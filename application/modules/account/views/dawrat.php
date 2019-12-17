<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}
.bag_edit{    color: #fff;
    float: left;
    margin-right: 5px;
    font-size: 12px;
    background: #da1414;
    border-radius: 50%;
    padding: 7px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 11px;
    margin-top: 10px;}
</style>
		<?php 
	foreach($site_info as $siteinfo)
	foreach($customers as $data_info)
	$cat_id=$data_info->cat_id;
	$cat_name= get_table_filed('category',array('id'=>$cat_id),'name');

	$myimg=$this->session->userdata("myimg");
									if($myimg==""){$main_img="no_img.png";}
									else {$main_img=$myimg;}
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
			<div class="container" style="padding:0px">

			<div class="col-md-12" style="padding:0px">
<div class="row" style="margin:0px">

<div class="col-lg-12 main_previw" style="text-align:center;padding:0px">
<div class="row" style="background:#fff;margin:50px 0px 0px 0px;border:1px solid #ecebebde; border-radius:0.4em;">

<?php 
if(count($result_count)==0){
?>

<div class="col-lg-12" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/dawrat_no.png">
</div>

<div class="col-lg-12" style="text-align:center"> 

<p class="main_previw" style="text-align:center;padding:10px;font-size:20px">لا يوجد دورات حالية</p>
<div class="col-md-12 ticket" style="text-align:center">
	<a href="<?=DIR?>user/company/add_new" class="mainheader stepsbutton" >
	<span style="padding:0px 15px 0px 15px"> 
	<i class="fa fa-briefcase" style="margin-left:10px;"></i>اضف دورة او دبلومة جديدة</span>
</a>
	</div>

 </div>
<?php } else {?>

	<?php
foreach($results as $bag){
	$city_id=$bag->city_id;
	$city_name=get_table_filed('city',array('id'=>$city_id),"name");
?>
<div class="col-md-4 col-lg-3 col-sm-12" style="margin-bottom:20px;margin-top:10px;    padding-right:10px;padding-left:10px;">
<div class="row"  style="margin:0px; webkit-box-shadow: 3px 1px 3px 1px #ecebebde; box-shadow: 3px 1px 3px 1px #ecebebde;;padding-bottom: 10px;">

<div class="img_info col-md-12" >

<?php 
if($bag->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>products/thumbnail_150/<?=$bag->img?>" style="width:100%;height:120px !important" class="img_bags">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="width:100%;height:120px !important" class="img_bags">
<?php }?>
</div>
<div class="col-md-12 info">
    


<div class="row"   style="margin:0px;">
<div class="col-md-12" style="padding:0px">
<h3 style="font-size:15px;text-align:right;font-weight:600;padding:10px 0px 10px 0px"><?= $bag->name;?></h3>
</div>

<div class="col-md-12 main_previw" style="color:#818181;padding:0px"><i class="icon-map-marker rate_view" style="font-size:17px;color:#8a8989"></i>
<span style="font-size:13px;text-align:right;font-weight:400;"><?= $city_name;?></span>
</div>

<div class="col-md-12 main_previw" style="line-height:40px;padding:0px">

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
<div style="font-size:15px;margin-left:10px">
<span  style="color: #367dff;font-size:14px; font-weight:bold;"><?= $price.""."ريال";?></span>

<?php 
if($discount!=""&&$bag->discount!=0){
?>
<strike style="color: #797979"><?= $discount.""."ريال";?></strike>
<?php }?>

<a href="#" title="حذف الدورة"  data-toggle="modal" data-target="#exampleModal" class="model_bag">
<span class="bag_edit"><i class="fa fa-trash-alt"></i></span>
</a>
<input type="hidden" value="<?= $bag->id;?>" class="delete_bag_id" >  
<a href="<?= DIR?>user/company/edit_dawrat/<?= $bag->id;?>" title="تعديل الدورة"><span class="bag_edit" style="background: #367dfe;"><i class="fa fa-pen"></i></span></a>

</div>



</div>



</div>

<!--<div class="col-md-12" style="font-size:12px;text-align:right;padding: 0px;">
<?php 
$total_rate=$bag->total_rate;
for($i=0; $i<5; $i++){
if($total_rate>$i){
//$total_rate--;
?>
<i class="fa fa-star rate_view " style="color:#fec355"></i>
<?php } else {?>
<i class="fa fa-star rate_view"></i>
<?php } }?>
<a href="#" title="حذف الدورة"  data-toggle="modal" data-target="#exampleModal" class="model_bag">
<span class="bag_edit"><i class="fa fa-trash-alt"></i></span>
</a>
<input type="hidden" value="<?= $bag->id;?>" class="delete_bag_id" >  

<a href="<?= DIR?>user/company/edit_dawrat/<?= $bag->id;?>" title="تعديل الدورة"><span class="bag_edit" style="background: #367dfe;"><i class="fa fa-pen"></i></span></a>
</div>-->
</div>

</div>
</div>

<?php  }?>
<div class="col-md-12 pagination justify-content-center" style="margin-bottom:20px;">						    
 <ul class="nav align-items-center" style="visibility: visible;margin:auto">
            <?php foreach($links as $link){?><?php echo $link;?><?php } ?>
</div>
                                            </ul>


<?php }?>

<div class="col-lg-12" style="text-align:center"> </div>
</div>





</div>
<div class="col-lg-12" style="height:0px"> </div>

</div>
</div></div>









<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="padding:0px">
      <div class="modal-header" style="text-align:center;display: block; border:0px;padding:0px">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align:right">
          <span aria-hidden="true">&times;</span>
        </button>
				<p class="main_previw" style="text-align:center">هل تريد حذف الحقيبة ؟</p>

     
      </div>
	  <div class="modal-body" style="padding:0px">

	  <div class="col-md-12">
<div class="row">
<div class="col-md-3"></div>
<input type="hidden" id="delete_bag">
<div class="col-md-3">
<button type="button" class=" searchbutton mainheader delete_dawrat" style="margin:10px 0px 10px 0px;border-radius:0.4em;background-color: #fe3642 !important;border:1px solid #fe3642;width:100%">
<span style="padding:0px"><span class="">نعم</span></span></button></div>

<div class="col-md-3">
<button type="button" data-dismiss="modal" aria-label="Close" class="searchbutton mainheader close"
 style="padding:1px;margin:10px 0px 10px 0px;border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class="">لا</span></span></button>
</div>

<div class="col-md-3"></div>
</div>
</div>




</div>
      
    </div>
  </div>
</div>
<!-------End Model----------------------->





</div>
</div>

	
