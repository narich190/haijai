<?php 
class noti extends CI_Model{

	public function newNoti($detail, $linkpath, $member_id){

		$this->db->query("insert into membernoti 
		values(null, '".$detail."', '".$linkpath."', NOW(), 'notread', ".$member_id.")");

		return "success";

	}

	public function newadminNoti($detail, $linkpath, $admin_type){

		$this->db->query("insert into adminnoti 
		values(null, '".$detail."', '".$linkpath."', NOW(), 'notread', '".$admin_type."')");

		return "success";

	}


	public function keeplog($type, $detail, $act_url){
		
		$log_id = null;
		$log_type = $type; //or member;
		$ip_user = $this->get_ip_address();
		$os_user = $this->os_info();
		$log_time = $this->get_Datetime_Now(0);
		$id = "";
		$action_detail = "";
		if($log_type == "admin"){
			$id = $this->session->userdata['adminsession']['admin_id'];
			$name = $this->session->userdata['adminsession']['admin_name'];
			$action_detail = $name." ".$detail;
		}else{
			$id = $this->session->userdata['membersession']['member_id'];
			$name = $this->session->userdata['membersession']['member_name'];
			$action_detail = $name." ".$detail;
		}
		$action_url = $act_url;
		
/*
		echo "log_id: ".$log_id."<br>";
		echo "log_type: ".$log_type."<br>";
		echo "ip_user: ".$ip_user."<br>";
		echo "os_user: ".$os_user."<br>";
		echo "log_time: ".$log_time."<br>";
		echo "id: ".$id."<br>";
		echo "action_detail: ".$action_detail."<br>";
*/

		$this->db->query("insert into loginfo 
			values(null, '".$log_type."', '".$ip_user."', '".$os_user."', '".$log_time."', '".$id."','".$action_detail."','".$action_url."')");

	}


	//get date time
	function get_Datetime_Now($datewantadd) {
	    $tz_object = new DateTimeZone('Asia/Bangkok');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    $datetime->modify('+'.$datewantadd.' day');

	    return $datetime->format('Y\-m\-d\ h:i:s');
	}

	//get client ip
	function get_ip_address() {
		$ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
		foreach ($ip_keys as $key) {
		    if (array_key_exists($key, $_SERVER) === true) {
		        foreach (explode(',', $_SERVER[$key]) as $ip) {
		            // trim for safety measures
		            $ip = trim($ip);
		            // attempt to validate IP
		            if ($this->validate_ip($ip)) {
		                return $ip;
		            }
		        }
		    }
		}

		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
	}

	function validate_ip($ip)
	{
		if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
		    return false;
		}
		return true;
	}

	//get OS system
	function os_info()
	{	
		$uagent = $_SERVER['HTTP_USER_AGENT'];
	    // the order of this array is important
	    global $uagent;
	    $oses   = array(
	        'Win311' => 'Win16',
	        'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
	        'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
	        'Win98' => '(Windows 98)|(Win98)',
	        'Win2000' => '(Windows NT 5.0)|(Windows 2000)',
	        'WinXP' => '(Windows NT 5.1)|(Windows XP)',
	        'WinServer2003' => '(Windows NT 5.2)',
	        'WinVista' => '(Windows NT 6.0)',
	        'Windows 7' => '(Windows NT 6.1)',
	        'Windows 8' => '(Windows NT 6.2)',
	        'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
	        'OpenBSD' => 'OpenBSD',
	        'SunOS' => 'SunOS',
	        'Ubuntu' => 'Ubuntu',
	        'Android' => 'Android',
	        'Linux' => '(Linux)|(X11)',
	        'iPhone' => 'iPhone',
	        'iPad' => 'iPad',
	        'MacOS' => '(Mac_PowerPC)|(Macintosh)',
	        'QNX' => 'QNX',
	        'BeOS' => 'BeOS',
	        'OS2' => 'OS/2',
	        'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
	    );
	    $uagent = strtolower($uagent ? $uagent : $_SERVER['HTTP_USER_AGENT']);
	    foreach ($oses as $os => $pattern)
	        if (preg_match('/' . $pattern . '/i', $uagent))
	            return $os;
	    return 'Unknown';
	}


}
?>