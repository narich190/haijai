<!-- Main bar --> 

    <div class="mainbar" style="min-width:580px;">

        <!-- Page heading -->
        <div class="page-head" >
            <!-- Page heading -->
            <div class="bread-crumb">
                <span>จัดการโครงการ -> ข้อมูลคำร้องขอสร้างโครงการ</span>
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
                        <h4 class="pull-left"><i class="fa fa-file-text"></i>ข้อมูลคำร้องขอสร้างโครงการ</h4>
                       
                        <div class="clearfix"></div>
                    </div>

                    <div class="widget-content" style="padding-top:2px;">


                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th>โครงการ</th>
                                <th>ประเภทโครงการ</th>
                                <th>หมวดหมู่โครงการ</th>
                                <th>วันที่ส่งคำร้อง</th>
                                <th>สถานะโครงการ</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                            </thead>
                            

                            <tbody>
                                    <?php 
                                    if(count($requestproject)==0){

                                    }else{

                                      foreach ($requestproject as $key => $value) {
                                      
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
                                          echo $value['project_request']; //project_request
                                          echo "</td>";
                              

                                          echo "<td>";
                                          echo $value['project_status'];
                                          echo "</td>";


                                          echo "<td>";

                                            echo "<button type='button' class='btn btn-primary'  data-toggle='collapse' data-target='#im".$value['project_id']."'  >";
                                              echo "<i class='fa fa-chevron-down'></i>";
                                            echo "</button>";

                                          echo "</td>";


                                        echo "</tr>";

                                        //toggle more detail

                                                    //full 
                                                      echo "<tr class='rowcontent'>";
                                                        echo "<td colspan='6' style='border-top:0'>";
                                                          echo "<div id='im".$value['project_id']."' class='collapse'>";
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
                                                                echo "<p>ลิ้งสีดีโอยูทูป: ".$value['video_detailpath']."</p>";
                                                                echo "<p>เอกสารโครงการ: "."<a href='".base_url()."assets/img/project/documentproject/".$value['project_pdfpath']."'>".$value['project_name'].".pdf</a>"."</p>";
                                                            echo "</div>";
                                                            
                                                            //approve or un approve
                                                            echo "<div style='float:right;width:100%;margin-top:10px;' onClick=\"approveRequestProject('".$value['project_id']."','approve')\" ><input type='button' style='width:100%;'  class='btn btn-success' value='อนุมัติ' /></div>";
                                                          
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

  function approveRequestProject($project_id, $action){

    $.ajax({
        url: "http://localhost/haijai/manageproject/approveRequestProject",
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
            async: false,
            url: 'http://sagaso.asia/dash/bugsafari' // add path
          });
        },
        */
        success:function(result){
          //insert project id 
          alert(result);
          window.location.reload();
        },
        error:function(err){
          alert("ERROR : "+err);
        }
                      
      });

  }


</script>

