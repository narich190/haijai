<!--messagebox-->
<div class="maingoodhaijai" style="width:100%;height:calc(100%);min-height:600px;background:white;
  padding:6% 8%">
  	<!--header-->
  	<div class="col-sm-12" >
  		<div class="col-sm-12" style="border-style: solid;border-width: 1px;padding:10px;"> 
			<div class="col-sm-12" >
				<span style="font-size:25;color:#333333;padding:0;"><b>ติดตามรายการธุรกรรม</b></span><br>
			</div>	
		</div>
	</div>
	
	<!--content-->
  	<div class="col-sm-12" style="width:100%;height:90%;">
		<!--left box: topic message-->
	  	<div class="col-sm-4" style="height:100%;border-style: solid;border-width: 1px;padding:10px;">
			<!--search log message-->
			<div class="col-sm-12" style="margin-top:15px;"> 
				<span style="font-size:18;color:#253747;padding:0;"><b>หมายเลขรายการ</b></span><br>
			</div>

			<div class="col-sm-12" style="margin-top:15px;"> 
				<input type="text" class="donationnumber" style="width:100%;" class="form-control" />
			</div>

			<div class="col-sm-12" style="margin-top:15px;"> 
				<button  class="form-control btn btn-info" onclick="checkTransaction();">ตรวจสอบ</button>
			</div>

			<div class="col-sm-12" style="margin-top:15px;"> 
				<span style="font-size:16;color:gray;padding:0;">
		  				กรุณากรอกหมายเลขรายการของท่านที่ช่องหมายรายการ
		  				เพื่อทำการตรวจสอบสถานะการทำธุรกรรม
		  		</span>
		  	</div>

		</div>


		<!--right box: content message-->
	  	<div class="col-sm-8" style="height:100%;border-style: solid;border-width: 1px;padding:0;margin:0;">
	  		<div class="col-sm-12 stepallprocess" style="overflow:auto;height:100%;display:none;padding:10px;">

	  			<!--step 1-->
	  			<div class="col-sm-12" style="padding:5px;">
	  				<div class="col-sm-12" > 
						<span style="font-size:18;color:#333333;padding:0;">1) อัพโหลดหลักฐานการโอนเงิน</span><br>
						<hr>
					</div>
					<div class="col-sm-12 step1process" style="padding:10px;display:none;">
						<form action="tracking/uploadslipdonate" method="post" id="form1" runat="server" enctype="multipart/form-data" style="text-align:center;">
						    <input type='hidden' name='donationlog_id' class='donationlog_id' value='' />
						    <input type='file' name='img_donationpath' id="imgInp" style="margin:0 auto;height:0px;overflow:hidden"/>
						    <img id="blah" src="<?=base_url()?>assets/img/main/slipupload.png" onclick="chooseFile();" alt="your image" style="width:50%;height:40%;" />
							<br><br>
							<div class="buttonUplaod" style="width:100%;display:none;"> 
								<button class="btn btn-danger" type="cancel" style="width:25%">ยกเลิก</button>
								<button class="btn btn-success" type="submit" style="width:25%">อัพโหลด</button>
							</div>
						</form>
					</div>

				</div>
				
				
				<!--step 2-->
	  			<div class="col-sm-12" style="padding:5px;">
					<div class="col-sm-12" style="position:relative;"> 
						<span style="font-size:18;color:#333333;padding:0;">2) รอการตรวจสอบจากทีมงาน</span><br>
						<hr>
					</div>
					<div class="col-sm-12 step2process" style="padding:30px;display:none;">
						<div style="text-align:center;">

							<span style="font-size:16;color:#333333;padding:0;"><b>เราได้รับการอัพโหลดหลักฐานจากท่านเเล้ว</b></span><br>
							<span style="font-size:16;color:#333333;padding:0;">
								ขั้นตอนการตรวจสอบหลักฐานจะมีการใช้ในการตรวจสอบประมาณ 7 วันหลังจากการอัพโหลด 
								หากภายใน 7 วัน รายการยังไม่มีการเปลี่ยนสถานะ กรุณาเเจ้งได้ที่
								<a>รายงานปัญหา</a> หรือติดต่อที่ <a>www.facebook.com/haijaisupport</a> 
							</span><br>
							<span style="font-size:16;color:#333333;padding:0;">
								ขอบคุณครับ 
							</span>
						</div>
					</div>
				</div>
				

				<!--step 3-->
	  			<div class="col-sm-12" style="padding:5px;">
	  				<div class="col-sm-12" style="position:relative;"> 
						<span style="font-size:18;color:#333333;padding:0;">3) การทำธุรกรรมเสร็จสมบูรณ์</span><br>
						<hr>
					</div>
					<div class="col-sm-12 step3process" style="padding:30px;display:none;">
						<div style="text-align:center;">
							<span style="font-size:16;color:#333333;padding:0;"><b>รายการของท่านได้รับการอนุมัติเเล้ว</b></span><br>
							<span style="font-size:16;color:#333333;padding:0;">
								ทางทีมงาน ขอขอบคุณท่านที่ได้ให้ความไว้วางใจให้ haijai ร่วมเป็นส่วนหนึ่งในการสร้างสังคมที่ดี ร่วมกันกับท่าน 
								หากท่านมีข้อสงสัย หรือต้องการให้ข้อมูลเพิ่มเติม กรุณาติดต่อที่ <a>www.facebook.com/haijaisupport</a>  
								
							</span><br>
						</div>
					</div>
				</div>
	  		</div>

	  		<!--no donation log-->
	  		<div class="col-sm-12 stepcomeprocess" style="overflow:auto;height:100%;text-align:center;padding:0;">
	  			<img src="<?=base_url()?>assets/img/main/bg2.jpg" style="width:100%;height:100%;" />
	  			

	  		</div>

		</div>


	</div>


</div>
<!---->

<script type="text/javascript">
	function chooseFile(){
		$("#imgInp").click();
	}

	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#blah').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }

	    $(".buttonUplaod").css("display","inline-block");
	}

	$("#imgInp").change(function(){
	    readURL(this);
	});


	function checkTransaction(){
		$logid = $(".donationnumber").val();

		$.ajax({
	      url: "http://localhost/haijai/tracking/checkdonationlog",
	      type:"POST",
	      cache:false,
	      data:{
	        donation_id: $logid.substring(2),
	        channelpay: $logid.substring(0,2),
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
	      	
	      	if(result[0].donation_status=="waitapprove" && result[0].img_donationpath==""){


	      		$(".step1process").css("display","inline-block");

				//close
				$(".step2process").css("display","none");
				$(".step3process").css("display","none");

				$(".donationlog_id").val($logid.substring(2));

				opencloseContexttrack();

	      	}else if(result[0].donation_status=="waitapprove" && result[0].img_donationpath!=""){

	      		$(".step2process").css("display","inline-block");

				//close
				$(".step1process").css("display","none");
				$(".step3process").css("display","none");

				opencloseContexttrack();

	      	}else{

	      		$(".step3process").css("display","inline-block");

				//close
				$(".step1process").css("display","none");
				$(".step2process").css("display","none");

				opencloseContexttrack();
	      	}
	      	//window.location.reload();
	      },
	      error:function(err){
	        alert("ERROR : "+err);
	      }
	                    
	    });  



	}

	function opencloseContexttrack(){
		if($(".donationnumber").val() != ""){
			$(".stepallprocess").css("display","inline-block");

			//close bg first
			$(".stepcomeprocess").css("display","none");
		}
		else if($(".donationnumber").val() == ""){
			$(".stepallprocess").css("display","none");

			//close bg first
			$(".stepcomeprocess").css("display","inline-block");
		}
	}

</script>