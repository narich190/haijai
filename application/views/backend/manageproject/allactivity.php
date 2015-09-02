<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการโครงการ -> ข้อมูลกิจกรรมประกาศทั้งหมด</span>
            </div>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->
      <!-- Matter -->

      <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row" style="margin-top:10px;">
            
            <div class="col-md-12">
                <div class="widget boxed">

                    <div class="widget-head">
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>ข้อมูลกิจกรรมประกาศทั้งหมด</h4>
                        
                        <div class="pull-right" style="width:10%;margin-right:10px;" >
                          <button type="button" class="btn btn-default filterbutton" onClick="showfilterbox();"  style="margin:2px 10px 2px 6px;width:100%;" aria-label="Left Align">
                            <span style="align:center" aria-hidden="true">กรองข้อมูล</span>
                          </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="widget-content" style="padding-top:2px;">


                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th>กิจกรรมประกาศ</th>
                                <th>ประเภทโครงการ</th>
                                <th>หมวดหมู่โครงการ</th>
                                <th>วันที่ส่งคำร้อง</th>
                                <th>สถานะกิจกรรมประกาศ</th>
                                <th>บล็อค</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            <div class="filterbox" style="width:100%;">
                              
                              <?=form_open("manageproject/activityfilter");?>
                                
                              <div class="filter-box">
                                <div class="form-group"  style="width:50%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">ประเภทโครงการ: </label>
                                  <select class="form-control" name='project_type'  style="width:70%;float:left;" >
                                    <option value='notchoose' selected>โครงการทั้งหมด</option>
                                    <option value='ระดมทุน'>โครงการระดมทุน</option>
                                    <option value='รับบริจาค'>โครงการรับบริจาค</option>
                                  </select>
                                </div>

                                <div class="form-group"  style="width:50%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">หมวดหมู่โครงการ: </label>
                                  <select class="form-control" name='project_group_projectgroup_id'  style="width:70%;float:left;">
                                    <option value='notchoose' selected>ทุกหมวดหมู่</option>
                                    <option value='1'>เด็ก/ สตรี/ เยาวชน</option>
                                    <option value='2'>คนชรา/ คนพิการ</option>
                                    <option value='3'>ขนกลุ่มน้อย</opion>
                                    <option value='4'>คนไร้บ้าน/ ที่อยู่อาศัย</opion>
                                    <option value='5'>สิทธิมนุษยชน</opion>
                                    <option value='6'>สัตว</opion>
                                    <option value='7'>พลังงาน/ สิ่งแวดล้อม</opion>
                                    <option value='8'>การศึกษา</option>
                                    <option value='9'>ศาสนา/ ศิลปวัฒนธรรม</option>
                                    <option value='10'>สุขภาพ/ ยา</option>
                                    <option value='11'>ฉุกเฉิน/ ความปลอดภัย</option>
                                    <option value='12'>ภัยพิบัติ</option>
                                    <option value='13'>คอมพิวเตอร์/ IT</option>
                                    <option value='14'>สื่อ/ การกระจายเสียง</option>
                                    <option value='15'>กีฬา/ สันทนาการ</option>
                                    <option value='16'>สวัสดิการ และ สังคม</option>
                                  </select>

                                </div>

                               
                                <div class="form-group"  style="width:40%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">จากวันที่: </label>
                                  <input type="date" name="datefromfil" class="form-control" style="width:70%;float:left;">
                                </div>

                                <div class="form-group"  style="width:40%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">ถึงวันที่: </label>
                                  <input type="date" name="datetofil" class="form-control" style="width:70%;float:left;">
                                </div> 
                                <button type="submit" style="width:15%;height:31px;line-height:12.5px;float:right;display:block;" class="btn btn-success">กรอง</button>
                              </div>
                              <?=form_close();?>

                            </div>

                            <tbody>
                                   <?php 
                                    if(count($requestactivity)==0){

                                    }else{

                                      foreach ($requestactivity as $key => $value) {
                                    
                                    //print content of donation
                                      echo "<tr class='rowcontent'>";
                                        
                                        echo "<td>";
                                        echo $value['project_name'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['project_type'];
                                        echo "</td>";

                                        
                                        echo "<td>";
                                        echo $value['projectgroup_name'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['activity_request'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['activity_status'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['activity_block_status'];
                                        echo "</td>";


                                        echo "<td>";

                                          echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im".$value['activity_id']."'  >";
                                            echo "<i class='fa fa-chevron-down'></i>";
                                          echo "</button>";

                                        echo "</td>";


                                      echo "</tr>";

                                      //toggle more detail

                                                  //full 
                                                    echo "<tr class='rowcontent'>";
                                                      echo "<td colspan='7' style='border-top:0'>";
                                                        echo "<div id='im".$value['activity_id']."' class='collapse'>";
                                                          //content
                                                            echo "<div style='float:left;width:100%;height:auto;'>";
                                                              echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                              //member data
                                                                echo "<h5><b>ข้อมูลผู้ส่งคำร้อง</b></h5>";
                                                                echo "<p>ชื่อ:  ".$value['member_name'].", ชื่อบัญชีในระบบ: ".$value['username']."</p>";//member_name + username
                                                                echo "<p>ที่อยู๋: ".$value['location']."</p>";//location
                                                                echo "<p>อีเมลล์:  ".$value['email'].", ต้องการรับข่าวสารผ่านทางอีเมลล์ไหม: ".$value['receiveemailnews']."</p>";//email + receiveemailnews
                                                              
                                                              //project_detail
                                                                echo "<h5><b>รายละเอียดโครงการ</b></h5>";
                                                                echo "<p>พรีวิวโครงการ: ".$value['project_preview']."</p>";
                                                                echo "<img src='".base_url()."assets/img/project/profile/".$value['img_previewpath']."' style='width:auto;max-height:150px;' />"; //img_previewpath
                                                                echo "<p>รายละเอียดเชิงลึกโครงการ: </p>";
                                                                echo "<img src='".base_url()."assets/img/project/header/".$value['img_detailpath']."' style='width:auto;max-height:150px;' />"; //img_detailpath
                                                                echo "<p>แขวง:  ".$value['subdisdrict'].", เขต: ".$value['district'].", จังหวัด: ".$value['country'].", ประเทศ: ".$value['province']."</p>";
                                                                echo "<p>กลุ่มเป้าหมาย: ".$value['project_target']."</p>";
                                                                echo "<p>วันที่คาดว่าจะจัดทำโครงการจริง: ".$value['project_target']."</p>";
                                                                if($value['project_type']=='ระดมทุน'){
                                                                  echo "<p>จำนวนเงินที่คาดหวัง: ".$value['money_expect']." บาท</p>";
                                                                }else{
                                                                  echo "<p>สิ่งของที่คาดหวัง: ".$value['item_expect']."</p>";
                                                                }
                                                                echo "<p>ลิ้งวีดีโอยูทูป: ".$value['video_detailpath']."</p>";
                                                                echo "<p>เอกสารโครงการ: "."<a href='".base_url()."assets/img/project/documentproject/".$value['project_pdfpath']."'>".$value['project_name'].".pdf</a>"."</p>";
                                                                 //project_detail
                                                                echo "<h5><b>รายละเอียดกิจกรรมประกาศ</b></h5>";
                                                                echo "<img src='".base_url()."assets/img/activity/header/".$value['activityimg']."' style='width:auto;max-height:150px;' /><br>"; //img_previewpath
                                                                echo $value['activity_deepdetail'];
                                                                echo "<p>ลิ้งวีดีโอยูทูปกิจกรรมประกาศ: ".$value['activityvideo']."</p>";
                                                                echo "<p>เอกสารกิจกรรมประกาศ: "."<a href='".base_url()."assets/img/activity/documentproject/".$value['activity_pdfpath']."'>"."activity-".$value['project_name'].".pdf</a>"."</p>";

                                                                
                                                          echo "</div>";
                                                          if($value['activity_block_status']=="no"){ 
                                                            echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"blockProjectManage('".$value['project_id']."','yes')\" ><input type='button' style='width:100%;'  class='btn btn-danger' value='บล็อคโครงการ' /></div>";
                                                          }else{
                                                            echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"blockProjectManage('".$value['project_id']."','no')\" ><input type='button' style='width:100%;'  class='btn btn-warning' value='ปลดบล็อคโครงการ' /></div>";
                                                          }
                                                          
                                                        echo "</div>";
                                                      echo "</td>";
                                                    echo "</tr>";
                                      } }                                
                                 ?>

                            </tbody>
                        </table>

                    </div>

                  

                    <div style="float:right">
                           <?=$this->pagination->create_links();?>
                    </div>

                </div>
            </div>
          </div> 

        </div>
      </div>

    <!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->        
   <div class="clearfix"></div>

  
</div>


<script type="text/javascript">

  function blockProjectManage($project_id,$action){
    //alert($project_id+", "+$action);
    
    $.ajax({
      url: "http://localhost/haijai/manageproject/blockProjectManage",
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
          async: false,''
          url: 'http://sagaso.asia/dash/bugsafari' // add path
        });
      },
      */
      success:function(result){
        alert(result);
        window.location.reload();
      },
      error:function(err){
        alert("ERROR : "+err);
      }
                    
    });  
  

  }



</script>
        

