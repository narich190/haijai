<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการสมาชิก -> ข้อมูลคำร้องขอสมัครสมาชิก</span>
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
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>ข้อมูลคำร้องขอสมัครสมาชิก</h4>
                        
                        <div class="pull-right" style="width:10%;margin-right:10px;" >
                          <button type="button" class="btn btn-default filterbutton" onClick="showfilterbox();"  style="margin:2px 10px 2px 6px;width:100%;" aria-label="Left Align">
                            <span style="align:center" aria-hidden="true">กรองข้อมูล</span>
                          </button>
                        </div>

                        <div class="pull-right" style="width:10%;margin-right:10px;" >
                          <button type="button" class="btn btn-danger" onClick="deldata();" style="margin:2px 10px 2px 6px;width:100%;" aria-label="Left Align">
                            <i class="fa fa-trash-o" ></i>
                          </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="widget-content" style="padding-top:2px;">


                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th><i class="fa fa-trash-o"></i></th>
                                <th>ชื่อสมาชิก</th>
                                <th>ชื่อในระบบ</th>
                                <th>อีเมลล์</th>
                                <th>สถานะของสมาชิก</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                    <?php 
                                    //print content of donation
                                      echo "<tr class='rowcontent'>";
                                        echo "<td>";
                                        echo "<input type='checkbox' name='checkdelete'  />";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "น้องแมน น้ำใจ";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "mamiman@mail.com";
                                        echo "</td>";

                                        
                                        echo "<td>";
                                        echo "mamiman";
                                        echo "</td>";



                                        echo "<td>";
                                        echo "รอการอนุมัติ";
                                        echo "</td>";


                                        echo "<td>";

                                          echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im"."id1"."'  >";
                                            echo "<i class='fa fa-chevron-down'></i>";
                                          echo "</button>";

                                        echo "</td>";


                                      echo "</tr>";

                                      //toggle more detail

                                                  //full 
                                                    echo "<tr class='rowcontent'>";
                                                      echo "<td colspan='7' style='border-top:0'>";
                                                        echo "<div id='im"."id1"."' class='collapse'>";
                                                          //content
                                                          echo "<div style='float:left;width:100%;height:auto;'>";
                                                            echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                            //member 
                                                              echo "<img src='".base_url()."assets/images/slip/"."path"."' style='width:auto;max-height:150px;' />"; //img_profilepath
                                                              echo "<p>ข้อมูลที่อยู่ผู้ใช้: </p>"; //location
                                                              echo "<p>ข้อมูลชีวประวัติ: </p>"; //biography

                                                              echo "<p>ต้องการรับข่าวสารผ่านทางอีเมลล์ไหม: ใช่</p>";//receiveemailnews
                                                              echo "<p>สนใจในโครงการ: ใช่</p>"; //interest table

                                                            echo "<h3><b>เอกสารการยืนยันตัวตน</b></h3>";
                                                              echo "<p>สำเนาบัตรประจำตัวประชาชน: </p>";
                                                              echo "<img src='".base_url()."assets/images/slip/"."path"."' style='width:auto;max-height:150px;' />"; //img_copypersonalCardperson
                                                              echo "<p>สำเนาทะเบียนบ้าน: </p>";
                                                              echo "<img src='".base_url()."assets/images/slip/"."path"."' style='width:auto;max-height:150px;' />"; //img_copyhomeBookpath
                                                              
                                                              echo "<p>เอกสารเพื่อสังคมในอดีต: "."<a href='#'>นายน้องแมนเอกสารสังคม.pdf</a>"."</p>";

                            
                                                              
                                                          echo "</div>";
                                                          
                                                          //approve or un approve
                                                          echo "<div style='float:right;width:100%;margin-top:10px;'><input type='submit' style='width:100%;'  class='btn btn-success' value='อนุมัติ' /></div>";
                                                        
                                                        echo "</div>";
                                                      echo "</td>";
                                                    echo "</tr>";
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

        

