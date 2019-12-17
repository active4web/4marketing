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
$curt='bank_accounts';
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
<title>تعديل حساب البنكى</title>
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
							<a href="<?=$url.'admin';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$url.'admin/banks/bank_accounts/';?>">الحسابات البنكية</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>تعديل حساب بنكى</span>
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
															<i class="fa fa-gift"></i>تعديل حساب بنكى</div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption">



															</div>
															<div class="actions"></div>
														</div>
														<?php 
														foreach($data as $data)
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" value="2" id="service_type">
															<form action="<?php echo $url?>admin/banks/edit_bank_accounts_action" class="form-horizontal form-bordered"
															 method="post" id="form">
															    <input type="hidden" value="<?=$data->id?>" name="id">
																<div class="form-body">
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		   <span class="help-block">  اسم البنك  </span>
																			<input name="title" value="<?=$data->name_bank?>" id="bank_name"  type="text" placeholder="اسم البنك" class="form-control" required>
																		</div>
																	</div>
																
																			<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		   	<span class="help-block"> رقم الحساب البنكى </span>

																			<input name="account_number"  value="<?=$data->account_number?>" id="account_number" type="text" placeholder="رقم الحساب البنكى" class="form-control" required>
																		</div>
																	</div>
																	
																			<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		  	<span class="help-block">رقم الأيبان</span>

																			<input name="iban_number"  value="<?=$data->iban_number?>" id="iban_number" type="text" placeholder="رقم الأيبان" class="form-control" required>
																		</div>
																	</div>
																	
																<div class="form-group">
																<div class="col-md-2"></div>
																<div class="col-md-10">
																	<span class="help-block">صاحب الحساب </span>

																	<input name="user_name" id="user_name" value="<?=$data->user_name?>" type="text" placeholder="صاحب الحساب" class="form-control" required>
																</div>
															   </div>
																	
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="button" class="btn green mainbutton" id="bankaccount">
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
</body>
</html>