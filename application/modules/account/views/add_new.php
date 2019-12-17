<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
	foreach($customers as $data)
						?>

<section class="page-title-bg pt-50 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        
                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
			<div class="container">




	<div class="col-lg-12">
	<div class="row" style="margin:0px;">


<!------- END Col-lg-4----------------------->
<div class="col-lg-12" >
<div class="row" style="background:#fff;margin:50px 0px 0px 0px;border:1px solid #ecebebde; border-radius:0.4em;">
<div class="col-lg-12" style="height:20px"></div>
<?php
if($this->session->userdata("user_type")==3){
?>
<div class="col-md-12 main_previw" style="text-align:center;">إضافة حقيبة تدريبية</div>
<?php } else if($this->session->userdata("user_type")==4) {?>
	<div class="col-md-12 main_previw" style="text-align:center;">إضافة  دورة او دبلومة</div>
<?php }?>
<div class="col-lg-12" style="height:30px"></div>
<div class="col-lg-3"></div>
<div class="col-lg-6" style="padding:0px">

<form method="POST" action="#" class="contact-form form" id="form">



<input id="user_type" name="user_type" type="hidden" value="<?=$this->session->userdata("user_type");?>">
	

<div class="row main_row" >

<div class="col-md-12 pos" style="text-align:center;margin-bottom:20px;">
<div class="fileinput fileinput-new" data-provides="fileinput">
	<div class="fileinput-new thumbnail" style="width:120px; height: 120px;border-radius:50%">
	<img src="<?= DIR_DES_STYLE; ?>customers/no_img.png">
</div>
	<div class="fileinput-preview fileinput-exists thumbnail" style="border-radius:50%;width: 120px;height: 120px;"> </div>
	<div class="btn_img fileinput img_upload" >
	<span class=" default btn-file">
	<!--<span class="fileinput-new"><i class="fa fa-pen"></i></span>
	<span class="fileinput-exists"><i class="fa fa-pen"></i></span>-->
	<input type="file" name="img" class="img_value"> </span>
<!--	<a href="javascript:;" class="red fileinput-exists" data-dismiss="fileinput"> 
		<i class="fa fa-times-circle"></i> </a>-->
	</div>
	</div>

</div>

<div class="col-md-12 pos">
<?php
if($this->session->userdata("user_type")==3){
	$place_name="اسم الحقيبة";
	$place_about="وصف الحقيبة";
} else if($this->session->userdata("user_type")==4){
	$place_name="اسم الدورة";
	$place_about="وصف الدورة";
}
?>
<label class="label" for="name"><?= $place_name;?></label>

<input id="name" name="name" type="text" class="theme-input-style main_input"   placeholder="<?=$place_name;?>">
</div>


<div class="col-md-12 pos">
<label class="label" for="about"><?= $place_about;?></label>
<textarea id="about" name="about" class="theme-input-style"  style="height:100px;" placeholder="<?= $place_about;?>"></textarea>
</div>
<?php 
if($this->session->userdata("user_type")==4){
?>

<div class="col-md-6 pos">
<label class="label" for="price">السعر</label>
<input type="text" id="price" name="price" class="theme-input-style"  placeholder="السعر">
</div>


<div class="col-md-6 pos">
<label class="label" for="discount">الخصم (سعر بعد الخصم)</label>
<input type="text" id="discount" name="discount" class="theme-input-style"   placeholder="سعر بعد الخصم">
</div>

<div class="col-md-6 pos">
<label class="label" for="about">المدينة-الموقع</label>
<select name="city_id" class="theme-input-style">
		<?php 
		if(count($city)>0){
		foreach($city as $cityid){
		?>
		<option value="<?=$cityid->id?>"><?=$cityid->name?></option>
		<?php  } }?>
		</select> 
</div>

<div class="col-md-6 pos">
<label class="label" for="about">التصنيف</label>
<select name="cat_id" class="theme-input-style">
		<?php 
		if(count($category)>0){
		foreach($category as $catid){
		?>
		<option value="<?=$catid->id?>"><?=$catid->name?></option>
		<?php  } }?>
		</select> 
		
		</div>

		<div class="col-md-6 pos">
<label class="label" for="discount">مدة الدورة</label>
<input type="text" id="duration" name="duration" class="theme-input-style"   placeholder="مدة الدورة">
</div>
<div class="col-md-6 pos">
<label class="label" for="course_type"> النوع</label>
<select name="course_type" class="theme-input-style" id="course_type">
		<option value="1">دورات داخلية</option>
		<option value="3">دبلومات</option>
		</select> 

</div>


<div class="col-md-6 pos">
<label class="label" for="discount">عدد المقاعد</label>
<input type="text" id="num_seats" name="num_seats" class="theme-input-style"   placeholder="عدد المقاعد">
</div>
<div class="col-md-6 pos">
<label class="label" for="discount">تاريخ الدروة او الدبلومة</label>
<input name="date_course"  id="date" class="theme-input-style form_datetime"   type="text" placeholder="تاريخ الدورة او الدبلومة">
</div>
<div class="col-md-12 pos accreditation_number">
<label class="label" for="discount">رقم الأعتماد</label>
<input type="text" id="accreditation_number" name="accreditation_number" class="theme-input-style"   placeholder="رقم الأعتماد">
</div>
<?php }?>



<div class="col-md-12 pos">
<p class="main_previw">المحتوى على هيئة نقاط</p>
<div class="field_wrapper">

<div style="text-align:right;margin-bottom:10px">	
<input type="text" name="field_name[]" value="" id="field_name" placeholder="المحتوى على هيئة نقاط" style="width:88%;border-radius:0.4em"  class="theme-input-style" />
<a href="javascript:void(0);" class="add_button" title="Add field">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
</div>

</div>

</div>
<?php 
if($this->session->userdata("user_type")==4){
?>
<div class="col-md-6 pos">
<label class="label" for="Institute_name">مقدم الدورة </label>
<input type="text" id="Institute_name" name="Institute_name" class="theme-input-style"   placeholder="مقدم الدورة">
</div>

<div class="col-md-6 pos" style="text-align:center;margin-bottom:20px;">
<label class="label" for="Institute_name" style="right:61px;top:-30px;text-align: center;">صورة مقدم الدورة</label>
<div class="fileinput fileinput-new" data-provides="fileinput">
	<div class="fileinput-new thumbnail default btn-file" style="width:120px; height: 120px;border-radius:50%">
	<img src="<?= DIR_DES_STYLE; ?>customers/no_img.png">
</div>
	<div class="fileinput-preview fileinput-exists thumbnail" style="border-radius:50%;width: 120px; height: 120px;"> </div>
	<div class="btn_img fileinput img_upload_main" >
	<span class=" default btn-file">
<!--	<span class="fileinput-new"><i class="fa fa-pen"></i></span>
	<span class="fileinput-exists"><i class="fa fa-pen"></i></span>-->
	<input type="file" name="Institute_img" id="Institute_img"> </span>
<!--	<a href="javascript:;" class="red fileinput-exists" data-dismiss="fileinput"> 
		<i class="fa fa-times-circle"></i> </a>-->
	</div>
	</div>

</div>

<div class="col-md-12 pos">
<label class="label" for="Institute_name">وصف مقدم  الدورة</label>
<textarea id="Institute_about" name="Institute_about" class="theme-input-style"  style="height:80px;" placeholder="وصف مقدم  الدورة"></textarea>

</div>



<?php 
}
if($this->session->userdata("user_type")==3){
?>
<div class="col-md-6 pos">
<label class="label" for="bage_total_daies">اجمالى عدد ايام الحقيبة</label>
<input type="number" id="bage_total_daies" name="bage_total_daies" class="theme-input-style main_input"  placeholder="اجمالى عدد ايام الحقيبة">
</div>

<div class="col-md-6 pos">
<label class="label" for="week_bage_daies">عدد الايام من كل اسبوع</label>
<input type="number" id="week_bage_daies" name="week_bage_daies" class="theme-input-style main_input"  placeholder="عدد الايام من كل اسبوع">
</div>

<div class="col-md-12 pos">
<label class="label" for="bage_hrs">اجمالى عدد ساعات الحقيبة</label>
<input type="number" id="bage_hrs" name="bage_hrs" class="theme-input-style main_input"  placeholder="اجمالى عدد ساعات الحقيبة">
</div>
<?php }?>



<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader add_bag" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class="">اضف الان</span></span></button>
</div>

<div class="col-lg-3"></div>


<div class="col-lg-12" style="height:100px"></div>


</div>
<div class="form-response"></div>
</form>

</div>
</div>
</div>


<div class="col-lg-12" style="height:20px"></div>
</div>
</div>
			</div>

	
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    	<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div style="text-align:right;margin-bottom:0px;"><input type="text" name="field_name[]" class="theme-input-style" style="width:88%"/><a href="javascript:void(0);" class="remove_button"><img src="<?= base_url()?>uploads/site_setting/remove-icon.png"/></a></div>'; //New input field html 
	var x = 1; //Initial field counter is 1
	
	//Once add button is clicked
	$(addButton).click(function(){
		//Check maximum number of input fields
		if(x < maxField){ 
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); //Add field html
		}
	});
	
	//Once remove button is clicked
	$(wrapper).on('click', '.remove_button', function(e){
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>
	<link href="<?=base_url()?>design/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
		<!-- Date -->
		        <link href="<?=base_url()?>design/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>design/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        
		        <script src="<?=base_url()?>design/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>design/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>design/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>design/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>design/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
		
        <script src="<?=base_url()?>design/assets/global/plugins/moment.min.js" type="text/javascript"></script>
		
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
</script>


