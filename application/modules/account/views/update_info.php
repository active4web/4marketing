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



<?php 
	$myimg=$this->session->userdata("myimg");
	if($myimg==""){$main_img="no_img.png";}
	else {$main_img=$myimg;}
	?>
	<div class="col-lg-12 main_previw pt-40">
		<div class="row">
		<div class="col-md-6"><img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img">
		<p style="margin-top:30px;margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_name"),0,50);?></p>
		<p style="margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_email"),0,50);?></p>
	</div>

	

	</div>
	</div>

	<div class="col-lg-12">
	<div class="row" style="margin:0px;">
	<div class="col-lg-3" style="background:#fff;text-align: right;border-radius: 0.4em;height:200px;border:1px solid #ecebebde; border-radius:0.4em;margin-bottom:50px">
<div class="row" style="margin:0px;">
<div class="col-lg-12 main_previw" style="padding-top:10px;">
<a href="<?=base_url()?>user/profile/myaccount" >
	تعديل المعلومات <span style="float:left"></span>
	</a>
</div>
<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>
<div class="col-lg-12 main_previw" style=""><a href="<?=base_url()?>user/profile/changepassword">
تعديل كلمة المرور
</a>
</div>
<?php if($this->session->userdata("user_type")==2){?>
	<div class="col-lg-12" ><hr style="width:100%;margin:5px 0px 5px 0px"></div>
<div class="col-lg-12 main_previw" style="padding-bottom:10px">
<a href="<?=base_url()?>user/profile/update_info" style="color:#367cff">
تعديل (نبذا عن-المؤهل-الخبرات)<i class="fa fa-chevron-left"></i>
</a>
</div>
<?php }?>
<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>

</div>
</div>

<!------- END Col-lg-4----------------------->
<div class="col-lg-9" >
<div class="row" style="background:#fff;margin:0px;border:1px solid #ecebebde; border-radius:0.4em;">
<div class="col-lg-2"></div>
<div class="col-lg-8">

<form method="POST" action="#" class="contact-form form" id="form" enctype='multipart/form-data'>




	

<div class="row">
<div class="col-lg-12" style="height:50px"></div>





<div class="col-md-12 pos">
<label class="label" for="about">نبذة عنك</label>
<textarea id="about" name="about" class="theme-input-style main_input"  style="height:120px;" placeholder="نبذة عنك"><?= $data->about?></textarea>
</div>

<div class="col-md-12 pos">
<p class="main_previw">المؤهلات العلمية</p>
<div class="field_wrapper">
<?php 
if(count($trainer_certifactes)>0){
	$count=0;
	foreach($trainer_certifactes as $trainer_cert){
		$count++;
		if($count==1){
?>	
<div style="text-align:center;margin-bottom:15px">	
 <input type="text" name="field_name[]" value="<?=$trainer_cert->certification;?>" id="field_name"/>
<a href="javascript:void(0);" class="add_button" title="اضافة المؤهل">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
</div>
		<?php } else {?>
			<div style="text-align:center;margin-bottom:15px;">
			<input type="text" name="field_name[]" value="<?=$trainer_cert->certification;?>"/>
			<a href="javascript:void(0);" class="remove_button">
			<img src="<?= base_url()?>uploads/site_setting/remove-icon.png" title="حذف مؤهل"/>
			</a></div>
		<?php }?>

	<?php }?>
<?php } else {?>
<div style="text-align:center;margin-bottom:15px">	
<input type="text" name="field_name[]" value="" id="field_name"  />
<a href="javascript:void(0);" class="add_button" title="Add field">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
</div>
<?php }?>

</div>

</div>





<div class="col-md-12 pos">
<p class="main_previw">الخبرات</p>
<div class="field_wrapper_exper">
<?php 
if(count($trainer_experiences)>0){
	$count=0;
	foreach($trainer_experiences as $trainer_exp){
		$count++;
		if($count==1){
			$arra_m=array("يناير","فبراير","مارس","ابريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");
?>	


<div style="text-align:center;margin-bottom:15px" class="col-12">
<a href="javascript:void(0);" class="add_button_exper" title="الخبرات">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>
<div class="row"  style="border:1px solid #ecebebde;border-radius:0.4em;margin:0px;padding-top:15px">
<div class="col-md-6"><input type="text" name="exp[]"  value="<?=$trainer_exp->experiences;?>" id="exp" class="theme-input-style main_input" placeholder="المسمى الوظيفى"/></div>
<div class="col-md-6"><input type="text" name="comp[]"  value="<?=$trainer_exp->company_name;?>" id="comp" class="theme-input-style main_input"  placeholder="اسم الشركة"/></div>
<div class="col-md-12"><p class="main_previw">من </p></div>

<div class="col-md-6">
<select name="start_month[]" class="theme-input-style">
<option><?=$trainer_exp->start_moth;?></option>
<?php
for($i=0; $i<count($arra_m);  $i++){
	if($trainer_exp->start_moth!=$arra_m[$i]){
?>
<option><?= $arra_m[$i];?></option>
<?php } }?>

</select>
</div>
<div class="col-md-6">
<select name="start_year[]" class="theme-input-style">
<option><?=$trainer_exp->start_date;?></option>
<?php
for($i=date("Y"); $i>1880;  $i--){
?>
<option><?= $i;?></option>
<?php }?>
</select>
</div>


<div class="col-md-12"><p class="main_previw">الى</p></div>

<div class="col-md-6">
<select name="end_month[]" class="theme-input-style">
<?php 
if($trainer_exp->end_month==""){
?>
<option value="1">حتى الان</option>
<?php }else{?>
<option><?=$trainer_exp->end_month;?></option>
<option value="1">حتى الان</option>
<?php }?>
<?php
for($i=0; $i<count($arra_m);  $i++){
	if($trainer_exp->end_month!=$arra_m[$i]){
?>
<option><?= $arra_m[$i];?></option>
	<?php } }?>
</select>
</div>

<div class="col-md-6">
<select name="end_year[]" class="theme-input-style">
<?php 
if($trainer_exp->end_date==""){
?>
<option value="1">حتى الان</option>
<?php }else{?>
<option><?=$trainer_exp->end_date;?></option>
<option value="1">حتى الان</option>
<?php }?>
<?php
for($i=date("Y"); $i>1880;  $i--){
	if($trainer_exp->end_date!=$i){
?>
<option><?= $i;?></option>
<?php }?>
	<?php }?>
</select>
</div>


</div>	



</div>
		<?php } else {
		
					$arra_m=array("يناير","فبراير","مارس","ابريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");

		?>
		
			<div style="text-align:center;margin-bottom:15px" class="col-12">
			<a href="javascript:void(0);" class="remove_button">
			<img src="<?= base_url()?>uploads/site_setting/remove-icon.png" title="حذف خبرات"/>
			</a>
<div class="row"  style="border:1px solid #ecebebde;border-radius:0.4em;margin:0px;padding-top:15px">
<div class="col-md-6"><input type="text" name="exp[]"  value="<?=$trainer_exp->experiences;?>" id="exp" class="theme-input-style main_input" placeholder="المسمى الوظيفى"/></div>
<div class="col-md-6"><input type="text" name="comp[]"  value="<?=$trainer_exp->company_name;?>" id="comp" class="theme-input-style main_input"  placeholder="اسم الشركة"/></div>
<div class="col-md-12"><p class="main_previw">من </p></div>

<div class="col-md-6">
<select name="start_month[]" class="theme-input-style">
<option><?=$trainer_exp->start_moth;?></option>
<?php
for($i=0; $i<count($arra_m);  $i++){
	if($trainer_exp->start_moth!=$arra_m[$i]){
?>
<option><?= $arra_m[$i];?></option>
<?php } }?>
</select>
</div>
<div class="col-md-6">
<select name="start_year[]" class="theme-input-style">
<option><?=$trainer_exp->start_date;?></option>
<?php
for($i=date("Y"); $i>1880;  $i--){
?>
<option><?= $i;?></option>
<?php }?>
</select>
</div>


<div class="col-md-12"><p class="main_previw">الى</p></div>

<div class="col-md-6">
<select name="end_month[]" class="theme-input-style">
<?php 
if($trainer_exp->end_month==""){
?>
<option value="1">حتى الان</option>
<?php }else{?>
<option><?=$trainer_exp->end_month;?></option>
<option value="1">حتى الان</option>
<?php }?>
<?php
for($i=0; $i<count($arra_m);  $i++){
	if($trainer_exp->end_month!=$arra_m[$i]){
?>
<option><?= $arra_m[$i];?></option>
	<?php } }?>

</select>
</div>

<div class="col-md-6">
<select name="end_year[]" class="theme-input-style">

<?php 
if($trainer_exp->end_date==""){
?>
<option value="1">حتى الان</option>
<?php }else{?>
<option><?=$trainer_exp->end_date;?></option>
<option value="1">حتى الان</option>
<?php }?>
<?php
for($i=date("Y"); $i>1880;  $i--){
	if($trainer_exp->end_date!=$i){
?>
<option><?= $i;?></option>
	<?php }?>
<?php }?>
</select>
</div>


</div>	


</div>


		<?php }?>

	<?php }?>
<?php } else {
					$arra_m=array("يناير","فبراير","مارس","ابريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");

?>
<a href="javascript:void(0);" class="add_button_exper" title="اضافة خبرة">
<img src="<?= base_url()?>uploads/site_setting/add-icon.png"/>
</a>	
<div style="text-align:center;margin-bottom:15px" class="col-12">
<div class="row"  style="border:1px solid #ecebebde;border-radius:0.4em;margin:0px;padding-top:15px">
<div class="col-md-6"><input type="text" name="exp[]"  id="exp" class="theme-input-style main_input" placeholder="المسمى الوظيفى"/></div>
<div class="col-md-6"><input type="text" name="comp[]"  id="comp" class="theme-input-style main_input"  placeholder="اسم الشركة"/></div>
<div class="col-md-12"><p class="main_previw">من </p></div>

<div class="col-md-6">
<select name="start_month[]" class="theme-input-style">
<?php
for($i=0; $i<count($arra_m);  $i++){
?>
<option><?= $arra_m[$i];?></option>
	<?php } ?>
</select>
</div>
<div class="col-md-6">
<select name="start_year[]" class="theme-input-style">
<?php
for($i=date("Y"); $i>1880;  $i--){
?>
<option><?= $i;?></option>
<?php }?>
</select>
</div>


<div class="col-md-12"><p class="main_previw">الى</p></div>

<div class="col-md-6">
<select name="end_month[]" class="theme-input-style">
<option value="1">حتى الان</option>
<?php
for($i=0; $i<count($arra_m);  $i++){
?>
<option><?= $arra_m[$i];?></option>
	<?php } ?>
</select>
</div>

<div class="col-md-6">
<select name="end_year[]" class="theme-input-style">
<option value="1">حتى الان</option>
<?php
for($i=date("Y"); $i>1880;  $i--){
?>
<option><?= $i;?></option>
<?php }?>
</select>
</div>


</div>	


</div>
<?php }?>

</div>

</div>



<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader update_info" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class="">حفظ التعديلات</span></span></button>
</div>

<div class="col-lg-2"></div>


<div class="col-lg-12" style="height:50px"></div>


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
	var fieldHTML = '<div style="text-align:center;margin-bottom:15px;"><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="<?= base_url()?>uploads/site_setting/remove-icon.png"/></a></div>'; //New input field html 
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



<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button_exper'); //Add button selector
	var wrapper = $('.field_wrapper_exper'); //Input field wrapper
	var fieldHTML = 
	'<div style="text-align:center;margin-bottom:15px" class="col-12"><a href="javascript:void(0);" class="remove_button"><img src="<?= base_url()?>uploads/site_setting/remove-icon.png"/></a><div class="row"  style="border:1px solid;border-radius:0.4em;margin:0px"><div class="col-md-6"><input type="text" name="exp[]" value=""  class="theme-input-style main_input" placeholder="المسمى الوظيفى"/></div><div class="col-md-6"><input type="text" name="comp[]" value="" class="theme-input-style main_input"  placeholder="اسم الشركة"/></div><div class="col-md-12"><p class="main_previw">من </p></div><div class="col-md-6"><select name="start_month[]" class="theme-input-style"><?php for($i=0; $i<count($arra_m);  $i++){?><option><?= $arra_m[$i];?></option><?php } ?></select></div><div class="col-md-6"><select name="start_year[]" class="theme-input-style"><?php for($i=date("Y"); $i>1880;  $i--){?><option><?= $i;?></option><?php }?></select></div><div class="col-md-12"><p class="main_previw">الى</p></div><div class="col-md-6"><select name="end_month[]" class="theme-input-style"><option value="1">حتى الان</option><?php for($i=0; $i<count($arra_m);  $i++){?><option><?= $arra_m[$i];?></option><?php } ?></select></div><div class="col-md-6"><select name="end_year[]" class="theme-input-style"><option value="1">حتى الان</option><?php for($i=date("Y"); $i>1880;  $i--){?><option><?= $i;?></option><?php }?></select></div></div></div>'; //New input field html 
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
