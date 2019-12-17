<?php
$url=base_url();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='messages';
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
<title>تفاصيل الرسالة </title>
<?php include ("design/inc/header.php");?>
<style>
button, input, select, textarea,.maindata {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    padding: 10px 20px 10px 20px;
    border-radius: 0.4em;
    background:#227216;
    color: #fff;
    font-size: 13px;
    border: 0px;
	line-height: 30px;
	height:40px;
}

</style>
<?php
foreach($messages_data as $result){
$name = $result->name;
$mail = $result->mail;
$name_org = $result->name_org;
$phone = $result->phone;
$date = $result->date;
}
?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
	<!-- BEGIN HEADER -->
	<?php include ("design/inc/topbar.php");?>
		<script type="text/javascript" src="<?=$url?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=$url?>design/ckfinder/ckfinder.js"></script>
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
				<div class="page-content" style="min-height: 1261px;">
					<!-- BEGIN PAGE HEAD-->

					<!-- END PAGE HEAD-->
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$url.'admin';?>">لوحة التحكم</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$url.'admin/messages/messages_services';?>">نماذج التواصل مع المنشاءات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active"> تفاصيل الرسالة</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->
					<!-- BEGIN PAGE BASE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<!-- PORTLET MAIN -->
								<!-- END PORTLET MAIN -->
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="col-md-12">
										<!--Start from-->
										<div class="tab-content">
											<div class="tab-pane active" id="tab_5">
												<div class="portlet box blue ">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-gift"></i> التفاصيل  </div>
															<div class="caption"  style="float:left;margin-left:120px;">
															<a href="<?= DIR?>admin/messages/replay?email=<?= $mail?>&type=0" style="color:#fff">
															<i class="fa fa-reply"></i>الرد
															</a>
															</div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
												
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<form action="#" class="form-horizontal form-bordered"
															 method="post" enctype="multipart/form-data">
																<div class="form-body">
															
																<div class="form-group">
																		<div class="col-md-6" style="text-align:center">
														<input type="text"  style="text-align:left;direction:ltr" readonly value="<?php echo $date?>">
																		</div>
																		<div class="col-md-6" style="text-align:center">
																		<input type="text" readonly value="<?php echo $name?>" style="text-align:center" >
																		</div>
																	</div>

																<div class="form-group">
																		<div class="col-md-12" style="text-align:center">
																		<input type="text" style="text-align:left;" readonly value="<?php echo $mail?>">
																		</div>
																	</div>

																	<div class="form-group">
																	<div class="form-group">
																		<div class="col-md-12 maindata" style="text-align:center;height:150px">
																		ممثل المنشاءة:<?= $name;?>
																		<br>
																		المشاءة:<?= $name_org;?>
																		<br>
																		التليفون:<?= $phone;?>
																		
																			<!-- <?php //echo $this->ckeditor->editor("description","description");?> -->
																			
																		</div>
																	</div>


																

																	
															</form>
															<!-- END FORM-->
															</div>
														</div>

													</div>
													<!---END FROM-->
												</div>
											</div>
											<!-- END PROFILE CONTENT -->
										</div>
									</div>
									<!-- END PAGE BASE CONTENT -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
<script>
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
        window.location.assign("show");
    });
});
</script>
<script type="text/javascript">
	//CKEDITOR.replace('description');
	var about_site = CKEDITOR.replace( 'about_site' );
	var about_site_ar = CKEDITOR.replace( 'about_site_ar' );
	CKFinder.setupCKEditor( about_site );
	CKFinder.setupCKEditor( about_sabout_site_arite );
</script>
</body>
</html>
