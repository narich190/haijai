<?php
class profile extends CI_Controller{
	public function profile(){
		parent::__construct();
	}

	public function index($id){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $id;

		$data['memberdata'] = $this->db->select("*")->from("member m")->join("interest i","i.member_member_id = m.member_id","left")->join("project_group g","i.project_group_projectgroup_id = g.projectgroup_id")->where("member_id",$member_id)->get()->result_array(); //get profile of member_id = 5 -> creator = 5
																																																															   //get follow history of member_id = 6 -> visitor
		$data['followprojectdata'] = $this->db->select("*")->from("project_follow f")->where("follow_type","member")->get()->result_array();


		$this->load->view("fontend/profile/profile.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}


	public function followmember(){

		$memberfollow_id = $this->input->post("memberfollow_id");
		$action = $this->input->post("action");


		if($action == 'follow'){

			//insert
			$this->db->query("insert into project_follow 
			values(null, '', '".$this->session->userdata['membersession']['member_id']."', '".$memberfollow_id."', 'member')");

		}else{ //unfollow

			$this->db->delete('project_follow', array('member_memberfollow_id' => $memberfollow_id, 'member_member_id' => $this->session->userdata['membersession']['member_id'])); 

		}

		echo json_encode("");
	}

	public function changepassword(){


		$member_id = $this->input->post("member_id");
		$oldpassword = $this->input->post("oldpassword");
		$newpassword = $this->input->post("newpassword");

		
		$getOldmemberdata = $this->db->select("*")->from("member m")->where("member_id",$member_id)->get()->row_array();

		$result = "";

		if($getOldmemberdata['password'] == $oldpassword){
		
			//update path update
		
			$pathupdatearr = array(
               'password' => $newpassword,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 
			
			$result = "เปลี่ยนรหัสผ่านเรียบร้อย";

		}else{
			$result = "กรุณาตรวจสอบรหัสผ่านเก่าของท่านอีกครั้ง";
		}

		echo json_encode($result);
	

	}

	public function updateuserInfo(){
		$member_id = $this->input->post("member_id");
		//imguserinfo
		$member_name = $this->input->post("member_name");
		$location = $this->input->post("location");
		$biography = $this->input->post("biography");
		$email = $this->input->post("email");
		$project_group_projectgroup_id = $this->input->post("project_group_projectgroup_id");


		//get old user profile path
		$getOldpathprofile = $this->db->select("*")->from("member m")->where("member_id",$member_id)->get()->row_array();

		if ($_FILES['img_profilepath']['name']!=""){

			array_map('unlink', glob("assets/img/profile/".$getOldpathprofile['img_profilepath']));

			//upload report file and update into table
			$config['upload_path']= 'assets/img/profile';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "profile-".$member_id;

			$this->upload->initialize($config);
			$this->upload->do_upload("img_profilepath");
			$pathupdate = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_profilepath' => $pathupdate,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}


		if ($_FILES['backgroundCrm_pdfpath']['name']!=""){

			array_map('unlink', glob("assets/img/profile/backgroundCrm/".$getOldpathprofile['backgroundCrm_pdfpath']));

			///upload backgroundCrm_pdfpath profile
			$config2['upload_path']= 'assets/img/profile/backgroundCrm';
			$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config2['max_size'] = 100000;
			$config2['file_name'] = "backgroundCrm_pdfpath-".$member_id;

			$this->upload->initialize($config2);
			$this->upload->do_upload("backgroundCrm_pdfpath");
			$pathupdate2 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'backgroundCrm_pdfpath' => $pathupdate2,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}

		if ($_FILES['img_copypersonalCardpath']['name']!=""){

			array_map('unlink', glob("assets/img/profile/copypersonalCard/".$getOldpathprofile['img_copypersonalCardpath']));

			//upload img_copypersonalCardpath profile
			$config3['upload_path']= 'assets/img/profile/copypersonalCard';
			$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config3['max_size'] = 100000;
			$config3['file_name'] = "img_copypersonalCardpath-".$member_id;

			$this->upload->initialize($config3);
			$this->upload->do_upload("img_copypersonalCardpath");
			$pathupdate3 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_copypersonalCardpath' => $pathupdate3,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}


		if ($_FILES['img_copyhomeBookpath']['name']!=""){

			array_map('unlink', glob("assets/img/profile/copyHomeBook/".$getOldpathprofile['img_copyhomeBookpath']));

			//upload img_copyhomeBookpath profile
			$config4['upload_path']= 'assets/img/profile/copyHomeBook';
			$config4['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config4['max_size'] = 100000;
			$config4['file_name'] = "img_copyhomeBookpath-".$member_id;
			
			$this->upload->initialize($config4);
			$this->upload->do_upload("img_copyhomeBookpath");
			$pathupdate4 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_copyhomeBookpath' => $pathupdate4,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}

		


		$this->db->set("m.member_name", $member_name);
		$this->db->set("m.location", $location);
		$this->db->set("m.biography", $biography);
		$this->db->set("m.email", $email);
		$this->db->set("i.project_group_projectgroup_id", $project_group_projectgroup_id);


		$this->db->where('m.member_id', $member_id);
		$this->db->where('m.member_id = i.member_member_id');
		$this->db->update('member as m, interest as i');


		redirect("profile/index/".$member_id);


	}

	public function updatecopydocument(){

		$member_id = $this->input->post("member_id");
		

		if ($_FILES['backgroundCrm_pdfpath']['name']!=""){

			///upload backgroundCrm_pdfpath profile
			$config2['upload_path']= 'assets/img/profile/backgroundCrm';
			$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config2['max_size'] = 100000;
			$config2['file_name'] = "backgroundCrm_pdfpath-".$member_id;

			$this->upload->initialize($config2);
			$this->upload->do_upload("backgroundCrm_pdfpath");
			$pathupdate2 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'backgroundCrm_pdfpath' => $pathupdate2,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}

		if ($_FILES['img_copypersonalCardpath']['name']!=""){

			
			//upload img_copypersonalCardpath profile
			$config3['upload_path']= 'assets/img/profile/copypersonalCard';
			$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config3['max_size'] = 100000;
			$config3['file_name'] = "img_copypersonalCardpath-".$member_id;

			$this->upload->initialize($config3);
			$this->upload->do_upload("img_copypersonalCardpath");
			$pathupdate3 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_copypersonalCardpath' => $pathupdate3,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}


		if ($_FILES['img_copyhomeBookpath']['name']!=""){

			//upload img_copyhomeBookpath profile
			$config4['upload_path']= 'assets/img/profile/copyHomeBook';
			$config4['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config4['max_size'] = 100000;
			$config4['file_name'] = "img_copyhomeBookpath-".$member_id;
			
			$this->upload->initialize($config4);
			$this->upload->do_upload("img_copyhomeBookpath");
			$pathupdate4 = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_copyhomeBookpath' => $pathupdate4,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 


		}

		

		redirect("project/createproject");

	}

	public function updatereceivenewsInfo(){
		$member_id = $this->input->post("member_id");
		
		$email = $this->input->post("email");
		$receiveemailnews = $this->input->post("receiveemailnews");


		//update path update
		$pathupdatearr = array(
            'email' => $email,
            'receiveemailnews' => $receiveemailnews,

        );

		$this->db->where('member_id', $member_id);
		$this->db->update('member', $pathupdatearr); 


		echo json_encode("");


	}

	public function receivenews(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];

		$criteriaproject_status = array('success','receivemoney'); 
		$data['memberdata'] = $this->db->select("*")->from("member")->where("member_id",$member_id)->get()->row_array();

		$data['folllowmemberdata'] = $this->db->select("*")->from("project_follow f")->join("member m","f.member_memberfollow_id = m.member_id")->where("follow_type","member")->where("f.member_member_id",$member_id)->get()->result_array();
		
		$data['followdonationdata'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse")->from("project_follow f")->join("project p","f.project_project_id = p.project_id")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->where("follow_type","project")->where("f.member_member_id",$member_id)->where("project_type","รับบริจาค")->get()->result_array();
		$data['followfunddata'] = $this->db->select("*,  DATEDIFF(project_end,now()) AS daycanuse")->from("project_follow f")->join("project p","f.project_project_id = p.project_id")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->where("follow_type","project")->where("f.member_member_id",$member_id)->where("project_type","ระดมทุน")->get()->result_array();
		$data['funddataproject1'] = $this->db->select("project_project_id, sum(money) as moneyfund")->from("Donationlog")->where("member_member_id",$member_id)->where("inuse","project1")->where("donation_status <>","waitapprove")->group_by("project_project_id")->get()->result_array();
		$data['funddataproject2'] = $this->db->select("project_project_id, sum(money) as moneyfund")->from("Donationlog")->where("member_member_id",$member_id)->where("inuse","project2")->where("donation_status <>","waitapprove")->group_by("project_id2")->get()->result_array();
		
		

		$this->load->view("fontend/profile/receivenews.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}



	public function transproject(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];


		$criteriaproject_status = array('approve'); 
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","รับบริจาค")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","ระดมทุน")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();


		$this->load->view("fontend/profile/transproject.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function updateproject(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];


		$criteriaproject_status = array('approve'); 
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","รับบริจาค")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","ระดมทุน")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();


		$this->load->view("fontend/profile/updateproject.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}


	public function reportproject(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];

		$criteriaproject_status = array('approve'); 
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","รับบริจาค")->where("m.member_id",$member_id)->get()->result_array();
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","ระดมทุน")->where("m.member_id",$member_id)->get()->result_array();


		$this->load->view("fontend/profile/reportproject.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function successactivity(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];


		$criteriaproject_status = array('success','receivemoney'); 
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","รับบริจาค")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","ระดมทุน")->where("m.member_id",$member_id)->where("block_status","no")->get()->result_array();


		$this->load->view("fontend/profile/successactivity.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function reportactivity(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];

		//not sure to block project ?
		$criteriaproject_status = array('success','receivemoney'); 
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","รับบริจาค")->where("m.member_id",$member_id)->get()->result_array();
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("project_type","ระดมทุน")->where("m.member_id",$member_id)->get()->result_array();


		$this->load->view("fontend/profile/reportactivity.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}


}
?>