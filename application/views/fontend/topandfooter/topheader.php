<html>
<head>
	<title>Haijai:: way of the opportunity</title>
	<meta charset="UTF-8"/>
	<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/css/firstpage.css" rel="stylesheet" media="screen">	
	<link href="<?=base_url()?>assets/css/overviewpage.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/css/detailprojectfund.css" rel="stylesheet" media="screen">
<!--
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
-->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome-4.4.0/css/font-awesome.min.css">
	<script src="<?=base_url()?>assets/javascript/jquery2.0.min.js"></script>
	<script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>


	

	
</head>
<body style="margin:0;padding:0;">

<header style="height:70px;width:100%;">

	<div class="container" style="height:100%;width:100%;padding:0;">
	    <nav class="navbar navbar-default" role="navigation"  style="height:70px;width:100%;background:#FFFFFF;padding:2 40;">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
	                    class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="<?=base_url()?>main">
	            	<img src="<?=base_url()?>assets/img/main/logo1.png" style="width:120;height:40px;"/>
	            </a>
	        </div>
	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:8 40;">
	        	<ul class="nav navbar-nav navbar-left" >
	        		<li>
	        			<a href="<?=base_url()?>tracking" style="padding:15px;">
		                 	<span style="font-size:20;"><i class="fa fa-university"></i>&nbsp;ติดตามรายการธุรกรรม</span>
						</a>
	        		</li>
	        		<?php 
	        			if($this->session->userdata('membersession')!=""){	
	        		?>
	        		<li>
	        			<a href="<?=base_url()?>project/createproject" style="padding:15px;">
		                 	<span style="font-size:20;"><i class="fa fa-plus-square"></i>&nbsp;สร้างโครงการ</span>
						</a>
	        		</li>
	        		<?php }?>
	        	</ul>

	            <ul class="nav navbar-nav navbar-right afterlogin" style="display:none;">

	            	<li>
	            		<a href="<?=base_url()?>profile/index/<?=$this->session->userdata('membersession')!=''? $this->session->userdata['membersession']['member_id']: '';?>" style="padding:0;">
		                 	<img src="<?=base_url()?>assets/img/profile/<?=$this->session->userdata('membersession')!=''? $this->session->userdata['membersession']['img_profilepath']: '';?>" style="width:50;height:50px;
							border-radius: 25px;
							-webkit-border-radius: 25px;
							-moz-border-radius: 25px;"/>
						</a>
	                </li>
	                <li style="padding:2"> <span>สวัสดี <?=$this->session->userdata('membersession')!=''? $this->session->userdata['membersession']['member_name']: '';?></span>
	                	<div>
	                	<a href="#" style="padding:0;" class="dropdown-toggle" data-toggle="dropdown">
	                		<i class="fa fa-bell-o" style="font-size:20px;"></i>
	                		<span class="label label-warning" id="numberofnoti">0</span>
		                </a>
		                <ul class="dropdown-menu notification" >
		                	<!--
		                    <li><a href="#">
		                    	<span class="label label-warning">4:00 AM</span>
		                    	Favourites Snippet
		                    </a></li>
		                    -->
		                </ul>
		               
	                   	<a href="<?=base_url()?>messagebox">
	                   		<i class="fa fa-inbox" style="font-size:20px;"></i>
	                   		<span class="label label-danger messagenumber">0</span>
		                </a>
		                

	                	<a href="<?=base_url()?>control/fontendlogout" style="padding:0;">ออกจากระบบ</a>
	                	<div>
	                </li>
	                
	            </ul>

	            <ul class="nav navbar-nav navbar-right beforelogin">
	            	 <li>
	            		<a href="<?=base_url()?>register" style="padding:8 3 0 0;margin:0;"><button class="btn btn-primary">สมัครสมาชิก</button></a>
	                </li>
	            	<li>
	            		<a  dclass="dropdown-toggle" href="#" data-toggle="dropdown" style="padding:8 3 0 0;margin:0;"><button class="btn btn-warning">เข้าสู่ระบบ</button></a>
	                	<ul class="dropdown-menu extended" style="white-space: nowrap;width:300px;padding:30px;
					    overflow-x: hidden;
					    overflow-y: visible;">
					    	<li>
					    		<?=form_open("control/checkloginfontend");?>
								  	<div class="form-group">
									  	<div class="input-group">
									    	<div class="input-group-addon"><i class="fa fa-user"></i></div>
									      	<input type="text" name="username" class="form-control" placeholder="username" />
									    </div>
									    <div class="input-group">
									    	<div class="input-group-addon"><i class="fa fa-key"></i></div>
									      	<input type="text" name="password" class="form-control" placeholder="password" />
									    </div>
								  	</div>
								  	<button type="submit" style="width:100%;"  class="btn btn-success">เข้าสู่ระบบ</button>
								<?=form_close()?>
					    		<hr>
								<button type="submit"  style="width:100%;" class="btn btn-primary">เข้าสู่ระบบด้วย Facebook</button>

					    	</li>
					    </ul>
	                </li>
	               

	                
	            </ul>

	        </div>
	        <!-- /.navbar-collapse -->
	    </nav>
	</div>

	

	
</header>
<script type="text/javascript">

	
		var searchstaffboxvalue = "";	
		$(document).ready(function(){
			var nowloginyet = "<?=$this->session->userdata['membersession']['member_name'];?>";
		
			if(nowloginyet != ""){
				$(".afterlogin").css("display","block");
				$(".beforelogin").css("display","none");

			}else{
				$(".afterlogin").css("display","none");
				$(".beforelogin").css("display","block");
			}
			

			$("#searchstaffbox").keyup(function(){
				//lert($("#searchcoffeebox").val());
				searchstaffboxvalue = $("#searchstaffbox").val(); //alert(searchvalue);
				//searchbytopic();
				//testa();
				
				searchbystaffbox();
			});

			setInterval(function () {checkNewMess()}, 1000);
			setInterval(function () {checkNewNoti()}, 1000);
			setInterval(function () {checkNewSuccess()}, 1000);


		});

		



		function checkNewMess(){
    		//alert("hg");
                $.ajax({
                    url: "http://localhost/haijai/main/checkRowMessagebox",
                    type:"POST",
                    cache:false,
                    dataType:"JSON",
                    success:function(result){
                  
                       // console.log(JSON.stringify(result));
                        displayMessNoti(result);
                        //alert(result);
                        //alert(result.length);
                    }
                });
		}

        
    
        function displayMessNoti($result){
               
                $(".messagenumber").html($result.length);
           
        }


        function checkNewNoti(){
    		//alert("hg");
                $.ajax({
                    url: "http://localhost/haijai/main/checkRowNoti",
                    type:"POST",
                    cache:false,
                    dataType:"JSON",
                    success:function(result){
                  
                       // console.log(JSON.stringify(result));
                        displayNoti(result);
                        //alert(result);
                        //alert(result.length);
                    }
                });
		}

        
    
        function displayNoti($result){
                //alert($result.length);
                
                $pukval = "";
                $nonoti = 0; //เพิ่ม
                // add value to newres
                for($i=0;$i<$result.length;$i++){
                         //alert("val"+$i);
                         
                        if($i==0){
                            $pukval += "<li class='title'>"+
                                            "<p>&nbsp;&nbsp;&nbsp;New notifications</p>"+
                                        "</li>";
                        }

                                    $sie = "";
                                    if($result[$i].readStatus == "notread"){
                                        $sie = "background:#CCE9FB;";
                                        $nonoti++;
                                    }
                             
                                    
                                        $pukval += "<li style='height:60px;"+$sie+"'>"+
                                                        "<a href='javascript:void(0);' onClick=\"gotoByNoti('"+$result[$i].notiLink+"','"+$result[$i].notiID+"')\">"+
                                                                    "<span class='label label-success'>"+
                                                                        "<i class='fa fa-chevron-circle-right'></i>"+
                                                                    "</span>"+
                                                            "<span class='message' >&nbsp;&nbsp;&nbsp;"+$result[$i].notiDetail+"</span>"+"<br>"+
                                                            "<span class='time'>"+$result[$i].notiCreate+"</span>"+
                                                        "</a>"+
                                                    "</li>";       
                        			
                }
                

                $("#numberofnoti").text($nonoti);
                $('.notification').html($pukval);
                
           

        }

        function gotoByNoti($linkpath,$notiID){

        		 $.ajax({
                    url: "http://localhost/haijai/main/editReadNoti",
                    type:"POST",
                    cache:false,
                    data:{
				        notiID: $notiID,
			      	},
			      	dataType:"JSON",
                    success:function(result){
                  
                       // console.log(JSON.stringify(result));
                        //displayNoti(result);
                        //alert(result);
                        //alert(result.length);
                        window.location.replace("<?=base_url()?>"+$linkpath);
                    }
                });

        }


        function checkNewSuccess(){
    		//alert("hg");
                $.ajax({
                    url: "http://localhost/haijai/main/checkNewSuccessProject",
                    type:"POST",
                    cache:false,
                    dataType:"JSON",
                    success:function(result){
                  
                       // console.log(JSON.stringify(result));
                        //displayMessNoti(result);
                        //alert(result);
                        //alert(result.length);
                    },
                });
		}



		function searchbystaffbox(){
	
			if(searchstaffboxvalue!=""){

				$.ajax({
					
					url:"http://localhost/haijai/project/searchbystaffbox",
					type:"POST",
					cache:false,
					data:{
						searchstaffboxvalue: searchstaffboxvalue,
						//project_id: $(".project_id").val()
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
						
						$htmlval = "";
						result.forEach(function(entry) {
							//alert("sss");
						    $htmlval += "<tr><td class='success' style='width:80%;'>"+entry['member_name']+"</td><td class='success' style='width:20%;'><button class='btn btn-primary'  onClick=\"selectStafftoProject(\'"+entry['member_id']+"\',\'"+$(".project_id").val()+"\');\" style='float:right;width:100%;'>Choose</button></td></tr>";
						});

						$("#searchstafftable").html($htmlval);
					},
					
				
				});
				

			}

			else{
				$("#searchstafftable").html("");
			}
	

		}

		function selectStafftoProject($member_id, $project_id){

				$.ajax({
					
					url:"http://localhost/haijai/project/selectStaff",
					type:"POST",
					cache:false,
					data:{
						member_id: $member_id,
						project_id: $project_id,
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

						if(result == "อัพเดทข้อมูลสต๊าฟโครงการเรียบร้อย"){
							window.location.reload();
						}
					},
					
				
				});
				

		}

		
</script>
