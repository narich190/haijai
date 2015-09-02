<section class="col-sm-12" style="background:white;width:100%;min-height:100%;padding:7% 8%;">
	<?php
		// member of visitor <> member that creator
		if ($this->session->userdata['membersession']['member_id'] != ""){

			echo "<ul class='nav nav-tabs nav-justified'>";
			  	echo "<li role='presentation' ><a href=".base_url()."profile/index/".$this->session->userdata['membersession']['member_id'].">Home</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/receivenews'>การติดตาม</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/transproject'>จัดการโครงการ</a></li>";
		  		echo "<li role='presentation' class='active'><a href='".base_url()."profile/successactivity'>โครงการที่สำเร็จ</a></li>";
			echo "</ul>";
		}
	?>

	<style>
	.progress {
	    position: relative;
	}

	.progress-bar-info {
	    z-index: 1;
	    position: absolute;
	}

		.progress span {
	    position: absolute;
	    top: 0;
	    z-index: 3;
	    color: black; // You might need to change it
	    text-align: center;
	    width: 100%;
	}
	</style>


	
	<div class="col-sm-6" style="padding:2%;">
		<!--โครงการรับบริจาค-->
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>โครงการรับบริจาค</b></span></div>
		<?php
		if (count($donationproject)==0){
			echo "<a href=\"#\">
					<div class='col-sm-12' style='background:#C9CBCD;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>ยังไม่มีโครงการรับบริจาคของคุณในขณะนี้</span><br>
						</div>
					</div>
				</a>";
		}else{
			foreach ($donationproject as $key => $value) {
			echo "<a href=\"javascript:void(0)\" onClick=\"checkRequestfund('".$value['project_id']."','".$value['project_name']."')\">
					<div class='col-sm-12' id='projectbox".$value['project_id']."' style='background:#DBFAF3;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
						</div>
					</div>
				</a>";
			}
		}
		?>



		<!--โครงการระดมสินทรัพย์-->
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>โครงการระดมสินทรัพย์</b></span></div>
		
		<?php
		if (count($fundproject)==0){
			echo "<a href='javascript:void(0);'>
					<div class='col-sm-12' style='background:#C9CBCD;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>ยังไม่มีโครงการระดมสินทรัพย์ของคุณในขณะนี้</span><br>
						</div>
					</div>
				</a>";
		}else{
			foreach ($fundproject as $key => $value) {
			echo "<a href=\"javascript:void(0)\" onClick=\"checkRequestfund('".$value['project_id']."','".$value['project_name']."')\">
					<div class='col-sm-12' id='projectbox".$value['project_id']."' style='background:#FDE0E4;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>เป้าหมาย ".$value['money_expect']." บาท</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>จำนวนเงินที่มีการบริจาคเข้ามา ".$value['money_raising']." บาท</span><br>
							<div class='progress'>
  								<div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow=".$value['projectpercen']."aria-valuemin='0' aria-valuemax='100' style='width:".$value['projectpercen']."%'>
  								<span>".$value['projectpercen']."%  </span>
 								 </div>
							</div>	
						</div>
					</div>
				</a>";
			}
		}
		?>

	</div>

	<!--if hover project bg color is #F8A1AB-->

	<!--right box info profile-->
	<div class="col-sm-6" style="padding:2%;">
		
		<!--topic-->
		<div class="col-sm-12">
			<a href="<?=base_url()?>profile/successactivity" style="padding:0;">
				<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-primary" style="width:100%;padding:0;">การรับเงินและกิจกรรมประกาศ</button>
				</div>
			</a>
			<a href="<?=base_url()?>profile/reportactivity" style="padding:0;">
				<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-default" style="width:100%;padding:0;">รายงานปัญหา</button>
				</div>
			</a>

		</div>



		<!--content-->
		<div class="col-sm-12" >
			
			<div style="overflow:auto;width:100%;height:100%;">

				<?=form_open("project/requestfund");?>
				<div class="col-sm-12 " style="background:#EFF6E8;border-style: solid;border-width: 1px;padding:5px;">
					
					<div class="col-sm-12" style="margin:10px 0px;"><span style="font-size:16;color:#333333;padding:0;" class="requestprojectname">กรุณาเลือกโครงการที่ช่องด้านซ้าย</span></div>
					
					<div class="requestfundbox" style='display:none'>
						<input type="hidden" class="project_id_field" name="project_id" value=""/>
						<div class="col-sm-3"><span style="font-size:12;color:#333333;padding:0;">ชื่อธนาคาร</span></div>
						<div class="col-sm-9"><input type="text" name="project_account_bank" class="form-control" style="width:100%;"/></div>

						<div class="col-sm-3"><span style="font-size:12;color:#333333;padding:0;">ชื่อบัญชี</span></div>
						<div class="col-sm-9"><input type="text" name="project_account_name" class="form-control" style="width:100%;"/></div>

						<div class="col-sm-3"><span style="font-size:12;color:#333333;padding:0;">หมายเลขบัญชี</span></div>
						<div class="col-sm-9"><input type="text" name="project_account_id" class="form-control" style="width:100%;"/></div>
						<div class="col-sm-12"><button class="form-control btn btn-info" style="width:100%;margin-top:10px;">ส่งคำร้อง</button>
					</div>

					<!--TODO: Check there are already request in project-->

				</div>
				<?=form_close();?>

				<?=form_open_multipart("manageproject/createActivity");?>
				<!--activity detail-->
				<div class="col-sm-12 " style="background:white;border-style: solid;border-width: 1px;padding:5px;margin-top:10px;">
					<div style="width:100%;background:white;">
						<div class="requestactivitybox" style='display:none'>
							<input type="hidden" class="project_id_field" name="project_id" value=""/>
							<!--คำอธิบาย-->
							<div class="col-sm-12">
								<span style="font-size:16;color:#333333;padding:0;">
									<b>พิมพ์ข้อความหรือแนบไฟล์รูป เพื่อทำการบันทึกข้อมูลกิจกรรมประกาศของคุณได้ที่นี่</b>
								</span><br>
								<span style="font-size:12;color:#333333;padding:0;">
									รายละเอียดกิจกรรมประกาศ
								</span>
							</div>

							<!--content1-->
							<div class="col-sm-12" style="padding:5px;">
								<textarea class="form-control" name="activity_deepdetail" style="width:100%;height:200px;">

								</textarea>
							</div>

							<!--content upload file-->
							<div class="col-sm-4" style="padding:5px;">
								<span style="font-size:12;color:#333333;padding:0;">
									ลิ้งยูทูปโครงการ
								</span>
							</div>
							<div class="col-sm-8" style="padding:5px;">
								<input type="text" name="video_detailpath" class="form-control" />
							</div>


							<!--content upload file-->
							<div class="col-sm-4" style="padding:5px;">
								<span style="font-size:12;color:#333333;padding:0;">
									รูปภาพหลักโครงการ
								</span>
							</div>
							<div class="col-sm-8" style="padding:5px;">
								<input type="file" name="activity_img_detailpath" class="form-control" />
							</div>

							<!--content upload file-->
							<div class="col-sm-4" style="padding:5px;">
								<span style="font-size:12;color:#333333;padding:0;">
									เอกสารโครงการ
								</span>
							</div>
							<div class="col-sm-8" style="padding:5px;">
								<input type="file" name="activity_pdfpath" class="form-control" />
							</div>


							<!--button submit update-->
							<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:5px;">
								<button class="form-control btn btn-warning" style="width:100%;">สร้างประกาศ</button>
							</div>
						</div>
						<div class="waitactivitybox" style='display:none'>
							<!--คำอธิบาย-->
							<div class="col-sm-12">
								<span style="font-size:16;color:#333333;padding:0;">
									<b>รายละเอียดกิจกรรมประกาศ</b>
								</span><br>
								<span style="font-size:12;color:#333333;padding:0;">
									<b>สถานะคำร้อง:</b> <span class='activity_status'></span><br>
									<b>เนื้อหา:</b> <span class='activity_deepdetail'></span><br>
									<b>วันที่ส่งคำร้อง:</b> <span class='activity_request'></span><br>
									<b>วันที่อนุมัติ:</b> <span class='activity_approved'></span><br>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?=form_close();?>


				
				
			</div>

		</div>

	</div>

	
</section>

<script type="text/javascript">

	function checkRequestfund($project_id, $project_name){
    	
		$(".requestprojectname").text("โครงการ: "+$project_name);
		//$("#projectbox"+$project_id).css("background","#F8A1AB")

	    $.ajax({
	      url: "http://localhost/haijai/project/checkRequestfund",
	      type:"POST",
	      cache:false,
	      data:{
	        project_id: $project_id,
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
	      	//insert project id 
	      	$(".project_id_field").val($project_id);
	      	if(result!=''){
	      		$(".requestfundbox").css("display","none");
	      	}else{
	      		$(".requestfundbox").css("display","block");
	      	}

	      	checkSendRequestActivity($project_id);

	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });  


	  }

	  function checkSendRequestActivity($project_id){
	  	 $.ajax({
	      url: "http://localhost/haijai/project/checkSendRequestActivity",
	      type:"POST",
	      cache:false,
	      data:{
	        project_id: $project_id,
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
	      	//insert project id 
	      	if(result.length == 0){
	      		$(".requestactivitybox").css("display","block");
	      		$(".waitactivitybox").css("display","none");
	      	}else{
	      		$(".requestactivitybox").css("display","none");
	      		$(".waitactivitybox").css("display","block");

	      		$(".activity_status").text(result[0].activity_status);
	      		$(".activity_deepdetail").text(result[0].activity_deepdetail);
	      		$(".activity_request").text(result[0].activity_request);
	      		if(result[0].activity_approved == null){
	      			$(".activity_approved").text("ยังไม่ได้รับการอนุมัติ");
	      		}else{
	      			$(".activity_approved").text(result[0].activity_approved);
	      		}

	      	}
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });  

	  }




</script>
