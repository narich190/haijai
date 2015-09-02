<?php
class receivemoneyfund extends CI_Controller{
	public function receivemoneyfund(){
		parent::__construct();
	}

	public function index(){
		
		$this->noti->keeplog("admin","เข้ามาดูคำร้องขอรับเงินโครงการ ", $_SERVER['REQUEST_URI']);//keeplog

		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		$criteriaproject_status = array('success','receivemoney'); 
		
		//database reference: donationlog, project, permanent_foundation, member
		//pagination
			$config['base_url'] = base_url()."/receivemoneyfund/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->select("*")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where("project_type","ระดมทุน")
								->where_in("project_status",$criteriaproject_status)
								->where("project_account_id <>","")->count_all_results();

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


		$data['allproject'] = $this->db->select("*, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where("project_type","ระดมทุน")
								->where_in("project_status",$criteriaproject_status)
								->where("project_account_id <>","")
								->get()->result_array();
		
		$this->load->view("backend/receivemoneyfund/receivemoneyfund.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function filterreceivemoney($project_id){
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//database reference: donationlog, project, permanent_foundation, member
		//pagination
			$config['base_url'] = base_url()."/receivemoneyfund/index/";
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


		$criteriaproject_status = array('success','receivemoney'); 
		$data['allproject'] = $this->db->select("*, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where("project_type","ระดมทุน")->where_in("project_status",$criteriaproject_status)->where("project_account_id <>","")->get()->result_array();
		
		$this->load->view("backend/receivemoneyfund/receivemoneyfund.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
	}
	
	//for bug ajax safari
	public function bugsafari(){
		header("Connection: Close");
	}


	public function sendMoney(){

		$project_id = $this->input->post("project_id");
		$project_status = $this->input->post("project_status"); 
		//receive_money_evidence
		$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();
		
		if($project_status == "receivemoney"){

			//upload report file and update into table
			$config['upload_path']= 'assets/backend/images/receivemoneyevidence';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "project_id-evidence-".$project_id;

			$this->upload->initialize($config);
			$this->upload->do_upload("receive_money_evidence");
			$pathupdate = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'receive_money_evidence' => $pathupdate,
            );

			$this->db->where('project_id', $project_id);
			$this->db->update('project', $pathupdatearr);

			//update project_status
			$this->db->set("s.project_status", $project_status);
			$this->db->where('p.project_id', $project_id);

			$this->db->where('p.project_id = s.project_project_id');
			$this->db->update('project as p, project_status as s');

			$this->noti->keeplog("admin","อัพเดทสถานะการส่งเงินให้โครงการ".$project_info['project_name']." เป็นส่งเงินไปแล้ว ".$project_info['money_raising']." บาท เรียบร้อยเเล้ว", $_SERVER['REQUEST_URI']);//keeplog

		}else{

			$getOldpathEvidence = $this->db->select("*")->from("project p")->where("project_id",$project_id)->get()->row_array();

			array_map('unlink', glob("assets/backend/images/receivemoneyevidence/".$getOldpathEvidence['receive_money_evidence']));

			//update path update
			$pathupdatearr = array(
               'receive_money_evidence' => '',
            );

			$this->db->where('project_id', $project_id);
			$this->db->update('project', $pathupdatearr);

			//update project_status
			$this->db->set("s.project_status", $project_status);
			$this->db->where('p.project_id', $project_id);

			$this->db->where('p.project_id = s.project_project_id');
			$this->db->update('project as p, project_status as s');

			$this->noti->keeplog("admin","อัพเดทสถานะการส่งเงินให้โครงการ".$project_info['project_name']." เป็นยกเลิกการส่งเงินไปแล้ว ".$project_info['money_raising']." บาท เรียบร้อยเเล้ว", $_SERVER['REQUEST_URI']);//keeplog

		}

		redirect("receivemoneyfund");


	}

	public function movemoney($action,$member_id,$project_id){
		//movetosubproject
		//echo $action.", ".$member_id.", ".$project_id;
		//get donator info
		$donation_info1 = $this->db->select("*")->from("Donationlog d")->where("d.inuse","project1")->where("project_project_id",$project_id)->where("member_member_id",$member_id)->get()->result_array();
		$donation_info2 = $this->db->select("*")->from("Donationlog d")->where("d.inuse","project2")->where("project_id2",$project_id)->where("member_member_id",$member_id)->get()->result_array();
						
		$donation_info = array_merge($donation_info1, $donation_info2);
		
		if($action == 'movetosubproject'){	

			for($i=0;$i < sizeof($donation_info);$i++){
				$inusechangeto = "project2";
				if($donation_info[$i]['inuse']=='project2'){
					$inusechangeto = "permanent";
				}

				$pathupdatearr = array(
	               'inuse' => $inusechangeto,
	               'canmovemoney' => 'yes',
	            );

				$this->db->where('donationlog_id', $donation_info[$i]['donationlog_id']);
				$this->db->update('Donationlog', $pathupdatearr); 

			}

			$this->noti->keeplog("member","ตัดสินใจย้ายเงินไปโครงการสำรองเนื่องจากโครงการถูกบล็อค", $_SERVER['REQUEST_URI']);//keeplog


		}else{

			for($i=0;$i < sizeof($donation_info);$i++){
				$pathupdatearr = array(
				   'inuse' => $donation_info[$i]['inuse'],
	               'canmovemoney' => 'no',
	            );
				$this->db->where('donationlog_id', $donation_info[$i]['donationlog_id']);
				$this->db->update('Donationlog', $pathupdatearr); 
			}

			$this->noti->keeplog("member","ตัดสิใจรอการพิสูจน์โครงการเป็นเวลา 7 วัน เนื่องจากโครงการถูกบล็อค", $_SERVER['REQUEST_URI']);//keeplog


		}


		//----------send messagebox to donator------------
		$helpadmin_id = $this->db->select("*")->from("member")->where("MemberRole","Moderator")->limit(1)->get()->row_array();
							//check ever talk with creator: get refer
							$messagebox_info = $this->db->select("*")
											->from("MESSAGEBOX")
											->where("member_member_id",$helpadmin_id['member_id'])
											->or_where("sender_member_id",$helpadmin_id['member_id'])
											->where("member_member_id",$member_id)
											->or_where("sender_member_id",$member_id)
											->group_by("refer")->get()->result_array();
							

		$msg_detail = "เราได้บันทึกการตัดสินใจของท่านเเล้ว ขอบคุณที่ให้ความร่วมมือครับ";
		$this->db->query("insert into messagebox 
						values(null, '".$msg_detail."', now(), '"."tomember"."', '".$member_id."', '".$helpadmin_id['member_id']."', '".$messagebox_info[0]['refer']."')");
				
		//-----------------------------------------------
		

		redirect("messagebox");

	}


}
?>