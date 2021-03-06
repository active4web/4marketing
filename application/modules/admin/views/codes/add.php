<?php
//session_start();
ob_start();
if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name'] == "") {
	header("Location:" . base_url() . "admin/login");
} else {
	$id_admin = $_SESSION['id_admin'];
	$admin_name = $_SESSION['admin_name'];
	$last_login = $_SESSION['last_login'];
	$curt = 'setting';
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
<title> اضافة كود</title>
<?php include("design/inc/header.php"); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
		<?php include("design/inc/topbar.php"); ?>
		<script type="text/javascript" src="<?= $url ?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?= $url ?>design/ckfinder/ckfinder.js"></script>
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include("design/inc/sidebar.php"); ?>
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
							<a href="<?= $url . 'admin'; ?>"><?= lang('admin_panel'); ?></a>
							<i class="fa fa-circle"></i>
						</li>

		<li>
							<a href="<?= $url . 'admin'; ?>/codes/user_codes">الأكواد</a>
							<i class="fa fa-circle"></i>
						</li>
						
						
						
						<li>
							<span>إضافة كود</span>
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
															<i class="fa fa-gift"></i>إضافة كود</div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
																<input type="hidden" value="1" id="service_type">
															<form id="myForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
																<div class="form-body">
										
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block">الكود </span>
																			<input name="code" id="mainid"  type="text" placeholder="الكود" class="form-control" required>
																		</div>
																		<div class="col-md-1"></div>
																	</div>
																			<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block">نسبة الخصم</span>
                            <input name="discount" required style="direction: ltr;width: 100%;" size="18"  type="number" id="num" start="1" >
																		</div>
																		<div class="col-md-1"></div>
																	</div>
															
																			<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block"> اجمالى الاستخدام</span>
                            <input name="total_used" required style="direction: ltr;width: 100%;" size="18"  type="number" id="total_used"  start="1">
																		</div>
																		<div class="col-md-1"></div>
																	</div>
															
															
                                            <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                            <span class="help-block">عدد مرات المتاحة للمستخدم</span>
                                            <input name="total_used_user" required style="direction: ltr;width: 100%;" size="18"  type="number" id="total_used_user"  start="1">
                                            </div>
                                            <div class="col-md-1"></div>
                                            </div>
																
																	

																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block">تاريخ  البداية</span>
                            <input name="start_date" style="direction: ltr;width: 100%;" size="18" id="start_date" type="text"  class="form_datetime form-control" >
																		</div>
																		<div class="col-md-1"></div>
																	</div>


																	<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">تاريخ  النهاية</span>
<input name="enddate"  value="<?=date("Y-m-d H:i");?>"  style="direction: ltr;width: 100%;" size="18" id="enddate" type="text"  class="form_datetime form-control editable editable-click" >
</div>
<div class="col-md-1"></div>
</div>



															

																


																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
						                 	<button type="button" class="mainbutton btn green taskbutton">
																					<i class="fa fa-check"></i> حفظ</button>
																				<button type="button" class="btn default cancelbutton">إلغاء</button>
																			</div>
																		</div>
																	</div>
																</div>
														</form>
														<!-- END FORM-->
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
        <?php include("design/inc/footer.php"); ?>
        <!-- END FOOTER -->

        <?php include("design/inc/footer_js.php"); ?>
<script>
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
window.history.back();
    });
});
</script>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
</script>  
</body>
</html>
