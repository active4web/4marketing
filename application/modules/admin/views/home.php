<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='home';
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>لوحة التحكم</title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
        <!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include ("design/inc/sidebar.php");?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->

                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!--<ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Dashboard</span>
                        </li>
                    </ul>-->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>admin/banks/requested_courses/">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php
$job_messages=$this->db->get_where("request_courses",array("view"=>'0'))->result();
echo count($job_messages);?>"></span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small style="font-size:13px">طلبات الأعلانات</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-credit-card-front"></i>
                                    </div>
                                </div>
</a>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>admin/tickets/show">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
											<span data-counter="counterup" data-value="<?php $job_messages=$this->db->get_where("tickets",array("status_id"=>'0'))->result();
echo count($job_messages);?>"></span> </h3>
                <small style="font-size:13px">التذاكر</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-envelope"></i>
                                    </div>
                                </div>
</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>admin/users/customers">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="<?php
$job_messages=$this->db->get_where("customers")->result();
echo count($job_messages);?>"></span>
                                        </h3>
                                        <small style="font-size:13px">المستخدمين</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-users"></i>
                                    </div>
                                </div>
</a>
                            </div>
                        </div>
                         <div class="col-lg-12"><br><br></div>
                         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>admin/courses/inside">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
<span data-counter="counterup" data-value="<?php
$job_messages=$this->db->get_where("products",array("view"=>'0'))->result();
echo count($job_messages);?>"></span>
                                        </h3>
                                        <small style="font-size:13px">الاعلانات</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-opencart"></i>
                                    </div>
                                </div>
</a>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
								
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($total_visitor);?>"></span>
                                        </h3>
                                        <small style="font-size:13px">الزيارات </small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-users"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
								
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($total_visitor);?>"></span>
                                        </h3>
                                        <small style="font-size:13px">الزائرين</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-users"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
    </body>
</html>
