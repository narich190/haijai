<?php
class register extends CI_Controller{
	public function register(){
		parent::__construct();
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
		redirect("main");
		
		


	}







}
?>