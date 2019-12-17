<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
		foreach($results as $data)
		$cat_id=$data->cat_id;
		$cat_name =get_table_filed('category',array('id'=>$cat_id),"name");
		$tab_id=$this->input->post("course_id");
						?>


<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
				
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: inline-flex;">
				<li class="nav-item">
				<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#inside" role="tab" aria-controls="pills-inside" aria-selected="true">التحويل للحساب بنكى
				</a></li>
				<li class="nav-item">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-outside" role="tab" aria-controls="pills-outside" aria-selected="false">  الدفع بواسطة باى بال 
				</a></li></ul>
				
				
                    </div>
                </div>
            </div>
        </div>
	</section>
	


		<div class="wrapper">
			<div class="container">
				<div class="row  pt-50 ">
<div class="col-md-3 col-xs-12" >

<div class="row" style="margin-bottom:30px;background-color:#fff;">
 <div class="col-md-12" style="margin-bottom:20px;">

<div class="img_info" style="text-align:center;">
<?php
$customer_id=$this->session->userdata("customer_id");
$id_fav =get_table_filed('favourites',array('user_id'=>$customer_id,'type'=>$data->type,'course_id'=>$data->id),"id");?>



<?php if($id_fav!=""){$myfav="block";  $no_myfav="none"; } else { $no_myfav="block";$myfav="none";}?>
<i class="fa fa-heart myfav" style="display:<?= $myfav;?>"></i>
<i class="fa fa-heart no_myfav"  style="display:<?= $no_myfav;?>"></i>

<input type="hidden" class="myfav_val" value="<?= $data->id;?>">
<input type="hidden" class="course_key" value="<?= $data->type;?>">
<?php 

if($data->img!=""){
?>


<img src="<?=DIR_DES_STYLE?>products/<?=$data->img?>" style="width:100%" >
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="width:100%">
<?php }?>





</div>

</div>   
<?php 
  $city_id_bage=$data->city_id;
  $cat_id=$data->cat_id;
  $city =get_table_filed('city',array('id'=>$city_id_bage),"name");
  $category_name =get_table_filed('category',array('id'=>$cat_id),"name");

?>
<div class="col-md-12" style=";text-align:right;color:#000;font-weight:bold"><?= $data->name;?></div>
<div class="col-md-12 main_previw" style="height:10px"></div>
<div class="col-md-5 main_previw" style="text-align:right;"><i class="fa fa-map-marker" style="margin-left:5px;font-size:13px;"></i><?= $city;?></div>
<?php
if(count($institute)>0){
foreach($institute as $institute)?>
<div class="col-md-7 main_previw" style="text-align:right;"><i class="fa fa-hotel" style="margin-left:5px;font-size:13px;"></i><?= $institute->Institute_name;?></div>
<?php }?>
<div class="col-md-12 main_previw" style="height:20px"></div>
<div class="col-md-5 main_previw" style="text-align:right;font-size:12px">سعر الدورة:</div>
<div class="col-md-7 main_previw" style="text-align:left;font-size:12px">
    <span  style="font-size:14px; font-weight:400;"><?= $data->price.""."ريال";?></span>
</div>
<?php
if($this->input->post("discount_ceuta")>0){

?>
<div class="col-md-5 main_previw" style="text-align:right;font-size:12px">نسبة الخصم:</div>
<div class="col-md-7 main_previw" style="text-align:left;font-size:12px">
<span  style="font-size:14px; font-weight:400;"><?= $this->input->post("discount_ceuta").""."%";?></span>
</div>
<?php }?>
<div class="col-md-8 main_previw" style="text-align:right;font-size:12px;color:#367dfe;font-weight: bold;">الأجمالى المطلوب للدفع</div>
<div class="col-md-4 main_previw" style="text-align:left;">
<span  style="font-size:14px; font-weight:400;"><?= $this->input->post("finalprice").""."ريال";?></span>
</div>

</div>
</div>

<div class="col-md-9 col-xs-12 mb-30"  >
<div class="row" style="background-color:#fff;border-radius: 0.4em;margin:0px !important">



<div class="tab-content" id="pills-tabContent" style="width:100%">

<div class="tab-pane fade show active" id="inside" role="tabpanel" aria-labelledby="pills-inside-tab">
<div class="row">
<div class="col-lg-12 main_previw" style=";text-align:center;color:#000;font-size:20px;padding-top:20px">
الحسابات البنكية المتاحة
</div>
<div class="col-lg-12 main_previw" style="text-align:center;">
اختر الحساب المناسب لديك ثم قم بعمل تحويل بنكى على هذا الحساب ثم قم بإرسال بيانات الحوالة للادراة من خلال الرابط اداناه
</div>
<div class="col-lg-12" style="text-align:center;margin-top:50px;margin-bottom:50px;">
<div class="row" style="margin:0px;">
<?php
if(count($bank_accounts)>0){
foreach($bank_accounts as $bank_accounts){
?>
<div class="col-lg-6 main_previw">
<table >
<tr><td style="border:0px;"><span style="font-weight:bold;font-size:17px"> <?= $bank_accounts->name_bank;?> </span></td> </tr>
<tr><td style="border:0px;">اسم صاحب الحساب</td> <td style="border:0px;">  <?= $bank_accounts->user_name;?></td></tr>
<tr><td style="border:0px;">رقم الحساب البنكى</td> <td style="border:0px;"> <?= $bank_accounts->account_number; ?></td></tr>
<tr><td style="border:0px;">رقم الأبيان</td><td style="border:0px;"> <?= $bank_accounts->iban_number?></td></tr>
</table>
</div>



<?php }?>
<?php }?>

<form id="myform" action="<?=base_url()?>user/courses/transfer_info" class="col-md-12" method="post">
<div class="col-md-12" style="text-align:center;margin-top:30px;">
<input type="hidden" id="final_price_request" value="<?=$this->input->post("finalprice"); ?>" name="finalprice">
<input type="hidden" value="<?=$this->input->post("course_id"); ?>" name="course_id">
<input type="hidden" id="discount_ceuta" value="<?=$this->input->post("discount_ceuta"); ?>" name="discount_ceuta">
<input type="hidden" id="discount_price" value="<?= $this->input->post("discount_price");?>" name="discount">
<button type="submit" class="btn searchbutton mainheader stepsbutton" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span>تأكيد الطلب</span></button>

</div>
</form>

</div>
</div>


</div>


</div>


<div class="tab-pane fade" id="pills-outside" role="tabpanel" aria-labelledby="pills-outside-tab">
<div class="row">
<div class="col-lg-12 main_previw" style=";text-align:center;color:#000;font-size:20px;padding-top:20px">
بيانات حساب باى بال

</div>
<div class="col-lg-12 main_previw" style="text-align:center;">ادفع الأن بواسطة باى بال</div>

	<form id="myform"  class="col-md-12 contact-form" method="post">
	    	        <div class="row" style="text-align:center">

	    	        <div class="col-md-3" style="text-align:center"></div>

	    <div class="col-md-6" style="text-align:center">
    <input type="text" class="theme-input-style" readonly placeholder="البريد الألكترونى" name="email">
    </div><div class="col-md-3" style="text-align:center"></div>
    <div class="col-md-3" style="text-align:center"></div>
    <div class="col-md-6" style="text-align:center">
    <input type="text" class="theme-input-style" readonly placeholder="القيمة المطلوب دفعها" name="price">
    </div><div class="col-md-3" style="text-align:center"></div>
<div class="col-md-12" style="text-align:center">

<button type="button" class="btn searchbutton mainheader stepsbutton disabled" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
    <span>اتمام الدفع</span></button>


</div>

</div>
</form>

</div>

</div>


</div>
</div>

</div></div></div>


