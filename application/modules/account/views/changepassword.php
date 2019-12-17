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
	<div class="col-lg-3" style="background:#fff;text-align: right;border:1px solid #ecebebde; border-radius:0.4em;;height:200px;margin-bottom:50px">
<div class="row" style="margin:0px;">
<div class="col-lg-12 main_previw" style="padding-top:10px;">
<a href="<?=base_url()?>user/profile/myaccount">
	تعديل المعلومات <span style="float:left"></span>
	</a>
</div>
<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>
<div class="col-lg-12 main_previw" style=""><a href="<?=base_url()?>user/profile/changepassword" style="color:#367cff">
تعديل كلمة المرور <span style="float:left"><i class="fa fa-chevron-left"></i></span>
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

<form method="POST" action="#" class="contact-form form" id="form" >




	

<div class="row">
<div class="col-lg-12" style="height:50px"></div>





<div class="col-md-12 pos">
<label class="label" for="curr_pass">كلمة المرور الحالية</label>
<input type="password" id="curr_pass" name="curr_pass" class="theme-input-style main_input"  placeholder="كلمة المرور الحالية">
</div>

<div class="col-md-12 pos">
<label class="label" for="new_pass">كلمة المرور الجديدة </label>
<input type="password" id="new_pass" name="new_pass" class="theme-input-style main_input"   placeholder="كلمة المرور الجديدة ">
</div>
<div class="col-md-12 pos">
<label class="label" for="confir_pass"> تاكيد كلمة المرور </label>
<input type="password" id="confir_pass" name="confir_pass" class="theme-input-style main_input"   placeholder=" تاكيد كلمة المرور ">
</div>



<div class="col-md-12">
<button type="button" class="btn searchbutton mainheader change_password" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
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

	
