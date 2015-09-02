
<!-- Main bar -->
    <div class="mainbar">

        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการสมาชิก -> เพิ่มสมาชิกสต๊าฟ</span>
                
            </div>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->
	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

         
          <div class="row" style="margin-top:20px;">
            <div class="col-md-12" >
              <i class="fa fa-plus-circle">&nbsp;เพิ่มสมาชิกสต๊าฟ: เพิ่มข้อมูลของสมาชิกสต๊าฟที่จะทำการเพิ่มในช่องด้านล่าง</i>
            </div>

           

            <div class="col-md-12 clearfix" style="margin-bottom:5px;"> </div>
            <?php echo form_open_multipart("managemember/addmemberstafffunction");?>

            
              
              <div class="col-md-12" style="border:solid;border-color:black;padding:1%;margin:0% 0.5% 1% 0.5%;;width:99%;">
              
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

                    <div class="col-sm-2" style="padding:15px;">
                      <span style="font-size:16;color:#253747;padding:0;">ไฟล์เอกสารเพื่อสังคมในอดีต</span>
                    </div>

                    <div class="col-sm-4" style="padding:15px;">
                      <input type="file" class="form-control society_doc" name="  " style="width:100%;" />
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

    
              </div>

              <div class="col-md-offset-10 col-md-2" >
                  <input type="hidden" class="form-control coffeeID" name="coffeeID" />
                  <input type="submit" class="form-control btn btn-success" name="btsave" style="color:white" value="บันทึก1"/><?php anchor("member","ยกเลิก") ?>
              </div>
            <?php echo form_close();?>
         
          </div>  

        </div>
		  </div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->	    	
   <div class="clearfix"></div>
  
</div>


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

</script>
