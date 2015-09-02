<?php
class control extends CI_Controller{
	public function index(){
		echo "notlogin";
	}

	/*--------log in Back end----------*/

	public function unavailable(){
		$this->load->view("unavailable.php");
	}

	public function login(){

		if($this->input->post("username")!=null){
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			
			if($username != "" && $password != ""){
				
				$admindata = $this->db->select("*")->from("admin")->where("username",$username)->where("password",$password)->get()->row_array();
				if(count($admindata)!=0){
    				
    				$this->session->set_userdata('adminsession', $admindata);
    				//keeplog
					$this->noti->keeplog("admin","เข้าสู่ระบบ ", $_SERVER['REQUEST_URI']);
			

					if($admindata['admin_type']=="admin_boss"){
						redirect("dash");
						exit();
					}
					else if($admindata['admin_type']=='admin_donator'){
						redirect("dash");
						exit();
					}else if($admindata['admin_type']=='admin_project'){
						redirect("manageproject");
						exit();
					}else if($admindata['admin_type']=='admin_receivemoney'){
						redirect("receivemoneyfund");
						exit();
					}else if($admindata['admin_type']=='admin_problem'){
						redirect("manageproblem");
						exit();
					}else{
						redirect("managemember");
						exit();
					}
				}
				else{
					echo "<font color='red'>username or password falsed</font>";
					$this->load->view("backend/login.php");
				}
			}
			else{
				/*
				$headers = apache_request_headers();

				foreach ($headers as $header => $value) {
				    echo "$header: $value <br />\n";
				}
				*/

				echo "<font color='red'>input username and password</font>";
				$this->load->view("backend/login.php");
			}
			
		}
		else{
			
			
			//echo  $this->get_ip_address();
			//echo $this->os_info();
			//echo $this->input->ip_address();
			
			$this->load->view("backend/login.php");
		}
		
	}

	

	public function logout(){

		//keeplog
		$this->noti->keeplog("admin","ออกจากระบบ ", $_SERVER['REQUEST_URI']);

		$this->session->unset_userdata("login_id");
		$this->load->view("backend/login.php");

	}


	public function checkRowNoti(){

		$admin_type = $this->input->post("admin_type");

		$result = "";
		if($admin_type == "admin_boss"){
			$result = $this->db->select("*")->from("adminnoti")->order_by("noti_time","desc")->get()->result_array();
		}else{
			$result = $this->db->select("*")->from("adminnoti")->where("admin_type",$admin_type)->order_by("noti_time","desc")->get()->result_array();
		}

		echo json_encode($result);

	}

	public function editReadNoti(){

		$notiID = $this->input->post("notiID");

		$pathupdatearr = array(
            'readStatus' => "read",
        );

		$this->db->where('notiID', $notiID);
		$this->db->update('adminnoti', $pathupdatearr);

		echo json_encode("");

	}

	/*--------log in font end----------*/
	public function checkloginfontend(){

		if($this->input->post("username")!=null){
			$username = $this->input->post("username");
			$password = $this->input->post("password");

			if($username != "" && $password != ""){
				//check user in databasw
				$memberdata = $this->db->select("*")->from("member")->where("username",$username)->where("password",$password)->get()->row_array();
				//echo $memberdata['member_name'];
				
				if(count($memberdata)!=0){
					//success login					
    				$this->session->set_userdata('membersession', $memberdata);
    				//keeplog
					$this->noti->keeplog("member","เข้าสู่ระบบ ", $_SERVER['REQUEST_URI']);

    				//keep current message data
    				$startMsgID = $this->db->select_max("msg_id")->from("MESSAGEBOX m")->where("m.sender_member_id",$memberdata['member_id'])->or_where("m.member_member_id",$memberdata['member_id'])->order_by("m.msg_create","desc")->limit(1)->get()->row_array();
    				$curMsgID = $startMsgID['msg_id'];
					$msgidsession = $this->session->userdata('startMsgIDsession');
					if(($msgidsession == "") || ($msgidsession != $curMsgID )){
						$ar = array(
								"startMsgIDsession"=> $curMsgID,
						);
						$this->session->set_userdata($ar);
					}

    				

					redirect("main");
					exit();
				}else{
					//fail login
					echo "<font color='red'>username or password falsed</font>";
					//redirect("main");
				}
				
				
			}
			else{
				//echo "<font color='red'>username or password falsed</font>";
				//$this->load->view("backend/login.php");
				//redirect("main");
			}
			
		}
		else{
			//$this->load->view("backend/login.php");
			//redirect("main");
		}
		
		
	}

	public function fontendlogout(){
		//keeplog
		$this->noti->keeplog("member","ออกจากระบบ ", $_SERVER['REQUEST_URI']);

		$this->session->unset_userdata("membersession");
		redirect("main");

	}




}
?>