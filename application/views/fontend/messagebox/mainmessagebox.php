<!--messagebox-->
<div class="maingoodhaijai" style="width:100%;height:calc(100%);min-height:600px;background:white;
  padding:6% 8%">
  	<!--header-->
  	<div class="col-sm-12" >
  		<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:10px;"> 
			<div class="col-sm-9" >
				<span style="font-size:25;color:#333333;padding:0;"><b>กล่องข้อความ</b></span><br>
			</div>	
			<div class="col-sm-3">
				<!--
				<button class="form-control btn btn-danger" style="width:100%;">ส่งข้อความหาผู้ดูแลระบบ</button>
				-->
			</div>
		</div>
	</div>
	
	<!--content-->
  	<div class="col-sm-12" style="width:100%;height:90%;">
		
		<!--left box: topic message-->
	  	<div class="col-sm-4" style="overflow:auto;height:100%;border-style: solid;border-width: 1px;padding:0;">
			<!--search topic message-->
			<div class="col-sm-12" style="padding:10px;border-style: solid;border-width: 1px;"> 
				<form class="form-inline">
				  	<div class="form-group"  style="width:100%;">
				    	<div class="input-group"  style="width:100%;">
				      		<input type="text" style="width:100%;" class="form-control" id="exampleInputAmount" placeholder="ค้นหาข้อความ">
				      		<div class="input-group-addon"><i class="fa fa-search"></i></div>
				    	</div>
				  	</div>
				</form>
			</div>

			<!--topic message 2-->
			<?php
				if(count($messagedata)==0){

				}else{
					foreach ($messagedata as $key => $value) {
						echo "<a href='javascript:void(0);' onclick=\"getMess(".$value['refer'].",".$this->session->userdata['membersession']['member_id'].")\">
									<div class='col-sm-12' style='border-style: solid;border-width: 1px;padding:10px;'> 
										<div class='col-sm-3'> 
											<img src='".base_url()."assets/img/profile/".$value['senderimg']."' style='width:60;height:60;'/>
										</div>
										<div class='col-sm-6'> 
											<span style='font-size:14;color:#333333;padding:0;'>".$value['senderm']."</span><br>
											<span style='font-size:10;color:#333333;padding:0;'>".$value['msg_create']."</span><br>
											<span style='font-size:12;color:#333333;padding:0;'>".$value['msg_detail']."</span><br>
										</div>";

								   echo "<div class='col-sm-3'> 
											<span style='font-size:12;color:red;padding:0;' id='refermess".$value['refer']."' ></span><br>
										</div>";
						echo "</div></a>";
					}
				}
			?>

		</div>


				

		<!--right box: content message-->
	  	<div class="col-sm-8" style="height:100%;border-style: solid;border-width: 1px;padding:10px;">
	  		<div class="col-sm-12 messagedata" style="overflow:auto;height:80%;">
	  			
				

	  		</div>
	  		<!--answer-->
	  		<div class="col-sm-12" style="height:20%;border-style: solid;border-width: 1px;padding:0;">
	  			
 				<input type="hidden" name="refer_id" class="refer_id" value=''/>
 				<input type="hidden" name="whotalk" class="whotalk" value=''/>
 				<input type="hidden" name="member_member_id" class="member_member_id" value="" />
 				<input type="hidden" name="sender_member_id" class="sender_member_id" value="" />

	  			<textarea name="msg_detail" class="msg_detail" style="width:100%;height:calc(100% - 30px);padding:0;">

	  			</textarea>
	  			<button class="form-control btn btn-default" onclick="saveMess()" type="button" style="height:30px;">ส่งข้อความ</button></a>
	  		</div>
		</div>


	</div>


</div>
<!---->



<script type="text/javascript">

	$(document).ready(function(){
			
		setInterval(function () {getMessNoti()}, 1000);
		//setInterval(function () {getMessNoti()}, 1000);

		setInterval(function () {checkselectMessage()}, 1000);

	});

	function checkselectMessage(){
		//case select specific message
		$member_id = "<?=$this->session->userdata['membersession']['member_id'];?>";
		if($(".refer_id").val()!=""){
			getMess($(".refer_id").val(),$member_id);
		}
	}

	function getMessNoti(){

		$.ajax({
	      url: "http://localhost/haijai/messagebox/getMessNoticon",
	      type:"POST",
	      cache:false,
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

        
                for($i=0;$i<result.length;$i++){
                
                	$('#refermess'+result[$i].refer).html("ข้อความใหม่");

                }

               
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });


	}



	//choose message
	function getMess($refer_id,$member_id){

		$.ajax({
	      url: "http://localhost/haijai/messagebox/getMessage",
	      type:"POST",
	      cache:false,
	      data:{
	        refer_id: $refer_id,
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

	      		//update after click look message
	      		$('#refermess'+result[0].refer).html("");
	      		//--------------------------------------------


	      		$(".refer_id").val(result[0].refer);
	      		$(".whotalk").val(result[0].type);
	      		$member_id = "<?=$this->session->userdata['membersession']['member_id']?>";
	      		if(result[result.length-1].sender_member_id == $member_id){
	      			$(".sender_member_id").val($member_id);
	      			$(".member_member_id").val(result[result.length-1].member_member_id);
	      		}else{
	      			$(".sender_member_id").val($member_id);
	      			$(".member_member_id").val(result[result.length-1].sender_member_id);
	      		}


	      		$pukval = "";
                
                for($i=0;$i<result.length;$i++){
                	

                    //$result[$i].response_topic + ", ";  
                	$pukval += "<div class='col-sm-12' style='padding:5px;'>"+
                					"<div class='col-sm-3'>"+
										"<img src='<?=base_url()?>assets/img/profile/"+result[$i].senderimg+"' style='width:60;height:60;'/>"+
									"</div>"+
									"<div class='col-sm-9' style='position:relative;'>"+
										"<span style='font-size:14;color:#333333;padding:0;'>"+result[$i].senderm+"</span><br>"+
										"<span style='font-size:10;color:#333333;padding:0;position:absolute;top:0;right:0;z-index:1;'>"+result[$i].msg_create+"</span><br>"+
										"<span style='font-size:12;color:#333333;padding:0;'>"+result[$i].msg_detail+"</span><br>"+
									"</div>"+
								"</div>";
								//result[$i].response_detail

                }

                $('.messagedata').html($pukval);
               
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });


	}

	function saveMess(){

		$.ajax({
	      url: "http://localhost/haijai/messagebox/saveMessage",
	      type:"POST",
	      cache:false,
	      data:{
	        refer_id: $(".refer_id").val(),
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
	      	
		    getMess($(".refer_id").val());
		    $(".msg_detail").val("");
		    
           
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });
				


	}


</script>