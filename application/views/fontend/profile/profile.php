<section class="col-sm-12" style="background:white;padding:7% 8%;">

	<?php
		if($this->session->userdata('membersession')!=""){	
			// member of visitor <> member that creator
			if ($this->session->userdata['membersession']['member_id'] == $memberdata[0]['member_id']){

				echo "<ul class='nav nav-tabs nav-justified'>";
				  	echo "<li role='presentation' class='active'><a href=".base_url()."profile/index/".$this->session->userdata['membersession']['member_id'].">Home</a></li>";
			  		echo "<li role='presentation'><a href='".base_url()."profile/receivenews'>การติดตาม</a></li>";
			  		echo "<li role='presentation'><a href='".base_url()."profile/transproject'>จัดการโครงการ</a></li>";
			  		echo "<li role='presentation'><a href='".base_url()."profile/successactivity'>โครงการที่สำเร็จ</a></li>";
				echo "</ul>";
			}
		}
	?>


	<!--left box picture profile-->
	<div class="col-sm-12">
		
			
				<?php
					if($this->session->userdata('membersession')!=""){	

						// member of visitor <> member that creator
						if ($this->session->userdata['membersession']['member_id'] <> $memberdata[0]['member_id']){

							//if look another profile: see only follow
							echo "<div class='col-sm-10'></div>";

							if(count($followprojectdata)==0){
								
								echo "<div class='col-sm-2' onclick=\"followmember('".$memberdata[0]['member_id']."','follow')\" style='padding:0;'><button class='btn btn-info' style='width:100%;'>ติดตาม</button></div>";
									
							}else{
								$checkfollowyet = 'notfollowing';
								foreach ($followprojectdata as $key => $value) {
									if($value['member_memberfollow_id']==$memberdata[0]['member_id'] and $value['follow_type']=='member' and $value['member_member_id']== $this->session->userdata['membersession']['member_id']){
										echo "<div class='col-sm-2' onclick=\"followmember('".$memberdata[0]['member_id']."','unfollow')\" style='padding:0;'><button class='btn btn-info' style='width:100%;'>กำลังติดตาม&nbsp;<i class='fa fa-check-square-o'></i></button></div>";
										$checkfollowyet = 'following';
									}
								}
								if($checkfollowyet == 'notfollowing'){
									echo "<div class='col-sm-2' onclick=\"followmember('".$memberdata[0]['member_id']."','follow')\" style='padding:0;'><button class='btn btn-info' style='width:100%;'>ติดตาม</button></div>";
								}

							}

						}else{
							// if look own profile
							echo "<div class='col-sm-8'></div>";
							echo "<div class='col-sm-2' style='padding:0;margin:0;'><button class='btn btn-danger' style='width:100%;' data-toggle='modal' data-target='#pass".$this->session->userdata['membersession']['member_id']."' >เปลี่ยนรหัสผ่าน</button></div>
								 <div class='col-sm-2' style='padding:0;margin:0;'><button class='btn btn-primary' style='width:100%;' onclick='edituserinfo();'>แก้ไขข้อมูล</button></div>";

						}
					}

				?>
				
				

	</div>

	<div id='pass<?=$this->session->userdata['membersession']['member_id']?>'  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class='modal'>

		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<div class="modal-header" style="background:#d9534f;color:white;">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">เปลี่ยนรหัสผ่าน</h4>
		      	</div>
		    	<div class="modal-body" style="width:100%;height:300px;padding:50px;">
		
		      		<div class="col-sm-12">
		      			<div class="col-sm-4">
		      				<span style='font-size:16px;'>รหัสผ่านเก่า</span>
		      			</div>
		      			<div class="col-sm-8">
		      				<input type="text" class="form-control oldpassword" name="oldpassword"/>
		      			</div>
		      			<div class="col-sm-4">
		      				<span style='font-size:16px;'>รหัสผ่านใหม่</span>
		      			</div>
		      			<div class="col-sm-8">
		      				<input type="text" class="form-control newpassword" name="newpassword"/>
		      			</div>
		      			<div class="col-sm-4">
		      				<span style='font-size:16px;'>รหัสผ่านใหม่อีกครั้ง</span>
		      			</div>
		      			<div class="col-sm-8">
		      				<input type="text" class="form-control renewpassword" />
		      			</div>
		      			<div class="col-sm-12" style="margin:10px 0px;">
		      			</div>
		      			<div class="col-sm-4 ">
		      				<span class="errorchange" style="color:red;"></span>
		      			</div>
		      			<div class="col-sm-8">
		      				<button class='btn btn-danger' type="button" onclick="changepassword(<?=$this->session->userdata['membersession']['member_id']?>);" style='width:100%;'  >บันทึก</button>
		      			</div>
		      		</div>

		      	</div>
		    </div>
	  	</div>

	</div>

	
	<!--left box picture profile-->
	<div class="col-sm-3 col-sm-offset-1" style="padding:2%;">
		
			<div class="imageold" >
				<img class="img-responsive img-thumbnail center-block" src="<?=base_url()?>assets/img/profile/<?=$memberdata[0]['img_profilepath'];?>" s/>
			</div>
			<div class="imagenew" style="position:relative;display:none;">
	            <img id="blahuserinfo" src="<?=base_url()?>assets/img/profile/<?=$memberdata[0]['img_profilepath'];?>" onclick="chooseFileuser();" alt="your image" style="width:100%;height:50%;" />
	            <br><br>
	            <div style="background:rgba(0,0,0,0.8);color:white;bottom:0;position:absolute;width:100%;text-align:center;height:50px;padding:10px;">กรุณากดที่รูปเพื่อเปลี่ยนรูป</div>
	        </div>

		
	</div>


	<!--right box info profile-->
	<div class="col-sm-7 olduserinfo" style="padding:2%;">
		<div style="background:#C4D3E3;padding:10px;">
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ชื่อ</u></b>
				<br><?=$memberdata[0]['member_name'];?>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ที่อยู่</u></b>
				<br><?=$memberdata[0]['location'];?>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ประวัติ</u></b>
				<br><?=$memberdata[0]['biography'];?>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>อีเมลล์</u></b><?=$memberdata[0]['email'];?>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>หมวดหมู่โครงการที่สนใจ</u></b><?=$memberdata[0]['projectgroup_name'];?>
			</span>
		</div>

	</div>

	<!--right box edit info profile-->
	<div class="col-sm-7 newuserinfo" style="padding:2%;display:none;">
		<div style="background:#C4D3E3;padding:10px;">
        <?=form_open_multipart("profile/updateuserInfo");?>

			<input type="hidden" name="member_id" value="<?=$memberdata[0]['member_id'];?>"/>
			<!--image profile-->
			<input type='file' id="imguserinfo" name="img_profilepath" style="margin:0 auto;height:0px;overflow:hidden;border:0;"/>

			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ชื่อ</u></b>
				
				<input type="text" name="member_name" style="width:100%;" value="<?=$memberdata[0]['member_name'];?>"/>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ที่อยู่</u></b>
				<br>
				<textarea name="location" style="width:100%;" ><?=$memberdata[0]['location'];?></textarea>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ประวัติ</u></b>
				<br>
				<textarea name="biography" style="width:100%;" ><?=$memberdata[0]['biography'];?></textarea>
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>อีเมลล์</u></b>
				<input type="text" name="email" style="width:100%;" value="<?=$memberdata[0]['email'];?>"/>
				
			</span>
			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>หมวดหมู่โครงการที่สนใจ </u></b>
			</span>
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
				
				<script type="text/javascript">
					$(document).ready(function(){
						var selectval = "<?=$memberdata[0]['project_group_projectgroup_id'];?>";
						$("select option").filter(function() {
						    //may want to use $.trim in here
						    return $(this).val() == selectval; 
						}).prop('selected', true);
					});
					

				</script>

			<br>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>ไฟล์เอกสารเพื่อสังคมในอดีต</u></b>
				<input type="file" name="backgroundCrm_pdfpath" style="width:100%;" />
			</span>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>อัพโหลดสำเนาบัตรประชาชน</u></b>
				<input type="file" name="img_copypersonalCardpath" style="width:100%;" />
			</span>
			<span style="font-size:16;color:#253747;padding:0;">
				<b><u>อัพโหลดสำเนาทะเบียนบ้าน</u></b>
				<input type="file" name="img_copyhomeBookpath" style="width:100%;" />
			</span>
			<br>
			
			<button class="btn btn-success form-control" style="margin-top:5px;width:100%;">บันทึก</button>
			<?=form_close();?>
		</div>

	</div>

	<div class="col-sm-12">
		<?php
			if($this->session->userdata('membersession')!=""){	
				// member of visitor <> member that creator
				if ($this->session->userdata['membersession']['member_id'] <> $memberdata[0]['member_id']){
					echo "<input type='hidden' name='refer_id' class='refer_id' value=''/>
	 					<input type='hidden' name='whotalk' class='whotalk' value='tomember'/>
	 					<input type='hidden' name='member_member_id' class='member_member_id' value='".$memberdata[0]['member_id']."' />
	 					<input type='hidden' name='sender_member_id' class='sender_member_id' value='".$this->session->userdata['membersession']['member_id']."' />";

					echo "<textarea class='form-control msg_detail' name='msg_detail' style='width:100%;height:100px;'>

						</textarea>
						<br>
						<button class='form-control btn btn-warning' onclick='saveMess()'' type='button'>ส่งข้อความ</button>";

				}
			}
		?>
	</div>


</section>


<script type="text/javascript">
	

	function followmember($memberfollow_id, $action){
    	

	    $.ajax({
	      url: "http://localhost/haijai/profile/followmember",
	      type:"POST",
	      cache:false,
	      data:{
	        memberfollow_id: $memberfollow_id,
	        action: $action,
	      },
	      dataType:"JSON",
	      /*
	      beforeSend: function (event, files, index, xhr, handler, callBack) {
	        $.ajax({
	          async: false,
	          url: 'http://sagaso.asia/dash/bugsafari' // add path
	        });
	      },
	      */
	      success:function(result){
	      	window.location.reload();
	      	
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });  


	}

	function changepassword($member_id){
    	
		if($(".newpassword").val() != $(".renewpassword").val()){
			$(".errorchange").text("รหัสผ่านใหม่ไม่ตรงกัน");
    	}else{
		    $.ajax({
		      url: "http://localhost/haijai/profile/changepassword",
		      type:"POST",
		      cache:false,
		      data:{
		        member_id: $member_id,
		        oldpassword: $(".oldpassword").val(),
		        newpassword: $(".newpassword").val(),
		      },
		      dataType:"JSON",
		      /*
		      beforeSend: function (event, files, index, xhr, handler, callBack) {
		        $.ajax({
		          async: false,
		          url: 'http://sagaso.asia/dash/bugsafari' // add path
		        });
		      },
		      */
		      success:function(result){
		      	if(result != "เปลี่ยนรหัสผ่านเรียบร้อย"){
					$(".errorchange").text("รหัสผ่านเก่าไม่ถูกต้อง");
		      	}else{
		      		alert(result);
	        		window.location.reload();
					$(".errorchange").text("");
		      	}
		   
		      },
		      error:function(err){
		        alert("ERROR : "+err);
		      }
		                    
		    });  
		}

	}


	function chooseFileuser(){
	    $("#imguserinfo").click();
	}

	  function readURL(input) {

	      if (input.files && input.files[0]) {
	          var reader = new FileReader();

	          reader.onload = function (e) {
	              $('#blahuserinfo').attr('src', e.target.result);
	          }

	          reader.readAsDataURL(input.files[0]);
	      }

	  }

	  $("#imguserinfo").change(function(){
	      //alert("sldjshd");
	      readURL(this);
	  });

	  var roundedituserinfo = 1;
	  function edituserinfo(){
	  	if (roundedituserinfo == 1){
	  		$(".imageold").css("display","none");
	  		$(".olduserinfo").css("display","none");

	  		$(".imagenew").css("display","block");
	  		$(".newuserinfo").css("display","block");

	  		roundedituserinfo = 2;
	 	}else{
	 		$(".imageold").css("display","block");
	  		$(".olduserinfo").css("display","block");

	  		$(".imagenew").css("display","none");
	  		$(".newuserinfo").css("display","none");

	  		roundedituserinfo = 1;
	  	}

	  	
	  }

	  function saveMess(){

		$.ajax({
	      url: "http://localhost/haijai/messagebox/saveMessage",
	      type:"POST",
	      cache:false,
	      data:{
	        refer_id: "",
	        whotalk: $(".whotalk").val(),
	        member_member_id: $(".member_member_id").val(),
	        sender_member_id: $(".sender_member_id").val(),
	        msg_detail: $(".msg_detail").val(),
	      },
	      dataType:"JSON",
	      /*
	      beforeSend: function (event, files, index, xhr, handler, callBack) {
	        $.ajax({
	          async: false,
	          url: 'http://sagaso.asia/dash/bugsafari' // add path
	        });
	      },
	      */
	      success:function(result){
	      	
		  	window.location.replace("http://localhost/haijai/messagebox");

	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });
				


	}

</script>