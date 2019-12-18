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
<style>
ul.ss {

    top: 58px;
}
</style>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>الأعلانات</title>
<?php include ("design/inc/header.php");?>
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
							<span class="active">الأعلانات</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									 
<div class="caption font-dark" style="float:left">
<form action="#" class="ssform" autocomplete="off">
<input type="text" name="name" placeholder="البحث بالاسم" id="search_name">
<ul class="ss"></ul>
</form>
</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<?php if($result_amount>0){?>
													<!--<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> حذف مجموعة
															<i class="fa fa-remove"></i>
														</button>
													</div>-->
												<?php }?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> إضافة 
														<i class="fa fa-plus"></i>
													</button>
													</div>
													
														<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold red cancel"> حذف نهائى 
														<i class="fa fa-remove"></i>
													</button>
													</div>
											</div>
											
											
										</div>
									</div>
									
									<?php if(!empty($results)){?>
									<form action="<?= base_url()?>admin/courses/final_delete" method="POST" id="form">
									    <input type="hidden" value="main_adv" name="main_adv">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th>الاسم </th>
												<th>الرئيسى</th>
												<th> السعر </th>
												<th>المسئول</th>
												<th>الفرعى</th>
												<th> النشر</th>
												<th>الأنتهاء</th>
										    	<th>الظهور</th>
												<th>الحالة </th>
												<th> العمليات </th>
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
												 <th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
											$where['customer_id'] = $data->id;
										$city_id=$data->city_id;
										$cat_id=$data->cat_id;
											$dep_id=$data->dep_id;
										$user_id=$data->user_id;
									
									$category_name=	get_table_filed('category',array('id'=>$cat_id),"name");
										$dep_name=	get_table_filed('department',array('id'=>$dep_id),"name");
										$view=$data->view;
										$expired_date=$data->expired_date;
										switch($view){
													case 0:
													  $view="<span class='label label-sm label-danger'>غير مفعل</span>";
													  break;
													case 1:
													  $view="<span class='label label-sm label-success'>مفعل</span>";
													  break;
													  case 2:
														$view="<span class='label label-sm label-success'>مرفوض</span>";
														break;
													default:
													  break; 
												}

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
												
												$imgs=$this->db->get_where("images",array("id_products"=>$data->id))->result();
												$user_name = get_table_filed('customers',array('id'=>$user_id),"user_name");
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?= mb_substr($data->name,0,40);?> </td>
												<td> <a href="<?=$url?>admin/courses/category_advertising?cat_id=<?=$data->cat_id?>"><?=$category_name;?></a></td>
												<td> <?= $data->price;?> </td>
									<td> <a href="<?=$url?>admin/users/customers_details?id=<?=$data->user_id?>"><?= mb_substr($user_name,0,50);?></a></td>
												<td> <?= $dep_name;?> </td>
												<td> <?= $data->creation_date;?> </td>
												<td> <?= $data->expired_date_Val;?> </td>
												<td> <a  data-id="<?php echo $data->id;?>" class="btn btn-xs purple table-icon edit_expired" title="change status" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="edit status"></i>
												<span class="code_actvation_expired-<?php echo $data->id;?>"><?php echo $expired_date;?></span>
											</a> </td>
												
													<td> 
												<a  data-id="<?php echo $data->id;?>" class="btn btn-xs purple table-icon edit" title="change status" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="edit status"></i>
												<span class="code_actvation-<?php echo $data->id;?>"><?php echo $view;?></span>
											</a>
											
											</td> 
												
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<li><a href="<?=$url?>admin/courses/courses_details?id=<?=$data->id?>"><i class="fa fa-eye"></i> تفاصيل </a></li>
													<?php 
													if($data->user_id==1){
													?>
														<li><a href="<?=$url?>admin/courses/edit?id=<?=$data->id;?>"><i class="fa fa-pencil"></i> تعديل </a></li>
													 <?php }?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php }else{?>
									<center><span class="caption-subject font-red bold uppercase">عفوا لاتوجد بيانات للعرض</span></center>
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
	$(".delbutton").click(function(e) {
        window.location.assign("delete");
	});
	 $(".addbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/courses/add_course");
    });
});
</script>

<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/courses/active") ?>',
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



	$(".edit_expired").click(function(e) {
var id = $(this).data("id");
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/courses/expired_action") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation_expired-"+id).html("<span class='label label-sm label-success'>متواجد</span>");
                	}
                	if (data == "0") {
                		$(".code_actvation_expired-"+id).html("<span class='label label-sm label-danger'>منتهى</span>");
                	}
				}
         });
	});



});

	$(".confirm_delete").click(function(e) {
      var iduser=$(this).next(".iduser").val();
     var b=confirm("حذف الاعلان قد يودى   الى  مشاكل فى عرض التفاصيل العامة ,هل انت متاكد من عملية الحذف");
    if(b==true){
      window.location.assign("<?=$url?>admin/courses/delete?id_customers="+iduser);  
    }
    
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
			toastr.warning("من فضلك حدد اعلان واحد على الاقل");
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