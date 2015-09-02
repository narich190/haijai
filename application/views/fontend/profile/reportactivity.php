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
			echo "<a href=\"javascript:void(0)\" onClick=\"chooseProject('".$value['project_id']."','".$value['project_name']."','".$value['project_type']."')\">
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
			echo "<a href=\"javascript:void(0)\" onClick=\"chooseProject('".$value['project_id']."','".$value['project_name']."','".$value['project_type']."')\">
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

	<!--right box info profile-->
	<div class="col-sm-6" style="padding:2%;">
		
		<!--topic-->
		<div class="col-sm-12">
			<a href="<?=base_url()?>profile/successactivity" style="padding:0;">
				<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-default" style="width:100%;padding:0;">การรับเงินและกิจกรรมประกาศ</button>
				</div>
			</a>
			<a href="<?=base_url()?>profile/reportactivity" style="padding:0;">
				<div class="col-sm-6" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-primary" style="width:100%;padding:0;">รายงานปัญหา</button>
				</div>
			</a>

		</div>


		<!--content-->
		<div class="col-sm-12" >
			
			<div style="overflow:auto;width:100%;height:100%;background:#C4D3E3;">

				<div class="col-sm-12" style="margin:10px 0px;">
					<span style="font-size:16;color:#333333;padding:0;" class="requestprojectname">
						กรุณาเลือกโครงการที่ช่องด้านซ้าย
					</span>
				</div>
				
				
				<!--evidence-->
				<div class="col-sm-12 collapse" id="receiveevidence" style="background:white;border-style: solid;border-width: 1px;padding:5px;">
				<?=form_open_multipart("manageproblem/adminresponse");?>
					<input type="hidden" class="project_id" name="project_id"/>
					<input type="hidden" class="report_type" name="report_type"/>
					<input type="hidden" class="report_id" name="report_id"/>

					<div style="width:100%;background:white;">
						<!--คำอธิบาย-->
						<div class="col-sm-12">
							<span style="font-size:16;color:#333333;padding:0;">
								<b>พิมพ์ข้อความหรือแนบไฟล์รูป เพื่อทำการยืนยันข้อเท็จจริงของปัญหาดังกล่าว</b>
							</span>
						</div>


						<!--content1-->
						<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:5px;">
							<textarea class="form-control" name="response_detail" style="width:100%;height:200px;">

							</textarea>
						</div>

						<!--content upload file-->
						<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:5px;">
							<input type="file" name='response_filepath' class="form-control" />
						</div>

						<!--button submit update-->
						<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:5px;">
							<button class="form-control btn btn-warning" style="width:100%;">อัพเดท</button>
						</div>
					</div>
				</div>
				<?=form_close();?>

				<div class="reportSuccessProjectdata">
					<!--response report will show here:-->
				</div>
	
				
				
			</div>

		</div>

	</div>

	
</section>


<script type="text/javascript">


	function chooseProject($project_id, $project_name,$project_type){

		$(".requestprojectname").text("โครงการ: "+$project_name);
		$(".project_id").val($project_id);
		$(".report_type").val($project_type);

		getReportSuccessProjectdata($project_id);


	}

	function InsertReportIDtomodal($report_id){

		$(".report_id").val($report_id);

	}	

	function getReportSuccessProjectdata($project_id){

		$.ajax({
	      url: "http://localhost/haijai/project/getReportSuccessProjectdata",
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
	      	
	      		$pukval = "";
                
                for($i=0;$i<result.length;$i++){
                    //$result[$i].response_topic + ", ";  
                	$pukval += "<a href='javascript:void(0);' data-toggle='collapse' data-target='#receiveevidence' onClick='InsertReportIDtomodal("+result[$i].report_id+");' ><div class='col-sm-12 report1' style='background:#EFF6E8;border-style: solid;border-width: 1px;padding:5px;'>"+
									"<span style='font-size:12;color:#333333;padding:0;'>"+
									result[$i].response_detail + " <?=('"+result[$i].response_filepath+"' == '' ? ' ' : '<a href=\"http://localhost/haijai/assets/backend/images/reportdoc/"+result[$i].response_filepath+"\">"+result[$i].response_filepath+"</a>' )?>"+
									"</span><br>"+
									"<span style='font-size:12;color:#333333;padding:0;'>"+
										"แจ้ง ณ วันที่ "+result[$i].response_create+
									"</span><br>"+
								"</div></a>";
                        
                }

                $('.reportSuccessProjectdata').html($pukval);
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });

	}

	




</script>