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
$curt='customers';
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
<title>تفاصيل المدرب</title>
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
							<a href="<?=$url.'admin/users/trainers/';?>">المدربين</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل المدرب</span>
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
															<i class="fa fa-gift"></i> تفاصيل المدرب </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$username = $result->user_name;
																$email = $result->email;
																$phone = $result->phone;
																$img = $result->img;
																$points = $result->points;
																$invitation_code = $result->invitation_code;
																$invitation_count = $result->invitation_count;
																$creation_date = $result->creation_date;
																$about = $result->about;
																
															}
													$city_id=$result->city_id;
										$cat_id=$result->cat_id;		
											$city_name=get_table_filed('city',array('id'=>$city_id),"name");
										$country_id=get_table_filed('city',array('id'=>$city_id),"country_id");
								    	$country_name=	get_table_filed('country',array('id'=>$country_id),"title");
										$category_name=	get_table_filed('category',array('id'=>$cat_id),"name");
															if($img!=""){
															if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/customers/'.$img)){
																$imge = base_url('uploads/customers/'.$img);
															}else{
																$imge = base_url('uploads/customers/avatar.png');
															}
															}else{
																$imge = base_url('uploads/customers/avatar.png');
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
																						<i class="fa fa-gift"></i> تفاصيل المدرب </div>
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
																														<th> البريد الإلكتروني </th>
																														<td> <?=$email;?> </td>
																													</tr>
																													<tr>
																														<th> التليفون </th>
																														<td> <?=$phone;?> </td>
																													</tr>
																													<tr>
																														<th>  الدولة  </th>
																														<td> <?=$country_name;?> </td>
																													</tr>
																													<tr>
																														<th>  المدينة  </th>
																														<td> <?=$city_name;?> </td>
																													</tr>
																												
																													
																														<tr>
																														<th>  القسم المشترك فيه </th>
																														<td> <?=$category_name;?> </td>
																													</tr>
																												
																													<tr>
																														<th> حالة الأكونت   </th>
																														<td> <?=$view;?> </td>
																													</tr>
																													
																													<tr>
																														<th> كود الدعوة </th>
																														<td> <?=$invitation_code;?> </td>
																													</tr>
																													<tr>
																														<th> عدد النقاط المتاحة </th>
																														<td> <?=$points;?> </td>
																													</tr>
																													


																													<tr>
																														<th> تاريخ الإشتراك </th>
																														<td> <?=$creation_date;?> </td>
																													</tr>
																														<tr>
																														<th> عن المدرب </th>
																														<td> <?=$about;?> </td>
																													</tr>
																											<?php 
																													if(count($trainer_certifactes)>0){?>
																												<tr><td colspan="2" style="text-align:center">المؤهل</td></tr>	
																										  <?php 
																										  foreach($trainer_certifactes as $trainer_certifactes){
																													?>
																														<tr>
																												<td colspan="2"> <?=$trainer_certifactes->certification;?> </td>
																													</tr>
																													<?php }?>
																													<?php }?>
																													
																														<?
																													if(count($trainer_experiences)>0){ ?>
																												<table class="table table-bordered">
																												<tbody>
																												     <tr>
																												         <td>الخبرة</td>
																												          <td>اسم الشركة</td>
																												          <td>من تلريخ</td>
																												          <td>الى تاريخ</td>
																												     </tr>	
																												     </tbody>
																												     </table>
																													
																										  <?php 
																										  
																										  foreach($trainer_experiences as $trainer_experiences){
																													?>
																														<tr>
																														    
																										<td colspan="2"> 
																									<table class="table table-bordered">
																											<tbody>
																											 <tr>
																										        <td><?=$trainer_experiences->experiences;?> </td>
																										        <td> <?=$trainer_experiences->company_name;?></td>
																										        <td><?=$trainer_experiences->start_moth;?>-<?=$trainer_experiences->start_date;?></td>
																										        <?php
																										        if($trainer_experiences->end_date!=""){
																										        ?>
																										        <td><?=$trainer_experiences->end_month;?>-<?=$trainer_experiences->end_date;?></td>
                                                                                                              <?php }else {?>
                                                                                                              <td>الى الأن</td>
                                                                                                              <?php }?>
																										    </tr>
																										    	</tbody>
																										</table>
																									</td>
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