<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>รายงานธุรกรรม</span>
            </div>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->
      <!-- Matter -->

      <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12">
                <!-- Page header start -->
                <div class="page-header">
                    <div class="page-title">
                        <h3>รายงานธุรกรรม</h3>
                        <span>สวัสดี, น้องแมนน้อยน้ำใจ</span>
                    </div>
                 
                </div>
                <!-- Page header ends -->
            </div>
          </div>



          <div class="row" style="margin-top:10px;">
            
            <div class="col-md-12">
                <div class="widget boxed">

                    <div class="widget-head">
                        <h4 class="pull-left"><i class="fa fa-btc"></i>ข้อมูลธุรกรรม</h4>
                        
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
                                <th>โครงการ</th>
                                <th>ใช้กับ</th>
                                <th>วันที่ส่งคำร้อง</th>
                                <th>จำนวนเงิน</th>
                                <th>สถานะการบริจาค</th>
                                <th>ช่องทางการบริจาค</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            <div class="filterbox" style="width:100%;">
                              
                              <?=form_open("dash/filter");?>
                                
                              <div class="filter-box">
                                <div class="form-group"  style="width:30%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">สถานะ: </label>
                                  <select class="form-control" name="statusfil" style="width:70%;float:left;">
                                    <option value="notchoose">-- ทั้งหมด --</option>
                                    <option value='waiting'>waiting</option>
                                    <option value='success'>success</option>
                                    <option value='sended ems'>sended ems</option>
                                    <option value='outoftime'>outoftime</option>
                                  </select>
                                </div>

                                <div class="form-group"  style="width:25%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">จากวันที่: </label>
                                  <input type="date" name="datefromfil" class="form-control" style="width:60%;float:left;">
                                </div>

                                <div class="form-group"  style="width:25%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">ถึงวันที่: </label>
                                  <input type="date" name="datetofil" class="form-control" style="width:60%;float:left;">
                                </div> 
                                <button type="submit" style="width:15%;height:31px;line-height:12.5px;float:right;display:block;" class="btn btn-success">กรอง</button>
                              </div>
                              <?=form_close();?>

                            </div>

                            <tbody>
                                    <?php 

                                    if(count($donationdata)==0){


                                    }
                                    else{
                                    foreach ($donationdata as $key => $value) {
                                    //print content of donation
                                      echo "<tr class='rowcontent'>";

                                         //change follow inuse
                                        if ($value['inuse'] == 'project1'){
                                          echo "<td>";
                                          echo $value['project_name'];
                                          echo "</td>";
                                          
                                          echo "<td>";
                                          echo "โครงการแรก";
                                          echo "</td>";
                                        }else if ($value['inuse'] == 'project2'){
                                          echo "<td>";
                                          echo $value['project_second'];
                                          echo "</td>";
                                          
                                          echo "<td>";
                                          echo "โครงการสำรอง";
                                          echo "</td>";
                                        }else{
                                          echo "<td>";
                                          echo $value['project_perma'];
                                          echo "</td>";
                                          
                                          echo "<td>";
                                          echo "หน่วยงานไม่แสวงหาผลกำไร";
                                          echo "</td>";

                                        }
                                        

                                        
                                        echo "<td>";
                                        echo $value['donation_create'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['money'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['donation_status'];
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['donation_channel'];
                                        echo "</td>";


                                        echo "<td>";

                                          echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im".$value['donationlog_id']."'  >";
                                            echo "<i class='fa fa-chevron-down'></i>";
                                          echo "</button>";

                                        echo "</td>";


                                      echo "</tr>";

                                      //toggle more detail

                                      echo form_open("dash/confirmpayment");
                                      //echo "<input type='hidden' name='orderID' class='orderID' value='".$value['orderID']."' />";
                                      //full 
                                                    echo "<tr class='rowcontent'>";
                                                      echo "<td colspan='7' style='border-top:0'>";
                                                        echo "<div id='im".$value['donationlog_id']."' class='collapse'>";
                                                          //content
                                                          echo "<div style='float:left;width:100%;height:auto;'>";
                                                            echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                            //member data
                                                              echo "<h5><b>ข้อมูลผู้บริจาค</b></h5>";
                                                              echo "<p>ชื่อ: ".$value['member_name'].", ชื่อบัญชีในระบบ: ".$value['username']."</p>";//member_name + username
                                                              echo "<p>ที่อยู่: ".$value['location']."";//location
                                                              echo "<p>อีเมลล์:  ".$value['email'].", ต้องการรับข่าวสารผ่านทางอีเมลล์ไหม: ".$value['receiveemailnews']."</p>";//email + receiveemailnews
                                                              //change follow inuse
                                                              if ($value['inuse'] == 'project1'){
                                                                echo "<h5><b>ข้อมูลโครงการสำรอง</b></h5>";
                                                                echo "<p>โครงการสำรอง: ".$value['project_second']."</p>";//project_name2
                                                                //Permanent foundation daa
                                                                echo "<h5><b>หน่วยงานไม่แสวงหาผลกำไร</b></h5>";
                                                                echo "<p>รหัสบัญชี: ".$value['permanent_account_id'].", ชื่อบัญชี: ".$value['permanent_account_name']."</p>";//permanene_account_id + permanene_account_name
                                                                echo "<p>ธนาคารเจ้าของบัญชี: ".$value['permanent_account_banktype']."</p>";//permanene_account_bank

                                                              }else if ($value['inuse'] == 'project2'){
                                                                echo "<h5><b>ข้อมูลโครงการแรก</b></h5>";
                                                                echo "<p>โครงการแรก: ".$value['project_name']."</p>";//project_name2
                                                                //Permanent foundation daa
                                                                echo "<h5><b>หน่วยงานไม่แสวงหาผลกำไร</b></h5>";
                                                                echo "<p>รหัสบัญชี: ".$value['permanent_account_id'].", ชื่อบัญชี: ".$value['permanent_account_name']."</p>";//permanene_account_id + permanene_account_name
                                                                echo "<p>ธนาคารเจ้าของบัญชี: ".$value['permanent_account_banktype']."</p>";//permanene_account_bank

                                                              }
                                                              else{
                                                                echo "<h5><b>ข้อมูลโครงการแรก</b></h5>";
                                                                echo "<p>โครงการแรก: ".$value['project_name']."</p>";//project_name2
                                                                echo "<h5><b>ข้อมูลโครงการสำรอง</b></h5>";
                                                                echo "<p>โครงการสำรอง: ".$value['project_second']."</p>";//project_name2
                                                              }
                                                            
                                                          echo "</div>";

                                                          echo "<h5><b>รูปภาพสลิป</b></h5>";

                                                        //check more detail
                                                          //There are image -> channel is paysbuy, There are image -> channel is bank
                                                          if(($value['img_donationpath']!='' && $value['donation_channel']=='paysbuy') || ($value['img_donationpath']!='' && $value['donation_channel']!='paysbuy')){
                                        
                                                            if($value['donation_status']=='success'){
                                                              //TO DO: un approve
                                                              echo "<div style='float:left;width:100%;height:300px;'><img src='".base_url()."assets/backend/images/slip/".$value['img_donationpath']."' style='width:auto;max-height:300px;' /></div>";
                                                              
                                                              echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"approveDonation('waitapprove','".$value['donationlog_id']."')\"><input type='button'  style='width:100%;'  class='btn btn-danger' value='ยกเลิกการอนุมัติ' /></div>";
                                                            
                                                            }
                                                            else{
                                                              //TO DO: Approve
                                                              echo "<div style='float:left;width:100%;height:300px;'><img src='".base_url()."assets/backend/images/slip/".$value['img_donationpath']."' style='width:auto;max-height:300px;' /></div>";
                                                              
                                                              echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"approveDonation('success','".$value['donationlog_id']."')\"><input type='button' style='width:100%;'  class='btn btn-success' value='อนุมัติ' /></div>";
                                                            
                                                            }

                                                          }
                                                          //There are not image -> channel is paysbuy
                                                          else if($value['img_donationpath']=='' && $value['donation_channel']=='paysbuy'){
                                                            
                                                            if($value['donation_status']=='success'){
                                                              //TO DO: un approve
                                                              echo "<p style='text-align:center'>มีการชำระเงินเข้ามาในระบบของเพย์สบายแล้ว</p>";
                                                              
                                                            }
                                                            else{
                                                              //TO DO: No slip
                                                              echo "<p style='text-align:center'>ยังไม่มีการชำระเงินเข้ามาในระบบ</p>";
                                                              
  
                                                            }

                                                          }
                                                          //There are not image -> channel is bank
                                                          else{//ไม่มีรูป
                                                            //TO DO: Approve
                                                            echo "<p style='text-align:center'>ยังไม่มีการชำระเงินเข้ามาในระบบ</p>";
                                                          }

                                                        echo "</div>";
                                                      echo "</td>";
                                                    echo "</tr>";


                                      echo form_close();
                                    }
                                    }
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

  function approveDonation($action, $donationlog_id){
    
    $.ajax({
      url: "http://localhost/haijai/dash/updatestatusdonationlog",
      type:"POST",
      cache:false,
      data:{
        action: $action,
        donationlog_id: $donationlog_id,
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
      error:function(err){
        alert("ERROR : "+err);
      }
                    
    });  


  }


  


</script>
        

