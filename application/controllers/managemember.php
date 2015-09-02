<?php
class managemember extends CI_Controller{
	public function managemember(){
		parent::__construct();
	}

	public function index(){

		$this->noti->keeplog("admin","เข้ามาดูสมาชิกทั้งหมด ", $_SERVER['REQUEST_URI']);//keeplog
	
		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/managemember/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('member');
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


		$data['allmember'] = $this->db->select("*")
		->from("member m")
		->join("interest i","m.member_id = i.member_member_id")
		->join("project_group g","i.project_group_projectgroup_id = g.projectgroup_id")
		->order_by("member_id","asc")->get()->result_array();
		
		$this->load->view("backend/managemember/allmember.php",$data);
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function filtermember($member_id){

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");


		//pagination
			$config['base_url'] = base_url()."/managemember/index/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('member');
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


		$data['allmember'] = $this->db->select("*")
		->from("member m")
		->join("interest i","m.member_id = i.member_member_id")
		->join("project_group g","i.project_group_projectgroup_id = g.projectgroup_id")
		->order_by("member_id","asc")->get()->result_array();
		
		$this->load->view("backend/managemember/allmember.php",$data);
		$this->load->view("backend/dash/scriptinside.php");

	}

	//font-end
	public function addmemberstaff(){
		
		$this->noti->keeplog("admin","เข้ามาดูหน้าเพิ่มสต๊าฟ ", $_SERVER['REQUEST_URI']);//keeplog

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");
		
		$this->load->view("backend/managemember/addmemberstaff.php");
		$this->load->view("backend/dash/scriptinside.php");

	}

	public function addmemberstafffunction(){

		$this->noti->keeplog("admin","ทำการเพิ่มสต๊าฟชื่อ ", $_SERVER['REQUEST_URI']);//keeplog


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
		values(null, '".$member_name."', '', '".$biography."', '".$location."', '".$username."', '".$password."', '".$email."', 'Moderator', 'approve', '".$receiveemailnews."', '', '', '')");
		
		//get member_id
		$memberdata = $this->db->select("*")->from("member")->where("member_name",$member_name)->where("username",$username)->get()->row_array();

		
		//upload user profile
		$config['upload_path']= 'assets/img/member/MemberProfile';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config['max_size'] = 100000;
		$config['file_name'] = "profile-".$memberdata['member_id'];

		$this->upload->initialize($config);
		$this->upload->do_upload("img_profilepath");
		$pathupdate = $this->upload->file_name;


		//upload backgroundCrm_pdfpath profile
		$config2['upload_path']= 'assets/img/member/MemberPDF';
		$config2['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config2['max_size'] = 100000;
		$config2['file_name'] = "backgroundCrm_pdfpath-".$memberdata['member_id'];

		$this->upload->initialize($config2);
		$this->upload->do_upload("backgroundCrm_pdfpath");
		$pathupdate2 = $this->upload->file_name;


		//upload img_copypersonalCardpath profile
		$config3['upload_path']= 'assets/img/member/MemberIdentification';
		$config3['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config3['max_size'] = 100000;
		$config3['file_name'] = "img_copypersonalCardpath-".$memberdata['member_id'];

		$this->upload->initialize($config3);
		$this->upload->do_upload("img_copypersonalCardpath");
		$pathupdate3 = $this->upload->file_name;



		//upload img_copyhomeBookpath profile
		$config4['upload_path']= 'assets/img/member/MemberPassport';
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



		$this->noti->keeplog("admin","ทำการเพิ่มสต๊าฟชื่อ ".$member_name, $_SERVER['REQUEST_URI']);//keeplog


		redirect("managemember");
	}


	public function blockmemberstafffunction(){

		$member_id = $this->input->post("member_id");
		$action = $this->input->post("action"); 


			$pathupdatearr = array(
               'member_status' => $action,
            );

			$this->db->where('member_id', $member_id);
			$this->db->update('member', $pathupdatearr); 
		
		$member_info = $this->db->select("*")->from("member")->where("member_id",$member_id)->get()->row_array();
		
		if($action == "block"){
			$this->noti->keeplog("admin","บล็อคสต๊าฟ ".$member_info['member_name'], $_SERVER['REQUEST_URI']);//keeplog
		}else{
			$this->noti->keeplog("admin","ปลดบล็อคสต๊าฟ ".$member_info['member_name'], $_SERVER['REQUEST_URI']);//keeplog

		}
	
		echo json_encode("ดำเนินการบล็อคเรียบร้อยเเล้ว");
	}



	//backend
	public function addadminpage(){
		
		$this->noti->keeplog("admin","เข้ามาดูหน้าเพิ่มผู้ดูแลระบบ", $_SERVER['REQUEST_URI']);//keeplog

		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");
		
		$this->load->view("backend/managemember/addadmin.php");
		$this->load->view("backend/dash/scriptinside.php");
		

	}

	public function addadminfunction(){
		$infoadmin = array(
		 	'admin_id' => null,
			'admin_name' => $this->input->post("member_name"),
			'img_profilepath' => "", 
			'admin_type' => $this->input->post("MemberRole"),
			'username' => $this->input->post("username"),
			'password' => $this->input->post("password"),
			'admin_status' => "approve",
			'biography' => $this->input->post("biography"),
			'location' => $this->input->post("location"),
			);

		$this->db->insert("admin",$infoadmin);

		$admin_info = $this->db->select("*")->from("admin")->order_by("admin_id","desc")->limit(1)->get()->row_array();
		//"img_profilepath"=>$this->input->post("img_profilepath"),
		//upload user profile
		$config['upload_path']= 'assets/img/member/MemberProfile';
		$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml";
		$config['max_size'] = 100000;
		$config['file_name'] = "profileadmin-".$admin_info['admin_id'];

		$this->upload->initialize($config);
		$this->upload->do_upload("img_profilepath");
		$pathupdate = $this->upload->file_name;

		//update path update
		$pathupdatearr = array(
            'img_profilepath' => $pathupdate,
        );


		$this->db->where('admin_id', $admin_info['admin_id']);
		$this->db->update('admin', $pathupdatearr); 

		$this->noti->keeplog("admin","ทำการเพิ่มผู้ดูแลระบบชื่อ ".$admin_info['admin_name'], $_SERVER['REQUEST_URI']);//keeplog


		redirect("managemember/alladmin");
	}


	
	public function alladmin(){

		$this->noti->keeplog("admin","เข้ามาดูผู้ดูแลระบบทั้งหมด", $_SERVER['REQUEST_URI']);//keeplog


		$this->load->view("backend/dash/headernav.php");
		$this->load->view("backend/dash/navcontent.php");

		//pagination
			$config['base_url'] = base_url()."/managemember/alladmin/";
			$config['per_page'] = 10;
			//count_all(); -> count data in table
			$counttable = $this->db->count_all('member');
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
		


		$data['alladmin'] = $this->db->select("*")
							->from("admin")
							->order_by("admin_id","asc")->get()->result_array();

		
		$this->load->view("backend/managemember/alladmin.php",$data);
		$this->load->view("backend/dash/scriptinside.php");

	}	

	public function blockadminstafffunction(){

		$admin_id = $this->input->post("admin_id");
		$action = $this->input->post("action"); 


			$pathupdatearr = array(
               'admin_status' => $action,
            );

			$this->db->where('admin_id', $admin_id);
			$this->db->update('admin', $pathupdatearr); 
		
		$admin_info = $this->db->select("*")->from("admin")->where("admin_id",$admin_id)->get()->row_array();
		if($action == "block"){
			$this->noti->keeplog("admin","บล็อคผู้ดูแลระบบ ".$admin_info['admin_name'], $_SERVER['REQUEST_URI']);//keeplog
		}else{
			$this->noti->keeplog("admin","ปลดบล็อคผู้ดูแลระบบ ".$admin_info['admin_name'], $_SERVER['REQUEST_URI']);//keeplog

		}

		echo json_encode("ดำเนินการบล็อคเรียบร้อยเเล้ว");
	}


}
?>