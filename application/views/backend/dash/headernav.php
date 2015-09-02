<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Haijai® :: </title>
   
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <!-- Stylesheets -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/css/font-awesome.css"> 

  <!--icon-->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/css/font-awesome.min.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/jquery-ui.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/prettyPhoto.css">   
  <!-- Star rating -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/bootstrap-datetimepicker.min.css">

  <!-- CLEditor -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/jquery.cleditor.css"> 
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/style/bootstrap-switch.css">
    <!-- Horizontal scroll -->
    <link href="<?=base_url()?>assets/backend/style/jquery.horizontal.scroll.css" rel="stylesheet">
    <!-- Main stylesheet -->
  <link href="<?=base_url()?>assets/backend/style/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="<?=base_url()?>assets/backend/style/widgets.css" rel="stylesheet">
    <!-- Slim slidebar stylesheet -->
    <link href="<?=base_url()?>assets/backend/style/slim_style.css" rel="stylesheet">
  <!--
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome-4.4.0/css/font-awesome.min.css">
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

  <!-- JS -->
  <script src="<?=base_url()?>assets/backend/js/jquery.js"></script> <!-- jQuery -->
  <script src="<?=base_url()?>assets/backend/js/bootstrap.js"></script> <!-- Bootstrap -->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">

    <div class="containerk">
    <!-- Menu button for smallar screens -->
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?=base_url()?>dash" class="logo-mn"><img src="<?=base_url()?>assets/images/logo_management.png"></a>
    </div>
    <!-- Site name for smallar screens -->


    <!-- Navigation starts -->
    <nav class="collapse navbar-collapse bs-navbar-collapse nav-mn" role="navigation">

   

    <!-- Notifications -->
    <ul class="nav navbar-nav navbar-right">

        <!-- notification -->
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-envelope"></i><span class="badge" id="numberofnoti"></span>
            </a>

            <ul class="dropdown-menu extended notification" style="white-space: nowrap;
    overflow-x: hidden;
    overflow-y: visible;height:300px;">

            </ul>

        </li>

        
        <!-- Profile Links -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-user-secret"></i>
                <span class="username"><?=$this->session->userdata['adminsession']['admin_name'];?></span>
                <b class="caret"></b>
            </a>
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>control/logout"><i class="fa fa-lock"></i> Logout</a></li>
            </ul>
        </li>
    </ul>

    </nav>

</div>

</div>

<script type="text/javascript">

  $(document).ready(function(){
    //alert("sdn");
    $admin_type = "<?=$this->session->userdata['adminsession']['admin_type'];?>";
    setInterval(function () {checkNewNoti($admin_type)}, 1000);

  });


    function checkNewNoti($admin_type){
        //alert("hg");
                $.ajax({
                    url: "http://localhost/haijai/control/checkRowNoti",
                    type:"POST",
                    cache:false,
                    data:{
                      admin_type: $admin_type,
                    },
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
                                                        "<a href='javascript:void(0);' onClick=\"gotoByNoti('"+$result[$i].notilink+"','"+$result[$i].notiID+"')\">"+
                                                                    "<span class='label label-success'>"+
                                                                        "<i class='fa fa-chevron-circle-right'></i>"+
                                                                    "</span>"+
                                                            "<span class='message' >&nbsp;&nbsp;&nbsp;"+$result[$i].notiDetail+"</span>"+"<br>"+
                                                            "<span class='time'>"+$result[$i].noti_time+"</span>"+
                                                        "</a>"+
                                                    "</li>";       
                              
                }
                

                $("#numberofnoti").text($nonoti);
                $('.notification').html($pukval);
                
           

        }

         function gotoByNoti($linkpath,$notiID){

             $.ajax({
                    url: "http://localhost/haijai/control/editReadNoti",
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
  

</script>