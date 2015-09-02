<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการปัญหา -> ปัญหาโครงการและกิจกรรมประกาศ<?=count($reportdata).", ".count($responsedata)?></span>
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
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>ข้อมูลปัญหาโครงการและกิจกรรมประกาศ</h4>
                        
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
                                <th>หัวข้อปัญหา</th>
                                <th>วันที่ทำการเเจ้ง</th>
                                <th>ผู้เเจ้ง</th>
                                <th>สถานะปัญหา</th>
                                <th>บล็อกโครงการ</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            <div class="filterbox" style="width:100%;">
                              
                              <?=form_open("dash/filter");?>
                                
                              <div class="filter-box">
                                <div class="form-group"  style="width:50%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">สถานะสมาชิก: </label>
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

                                    if(count($reportdata)==0){

                                    }else{
                                      foreach ($reportdata as $key => $value) {
                                        
                                      //print content of donation
                                      echo "<tr class='rowcontent'>";

                                        echo "<td>";
                                        echo $value['project_name'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['report_topic'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['report_create'];
                                        echo "</td>";

                                        echo "<td>";
                                        echo $value['reporter_name']; // คนแจ้ง
                                        echo "</td>";


                                        echo "<td>";
                                        echo $value['report_status']; // if status is waitapprove then it same as automatic send thank u to reporter
                                        echo "</td>";

                                        foreach ($allproject as $key => $valueproject) {
                                          if($valueproject['project_id']==$value['project_id']){
                                            echo "<td>";
                                            echo $valueproject['block_status']; // if status is waitapprove then it same as automatic send thank u to reporter
                                            echo "</td>";
                                          }
                                        }
                                    
                                        echo "<td>";

                                          echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im".$value['report_id']."'  >";
                                            echo "<i class='fa fa-chevron-down'></i>";
                                          echo "</button>";

                                        echo "</td>";


                                      echo "</tr>";

                                      //toggle more detail

                                                  //full 
                                                    echo "<tr class='rowcontent'>";
                                                      echo "<td colspan='7' style='border-top:0'>";
                                                        echo "<div id='im".$value['report_id']."' class='collapse' >";
                                                          //content
                                                          echo "<div style='float:left;width:100%;height:auto;'>";
                                                            echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                             
                                                              echo "<p>".$value['report_detail']."</p>"; //location
                                                            
                                                              echo "<h3><b>การตอบกลับปัญหา: คลิ้กเพื่อส่งข้อความตอบกลับปัญหา</b>
                                                                      <button type='button' class='btn btn-danger'  data-toggle='collapse' data-target='#replybox".$value['report_id']."'  >
                                                                        <i class='fa fa-pencil-square'></i>
                                                                      </button>
                                                                    </h3>";

                                                              echo form_open_multipart("manageproblem/adminresponse");
                                                              //echo "<textarea  class='form-control' style='width:100%;height:150px;resize: none;padding:10px;'></textarea>";
                                                              echo "<div id='replybox".$value['report_id']."' class='collapse' >
                                                                      <input type='hidden' name='report_id' value='".$value['report_id']."' />
                                                                      <input type='hidden' name='report_type' value='".$value['report_type']."' />

                                                                      <div class='col-sm-12'>
                                                                        <textarea class='form-control' name='response_detail' style='width:50%;height:150px;resize: none;''>

                                                                        </textarea>
                                                                      </div>

                                                                      <div class='col-sm-12'>
                                                                        <input type='file' name='response_filepath' class='form-control' style='width:50%;' />
                                                                      </div>

                                                                      <div class='col-sm-12' style='margin-top:10px;'>
                                                                        <button class='btn btn-danger' type='submit' style='width:50%;'>ส่งหาเจ้าของโครงการ</button>
                                                                      </div>
                                                                    </div>";
                                                              echo form_close();

                                                              echo "<table>";
                                                                echo "<tr>
                                                                        <th>วันที่ตอบกลับ</th>
                                                                        <th>รายละเอียด</th>
                                                                        <th>เอกสารประกอบ</th>
                                                                        <th>ผู้ส่ง</th>
                                                                      </tr>";

                                                                if(count($responsedata)==0){



                                                                }else{
                                                                  foreach ($responsedata as $key => $responsevalue) {
                                                                  if($responsevalue['report_id'] == $value['report_id']){
                                                                    echo "<tr >";
                                                                      echo "<td>";
                                                                      echo $responsevalue['response_create'];
                                                                      echo "</td>";

                                                                      echo "<td>";
                                                                      echo $responsevalue['response_detail'];
                                                                      echo "</td>";

                                                                      echo "<td>";
                                                                      echo "<a href='".base_url()."assets/backend/images/reportdoc/".$responsevalue['response_filepath']."'>".$responsevalue['response_filepath']."</a>";
                                                                      echo "</td>";

                                                                      echo "<td>";
                                                                      echo $responsevalue['sender'];
                                                                      echo "</td>";
                                                                     // ($productamount[0]['productType'] == 'machine' ? $productamount[0]['colorCoffee'] : '' )
                                                                      

                                                                    echo "</tr>";

                                                                  }
                                                                  }
                                                                }


                                                              echo "</table>";

                                                              
                                                              //approve or un approve
                                                              if($value['report_status']=='waitapprove'){ 
                                                                echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"approveReport('success','".$value['report_id']."')\"><input type='button' style='width:100%;'  class='btn btn-success' value='ตรวจสอบเเล้ว' /></div>";
                                                              }else if($value['report_status']=='success'){
                                                                echo "<div style='float:left;width:50%;margin-top:10px;' onClick=\"approveReport('waitapprove','".$value['report_id']."')\"><input type='button' style='width:100%;'  class='btn btn-warning' value='ยกเลิกการตรวจสอบ' /></div>";
                                                                foreach ($allproject as $key => $valueproject) {
                                                                  if($valueproject['project_id']==$value['project_id']){
                                                                    if($valueproject['block_status']=="yes"){
                                                                      echo "<div style='float:left;width:50%;margin-top:10px;' onClick=\"approveReport('unblock','".$value['report_id']."')\"><input type='button' style='width:100%;'  class='btn btn-danger' value='ปลดบล็อคโครงการ' /></div>";
                                                                    }else{
                                                                      echo "<div style='float:left;width:50%;margin-top:10px;' onClick=\"approveReport('block','".$value['report_id']."')\"><input type='button' style='width:100%;'  class='btn btn-danger' value='บล็อคโครงการ' /></div>";
                                                                    }
                                                                  }
                                                                }
                                                              }


                                                          echo "</div>";

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

  function approveReport($action, $report_id){
    
    $.ajax({
      url: "http://localhost/haijai/manageproblem/updatestatusreport",
      type:"POST",
      cache:false,
      data:{
        action: $action,
        report_id: $report_id,
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
        

