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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>تفاصيل طلب اعلان سوشيال</title>
<?php include ("design/inc/header.php");?>
<style>
.mt-comments .mt-comment {
    background-color:#f9f9f9;
    height: 75px;
}
</style>
<link rel="stylesheet" href="<?= base_url();?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?= base_url();?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
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
							<a href="<?=$url.'admin/banks/requested_courses/';?>">الطلبات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل الطلب</span>
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
															<i class="fa fa-gift"></i> تفاصيل الطلب </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$social_type = $result->social_type;
																$sex = $result->sex;
																$age_f = $result->age_f;
																$age_t = $result->age_t;
																$places = $result->places;
																$timing = $result->timing;
																$hr_f = $result->hr_f;
																$hr_t = $result->hr_t;
																$img_type = $result->img_type;
																$img = $result->img;
																$price = $result->price;
																$creation_date = $result->date;
																$adversiting_id = $result->adversiting_id;
																$user_id = $result->user_id;
																$payment_type = $result->payment_type;
																$cat_id = $result->cat_id;
																
															}
								
									$category_name=	get_table_filed('category',array('id'=>$cat_id),"name");
									$products_name=	get_table_filed('products',array('id'=>$adversiting_id),"name");
									$user_name=	get_table_filed('customers',array('id'=>$user_id),"user_name");
									$user_phone=	get_table_filed('customers',array('id'=>$user_id),"phone");
									$user_email=	get_table_filed('customers',array('id'=>$user_id),"email");					
																$view=$result->view;
																switch($view){
																	case 0:
																	  $view="<span class='label label-sm label-danger'>منتظر التاكيد</span>";
																	  break;
																	case 1:
																	  $view="<span class='label label-sm label-success'>تم تاكيد الطلب</span>";
																	  break;
																	  case 2:
																	  $view="<span class='label label-sm label-success'>تم رفض الطلب </span>";
																	  break;
																	default:
																	  break; 
																}
																$type = get_table_filed('category',array('id'=>$cat_id),"name");
																$social_type = explode(',',$social_type);
																$sex = explode(',',$sex);
																
																	if(count($social_type)==2){
																		$social_type_data="فيس-انستجرام";
																	}else{
																		if($social_type[0]==2){
																			$social_type_data="انستجرام";
																		}
																		if($social_type[0]==1){
																			$social_type_data="فيس بوك";
																		}
																	}

																	if(count($sex)==2){
																		$social_type_sex="مؤنث-مذكر";
																	}else{
																		if($sex[0]==2){
																			$social_type_sex="مؤنث";
																		}
																		if($sex[0]==1){
																			$social_type_sex="مذكر";
																		}
																	}

																	if($result->age_f==""){
																		$age_group="الى سن"." ".$result->age_t;
																	}
																	if($result->age_t==""){
																		$age_group="من سن"." ".$result->age_f;
																	}
																	if($result->age_t!=""&&$result->age_f!=""){
																		$age_group=$result->age_f."-".$result->age_t;
																	}


																	if($timing==2){
																		
																		if($result->hr_f==""){
																			$timing_data="الى الساعة"." ".$result->hr_t;
																		}
																		if($result->hr_t==""){
																			$timing_data="من الساعة"." ".$result->hr_f;
																		}
																		if($result->hr_t!=""&&$result->hr_f!=""){
																			$timing_data=$result->hr_f."-".$result->hr_t;
																		}


																	}else{
																	
																			$timing_data="طول اليوم";
																		
																	}

				
																	$status=$result->status;
																	switch($status){
																		case 0:
																		  $status="<span class='label label-sm label-danger'>منتظر</span>";
																		  break;
																		case 1:
																		  $status="<span class='label label-sm label-success'>تم</span>";
																		  break;
																		  case 2:
																			$status="<span class='label label-sm label-success'>فشل</span>";
																			break;
																		default:
																		  break; 
																	}
																	$payment_type=$result->payment_type;
																	switch($payment_type){
																		case 0:
																		  $payment_type="<span class='label label-sm label-danger'>غير محددة</span>";
																		  break;
																		case 1:
																		  $payment_type="<span class='label label-sm label-success'>تحويل بنكى</span>";
																		  break;
																		  case 2:
																			$payment_type="<span class='label label-sm label-success'>فيزا</span>";
																			break;
																		default:
																		  break; 
																	}

																	$img_type=$result->img_type;
																	switch($img_type){
																	
																		case 1:
																		  $img_type="<span class='label label-sm label-success'>صورة من صور الأعلان</span>";
																		  break;
																		  case 2:
																			$img_type="<span class='label label-sm label-success'>صورة حديثة</span>";
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
				
						<div class="mt-comment-body">
							<div class="mt-comment-info">
								<span class="mt-comment-author"><?=$user_name;?></span>
								<span class="mt-comment-date" style="color:#000"><?=$creation_date;?></span>
							</div>
						</div>
					</div>
				</div>

				<br>
				<div class="portlet box yellow">
				
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
													<td colspan="2">
													<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
												
													</table>
													 </td>
													</tr>

													<tr>
															<th>نوع الحملة الاعلانية</th>
															<td> <?=$social_type_data;?> </td>
														</tr>

														<tr>
															<th>النوع المستهدف</th>
															<td> <?=$social_type_sex;?> </td>
														</tr>
														<tr>
															<th>الفئة العمرية</th>
															<td> <?=$age_group;?> </td>
														</tr>

														<tr>
															<th> التكلفة </th>
															<td> <?=$price;?> </td>
														</tr>
														<tr>
															<th>توقيت الأعلان</th>
															<td> <?=$timing_data;?> </td>
														</tr>

														<tr>
															<th>الاعلان</th>
															<td> <?=$products_name;?> </td>
														</tr>
														<tr>
															<th>  التصنيف المستهدف  </th>
															<td> <?=$category_name;?> </td>
														</tr>
														
														
														
														<tr>
															<th>طريقة الدفع</th>
															<td> <?=$payment_type;?> </td>
														</tr>
														<tr>
															<th>حالة الدفع</th>
															<td> <?=$status;?> </td>
														</tr>
														
													
														
														<tr>
															<th>الصورة المستخدمة </th>
															<td> <?=$img_type;?> 
															<?php  if($result->img!=""){?>
		<a title="view image" class="example-image-link" href="<?= base_url('')?>uploads/soical_advertising/<?= $result->img;?>" data-lightbox="example-1"><i class="fa fa-picture-o"></i> الصورة</a>
													<?php }?>
													</td>	
													</tr>
													
													<tr>
															<th>رقم نليفون صاحب الاعلان</th>
															<td> <?=$user_phone;?> </td>
														</tr>
														<tr>
															<th>ايميل صاحب الاعلان </th>
															<td> <?=$user_email;?> </td>
														</tr>
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