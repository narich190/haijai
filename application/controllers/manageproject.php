<?php
class manageproject extends CI_Controller{
	public function manageproject(){
		parent::__construct();
	}

	public function index(){
		
		$this->noti->keeplog("admin","เข้ามาดูคำร้องขอสร้างโครงการ ", $_SERVER['REQUEST_URI']);//keeplog

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/manageproject/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('project');
			$config['total_rows'] = $counttable;


			

			//out side
			$config['full_tag_open'] = "<ul class='pagination'>";
				
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';

   				$config['last_tag_open'] = '<li>';
   				$config['last_tag_close'] = '</li>';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				//current page
				$config['cur_tag_open'] = "<li class='active'><a>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				
				//another page
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";

				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

			$config['full_tag_close'] = "</ul";

			$this->pagination->initialize($config);



		$criteriaproject_status = array('waitapprove'); 
		$data['requestproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status <>","yes")->get()->result_array();

		
		$this->load->view("backend/manageproject/requestmanageproject.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}


	public function approveRequestProject(){

		$project_id = $this->input->post("project_id");
		$action = $this->input->post("action");

		$criteriaproject_status = 'waitapprove'; 
		$getOlddataproject = $this->db->select("*")->from("project_status")->where("project_project_id",$project_id)->where("project_status",$criteriaproject_status)->get()->row_array();
		
		//cal diff date of request and end
		$date1=date_create($getOlddataproject['project_request']);
		$date2=date_create($getOlddataproject['project_end']);
		$diff=date_diff($date1,$date2);
		$result = substr($diff->format("%R%a"), 1); //delete operation

		
		//update path update
			$pathupdatearr = array(
               'project_approved' => $this->get_Datetime_Now(0),
               'project_status' => $action,
               'project_end' => $this->get_Datetime_Now($result),
            );

			$this->db->where('project_project_id', $project_id);
			$this->db->update('project_status', $pathupdatearr); 


		$project_info = $this->db->select("*")->from("project p")->where("p.project_id",$project_id)->get()->row_array();

		//-----------noti of comment to creator--------------
		$linkpath = "project/detailprojectfund/".$project_id."";
		$detail = "โครงการ".$project_info['project_name']." ของคุณได้รับการอนุมัติเเล้ว";
				
		$this->noti->newNoti($detail, $linkpath, $project_info['member_member_id']);
		//-----------------------------------


		//-----------noti of update follow member--------------
		$member_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();
		
		$linkpath = "project/detailprojectfund/".$project_id."";
		$detail = $member_info['member_name']."ได้สร้างโครงการ".$project_info['project_name']."";
		
		$member_follow_info = $this->db->select("*")->from("project_follow")
						->where("follow_type","member")
						->where("member_memberfollow_id",$member_info['member_id'])
						->where("member_member_id <>",$project_info['member_member_id'])
						->get()->result_array();

		foreach ($member_follow_info as $key => $value) {
			$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
		}
		//-----------------------------------


		$this->noti->keeplog("admin","อนุมัติคำร้องขอสร้างโครงการ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog

		echo json_encode("อนุมัติโครงการเรียบร้อยเเล้ว");
		
	}

	function get_Datetime_Now($datewantadd) {
	    $tz_object = new DateTimeZone('Asia/Bangkok');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    $datetime->modify('+'.$datewantadd.' day');

	    return $datetime->format('Y\-m\-d\ h:i:s');
	}

	public function allproject(){
		
		$this->noti->keeplog("admin","เข้ามาดูโครงการทั้งหมด ", $_SERVER['REQUEST_URI']);//keeplog
		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		//pagination
			$config['base_url'] = base_url()."/manageproject/allproject/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('project');
			$config['total_rows'] = $counttable;


			//out side
			$config['full_tag_open'] = "<ul class='pagination'>";
				
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';

   				$config['last_tag_open'] = '<li>';
   				$config['last_tag_close'] = '</li>';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				//current page
				$config['cur_tag_open'] = "<li class='active'><a>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				
				//another page
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";

				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

			$config['full_tag_close'] = "</ul>";

			$this->pagination->initialize($config);



		$criteriaproject_status = 'waitapprove'; 
		$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->get()->result_array();

		



		$this->load->view("backend/manageproject/allproject.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}
	public function filterproject($project_id){

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/manageproject/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('project');
			$config['total_rows'] = $counttable;


			

			//out side
			$config['full_tag_open'] = "<ul class='pagination'>";
				
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';

   				$config['last_tag_open'] = '<li>';
   				$config['last_tag_close'] = '</li>';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				//current page
				$config['cur_tag_open'] = "<li class='active'><a>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				
				//another page
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";

				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

			$config['full_tag_close'] = "</ul";

			$this->pagination->initialize($config);



		$criteriaproject_status = array('waitapprove'); 
		$data['requestproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status <>","yes")->get()->result_array();

		
		$this->load->view("backend/manageproject/requestmanageproject.php",$data);
		$this->load->view("backend/dash/scriptinside.php");

	}



	public function createActivity(){


		//$activity_id = null
		//$activity_img_detailpath
		$video_detailpath = $this->input->post("video_detailpath"); //
		//$activity_pdfpath
		$project_id = $this->input->post("project_id"); //
		$block_status = "no"; //
		$activity_request = $this->get_Datetime_Now(0); //
		//$activity_approved = null //
		$activity_status = "waitapprove"; //
		$activity_deepdetail = $this->input->post("activity_deepdetail"); //


		//upload img_detailpath profile file and update into table
			$config2['upload_path'] = 'assets/img/activity/header';
			$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config2['max_size'] = 100000;
			$config2['file_name'] = "activity-img_detailpath-".$project_id;

			$this->upload->initialize($config2);
			$this->upload->do_upload("activity_img_detailpath");
			$pathupdate2 = $this->upload->file_name;


			//upload project_pdfpath profile file and update into table
			$config3['upload_path'] = 'assets/img/activity/documentproject';
			$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config3['max_size'] = 100000;
			$config3['file_name'] = "activity_pdfpath-".$project_id;

			$this->upload->initialize($config3);
			$this->upload->do_upload("activity_pdfpath");
			$pathupdate3 = $this->upload->file_name;

		

			$this->db->query("insert into activity 
			values(null,'$pathupdate2','$video_detailpath','$pathupdate3',$project_id,
				'$activity_request', null,'$activity_status','$activity_deepdetail');");
		
	

			//-----------noti of comment to creator--------------
			$project_info = $this->db->select("*")->from("project p")->where("p.project_id",$project_id)->get()->row_array();

			$linkpath = "profile/reportactivity";
			
			$detail = "เราได้รับคำร้องขอสร้างกิจกรรมประกาศโครงการ".$project_info['project_name']." ของคุณเเล้ว";
					
			$this->noti->newNoti($detail, $linkpath, $project_info['member_member_id']);
			//-----------------------------------


			//-----------------new admin noti-------------------
			$detail = $this->session->userdata['membersession']['member_name']." ส่งคำร้องขอสร้างกิจกรรมประกาศใหม่เข้ามา";
			$linkpath = "manageproject/filteractivity/".$project_id;
			$admin_type = "admin_project";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


		redirect("profile/successactivity");

	}

	public function requestmanageactivity(){
	
		$this->noti->keeplog("admin","เข้ามาดูคำร้องขอสร้างกิจกรรมประกาศ ", $_SERVER['REQUEST_URI']);//keeplog
		

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		//pagination
			$config['base_url'] = base_url()."/manageproject/requestmanageactivity/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('activity');
			$config['total_rows'] = $counttable;


			//out side
			$config['full_tag_open'] = "<ul class='pagination'>";
				
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';

   				$config['last_tag_open'] = '<li>';
   				$config['last_tag_close'] = '</li>';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				//current page
				$config['cur_tag_open'] = "<li class='active'><a>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				
				//another page
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";

				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

			$config['full_tag_close'] = "</ul>";

			$this->pagination->initialize($config);



		$criteriaproject_status = 'waitapprove'; 
		$data['requestactivity'] = $this->db->select("*, a.img_detailpath as activityimg, a.video_detailpath as activityvideo")->from("activity a")
		->join("project p","p.project_id = a.project_id")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->where("activity_status",$criteriaproject_status)
		->where("s.block_status <>","yes")
		->get()->result_array();




		$this->load->view("backend/manageproject/requestmanageactivity.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function approveRequestActivity(){

		$activity_id = $this->input->post("activity_id");
		$action = $this->input->post("action");

		
		//update path update
			$pathupdatearr = array(
               'activity_approved' => $this->get_Datetime_Now(0),
               'activity_status' => $action,
            );

			$this->db->where('activity_id', $activity_id);
			$this->db->update('activity', $pathupdatearr); 


			//-----------noti of comment to creator--------------
			$activity_info = $this->db->select("*")->from("activity a")->where("a.activity_id",$activity_id)->get()->row_array();
			$project_info = $this->db->select("*")->from("project p")->where("p.project_id",$activity_info['project_id'])->get()->row_array();

			$linkpath = "profile/reportactivity";
			
			$detail = "กิจกรรมประกาศโครงการ".$project_info['project_name']." ของคุณได้รับการอนุมัติเเล้ว";
					
			$this->noti->newNoti($detail, $linkpath, $project_info['member_member_id']);
			//--------------------------------------------------

				//-----------noti of update to follow--------------
				//TODO: Replace link to activity detail
				$linkpath = "project/detailprojectfund/".$project_info['project_id']."";
				$detail = "โครงการ".$project_info['project_name']."มีการอัพเดทกิจกรรมประกาศเข้ามา";
				
				$project_follow_info = $this->db->select("*")->from("project_follow")
								->where("follow_type","project")
								->where("project_project_id",$project_info['project_id'])
								->where("member_member_id <>",$project_info['member_member_id'])
								->get()->result_array();

				foreach ($project_follow_info as $key => $value) {
					$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
				}
				//-----------------------------------


		$this->noti->keeplog("admin","อนุมัติคำร้องขอสร้างกิจกรรมประกาศ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog

		echo json_encode("อนุมัติกิจกรรมประกาศเรียบร้อยเเล้ว");
		
	}

	public function allactivity(){
		
		$this->noti->keeplog("admin","เข้ามาดูกิจกรรมประกาศทั้งหมด ", $_SERVER['REQUEST_URI']);//keeplog

		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		$criteriaproject_status = 'waitapprove'; 
		$data['requestactivity'] = $this->db->select("*, a.img_detailpath as activityimg, a.video_detailpath as activityvideo, s.block_status as activity_block_status")->from("activity a")
		->join("project p","p.project_id = a.project_id")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->where("activity_status <>",$criteriaproject_status)
		->get()->result_array();

		
		$this->load->view("backend/manageproject/allactivity.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}


	public function blockProjectManage(){
		
		$project_id = $this->input->post("project_id");
		$action = $this->input->post("action"); 


			$pathupdatearr = array(
               'block_status' => $action,
            );

			$this->db->where('project_project_id', $project_id);
			$this->db->update('project_status', $pathupdatearr); 
		

		$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$project_id)->get()->row_array();
		if($action == "yes"){

			$linkpath = "";
			//-----------noti of comment to creator--------------
			if($project_info['project_status']!='success'){
				$linkpath = "profile/reportproject";
			}else{
				$linkpath = "profile/reportactivity";
			}
			$detail = "โครงการ".$project_info['project_name']." ของคุณถูกบล็อค กรุณาชี้เเจงข้อเท็จจริงภายใน 7 วัน";
					
			$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

			$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);
			//-----------------------------------


				//-----------noti of update to follow--------------
				$linkpath = "project/detailprojectfund/".$project_info['project_id']."";
				$detail = "โครงการ".$project_info['project_name']." ถูกบล็อค";
				
				$project_follow_info = $this->db->select("*")->from("project_follow")
								->where("follow_type","project")
								->where("project_project_id",$project_info['project_id'])
								->where("member_member_id <>",$project_info['member_member_id'])
								->get()->result_array();

				foreach ($project_follow_info as $key => $value) {
					$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
				}
				//-----------------------------------
			
			$this->noti->keeplog("admin","ล็อคโครงการ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog

		}else{

			$linkpath = "";
			//-----------noti of comment to creator--------------
			if($project_info['project_status']!='success'){
				$linkpath = "profile/reportproject";
			}else{
				$linkpath = "profile/reportactivity";
			}
			$detail = "โครงการ".$project_info['project_name']." ของคุณได้รับการปลดล็อคเเล้ว";
					
			$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

			$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);
			//-----------------------------------

				//-----------noti of update to follow--------------
				$linkpath = "project/detailprojectfund/".$project_info['project_id']."";
				$detail = "โครงการ".$project_info['project_name']." ได้รับการปลดบล็อคแล้ว";
				
				$project_follow_info = $this->db->select("*")->from("project_follow")
								->where("follow_type","project")
								->where("project_project_id",$project_info['project_id'])
								->where("member_member_id <>",$project_info['member_member_id'])
								->get()->result_array();

				foreach ($project_follow_info as $key => $value) {
					$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
				}
				//-----------------------------------
			

			$this->noti->keeplog("admin","ปลดล็อคโครงการ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog

		}
		
		
		echo json_encode("ดำเนินการเรียบร้อย");

	}


	public function filteractivity($project_id){

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		//pagination
			$config['base_url'] = base_url()."/manageproject/requestmanageactivity/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('activity');
			$config['total_rows'] = $counttable;


			//out side
			$config['full_tag_open'] = "<ul class='pagination'>";
				
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';

   				$config['last_tag_open'] = '<li>';
   				$config['last_tag_close'] = '</li>';

				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

				//current page
				$config['cur_tag_open'] = "<li class='active'><a>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				
				//another page
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";

				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';

			$config['full_tag_close'] = "</ul>";

			$this->pagination->initialize($config);



		$criteriaproject_status = 'waitapprove'; 
		$data['requestactivity'] = $this->db->select("*, a.img_detailpath as activityimg, a.video_detailpath as activityvideo")->from("activity a")
		->join("project p","p.project_id = a.project_id")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->where("activity_status",$criteriaproject_status)
		->where("s.block_status <>","yes")
		->get()->result_array();




		$this->load->view("backend/manageproject/requestmanageactivity.php",$data);
		$this->load->view("backend/dash/scriptinside.php");

	}

	

	//for bug ajax safari
	public function bugsafari(){
		header("Connection: Close");
	}


}
?>