<section class="col-sm-12" style="background:white;width:100%;min-height:100%;padding:7% 8%;">
	<?php
		// member of visitor <> member that creator
		if ($this->session->userdata['membersession']['member_id'] != ""){

			echo "<ul class='nav nav-tabs nav-justified'>";
			  	echo "<li role='presentation' ><a href=".base_url()."profile/index/".$this->session->userdata['membersession']['member_id'].">Home</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/receivenews'>การติดตาม</a></li>";
		  		echo "<li role='presentation' class='active'><a href='".base_url()."profile/transproject'>จัดการโครงการ</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/successactivity'>โครงการที่สำเร็จ</a></li>";
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
			echo "<a href=\"javascript:void(0)\" onClick=\"chooseProject('".$value['project_id']."','".$value['project_name']."','".$value['project_type']."')\">
					<div class='col-sm-12' id='projectbox".$value['project_id']."' style='background:#DBFAF3;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span><br>
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
			echo "<a href=\"javascript:void(0)\" onClick=\"chooseProject('".$value['project_id']."','".$value['project_name']."','".$value['project_type']."')\">
					<div class='col-sm-12' id='projectbox".$value['project_id']."' style='background:#FDE0E4;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>เป้าหมาย ".$value['money_expect']." บาท</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>จำนวนเงินที่มีการบริจาคเข้ามา ".$value['money_raising']." บาท</span><br>
							<span style='font-size:12;color:#333333;padding:0;'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span><br>
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

	<!--right box info profile-->
	<div class="col-sm-6" style="padding:2%;">
		
		<!--topic-->
		<div class="col-sm-12">
			<a href="<?=base_url()?>profile/transproject" style="padding:0;">
				<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-default" style="width:100%;padding:0;">ทรานแซคชั่น</button>
				</div>
			</a>
			<a href="<?=base_url()?>profile/updateproject" style="padding:0;">
				<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-primary" style="width:100%;padding:0;">อัพเดทโครงการ</button>
				</div>
			</a>
			<a href="<?=base_url()?>profile/reportproject" style="padding:0;">
				<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-default" style="width:100%;padding:0;">รายงานปัญหา</button>
				</div>
			</a>

		</div>

		<!--content-->
		<div class="col-sm-12" >
			
			<div style="overflow:auto;width:100%;height:100%;background:#C4D3E3;">
			<?=form_open_multipart("project/updateproject");?>
				<div class="col-sm-12" style="margin:10px 0px;">
					<input type="hidden" name="project_id" class="project_id"/>
					<span style="font-size:16;color:#333333;padding:0;" class="requestprojectname">
						กรุณาเลือกโครงการที่ช่องด้านซ้าย
					</span>
				</div>
				
				<div class="updatebox">
					<!--คำอธิบาย-->
					<div class="col-sm-12">
						<span style="font-size:16;color:#333333;padding:0;">
							<b>พิมพ์ข้อความหรือแนบไฟล์รูป เพื่ออัพเดทข่าวสารของโครงการของคุณได้ที่นี่</b>
						</span>
					</div>


					<!--content1-->
					<div class="col-sm-12" style="padding:10px;">
						<textarea class="form-control" name="detail" style="width:100%;height:200px;">

						</textarea>
					</div>

					<!--content upload file-->
					<div class="col-sm-12" style="padding:0 10 10 10px;">
						<input type="file" name="img_detailpath" class="form-control" />
					</div>

					<!--button submit update-->
					<div class="col-sm-12" style="padding:0 10 10 10px;">
						<button class="form-control btn btn-warning" style="width:100%;">อัพเดท</button>
					</div>
				</div>
			<?=form_close();?>
				
				<div class="col-sm-12" style="height:10px;"></div>
				
				<div class="staffbox" >
					<!--คำอธิบาย-->
					<div class="col-sm-12">
						<span style="font-size:16;color:#333333;padding:0;">
							<b>สต๊าฟของโครงการ</b>
						</span>
					</div>
			
					
					<div class="col-md-12" >
					    <div class="input-group">
					        <input type="text" id="searchstaffbox" class="form-control" aria-label="..." placeholder="ค้นหาสมาชิก" >
					        <span class="input-group-addon">
					            <i class="fa fa-search"></i>
					        </span>
					                
					    </div><!-- /input-group -->
					    <table class="table table-hover" id="searchstafftable">
					              
					    </table>
					</div>

					<div class='staffboxcentent'>

						

					</div>

					

				</div>


			</div>
		</div>


	</div>


</section>



<script type="text/javascript">
	$(document).ready(function(){
		
		$(".updatebox").css("display","none");
		$(".staffbox").css("display","none");
		
	});

	function chooseProject($project_id, $project_name,$project_type){

		$(".requestprojectname").text("โครงการ: "+$project_name);
		$(".project_id").val($project_id);
		$(".report_type").val($project_type);

		//getReportProjectdata($project_id);

		$(".updatebox").css("display","block");
		$(".staffbox").css("display","block");

		getStaffinProjectInfo($project_id);
		
	}

	function getStaffinProjectInfo($project_id){

				$.ajax({
					
					url:"http://localhost/haijai/project/getStaffinProjectInfo",
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
						//alert(result);
						$htmlval = "";
						
						result.forEach(function(entry) {
							//alert(entry['member_name']);
							
						    //$htmlval += "<tr><td class='success' style='width:80%;'>"+entry['member_name']+"</td><td class='success' style='width:20%;'><button class='btn btn-primary'  onClick=\"selectStafftoProject(\'"+entry['member_id']+"\',\'"+$(".project_id").val()+"\');\" style='float:right;width:100%;'>Choose</button></td></tr>";
							$htmlval += "<a href='<?=base_url()?>profile/index/"+entry['member_id']+"' >"+
											"<div class='col-sm-11' style='background:#fffafa;border-style: solid;border-width: 1px;position:relative;margin:0 12 2 12;'>"+
								    			"<div class='col-sm-11'>"+
								    				"<div class='col-sm-3'>"+
														"<img src='<?=base_url()?>assets/img/profile/"+entry['img_profilepath']+"' style='width:50px;height:50px;'/>"+
								    				"</div>"+
								    				"<div class='col-sm-9'>"+
														"<span style='font-size:14;color:#333333;padding:0;'>"+entry['member_name']+"</span><br>"+
														"<span style='font-size:12;color:#333333;padding:0;'>"+entry['status']+"</span>"+
													"</div>"+
												"</div>"+
												"<a href='javascript:void(0);'  onClick=\"deleteStaffinProject(\'"+entry['project_id']+"\',\'"+entry['member_id']+"\')\" style='position:absolute;z-index:1;top:0;right:0;'><i class='fa fa-times-circle' style='color:red;'></i></a>"+
											"</div>"+
										"</a>";
							
						});

						$(".staffboxcentent").html($htmlval);
						
					},
					
				
				});

	}

	

	function deleteStaffinProject($project_id, $member_id){
			$.ajax({
					
					url:"http://localhost/haijai/project/deleteStaffinProjectInfo",
					type:"POST",
					cache:false,
					data:{
						project_id: $project_id,
						member_id: $member_id,
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
						alert(result);
						window.location.reload();
					},
					
				
				});
	}

</script>