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

<title>تفاصيل الأعلان</title>
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
							<a href="<?=$url.'admin/courses/inside/';?>">الأعلانات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل الاعلان</span>
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
															<i class="fa fa-gift"></i> تفاصيل الاعلان </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$username = $result->name;
																$details = $result->details;
																$img = $result->img;
																$price = $result->price;
																$cat_id = $result->cat_id;
																$city_id = $result->city_id;
																$user_id = $result->user_id;
																$creation_date = $result->creation_date;
															}
									$city_name=$city_id;
									$views = $result->views;
									$category_name=	get_table_filed('category',array('id'=>$cat_id),"name");

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

												$expired_date=$result->expired_date;
												$delete_key=$result->delete_key;
												$expired_date_Val=$result->expired_date_Val;
										
												switch($expired_date){
													case 0:
													  $expired_date="<span class='label label-sm label-danger'>منتهى</span>";
													  break;
													case 1:
													  $expired_date="<span class='label label-sm label-success'>متواجد</span>";
													  break;
													default:
													  break; 
												}
												switch($delete_key){
													case 0:
													  $delete_key="<span class='label label-sm label-danger'>فى الارشيف</span>";
													  break;
													case 1:
													  $delete_key="<span class='label label-sm label-success'>متواجد فى الأعلانات</span>";
													  break;
													default:
													  break; 
												}
												
												$special=$result->special;
												switch($special){
													case 0:
													  $special="<span class='label label-sm label-danger'>اعلان عادى</span>";
													  break;
													case 1:
													  $special="<span class='label label-sm label-success'>اعلان مميز</span>";
													  break;
													default:
													  break; 
												}
                                $gallery=$this->db->get_where("images",array("id_products"=>$result->id))->result();
								$customers_name=	get_table_filed('customers',array('id'=>$user_id),"user_name");
								$customers_phone=	get_table_filed('customers',array('id'=>$cat_id),"phone");
								$customers_email=	get_table_filed('customers',array('id'=>$cat_id),"email");
								$customers_email=	get_table_filed('customers',array('id'=>$cat_id),"email");
							
							   

							  
													
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
													<tr>
													<th>
													    <a href="<?= base_url()?>admin/courses/change_expired?id=<?= $result->id?>">
													<button id="sample_editable_1_2_new" class="btn sbold green show_adv">
													    <?php if($result->expired_date==0){?>
													    <?= $expired_date?>  
														اعادة النشر
														<?php } else {?>
														انهاء النشر
														<?php }?>
													</button>
													</a>
													 </th>
													<th> 	
													<a href="<?= base_url()?>admin/courses/change_archive?id=<?= $result->id?>">
													<button id="sample_editable_1_2_new" class="btn sbold red archive_adv">
													    <?php 
													    if($result->delete_key==1){
													    ?>
													<span class='label label-sm label-danger'>اضف الى الارشيف</span
													<?php } else {?>
													<span class='label label-sm label-danger'>اضف الى الاعلانات</span
													<?php }?>
														<i class="fa fa-trash"></i>
													</button>
													</th>
													<th>  
													<a href="<?= base_url()?>admin/courses/change_date?id=<?= $result->id?>">
													<button id="sample_editable_1_2_new" class="btn sbold blue reset_adv"> تحديث تاريخ الانتهاء 
														<i class="fa fa-undo"></i></i>
													</button>
													</a>
													</th>
													</tr>
													</table>
													 </td>
													</tr>

													<tr>
															<th>صاحب الاعلان</th>
															<td> <?=$customers_name;?> </td>
														</tr>

														<tr>
															<th>رقم تليفون المعلن</th>
															<td> <?=$customers_phone;?> </td>
														</tr>
														<tr>
															<th>البريد الألكترونى</th>
															<td> <?=$customers_email;?> </td>
														</tr>

														<tr>
															<th> الإسم </th>
															<td> <?=$username;?> </td>
														</tr>
														<tr>
															<th> نوع الأعلان </th>
															<td> <?=$special;?> </td>
														</tr>

														<tr>
															<th>التصنيف</th>
															<td> <?=$category_name;?> </td>
														</tr>
														<tr>
															<th>  المدينة  </th>
															<td> <?=$city_name;?> </td>
														</tr>
														<tr>
															<th> تاريخ اضافة الاعلان </th>
															<td> <?=$creation_date;?> </td>
														</tr>
														<tr>
															<th>عدد المشاهدات</th>
															<td> <?= $views;?> </td>
														</tr>
														
														<tr>
															<th>السعر</th>
															<td> <?=$price;?> </td>
														</tr>
														<tr>
															<th>حالة الاعلان</th>
															<td> <?=$view;?> </td>
														</tr>
														<tr>
															<th>حالة الظهور</th>
															<td> <?= $expired_date;?> </td>
														</tr>
														<tr>
															<th>ارشفة الأعلان</th>
															<td> <?= $delete_key;?> </td>
														</tr>
														
														<tr>
															<th>تاريخ الأنتهاء</th>
															<td> <?=$expired_date_Val;?> </td>
														</tr>
														<tr>
															<td colspan="2"> <?=$details;?> </td>
														</tr>

														<tr>
														<?php
														if(count($gallery)){?>
														<td colspan="2">
													<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
													<tr>
													<th>الصورة</th>
													<th>الحذف</th>
													</tr>
													<?php
													foreach($gallery as $gallery){
														?>
													<tr>
													<td><a title="view image" class="example-image-link" href="<?= base_url('')?>uploads/products/<?= $gallery->image;?>" data-lightbox="example-1"><i class="fa fa-picture-o"></i> الصورة</a></td>
													<td><a href="<?=$url?>admin/courses/delete_img?advertising_id=<?=$id;?>&id=<?=$gallery->id;?>"><i class="fa fa-remove"></i> حذف </a></td>
												
													</tr>
													<?php }?>
													
													</table>
													</td>
														<?php }?>
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