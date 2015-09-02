<!--Header-->
<div class="container" style="margin-top:20px;margin-bottom:20px;">
	
	 <h2 align="left">สร้างโครงการ</h2>

</div><!-- /.container -->


<?=form_open_multipart("profile/updatecopydocument");?>
<div class="container boxupload" style="padding:30px;background:#C4D3E3;margin-bottom:30px;">
	<?php 
		echo "<input type='hidden' name='member_id' value='".$member_logindata['member_id']."' />";
		echo "<div class='col-sm-12'>
				<span style='font-size:20;color:#253747;padding:0;'><i class='fa fa-info-circle'></i> <b> กรุณาทำการอัพโหลดเอกสารดังต่อไปนี้ก่อนทำการสร้างโครงการ</b></span>
			</div>
			<div class='col-sm-12' style='margin:10px 0px;'></div>";

			if($member_logindata['img_copypersonalCardpath']==""){
				echo "<div class='col-sm-offset-1 col-sm-11'>
						<span style='font-size:18;color:#FE5F5E;padding:0;'><i class='fa fa-check-circle-o'></i> สำเนาบัตรจำตัวประชาชน</span>
						<input type='file' class='form-control' name='img_copypersonalCardpath' />
					</div>";
			}
			if($member_logindata['img_copyhomeBookpath']==""){
				echo "<div class='col-sm-offset-1 col-sm-11'>
						<span style='font-size:18;color:#FE5F5E;padding:0;'><i class='fa fa-check-circle-o'></i> สำเนาทะเบียนบ้าน</span>
						<input type='file' class='form-control' name='img_copyhomeBookpath' />
					</div>";
			}
			if($member_logindata['backgroundCrm_pdfpath']==""){
				echo "<div class='col-sm-offset-1 col-sm-11'>
						<span style='font-size:18;color:#FE5F5E;padding:0;'><i class='fa fa-check-circle-o'></i> ไฟล์เอกสารเพื่อสังคมในอดีต(ถ้ามี)</span>
						<input type='file' class='form-control' name='backgroundCrm_pdfpath' />
					</div>";
			}

		echo "<div class='col-sm-12' style='margin:10px 0px;'></div>

			<div class='col-sm-offset-1 col-sm-4'>
				<button class='form-control btn btn-success' >อัพโหลด</button>	
			</div>";
	
	?>

</div>
<?=form_close();?>

<?=form_open_multipart("project/createprojectprocess");?>
<div class="container boxcontent" style="margin-bottom:20px;display:none;">

	<!--step1-->
	<div class="step1createproject">

		<div class="col-sm-12">
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลพื้นฐาน</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-default" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลโครงการโดยละเอียด</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-default" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ยืนยันความถูกต้องข้อมูล</button>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อโครงการ</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<input type="text" class="form-control project_name" name='project_name' style="width:100%;" placeholder="เช่น โครงการแจกยิ้มเพื่อน้อง"/>
			</div>
			

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ประเภทโครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="project_type" class="form-control project_type" style="width:100%;">
					<option value="ระดมทุน" selected>ระดมสินทรัพย์</option>
					<option value="รับบริจาค" >รับบริจาค</option>
				</select>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">หมวดหมู่โครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="project_group_projectgroup_id" class="form-control project_categories" style="width:100%;">
					<option value="1">เด็ก/สตรี/เยาวชน</option>
                    <option value='2'>ระดมสินทรัพย์</option>
                    <option value='3'>คนชรา / คนพิการ</option>
                    <option value='4'>ชนกลุ่มน้อย</option>
                    <option value='5'>คนไร้บ้าน / ที่อยู่อาศัย</option>
                    <option value='6'>สิทธิมนุษยชน</option>
                    <option value='7'>สัตว์</option>
                    <option value='8'>พลังงาน / สิ่งแวดล้อม</option>
                    <option value='9'>การศึกษา</option>
                    <option value='10'>ศาสนา / ศิลปวัฒนธรรม</option>
                    <option value='11'>สุขภาพ / ยา</option>
                    <option value='12'>ฉุกเฉิน / ความปลอดภัย</option>
                    <option value='13'>ภัยพิบัติ</option>
                    <option value='14'>คอมพิวเตอร์ / IT</option>
                    <option value='15'>สือ / การกระจายเสียง</option>
                    <option value='16'>กีฬา / สันทนาการ</option>
                    <option value='17'>สวัสดิการสังคทม</option>
				</select>
			</div>

		</div>

		<div class="col-sm-12">

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รายละเอียดโดยย่อ</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<input type="text" name="project_preview" class="form-control project_shortdescription" style="width:100%;" placeholder="เช่น โครงการให้ความบันเทิงแก่เด็กในชุมชน มดน้อย"/>
			</div>

		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">วัตถุประสงค์</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<textarea class="form-control project_objective" name="project_object" style="width:100%;height:150px;resize: none;">

				</textarea>
			</div>


			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">กลุ่มเป้าหมาย</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<textarea class="form-control project_point" name="project_target" style="width:100%;height:150px;resize: none;">

				</textarea>
			</div>

			
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">แขวง</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="subdisdrict" class="form-control project_subdistrict" style="width:100%;">
					<option  option="บางมด" selected>บางมด</option>
				</select>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">เขต</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="district" class="form-control project_district" style="width:100%;">
					<option option="จอมทอง" selected>จอมทอง</option>
				</select>
			</div>


			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">จังหวัด</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="country" class="form-control project_country" style="width:100%;">
					<option  option="กรุงเทพมหานคร" selected>กรุงเทพมหานคร</option>
				</select>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ประเทศ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<select name="province" class="form-control project_province" style="width:100%;">
					<option option="ไทย" selected>ไทย</option>
				</select>
			</div>
		


			<div class="col-sm-3" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รูปภาพโปรไฟล์ของโครงการ</span>
			</div>

			<div class="col-sm-9" style="padding:15px;">
				<input type="file" name="img_previewpath" class="form-control" style="width:100%;" />
			</div>

		</div>


		<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
			<div class="col-sm-12">
				<button class="form-control btn btn-success" type="button" onClick="openDiv('step2createproject','step1createproject')" >ถัดไป</button>
			</div>
		</div>

	</div><!--end create step 1-->


	<!--step2-->
	<div class="step2createproject" style="display:none;">
		
		<div class="col-sm-12">
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลพื้นฐาน</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลโครงการโดยละเอียด</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-default" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ยืนยันความถูกต้องข้อมูล</button>
			</div>
		</div>


		<div class="col-sm-12">

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ข้อมูลโครงการโดยละเอียด</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<textarea class="form-control project_deepdetail" name="project_deepdetail" style="width:100%;height:150px;resize: none;">
				เช่น เป็นที่ยอมรับกันว่าเด็กในวันนี้คือผู้ใหญ่ในวันหน้า ถ้าเราปลูกฝัง อบรมสั่งสอนให้เด็กไทยมีจิต
				ใจที่ดีงาม มีความประพฤติดีใฝ่ดี ใฝ่เรียนรู้ขวนขวายหาความเจริญก้าวหน้าให้แก่ตนเองและประเทศ
				ชาติแล้ว ประเทศไทยของเราก็จะเจริญก้าวหน้าทัดเทียมประเทศมหาอำนาจซึ่งจะส่งผลให้ประชากร
				</textarea>
			</div>

			<!--fundrasing-->
			<div class="divfundrasinginfo" style="display:none;">

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">จำนวนเงินที่คาดหวัง</span>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<input type="text" class="form-control project_moneyexpect" name="money_expect" style="width:100%;" placeholder="เช่น 100000"/>
				</div>


				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">วันจัดทำโครงการจริง</span>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<input type="date" class="form-control project_realdo_fund" name="project_realstart_fund" style="width:100%;" />
				</div>

			</div>


			<!--donation-->
			<div class="divdonationinfo" style="display:none;">

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">สิ่งของที่คาดหวัง</span>
				</div>
				<div class="col-sm-10" style="padding:15px;">
					<textarea class="form-control project_itemexpect" name="item_expect" style="width:100%;height:150px;resize: none;">
					หากเป็นจำนวนเงินกรุณา ระบุ รายละเอียดธุรกรรมลงไปด้วย

					</textarea>
				</div>

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">วันจัดทำโครงการจริง</span>
				</div>
				<div class="col-sm-10" style="padding:15px;">
					<input type="date" class="form-control project_realdo_donate" name="project_realstart_donate" style="width:100%;" />
				</div>

			</div>

		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ระยะเวลาโครงการ</span>
			</div>
			<div class="col-sm-2" style="padding:15px;">
				<input type="number" class="form-control project_intime" name="timewantdisplay" style="width:100%;" />
			</div>
			<div class="col-sm-8" style="padding:15px;">
				<span style="font-size:14;color:#253747;padding:0;">
					ระยะเวลาจะเริ่มนับหลังจากระบบทำการอนุมัติโครงการ(ใช้เวลา 7 วันนับจากส่งคำร้องขอ)
				</span>
			</div>

		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ลิ้งยูทูปโครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<input type="text" class="form-control project_youtube" name="video_detailpath" style="width:100%;" />
			</div>
			<div class="col-sm-6" style="padding:15px;">
				<span style="font-size:14;color:#253747;padding:0;">
					เช่น http://www.youtube.com/smileforbaby
				</span>
			</div>

		</div>


		<div class="col-sm-12">
			<div class="col-sm-3" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รูปภาพหน้าปกของโครงการ</span>
			</div>

			<div class="col-sm-9" style="padding:15px;">
				<input type="file" name="img_detailpath" class="form-control" style="width:100%;" />
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-3" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">เอกสารโครงการ (.pdf)</span>
			</div>

			<div class="col-sm-9" style="padding:15px;">
				<input type="file" name="project_pdfpath" class="form-control" style="width:100%;" />
			</div>
		</div>


		<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
			<div class="col-sm-2">
				<button class="form-control btn btn-warning" type="button" onClick="openDiv('step1createproject','step2createproject')" >ย้อนกลับ</button>
			</div>
			<div class="col-sm-10">
				<button class="form-control btn btn-success" type="button" onClick="openDiv('step3createproject','step2createproject')" >ถัดไป</button>
			</div>
		</div>

	</div><!--end create step 2-->


	<!--step3-->
	<div class="step3createproject" style="display:none;">
		
		<div class="col-sm-12">
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลพื้นฐาน</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลโครงการโดยละเอียด</button>
			</div>
			<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ยืนยันความถูกต้องข้อมูล</button>
			</div>
		</div>


		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อโครงการ</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_name_step3">โครงการแจกยิ้มเพื่อน้อง</span>
			</div>
		</div>
		<div class="col-sm-12"> 	

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ประเภทโครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<span class="project_type_step3">ระดมสินทรัพย์</span>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">หมวดหมู่โครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<span class="project_categories_step3">เด็กและเยาวชน</span>
			</div>

		</div>

		<div class="col-sm-12">

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รายละเอียดโดยย่อ</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_shortdescription_step3">โครงการให้ความบันเทิงแก่เด็กในชุมชน มดน้อย</span>
			</div>

		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">วัตถุประสงค์</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_objective_step3">

					นี่คือวัตถุประสงค์โครงการ ทดสอบทดสอบ ทดสอบ

				</span>
			</div>
		</div>


		<div class="col-sm-12"> 	

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">กลุ่มเป้าหมาย</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_point_step3">

					นี่คือกลุ่มเป้าหมายโครงการ ทดสอบทดสอบ ทดสอบ

				</span>
			</div>
		</div>


		<div class="col-sm-12"> 		
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ที่อยู่</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_address_step3">123/22 แขวงบางมด เขตทุ่งครุ่ง จังหวัด กรุงเทพมหานคร ประเทศไทย</span>
			</div>
		</div>	
		


		<div class="col-sm-12">

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ข้อมูลโครงการโดยละเอียด</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="project_deepdetail_step3">

					นี่คือข้อมูลโครงการโดยละเอียดโครงการ ทดสอบทดสอบ ทดสอบ

				</span>
			</div>
		</div>


		<div class="col-sm-12"> 
			<!--fundrasing-->
			<div class="divfundrasinginfo" style="display:none;">

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">จำนวนเงินที่คาดหวัง</span>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<span class="project_moneyexpect_step3">100000 บาท</span>
				</div>


				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">วันจัดทำโครงการจริง</span>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<span class="project_realdo_step3" >21 กรกฏาคม 2558</span>
				</div>

			</div>


			<!--donation-->
			<div class="divdonationinfo" style="display:none;">

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">สิ่งของที่คาดหวัง</span>
				</div>
				<div class="col-sm-10" style="padding:15px;">
					<span class="project_itemexpect_step3">

						นี่คือข้อมูลสิ่งของที่คาดหวังโครงการ ทดสอบทดสอบ ทดสอบ

					</span>
				</div>

				<div class="col-sm-12"> </div>

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">วันจัดทำโครงการจริง</span>
				</div>
				<div class="col-sm-10" style="padding:15px;">
					<span class="project_realdo_step3">21 กรกฏาคม 2558</span>
				</div>

			</div>

		</div>


		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ระยะเวลาโครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<span class="project_intime_step3">45 วัน</span>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ลิ้งยูทูปโครงการ</span>
			</div>
			<div class="col-sm-4" style="padding:15px;">
				<span class="project_youtube_step3">http://www.youtube.com/smileforbaby</span>
			</div>

		</div>


		


		<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
			<div class="col-sm-2">
				<button class="form-control btn btn-warning" type="button" onClick="openDiv('step2createproject','step3createproject')" >ย้อนกลับ</button>
			</div>
			<div class="col-sm-10">
				<button class="form-control btn btn-success" type="submit" >สร้างโครงการ</button>
			</div>
		</div>

	</div><!--end create step 3-->

	
</div>
<?=form_close();?>


<script type="text/javascript">
	
	//goto step 1 2 3 create project
	function openDiv($divOpen, $divClose){

		$("."+$divOpen).css("display","inline-block");
		$("."+$divClose).css("display","none");


		//input value to step 3
        if($divOpen == "step3createproject"){

        	$(".project_name_step3").html($(".project_name").val());
        	if($(".project_type").val() == "ระดมทุน"){
        		$(".project_type_step3").html("ระดมสินทรัพย์");
        		$(".project_realdo_step3").html($(".project_realdo_fund").val());
        	}else{
        		$(".project_type_step3").html("รับบริจาค");
        		$(".project_realdo_step3").html($(".project_realdo_donate").val());
        	}	


        	$project_categoriesval = $(".project_categories").val();

        	$(".project_categories_step3").html($(".project_categories option[value='"+$project_categoriesval+"']").text());
        	$(".project_shortdescription_step3").html($(".project_shortdescription").val());
        	$(".project_objective_step3").html($(".project_objective").val());
        	$(".project_point_step3").html($(".project_point").val());
        	$(".project_address_step3").html("แขวง"+ $(".project_subdistrict").val() + " เขต"+ $(".project_district").val() + " จังหวัด"+ $(".project_country").val() + " ประเทศ"+ $(".project_province").val());
        	$(".project_deepdetail_step3").html($(".project_deepdetail").val());
        	$(".project_moneyexpect_step3").html($(".project_moneyexpect").val() + " บาท");
        	$(".project_itemexpect_step3").html($(".project_itemexpect").val());
        	
        	$(".project_intime_step3").html($(".project_intime").val() + " วัน");
        	$(".project_youtube_step3").html($(".project_youtube").val());
        	
        }

	}

	$(document).ready(function(){

	
		$img_copypersonalCardpath = "<?=$member_logindata['img_copypersonalCardpath']?>";
		$img_copyhomeBookpath = "<?=$member_logindata['img_copyhomeBookpath']?>";
		$backgroundCrm_pdfpath = "<?=$member_logindata['backgroundCrm_pdfpath']?>";
		
		if($img_copypersonalCardpath == "" && $img_copyhomeBookpath == "" && $backgroundCrm_pdfpath == ""){

			$(".boxcontent").css("display","none");
			$(".boxupload").css("display","block");

		}else{

			$(".boxcontent").css("display","block");
			$(".boxupload").css("display","none");

		}


		$convertprojecttype = "";

		if($(".project_type").val()=="ระดมทุน"){
			$convertprojecttype = "fundrasing";
		}else{
			$convertprojecttype = "donation";
		}

		//change display in step 2 or 3 when choose fundrasing or donation
		$(".div"+$convertprojecttype+"info").css("display","inline");
		$(".divdonationinfo").css("display","none");

		$(document).on('change','.project_type',function(){

			if($(".project_type").val()=="ระดมทุน"){
				$convertprojecttype = "fundrasing";
			}else{
				$convertprojecttype = "donation";
			}

            if($convertprojecttype == "fundrasing"){
				$(".divfundrasinginfo").css("display","inline");
				$(".divdonationinfo").css("display","none");
			}else{
				$(".divfundrasinginfo").css("display","none");
				$(".divdonationinfo").css("display","inline");
			}
        });



	});



</script>