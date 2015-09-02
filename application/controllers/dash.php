<?php
class dash extends CI_Controller{
	public function dash(){
		parent::__construct();
	}

	public function index(){
		
		$this->noti->keeplog("admin","เข้ามาดูธุรกรรม ", $_SERVER['REQUEST_URI']);//keeplog
		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//database reference: donationlog, project, permanent_foundation, member
		//pagination
			$config['base_url'] = base_url()."/dash/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('Donationlog');
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

		//get all donation log
		$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")->from("Donationlog d")->join("project p","p.project_id = d.project_project_id")->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")->join("member m","d.member_member_id = m.member_id")->order_by("donation_create", "desc")->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		

		
		$this->load->view("backend/dash/dashcontent.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	
	//for bug ajax safari
	public function bugsafari(){
		header("Connection: Close");
	}

	public function updatestatusdonationlog(){

		$action = $this->input->post("action"); //success or waitapprove
		$donationlog_id = $this->input->post("donationlog_id");
		
		$this->db->set("donation_status", $action);
		$this->db->where('donationlog_id', $donationlog_id);
		$this->db->update('Donationlog');

		$this->updateprojectmoney($action, $donationlog_id);



		$donationdata = $this->db->select("*")->from("Donationlog")->where("donationlog_id",$donationlog_id)->get()->row_array();
		
		//-----------------new noti-------------------------
		$donationlog_idwithtext = $donationdata['donation_channel']=='bank'?'BA':'PA';
		if($action=="success"){
			//keeplog
			$this->noti->keeplog("admin", "อนุมัติธุรกรรมหมายเลข ".$donationlog_idwithtext.$donationdata['donationlog_id'], $_SERVER['REQUEST_URI']);

			$detail = "หมายเลขธุรกรรม ".$donationlog_idwithtext.$donationdata['donationlog_id']." ได้รับการตรวจสอบเรียบร้อยเเล้ว";
		}else{
			$this->noti->keeplog("admin","ยกเลิกธุรกรรมหมายเลข ".$donationlog_idwithtext.$donationdata['donationlog_id'], $_SERVER['REQUEST_URI']);

			$detail = "หมายเลขธุรกรรม ".$donationlog_idwithtext.$donationdata['donationlog_id']." มีปัญหากรุณาติดต่อผู้ดูแลระบบ";
		}
			$linkpath = "tracking";
			$member_id = $donationdata['member_member_id'];

			$this->noti->newNoti($detail, $linkpath, $member_id);
		//--------------------------------------------------

		//------------------noti of creator-----------------
		

		$project_id = 0;
		if($donationdata['inuse']=='project1'){
			$project_id = $donationdata['project_project_id'];	
		}else if($donationdata['inuse']=='project2'){
			$project_id = $donationdata['project_id2'];
		}
		$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();
		
		if($action=="success"){
			$detail = "โครงการ".$project_info['project_name']."มีการระดมสินทรัพย์เข้ามาในโครงการของคุณ ".$donationdata['money']."บาท";
		}else{
			$detail = "มีการตรวจสอบพบรายการธุรกรรมที่ผิดพลาดเข้ามาในโครงการ".$project_info['project_name']."ของคุณจำนวน ".$donationdata['money']."บาท";
		}
		$creator_id = $project_info['member_member_id'];

		$linkpath = "profile/transproject";
		
		$this->noti->newNoti($detail, $linkpath, $creator_id);
		//--------------------------------------------------
		


		echo json_encode("ดำเนินรายการอัพเดทสถานะทางธุรกรรมเรียบร้อย");

	}

	public function updateprojectmoney($action, $donationlog_id){
		//get inuse of donation form donation_id
		$getDonationInfo = $this->db->select("*")->from("Donationlog")->where("donationlog_id",$donationlog_id)->get()->row_array(); //get last product ID
		$getOldProjectInfo = "";
		
		//increase
		if ($action == "success"){
			if ($getDonationInfo['inuse'] == "project1"){
				$getOldProjectInfo = $this->db->select("*")->from("project")->where("project_id",$getDonationInfo['project_project_id'])->get()->row_array(); //get last product ID
				//update money
				$this->db->set("money_raising", $getOldProjectInfo['money_raising']+$getDonationInfo['money']);
				$this->db->where('project_id', $getOldProjectInfo['project_id']);
				$this->db->update('project');	
			}
			else if($getDonationInfo['inuse'] == "project2"){
				$getOldProjectInfo = $this->db->select("*")->from("project")->where("project_id",$getDonationInfo['project_id2'])->get()->row_array(); //get last product ID

				//update money
				$this->db->set("money_raising", $getOldProjectInfo['money_raising']+$getDonationInfo['money']);
				$this->db->where('project_id', $getOldProjectInfo['project_id']);
				$this->db->update('project');	
			}
		}
		else{
			if ($getDonationInfo['inuse'] == "project1"){
				$getOldProjectInfo = $this->db->select("*")->from("project")->where("project_id",$getDonationInfo['project_project_id'])->get()->row_array(); //get last product ID
				//update money
				$this->db->set("money_raising", $getOldProjectInfo['money_raising'] - $getDonationInfo['money']);
				$this->db->where('project_id', $getOldProjectInfo['project_id']);
				$this->db->update('project');	
			}
			else if($getDonationInfo['inuse'] == "project2"){
				$getOldProjectInfo = $this->db->select("*")->from("project")->where("project_id",$getDonationInfo['project_id2'])->get()->row_array(); //get last product ID

				//update money
				$this->db->set("money_raising", $getOldProjectInfo['money_raising'] - $getDonationInfo['money']);
				$this->db->where('project_id', $getOldProjectInfo['project_id']);
				$this->db->update('project');	
			}
		}

		//----------Question: what should we do in permanent project -> How to manage money?----------

	}

	public function filterdash($donationlog_id){


		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//get all donation log
		$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")
								->from("Donationlog d")
								->join("project p","p.project_id = d.project_project_id")
								->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")
								->join("member m","d.member_member_id = m.member_id")
								->where("donationlog_id",$donationlog_id)
								->order_by("donation_create", "desc")
								->get()->result_array();
		
		
		$this->load->view("backend/dash/dashcontent.php",$data);
		$this->load->view("backend/dash/scriptinside.php");


	}

	public function filter(){
		

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		$donation_status = $this->input->post("statusfil");
		$dfromfil = $this->input->post("datefromfil");
		$dtofil = $this->input->post("datetofil");


		//firsttime to filter
		if($this->session->userdata('donation_status_ssession')=="" && 
			$this->session->userdata('donation_dtofil_session')=="" && 
			$this->session->userdata('donation_dfromfil_session')==""){
			
			$ar = array(
					"donation_status_ssession"=> $donation_status,
					"donation_dfromfil_session"=>$dfromfil,
					"donation_dtofil_session"=>$dtofil,
			);

			$this->session->set_userdata($ar);
		}

		//second time to filter
		if(($this->session->userdata('donation_statussession')!=$donation_status  && $donation_status != "")
			|| (($this->session->userdata('dtosession')!=$dtofil && $dtofil != "")
			&& ($this->session->userdata('dfromsession')!=$dfromfil && $dfromfil != ""))){
			$ar = array(
					"donation_status_ssession"=> $this->input->post("statusfil"),
					"donation_dfromfil_session"=> $this->input->post("datefromfil"),
					"donation_dtofil_session"=>$this->input->post("datetofil"),
			);

			$this->session->set_userdata($ar);
		}


		//$pfil =  $this->session->userdata('psession');
		$donation_status =  $this->session->userdata('donation_status_ssession');
		$dfromfil = $this->input->post("datefromfil");
		$dtofil = $this->input->post("datetofil");


		$datecheck = "notchoose";
	
		if($dfromfil != "" && $dtofil != ""){$datecheck="choose";}


		$counttable = 0;

	
		//11
		if($donation_status != "notchoose" && $datecheck != "notchoose"){
			$counttable = $this->db->select("*")
						->from("Donationlog log")
						->where("log.donation_status",$donation_status)
						->where("SUBSTRING(log.donation_create, 1, 10) >=", $dfromfil)
						->where('SUBSTRING(log.donation_create, 1, 10) <=', $dtofil)
						->order_by("donation_create", "desc")->count_all_results();
		}
		//10
		else if($donation_status != "notchoose" && $datecheck == "notchoose"){
			$counttable = $this->db->select("*")
						->from("Donationlog log")
						->where("log.donation_status",$donation_status)
						->order_by("donation_create", "desc")
						->count_all_results();
		}
		//01
		else if($donation_status == "notchoose" && $datecheck != "notchoose"){
			$counttable = $this->db->select("*")
						->from("Donationlog log")
						->where("SUBSTRING(log.donation_create, 1, 10) >=", $dfromfil)
						->where('SUBSTRING(log.donation_create, 1, 10) <=', $dtofil)
						->order_by("donation_create", "desc")
						->count_all_results();
		}
		//00
		else{
			$counttable = $this->db->select("*")
							->from("Donationlog log")
							->count_all_results();
		}

		//pagination
			$config['base_url'] = base_url()."/dash/filter/";
			$config['per_page'] = 10;

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


		$data['donationdata'] = '';

		//11
		if($donation_status != "notchoose" && $datecheck != "notchoose"){
			//$data['logdata'] = $this->db->select("*")->from("orderlog log")->where("log.orderStatus",$sfil)->where("SUBSTRING(log.orderStart, 1, 10) >=", $dfromfil)->where('SUBSTRING(log.orderFinish, 1, 10) <=', $dtofil)->order_by("orderStart", "desc")->count_all_results();
			$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")
								->from("Donationlog d")
								->join("project p","p.project_id = d.project_project_id")
								->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")
								->join("member m","d.member_member_id = m.member_id")
								->where("d.donation_status",$donation_status)
								->where("SUBSTRING(d.donation_create, 1, 10) >=", $dfromfil)
								->where('SUBSTRING(d.donation_create, 1, 10) <=', $dtofil)
								->order_by("donation_create", "desc")
								->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		}
		//10
		else if($donation_status != "notchoose" && $datecheck == "notchoose"){
			//$data['logdata'] = $this->db->select("*")->from("orderlog log")->where("log.orderStatus",$sfil)->order_by("orderStart", "desc")->count_all_results();
			$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")
								->from("Donationlog d")
								->join("project p","p.project_id = d.project_project_id")
								->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")
								->join("member m","d.member_member_id = m.member_id")
								->where("d.donation_status",$donation_status)
								->order_by("donation_create", "desc")
								->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		}
		//01
		else if($donation_status == "notchoose" && $datecheck != "notchoose"){

			$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")
								->from("Donationlog d")
								->join("project p","p.project_id = d.project_project_id")
								->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")
								->join("member m","d.member_member_id = m.member_id")
								->where("SUBSTRING(d.donation_create, 1, 10) >=", $dfromfil)
								->where('SUBSTRING(d.donation_create, 1, 10) <=', $dtofil)
								->order_by("donation_create", "desc")
								->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		}
		//00
		else{
			$data['donationdata'] = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")
								->from("Donationlog d")
								->join("project p","p.project_id = d.project_project_id")
								->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")
								->join("member m","d.member_member_id = m.member_id")
								->order_by("donation_create", "desc")
								->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		}



		//get all donation log

		
		$this->load->view("backend/dash/dashfilter.php",$data);
		$this->load->view("backend/dash/scriptinside.php");

	}



}
?>