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
$curt='tickets_types';
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
<title>تفاصيل التذكرة</title>
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
							<a href="<?=$url.'admin/pages/show/';?>">تفاصيل التذكرة</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل التذكرة</span>
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
															<i class="fa fa-gift"></i> تفاصيل التذكرة </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$title = $result->title;
																$ticket_type_id = $result->ticket_type_id;
																$content = $result->content;
																$created_by = $result->created_by;
																$created_at = $result->created_at;
																$time = $result->time;
															}
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<form action="<?php echo $url?>admin/tickets/add_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?=$id;?>">
															<input type="hidden" name="created_by" value="<?=$_SESSION['id_admin'];?>">
																<div class="form-body">
																
																	<div class="form-group">
																		<div class="col-md-2">تفاصيل التذكرة</div>
																		<div class="col-md-10">
																		<div class="portlet box yellow">
																				<div class="portlet-title">
																					<div class="caption"><i class="fa fa-cogs"></i> تفاصيل التذكرة </div>
																					<div class="tools"><a href="javascript:;" class="collapse"></a></div>
																				</div>
																			<div class="portlet-body">
																					<div class="table-responsive">
																						<table class="table table-bordered">
																							<tbody>
																								<tr>
																									<th> إسم العميل </th>
																									<td> <?php echo get_this('customers',['id'=>$created_by],'user_name');?> </td>
																								</tr>
																								<tr>
																									<th> وقت الإنشاء </th>
																									<td> <?=$time."-".$created_at;?> </td>
																								</tr>
																								<tr>
																									<th> نوع التذكرة </th>
																									<td> <?php echo get_this('tickets_types',['id'=>$ticket_type_id],'name');?> </td>
																								</tr>
																								<tr>
																									<th> عنوان التذكرة </th>
																									<td> <?=$title;?> </td>
																								</tr>
																								<tr>
																									<th> تفاصيل التذكرة </th>
																									<td> <?=$content;?> </td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																				</div>
																		</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2"> الردود [<?=count($replies);?>]</div>
																		<div class="col-md-10">
																			<div class="mt-comments">
																			<?php 
																			foreach($replies as $replie){
																			if($replie->reply_type==1){
																				$username = get_this('customers',['id'=>$replie->created_by],'user_name');
																				$main_img=get_this('customers',['id'=>$replie->created_by],'img');
																			
																				if($main_img!=""){
																				    	$img = base_url()."uploads/customers/".$main_img;
																				}
																				else {
																				    	$img = base_url()."uploads/customers/default.png";
																				}
																			}else{
																				$username = get_this('admin',['id'=>$replie->created_by],'username');
																				$img = base_url()."uploads/site_setting/".get_this('admin',['id'=>$replie->created_by],'img');
																			}
																			?>
																				<div class="mt-comment">
																					<div class="mt-comment-img">
																						<img src="<?=$img?>" width="50px" height="50px" /> </div>
																					<div class="mt-comment-body">
																						<div class="mt-comment-info">
																							<span class="mt-comment-author"><?=$username;?></span>
																							<span class="mt-comment-date"><?=$replie->created_at;?> - <?=$replie->time;?></span>
																						</div>
																						<div class="mt-comment-text"> <?=$replie->content;?> </div>
																					</div>
																				</div>
																			<?php }?>
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<?php echo $this->ckeditor->editor("content","contents");?>
																			<span class="help-block"> رد </span>
																		</div>
																	</div>
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="submit" class="btn green">
																					<i class="fa fa-check"></i> رد </button>
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
</body>
</html>