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
			echo "<a href=\"javascript:void(0)\" onClick=\"chooseProjectDonation('".$value['project_name']."')\">
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
					<div class='col-sm-12' id='projectbox".$value['project_id']."' style='background:#FDE0E4;border-style: solid;border-width: 1px;padding:0;'>
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
	    			<button class="btn btn-primary" style="width:100%;padding:0;">ทรานแซคชั่น</button>
				</div>
			</a>
			<a href="<?=base_url()?>profile/updateproject" style="padding:0;">
				<div class="col-sm-4" style="background:#FDE0E4;padding:0;">
	    			<button class="btn btn-default" style="width:100%;padding:0;">อัพเดทโครงการ</button>
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
				
				<div class="col-sm-12" style="margin:10px 0px;">
					<input type="hidden" name="project_id" class="project_id"/>
					<span style="font-size:16;color:#333333;padding:0;" class="requestprojectname">
						กรุณาเลือกโครงการที่ช่องด้านซ้าย
					</span>
				</div>


				<div class="donationProjectdata">
					<!--donalog will show here:-->
				</div>

				
			</div>

		</div>


	</div>

	
</section>




<script type="text/javascript">

	function chooseProject($project_id, $project_name,$project_type){

		$(".requestprojectname").text("โครงการ: "+$project_name);
		$(".project_id").val($project_id);


		getDonationProjectdata($project_id);

	}


	function chooseProjectDonation($project_name){
		
		$(".requestprojectname").text("โครงการ: "+$project_name+" ทรานแซคชั่นของโครงการจะทำการเเสดงผลเฉพาะในส่วนโครงการที่เป็นโครงการระดมสินทรัพย์เท่านั้น");


	}


	function getDonationProjectdata($project_id){
		
		$.ajax({
	      url: "http://localhost/haijai/project/getDonationProjectdata",
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
                    
                    //show only log that use in project
                    if(result[$i].inuse == "project1"){
                    	if(result[$i].project_project_id == $project_id){
                    		$pukval += "<div class='col-sm-12' style='background:#EFF6E8;border-style: solid;border-width: 1px;padding:5px;'>"+
									"<span style='font-size:12;color:#333333;padding:0;'>"+result[$i].member_name+" บริจาคเข้ามา "+result[$i].money+" บาท</span><br>"+
									"<span style='font-size:12;color:#333333;padding:0;'>ได้รับการอนุมัติ วันที่ "+result[$i].donation_success+"</span><br>"+
								"</div>";
                    	}

                    }else if(result[$i].inuse == "project2"){
                    	if(result[$i].project_id2 == $project_id){
                    		$pukval += "<div class='col-sm-12' style='background:#EFF6E8;border-style: solid;border-width: 1px;padding:5px;'>"+
									"<span style='font-size:12;color:#333333;padding:0;'>"+result[$i].member_name+" บริจาคเข้ามา "+result[$i].money+" บาท</span><br>"+
									"<span style='font-size:12;color:#333333;padding:0;'>ได้รับการอนุมัติ วันที่ "+result[$i].donation_success+"</span><br>"+
								"</div>";
                    	}
                    }
                	
                        
                }

                $('.donationProjectdata').html($pukval);
               
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });

	}

</script>