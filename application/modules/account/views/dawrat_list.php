<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
			<div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="page-title text-center">
					<div class="row">
                        <span class="col-lg-3 col-md-6 user_dawrat"><a href="<?= base_url()?>user/" style="color:#fff;">الدورات</a> </span>
						<span class="col-lg-3 col-md-6 user_dawrat_1"><a href="<?= base_url()?>user/courses/diplomas">الدبلومات</a></span>
						<span class="col-lg-3 col-md-6 user_dawrat_1"><a href="<?= base_url()?>user/courses/bags/">الحقائب</a></span>
						<span class="col-lg-3 col-md-6 user_dawrat_1"><a href="<?= base_url()?>user/trainers/">المدربين</a></span>
						</div>
                    </div>
                </div>
				<div class="col-md-4"></div>
            </div>
        </div>
    </section>
	
		<div class="wrapper">
			<div class="container">
				<div class="row  pt-50 ">
<div class="col-md-4 col-lg-3" style="margin-bottom:30px;background-color:#fcfcfe;padding:10px">
<?php 
include("sidebar.php");
?>
					</div>
					
					<div class="col-md-8 col-lg-9" style="padding-right:30px">
						<div class="row">
						    <div class="col-md-12" style="margin-bottom: 15px;border-bottom: 2px solid #fcfcfe;padding-bottom: 10px;">
						        
						        <a>
<div  class="display_courses">
<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="th-list" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-th-list fa-w-16 fa-lg"><path fill="currentColor" d="M0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48H48C21.49 32 0 53.49 0 80zm472 224H197.333v-96H472v96zm0 40v84c0 6.627-5.373 12-12 12H197.333v-96H472zM40 208h117.333v96H40v-96zm157.333-40V72H460c6.627 0 12 5.373 12 12v84H197.333zm-40-96v96H40V84c0-6.627 5.373-12 12-12h105.333zM40 344h117.333v96H52c-6.627 0-12-5.373-12-12v-84z" class=""></path></svg>
</div></a>

	 <a href="<?=base_url()?>user/">
       <div  class="display_courses_notactive">
			<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="th" role="img" xmlns="http://www.w3.org/2000/svg" 
			viewBox="0 0 512 512" class="svg-inline--fa fa-th fa-w-16 fa-lg"><path fill="currentColor" 
			d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM197.3 72h117.3v96H197.3zm0 136h117.3v96H197.3zm-40 232H52c-6.6 0-12-5.4-12-12v-84h117.3zm0-136H40v-96h117.3zm0-136H40V84c0-6.6 5.4-12 12-12h105.3zm157.4 272H197.3v-96h117.3v96zm157.3 0H354.7v-96H472zm0-136H354.7v-96H472zm0-136H354.7V72H472z" class=""  ></path></svg>
						</div>
						    </a>
						    


						    
						    </div>
						    <?php
						    if(count($result_count)==0){
						    ?>
						    <div class="col-md-12">
					<div class="page-title text-center" >
                        <h2 style="font-size:16px;padding-top:20px">لا يوجد اى محتوى حاليا</h2>
                        </div>
                        </div>
						    <?php } else {?>

<?php
$customer_id=$this->session->userdata("customer_id");
foreach($results as $bag){

 $Institute_name=get_table_filed('Institute',array('id_course'=>$bag->id),"Institute_name");
 $Institute_about=get_table_filed('Institute',array('id_course'=>$bag->id),"Institute_about");  
  $Institute_img=get_table_filed('Institute',array('id_course'=>$bag->id),"Institute_img");  
  $city_id_bage=$bag->city_id;
$city =get_table_filed('city',array('id'=>$city_id_bage),"name");
$country_id =get_table_filed('city',array('id'=>$city_id_bage),"country_id");
$country=get_table_filed('country',array('id'=>$country_id),"title");
$id_fav =get_table_filed('favourites',array('user_id'=>$customer_id,'type'=>$bag->type,'course_id'=>$bag->id),"id");

?>
<div class="col-md-12" style="margin-bottom:20px;position:relative;min-height:120px">
 <div class="row" style="background-color:#fff">
    

       
 <div class="col-md-2 col-ms-6" style="text-align:right">       
<div class="img_info" >

 <a href="<?=base_url()?>user/courses/courses_details/<?= $bag->id;?>">
<?php 
if($bag->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>products/thumbnail_100/<?=$bag->img?>" style="height:auto !important;width:100% !important" class="img_bags">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:auto !important;width:100% !important" class="img_bags">
<?php }?>
</a>
</div>

</div>

 <div class="col-md-10 col-ms-6" style="text-align:right;">
     
<h3 style="font-size:14px;text-align:right;font-weight:600;padding-top:10px;color:#797979">
<?php if($id_fav!=""){$myfav="block";  $no_myfav="none"; } else { $no_myfav="block";$myfav="none";}?>
<i class="fa fa-heart myfav" style="display:<?= $myfav;?>"></i>
<i class="icon-heart-empty no_myfav"  style="display:<?= $no_myfav;?>"></i>
<input type="hidden" class="myfav_val" value="<?= $bag->id;?>">
<input type="hidden" class="course_key" value="<?= $bag->type;?>">

 <a href="<?=base_url()?>user/courses/courses_details/<?= $bag->id;?>"> <?= $bag->name;?></a></h3>
 <a href="<?=base_url()?>user/courses/courses_details/<?= $bag->id;?>">


<div class="row"  style="color:#797979;padding-top:15px">
<div class="col-md-4 col-sm-12" style="font-weight:500;font-size:14px;text-align:right">
<i class="icon-map-marker" style="margin-left:5px;font-size:16px"></i><?= mb_substr($city,0,10);?></div>
<div class="col-md-4 col-sm-12" style="font-size:14px;text-align:right;font-weight:500;">
<img src="<?=DIR_DES_STYLE?>site_setting/buliding.png" class="icon_img"><?= mb_substr($Institute_name,0,10);?></div>
<div class="col-md-4 col-sm-12" style="font-size:14px;text-align:right;color: #367dff;font-weight:500;">
<img src="<?=DIR_DES_STYLE?>site_setting/chair.png" class="icon_img"><?= $bag->num_seats;;?></div>
</div>


<div class="row"  style="color:#3f3f3f;padding-top:10px;padding-bottom: 10px;">
<div class="col-md-12 col-lg-4" style="font-size:12px;text-align:right;">
<?php
if($bag->price>$bag->discount&&$bag->discount!=""&&$bag->discount!=0){
  $discount=$bag->price; 
  $price=$bag->discount;
}
else{
if($bag->discount==""||$bag->discount==0){$discount="";}
else {$discount=$bag->discount; }
$price=$bag->price;   
}

?>
<div style="color: #367dff;font-size:12px; font-weight:500;margin-left:10px"><?= $price.""."ريال";?>

<?php 
if($discount!=""){
?>
<strike style="color: #797979"><?= $discount.""."ريال";?></strike>
<?php }?>
</div>
</div>

<div class="col-md-12 col-lg-2"></div>  
<div class="col-md-12 col-lg-6 align_r" style="font-size:13px;text-align:left">
<?php 
$total_rate=$bag->total_rate;
for($i=0; $i<5; $i++){
if($total_rate>$i){
//$total_rate--;
?>
<i class="fa fa-star rate_view " style="color:#fec355;font-size:12px"></i>
<?php } else {?>
<i class="icon-star-empty"></i>
<?php } }?>
</div>
</div>



</div>




</div>
</a>
</div>

<?php  }?>
<div class="col-md-12 pagination justify-content-center" style="margin-bottom:20px;">						    
 <ul class="nav align-items-center" style="visibility: visible;margin:auto">
            <?php foreach($links as $link){?><?php echo $link;?><?php } ?>
</div>
                                            </ul>						    
						    <?php }?>
						    
						</div>
					</div>

			</div>
		</div>
		

		</div>

	
