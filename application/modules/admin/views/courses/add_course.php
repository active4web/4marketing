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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>اضافة اعلان</title>
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
							<a href="<?=$url.'admin/courses/inside';?>">اعلانات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>اضافة اعلان</span>
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
															<i class="fa fa-gift"></i>اضافة اعلان </div>
													</div>
													<?php //print_r($now);?>
													<div class="portlet light bordered form-fit">
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" id="service_type" value="1">
						<form action="#" class="form-horizontal form-bordered"  method="post" id="myForm">
															    
															    	
															    
															    
																<div class="form-body">
																	
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-5">
																		<span class="help-block"> اسم الأعلان </span>
																			<input name="title" id="title"  type="text" placeholder="اسم الأعلان " class="form-control" required>
																			
																		</div>
																			<div class="col-md-5">
																		<span class="help-block">البلد</span>
																		 <select name="city"  class="form-control"  id="city">
                                                             <?php 
                                                             foreach($city as $city){
                                                             ?>
                                                             <option value="<?=$city->id?>"> <?=$city->name?> </option>
                                                             <?php }?>
                                                             </select>
																		</div>
																		<div class="col-md-1"></div>
																	</div>																	
																	
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-5">
																		<span class="help-block">السعر</span>
																			<input name="price" id="price"  type="text" placeholder="السعر" class="form-control" required>
																		</div>
																		<div class="col-md-5">
																		    
																		      <label> العملة  </label>
                                                             <select name="currency"  class="form-control" id="currency">
                                                                  <option value="">من فضلك حدد عملة </option>
                                                             <?php 
                                                             foreach($currency as $currency){
                                                             ?>
                                                             <option value="<?=$currency->id?>"> <?=$currency->name?> </option>
                                                             <?php }?>
                                                             </select>
																		    
																		</div>
																			<div class="col-md-1"></div>
																	</div>	
																	
																
																	
																		<div class="form-group">
														<div class="col-md-1"></div>
                                                            <div class="col-md-5">
                                                                <label> الاقسام الرئيسية </label>
                                                             <select name="category"  class="form-control" id="category"  onChange="getState(this.value);">
                                                                  <option value="">من فضلك حدد القسم</option>
                                                             <?php 
                                                             foreach($category as $category){
                                                             ?>
                                                             <option value="<?=$category->id?>"> <?=$category->name?> </option>
                                                             <?php }?>
                                                             </select>
															</div>
															  <div class="col-md-5">
                                                                 <label>الاقسام الفرعية</label>
                        <select class="form-control demoInputBox city_id"  name="dep_id"  id="state-list">
                        <option value="">الأقسام الفرعية</option>
                        </select>
															</div>
															
															<div class="col-md-1"></div>
                                                        </div>
														
														
														
                                                        
                                                       
                                                        
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
																		<div class="col-md-4">
																		<span class="help-block">التليفون</span>
																			<input name="phone"  id="phone"  type="text" placeholder="التليفون" class="form-control" required>
																		</div>
																			<div class="col-md-4">
																		<span class="help-block">البريد الألكترونى</span>
																			<input name="email"   type="text" placeholder="البريد الألكترونى" class="form-control" required>
																		</div>
																		<div class="col-md-2">
                                                                 <label>نوع الأعلان</label>
                        <select class="form-control"  name="special" >
                        <option value="1">اعلان مميز</option>
                         <option value="0">اعلان عادى</option>
                        </select>
															</div>
															<div class="col-md-1"></div>
																	</div
																	
    													
														
																	
																	  <div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block">وصف  </span>
																	<textarea name="about" id="about" class="form-control" style="height:100px;"></textarea>

																		</div>
																			<div class="col-md-1"></div>
																	</div>
																	
																		<div class="form-group">
																	<div class="col-md-4">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"></div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new">صورة  </span>
																								<span class="fileinput-exists">تغيير</span>
																								<input type="file" name="img"> </span>
																								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																						</div>
																					</div>
																					<p style="color:red;direction:rtl"></p>
																		<p style="color:red;direction:rtl">عرض الصورة 400 بيكسل</p>
																		<p style="direction:rtl">طول الصورة 400بيكسل</p>
																	</div>
																	
																	
																		<div class="col-md-4">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"></div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new">صورة  </span>
																								<span class="fileinput-exists">تغيير</span>
																								<input type="file" name="img1"> </span>
																								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																						</div>
																					</div>
																					<p style="color:red;direction:rtl"></p>
																		<p style="color:red;direction:rtl">عرض الصورة 400 بيكسل</p>
																		<p style="direction:rtl">طول الصورة 400بيكسل</p>
																	</div>
																	
																	
																	
																		<div class="col-md-4">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"></div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new">صورة  </span>
																								<span class="fileinput-exists">تغيير</span>
																								<input type="file" name="img2"> </span>
																								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																						</div>
																					</div>
																					<p style="color:red;direction:rtl"></p>
																		<p style="color:red;direction:rtl">عرض الصورة 400 بيكسل</p>
																		<p style="direction:rtl">طول الصورة 400بيكسل</p>
																	</div>
																	
																	</div>
																	
																	
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="button" class="mainbutton btn green coursesbutton">
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

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>  


</body>
</html>
