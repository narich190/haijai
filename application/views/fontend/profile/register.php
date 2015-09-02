<!--Header-->
<div class="container" style="margin-top:20px;margin-bottom:20px;">
	
	 <h2 align="left">สมัครสมาชิก</h2>

</div><!-- /.container -->



<?=form_open_multipart("register/savemember");?>
<div class="container" style="margin-bottom:20px;">
	<!--step1-->
	<div class="step1register">

		<div class="col-sm-12">
			<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลพื้นฐาน</button>
			</div>
			<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-default" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ยืนยันความถูกต้องข้อมูล</button>
			</div>
		</div>
		
		
		<div class="col-sm-6">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อสมาชิก</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<input type="text" class="form-control member_name" name="member_name" style="width:100%;" placeholder="เช่น นายน้องแมน น้ำใจ"/>
			</div>
			
			<div class="col-sm-12" ></div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อเข้าระบบ</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<input type="text" class="form-control username" name="username" style="width:100%;" placeholder="เช่น mamiman"/>
			</div>

			<div class="col-sm-12" ></div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รหัสผ่าน</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<input type="text" class="form-control password" name="password" style="width:100%;" placeholder="เช่น ความยาวตั้งแต่ 8 หลักขึ้นไป"/>
			</div>

		</div>

		<div class="col-sm-6">
			
			<div class="col-sm-12" style="text-align:center;margin-top:20px;">
                    <input type='file' name="img_profilepath" id="imgInpregister" style="margin:0 auto;height:0px;overflow:hidden;border:0;"/>
                    <img id="blahregister" src="<?=base_url()?>assets/img/main/slipupload.png" onclick="chooseFileregister();" alt="your image" style="width:40%;height:20%;" />
                    <br><br>
                    <div class="buttonUplaod" style="width:100%;display:none;"> 
                    	<button class="btn btn-warning" type="button" onClick="chooseFileregister();" style="width:50%">เปลี่ยนรูป</button>
                    </div>
            </div>

		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ประวัติส่วนตัว</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<textarea class="form-control biology" name="biography" style="width:100%;height:150px;resize: none;">

				</textarea>
			</div>


			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">สถานที่ติดต่อได้</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<textarea class="form-control location" name="location" style="width:100%;height:150px;resize: none;">

				</textarea>
			</div>

			<div class="col-sm-12">
				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">อีเมลล์</span>
				</div>
				<div class="col-sm-5" style="padding:15px;">
					<input type="text" class="form-control member_email" name="email" style="width:100%;" placeholder="เช่น mamiman@mail.com"/>
				</div>
				
				<div class="col-sm-1" style="padding:15px;">
					<input type="checkbox" class="form-control receiveemailnews" value='yes' name="receiveemailnews" style="width:100%;" placeholder="เช่น mamiman@mail.com"/>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">ต้องการรับข่าวสารผ่านทางอีเมล์</span>
				</div>
			</div>
		
			<div class="col-sm-12">
				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">หมวดหมู่โครงการที่สนใจ</span>
				</div>
				<div class="col-sm-4" style="padding:15px;">
					<select  name="project_group_projectgroup_id" class="groupinterest" style="width:100%;">
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

				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">ไฟล์เอกสารเพื่อสังคมในอดีต</span>
				</div>

				<div class="col-sm-4" style="padding:15px;">
					<input type="file" class="form-control society_doc" name="backgroundCrm_pdfpath" style="width:100%;" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;"  >อัพโหลดสำเนาบัตรประชาชน</span>
				</div>

				<div class="col-sm-4" style="padding:15px;">
					<input type="file" class="form-control personalid_doc" name="img_copypersonalCardpath" style="width:100%;" />
				</div>
				<div class="col-sm-2" style="padding:15px;">
					<span style="font-size:16;color:#253747;padding:0;">อัพโหลดสำเนาทะเบียนบ้าน</span>
				</div>

				<div class="col-sm-4" style="padding:15px;">
					<input type="file" class="form-control home_doc" name="img_copyhomeBookpath" style="width:100%;" />
				</div>
			</div>

		</div>


		<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
			<div class="col-sm-12">
				<button class="form-control btn btn-success" type="button" onClick="openDiv('step2register','step1register')" >ถัดไป</button>
			</div>
		</div>

	</div><!--end create step 1-->


	<!--step2-->
	<div class="step2register" style="display:none;">
		
		<div class="col-sm-12">
			<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ข้อมูลพื้นฐาน</button>
			</div>
			<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
			    <button class="btn btn-primary" disabled style="width:100%;padding:0;height:40px;border-radius:0;border:0;border-style:none;">ยืนยันความถูกต้องข้อมูล</button>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อสมาชิก</span>
			</div>
			<div class="col-sm-2" style="padding:15px;">
				<span class="member_name_3" style="width:100%;"></span>	
			</div>
		
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ชื่อเข้าระบบ</span>
			</div>
			<div class="col-sm-2" style="padding:15px;">
				<span class="username_3" style="width:100%;"></span>
			</div>

			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">รหัสผ่าน</span>
			</div>
			<div class="col-sm-2" style="padding:15px;">
				<span class="password_3" style="width:100%;"></span>
			</div>

		</div>

		
		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">ประวัติส่วนตัว</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="biology_3" style="width:100%;"></span>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-2" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">สถานที่ติดต่อได้</span>
			</div>
			<div class="col-sm-10" style="padding:15px;">
				<span class="location_3" style="width:100%;"></span>
			</div>

		</div>	
		<div class="col-sm-5">
			<div class="col-sm-4" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">อีเมลล์</span>
			</div>
			<div class="col-sm-8" style="padding:15px;">
				<span class="member_email_3" style="width:100%;"></span>
			</div>
		
		</div>
		<div class="col-sm-7">
			<div class="col-sm-5" style="padding:15px;">
				<span style="font-size:16;color:#253747;padding:0;">หมวดหมู่โครงการที่สนใจ</span>
			</div>
			<div class="col-sm-7" style="padding:15px;">
				<span class="groupinterest_3" style="width:100%;"></span>
			</div>
		
		</div>


		<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
			<div class="col-sm-2">
				<button class="form-control btn btn-warning" type="button" onClick="openDiv('step1register','step2register')" >ย้อนกลับ</button>
			</div>
			<div class="col-sm-10">
				<button class="form-control btn btn-success" type="submit" >สมัครสมาชิก</button>
			</div>
		</div>

	</div><!--end create step 3-->

	
</div>
<?=form_close();?>


<script type="text/javascript">


	  function chooseFileregister(){
	    $("#imgInpregister").click();
	  }

	  function readURL(input) {

	      if (input.files && input.files[0]) {
	          var reader = new FileReader();

	          reader.onload = function (e) {
	              $('#blahregister').attr('src', e.target.result);
	          }

	          reader.readAsDataURL(input.files[0]);
	      }

	      $(".buttonUplaod").css("display","inline-block");
	  }

	  $("#imgInpregister").change(function(){
	      //alert("sldjshd");
	      readURL(this);
	  });


	
	//goto step 1 2 3 create project
	function openDiv($divOpen, $divClose){

		$("."+$divOpen).css("display","inline-block");
		$("."+$divClose).css("display","none");


		//input value to step 3
        if($divOpen == "step2register"){

        	
        	$(".member_name_3").html($(".member_name").val());
        	$(".username_3").html($(".username").val());
        	$(".password_3").html($(".password").val());
        	$(".biology_3").html($(".biology").val());
        	$(".location_3").html($(".location").val());
        	$(".member_email_3").html($(".member_email").val());
			
			$(".groupinterest_3").html($(".groupinterest option:selected").text());

					
        }

	}

	$(document).ready(function(){

		//change display in step 2 or 3 when choose fundrasing or donation
		$(".div"+$(".project_type").val()+"info").css("display","inline");
		$(".divdonationinfo").css("display","none");

		$(document).on('change','.project_type',function(){
            if($(".project_type").val() == "fundrasing"){
				$(".divfundrasinginfo").css("display","inline");
				$(".divdonationinfo").css("display","none");
			}else{
				$(".divfundrasinginfo").css("display","none");
				$(".divdonationinfo").css("display","inline");
			}
        });



	});





</script>