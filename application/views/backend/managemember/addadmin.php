
<!-- Main bar -->
    <div class="mainbar">

        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการสมาชิก -> เพิ่มผู้ดูแลระบบ</span>
                
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
              <i class="fa fa-plus-circle">&nbsp;เพิ่มผู้ดูแลระบบ: เพิ่มข้อมูลของผู้ดูแลระบบที่จะทำการเพิ่มในช่องด้านล่าง</i>
            </div>

           

            <div class="col-md-12 clearfix" style="margin-bottom:5px;"> </div>
            <?php echo form_open_multipart("managemember/addadminfunction");?>

              <div class="col-md-12" style="border:solid;border-color:black;padding:1%;margin:0% 0.5% 1% 0.5%;;width:99%;">
                
                <div class="col-md-8" style="padding-left:0%;padding-right:0%;">
                  <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                    username:
                  </div> 
                  <div class="col-md-10" style="padding-left:10;">
                    <input type="text" class="form-control spp" name="username" style="width:100%;" required/>
                  </div>
                  <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                    password:
                  </div> 
                  <div class="col-md-10" style="padding:10;">
                    <input type="text" class="form-control spp" name="password" style="width:100%;" required/>
                  </div>
                  <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                    ประเภทของผู้ดูแลระบบ:
                  </div> 
                  <div class="col-md-10" style="padding:10;">
                    <select style="width:100%;" name="MemberRole" class="form-control">
                      <option value='admin_donator'>จัดการรายการบริจาค</option>
                      <option value='admin_project'>จัดการโครงการ</option>
                      <option value='admin_receivemoney'>จัดการการจ่ายเงิน</option>
                      <option value='admin_problem'>จัดการปัญหา</option>
                      <option value='admin_member'>จัดการสมาชิก</option>
                    </select>
                  </div>
                </div> 

                <!--profile image-->
                <div class="col-md-4" style="padding-left:0%;padding-right:0%;margin-top:7px;">
                  <div class="col-sm-12" style="text-align:center;">
                    <input type='file' name="img_profilepath" id="img_profilepath" style="margin:0 auto;height:0px;overflow:hidden;border:0;"/>
                    <img id="blahadmin" src="<?=base_url()?>assets/img/main/slipupload.png" onclick="chooseFileadmin();" alt="your image" style="width:40%;height:30%;" />
                    <br><br>
                    <div class="buttonUplaod" style="width:100%;display:none;"> 
                      <button class="btn btn-warning" type="button" onClick="chooseFileadmin();" style="width:50%">เปลี่ยนรูป</button>
                    </div>
                  </div>
                </div>  

                <div class="col-md-12" style="border:solid;border-color:black;margin:1% 0% 1% 0%;width:100%;"><!--clear fix--></div>

                <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                  ชื่อผู้ดูแลระบบ: 
                </div>  
                <div class="col-md-10" style="padding-left:0%;padding-right:0%;">
                  <input type="text" class="form-control coffeename" name="member_name" style="width:100%;" required/>
                </div>

                <div class="col-md-12" style="margin:0% 0% 1% 0%;width:100%;"><!--clear fix--></div>

                <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                  ข้อมูลชีวประวัติ: 
                </div>  
                <div class="col-md-10" style="padding-left:0%;padding-right:1%;margin:2px 0px;">
                  <textarea class="form-control introductionCoffee" name="biography" style="width:100%;min-width:100%;max-width:100%;height:100px;min-height:100px;max-height:100px;" required></textarea>
                </div>

                <div class="col-md-2" style="padding-left:0%;padding-right:0%;">
                  ข้อมูลที่อยู่:
                </div>  
                <div class="col-md-10" style="padding-left:0%;padding-right:1%;margin:2px 0px;">
                  <textarea class="form-control headerofcoffee" name="location" style="width:100%;min-width:100%;max-width:100%;height:100px;min-height:100px;max-height:100px;" required></textarea>
                </div>

                
              </div>

              <div class="col-md-offset-10 col-md-2" >
                  <input type="hidden" class="form-control coffeeID" name="coffeeID" />
                  <input type="submit" class="form-control btn btn-success" name="btsave" style="color:white" value="บันทึก"/><?php anchor("member","ยกเลิก") ?>
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

  function chooseFileadmin(){
    $("#img_profilepath").click();
    //alert("ddfd");
  }

  function readURL(input) {

      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blahadmin').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }

      $(".buttonUplaod").css("display","inline-block");
  }

  $("#img_profilepath").change(function(){
      //alert("sldjshd");
      readURL(this);
  });
</script>
