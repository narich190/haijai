<div class="container" style="padding:30px;">

    <div style="text-align:center;">
		<p align="right">หมายเลขการทำรายการ <?=$donationlog_id?></p>
	  	<hr>
        <h1 style="font-size:500%">Haijai</h1>
        <p class="lead">ขอขอบคุณที่ให้โอกาสเรา<br>
		ได้เป็นส่วนหนึ่งในการสร้างสังคมที่ดีร่วมกับคุณ</p>
		
		<div  class="col-sm-12" style="background:#FEC8CF;padding:20px;">
		
			<div class="col-sm-3" >
				<img src="<?=base_url()?>assets/img/project/tracking.png" style="height:150px;opacity:0.1;"/>
			</div>

			<div class="col-sm-9" style="text-align:left;">
				<span class='bankcase' style='font-size:14;color:#253747;padding:0;display:none;'>
					เมื่อทำการโอนเงินเรียบร้อยเเล้ว ให้ท่านทำการอัพโหลดสลิป
					หลักฐานการโอนเงิน เข้าที่ เมนู ติดตามสถานะการทำธุรกรรม อัพโหลดเป็นไฟล์ .jpg โดย
					การทำการถ่ายภาพหรือสแกน เมื่อทำการอัพโหลดเรียบร้อยเเล้ว ทางทีมงานจะทำการตรวจสอบ
					และอนุมัติรายการธุรกรรมของท่าน และทำการอัพเดทข้อมูลธุรกรรมโดยอัตโนมัติ
				</span><br>
				<span class='paysbuycase' style='font-size:14;color:#253747;padding:0;display:none;'>
					ระบบจะทำการตรวจสอบเเละอัพเดทข้อมูลธุรกรรมของท่านโดยอัตโนมัติเมื่อ
					เพย์สบายยืนยันรายการทำธุรกรรมของท่านเสร็จสมบูรณ์ 
					ซึ่งสามารถตรวจสอบรายการธุรกรรมได้จากเมนู ติดตามสถานะการทำธุรกรรมโดยใช้หมาย
					เลขรายการของท่าน   
				</span><br>
			</div>

		</div>
      	
	  	<div class="col-sm-12" style="margin-top:10px;">
	  		<hr>
			<a href="<?=base_url()?>">
				<button type="button" class="btn btn-default btn-lg">
					กลับไปหน้าแรก
				</button>
			</a>
		</div>
	  
	</div>
		
</div><!-- /.container -->

<script type="text/javascript">
	
	//open step process content to users

	$("."+"<?=$donation_channel?>"+"case").css("display","inline");
	


</script>