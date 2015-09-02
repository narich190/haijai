<?php
class messagebox extends CI_Controller{

	public function messagebox(){
		parent::__construct();
	}

	public function index(){

		$this->load->view("fontend/topandfooter/topheader.php");

		
		$member_id = $this->session->userdata['membersession']['member_id'];

		$data['messagedata'] = $this->db->select("*")
		->from("(select *, 
						(select member_name from member mem where member_id = m.sender_member_id) as senderm
      					, (select img_profilepath from member mem where member_id = m.sender_member_id) as senderimg
      					FROM messagebox m 
      					where m.sender_member_id = $member_id or m.member_member_id = $member_id
      					order by m.msg_id desc) as mess")
		->group_by("refer")->get()->result_array();


		//$data['messnoti'] = $this->db->select("count(*) as numbereachrefer, refer")->from("messnoti mess")->where("member_id",$member_id)->where("readstatus","notread")->group_by("refer")->order_by("mess.messnoti_id","desc")->get()->result_array();

		$this->load->view("fontend/messagebox/mainmessagebox.php",$data);

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function getMessNoticon(){
		$member_id = $this->session->userdata['membersession']['member_id'];
		$messnotidata = $this->db->select("count(*) as numbereachrefer, refer")->from("messnoti mess")->where("member_id",$member_id)->where("readstatus","notread")->group_by("refer")->order_by("mess.messnoti_id","desc")->get()->result_array();
		echo json_encode($messnotidata);
	}



	public function getMessage(){

		$refer_id = $this->input->post("refer_id");
		$member_id = $this->input->post("member_id");

		//update message in messnoti
		$this->db->where('refer', $refer_id);
		$this->db->where('member_id', $member_id);
		$this->db->update('messnoti', array('readstatus' => "read")); 



		$getmessagedata = $this->db->select("*, senderm.member_name as senderm, senderm.img_profilepath as senderimg")->from("(select * from messagebox mess where refer = '".$refer_id."' order by msg_create asc) as mess")->join("member senderm","senderm.member_id = mess.sender_member_id","inner")->join("member receivem","receivem.member_id = mess.member_member_id","inner")->order_by("msg_create","asc")->get()->result_array();
		echo json_encode($getmessagedata);

	}

	public function saveMessage(){

		$refer_id = $this->input->post("refer_id");
		$whotalk = $this->input->post("whotalk"); //type


		$msg_detail = $this->input->post("msg_detail");
		$member_member_id = $this->input->post("member_member_id");
		$sender_member_id = $this->input->post("sender_member_id");

		
		
		if($refer_id == ""){
			$member = array($member_member_id, $sender_member_id);

			$messagehisdata = $this->db->select("*")->from("messagebox")->where_in('member_member_id', $member)->where_in('sender_member_id', $member)->get()->result_array();
			
			if(sizeof($messagehisdata) == 0){
				$this->db->query("insert into messagebox 
				values(null, '".$msg_detail."', now(), '".$whotalk."', '".$member_member_id."', '".$sender_member_id."', '')");
					
				$messagecurdata = $this->db->select("*")->from("messagebox")->where("msg_detail",$msg_detail)->order_by("msg_create","desc")->limit(1)->get()->row_array(); 

				$this->db->set("refer", $messagecurdata['msg_id']);
				$this->db->where('msg_id', $messagecurdata['msg_id']);
				$this->db->update('messagebox');
			}else{
				//insert
				$this->db->query("insert into messagebox 
				values(null, '".$msg_detail."', now(), '".$whotalk."', '".$member_member_id."', '".$sender_member_id."', '".$messagehisdata[0]['refer']."')");
			}
			
		}else{
			//insert
			$this->db->query("insert into messagebox 
			values(null, '".$msg_detail."', now(), '".$whotalk."', '".$member_member_id."', '".$sender_member_id."', '".$refer_id."')");
			
		}


		echo json_encode("");


	}


}
?>