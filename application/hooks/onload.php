<?php
class onload{
	private $ci;

	public function __construct(){
		$this->ci =& get_instance(); //property  ci รับคุณสมับัติของ CI เข้ามา
		$this->ci->load->helper('url');
		$this->ci->load->library('session');

	}

	public function check_login(){

		$controller = $this->ci->router->class;
		$method = $this->ci->router->method;

		
		if(($controller == 'dash' || $controller == 'managemember')){
			if($this->ci->session->userdata('adminsession')==null){
				//echo "login";
				if($method != "login"){
					redirect("control/login","refresh");
					exit();
				}
			}
		}
		
		
	}

}

?>