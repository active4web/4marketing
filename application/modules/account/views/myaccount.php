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
	<div class="col-lg-3" style="background:#fff;text-align: right;border:1px solid #ecebebde; border-radius:0.4em;;height:200px">
<div class="row" style="margin:0px;">
<div class="col-lg-12 main_previw" style="padding-top:10px; color:#367cff">
<a href="<?=base_url()?>user/profile/myaccount" style="color:#367cff">
	تعديل المعلومات <span style="float:left"><i class="fa fa-chevron-left"></i></span>
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
<a href="<?=base_url()?>user/profile/update_info">
تعديل (نبذا عن-المؤهل-الخبرات)
</a>
</div>
<?php }?>
<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>

</div>
</div>

<!------- END Col-lg-4----------------------->
<div class="col-lg-9" >
<div class="row" style="background:#fff;margin:0px;border:1px solid #ecebebde; border-radius:0.4em;">
<div class="col-lg-3"></div>
<div class="col-lg-6">

<form method="POST" action="#" class="contact-form form" id="form" enctype='multipart/form-data'>




	

<div class="row">
<div class="col-lg-12" style="height:50px"></div>



<div class="col-md-12 pos" style="text-align:center">
<div class="fileinput fileinput-new" data-provides="fileinput">
	<div class="fileinput-new thumbnail" style="width:120px; height: 120px;border-radius:50%">
	<img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>">
</div>
	<div class="fileinput-preview fileinput-exists thumbnail" style="border-radius:50%;width: 120px;height: 120px;"> </div>
	<div class="btn_img fileinput img_upload_profile">
	<span class=" default btn-file">
	<!--<span class="fileinput-new"><i class="fa fa-pen"></i></span>
	<span class="fileinput-exists"><i class="fa fa-pen"></i></span>-->
	<input type="file" name="img"> </span>
<!--<a href="javascript:;" class="red fileinput-exists" data-dismiss="fileinput"> 
		<i class="fa fa-times-circle"></i> </a>-->
	</div>
	</div>

</div>


<div class="col-md-12 pos">
<label class="label" for="password">الأسم</label>
<input type="text" id="name" name="name" class="theme-input-style main_input" value="<?= $data->user_name?>"  placeholder="الأسم">
</div>

<div class="col-md-12 pos">
<label class="label" for="phone">رقم الجوال</label>
<input type="text" id="phone" name="phone" class="theme-input-style main_input" value="<?= $data->phone?>"  placeholder="رقم الجوال">
</div>
<div class="col-md-12 pos">
<label class="label" for="email">البريد الألكترونى </label>
<input type="text" id="email" name="email" class="theme-input-style main_input" value="<?= $data->email?>"  placeholder="البريد الألكترونى">
</div>
<div class="col-md-6 pos">
<label class="label" for="age"> العمر </label>
<input type="text" id="age" name="age" class="theme-input-style main_input" value="<?= $data->age?>"  placeholder="العمر">
</div>

<div class="col-md-6 pos">
<label class="label" for="city"> المدينة </label>
<select name="cityid" class="theme-input-style">
		<option value="<?=$data->city_id?>"><?= $city_name?></option>
		<?php 
		if(count($city)>0){
		foreach($city as $cityid){
		?>
		<option value="<?=$cityid->id?>"><?=$cityid->name?></option>
		<?php  } }?>
		</select> 

</div>
<?php if($this->session->userdata("user_type")==2||$this->session->userdata("user_type")==4){?>
<div class="col-md-12 pos">
<?php if($this->session->userdata("user_type")==2){?>
<label class="label" for="cat_id"> التخصص </label>
<?php } else if($this->session->userdata("user_type")==4){?>
<label class="label" for="cat_id"> تخصص الشركة </label>
<?php }?>
		<select name="cat_id" class="theme-input-style">
		<option value="<?=$data->cat_id?>"><?= $cat_name?></option>
		<?php 
		if(count($category)>0){
		foreach($category as $catid){
		?>
		<option value="<?=$catid->id?>"><?=$catid->name?></option>
		<?php  } }?>
		</select> 
</div>
		<?php }?>


<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader change_profile" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
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

	
