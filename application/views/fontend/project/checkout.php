<?=form_open("project/confirm");?>
<div class="container">

	<div>
	  	<h2 align="left">ร่วมระดมสินทรัพย์</h2>
	  
    	<div class="col-md-5" style="background:url('<?=base_url()?>assets/img/project/profile/<?=$detailproject[0]['img_previewpath']?>') no-repeat;height:300px;">
		
		</div>

		<div class="col-md-7" style="padding:15px;">
			<input type='hidden' name='project_id' value="<?=$detailproject[0]['project_id']?>"/>
			<input type='hidden' name='member_id' value="<?=$this->session->userdata['membersession']['member_id'];?>" />
			<input type='hidden' name='donation_channel' value="<?=$channel?>" />

			<span style="font-size:25;color:#253747;padding:0;" align="left"><?=$detailproject[0]['project_name']?></span><br>
			<span style="font-size:16;color:#253747;padding:0;">สถานที่: <?=$detailproject[0]['country']?>, <?=$detailproject[0]['province']?></span><br>
			<span style="font-size:16;color:#253747;padding:0;">หมวดหมู่โครงการ: <?=$detailproject[0]['projectgroup_name']?></span><br>
			<span style="font-size:16;color:#253747;padding:0;">เป้าหมายของโครงการ: <?=$detailproject[0]['project_target']?> บาท</span><br>
			<span style="font-size:16;color:#253747;padding:0;">เหลือเวลาอีก <?=$detailproject[0]['daycanuse']?> วัน</span><br>
			<span style="font-size:16;color:#253747;padding:0;">สร้างโครงการโดย: <?=$detailproject[0]['member_name']?></span><br>
				
			<span style="font-size:16;color:red;padding:0;">ร่วมระดมทุนเข้าบัญชี: บริษัท ให้ใจเพื่อการศึกษา</span><br>
			<span style="font-size:16;color:red;padding:0;">หมายเลขบัญชี: 123-456-789 ธนาคาร กสิกรไทย สาขา ประชาอุทิศ</span><br>	
			
			<span style='font-size:25;color:#253747;padding:0;' align='left'>ร่วมบริจาคเป็นจำนวนเงิน (บาท)</span><br>
			<input type='text' style='width:100%;' name='money' class='form-control' />
		
		</div>
		
	</div>
	
</div><!-- /.container -->


<div class="container">
	<hr>
	<div class="col-sm-12">
		<span style="font-size:25;color:#253747;padding:0;" align="left"><b>โครงการสำรอง</b></span>
	</div>
	
	
	<div class="col-sm-6">
		<span style="font-size:16;color:#253747;padding:0;" align="left">หมวดหมู่โครงการ</span>
		<select class="form-control" style="width:100%;">
			<option value='all'>ทั้งหมด</option>
			<?php
				foreach ($project_group as $key => $value) {
					echo "<option value='".$value['projectgroup_name']."'>";
					echo $value['projectgroup_name'];
					echo "</option>";	
				}
			?>
		</select>
	</div>
	
	
	<div class="col-sm-6">
		<span style="font-size:16;color:#253747;padding:0;" align="left">เลือกโครงการ</span>
		<select class="form-control" name="project_id2" style="width:100%;">
			<?php
				foreach ($project_2 as $key => $value) {
					echo "<option value='".$value['project_id']."'>";
					echo $value['project_name'];
					echo "</option>";	
				}
			?>
		</select>
	</div>
	
	<div class="col-sm-12" style="height:10px;"></div>	

	<div class="col-sm-12">
		<span style="font-size:25;color:#253747;padding:0;" align="left"><b>หน่วยงานไม่แสวงหาผลกำไร</b></span>
	</div>
	
	
	<div class="col-sm-6">
		<span style="font-size:16;color:#253747;padding:0;" align="left">
			กรุณาเลือกหน่วยงานไม่แสวงหาผลกำไรหากโครงการแรกและโครงการสำรอง 
			ไม่ประสบผลสำเร็จเพื่อเป็นการส่งต่อความช่วยเหลือของท่าน ไปยังผู้ต้องการ 
			ความช่วยเหลือคนอื่นๆ
		</span>
	</div>
	
	
	<div class="col-sm-6">
		<span style="font-size:16;color:#253747;padding:0;" align="left">หน่วยงาน</span>
		<select class="form-control" name="perma" style="width:100%;">
			<?php
				foreach ($permanent as $key => $value) {
					echo "<option value='".$value['permanent_id']."'>";
					echo $value['permanent_account_name'];
					echo "</option>";	
				}
			?>
		</select>
	</div>


	<div class="col-sm-12" style="padding:20px;">

		<button class="form-control btn btn-success" type="submit" style="width:100%;">ยืนยัน</button>

	</div>

	
</div>
<?=form_close();?>