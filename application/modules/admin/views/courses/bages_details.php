<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".$url."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='courses';
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
<title>تفاصيل الحقيبة</title>
<?php include ("design/inc/header.php");?>
<style>
.mt-comments .mt-comment {
    background-color:#f9f9f9;
    height: 75px;
}
</style>
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
							<a href="<?=$url.'admin/courses/bags/';?>">الحقائب</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل الحقيبة</span>
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
															<i class="fa fa-gift"></i> تفاصيل الحقيبة </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$username = $result->bage_name;
																$details = $result->bage_details;
																$bage_hrs = $result->bage_hrs;
																$img = $result->img;
																$week_bage_daies = $result->week_bage_daies;
																$bage_total_daies = $result->bage_total_daies;
																$total_rate = $result->total_rate;
																$creation_date = $result->creation_date;
															}
															
										
															if($img!=""){
															if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/products/'.$img)){
																$imge = base_url('uploads/products/'.$img);
															}else{
																$imge = base_url('uploads/products/no_img.png');
															}
															}else{
																$imge = base_url('uploads/products/no_img.png');
															}
																$view=$result->view;
																switch($view){
													case 0:
													  $view="<span class='label label-sm label-danger'>غير مفعل</span>";
													  break;
													case 1:
													  $view="<span class='label label-sm label-success'>مفعل</span>";
													  break;
													default:
													  break; 
												}
												$intersted_courses=$this->db->get_where("reviews",array("id_course"=>$result->id,'course_key'=>2))->result();
											$request_courses=$this->db->get_where("request_courses",array("id_course"=>$result->id,'type'=>2))->result();
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<div class="form-horizontal form-bordered">
																<input type="hidden" name="id" value="<?=$id;?>">
																<div class="form-body">
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																			<div class="mt-comments">
																				<div class="mt-comment">
																					<div class="mt-comment-img">
																						<img src="<?=$imge?>" width="50px" height="50px" /> </div>
																					<div class="mt-comment-body">
																						<div class="mt-comment-info">
																							<span class="mt-comment-author"><?=$username;?></span>
																							<span class="mt-comment-date" style="color:#000"><?=$creation_date;?></span>
																						</div>
																					</div>
																				</div>
																			</div>
																			<br>
																			<div class="portlet box yellow">
																				<div class="portlet-title">
																					<div class="caption">
																					    
																					   
																						<i class="fa fa-gift"></i> تفاصيل الدورة </div>
																					<div class="tools">
																						<a href="javascript:;" class="collapse"> </a>
																					</div>
																				</div>
																				<div class="portlet-body">
																					<div class="row">
																					
																						<div class="col-md-12">
																							<div class="tab-content">
																								<div class="tab-pane active" id="tab_6_1">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<tbody>
																													<tr>
																														<th> الإسم </th>
																														<td> <?=$username;?> </td>
																													</tr>
																													<tr>
																														<th>عدد أيام الحقيبة</th>
																														<td> <?=$bage_total_daies;?> </td>
																													</tr>
																													<tr>
																														<th> اجمالى الايام فى الاسبوع  </th>
																														<td> <?=$week_bage_daies;?> </td>
																													</tr>
																													<tr>
																														<th>  عدد الساعات  </th>
																														<td> <?=$bage_hrs;?> </td>
																													</tr>
																													  <tr>
																														<th> تقييم الدورة</th>
																														<td> <?=$result->total_rate;?> </td>
																													</tr>
																													
																													<tr>
																														<th> عدد التقييمات </th>
								<td><a href="<?=$url?>admin/courses/rate_details?id=<?=$result->id;?>&course_type=2"><?= count($intersted_courses);?></a></td>
																													</tr>
																													
																													
																													<tr>
																														<th> تاريخ أشاء الدورة </th>
																														<td> <?=$creation_date;?> </td>
																													</tr>
																														
																														
																														
																													
																													<tr>
																														<th>  التفاصيل  </th>
																														<td> <?=$details;?> </td>
																													</tr>
																												
																												
																													
																											<?php 
																													if(count($course_info)>0){?>
																												<tr><td colspan="2" style="text-align:center"> محتوى الدورة</td></tr>	
																										  <?php 
																										  foreach($course_info as $intersted_courses){
																										   $course_content= $intersted_courses->content;
																													?>
																														<tr>
																												<td colspan="2"><?=$course_content;?> </td>
																													</tr>
																													<?php }?>
																													<?php }?>
																													
																													
																												</tbody>
																											</table>
																										</div>
																									</div>
																								</div>
																						
																					
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		
																		</div>
																		<div class="col-md-1"></div>
																	</div>
															</div>
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