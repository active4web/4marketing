<?php
//session_start();
ob_start();
if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name'] == "") {
	header("Location:" . base_url() . "admin/login");
} else {
	$id_admin = $_SESSION['id_admin'];
	$admin_name = $_SESSION['admin_name'];
	$last_login = $_SESSION['last_login'];
	$curt = 'package';
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
<title>تعديل</title>
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
							<a href="<?= $url . 'admin'; ?>/codes/user_codes">الباقات</a>
							<i class="fa fa-circle"></i>
						</li>
						
						
						
						<li>
							<span>تعديل</span>
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
															<i class="fa fa-gift"></i>تعديل </div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<?php
															foreach($data as $data)
															?>
																<input type="hidden" value="2" id="service_type">
<form id="myForm" action="<?= base_url()?>admin/codes/edit_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
																<div class="form-body">
												<input type="hidden" value="<?=$data->id?>" name="id">
																	

<div class="form-group">
<div class="col-md-3" style="text-align:center"></div>
<div class="col-md-6" style="text-align:center">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="<?=$url;?>uploads/icon/<?=$data->icon?>" alt="" /> </div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
<div>
<span class="btn default btn-file">
<span class="fileinput-new"> (الطول :60 والعرض:60)صورة الأيقونة</span>
<span class="fileinput-exists">تغير</span>
<input type="file" name="file"></span>
<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">حذف </a>
</div>
</div>
</div>
<div class="col-md-3" style="text-align:center"></div>
</div>



												<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">الباقة </span>
<input name="code" id="mainid"  value="<?=$data->code_name?>" type="text" placeholder="الكود" class="form-control" required>
</div>
<div class="col-md-1"></div>
</div>
															
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">عدد الاعلانات</span>
<input name="total_used" value="<?=$data->total_used?>" style="direction:rtl;width:100%;" type="text" id="total_used" class="form-control" >
</div>
<div class="col-md-1"></div>
</div>
															
															
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">التكلفة</span>
<input name="price" value="<?=$data->price?>" style="direction:rtl;width:100%;"   type="text" id="price"  class="form-control">
</div>
<div class="col-md-1"></div>
</div>


	<div class="form-group">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	<span class="help-block">مدة  الظهور</span>
	<input name="time_days" value="<?=$data->time_days?>" style="direction:rtl;width: 100%;"  type="text" id="time_days"  class="form-control">
	</div>
	<div class="col-md-1"></div>
	</div>


	<div class="form-group">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	<span class="help-block">الوصف</span>
	<textarea name="descrption" id="descrption" class="form-control" style="height:100px;direction:rtl">
<?= $data->descrption?>
</textarea>
	</div>
	<div class="col-md-1"></div>
	</div>

															
<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
						<button type="submit" class=" btn green ">
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
