<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>คำร้องขอรับเงิน</span>
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
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>ข้อมูลคำร้องขอรับเงิน</h4>
                        
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
                                <th>ชื่อโครงการ</th>
                                <th>เจ้าของโครงการ</th>
                                <th>จำนวนเงิน</th>
                                <th>วันที่สิ้นสุดโครงการ</th>
                                <th>สถานะคำร้อง</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            <div class="filterbox" style="width:100%;">
                              
                              <?=form_open("dash/filter");?>
                                
                              <div class="filter-box">
                                <div class="form-group"  style="width:50%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">สถานะคำร้องขอรับเงิน: </label>
                                  <select class="form-control" name="statusfil" style="width:70%;float:left;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value=''>รอการอนุมัติ</option>
                                    <option value=''>อนุมัตืเเล้ว</option>
                                  </select>
                                </div>

                                
                                
                                <button type="submit" style="width:15%;height:31px;line-height:12.5px;float:right;display:block;" class="btn btn-success">กรอง</button>
                              </div>
                              <?=form_close();?>

                            </div>

                            <tbody>
                                    <?php 

                                    if(count($allproject)==0){

                                    }
                                    else{
                                    foreach ($allproject as $key => $value) {
                                      
                                    //print content of donation
                                      echo "<tr class='rowcontent'>";
                                        
                                        echo "<td>";
                                        echo $value['project_name'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['member_name'];
                                        echo "</td>";

                                        
                                        echo "<td>";
                                        echo $value['money_raising'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['project_end'];
                                        echo "</td>";

                                        //if project approved request fund, project_status == 'receivemoney' then status of log will changed to success 
                                        if($value['project_status']=='success'){
                                          echo "<td>";
                                          echo "waitapprove";
                                          echo "</td>";
                                        }else{
                                          echo "<td>";
                                          echo "success";
                                          echo "</td>";
                                        }


                                        echo "<td>";

                                          echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im".$value['project_id']."'  >";
                                            echo "<i class='fa fa-chevron-down'></i>";
                                          echo "</button>";

                                        echo "</td>";


                                      echo "</tr>";

                                      //toggle more detail

                                                  //full 
                                                    echo "<tr class='rowcontent'>";
                                                      echo "<td colspan='7' style='border-top:0'>";
                                                        echo "<div id='im".$value['project_id']."' class='collapse'>";
                                                          //content
                                                          echo "<div style='float:left;width:100%;height:auto;'>";
                                                            echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                            //member 
                                                              echo "<p>ข้อมูลที่อยู่ผู้ใช้: ".$value['location']."</p>"; //location
                                                              echo "<p>ข้อมูลชีวประวัติ: ".$value['biography']."</p>"; //biography


                                                            echo "<h5><b>โครงการ</b></h5>";
                                                              echo "<p>แขวง:  ".$value['subdisdrict'].", เขต: ".$value['district'].", จังหวัด: ".$value['country'].", ประเทศ: ".$value['province']."</p>";
                                                              echo "<p>กลุ่มเป้าหมาย: ".$value['project_target']."</p>";
                                                              echo "<p>วันที่คาดว่าจะจัดทำโครงการจริง: ".$value['project_realstart']."</p>";
                                                            echo "<h5><b>รายละเอียดการที่อยู่การโอน</b></h5>";
                                                              echo "<p>ธนาคาร: ".$value['project_account_bank']."</p>";
                                                              echo "<p>ชื่อบัญชี:  ".$value['project_account_name'].",หมายเลขบัญชี: ".$value['project_account_id']."</p>";
                                                            
                                                         

                                                          //approve or un approve
                                                          if($value['project_status']=='receivemoney'){
                                                              echo "<h5 ><b>หลักฐานการโอนเงิน</b></h5>";
                                                              if($value['receive_money_evidence']!=""){
                                                                echo "<div style='float:left;width:100%;height:300px;'><img src='".base_url()."assets/backend/images/receivemoneyevidence/".$value['receive_money_evidence']."' style='width:auto;max-height:300px;' /></div>";
                                                              }
                                                              echo "<form action='receivemoneyfund/sendMoney' method='post' enctype='multipart/form-data' style='margin:0;'>";
                                                                echo "<input type='hidden' name='project_id' value='".$value['project_project_id']."' />";
                                                                echo "<input type='hidden' name='project_status' value='success' />";

                                                                echo "<div style='float:right;width:100%;margin-top:10px;' ><input type='submit' style='width:100%;'  class='btn btn-danger' value='ยกเลิกการโอนเงิน' /></div>";
                                                              echo form_close();
                                                            }
                                                            else{
                                                               //echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"approveProject('receivemoney','".$value['project_project_id']."')\"><input type='button' style='width:100%;'  class='btn btn-success' value='อนุมัติ' /></div>";
                                                              //echo form_open("receivemoneyfund/sendMoney");
                                                              echo "<form action='receivemoneyfund/sendMoney' method='post' enctype='multipart/form-data' style='margin:0;'>";
                                                                echo "<h5 ><b>อัพโหลดหลักฐานการโอนเงิน</b></h5>";
                                                                echo "<input type='hidden' name='project_id' value='".$value['project_project_id']."' />";
                                                                echo "<input type='hidden' name='project_status' value='receivemoney' />";
                                                                echo "<input type='file' name='receive_money_evidence' class='form-control' style='width:100%;' name='receive_money_evidence' />";

                                                                echo "<div style='float:right;width:100%;margin-top:10px;' ><input type='submit' style='width:100%;'  class='btn btn-success' value='โอนเงินเรียบร้อย' /></div>";
                                                              echo form_close();

                                                            }




                                                        echo "</div>";
                                                      echo "</td>";
                                                    echo "</tr>";
                                    

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
  


</script>
        

        

