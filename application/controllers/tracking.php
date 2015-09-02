<?php
class tracking extends CI_Controller{

	public function tracking(){
		parent::__construct();
	}

	public function index(){

		$this->load->view("fontend/topandfooter/topheader.php");

		$this->load->view("fontend/project/trackingprocess.php");

		$this->load->view("fontend/topandfooter/bottomfooter.php");

	}

	public function checkdonationlog(){

		$donationlog_id = $this->input->post("donation_id");
		$channel = $this->input->post("channelpay");
		if($channel == "PA"){
			$channel = "paysbuy";
		}else if($channel == "BA"){
			$channel = "bank";
		}

		$donationlogdata = $this->db->select("*")->from("Donationlog")->where("donation_channel",$channel)->where("donationlog_id",$donationlog_id)->get()->result_array();
		
		echo json_encode($donationlogdata);
	}

	public function uploadslipdonate(){

		$donationlog_id = $this->input->post("donationlog_id");

		if ($_FILES['img_donationpath']['name']!=""){

			$config['upload_path']= 'assets/backend/images/slip';
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
			$config['max_size'] = 100000;
			$config['file_name'] = "slip-".$donationlog_id;

			$this->upload->initialize($config);
			$this->upload->do_upload("img_donationpath");
			$pathupdate = $this->upload->file_name;

			//update path update
			$pathupdatearr = array(
               'img_donationpath' => $pathupdate,
            );

			$this->db->where('donationlog_id', $donationlog_id);
			$this->db->update('Donationlog', $pathupdatearr); 


		}

		$donationdata = $this->db->select("*")->from("Donationlog")->where("donationlog_id",$donationlog_id)->get()->row_array();
		//-----------------new noti-------------------------
		$donationlog_idwithtext = $donationdata['donation_channel']=='bank'?'BA':'PA';
		
			$detail = "เราได้รับหลักฐานของหมายเลขธุรกรรม ".$donationlog_idwithtext.$donationdata['donationlog_id']."แล้ว";
			$linkpath = "tracking";
			$member_id = $donationdata['member_member_id'];

			$this->noti->newNoti($detail, $linkpath, $member_id);
		//--------------------------------------------------


			//-----------------new admin noti-------------------
			$detail = $donationlog_idwithtext.$donationdata['donationlog_id']." อัพโหลดหลักฐานทางธุรกรรม";
			$linkpath = "dash/filterdash/".$donationdata['donationlog_id'];
			$admin_type = "admin_donator";

			$this->noti->newadminNoti($detail, $linkpath, $admin_type);
			//--------------------------------------------------


		redirect("tracking");

	}
	


}
?>