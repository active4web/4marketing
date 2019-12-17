<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-130 pb-30" >
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
<div class="col-lg-3"></div>
<div class="col-lg-6">

<div class="col-lg-12" style="height:20px"></div>


<form method="POST" action="#" class="contact-form form" id="form" enctype='multipart/form-data'>

<div class="row">
<div class="col-md-12 main_previw" style="text-align:center;margin-bottom:10px;color:#367dfe;font-weight:bold;font-size:20px">إنشاء حساب جديد
</div>
<?php
if($this->uri->segment(4)==2){
?>
<div class="col-md-12 main_previw" style="text-align:center;">انت الأن تسجل فى حساب مدرب</div>
<?php
} if($this->uri->segment(4)==4){
?>
<div class="col-md-12 main_previw" style="text-align:center;">انت الأن تسجل فى حساب شركة</div>
<?php
 } if($this->uri->segment(4)==3){
?>
<div class="col-md-12 main_previw" style="text-align:center;">انت الأن تسجل فى حساب صاحب حقيبة</div>
<?php
 } if($this->uri->segment(4)==1){
?>
<div class="col-md-12 main_previw" style="text-align:center;">انت الأن تسجل فى حساب عضو</div>
<?php }?>

<div class="col-lg-12" style="height:20px"></div>

<div class="col-md-12 pos" style="text-align:center">
<div class="fileinput fileinput-new" data-provides="fileinput">
	<div class="fileinput-new thumbnail" style="width:120px; height: 120px;border-radius:50%">
	<img src="<?= DIR_DES_STYLE; ?>customers/no_img.png">
</div>
	<div class="fileinput-preview fileinput-exists thumbnail" style="border-radius:50%;max-width: 120px; max-height: 120px;"> </div>
	<div class="btn_img fileinput" style="right: 169px;top: 23px;">
	<span class=" default btn-file">
	<span class="fileinput-new"><i class="fa fa-pen"></i></span>
	<span class="fileinput-exists"><i class="fa fa-pen"></i></span>
	<input type="file" name="img"> </span>
	<a href="javascript:;" class="red fileinput-exists" data-dismiss="fileinput"> 
		<i class="fa fa-times-circle"></i> </a>
	</div>
	</div>

</div>
<input type="hidden" id="usertype" name="usertype"  value="<?= $this->uri->segment(4); ?>">

<div class="col-md-12 pos">
<label class="label" for="password">الأسم</label>
<input type="text" id="name" name="name" class="theme-input-style main_input"   placeholder="الأسم">
</div>

<div class="col-md-12 pos">
<label class="label" for="phone">رقم الجوال</label>
<input type="text" id="phone" name="phone" class="theme-input-style main_input"   placeholder="رقم الجوال">
</div>
<div class="col-md-12 pos">
<label class="label" for="email">البريد الألكترونى </label>
<input type="text" id="email" name="email" class="theme-input-style main_input"  placeholder="البريد الألكترونى">
</div>



<div class="col-md-6 pos">
<label class="label" for="age"> العمر </label>
<input type="text" id="age" name="age" class="theme-input-style main_input"  placeholder="العمر">
</div>

<div class="col-md-6 pos">
<label class="label" for="city"> المدينة </label>
<select name="city_id" class="theme-input-style">
		<?php 
		if(count($city)>0){
		foreach($city as $cityid){
		?>
		<option value="<?=$cityid->id?>"><?=$cityid->name?></option>
		<?php  } }?>
		</select> 
</div>

<?php
if($this->uri->segment(4)==2||$this->uri->segment(4)==4){
?>
<div class="col-md-12 pos">
<?php
if($this->uri->segment(4)==2){
?>
<label class="label trainer" for="cat_id"> التخصص </label>
<?php
} if($this->uri->segment(4)==4){
?>
<label class="label company" for="cat_id"> تخصص الشركة </label>
<?php }?>
		<select name="cat_id" class="theme-input-style">
		<?php 
		if(count($category)>0){
		foreach($category as $catid){
		?>
		<option value="<?=$catid->id?>"><?=$catid->name?></option>
		<?php  } }?>
		</select> 
</div>
		<?php }?>

<div class="col-md-12 pos">
<label class="label" for="email">كود المشاركة المرسل لك </label>
<input type="text" id="invitation_code" name="invitation_code" class="theme-input-style main_input"  placeholder="كود المشاركة المرسل لك (اختيارى)">
</div>

<div class="col-md-6 pos">
<label class="label" for="pass"> كلمة المرور </label>
<input type="password" id="pass" name="pass" class="theme-input-style main_input"  placeholder="كلمة المرور">
</div>

<div class="col-md-6 pos">
<label class="label" for="conpass"> تاكيد كلمة المرور </label>
<input type="password" id="conpass" name="conpass" class="theme-input-style main_input"  placeholder="تاكيد كلمة المرور">
</div>

<div class="col-md-12 main_previw" style="text-align:center;margin-bottom:10px;">
		إذا فمت تكلمة التسجيل فأنت توافق على <a href="<?= DIR?>login/terms/<?=$this->uri->segment(4)?>" style="color:#367dfe;" target="_blank">الشروط والأحكام</a>
</div>

<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader register_account" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class=""> إنشاء حساب جديد</span></span></button>
</div>

<div class="col-lg-3"></div>


<div class="col-lg-12" style="height:100px"></div>


</div>
<div class="form-response"></div>
</form>

</div>
</div>
<div class="col-md-12 bg_login" style="background-image:url(<?=base_url()?>uploads/site_setting/login_bg.jpg)"></div>
</div>


<div class="col-lg-12" style="height:20px"></div>
</div>
</div>
			</div>

	
