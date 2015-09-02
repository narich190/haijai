<?php
class main extends CI_Controller{

	public function main(){
		parent::__construct();
	}

	public function index(){

		$this->load->view("fontend/topandfooter/topheader.php");



		$criteriaproject_status = array('approve'); 
		$data['fundproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status","no")->where("project_type","ระดมทุน")->limit(3)->get()->result_array();
		$data['donationproject'] = $this->db->select("*, DATEDIFF(project_end,now()) AS daycanuse, (money_raising * 100)/money_expect AS projectpercen")->from("project p")->join("project_detail d","p.project_id = d.project_project_id")->join("project_status s","p.project_id = s.project_project_id")->join("project_group g","p.project_group_projectgroup_id = g.projectgroup_id")->join("member m","p.member_member_id = m.member_id")->where_in("project_status",$criteriaproject_status)->where("block_status","no")->where("project_type","รับบริจาค")->limit(3)->get()->result_array();


		$this->load->view("fontend/main/firstpage.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function checkRowMessagebox(){
		//getCurrentProbId();
		$member_id = $this->session->userdata['membersession']['member_id'];
			
    	$notidata =  $this->db->select("*")->from("(select *, 
						(select member_name from member mem where member_id = m.sender_member_id) as senderm
      					, (select img_profilepath from member mem where member_id = m.sender_member_id) as senderimg
      					FROM messagebox m 
      					where m.sender_member_id = $member_id or m.member_member_id = $member_id
      					order by m.msg_id desc) as mess")
    					->where("msg_id >",$this->session->userdata['startMsgIDsession']['msg_id'])
						->group_by("refer")->get()->result_array();

		
		if(sizeof($notidata)>0){
			//$a .= "";
			
			//loop for check in case have to notification new
			for($i=0;$i<sizeof($notidata);$i++) {
				
				$messageInfo = $this->db->select("member_member_id")->from("MESSAGEBOX")->where("msg_id",$notidata[$i]['msg_id'])->limit(1)->get()->row_array();

				//insert into notification table
				$data = array(
					'messnoti_id' => null ,
					'msg_id' => $notidata[$i]['msg_id'],
					'refer' => $notidata[$i]['refer'],
					'readstatus' => "notread",
					'member_id' => $messageInfo['member_member_id'],
				);
				$this->db->insert('messnoti', $data);
				

				//change current orderID session		
				if($i == (sizeof($notidata)-1)){

					$this->session->unset_userdata('startMsgIDsession');
					$ar = array(
								"startMsgIDsession" =>$this->db->select_max("msg_id")->from("MESSAGEBOX m")->where("m.sender_member_id",$member_id)->or_where("m.member_member_id",$member_id)->order_by("m.msg_create","desc")->limit(1)->get()->row_array(),
						);
					$this->session->set_userdata($ar);
					//$a .= "finish";
				}
				
			}
			
			
		}
		
		//delete dupicate data
		$dupicateIDdata = $this->db->select("*")->from("messnoti")->group_by("msg_id")->having("count(msg_id) > 1")->get()->result_array();

		if(sizeof($dupicateIDdata)>0){	
			for ($i=0; $i < sizeof($dupicateIDdata); $i++) { 
				//$this->db->query("DELETE FROM notification WHERE notiID = '".$dupicateIDdata[$i]['notiID']."'");
				$this->db->delete('messnoti', array('messnoti_id' => $dupicateIDdata[$i]['messnoti_id'])); 
			}
		}
		

		$rs = $this->db->select("*")->from("messnoti mess")->where("member_id",$member_id)->where("readstatus","notread")->order_by("mess.messnoti_id","desc")->get()->result_array();
		echo json_encode($rs);

	}


	public function checkRowNoti(){
		//getCurrentProbId();
		$member_id = $this->session->userdata['membersession']['member_id'];
			
    	$notidata =  $this->db->select("*")->from("membernoti")
    				->where("member_id",$member_id)
    				->order_by("notiCreate","desc")
    				->get()->result_array();

	
		
		echo json_encode($notidata);

	}

	public function editReadNoti(){

		$notiID = $this->input->post("notiID");

			$pathupdatearr = array(
               'readStatus' => "read",
            );

			$this->db->where('notiID', $notiID);
			$this->db->update('membernoti', $pathupdatearr); 

		echo json_encode("success");

	}

	public function checkNewSuccessProject(){

		$member_id = $this->session->userdata['membersession']['member_id'];
		
		if($member_id!=""){

			$project_info = $this->db->select("*")->from("project p")
			->join("project_status s","p.project_id = s.project_project_id")
			->where("s.project_status","success")
			->where("member_member_id",$member_id)
			->get()->result_array();

			if(sizeof($project_info)>0){
				foreach ($project_info as $key => $value) {
					$detail = "โครงการ".$value['project_name']." ของคุณสำเร็จเเล้วกรุณาอัพเดทข้อมูลกิจกรรมประกาศของท่าน";
					$noti = $this->db->select("*")->from("membernoti m")->where("m.notiDetail",$detail)->get()->row_array();
					if(sizeof($noti)==0){
						//-----------notification------------
						$linkpath = "profile/successactivity";
						$this->noti->newNoti($detail, $linkpath, $member_id);
						//-----------------------------------

					}

				}
			}


			//follow project
			$project_follow_info = $this->db->select("*")->from("project_follow")
										->where("follow_type","project")
										->where("member_member_id",$member_id)
										->get()->result_array();

			if(sizeof($project_follow_info)>0){
				foreach ($project_follow_info as $key => $value_project_follow_info) {
					
					$project_info = $this->db->select("*")->from("project p")
									->join("project_status s","p.project_id = s.project_project_id")
									->where("s.project_status","success")
									->where("p.project_id",$value_project_follow_info['project_project_id'])
									->get()->row_array();
					
					
					if(sizeof($project_info)>0){
						
						$detail = "โครงการ".$project_info['project_name']." สำเร็จตามเป้าเเล้ว";
						$noti = $this->db->select("*")->from("membernoti m")
								->where("m.notiDetail",$detail)
								->where("m.member_id",$member_id)
								->get()->row_array();

						if(sizeof($noti)==0){
							//-----------noti of update to follow--------------
							$linkpath = "project/detailprojectfund/".$project_info['project_id']."";
						
							$this->noti->newNoti($detail, $linkpath, $member_id);
							//-----------------------------------
						}

					}


				}
			}



		}

		echo json_encode("");

	}

	

}
?>