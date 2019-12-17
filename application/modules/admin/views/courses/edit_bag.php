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
foreach ($data as $data)
$cat_id=$data->dep_id;
if($cat_id!=""){
$category_name=	get_table_filed('category',array('id'=>$cat_id),"name");
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
<title> تعديل </title>
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
							<a href="<?=$url.'admin/courses/bags';?>">الحقائب</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>تعديل حقيبة</span>
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
															<i class="fa fa-gift"></i>تعديل حقيبة </div>
													</div>
													<?php //print_r($now);?>
													<div class="portlet light bordered form-fit">
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" id="service_type" value="2">
						<form action="#" class="form-horizontal form-bordered"  method="post" id="myForm">
							<input name="id" value="<?= $data->id;?>" type="hidden"  >									    
															    	<div class="form-group">
																	<div class="col-md-2"></div>
																	<div class="col-md-10">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																						    <img src="<?= base_url()?>uploads/products/<?= $data->img;?>">
																						</div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new">صورة  الحقيبة </span>
																								<span class="fileinput-exists">تغيير</span>
																								<input type="file" name="img_course"> </span>
																								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																						</div>
																					</div>
																					<p style="color:red;direction:rtl"></p>
																		<p style="color:red;direction:rtl">عرض الصورة 400 بيكسل</p>
																		<p style="direction:rtl">طول الصورة 400بيكسل</p>
																	</div>
																	</div>
															    
															    
																<div class="form-body">
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		<span class="help-block"> اسم الحقيبة </span>
																			<input name="title" id="title" value="<?= $data->bage_name?>"  type="text" placeholder="اسم الحقيبة " class="form-control" required>
																			
																		</div>
																	</div>																	
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		<span class="help-block">اجمالى الساعات</span>
																			<input name="bage_hrs" id="bage_hrs" value="<?= $data->bage_hrs?>"  type="number" placeholder="اجمالى الساعات" class="form-control" required>
																		</div>
																	</div>	
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		<span class="help-block">إجمالى الايام فى الاسبوع</span>
																			<input name="week_bage_daies" value="<?= $data->week_bage_daies?>" id="week_bage_daies"  type="number" placeholder="اجمالى الأيام فى الأسبوع" class="form-control" required>
																		</div>
																	</div>	
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		<span class="help-block">اجمالى ايام الحقيبة</span>
																			<input name="bage_total_daies"  value="<?= $data->bage_total_daies?>"  id="bage_total_daies" type="number" placeholder="اجمالى ايام الحقيبة" class="form-control" required>
																		</div>
																	</div>	
																	
																	
														
														
													
                                                      <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-10">
                                                                <label> التخصص   </label>
                                                             <select name="cat_id"  class="form-control"  id="cat_id">
                                                                 <option value="<?= $cat_id; ?>"><?= $category_name; ?></option>
                                                             <?php
                                                            $category= $this->db->get_where('category',array('view'=>'1','id!='=>$cat_id))->result();
                                                             foreach($category as $category){
                                                             ?>
                                                             <option value="<?=$category->id?>"> <?=$category->name?> </option>
                                                             <?php }?>
                                                             </select>
															</div>
                                                        </div>
                                                        
																	
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																		<span class="help-block">الوصف العام للحقيبة</span>
																			<textarea name="bage_details" id="bage_details" class="form-control" style="height:80px"><?= $data->bage_details?></textarea>
																		</div>
																	</div>
																	
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="button" class="mainbutton btn green bagbutton">
																					<i class="fa fa-check"></i>حفقظ</button>
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
        window.location.assign("<?=DIR?>admin/places/");
    });
    $("#type").change(function(){
     var val=  $(this).val(); 
      if(val==1){
          $(".outside_courses").hide();
          $(".inside_courses").show();
      }
      else {
          $(".inside_courses").hide();
          $(".outside_courses").show();     
      }
    });
});
</script>




</body>
</html>
