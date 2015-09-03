<?php

class project extends CI_Controller{

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

		//calculate time can use
		//calculate currently, percentage 
		$criteriaproject_status = array('approve','success','receivemoney'); 
		$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->order_by("project_end","asc")
								->order_by("project_end","asc")
								->get()->result_array();


		$this->load->view("fontend/project/overviewpage.php",$data);
		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function filterproject(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$project_type = $this->input->post("project_type");
		$project_group_projectgroup_id = $this->input->post("project_group_projectgroup_id");


		$project_typesession = $this->session->userdata('project_typesession');
		$project_group_projectgroup_ididsession = $this->session->userdata('project_group_projectgroup_ididsession');

		if(($project_typesession == "") || ($project_typesession != $project_type )){
			
			$ar = array(
					"project_typesession" => $project_type,
			);

			$this->session->set_userdata($ar);
		}

		if(($project_group_projectgroup_ididsession == "") || ($project_group_projectgroup_ididsession != $project_group_projectgroup_id )){
			
			$ar = array(
					"project_group_projectgroup_ididsession" => $project_group_projectgroup_id,
			);

			$this->session->set_userdata($ar);
		}



		$data['allproject'] = '';

		$criteriaproject_status = array('approve','success','receivemoney'); 
		if($project_type == 'all' && $project_group_projectgroup_id == 'all'){// all project

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->order_by("project_end","asc")
								->get()->result_array();


		}else if($project_type != 'all' && $project_group_projectgroup_id == 'all'){

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_type",$project_type)
								->order_by("project_end","asc")
								->get()->result_array();

		}
		else if($project_type == 'all' && $project_group_projectgroup_id != 'all'){

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_group_projectgroup_id",$project_group_projectgroup_id)
								->order_by("project_end","asc")
								->get()->result_array();

		}else{

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_type",$project_type)
								->where("p.project_group_projectgroup_id",$project_group_projectgroup_id)
								->order_by("project_end","asc")
								->get()->result_array();


		}

		$this->load->view("fontend/project/overviewpage.php",$data);
		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function detailprojectfund($project_id){

		$this->load->view("fontend/topandfooter/topheader.php");
		$member_id = 0;
		if($this->session->userdata('membersession') != ""){
			$member_id = $this->session->userdata['membersession']['member_id'];
		}
		


		$criteriaproject_status = array('approve','success','receivemoney');
		$data['detailproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen, (SELECT COUNT(DISTINCT member_member_id) FROM Donationlog where project_project_id = ".$project_id.") as peopledonate")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status","no")->where("project_id",$project_id)->get()->result_array();
		
		//follow
		$data['followprojectdata'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse")
		->from("project_follow f")
		->join("project p","f.project_project_id = p.project_id")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->where("f.follow_type","project")
		->where("f.project_project_id",$project_id)
		->where("f.member_member_id",$member_id)
		->get()->result_array();

		//haijai
		$data['haijaiprojectdata'] = $this->db->select("*")->from("like l")->join("project p","l.project_project_id = p.project_id")->join("member m","l.member_member_id = m.member_id")->where("p.project_id",$project_id)->where("m.member_id",$member_id)->get()->result_array();


		$data['updateprojectdata'] = $this->db->select("*")->from("project p")->join("updateproject u","p.project_id = u.project_project_id")->join("member m","p.member_member_id = m.member_id")->where("project_id",$project_id)->get()->result_array();
		//comment
		$data['commentprojectdata'] = $this->db->select("*")->from("project_comment c")->join("member m","m.member_id = c.member_member_id")->join("project p","c.project_project_id = p.project_id")->where("project_project_id",$project_id)->order_by("comment_create","desc")->get()->result_array();
		$data['member_logindata'] = $this->db->select("*")->from("member")->where("member_id",$member_id)->get()->row_array();
		
		$data['checkStaff'] = $this->db->select("*")->from("memrefproject")->where("project_id",$project_id)->where("status","ยินยอมเป็นสต๊าฟ")->get()->result_array();


		$this->load->view("fontend/project/detailprojectfund.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function newcomment(){

		$action = $this->input->post("action");
		$replyTo_projectcomment_id = $this->input->post("replyTo_projectcomment_id");
		
		$member_member_id = $this->input->post("member_member_id");
		$project_project_id = $this->input->post("project_project_id");

		$comment_detail = $this->input->post("comment_detail");

		if($action == 'sub'){

			//insert
			$this->db->query("insert into project_comment 
			values(null, '".$comment_detail."', "."now()".", '".$replyTo_projectcomment_id."', '".$member_member_id."','','".$project_project_id."')");


			//get group comment and loop for send to them notification except sender
			$comment_info = $this->db->select("distinct(member_member_id)")->from("project_comment")
			->where("replyTo_projectcomment_id",$replyTo_projectcomment_id)
			->where("member_member_id <>",$member_member_id)->get()->result_array();
			
			for($i=0;$i<sizeof($comment_info);$i++) {
				$commentor_id = $comment_info[$i]['member_member_id'];
				//------------------noti of comment-----------------
				$member_name = $this->db->select("*")->from("member")->where("member_id",$member_member_id)->get()->row_array();
				$project_info = $this->db->select("*")->from("project")->where("project_id",$project_project_id)->get()->row_array();
			
				$linkpath = "project/detailprojectfund/".$project_project_id;
				$detail = $member_name['member_name']." แสดงความคิดเห็นต่อจากคุณใน"."โครงการ".$project_info['project_name'];
				
				$this->noti->newNoti($detail, $linkpath, $commentor_id);
				//--------------------------------------------------

			}

		}else{ //new comment
			//insert
			$this->db->query("insert into project_comment 
			values(null, '".$comment_detail."', "."now()".", '', '".$member_member_id."','','".$project_project_id."')");
			

			//------------------noti of creator-----------------
			$member_name = $this->db->select("*")->from("member")->where("member_id",$member_member_id)->get()->row_array();
			$project_info = $this->db->select("*")->from("project")->where("project_id",$project_project_id)->get()->row_array();
			$creator_id = $project_info['member_member_id'];

			$linkpath = "project/detailprojectfund/".$project_project_id;
			$detail = $member_name['member_name']." แสดงความคิดเห็นใน"."โครงการ".$project_info['project_name'];
			
			$this->noti->newNoti($detail, $linkpath, $creator_id);
			//--------------------------------------------------
		}
		

		echo json_encode("");



	}
	//like
	public function likeproject(){

		$project_id = $this->input->post("project_id");
		$action = $this->input->post("action");

		$member_id = 0;
		if($this->session->userdata('membersession') != ""){
			$member_id = $this->session->userdata['membersession']['member_id'];
		}

		if($action == 'like'){
			//insert session member like
			$this->db->query("insert into `like`(`like_id`, `member_member_id`, `project_project_id`) values(null, '".$member_id."', '".$project_id."')");

		}else{ //unlike
			$this->db->delete('like', array('project_project_id' => $project_id, 'member_member_id' => $member_id)); 
		}

		echo json_encode($action);


	}

	public function followproject(){

		$project_id = $this->input->post("project_id");
		$action = $this->input->post("action");

		$member_id = 0;
		if($this->session->userdata('membersession') != ""){
			$member_id = $this->session->userdata['membersession']['member_id'];
		}

		if($action == 'follow'){

			//insert
			$this->db->query("insert into project_follow 
			values(null, '".$project_id."', '".$member_id."', '', 'project')");

		}else{ //unfollow

			$this->db->delete('project_follow', array('project_project_id' => $project_id, 'member_member_id' => $member_id)); 

		}

		echo json_encode("");


	}


	public function checkout($project_id,$channel){

		$this->load->view("fontend/topandfooter/topheader.php");

		$criteriaproject_status = array('approve','success','receivemoney'); 
		$data['detailproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen, (SELECT COUNT(DISTINCT member_member_id) FROM Donationlog where project_project_id = ".$project_id.") as peopledonate")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status","no")->where("project_id",$project_id)->get()->result_array();
		$data['project_group'] = $this->db->select("*")->from("project_group")->get()->result_array();
		$data['project_2'] = $this->db->select("*")->from("project")->where("project_id <>",$project_id)->get()->result_array();
		$data['permanent'] = $this->db->select("*")->from("Permanent_foundation")->get()->result_array();

		$data['channel'] = $channel;

		$this->load->view("fontend/project/checkout.php",$data);
		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function confirm(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$channel =  $this->input->post("donation_channel");
		$money =  $this->input->post("money");
		$project_id =  $this->input->post("project_id");
		$member_id =  $this->input->post("member_id");
		$perma_id =  $this->input->post("perma");
		$project_id2 =  $this->input->post("project_id2");
		//insert to donation log
		$this->db->query("insert into Donationlog 
		values(null, '".$channel."', NOW(),NOW()+INTERVAL 7 DAY, 'waitapprove', '', '".$money."', 'project1', '".$project_id2."', '".$project_id."', '".$member_id."','".$perma_id."','')");
		

		//get log of donation that member fundrasing
		$donationlogarr = $this->db->select("*")->from("Donationlog d")->where("donation_channel",$channel)->where("project_project_id",$project_id)->where("member_member_id",$member_id)->order_by("donation_create", "desc")->limit(1)->get()->result_array();
		//paysbuy case save: paysbuy will go to redirect page for payment in gw
		if ($channel != "bank"){

			$data['logdata'] = $donationlogarr;

			$this->load->view("fontend/project/redirectpaysbuypage.php",$data);
		}else{

			//-----------------new noti-------------------------
			$detail = "ขอบคุณที่ร่วมบริจาคกับเรา หมายเลขธุรกรรม BA".$donationlogarr[0]['donationlog_id'];
			$linkpath = "tracking";
			$member_id = $member_id;

			$this->noti->newNoti($detail, $linkpath, $member_id);
			//--------------------------------------------------

			//-----------------new admin noti-------------------
			$detail = "รายการธุรกรรมใหม่เข้ามา BA".$donationlogarr[0]['donationlog_id'];
			$linkpath = "dash/filterdash/".$donationlogarr[0]['donationlog_id'];
			$admin_type = "admin_donator";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


			$data['donationlog_id'] = "BA".$donationlogarr[0]['donationlog_id'];
			$data['donation_channel'] = $channel;
			$this->load->view("fontend/project/thankyou.php",$data);
			$this->load->view("fontend/topandfooter/bottomfooter.php");
		}
	


	}

	//receive and update log of paysbuy
	public function checkpaysbuy(){

		$result = $this->input->post("result");
		$apCode = $this->input->post("apCode"); 
		$amt = $this->input->post("amt");
		$amt = $amt*1;

		$result_code    =    substr($result,0,2);
		$invoice    =    substr($result,2,strlen($result));
		

		if ($result_code ==01) {
		    echo "เงินไม่พอซื้อไม่ได้";
		}elseif($result_code ==99){
		    echo "ซื้อไม่ได้ไม่ทราบสาเหตุ";
		}elseif($result_code ==00){
		    //echo "ซื้อสินค้าเรียบร้อยแล้ว";
		    //echo "Invoice ".$invoice."<br>";
		    //echo $amt." บาท";

		    $donationID = "";
			$memberID = "";
			$found = 0;
			
			//getvalue
			for($i=0;$i<strlen($invoice);$i++){

				if($invoice{$i}=="_"){
					$found = 1;
				}
				else if($invoice{$i}!="_" && $found ==0){
					$donationID .= $invoice{$i}; 
				}
				else{
					$memberID .= $invoice{$i}; 
				}

			}
			//echo "memberID: ".$memberID;
			//echo "projectID: ".$projectID;
			//echo "logID: ".$logID;
			//$this->db->query("insert into donationlog values (null, '$paychannel', CURRENT_TIMESTAMP, (CURRENT_TIMESTAMP+INTERVAL 7 DAY), 'waiting', '', $money, $projectID, $memberID);");
			$this->db->query("update Donationlog set donation_status = 'success', donation_success = CURRENT_TIMESTAMP where member_member_id = $memberID and donationlog_id = $donationID;");



			//-----------------new noti-------------------------
			$detail = "ขอบคุณที่ร่วมบริจาคกับเรา หมายเลขธุรกรรม PA".$donationID;
			$linkpath = "tracking";
			$member_id = $memberID;

			$this->noti->newNoti($detail, $linkpath, $member_id);
			//--------------------------------------------------


			//-----------------new admin noti-------------------
			$detail = "รายการธุรกรรมใหม่เข้ามา PA".$donationID;
			$linkpath = "dash/filterdash/".$donationID;
			$admin_type = "admin_donator";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


			//load view thank you
			$this->load->view("fontend/topandfooter/topheader.php");
			$data['donationlog_id'] = "PA".$donationID;
			$data['donation_channel'] = "paysbuy";
			$this->load->view("fontend/project/thankyou.php",$data);
			$this->load->view("fontend/topandfooter/bottomfooter.php");
		    
		   	

		}

	}

	public function createproject(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$member_id = $this->session->userdata['membersession']['member_id'];


		$data['member_logindata'] = $this->db->select("*")->from("member")->where("member_id",$member_id)->get()->row_array();

		$this->load->view("fontend/project/createproject.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function createprojectprocess(){

		//--project--
		//project_id -> null
		$project_name = $this->input->post("project_name"); //
		$project_type = $this->input->post("project_type"); //
		//money_raising -> 0
		//project_view -> 0
		//img_previewpath -> profile (file) //
		$project_group_projectgroup_id = $this->input->post("project_group_projectgroup_id"); //
		$member_member_id = 0;
		if($this->session->userdata('membersession') != ""){
			$member_member_id = $this->session->userdata['membersession']['member_id'];
		}


		//project_account_id -> ''
		//project_account_name -> ''
		//project_account_bank -> ''
		//receive_money_evidence -> ''

		if($project_type =="ระดมทุน"){
			//insert
			$this->db->query("insert into project 
			values(null,'".$project_name."','".$project_type."', 0, 0,'', ".$project_group_projectgroup_id.",".$member_member_id.",'','','','')");
		}else{
			//insert
			$this->db->query("insert into project 
			values(null,'".$project_name."','".$project_type."', 0, 0,'', ".$project_group_projectgroup_id.",".$member_member_id.",'-','-','-','-')");
		
		}
		$projectdata = $this->db->select("*")->from("project")->order_by("project_id","desc")->where("project_name",$project_name)->limit(1)->get()->row_array();



		//--project_status--
		//projectstatus_id -> null
		//block_status -> 'no'
		//project_request -> now()
		//project_approved -> null
			$timewantdisplay = $this->input->post("timewantdisplay"); //plus now() and save to project_end
		//project_end -> now()+$timewantdisplay
		//project_status -> 'waitapprove'
		//$project_project_id = $projectdata['project_id'];

		//insert
		$this->db->query("insert into project_status 
		values(null,'no',null,null, NOW(), null, NOW()+INTERVAL ".$timewantdisplay." DAY, 'waitapprove', ".$projectdata['project_id'].")");



		//--project_detail--
		//projectdetail_id -> null
		$project_preview = $this->input->post("project_preview"); //
		$project_object = $this->input->post("project_object"); //
		$project_deepdetail = $this->input->post("project_deepdetail"); //
		$subdisdrict = $this->input->post("subdisdrict"); //
		$district = $this->input->post("district"); //
		$country = $this->input->post("country"); //
		$province = $this->input->post("province"); //
		$project_target = $this->input->post("project_target"); //


		$project_realstart_fund = $this->input->post("project_realstart_fund");// -> array should edit
		$project_realstart_donate = $this->input->post("project_realstart_donate");// -> array should edit
		//echo "fund:".$project_realstart_fund.", donate:".$project_realstart_donate;

		$money_expect = $this->input->post("money_expect"); //
		$item_expect = $this->input->post("item_expect"); //case of donation //
		//img_detailpath -> header (file) //
		$video_detailpath = $this->input->post("video_detailpath");
		//project_pdfpath -> pdf file  //
		//$project_project_id = $projectdata['project_id'];
		
		if($project_type =="ระดมทุน"){
			//insert
			$this->db->query("insert into project_detail 
			values(null,'".$project_preview."','".$project_object."',
				'".$project_deepdetail."','".$subdisdrict."','".$district."',
				'".$country."','".$province."','".$project_target."',
				'".$project_realstart_fund."',".$money_expect.",'','','".$video_detailpath."','',".$projectdata['project_id'].")");
		}else{
			//insert
			$this->db->query("insert into project_detail 
			values(null,'".$project_preview."','".$project_object."',
				'".$project_deepdetail."','".$subdisdrict."','".$district."',
				'".$country."','".$province."','".$project_target."',
				'".$project_realstart_donate."','','".$item_expect."','','".$video_detailpath."','',".$projectdata['project_id'].")");
		}


		//upload image of project
			//upload img_previewpath profile file and update into table
			$config['upload_path'] = 'assets/img/project/profile';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "img_previewpath-".$projectdata['project_id'];

			$this->upload->initialize($config);
			$this->upload->do_upload("img_previewpath");
			$pathupdate = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_previewpath' => $pathupdate,
            );

			$this->db->where('project_id', $projectdata['project_id']);
			$this->db->update('project', $pathupdatearr); 




			//upload img_detailpath profile file and update into table
			$config2['upload_path'] = 'assets/img/project/header';
			$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config2['max_size'] = 100000;
			$config2['file_name'] = "img_detailpath-".$projectdata['project_id'];

			$this->upload->initialize($config2);
			$this->upload->do_upload("img_detailpath");
			$pathupdate2 = $this->upload->file_name;


			//upload project_pdfpath profile file and update into table
			$config3['upload_path'] = 'assets/img/project/documentproject';
			$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config3['max_size'] = 100000;
			$config3['file_name'] = "project_pdfpath-".$projectdata['project_id'];

			$this->upload->initialize($config3);
			$this->upload->do_upload("project_pdfpath");
			$pathupdate3 = $this->upload->file_name;

			//update path update
			$pathupdatearr2 = array(
               'img_detailpath' => $pathupdate2,
               'project_pdfpath' => $pathupdate3,
            );

			$this->db->where('project_project_id', $projectdata['project_id']);
			$this->db->update('project_detail', $pathupdatearr2); 
		


		//-----------noti of comment to creator--------------
		$linkpath = "profile/updateproject";
		$detail = "เราได้รับคำร้องขอการสร้างโครงการ".$project_name." ของคุณเเล้วกรุณารอการตรวจสอบประมาณ 7 วัน";
				
		$this->noti->newNoti($detail, $linkpath, $member_member_id);
		//-----------------------------------


			//-----------------new admin noti-------------------
			$detail = $this->session->userdata['membersession']['member_name']." ส่งคำร้องขอสร้างโครงการใหม่เข้ามา";
			$linkpath = "manageproject/filterproject/".$projectdata['project_id'];
			$admin_type = "admin_project";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


		//echo $_FILES['project_pdfpath']['name'];
		redirect("main");

	}


	public function checkRequestfund(){
		$project_id = $this->input->post("project_id");

		$project_found = $this->db->select("*")->from("project")->where("project_id",$project_id)->where("project_account_id <>","")->get()->row_array(); //get last product ID


		echo json_encode($project_found);

	}

	public function checkSendRequestActivity(){

		$project_id = $this->input->post("project_id");

		$activity_info = $this->db->select("*")->from("activity a")->where("a.project_id",$project_id)->get()->result_array();

		echo json_encode($activity_info);

	}

	public function requestfund(){
		$project_id = $this->input->post("project_id");
		$project_account_id = $this->input->post("project_account_id");
		$project_account_name = $this->input->post("project_account_name");
		$project_account_bank = $this->input->post("project_account_bank");
		
		$this->db->set("project_account_id", $project_account_id);
		$this->db->set("project_account_name", $project_account_name);
		$this->db->set("project_account_bank", $project_account_bank);

		$this->db->where('project_id', $project_id);
		$this->db->update('project');


			//-----------------new admin noti-------------------
			$project_info = $this->db->select("*")->from("project p")->where("p.project_id",$project_id)->get()->row_array();

			$detail = $project_info['project_name']." ส่งคำร้องขอร้องขอรับเงินเข้ามา";
			$linkpath = "receivemoneyfund/filterreceivemoney/".$project_id;
			$admin_type = "admin_receivemoney";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


			//-----------noti of comment to creator--------------
			$linkpath = "profile/successactivity";
			$detail = "เราได้รับคำร้องขอรับเงินของคุณเเล้วกรุณารอการตรวจสอบประมาณ 7 วัน";
					
			$this->noti->newNoti($detail, $linkpath, $project_info['member_member_id']);
			//-----------------------------------


		redirect("profile/successactivity");

	}

	public function getReportSuccessProjectdata(){
		$project_id = $this->input->post("project_id");

		$responsedata = $this->db->select("*")->from("report r")->join("response_report res","r.report_id = res.report_id")->order_by("response_create", "desc")->where("project_id",$project_id)->get()->result_array();



		echo json_encode($responsedata);
	}

	public function getReportProjectdata(){
		$project_id = $this->input->post("project_id");

		$responsedata = $this->db->select("*")->from("report r")->join("response_report res","r.report_id = res.report_id")->order_by("response_create", "desc")->where("project_id",$project_id)->get()->result_array();


		echo json_encode($responsedata);


	}


	public function getDonationProjectdata(){

		$project_id = $this->input->post("project_id");

		$donationdata = $this->db->select("*, (select psub.project_name from project psub where psub.project_id = d.project_id2) as project_second, (select permanent_account_name from Permanent_foundation perma where perma.permanent_id = d.permanent_foundation_permanent_id) as project_perma")->from("Donationlog d")->join("project p","p.project_id = d.project_project_id")->join("Permanent_foundation perma","d.permanent_foundation_permanent_id = perma.permanent_id")->join("member m","d.member_member_id = m.member_id")->where("p.project_id",$project_id)->where("donation_status","success")->order_by("donation_create", "desc")->get()->result_array();


		echo json_encode($donationdata);

	}


	public function updateproject(){

		$project_id = $this->input->post("project_id");
		$detail = $this->input->post("detail");
		
		//insert
		$this->db->query("insert into updateproject 
		values(null, '".$detail."', '".""."',NOW(), '".$project_id."')");
		
		$updateprojectdata = $this->db->select("*")->from("updateproject u")->order_by("updateproject_id","desc")->limit(1)->get()->row_array();


		//if have file to send
		if ($_FILES['img_detailpath']['name']!=""){


			//upload report file and update into table
			$config['upload_path']= 'assets/img/project/updateproject';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "update-".$project_id."-".$updateprojectdata['updateproject_id'];

			$this->upload->initialize($config);
			$this->upload->do_upload("img_detailpath");
			$pathupdate = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_detailpath' => $pathupdate,
            );

			$this->db->where('updateproject_id', $updateprojectdata['updateproject_id']);
			$this->db->update('updateproject', $pathupdatearr); 


		}
		
		//-----------noti of update to creator--------------
		$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();
		$linkpath = "project/detailprojectfund/".$project_id."";
		$detail = "อัพเดทข้อมูลโครงการ".$project_info['project_name']." เรียบร้อยเเล้ว";
				
		$this->noti->newNoti($detail, $linkpath, $project_info['member_member_id']);
		//-----------------------------------


		//-----------noti of update to follow--------------
		$linkpath = "project/detailprojectfund/".$project_id."";
		$detail = "โครงการ".$project_info['project_name']." มีการอัพเดทข้อมูลโครงการ";
		
		$project_follow_info = $this->db->select("*")->from("project_follow")
						->where("follow_type","project")
						->where("project_project_id",$project_id)
						->where("member_member_id <>",$project_info['member_member_id'])
						->get()->result_array();

		//echo sizeof($project_follow_info);
		foreach ($project_follow_info as $key => $value) {
			$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
		}
		//-----------------------------------

		//-----------noti of update follow member--------------
		$member_info = $this->db->select("*")->from("member")->where("member_id",$project_info['member_member_id'])->get()->row_array();
		
		$linkpath = "project/detailprojectfund/".$project_id."";
		$detail = $member_info['member_name']."ได้อัพเดทข้อมูลในโครงการ".$project_info['project_name']."";
		
		$member_follow_info = $this->db->select("*")->from("project_follow")
						->where("follow_type","member")
						->where("member_memberfollow_id",$member_info['member_id'])
						->where("member_member_id <>",$project_info['member_member_id'])
						->get()->result_array();

		foreach ($member_follow_info as $key => $value) {
			$this->noti->newNoti($detail, $linkpath, $value['member_member_id']);
		}
		//-----------------------------------


		redirect("profile/updateproject");

	

	}

	public function searchbystaffbox(){

		$searchstaffboxvalue = $this->input->post("searchstaffboxvalue");


		$result = $this->db->select("*")
				->from('member')
				->like('member_name', $searchstaffboxvalue)
				->get()->result_array();

		echo json_encode($result);

	}

	public function selectStaff(){

		$member_id = $this->input->post("member_id");
		$project_id = $this->input->post("project_id");



		$check_memberref_info = $this->db->select("*")
								->from("memrefproject")
								->where("member_id",$member_id)
								->where("project_id",$project_id)
								->get()
								->row_array();

		$result = "";

		if(count($check_memberref_info) == 0){ //mean don't have

			if($member_id == $this->session->userdata['membersession']['member_id']){
				$result = "ไม่สามารถเพิ่มเจ้าของโครงการเป็นสต๊าฟได้";
			}else{
				$this->db->query("insert into memrefproject 
				values(null, '".$member_id."', '".$project_id."','รอการตอบรับ')");

				$result = "อัพเดทข้อมูลสต๊าฟโครงการเรียบร้อย";


						//to messagebox
						//------------send to messagebox of donater-------------
								$sender = $this->session->userdata['membersession']['member_id'];
							
								//check ever talk with creator: get refer
								$messagebox_info = $this->db->select("*")
												->from("MESSAGEBOX")
												->where("member_member_id",$sender)
												->or_where("sender_member_id",$sender)
												->where("member_member_id",$member_id)
												->or_where("sender_member_id",$member_id)
												->group_by("refer")->get()->result_array();
								
								$textmove = "<a href=\"project/approveStaffRequest/accept/".$member_id."/".$project_id."\" >ยอมรับการเป็นสต๊าฟ</a>";
								$textwait = "<a href=\"project/approveStaffRequest/nonaccept/".$member_id."/".$project_id."\" >ปฏิเสธการเป็นสต๊าฟ</a>";
								
								$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();

								$msg_detail = "เราต้องการเชิญคุณมาเป็นสต๊าฟในโครงการ".$project_info['project_name'].
											"เราจึงเเจ้งให้ท่านทราบเพื่อสอบถามถึงความยินยอมในการเข้ามาเป็นส่วนหนึ่งกับโครงการเรา ".$textmove." กับ ".$textwait."";
								

								if(sizeof($messagebox_info)>0){
									//have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$member_id."', '".$sender."', '".$messagebox_info[0]['refer']."')");
					
								}else{
									//dont'have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$member_id."', '".$sender."', '')");
										
									$messagecurdata = $this->db->select("*")->from("messagebox")->where("msg_detail",$msg_detail)
									->where("member_member_id",$member_id)
									->or_where("sender_member_id",$member_id)
									->order_by("msg_create","desc")->limit(1)->get()->row_array(); 

									$this->db->set("refer", $messagecurdata['msg_id']);
									$this->db->where('msg_id', $messagecurdata['msg_id']);
									$this->db->update('messagebox');
									
								}
								
							
						//---------------------------------
			}

		}else{


			$result = "สมาชิกเป็นสตา๊าฟในโครงการนี้อยู่เเล้ว";

		}

		echo json_encode($result);


	}

	public function approveStaffRequest($action, $member_id, $project_id){


		$data = array(
               'status' => ($action == 'accept'?'ยินยอมเป็นสต๊าฟ':'ปฏิเสธการเป็นสต๊าฟ'),
        );

		$this->db->where('project_id', $project_id);
		$this->db->where('member_id', $member_id);
		$this->db->update('memrefproject', $data); 

					if($action == 'accept'){
						
						//to messagebox
						//------------send to messagebox of donater-------------
								$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();

								$sender = $project_info['member_member_id'];
							
								//check ever talk with creator: get refer
								$messagebox_info = $this->db->select("*")
												->from("MESSAGEBOX")
												->where("member_member_id",$sender)
												->or_where("sender_member_id",$sender)
												->where("member_member_id",$member_id)
												->or_where("sender_member_id",$member_id)
												->group_by("refer")->get()->result_array();
								
								$projectlink = "<a href=\"project/detailprojectfund/".$project_info['project_id']."\" >".$project_info['project_name']."</a>";
								
								$msg_detail = "ขอบคุณที่ร่วมมาเป็นส่วนหนึ่งกับโครงการ".$project_info['project_name'].
											"ครับ คุณสามารถเข้าไปดูโครงการได้ที่ ".$projectlink."";
								

								if(sizeof($messagebox_info)>0){
									//have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$member_id."', '".$sender."', '".$messagebox_info[0]['refer']."')");
					
								}else{
									//dont'have talk in history
									$this->db->query("insert into messagebox 
									values(null, '".$msg_detail."', now(), '"."tomember"."', '".$member_id."', '".$sender."', '')");
										
									$messagecurdata = $this->db->select("*")->from("messagebox")->where("msg_detail",$msg_detail)
									->where("member_member_id",$member_id)
									->or_where("sender_member_id",$member_id)
									->order_by("msg_create","desc")->limit(1)->get()->row_array(); 

									$this->db->set("refer", $messagecurdata['msg_id']);
									$this->db->where('msg_id', $messagecurdata['msg_id']);
									$this->db->update('messagebox');
									
								}
								
							
						//---------------------------------
					}



		redirect("messagebox");

	}

	public function getStaffinProjectInfo(){

		$project_id = $this->input->post("project_id");

		
		$memberrefInfo = $this->db->select("*")
						->from("memrefproject ref")
						->join("member m","ref.member_id = m.member_id")
						->where("project_id",$project_id)
						->order_by("status","desc")
						->get()->result_array();

	
		echo json_encode($memberrefInfo);

	}

	public function deleteStaffinProjectInfo(){

		$project_id = $this->input->post("project_id");
		$member_id = $this->input->post("member_id");


		$this->db->delete('memrefproject', array('member_id' => $member_id, 'project_id' => $project_id)); 
	
		echo json_encode("ดำเนินการอัพเดทเรียบร้อย");


	}



	public function overviewactivity(){
		$this->load->view("fontend/topandfooter/topheader.php");

		//calculate time can use
		//calculate currently, percentage 
		$criteriaproject_status = array('success','receivemoney'); 
		$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
		->from("project p")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->join("activity a","a.project_id = p.project_id")
		->where_in("project_status",$criteriaproject_status)
		->where("block_status","no")
		->get()->result_array();


		$this->load->view("fontend/project/overviewactivity.php",$data);
		$this->load->view("fontend/topandfooter/bottomfooter.php");
	}

	public function detailactivity($project_id){

		$this->load->view("fontend/topandfooter/topheader.php");
		$member_id = 0;
		if($this->session->userdata('membersession') != ""){
			$member_id = $this->session->userdata['membersession']['member_id'];
		}
		


		$criteriaproject_status = array('success','receivemoney');
		$data['detailproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen, (SELECT COUNT(DISTINCT member_member_id) FROM Donationlog where project_project_id = ".$project_id.") as peopledonate, a.img_detailpath as activityheaderpath, a.video_detailpath as activityvideo")
		->from("project p")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
		->join("member m","p.member_member_id = m.member_id")
		->join("activity a","a.project_id = p.project_id")
		->where_in("project_status",$criteriaproject_status)
		->where("block_status","no")
		->where("a.project_id",$project_id)
		->order_by("activity_approved","asc")
		->get()->result_array();

		
		//follow
		$data['followprojectdata'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse")
		->from("project_follow f")
		->join("project p","f.project_project_id = p.project_id")
		->join("project_detail d","p.project_id = d.project_project_id")
		->join("project_status s","p.project_id = s.project_project_id")
		->where("f.follow_type","project")
		->where("f.project_project_id",$project_id)
		->where("f.member_member_id",$member_id)
		->get()->result_array();

		//haijai
		$data['haijaiprojectdata'] = $this->db->select("*")
									->from("like l")
									->join("project p","l.project_project_id = p.project_id")
									->join("member m","l.member_member_id = m.member_id")
									->where("p.project_id",$project_id)
									->where("m.member_id",$member_id)
									->get()->result_array();


		$data['updateprojectdata'] = $this->db->select("*")->from("project p")->join("updateproject u","p.project_id = u.project_project_id")->join("member m","p.member_member_id = m.member_id")->where("project_id",$project_id)->get()->result_array();
		//comment
		$data['commentprojectdata'] = $this->db->select("*")->from("project_comment c")->join("member m","m.member_id = c.member_member_id")->join("project p","c.project_project_id = p.project_id")->where("project_project_id",$project_id)->order_by("comment_create","desc")->get()->result_array();
		$data['member_logindata'] = $this->db->select("*")->from("member")->where("member_id",$member_id)->get()->row_array();

		$data['checkStaff'] = $this->db->select("*")->from("memrefproject")->where("project_id",$project_id)->where("status","ยินยอมเป็นสต๊าฟ")->get()->result_array();

		$this->load->view("fontend/project/detailactivityfund.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function filteractivity(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$project_type = $this->input->post("project_type");
		$project_group_projectgroup_id = $this->input->post("project_group_projectgroup_id");


		$activity_typesession = $this->session->userdata('activity_typesession');
		$activity_project_group_projectgroup_ididsession = $this->session->userdata('activity_project_group_projectgroup_ididsession');

		if(($activity_typesession == "") || ($activity_typesession != $project_type )){
			
			$ar = array(
					"activity_typesession" => $project_type,
			);

			$this->session->set_userdata($ar);
		}

		if(($activity_project_group_projectgroup_ididsession == "") || ($activity_project_group_projectgroup_ididsession != $project_group_projectgroup_id )){
			
			$ar = array(
					"activity_project_group_projectgroup_ididsession" => $project_group_projectgroup_id,
			);

			$this->session->set_userdata($ar);
		}



		$data['allproject'] = '';

		$criteriaproject_status = array('success','receivemoney');

		if($project_type == 'all' && $project_group_projectgroup_id == 'all'){// all project
			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->join("activity a","a.project_id = p.project_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->get()->result_array();


		}else if($project_type != 'all' && $project_group_projectgroup_id == 'all'){

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->join("activity a","a.project_id = p.project_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_type",$project_type)
								->get()->result_array();

		}
		else if($project_type == 'all' && $project_group_projectgroup_id != 'all'){

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->join("activity a","a.project_id = p.project_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_group_projectgroup_id",$project_group_projectgroup_id)
								->get()->result_array();


		}else{

			$data['allproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")
								->from("project p")
								->join("project_detail d","p.project_id = d.project_project_id")
								->join("project_status s","p.project_id = s.project_project_id")
								->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")
								->join("member m","p.member_member_id = m.member_id")
								->join("activity a","a.project_id = p.project_id")
								->where_in("project_status",$criteriaproject_status)
								->where("block_status","no")
								->where("p.project_type",$project_type)
								->where("p.project_group_projectgroup_id",$project_group_projectgroup_id)
								->get()->result_array();

		}

		$this->load->view("fontend/project/overviewactivity.php",$data);
		$this->load->view("fontend/topandfooter/bottomfooter.php");



	}

	public function postFB($project_id, $project_action){

		$project_info = $this->db->select("*")->from("project")->where("project_id",$project_id)->get()->row_array();

		$pathShare = 'http://localhost/haijai/project/detailprojectfund/'.$project_id;
		$messageDetail = "ฉันอยากจะเชิญชวนทุกคนมาร่วมให้ใจให้โอกาสกับ\n โครงการ".$project_info['project_name']." ร่วมกัน \nดูรายละเอียดได้ที่: ".$pathShare;
		if($project_action == 'activity'){
			$pathShare = 'http://localhost/haijai/project/detailactivity/'.$project_id;
			$messageDetail = "อีกหนึ่งความสำเร็จของการแบ่งปัน โครงการ".$project_info['project_name']."\nดูรายละเอียดได้ที่: ".$pathShare;
		}



		
			  // Remember to copy files from the SDK's src/ directory to a
				  // directory in your application on the server, such as php-sdk/
				  //require_once('assests/facebook-php-sdk/src/facebook.php');

				  $config = array(
				    'appId' => '878498028884904',
				    'secret' => 'd90e3135b2566f7ace704f6725ccaaa9',
				    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
				  );

				  $facebook = new Facebook($config);
				  $user_id = $facebook->getUser();
				    if($user_id) {

				      // We have a user ID, so probably a logged in user.
				      // If not, we'll get an exception, which we handle below.
				      try {
				        $ret_obj = $facebook->api('/me/feed', 'POST',
				                                    array(
				                                      'link' => $pathShare,
				                                      'message' => $messageDetail,
				                                 ));
				        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';

				        // Give the user a logout link 
				        echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
				      } catch(FacebookApiException $e) {
				        // If the user is logged out, you can have a 
				        // user ID even though the access token is invalid.
				        // In this case, we'll get an exception, so we'll
				        // just ask the user to login again here.
				        $login_url = $facebook->getLoginUrl( array(
				                       'scope' => 'publish_actions'
				                       )); 
				        echo 'Please <a href="' . $login_url . '">login.</a>';
				        error_log($e->getType());
				        error_log($e->getMessage());
				      }   
				    } else {

				      // No user, so print a link for the user to login
				      // To post to a user's wall, we need publish_actions permission
				      // We'll use the current URL as the redirect_uri, so we don't
				      // need to specify it here.
				      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_actions' ) );
				      echo 'Please <a href="' . $login_url . '">login.</a>';

				    } 
	}


}
?>