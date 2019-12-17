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
<title>المستخدمين</title>
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
							<span class="active">المستخدمين </span>
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
										<span class="caption-subject bold uppercase">المستخدمين </span>
									</div>
										<div class="caption font-dark" style="float:left">
<form action="#" class="ssform" autocomplete="off">
<input type="text" name="phone" placeholder="البحث بالجوال" id="username_search">
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
											</div>
										</div>
									</div>
									
									<?php if(!empty($results)){?>
									<form action="#" method="POST" id="form">
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
												<th> البريد الإلكتروني </th>
												<th> الهاتف </th>
												<th> المدينة  </th>
												<th> الدولة  </th>
											    <th> نوع المستخدم </th>
												<th>تاريخ الأشتراك</th>
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
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
											$where['customer_id'] = $data->id;
										$city_id=$data->city_id;
										$city_name=get_table_filed('city',array('id'=>$city_id),"name");
										$country_id=get_table_filed('city',array('id'=>$city_id),"country_id");
									$country_name=	get_table_filed('country',array('id'=>$country_id),"title");
										$view=$data->view;
										$status=$data->status;
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
												
												
												switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger'>مستخدم</span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>مدرب</span>";
													  break;
													  	case 3:
													  $status="<span class='label label-sm label-success'>مقدم حقيبة</span>";
													  break;
													  	case 4:
													  $status="<span class='label label-sm label-success'>شركة</span>";
													  break;
													default:
													  break; 
												}
												
												$intersted_courses=$this->db->get_where("intersted_courses",array("id_user"=>$data->id))->result();
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=mb_substr($data->user_name,0,50);?> </td>
												<td> <?=$data->email;?> </td>
												<td> <?=$data->phone;?> </td>
												<td> <?=$city_name;?> </td>
												<td> <?=$country_name;?> </td>
												
												<td> 
												<?php if($data->status==1){?>
												<a href="<?=$url?>admin/users/customers_details?id=<?=$data->id;?>"><?= $status;?></a>
												<?php } else if($data->status==2){?>

													<a href="<?=$url?>admin/users/trainer_details?id=<?=$data->id;?>"><?= $status;?></a>
												<?php } else if($data->status==3){?>

													<a href="<?=$url?>admin/users/provider_details?id=<?=$data->id;?>"><?= $status;?></a>
										<?php } else if($data->status==4){?>
													<a href="<?=$url?>admin/users/company_details?id=<?=$data->id;?>"><?= $status;?></a>
												<?php }?>
												
												</td>
											    <td> <?=$data->creation_date;?> </td>
													<td> 
												<a  data-id="<?php echo $data->id;?>" class="btn btn-xs purple table-icon edit" title="change status" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="edit status"></i>
												<span class="code_actvation-<?php echo $data->id;?>"><?php echo $view;?></span>
											</a></td> 
												
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<li><a href="<?=$url?>admin/users/customers_details?id=<?=$data->id;?>"><i class="fa fa-eye"></i> تفاصيل </a></li>
														<li><a href="<?=$url?>admin/users/edit?id=<?=$data->id;?>"><i class="fa fa-pencil"></i> تعديل </a></li>
													   <li><a  class="confirm_delete"><i class="fa fa-remove"></i> حذف </a>
													   <input type="hidden" name="" class="iduser" value="<?=$data->id;?>">
													   </li>

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
});
</script>

<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/users/active") ?>',
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

	$(".confirm_delete").click(function(e) {
      var iduser=$(this).next(".iduser").val();
     var b=confirm("حذف المستخدم قد يؤدى الىى مشاكل فى عرض التفاصيل العامة ,هل انت متاكد من عملية الحذف");
    if(b==true){
      window.location.assign("<?=$url?>admin/users/delete?id_customers="+iduser);  
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
	$(".delbutton").click(function(){
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