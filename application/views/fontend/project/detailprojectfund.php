<!--header-->
<header class="detailmainprojectfund" style="width:100%;min-height:230px;background:url('<?=base_url()?>assets/img/project/header/<?=$detailproject[0]['img_detailpath']?>') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  opacity:0.9;
  padding:6% 2%;">

	<!--content header-->
	<div class="col-sm-12" style="padding:2%;text-align:left;">
		<!--profile picture-->
		<div class="col-sm-3">
			<img class="image-responsive" src="<?=base_url()?>assets/img/project/profile/<?=$detailproject[0]['img_previewpath']?>" style="width:90%" />
		</div>

		<!--content header-->
		<div class="col-sm-9">
			<div class="col-sm-12">
				<span style="font-size:45;color:white;font-weight:50px;"><b><?=$detailproject[0]['project_name']?></b></span>
				<br>
				<span style="font-size:18;color:white;"><?=$detailproject[0]['country']?>, <?=$detailproject[0]['province']?></span>
				<br>
				<span style="font-size:18;color:white;"><?=$detailproject[0]['projectgroup_name']?></span>

			</div>
			<div class="col-sm-12">

				<!--follow-->
				<?php

					if($this->session->userdata('membersession')!=""){	
						if(count($haijaiprojectdata)==0){
							echo "<div class='col-sm-2' onclick=\"like('".$detailproject[0]['project_project_id']."','like')\" style='padding:0;'><button class='btn btn-danger' style='width:100%;margin-top:20px;'>ให้ใจ&nbsp;<i class='fa fa-heart'></i></button></div>";	
						}else{
							//$checklikeyet = 'unlike';
							if($detailproject[0]['project_project_id'] == $haijaiprojectdata[0]['project_project_id']){
								echo "<div class='col-sm-2'   onclick=\"like('".$detailproject[0]['project_project_id']."','unlike')\" style='padding:0;'><button class='btn btn-default' style='width:100%;margin-top:20px;'><span style='color:#d9534f;'>ถอนใจ&nbsp;<i class='fa fa-heart'></i></span></button></div>";	
								//$checklikeyet = 'like';
							}else{
								echo "<div class='col-sm-2' onclick=\"like('".$detailproject[0]['project_project_id']."','like')\" style='padding:0;'><button class='btn btn-danger' style='width:100%;margin-top:20px;'>ให้ใจ&nbsp;<i class='fa fa-heart'></i></button></div>";	
							}

						}
					}

				?>

				<!--share FB-->
				<br>
				<div class="col-sm-2" style="padding:0;"><a href='<?=base_url()?>project/postFB/<?=$detailproject[0]['project_project_id']?>/โครงการทั่วไป'><button class="btn btn-primary" style="width:100%;">แชร์&nbsp;<i class="fa fa-facebook-official"></i></button></a></div>
				
				<!--follow-->
				<?php
					if($this->session->userdata('membersession')!=""){	
						if(count($followprojectdata)==0){
							
							echo "<div class='col-sm-3' onclick=\"follow('".$detailproject[0]['project_project_id']."','follow')\" style='padding:0;'><button class='btn btn-info' style='width:100%;'>ติดตาม</button></div>";
								
						}else{
							
							echo "<div class='col-sm-3' onclick=\"follow('".$detailproject[0]['project_project_id']."','unfollow')\" style='padding:0;'><button class='btn btn-info' style='width:100%;'>กำลังติดตาม&nbsp;<i class='fa fa-check-square-o'></i></button></div>";
								
						}
					}

				?>

				<div class="col-sm-2"></button></div>
				<?php
					if($this->session->userdata('membersession')!=""){	
						echo "<div class='col-sm-3' style='padding:0;'><button class='btn btn-danger' style='width:100%;' data-toggle='modal' data-target='#problemprojectbutton'>รายงานปัญหา</button></div>";
					}
				?>
				<!-- problemproject -->
				<div class="modal fade" id="problemprojectbutton" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
					<div class="modal-dialog" role="document"  >
					    <div class="modal-content">
					    	<div class="modal-header" style="background:#4A90E2;color:white;">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        	<h4 class="modal-title" id="myModalLabel">รายงานปัญหา</h4>
					      	</div>
					      	<div class="modal-body" style="width:100%;height:320px;padding:30;">
					      	<?=form_open("manageproblem/savereport")?>
					      		<input type="hidden" name="project_id" value="<?=$detailproject[0]['project_id']?>" />
					      		<input type="hidden" name="member_id" value="<?=$this->session->userdata('membersession')!=''? $this->session->userdata['membersession']['member_id']: '';?>" /> <!--ใครเป็นคนเเจ้ง: ทดสอบกำหนดเป็น 6-->
					      		<div class="col-sm-3">
						      		<span style="font-size:18;color:#253747;padding:0;"><b>ประเภทปัญหา</b></span><br>
						      	</div>
						      	<div class="col-sm-9">
						      		<select class="form-control" name="report_type" style="width:100%;">
						      			<option value="ระดมทุน" selected>โครงการระดมสินทรัพย์</option>
						      			<option value="รับบริจาค">โครงการรับบริจาค</option>
						      			<option value="ทั่วไป">ปัญหาทั่วไป</option>
						      		</select>
						      	</div>
						      	<div class="col-sm-12" style="margin-top:10px;">
						      		 <input type="text" style="width:100%;" name="report_topic" class="form-control" placeholder="กรุณาระบุหัวข้อปัญหา" />
						      	</div>
						      	<div class="col-sm-12">
						      		<textarea class="form-control" name="report_detail" style="width:100%;height:150px;resize: none;">
						      		กรุณาระบุรายละเอียดปัญหา
						      		</textarea>
						      	</div>

						      	<div class="col-sm-12" style="margin-top:10px;">
						      		<button class="btn btn-danger" style="width:100%;">รายงานปัญหา</button>
						      	</div>
						     <?=form_close()?>
					      	</div>
					    </div>
				  	</div>
				</div>


			</div>
		</div>



 	</div>
 	<!---->

</header>
<!---->

<section style="width:100%;background:white;padding:2%;">
	<!--ยอดสนับสนุน-->
	<div class="col-sm-3" style="background:#C4D3E3;padding:10px;">
		<?php
		if($detailproject[0]['project_type']=='ระดมทุน'){
			echo "<span style='font-size:20;color:#253747;padding:0;'><b>ยอดสนับสนุนทั้งหมด</b></span><br>
				<span style='font-size:20;color:#4A90E2;padding:0;center;>".$detailproject[0]['money_raising']." บาท</span><br>
				<span style='font-size:16;color:#333333;padding:0;'>จำนวนคนสนับสนุน ".$detailproject[0]['peopledonate']." คน</span><br>
				<span style='font-size:16;color:#333333;padding:0;'>เป้าหมาย <span  style='font-size:16;color:#333333;padding:0;' style='font-size:10;color:#333333;padding:0;'><b>".$detailproject[0]['money_expect']."</b></span> บาท</span><br>";
		
			echo "<span style='font-size:16;color:#333333;padding:0;'>เหลืออีก".$detailproject[0]['daycanuse']." วัน</span><br>";
		
			echo "<span style='font-size:12;color:#333333;padding:0;text-align:left;'>".$detailproject[0]['projectpercen']."%</span><br>
				<div class='progress' style='width:100%;'>
					<div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='".$detailproject[0]['projectpercen']."' aria-valuemin='0' aria-valuemax='100' style='width:".$detailproject[0]['projectpercen']."%'>
				    	<span class='sr-only'>".$detailproject[0]['projectpercen']."% Complete</span>
				  	</div>
				</div>";
		}else{

			echo "<span style='font-size:25;color:#253747;padding:0;'><b>เหลืออีก".$detailproject[0]['daycanuse']." วัน</b></span><br>";  
			echo "<span style='font-size:16;color:#333333;padding:0;'><u>สิ่งของที่ต้องการ</u><br> ".$detailproject[0]['item_expect']." คน</span><br>";

		}
		?>

		<div class="col-sm-12 fundbutton" style="padding:0;" style="display:none;">
				<?php
					if($this->session->userdata('membersession')!=""){	
				?>
					<button class="btn btn-success" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#donationbutton"style="width:100%;">
						ร่วมระดมสินทรัพย์
					</button>
				<?php }
				else{
				?>
					<a href="javascript:void(0)" onclick="goToRegister()">
						<button class="btn btn-success" class="btn btn-primary btn-lg" type="button"  style="width:100%;">
							ร่วมบริจาค
						</button>
					</a>
					
				<?php }?>
				<!-- donation -->
				<div class="modal fade" id="donationbutton" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
					<div class="modal-dialog" role="document"  >
					    <div class="modal-content">
					    	<div class="modal-header" style="background:#4A90E2;color:white;">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        	<h4 class="modal-title" id="myModalLabel">เลือกช่องทางในการชำระเงิน</h4>
					      	</div>
					      	<div class="modal-body" style="width:100%;height:320px;padding:30;">
					      		<a href="<?=base_url()?>project/checkout/<?=$detailproject[0]['project_id']?>/bank">
						        	<div class="choosebank" style="width:50%;float:left;">
						        		<img src="<?=base_url()?>assets/img/project/bank.jpg" style="width:100%;height:100%;position:relative;" />
						        		<div class="choosebankselected" style="width:45%;height:80%;background:gray;opacity:0.2;z-index:2;position:absolute;top:10%;display:none;"></div>
						        	</div>
						        </a>
						        <a href="<?=base_url()?>project/checkout/<?=$detailproject[0]['project_id']?>/paysbuy">
						        	<div class="choosepaysbuy" style="width:50%;float:left;">
						        		<img src="<?=base_url()?>assets/img/project/paysbuylogo.jpg" style="width:100%;height:100%;" />
						        		<div class="choosepaysbuyselected" style="width:45%;height:80%;background:gray;opacity:0.2;z-index:2;position:absolute;top:10%;display:none;"></div>
						        	</div>
						        </a>
					      	</div>
					    </div>
				  	</div>
				</div>
		</div>
		<br>
		<span style="font-size:16;color:#333333;padding:0;"><br>สร้างโดย</span><br>
			
		<!--ผู้สร้าง-->
			<div class="col-sm-12">
				<div class="col-sm-4" style="padding:2px;">
					<img src="<?=base_url()?>assets/img/profile/<?=$detailproject[0]['img_profilepath']?>" style="width:50px;height:50px;"/>
				</div>
			
			<div class="col-sm-8" style="padding:0;">
				<span style="font-size:16;color:#253747;padding:0;"><b><?=$detailproject[0]['member_name']?></b></span><br>
				<a href="<?=base_url()?>profile/index/<?=$detailproject[0]['member_id']?>"><span style="font-size:16;color:#253747;padding:0;">ดูโปรไฟล์</span><br></a>
			</div>

		</div>

	</div>

	<!--รายละเอียดโครงการ-->
	<div class="col-sm-9">
		<?php
			if($detailproject[0]['receive_money_evidence']!="" && $detailproject[0]['receive_money_evidence']!="-"){
				echo "<span style='font-size:16;color:#253747;padding:0;'>
					<b>ทางเจ้าของโครงการได้รับเงินเเล้ว ทางทีมงานให้ใจขอขอบคุณทุกท่าน<br>ที่มาร่วมกันให้ใจ ให้โอกาสกัน ณ ที่นี้ ขอบคุณครับ</b>
					<br>
				</span>";
                echo "<div style='float:left;width:100%;height:300px;'><img src='".base_url()."assets/backend/images/receivemoneyevidence/".$detailproject[0]['receive_money_evidence']."' style='width:auto;max-height:300px;' /></div>";
            }
		?>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>รายละเอียดโครงการ</b>
			<br>
			&nbsp; &nbsp; &nbsp;<?=$detailproject[0]['project_deepdetail']?>
			<br>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>ดูวีดีโอของเราบนยูทูปได้ที่นี่</b>
			<br>
			&nbsp; &nbsp; &nbsp;<a href="<?=$detailproject[0]['video_detailpath']?>"><?=($detailproject[0]['video_detailpath']!='' ? $detailproject[0]['video_detailpath'] : '-' )?></a>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>กลุ่มเป้าหมาย</b>
			<br>
			&nbsp; &nbsp; &nbsp;<?=$detailproject[0]['project_target']?>
			<br>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>วัตถุประสงค์</b>
			<br>
			&nbsp; &nbsp; &nbsp;<?=$detailproject[0]['project_object']?>
			<br>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>สถานที่จัดทำโครงการ</b>
			<br>
			&nbsp; &nbsp; &nbsp;แขวง<?=$detailproject[0]['subdisdrict']?> เขต<?=$detailproject[0]['district']?> จังหวัด<?=$detailproject[0]['country']?> ประเทศ<?=$detailproject[0]['province']?>
			<br>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>วันที่คาดว่าจะจัดทำโครงการ</b>
			<br>
			&nbsp; &nbsp; &nbsp;<?=$detailproject[0]['project_realstart']?>
			<br>
		</span>
		<br>
		<span style="font-size:16;color:#253747;padding:0;">
			<b>เอกสารประกอบโครงการ</b>
			<br>
			&nbsp; &nbsp; &nbsp;	<a href="<?=base_url()?>assets/img/project/documentproject/<?=$detailproject[0]['project_pdfpath']?>"><?=($detailproject[0]['project_pdfpath']!='' ? $detailproject[0]['project_name'] : '-' )?></a>
			<br>
		</span>

	</div>

</section>

<!--class="textareareplyID2" style="display:none;"-->


<!-- Contenedor Principal -->
<div class="comments-container" >
	<a href="javascript:void(0);" onclick="checkOpenCommentOrUpdatebox('commentbox')"><span style="font-size:17;color:#30dbb5;padding:0;"><b>ความคิดเห็นต่อโครงการ/</b></span></a>
	<a href="javascript:void(0);" onclick="checkOpenCommentOrUpdatebox('updatebox')"><span style="font-size:17;color:#f78787;padding:0;"><b>ข่าวสารการอัพเดทโครงการ</b></span></a>

	

	<!--Comment-->
	<ul id="comments-list" class="comments-list commentbox">
		<?php
			if($this->session->userdata('membersession')!=""){	
		?>
		<!--new comment-->
			<?=form_open("project/newcomment")?>
			<li>
				<?php
					//echo form_open("project/newcomment");
					echo "<input type='hidden' name='member_member_id' class='member_member_id_".$detailproject[0]['project_id']."' value='".$member_logindata['member_id']."' /> 
						<input type='hidden' name='project_project_id' class='project_project_id_".$detailproject[0]['project_id']."' value='".$detailproject[0]['project_id']."' /> 
						";

				?>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="<?=base_url()?>assets/img/profile/<?=$member_logindata['img_profilepath'];?>" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<?php
								if($detailproject[0]['member_member_id']==$member_logindata['member_id']){
									if($member_logindata['MemberRole']=="Moderator"){
										echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span>";
									}
									else{
										echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
									}
								}else{
									if($member_logindata['MemberRole']=="Moderator"){
										echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span>";
									}else{
										if(count($checkStaff)!=0){
											foreach ($checkStaff as $key => $staffValue) {
												if($staffValue['member_id'] == $member_logindata['member_id']){
													echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>สต๊าฟโครงการ</b></span>";
												}else{
													echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
												}
											}
										}else{
											echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
										}

									}
								}
							?>
							</div>
						<div class="comment-content">
							<textarea style="width:100%;" class="comment_detail_<?=$detailproject[0]['project_id']?>">

							</textarea>
							<button class="btn btn-default"  type='button' onclick="newcomment('<?=$detailproject[0]['project_id']?>','root')" style="float:right;">เเสดงความคิดเห็น</button>
						</div>
					</div>
				</div>
			</li>
			<?=form_close();?>
		<?php }?>
		<?php
		foreach ($commentprojectdata as $key => $value) {
			
			if($value['replyTo_projectcomment_id']==""){
				echo "<li>
						<div class='comment-main-level'>
							<!-- Avatar -->
							<div class='comment-avatar'><img src='".base_url()."assets/img/profile/".$value['img_profilepath']."' alt=''></div>
							<!-- Contenedor del Comentario -->
							<div class='comment-box'>
								<div class='comment-head'>";
								
								if($detailproject[0]['member_member_id']==$value['member_id']){
									echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$value['member_id']."'>".$value['member_name']."</a></h6>";
							  	}else{
									echo "<h6 class='comment-name' ><a href='".base_url()."profile/index/".$value['member_id']."'>".$value['member_name']."</a></h6>";
							  	}
							  	if($value['MemberRole']=="Moderator"){
							  		echo "<span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span><span>".$value['comment_create']."</span>";
							  	}else{
							  			if(count($checkStaff)!=0){
											foreach ($checkStaff as $key => $staffValue) {
												if($staffValue['member_id'] == $member_logindata['member_id']){
							  						echo "<span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>สต๊าฟโครงการ</b></span><span>".$value['comment_create']."</span>";
												}else{
							 						echo "<span>".$value['comment_create']."</span>";
												}
											}
										}else{
							 				echo "<span>".$value['comment_create']."</span>";
							 			}
								}
								

							  echo "<a href='javascript:void(0)' style='float:right' onclick='openCommentBox(\"textareareplyID".$value['projectcomment_id']."\")'><i class='fa fa-reply'></i></a>
								</div>
								<div class='comment-content'>
									".$value['comment_detail']."
								</div>
							</div>
						</div>
						<!-- Respuestas de los comentarios -->";

						$countsubcomment = 0;
						foreach ($commentprojectdata as $key => $subcomment) {	
							if (($subcomment['replyTo_projectcomment_id']==$value['projectcomment_id']) && ($subcomment['replyTo_projectcomment_id']!="")){
								$countsubcomment += 1;
							}
						}

						if($countsubcomment != 0){
							echo "<ul class='comments-list reply-list' style='padding-top:0;margin-top:0;'>
									<a href='javascript:void(0);' onclick=\"openSubComment('".$value['projectcomment_id']."','".$countsubcomment."')\">
										<div style='color:white;background:#3399FF;height:30px;padding:5px;' id='hiddencomment".$value['projectcomment_id']."' >ดูความคิดเห็นย่อย ".$countsubcomment." ความคิดเห็น</div>
									</a>
								</ul>";
							echo "<ul class='comments-list reply-list' id='headcomment".$value['projectcomment_id']."' style='display:none;' >";
						}else{
							echo "<ul class='comments-list reply-list'  >";
						}



						foreach ($commentprojectdata as $key => $subcomment) {	
							if (($subcomment['replyTo_projectcomment_id']==$value['projectcomment_id']) && ($subcomment['replyTo_projectcomment_id']!="")){
							echo "<li>
									<!-- Avatar -->
									<div class='comment-avatar'><img src='".base_url()."assets/img/profile/".$subcomment['img_profilepath']."' alt=''></div>
									<!-- Contenedor del Comentario -->
									<div class='comment-box'>
										<div class='comment-head'>";

										if($detailproject[0]['member_member_id']==$subcomment['member_id']){
											echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$subcomment['member_id']."'>".$subcomment['member_name']."</a></h6>";
									  	}else{
											echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$subcomment['member_id']."'>".$subcomment['member_name']."</a></h6>";
									  	}
									  	if($subcomment['MemberRole']=="Moderator"){
									  		echo "<span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span><span>".$value['comment_create']."</span>";
									  	}else{
									  		if(count($checkStaff)!=0){
													foreach ($checkStaff as $key => $staffValue) {
														if($staffValue['member_id'] == $subcomment['member_id']){
									  						echo "<span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>สต๊าฟโครงการ</b></span><span>".$value['comment_create']."</span>";
														}else{
									 						echo "<span>".$value['comment_create']."</span>";
														}
													}
												}else{
									 				echo "<span>".$value['comment_create']."</span>";
									 			}

										}
							  			
									echo "</div>
										<div class='comment-content'>
											".$subcomment['comment_detail']."
										</div>
									</div>
								</li>";
							}
						}
				if($this->session->userdata('membersession')!=""){	
					//echo form_open("project/newcomment");
					echo "<input type='hidden' name='replyTo_projectcomment_id' class='replyTo_projectcomment_id_".$value['projectcomment_id']."' value='".$value['projectcomment_id']."' /> 
						<input type='hidden' name='member_member_id' class='member_member_id_".$value['projectcomment_id']."' value='".$member_logindata['member_id']."' /> 
						<input type='hidden' name='project_project_id' class='project_project_id_".$value['projectcomment_id']."' value='".$value['project_project_id']."' /> 
						";
					echo 	"<!--comment sub: text area if visitor want comment-->
								<li class='textareareplyID".$value['projectcomment_id']."' style='display:none;'>
									<!-- Avatar -->
									<div class='comment-avatar'><img src='".base_url()."assets/img/profile/".$member_logindata['img_profilepath']."' alt=''></div>
									<!-- Contenedor del Comentario -->
									<div class='comment-box'>
										<div class='comment-head'>";
				
											if($detailproject[0]['member_member_id']==$member_logindata['member_id']){
												if($member_logindata['MemberRole']=="Moderator"){
													echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span>";
												}
												else{
													echo "<h6 class='comment-name by-author'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
												}
											}else{
												if($member_logindata['MemberRole']=="Moderator"){
													echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>ผู้ดูแลระบบ</b></span>";
												}else{
													if(count($checkStaff)!=0){
														foreach ($checkStaff as $key => $staffValue) {
															if($staffValue['member_id'] == $member_logindata['member_id']){
																echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6><span style='color:white;background:#03658c;padding:1px 7px;margin:5px 4px;'><b>สต๊าฟโครงการ</b></span>";
															}else{
																echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
															}
														}
													}else{
														echo "<h6 class='comment-name'><a href='".base_url()."profile/index/".$member_logindata['member_id']."'>".$member_logindata['member_name']."</a></h6>";
													}

												}
											}

									echo "</div>
										<div class='comment-content'>
											<textarea name='comment_detail' class='comment_detail_".$value['projectcomment_id']."' style='width:100%;'>

											</textarea>
											<button class='btn btn-default' type='button' onclick=\"newcomment('".$value['projectcomment_id']."','sub')\" style='float:right;'>เเสดงความคิดเห็น</button>
										</div>
									</div>
								</li>";
					//echo form_close();
					}
					echo "</ul>

					</li>";
			}
		}
		?>

	</ul>

	<!--
	<button class="btn btn-default commentbox" style="width:100%;">เเสดงผลเพิ่มเติม</button>
	-->


	<!--Update-->
	<ul id="comments-list" class="comments-list updatebox" style="display:none;">
	<?php
		if(count($updateprojectdata)==0){
			echo "<li>
						<div class='comment-main-level'>
							<div class='comment-box'>
								<div class='comment-content'>
									<span style='font-size:16;'>ยังไม่มีการอัพเดทโครงการในขณะนี้</span>
								</div>
							</div>
						</div>
					</li>";
		}else{
			foreach ($updateprojectdata as $key => $value) {
				echo "<li>
						<div class='comment-main-level'>
							<!-- Avatar -->
							<div class='comment-avatar'><img src='".base_url()."assets/img/profile/".$value['img_profilepath']."' alt=''></div>
							<!-- Contenedor del Comentario -->
							<div class='comment-box'>
								<div class='comment-head'>
									<h6 class='comment-name by-author'><a href='#'>".$value['member_name']."</a></h6>
									<span>".$value['update_create']."</span>
								</div>
								<div class='comment-content'>
									".$value['detail']."
									<br>";
									//update-1.png
									if($value['img_detailpath']!=''){
                                    	echo "<div style='float:left;width:100%;height:150px;'><img src='".base_url()."assets/img/project/updateproject/".$value['img_detailpath']."' style='width:auto;max-height:150px;' /></div>";
									}

				echo			"</div>
							</div>
						</div>
					</li>";
			}
		}
	?>
	</ul>
	<!--
	<button class="btn btn-default updatebox" style="width:100%;display:none;">เเสดงผลเพิ่มเติม</button>
	-->
</div>

<script type="text/javascript">

	function newcomment($id,$sub){
		if($sub=="sub"){
		    $.ajax({
		      url: "http://localhost/haijai/project/newcomment",
		      type:"POST",
		      cache:false,
		      data:{
		      	action: $sub,
				replyTo_projectcomment_id: $(".replyTo_projectcomment_id_"+$id).val(),
				member_member_id: $(".member_member_id_"+$id).val(),
				project_project_id: $(".project_project_id_"+$id).val(),
				comment_detail: $(".comment_detail_"+$id).val(),
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
		}else{

			$.ajax({
		      url: "http://localhost/haijai/project/newcomment",
		      type:"POST",
		      cache:false,
		      data:{
		      	action: $sub,
				replyTo_projectcomment_id: "",
				member_member_id: $(".member_member_id_"+$id).val(),
				project_project_id: $(".project_project_id_"+$id).val(),
				comment_detail: $(".comment_detail_"+$id).val(),
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
	
	function checkOpenCommentOrUpdatebox($check){
		if($check == 'commentbox'){
			$(".commentbox").css("display","inline-block");
			$(".updatebox").css("display","none");
		}else{
			$(".commentbox").css("display","none");
			$(".updatebox").css("display","inline-block");
		}
	}

	function openCommentBox($textareareplyID){
		$("."+$textareareplyID).css("display","inline-block");
	}

	function follow($project_id, $action){
    	
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

	//like
	function like($project_id, $action){
    	
	    $.ajax({
	      url: "http://localhost/haijai/project/likeproject",
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

	function goToRegister(){
		alert("กรุณาทำการเข้าสู่ระบบก่อนทำการบริจาคครับ");
		window.location.replace("<?=base_url()?>register");
	}

	function openSubComment($headcommentId,$countsubcomment){
		//alert($headcommentId);
		$("#headcomment"+$headcommentId).toggle( "slow", function() {
		    // Animation complete.
		});

		//hiddencomment
		

		
		if($("#hiddencomment"+$headcommentId).text() == ("ดูความคิดเห็นย่อย "+$countsubcomment+" ความคิดเห็น") ){
			$("#hiddencomment"+$headcommentId).text("ซ่อนความคิดเห็นย่อย "+$countsubcomment+" ความคิดเห็น");
		}else{
			$("#hiddencomment"+$headcommentId).text("ดูความคิดเห็นย่อย "+$countsubcomment+" ความคิดเห็น");
		}
		
	}

	$(document).ready(function(){
		//for hidden fundrasing button
		$project_status = "<?=$detailproject[0]['project_status']?>";
		$project_type = "<?=$detailproject[0]['project_type']?>";
		if($project_status != 'approve' || $project_type != "ระดมทุน"){
			$(".fundbutton").css("display","none");
		}else{
			$(".fundbutton").css("display","inline");
		}
	});

</script>