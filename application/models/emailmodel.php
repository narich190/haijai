<?php 
class emailmodel extends CI_Model{

	public function newMessage(){

		$config['protocol'] = 'mail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 40;
		
		/*							
		//message = $this->input->post("message");
		$userBuyID = $this->db->select("*")->from("userbuy")->order_by("userBuyID","desc")->limit(1)->get()->row_array();
		$orderList = $this->db->select("*")->from("orderlist")->where("orderID",$getorderID)->where("productID !=",0)->get()->result_array();
		$orderName = $this->db->select("*")->from("orderlog")->where("orderID",$getorderID)->order_by("orderID","desc")->limit(1)->get()->row_array();

		$message = "Hello ".$userBuyID['firstname'].' '.$userBuyID['lastname']."\n Your order number is ".$orderName['orderName']."\n Detail: ";

		if(sizeof($orderList)>0){	
			for ($i=0; $i < sizeof($orderList); $i++) { 

				$productamount = $this->db->select("*")->from("orderlist ls")->join("product p","ls.productID = p.productID")->where("orderListID",$orderList[$i]['orderListID'])->get()->result_array();

				$message .= "\t".$productamount[0]['productName'].': '.$orderList[$i]['amount']."\n";
											
			}

		}	

		$orderAmount = $this->db->select("sum(ol.amount) as amount, sum(ol.totalprice) as total")->from("orderlog log")->join("orderlist ol","log.orderID = ol.orderID")->where("ol.orderID",$getorderID)->group_by("log.orderName")->order_by("orderStart", "desc")->limit(1)->get()->row_array();
										$message .= " Amount: ".$orderAmount['amount'].', Total : '.$orderAmount['total'].' Baht'."\n";
										
		$message .= "ท่านสามารถตรวจสอบสถานะของการสั่งซื้อได้ที่เมนู Order Tracking";
		*/
		
		$config['protocol'] = 'mail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 40;
		$message = "Hello";
										
		$sender = "Haijai Support";
		$email = 'haijaisupport@gmail.com';
										
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from($email);
		$this->email->to("daechatorn.man@gmail.com"); //ส่งหาใคร
		$this->email->subject($sender);
		$this->email->message($message);

		$this->email->send();

	}


}
?>