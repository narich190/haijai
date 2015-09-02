<!DOCTYPE html>
<html lang="en">
<!--header-->
<header class="firstpage" style="width:100%;height:calc(50% - 90px);min-height:120px;background:url('<?=base_url()?>assets/img/project/projectbg1.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  padding:4% 8%;">

  	<link rel="stylesheet" href="haijai/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="haijai/assets/css/main.css"> 

	<!--ข้อความ-->
	<div class="col-sm-12" style="padding:5%;text-align:center;">
		<span style="font-size:35;color:white;font-weight:50px;"><b>"แรงบันดาลใจ ความฝัน ความปรารถนา"</b></span>
		<br><br>
		<span style="font-size:18;color:white;"><b>เราสามารถทำให้มันเป็นจริงร่วมกันได้</b></span>
	 	<br>
	 	
 	</div>
 	<!---->

</header>
<!---->


<!--projectfilter-->
<div class="projectfilter" style="width:100%;height:100px;background:#30dbb5;padding:1% 2%">
  	<div class="col-sm-8 col-sm-offset-2" style="padding:2% 2%;height:100%;">
		<!--filter type-->
		<div class="col-sm-2" style="text-align:left;">
			<span style="font-size:18;color:white;"><b>แสดงผลโดย</b></span>
			<br><br>
	 	</div>
		<div class="col-sm-2" style="text-align:center;padding-left:5px;padding-right:5px;color:white;">
			<select class="form-control" style="border:none;background:transparent;width:auto;">
				<option>โครงการระดมสินทรัพย์</option>
				<option>โครงการรับบริจาค</option>
				<option>กิจกรรมประกาศ</option>
			</select>
	 	</div>

		<div class="col-sm-2 col-sm-offset-1" style="text-align:center;padding-left:5px;padding-right:5px;color:white;">
			<select class="form-control" style="border:none;background:transparent;width:auto;">
				<option>ทั้งหมด</option>
				<option>เด็ก/ สตรี/ เยาวชน</option>
				<option>คนชรา/ คนพิการ</option>
				<opion>ขนกลุ่มน้อย</opion>
				<opion>คนไร้บ้าน/ ที่อยู่อาศัย</opion>
				<opion>สิทธิมนุษยชน</opion>
				<opion>สัตว</opion>
				<opion>พลังงาน/ สิ่งแวดล้อม</opion>
				<option>การศึกษา</option>
				<option>ศาสนา/ ศิลปวัฒนธรรม</option>
				<option>สุขภาพ/ ยา</option>
				<option>ฉุกเฉิน/ ความปลอดภัย</option>
				<option>ภัยพิบัติ</option>
				<option>คอมพิวเตอร์/ IT</option>
				<option>สื่อ/ การกระจายเสียง</option>
				<option>กีฬา/ สันทนาการ</option>
				<option>สวัสดิการ และ สังคม</option>
			</select>
	 	</div>

	<div class="col-sm-2 col-sm-offset-1" style="text-align:center;padding-left:5px;padding-right:5px;color:white;">
 		<button type="submit" class="btn btn-default">ค้นหา</button>
	</div>

	</div>
</div>
<!---->


<!--โครงการ-->
<div class="overviewproject" style="width:100%;min-height:1000px;background:#FFFFFF;padding:2% 8% 0% 4%;">
	
	
	<!--ตัวอย่างโครงการทั้งหมดโดยย่อ-->
	<div class="col-sm-12" style="padding:0%;width:100%;">
    	<hr>
		<!--โครงการที่1 + bg: preview project-->
		<?php
		if (count($allproject)==0){

		}
		else{
		$round = 1;
		foreach ($allproject as $key => $value) {

		/*----------------Question: How to display project that success or receivemoney ?----------------*/
		
		echo "<div class='col-sm-4 previewviewproject1' style='padding-top:20px;position:relative;'>";
		
		//change color when hover

		echo "<div class='previewproject1' style='position:absolute;width:calc(100% - 29px);height:calc(100% - 20px);background:pink;z-index:10;opacity:0;text-align:center;padding:40% 0%;'>";
		echo "<span style='color:white;font-size:16;'>".$value['project_preview']."</span>
				<br><br>
				<a href='".base_url()."project/detailprojectfund/".$value['project_id']."'><button class='btn btn-primary'>ดูเพิ่มเติม</button></a>
			</div>
			<a href='#'>
				<div style='max-width:100%;'>
					<!--img project-->
					<img src='".base_url()."assets/img/project/profile/".$value['img_previewpath']."'style='height:20%;width:100%;position:relative;min-height:230px;' />
					
				</div>
			</a>";

		
			echo "<div style='background:#0FA3F2;height:250px;padding:20px;text-align:center'>";
		
				echo "<span style='color:white;font-size:18'><b>".$value['project_name']."</b></span>
							<br>";
				if($value['project_status']=='success' or $value['project_status']=='receivemoney'){
				echo "<span style='color:#253747;font-size:16'>โครงการสำเร็จเรียบร้อย <br>ขอขอบคุณทุกท่านที่มาร่วมให้ใจให้โอกาสร่วมกัน</span>";
				}
				else{
					if($value['project_type']=="ระดมทุน"){
						echo "<span style='color:white;font-size:16'>เป้าหมาย ".$value['money_expect']." บาท </span>
							<br>";
						echo "<span style='color:white;font-size:16'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span>
							<br>";
						echo "<span style='color:#253747;font-size:16'>คืบหน้า ".$value['projectpercen']."% จากเป้าหมาย</span>
							<br>";
						
						echo "<div class='progress' style='width:100%;'>
							<div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='".$value['projectpercen']."' aria-valuemin='0' aria-valuemax='100' style='width:".$value['projectpercen']."%'>
				    		<span class='sr-only'>".$value['projectpercen']."% Complete</span>

				  			</div>
						</div>	";
					}
						
					if($value['project_type']=="รับบริจาค"){
						echo "<span style='color:white;font-size:16'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span>
							<br>";
					}
				}
			echo"</div>
		</div>";
		}
		}
		?>

		<!---->

		<!--more suggest-->
		    <div class="col-sm-12" style="padding-top:20px;" 
	    	<a href="javascript:void(0);" onClick="displayoverviewall();">
	    		<br>&nbsp&nbsp<br>
		        <button class="btn btn-default btn-group" style="width:100%;height:50px;background:#d5d2d5;">แสดงผลเพิ่มเติม</button>
		    </a>
	    	</div>
		</div>
	</div> 	

	<!---->

<div class="row" style="width:100%;height:100px;background:#30dbb5;font-size:18;color:white;margin-top: 2cm;">
<br>
  <div class="col-sm-2 col-sm-offset-2">ยอดเงินบริจาคทั้งหมด <br>&nbsp 1000000 บาท</div>
  <div class="col-sm-2 col-sm-offset-1">จำนวนผู้บริจาคทั้งหมด <br>&nbsp 3204 คน</div>
  <div class="col-sm-2 col-sm-offset-1">สมาชิกทั้งหมด <br>&nbsp 5063 คน</div>
</div>


<!---->

<script type="text/javascript">

	function displayoverviewall(){

		//TODO: Used ajax to get project between nine - end projects

	}
</script>
</html>


