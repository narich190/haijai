<section class="col-sm-12" style="background:white;width:100%;min-height:100%;padding:7% 8%;">
	

	<?php
		// member of visitor <> member that creator
		if ($this->session->userdata['membersession']['member_id'] != ""){
			echo "<ul class='nav nav-tabs nav-justified'>";
			  	echo "<li role='presentation' ><a href=".base_url()."profile/index/".$this->session->userdata['membersession']['member_id'].">Home</a></li>";
		  		echo "<li role='presentation' class='active'><a href='".base_url()."profile/receivenews'>การติดตาม</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/transproject'>จัดการโครงการ</a></li>";
		  		echo "<li role='presentation'><a href='".base_url()."profile/successactivity'>โครงการที่สำเร็จ</a></li>";
			echo "</ul>";
		}
	?>

	<!--modify news receive-->
	<div class="col-sm-12">
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>ตั้งค่าการรับข่าวสาร</b></span></div>
		
		<div class="col-sm-12" style="padding:2%;">
			<div class="col-sm-1"><input type="checkbox" class="form-control checkreceivenews" /></div>
			<div class="col-sm-5"><span style="font-size:16;color:#333333;padding:0;">ต้องการรับข่าวสารผ่านอีเมลล์</span></div>	
			<div class="col-sm-3"><input type="text" class="form-control emailreceivenews" disabled/></div>
			<div class="col-sm-3"><span style="font-size:16;color:#333333;">อีเมลล์ที่ใช้รับข่าว</span></div>	
			
		</div>
	</div>
	<script type="text/javascript">
		
		$(".emailreceivenews").val("<?=$memberdata['email']?>");
		$receivenewsyet = "<?=$memberdata['receiveemailnews']?>";
		if($receivenewsyet=="yes"){
			$('.checkreceivenews').prop('checked', true);
		}else{
			$('.checkreceivenews').prop('checked', false);
		}

		
		
	</script>
	

	<div class="col-sm-6" style="padding:2%;">
		<!--โครงการรับบริจาค-->
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>โครงการรับบริจาคที่ติดตาม</b></span></div>
		<?php
			if(count($followdonationdata)==0){
				echo "<a href=\"#\">
					<div class='col-sm-12' style='background:#C9CBCD;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>ยังไม่มีการติดตามโครงการรับบริจาคของคุณในขณะนี้</span><br>
						</div>
					</div>
				</a>";
			}else{

				foreach ($followdonationdata as $key => $value) {
				
				echo "<a href='#'>
						<div class='col-sm-12' style='background:#DBFAF3;border-style: solid;
			    border-width: 1px;padding:0;position:relative;'>
			    			<div class='col-sm-11'>
								<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
								<span style='font-size:12;color:#333333;padding:0;'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span>
							</div>
							<a href='javascript:void(0);' onclick=\"follow('".$value['project_project_id']."','unfollow')\"  style='position:absolute;z-index:1;top:0;right:0;'><i class='fa fa-times-circle' style='color:red;'></i></a>
						</div>
					</a>";
				
				}


			}

		?>



		<!--โครงการระดมสินทรัพย์-->
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>โครงการระดมสินทรัพย์ที่ติดตาม</b></span></div>
		
		<?php
			if(count($followfunddata)==0){
				echo "<a href=\"#\">
					<div class='col-sm-12' style='background:#C9CBCD;border-style: solid;border-width: 1px;padding:0;position:relative;'>
		    			<div class='col-sm-12'>
							<span style='font-size:14;color:#333333;padding:0;'>ยังไม่มีการติดตามโครงการระดมสินทรัพย์ของคุณในขณะนี้</span><br>
						</div>
					</div>
				</a>";
			}else{
				$summoney = 0;
				$round = 0;
				foreach ($followfunddata as $key => $value) {
						  echo "<a href='#'>
										<div class='col-sm-12' style='background:#FDE0E4;border-style: solid;
							    border-width: 1px;padding:0;position:relative;'>
							    			<div class='col-sm-11'>
												<span style='font-size:14;color:#333333;padding:0;'>".$value['project_name']."</span><br>
												<span style='font-size:12;color:#333333;padding:0;'>เหลือเวลาอีก ".$value['daycanuse']." วัน</span>";
										foreach ($funddataproject1 as $key => $funddataprojectone) {
											if($value['project_id'] == $funddataprojectone['project_project_id']){
												foreach ($funddataproject2 as $key => $funddataprojecttwo) {
													if($funddataprojectone['project_project_id'] == $funddataprojecttwo['project_project_id']){
														$summoney += $funddataprojecttwo['moneyfund'];
													}
												}
												$summoney += $funddataprojectone['moneyfund'];
												//echo $summoney."<br>";
												
												echo "<span style='font-size:12;color:#333333;padding:0;'>, ฉันบริจาคไป ".$summoney." บาท</span>";
												
												$summoney = 0;
											}
										}
									  echo "</div>
											<a href='javascript:void(0);' onclick=\"follow('".$value['project_project_id']."','unfollow')\" style='position:absolute;z-index:1;top:0;right:0;'><i class='fa fa-times-circle' style='color:red;'></i></a>
										</div>
									</a>";
				
				}


			}

		?>


	</div>

	<!--right box info profile-->
	<div class="col-sm-6" style="padding:2%;">
		<!--บุคคลที่ติดตาม-->
		<div class="col-sm-12"><span style="font-size:16;color:#333333;padding:0;"><b>บุคคลที่ติดตาม</b></span></div>
		<?php
			if(count($folllowmemberdata)==0){
				echo "<a href='#'>
						<div class='col-sm-12' style='background:#C9CBCD;border-style: solid;border-width: 1px;padding:0;position:relative;'>
			    			<div class='col-sm-12'>
								<span style='font-size:14;color:#333333;padding:0;'>ยังไม่มีการติดตามใครในขณะนี้</span><br>
							</div>
						</div>
					</a>";
			}else{

				foreach ($folllowmemberdata as $key => $value) {
					
				echo "<a href='".base_url()."profile/index/".$value['member_id']."'>
						<div class='col-sm-4' style='padding:0;'>
			    			<div class='col-sm-12' style='position:relative;padding:0;'>
								<img src='".base_url()."assets/img/profile/".$value['img_profilepath']."' style='width:100%;height:20%;'/>
							</div>
							<a href='javascript:void(0);' onclick=\"followmember('".$value['member_memberfollow_id']."','unfollow')\" style='position:absolute;z-index:1;top:0;right:0;'><i class='fa fa-times-circle' style='color:red;'></i></a>
						</div>
					</a>";

				}


			}

		?>
		

	</div>

	

</section>



<script type="text/javascript">
	$(document).ready(function(){
		$member_id = "<?=$memberdata['member_id']?>"

		//check change value of receivenews
		$("input[type='checkbox']").change(function() {
			if(this.checked) {
			    updatereceiveinfo($member_id,"yes");
			}else{
			    updatereceiveinfo($member_id,"no");
			}
		});
	});

	function updatereceiveinfo($member_id, $receiveemailnews){

		$.ajax({
	      url: "http://localhost/haijai/profile/updatereceivenewsInfo",
	      type:"POST",
	      cache:false,
	      data:{
	        member_id: $member_id,
	        email: $(".emailreceivenews").val(),
	        receiveemailnews: $receiveemailnews,
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
	      	//alert(result);
        	window.location.reload();
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    }); 

	}

	function follow($project_id, $action){
    	
    	var conf = confirm('คุณต้องการลบการติดตามโครงการจริงหรือไม่?');
			//alert(coffeecheckdelete);
		if(conf){
		    $.ajax({
		      url: "http://localhost/haijai/project/followproject",
		      type:"POST",
		      cache:false,
		      data:{
		        project_id: $project_id,
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
		      	//insert project id 
		      	//alert(result);
	        	window.location.reload();
		      },
		      error:function(err){
		        alert("ERROR : "+err);
		      }
		                    
		    });  
		}


	}

	function followmember($memberfollow_id, $action){
    	
		var conf = confirm('คุณต้องการลบการติดตามสมาชิกจริงหรือไม่?');
			//alert(coffeecheckdelete);
		if(conf){
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


	}

	

</script>