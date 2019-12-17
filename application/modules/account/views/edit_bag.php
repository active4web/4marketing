<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
	foreach($bag_info as $bag_info)
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
<div class="row" style="background:#fff;margin:50px 0px 0px 0px">
<div class="col-lg-12" style="height:20px"></div>
<div class="col-md-12 main_previw" style="text-align:center;">تعديل الحقيبة <?= $bag_info->bage_name;?></div>
<div class="col-lg-12" style="height:30px"></div>
<div class="col-lg-3"></div>
<div class="col-lg-6">

<form method="POST" action="#" class="contact-form form" id="form">




	

<div class="row">

<div class="col-md-12 pos" style="text-align:center">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width:120px; height: 120px;border-radius:50%">
	<img src="<?= DIR_DES_STYLE; ?>products/<?= $bag_info->img?>">
</div>

	<div class="fileinput-preview fileinput-exists thumbnail" style="border-radius:50%;width: 120px;height: 120px;">
	<img src="<?= DIR_DES_STYLE; ?>products/<?= $bag_info->img?>">
</div>

	<div class="btn_img fileinput img_upload" >
	<span class=" default btn-file">
	<!--<span class="fileinput-new"><i class="fa fa-pen"></i></span>
	<span class="fileinput-exists"><i class="fa fa-pen"></i></span>-->
	<input type="file" name="img" class="img_value"> </span>
	<!--<a href="javascript:;" class="red fileinput-exists" data-dismiss="fileinput"> 
		<i class="fa fa-times-circle"></i> </a>-->
	</div>
	</div>

</div>
<input name="bag_id"  value="<?= $bag_info->id?>"  type="hidden" >

<div class="col-md-12 pos">
<label class="label" for="name">اسم الحقيبة</label>
<input id="name" name="name"  value="<?= $bag_info->bage_name?>" type="text" class="theme-input-style main_input"   placeholder="اسم الحقيبة">
</div>


<div class="col-md-12 pos">
<label class="label" for="about">وصف الحقيبة</label>
<textarea id="about" name="about" class="theme-input-style"  style="height:120px;" placeholder="وصف الحقيبة"><?= $bag_info->bage_details?></textarea>
</div>

<div class="col-md-12 pos">
<p class="main_previw"> محتوى الحقيبة فى نقاط</p>
<div class="field_wrapper">

<?php 
if(count($course_info)>0){
	$count=0;
	foreach($course_info as $course_info){
		$count++;
		if($count==1){
?>	
<div style="text-align:center;margin-bottom:15px">	
 <input type="text" name="field_name[]" value="<?=$course_info->content;?>" id="field_name" style="width:88%;border-radius:0.4em"  class="theme-input-style"/>
<a href="javascript:void(0);" class="add_button" title="اضافة محتوى">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
</div>
		<?php } else {?>
			<div style="text-align:center;margin-bottom:15px;">
			<input type="text" name="field_name[]" value="<?=$course_info->content;?>" style="width:88%;border-radius:0.4em"  class="theme-input-style"/>
			<a href="javascript:void(0);" class="remove_button">
			<img src="<?= base_url()?>uploads/site_setting/remove-icon.png" title="حذف محتوى"/>
			</a></div>
		<?php }}?>

	<?php  } else {?>
<div style="text-align:right;margin-bottom:10px">	
<input type="text" name="field_name[]" value="" id="field_name" style="width:88%;border-radius:0.4em"  class="theme-input-style" />
<a href="javascript:void(0);" class="add_button" title="اضافة محتوى">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
</div>
<?php }?>

</div>

</div>

<div class="col-md-6 pos">
<label class="label" for="bage_total_daies">اجمالى عدد ايام الحقيبة</label>
<input type="number" id="bage_total_daies" value="<?= $bag_info->bage_total_daies?>" name="bage_total_daies" class="theme-input-style main_input"  placeholder="اجمالى عدد ايام الحقيبة">
</div>

<div class="col-md-6 pos">
<label class="label" for="week_bage_daies">عدد الايام من كل اسبوع</label>
<input type="number" id="week_bage_daies" value="<?= $bag_info->week_bage_daies?>" name="week_bage_daies" class="theme-input-style main_input"  placeholder="عدد الايام من كل اسبوع">
</div>

<div class="col-md-12 pos">
<label class="label" for="bage_hrs">اجمالى عدد ساعات الحقيبة</label>
<input type="number" id="bage_hrs" value="<?= $bag_info->bage_hrs?>" name="bage_hrs" class="theme-input-style main_input"  placeholder="اجمالى عدد ساعات الحقيبة">
</div>




<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader edit_bag" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class="">حفظ التعديلات</span></span></button>
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
	var fieldHTML = '<div style="text-align:center;margin-bottom:15px;"><input type="text" name="field_name[]" class="theme-input-style" style="width:88%"/><a href="javascript:void(0);" class="remove_button"><img src="<?= base_url()?>uploads/site_setting/remove-icon.png"/></a></div>'; //New input field html 
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



