<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".base_url()."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='pages';
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
<title>تعديل صفحة</title>
<?php include ("design/inc/header.php");?>
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
							<a href="<?=$url.'admin/pages/terms/';?>">صفحات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تعديل صفحة</span>
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
															<i class="fa fa-gift"></i> تعديل صفحة </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$title_ar = $result->title;
																$content_ar = $result->content;
																$flag = $result->flag;
													switch($flag){
													case 1:
													  $flag="<span class='label label-sm label-danger'>مستخدم </span>";
													  break;
													case 2:
													  $flag="<span class='label label-sm label-success'>مدرب</span>";
													  break;
													case 3:
													  $flag="<span class='label label-sm label-success'>مقدم حقيبة</span>";
													  break;
													case 4:
													  $flag="<span class='label label-sm label-success'>شركة</span>";
													  break;
													default:
													  break; 
												}

															}
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<form action="<?php echo $url?>admin/pages/edit_terms_action" class="form-horizontal form-bordered"
															 method="post" enctype="multipart/form-data">
																<div class="form-body">
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<input value="<?=$title_ar;?>" name="title" type="text" placeholder="عنوان الصفحة " class="form-control" required>
																			<input type="hidden" name="id" value="<?=$id;?>">
																			<span class="help-block"> عنوان الصفحة </span>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<textarea name="content" id="contents"><?=$content_ar;?></textarea>
																			<!-- <?php //echo $this->ckeditor->editor("description","description");?> -->
																			<span class="help-block"> المحتوي </span>
																		</div>
																	</div>
																	
																	<div class="form-group">
																	<div class="col-md-2"></div>
																	<div class="col-md-10">
														<label>  نوع العضوية   (<?=$flag;?>) </label>
                                            			<select class="form-control demoInputBox" name="user_type" >
                                            			    <option value="">من فضلك حدد نوع العضوية</option>
                                                                    <option value="1">مستخدم</option>
                                                                    <option value="2">مدرب</option>
                                                                    <option value="3">مقدم دورة</option>
                                                                    <option value="4">شركة</option>
                                                                    </select>
																		</div>
																	</div>
																	
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="submit" class="btn green">
																					<i class="fa fa-check"></i> حفظ </button>
																				<button type="button" class="btn default cancelbutton">إلغاء</button>
																			</div>
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
	var editor = CKEDITOR.replace( 'contents' );
	var editor = CKEDITOR.replace( 'contents_en' );
	CKFinder.setupCKEditor( editor );
</script>
</body>
</html>