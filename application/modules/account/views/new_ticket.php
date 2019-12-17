<style>.wrapper {background-color:#fff} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        <h2>فتح تذكرة جديدة</h2>
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li>فتح تذكرة جديدة</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
	<div class="container">
	<div class="row" style="margin:0px">
	<div class="col-lg-3" style="text-align:center"> </div>
	<div class="col-lg-6" style="text-align:center">
<?php
		$user_type=$this->session->userdata("user_type");	
		$customer_id=$this->session->userdata("customer_id");

?>
<form method="POST" action="#" class="col-12 contact-form form" id="form">
<div class="row">
<input type="hidden"  name="customer_id" value="<?= $customer_id;?>">
<input type="hidden"  name="user_type" value="<?= $user_type;?>">
<input type="hidden"  name="tickets_types" value="1" id="tickets_types">
<div class="col-md-12">
<input class="theme-input-style input" type="text" placeholder="عنوان التذكرة" name="name" required="">
</div>
<div class="col-md-12">
<p class="main_previw">تحديد نوع التذكرة</p>
<div class="row">
<?php
foreach($tickets_types as $tickets_types){
?>
<div class="col-md-3 col-sm-4 ticket_tp"  style="cursor: pointer;margin-bottom:20px;background:<?= $tickets_types->color;?>;text-align:center;line-height:30px;margin-right:10px;color:#fff"><?= $tickets_types->name;?></div>
<input type="hidden"  class="div_txt" value="<?= $tickets_types->id;?>">
<?php }?>
</div>
</div>

<div class="col-md-12">
<textarea name="message" style="width:100%;height:100px;" id="message" class="theme-input-style main_input" placeholder="اكتب رسالتك"></textarea>
</div>
<div class="col-md-6 col-sm-6">
<button type="button" class="btn searchbutton mainheader reply_tickect" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><i class="fab fa-telegram-plane" style="background: transparent;float:right;    line-height: 45px;padding-right: 6px; font-size: 25px;"></i><span class="button_right"> ارسال الأن</span></span></button>
</div></div></form>

</div>
	<div class="col-lg-3" style="text-align:center"> </div>
</div>
            
	ً</div>	   </div>	  

	
