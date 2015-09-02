<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการปัญหา -> จัดการปัญหาทั่วไป</span>
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
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>จัดการ ปัญหาทั่วไป</h4>
                        
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
                                <th>หัวข้อปัญหา</th>
                                <th>วันที่ทำการเเจ้ง</th>
                                <th>ผู้เเจ้ง</th>
                                <th>วันที่ทำการตอบปัญหา</th>
                                <th>สถานะปัญหา</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            <div class="filterbox" style="width:100%;">
                              
                              <?=form_open("dash/filter");?>
                                
                              <div class="filter-box">
                                <div class="form-group"  style="width:50%;display:inline-block;float:left;">
                                  <label for="exampleInputEmail1" style="margin-right:10px;float:left;">สถานะปัญหา: </label>
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
                                    //print content of donation
                                      echo "<tr class='rowcontent'>";
                                       
                                        echo "<td>";
                                        echo "ส่อแววทุจริต";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "10/08/58";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "12/08/58";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "น้องแมน น้ำใจ";
                                        echo "</td>";


                                        echo "<td>";
                                        echo "ส่งอัตโนมัติไปแล้ว";
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
                                                      echo "<td colspan='6' style='border-top:0'>";
                                                        echo "<div id='im"."id1"."' class='collapse' ";
                                                          //content
                                                          echo "<div style='float:left;width:100%;height:auto;'>";
                                                            echo "<h3><b>รายละเอียดเพิ่มเติม</b></h3>";
                                                             
                                                              echo "<p>Website มีปัญหาระบบข้อความไม่คอบสนองทำงานแล้วค้าง ไม่สามารถตอบข้อความ หรือ ส่งข้อความได้ </p>"; //location
                                                            
                                                             echo "<div style='float:right;width:100%;margin-top:10px;'><input type='submit' style='width:100%;'  class='btn btn-success' value='รับทราบเเล้ว' /></div>";
                                                          echo "</div>";
                                                                  echo "</td>";
                                                                echo "</tr>";
                                                              echo "</table>";

                                                              //approve or un approve
                                                            

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

        

