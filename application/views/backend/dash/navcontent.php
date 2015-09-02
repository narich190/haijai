<!-- Main content starts -->

<div class="content">

    <!-- Sidebar -->
    <div class="sidebar sidebar-fixed">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <div class="sidebar-inner" id="sidebarmanmade" width="100%">
            <!-- Search form -->
            <div class="sidebar-widget">
                <form class="sidebar-search">
                    <div class="input-box">
                        <button class="submit" type="submit">
                            <i class="icon-search"></i>
                        </button>
                          <span>
                            <input type="text" placeholder="Search...">
                          </span>
                    </div>
                </form>
            </div>

            <!--- Sidebar navigation -->
            <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
            <ul class="navi">

                <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->
                <?php if($this->session->userdata['adminsession']['admin_type']=='admin_donator'){ ?>
                <li class="current"><a href="<?=base_url()?>dash"><i class="fa fa-btc"></i> รายงานธุรกรรม</a></li>
                <?php } ?>

                <!-- Menu with sub menu -->
                <?php if($this->session->userdata['adminsession']['admin_type']=='admin_project' ){ ?>
                    <li><a href="<?=base_url()?>manageproject"><i class="fa fa-newspaper-o"></i> ข้อมูลคำร้องขอสร้างโครงการ</a></li>
                    <li><a href="<?=base_url()?>manageproject/allproject"><i class="fa fa-newspaper-o"></i> โครงการทั้งหมด</a></li>
                    <li><a href="<?=base_url()?>manageproject/requestmanageactivity"><i class="fa fa-newspaper-o"></i> ข้อมูลคำร้องขอสร้างกิจกรรมประกาศ</a></li>
                    <li><a href="<?=base_url()?>manageproject/allactivity"><i class="fa fa-newspaper-o"></i> กิจกรรมประกาศทั้งหมด</a></li>
                <?php } ?>



                <?php if($this->session->userdata['adminsession']['admin_type']=='admin_member'){ ?>
                    <li><a href="<?=base_url()?>managemember"><i class="fa fa-users"></i> สมาชิกทั้งหมด</a></li>
                    <li><a href="<?=base_url()?>managemember/addmemberstaff"><i class="fa fa-users"></i> เพิ่มสมาชิกสต๊าฟ</a></li>
                    <li><a href="<?=base_url()?>managemember/addadminpage"><i class="fa fa-users"></i> เพิ่มผู้ดูแลระบบ</a></li>
                    <li><a href="<?=base_url()?>managemember/alladmin"><i class="fa fa-users"></i> ผู้ดูแลระบบทั้งหมด</a></li>
                    
                <?php } ?>
                

                <?php if($this->session->userdata['adminsession']['admin_type']=='admin_receivemoney' ){ ?>
                    <li><a href="<?=base_url()?>receivemoneyfund"><i class="fa fa-check-circle-o"></i>คำร้องขอรับเงิน</a></li>
                <?php } ?>


                <?php if($this->session->userdata['adminsession']['admin_type']=='admin_problem'){ ?>
                    <li><a href="<?=base_url()?>manageproblem"><i class="fa fa-exclamation-triangle"></i> ปัญหาโครงการและกิจกรรมประกาศ</a></li>
                    <li><a href="<?=base_url()?>manageproblem/generalproblem"><i class="fa fa-exclamation-triangle"></i> ปัญหาทั่วไป</a></li>
                        
                <?php } ?>

               
                <?php if( $this->session->userdata['adminsession']['admin_type']=='admin_boss' ){ ?>
                    <li class="current"><a href="<?=base_url()?>dash"><i class="fa fa-btc"></i> รายงานธุรกรรม</a></li>
                    <li class="has_submenu">
                        <a href="#">
                            <!-- Menu name with icon -->
                            <i class="fa fa-newspaper-o"></i> จัดการโครงการ
                        </a>
                        <ul>
                            <li><a href="<?=base_url()?>manageproject">ข้อมูลคำร้องขอสร้างโครงการ</a></li>
                            <li><a href="<?=base_url()?>manageproject/allproject">โครงการทั้งหมด</a></li>
                            <li><a href="<?=base_url()?>manageproject/requestmanageactivity">ข้อมูลคำร้องขอสร้างกิจกรรมประกาศ</a></li>
                            <li><a href="<?=base_url()?>manageproject/allactivity">กิจกรรมประกาศทั้งหมด</a></li>
                        </ul>
                    </li>
                    <li class="has_submenu">
                        <a href="#">
                            <!-- Menu name with icon -->
                            <i class="fa fa-users"></i> จัดการสมาชิก
                        </a>
                        <ul>
                            <li><a href="<?=base_url()?>managemember">สมาชิกทั้งหมด</a></li>
                            <li><a href="<?=base_url()?>managemember/addmemberstaff">เพิ่มสมาชิกสต๊าฟ</a></li>
                            <li><a href="<?=base_url()?>managemember/addadminpage">เพิ่มผู้ดูแลระบบ</a></li>
                            <li><a href="<?=base_url()?>managemember/alladmin">ผู้ดูแลระบบทั้งหมด</a></li>
                        </ul>
                    </li>
                    <li><a href="<?=base_url()?>receivemoneyfund"><i class="fa fa-check-circle-o"></i>คำร้องขอรับเงิน</a></li>
                    <li class="has_submenu">
                        <a href="#">
                            <!-- Menu name with icon -->
                            <i class="fa fa-exclamation-triangle"></i> จัดการปัญหา
                        </a>
                        <ul>
                            <li><a href="<?=base_url()?>manageproblem">ปัญหาโครงการและกิจกรรมประกาศ</a></li>
                            <li><a href="<?=base_url()?>manageproblem/generalproblem">ปัญหาทั่วไป</a></li>
                        </ul>
                    </li>

                <?php } ?>
                

            </ul>

        </div>
    </div>
    <!-- Sidebar ends -->



