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
$curt='social';
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

<title>طلبات اعلانات السوشيال</title>
<?php include ("design/inc/header.php");?>
<link rel="stylesheet" href="<?=$url;?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?=$url;?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
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
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$url.'admin';?>">لوحة التحكم</a>
							<i class="fa fa-circle"></i>
						</li>
					
						<li>
							<span class="active">الطلبات</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase">الطلبات</span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
											<!--	<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> إضافة
														<i class="fa fa-plus"></i>
													</button>
												</div>-->
												<?php if($result_amount>0){?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red cancel"> حذف مجموعة
															<i class="fa fa-remove"></i>
														</button>
													</div>
												<?php }?>
											</div>
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="<?= base_url()?>admin/banks/delete_advert_soical" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												 <th>  الاعلان  </th>
												 <th>  التصنيف  </th>
												 <th>  الطريقة  </th>
												 <th>الفئة العمرية  </th>
												<th> المستخدم  </th>
												<th>التكلفة </th>
												<th>الدفع</th>
												<th> حالة الطلب  </th>
										        <th>  العمليات </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
												$active=$data->view;
												switch($active){
													case 0:
													  $active="<span class='label label-sm label-danger'>منتظر التاكيد</span>";
													  break;
													case 1:
													  $active="<span class='label label-sm label-success'>تم تاكيد الطلب</span>";
													  break;
													  case 2:
													  $active="<span class='label label-sm label-success'>تم رفض الطلب </span>";
													  break;
												
													  
													default:
													  break; 
												}
												
										$id_user=$data->user_id;
										$user_name = get_table_filed('customers',array('id'=>$id_user,'view'=>'1'),"user_name");
                                         
												$id_course=$data->adversiting_id;
											
												$course_name = get_table_filed('products',array('id'=>$id_course),"name");
												$cat_id = get_table_filed('products',array('id'=>$id_course),"cat_id");
												$type = get_table_filed('category',array('id'=>$cat_id),"name");
												$social_type = explode(',',$data->social_type);
												$sex = explode(',',$data->sex);
												
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
													if($data->age_f==""){
														$age_group="الى سن"." ".$data->age_t;
													}
													if($data->age_t==""){
														$age_group="من سن"." ".$data->age_f;
													}
													if($data->age_t!=""&&$data->age_f!=""){
														$age_group=$data->age_f."-".$data->age_t;
													}

													$status=$data->status;

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
									 
									 ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
 <td> <a href="<?= base_url()?>admin/courses/courses_details?id=<?= $id_course?>"><?=mb_substr($course_name,0,20);?></a> </td>
 
<td> <?= mb_substr($type,0,20)?> </td>
<td> <?=$social_type_data?> </td>
<td> <?= $age_group;?> </td>
<td><a href="<?= base_url()?>admin/users/customers_details?id=<?= $id_course?>"> <?=mb_substr($user_name,0,20);?> </a></td>
<td> <?= $data->price;?> </td>
<td> <?= $status;?> </td>
												<td>
												<a href="<?= base_url()?>admin/banks/request_courses_status?id=<?=$data->id;?>" class="btn btn-xs purple edit" style="padding: 1px 0px;">
												    <i class="fa fa-edit"></i>
												<span class="code_actvation-<?php echo $data->id;?>"><?php echo $active;?></span>
												</a>
												</td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<li><a href="<?=$url?>admin/banks/requested_soical?id=<?=$data->id;?>"><i class="fa fa-pencil"></i> التفاصيل </a></li>
															<li><a href="<?=$url?>admin/banks/archive_social?id_pages=<?=$data->id;?>"><i class="fa fa-remove"></i> الارشيف </a></li>

														</ul>
													</div>
												</td>
											
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php }else{?>
									<center><span class="caption-subject font-red bold uppercase"><?=lang('no_data');?></span></center>
									<?php }?>
								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> مجموع السجلات :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								</div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END Table Data-->

				</div>
				<!-- END CONTENT -->
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
<script>
$(document).ready(function(e) {
	
    $(".addbutton").click(function(e) {
        window.location.assign("add");
    });

	$(".delbutton").click(function(e) {
        window.location.assign("delete");
	});
});
</script>

<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
	$.ajax({
		url: '<?php echo base_url("admin/banks/active") ?>',
		type: 'POST',
		data: data,				
		success: function( data ) {
		if (data == "1") {
			// alert(data);
			$(".code_actvation-"+id).html("<span class='label label-sm label-success'>مفعل</span>");
		}
		if (data == "0") {
			$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>غير مفعل</span>");
		}
		}
		});
	});
});
</script>
<script>
$(document).ready(function(e) {
    $("#checkAll").change(function(){
		$("input[type=checkbox]").not("#checkAll").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".cancel").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
			$('#form').unbind('submit').submit();//renable submit
		}
	    else{
			window.stop();
			//alert("<?=lang('row_one_alert');?>");
			toastr.warning("<?=lang('row_one_alert');?>");
	}
	});
});
</script>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
	toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body>
</html>