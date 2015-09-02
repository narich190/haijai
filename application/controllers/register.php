<?php
class register extends CI_Controller{

	private $uid;

	private $access_token;

	public function __construct()
	{
		parent::__construct();

		$this->load->library("session");
		$this->load->library("facebook",array(
			"appId"=>"878498028884904",
			"secret"=>"d90e3135b2566f7ace704f6725ccaaa9"
			));
		$this->uid = $this->facebook->getUser();
		$this->access_token = $this->facebook->getAccessToken();
		$this->facebook->setAccessToken($this->access_token);
	}




	public function index(){
	
		
		$this->load->view("fontend/topandfooter/topheader.php");

		$this->load->view("fontend/profile/register.php");

		$this->load->view("fontend/topandfooter/bottomfooter.php");

		

	}

	public function savemember(){

		$member_name = $this->input->post("member_name");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$biography = $this->input->post("biography");
		$location = $this->input->post("location");
		$email = $this->input->post("email");
		$receiveemailnews = $this->input->post("receiveemailnews");

		//interest table
		$project_group_projectgroup_id = $this->input->post("project_group_projectgroup_id");

		//img_profilepath

		//backgroundCrm_pdfpath
		//img_copypersonalCardpath
		//img_copyhomeBookpath

		if($receiveemailnews != "yes"){
			$receiveemailnews = "no";
		}


		//insert
		$this->db->query("insert into member 
		values(null, '".$member_name."', '', '".$biography."', '".$location."', '".$username."', '".$password."', '".$email."','member', 'approve', '".$receiveemailnews."', '', '', '')");
		
		//get member_id
		$memberdata = $this->db->select("*")->from("member")->where("member_name",$member_name)->where("username",$username)->get()->row_array();

		
		//upload user profile
		$config['upload_path']= 'assets/img/profile';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config['max_size'] = 100000;
		$config['file_name'] = "profile-".$memberdata['member_id'];

		$this->upload->initialize($config);
		$this->upload->do_upload("img_profilepath");
		$pathupdate = $this->upload->file_name;


		//upload backgroundCrm_pdfpath profile
		$config2['upload_path']= 'assets/img/profile/backgroundCrm';
		$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config2['max_size'] = 100000;
		$config2['file_name'] = "backgroundCrm_pdfpath-".$memberdata['member_id'];

		$this->upload->initialize($config2);
		$this->upload->do_upload("backgroundCrm_pdfpath");
		$pathupdate2 = $this->upload->file_name;



		//upload img_copypersonalCardpath profile
		$config3['upload_path']= 'assets/img/profile/copypersonalCard';
		$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config3['max_size'] = 100000;
		$config3['file_name'] = "img_copypersonalCardpath-".$memberdata['member_id'];

		$this->upload->initialize($config3);
		$this->upload->do_upload("img_copypersonalCardpath");
		$pathupdate3 = $this->upload->file_name;



		//upload img_copyhomeBookpath profile
		$config4['upload_path']= 'assets/img/profile/copyHomeBook';
		$config4['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config4['max_size'] = 100000;
		$config4['file_name'] = "img_copyhomeBookpath-".$memberdata['member_id'];

		$this->upload->initialize($config4);
		$this->upload->do_upload("img_copyhomeBookpath");
		$pathupdate4 = $this->upload->file_name;
			



		//update path update
		$pathupdatearr = array(
            'img_profilepath' => $pathupdate,
            'backgroundCrm_pdfpath' => $pathupdate2,
            'img_copypersonalCardpath' => $pathupdate3,
            'img_copyhomeBookpath' => $pathupdate4,
        );

		$this->db->where('member_id', $memberdata['member_id']);
		$this->db->update('member', $pathupdatearr); 


		//insert into member interest group
		
		$this->db->query("insert into interest 
		values(null, '".$memberdata['member_id']."', '".$project_group_projectgroup_id."')");
		

		//-----------notification------------
		$linkpath = "main";
		$detail = "ยินดีต้อนรับเข้ามาเป็นส่วนหนึ่งของ ให้ใจครับ";
				
		$this->noti->newNoti($detail, $linkpath, $memberdata['member_id']);
		//-----------------------------------

		//-----------------new admin noti-------------------
			$detail = $member_name." ส่งคำร้องขอสมัครสมาชิกเข้ามา";
			$linkpath = "managemember/filtermember/".$memberdata['member_id'];
			$admin_type = "admin_member";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------

		//------------------ TODO:should to automatic login ? ------------------


			//success login					
    		$this->session->set_userdata('membersession', $memberdata);
    		//keeplog
			$this->noti->keeplog("member","เข้าสู่ระบบ ", $_SERVER['REQUEST_URI']);


		redirect("main");
		
		


	}


	public function loginfacebook(){


		if($this->uid){
			try {
				$me = $this->facebook->api("/me");
				//$this->session->set_userdata("facebook",$me['id']);
				//redirect("auth");

			} catch (FacebookApiException $e) {
					print_r($e);
					$this->uid = NULL;
			}
		}else{
			die("<script>top.location='".$this->facebook->getLoginUrl(array(
					"scope"=>"email",
					"redirect_url"=>site_url("auth")
				))."'</script>");
		}

		$this->checkUserAlready($me);



	}


	public function checkUserAlready($me){

		$fb_id = $me['id'];
		$fb_name = $me['name'];

		$memberfaceInfo = $this->db->select("*")->from("memfacebook")->where("fb_id",$fb_id)->get()->row_array();
		//echo sizeof($memberfaceInfo);
		//print_r($memberfaceInfo);

		if(sizeof($memberfaceInfo) == 0){

			$member_name = $fb_name;
			$username = $fb_name."#".$fb_name;
			$password = $fb_name."#".$fb_name;
			$biography = "";
			$location = "";
			$email = '';
			$receiveemailnews = '';

			//interest table
			$project_group_projectgroup_id = 1;


			if($receiveemailnews != "yes"){
				$receiveemailnews = "no";
			}


			//insert
			$this->db->query("insert into member 
			values(null, '".$member_name."', '', '".$biography."', '".$location."', '".$username."', '".$password."', '".$email."','member', 'approve', '".$receiveemailnews."', '', '', '')");
			
			
			//$admindata = $this->db->select("*")->from("admin")->where("username",$username)->where("password",$password)->get()->row_array();
			$memberInfo = $this->db->select("*")->from("member")->where("member_name",$member_name)->where("username",$username)->where("password",$password)->get()->row_array();

			//insert into member interest group
			$this->db->query("insert into interest 
			values(null, '".$memberInfo['member_id']."', '".$project_group_projectgroup_id."')");

			//insert
			$this->db->query("insert into memfacebook 
			values(null, '".$fb_id."', ".$memberInfo['member_id'].")");
			

			//success login					
    		$this->session->set_userdata('membersession', $memberInfo);
    		//keeplog
			$this->noti->keeplog("member","เข้าสู่ระบบ ", $_SERVER['REQUEST_URI']);



			//-----------notification------------
			$linkpath = "main";
			$detail = "ยินดีต้อนรับเข้ามาเป็นส่วนหนึ่งของ ให้ใจครับ";
					
			$this->noti->newNoti($detail, $linkpath, $memberInfo['member_id']);
			//-----------------------------------
			

		}else{

			$memberInfo = $this->db->select("*")->from("member")->where("member_id",$memberfaceInfo['member_id'])->get()->row_array();

			//success login					
    		$this->session->set_userdata('membersession', $memberInfo);
    		//keeplog
			$this->noti->keeplog("member","เข้าสู่ระบบ ", $_SERVER['REQUEST_URI']);


		}
	

		
		redirect("main");
	
	}






}
?>