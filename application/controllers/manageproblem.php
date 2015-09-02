<?php
class manageproblem extends CI_Controller{
	public function manageproblem(){
		parent::__construct();
	}

	public function index(){
		
		$this->noti->keeplog("admin","เข้ามาดูปัญหาโครงการและกิจกรรมประกาศทั้งหมด ", $_SERVER['REQUEST_URI']);//keeplog


		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/manageproblem/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('report');
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

		//pass m is creator_name
		//get reporter_name
		$data['reportdata'] = $this->db->select("*, (select reportm.member_name from member reportm where reportm.member_id = r.member_id) as reporter_name")->from("report r")->join("project p","r.project_id = p.project_id")->order_by("report_create", "desc")->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		$data['responsedata'] = $this->db->select("*")->from("response_report res")->join("report r","r.report_id = res.report_id")->order_by("response_create", "desc")->get()->result_array();

		//project data
		$criteriaproject_status = 'waitapprove'; 
		$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->get()->result_array();


		$this->load->view("backend/manageproblem/projectproblem.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function filterprojectproblem($report_id){
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/manageproblem/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('report');
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

		//pass m is creator_name
		//get reporter_name
		$data['reportdata'] = $this->db->select("*, (select reportm.member_name from member reportm where reportm.member_id = r.member_id) as reporter_name")->from("report r")->join("project p","r.project_id = p.project_id")->order_by("report_create", "desc")->limit($config['per_page'],end($this->uri->segments))->get()->result_array();
		$data['responsedata'] = $this->db->select("*")->from("response_report res")->join("report r","r.report_id = res.report_id")->order_by("response_create", "desc")->get()->result_array();

		//project data
		$criteriaproject_status = 'waitapprove'; 
		$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->where("project_status <>",$criteriaproject_status)
		->get()->result_array();


		$this->load->view("backend/manageproblem/projectproblem.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
	}

	public function generalproblem(){
	
		
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		
		$this->load->view("backend/manageproblem/generalproblem.php");
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function savereport(){

		$report_topic = $this->input->post("report_topic");
		$report_detail = $this->input->post("report_detail");
		$project_id = $this->input->post("project_id");
		$report_type = $this->input->post("report_type");
		$member_id = $this->input->post("member_id");

		//save to system
		$this->db->query("insert into report 
		values(null, '".$report_topic."', '".$report_detail."',NOW(), 'waitapprove', '".$report_type."', '".$project_id."', '".$member_id."')");
		

		//auto send to user
			//get report_id
			$report_info = $this->db->select("*")->from("report")
			->where("report_topic",$report_topic)
			->where("project_id",$project_id)
			->where("member_id",$member_id)
			->order_by("report_id","desc")->limit(1)->get()->row_array();

		$response_detail = "มีสมาชิกแจ้งมาหาโครงการท่านว่า<br>".$report_info['report_detail']."<br>หมายเหตุ: ข้อความต่อไปนี้ถูกส่งมาจากระบบอัตโนมัติ";

		$this->db->query("insert into response_report 
		values(null, '".$response_detail."', '".""."',NOW(), '".$report_info['report_type']."', 'yes', 'admin', '".$report_info['report_id']."')");
			


				//-----------noti of comment to sender--------------
				$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();
			
				$linkpath = "project/detailprojectfund/".$project_id;
				$detail = "ขอบคุณที่ร่วมเเจ้งปัญหาใน "."โครงการ".$project_info['project_name']." ทางทีมงานจะรีบตรวจสอบอย่างเร็วที่สุด";
				
				$this->noti->newNoti($detail, $linkpath, $member_id);
				//--------------------------------------------------


				//-----------noti of comment to creator--------------
				$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$project_id)->get()->row_array();
				
				if($project_info['project_status']!='success'){
					$linkpath = "profile/reportproject";
				}else{
					$linkpath = "profile/reportactivity";
				}
				$detail = "โครงการ".$project_info['project_name']."มีการโดนเเจ้งรายงานปํญหาเข้ามา";
				
				$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

				$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);
				//--------------------------------------------------

				//-----------------new admin noti-------------------
				
				$detail = $project_info['project_name']." มีการโดนเเจ้งรายงานปํญหาเข้ามา";
				$linkpath = "manageproblem/filterprojectproblem/".$report_info['report_id'];
				$admin_type = "admin_problem";

				$this->noti->newadminNoti($detail, $linkpath, $admin_type);
				//--------------------------------------------------


		$this->noti->keeplog("member","เเจ้งปัญหาโครงการ".$project_info['project_name']."ว่า ".$report_detail, $_SERVER['REQUEST_URI']);//keeplog


		redirect("project/detailprojectfund/".$project_id);


	}

	public function updatestatusreport(){

		$action = $this->input->post("action"); //success or waitapprove
		$report_id = $this->input->post("report_id");
		
		if($action == "success"){
			$this->db->set("report_status", "success");
			$this->db->where('report_id', $report_id);
			$this->db->update('report');

			$report_info = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
			$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$report_info['project_id'])->get()->row_array();
					

			$this->noti->keeplog("admin","ตรวจสอบปัญหาโครงการ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog

		}else if($action == "waitapprove"){
			$this->db->set("report_status", "waitapprove");
			$this->db->where('report_id', $report_id);
			$this->db->update('report');

			$this->noti->keeplog("admin","ยกเลิกการตรวจสอบปัญหาโครงการ".$project_info['project_name'], $_SERVER['REQUEST_URI']);//keeplog
			
		}

		$reportdata = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
		if($reportdata['report_status']=="success"){
			if($action == "block"){
				$this->db->set("block_status", "yes");
				$this->db->where('project_project_id', $reportdata['project_id']);
				$this->db->update('project_status');


					//-----------noti of comment to creator--------------
					$report_info = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
					$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$report_info['project_id'])->get()->row_array();
					
					if($project_info['project_status']!='success'){
						$linkpath = "profile/reportproject";
					}else{
						$linkpath = "profile/reportactivity";
					}
					$detail = "โครงการ".$project_info['project_name']."ของคุณถูกบล็อค กรุณาชี้เเจงข้อเท็จจริงภายใน 7 วัน";
					
					$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

					$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);

						//------------response to creator-------------
							$response_detail = "โครงการของคุณถูกบล็อคเนื่องจากคุณไม่สามารถชี้เเจงข้อกล่าวหาดังกล่าวได้";
							$this->db->query("insert into response_report 
							values(null, '".$response_detail."', '".""."',NOW(), '".$report_info['report_type']."', 'yes', 'admin', '".$report_info['report_id']."')");
							

							//------------count time block-------------
								$this->db->query("UPDATE project_status SET block_request='".$this->get_Datetime_Now(0)."', block_end='".$this->get_Datetime_Now(7)."' WHERE project_project_id=".$project_info['project_id'].";");
								//TODO: if currently = block end -> change block_status -> full block if block_status == full block admin cann't click unblock project
							//---------------------------------

							
							//------------send to messagebox of donater-------------
							$helpadmin_id = $this->db->select("*")->from("member")->where("MemberRole","Moderator")->limit(1)->get()->row_array();
							//get donator info
							$donator_info1 = $this->db->select("distinct(member_member_id)")->from("Donationlog d")->where("d.inuse","project1")->where("project_project_id",$project_info['project_id'])->get()->result_array();
							$donator_info2 = $this->db->select("distinct(member_member_id)")->from("Donationlog d")->where("d.inuse","project2")->where("project_id2",$project_info['project_id'])->get()->result_array();
							
							$donator_info = array_merge($donator_info1, $donator_info2);
							
							for($i=0;$i < sizeof($donator_info);$i++){
								//check ever talk with creator: get refer
								$messagebox_info = $this->db->select("*")
												->from("MESSAGEBOX")
												->where("member_member_id",$helpadmin_id['member_id'])
												->or_where("sender_member_id",$helpadmin_id['member_id'])
												->where("member_member_id",$donator_info[$i]['member_member_id'])
												->or_where("sender_member_id",$donator_info[$i]['member_member_id'])
												->group_by("refer")->get()->result_array();
								
								$textmove = "<a href=\"receivemoneyfund/movemoney/movetosubproject/".$donator_info[$i]['member_member_id']."/".$project_info['project_id']."\" >ย้ายเงินไปยังโครงการสำรองที่ท่านเลือกไว้</a>";
								$textwait = "<a href=\"receivemoneyfund/movemoney/waitproject/".$donator_info[$i]['member_member_id']."/".$project_info['project_id']."\" >รอเจ้าของโครงการพิสูจน์ตัวตนเป็นเวลา 7 วัน</a>";
								
								$msg_detail = "โครงการ".$project_info['project_name'].
											" ถูกบล็อกอันเนื่องมาจากไม่สามารถที่จะพิสูจน์ข้อเท็จจริงถึงการโดนรายงานปัญหาจากที่มีผู้เเจ้งไว้ได้".
											"เราจึงเเจ้งให้ท่านทราบเพื่อดำเนินการตัดสินใจเกี่ยวกับเงินของท่านที่ได้บริจาคให้แก่โครงการว่าจะทำอย่างไรต่อไป".
											"ระหว่างให้ทางเรา ".$textmove." กับ ".$textwait."";


								if(sizeof($messagebox_info)>0){
									//have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$donator_info[$i]['member_member_id']."', '".$helpadmin_id['member_id']."', '".$messagebox_info[0]['refer']."')");
					
								}else{
									//dont'have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$donator_info[$i]['member_member_id']."', '".$helpadmin_id['member_id']."', '')");
										
									$messagecurdata = $this->db->select("*")->from("messagebox")->where("msg_detail",$msg_detail)
									->where("member_member_id",$donator_info[$i]['member_member_id'])
									->or_where("sender_member_id",$donator_info[$i]['member_member_id'])
									->order_by("msg_create","desc")->limit(1)->get()->row_array(); 

									$this->db->set("refer", $messagecurdata['msg_id']);
									$this->db->where('msg_id', $messagecurdata['msg_id']);
									$this->db->update('messagebox');
									
								}
								
							}
							//---------------------------------
							

						//---------------------------------

					//--------------------------------------------------

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

				$this->noti->keeplog("admin","บล็อคโครงการ".$project_info['project_name']."และให้ระบบอัตโนมัติส่งรายงานผ่านกล่องข้อความไปหาเจ้าของโครงการ ผู้ติดตาม และผู็บริจาค", $_SERVER['REQUEST_URI']);//keeplog


			}else if($action == "unblock"){
				$this->db->set("block_status", "no");
				$this->db->where('project_project_id', $reportdata['project_id']);
				$this->db->update('project_status');


					//-----------noti of comment to creator--------------
					$report_info = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
					$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$report_info['project_id'])->get()->row_array();
					
					if($project_info['project_status']!='success'){
						$linkpath = "profile/reportproject";
					}else{
						$linkpath = "profile/reportactivity";
					}
					$detail = "โครงการ".$project_info['project_name']." ของคุณได้รับการปลดล็อคเเล้ว";
					
					$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

					$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);
					//---------------------------------



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

				$this->noti->keeplog("admin","ปลดบล็อคโครงการ".$project_info['project_name']."และให้ระบบอัตโนมัติส่งรายงานผ่านกล่องข้อความไปหาเจ้าของโครงการ และผู้ติดตาม", $_SERVER['REQUEST_URI']);//keeplog

			}
		}


		echo json_encode("ดำเนินรายการอัพเดทสถานะการเเจ้งปัญหาเรียบร้อย");
		
	}

	function get_Datetime_Now($datewantadd) {
	    $tz_object = new DateTimeZone('Asia/Bangkok');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    $datetime->modify('+'.$datewantadd.' day');

	    return $datetime->format('Y\-m\-d\ h:i:s');
	}

	public function adminresponse(){

		$report_id = $this->input->post("report_id");
		$response_detail = $this->input->post("response_detail");
		$report_type = $this->input->post("report_type");
		//echo $_FILES['response_filepath']['name'];

		//creator send
		if($this->input->post("project_id")!=''){
			//insert
			$this->db->query("insert into response_report 
			values(null, '".$response_detail."', '".""."',NOW(), '".$report_type."', 'yes', 'creator', '".$report_id."')");
		
				//-----------------new admin noti-------------------
				$report_info = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
				$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$report_info['project_id'])->get()->row_array();
				
				$detail = $project_info['project_name']." มีการยืนยันข้อเท็จจริงเข้ามา";
				$linkpath = "manageproblem/filterprojectproblem/".$report_info['report_id'];
				$admin_type = "admin_problem";

				$this->noti->newadminNoti($detail, $linkpath, $admin_type);
				//--------------------------------------------------

		}else{
			//Admin send
			$this->db->query("insert into response_report 
			values(null, '".$response_detail."', '".""."',NOW(), '".$report_type."', 'yes', 'admin', '".$report_id."')");
			


				//-----------noti of comment to creator--------------
				$report_info = $this->db->select("*")->from("report")->where("report_id",$report_id)->get()->row_array();
				$project_info = $this->db->select("*")->from("project p")->join("project_status s","p.project_id = s.project_project_id")->where("p.project_id",$report_info['project_id'])->get()->row_array();
				
				if($project_info['project_status']!='success'){
					$linkpath = "profile/reportproject";
				}else{
					$linkpath = "profile/reportactivity";
				}
				$detail = "โครงการ".$project_info['project_name']."มีการโดนเเจ้งรายงานปํญหาเข้ามา";
				
				$creator_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();

				$this->noti->newNoti($detail, $linkpath, $creator_info['member_id']);
				//--------------------------------------------------
		}


		$reponsedata = $this->db->select("response_report_id")->from("response_report res")->order_by("response_report_id","desc")->limit(1)->get()->row_array();


		//if have file to send
		if ($_FILES['response_filepath']['name']!=""){


			//upload report file and update into table
			$config['upload_path']= 'assets/backend/images/reportdoc';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "report-".$report_id."-".$reponsedata['response_report_id'];

			$this->upload->initialize($config);
			$this->upload->do_upload("response_filepath");
			$pathreport = $this->upload->file_name;

			//update path report
			$pathreportarr = array(
               'response_filepath' => $pathreport,
            );

			$this->db->where('response_report_id', $reponsedata['response_report_id']);
			$this->db->update('response_report', $pathreportarr); 


		}


		if($this->input->post("project_id")!=''){
			
			$this->noti->keeplog("member","ส่งรายงานชี้เเจงโครงการว่า ".$response_detail." ไปหาผู้ดูแลระบบ", $_SERVER['REQUEST_URI']);//keeplog

			if($this->input->post("actionmain")!=''){
				//go to font end in the part of
				redirect($this->input->post("actionmain"));
			}else{
				redirect("profile/reportactivity");
			}
		}else{
			$this->noti->keeplog("admin","ส่งรายงานชี้เเจงโครงการว่า ".$response_detail." ไปหาเจ้าของโครงการ", $_SERVER['REQUEST_URI']);//keeplog
			redirect("manageproblem");
		}
		

	}


}
?>