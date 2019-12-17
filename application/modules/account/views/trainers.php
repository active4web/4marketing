<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}


</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
			<div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="page-title text-center">
					<div class="row">
                        <span class="col-md-3 user_dawrat_1"><a href="<?= base_url()?>user/" >الدورات</a> </span>
						<span class="col-md-3 user_dawrat_1"><a href="<?= base_url()?>user/courses/diplomas" >الدبلومات</a></span>
						<span class="col-md-3 user_dawrat_1"><a href="<?= base_url()?>user/courses/bags/">الحقائب</a></span>
						<span class="col-md-3 user_dawrat"><a href="<?= base_url()?>user/trainers/" style="color:#fff;">المدربين</a></span>
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
					
					<div class="col-md-8 col-lg-9" style="">
						<div class="row">
				
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
foreach($results as $bag){

   $city_id_bage=$bag->cat_id;
$category_name =get_table_filed('category',array('id'=>$city_id_bage),"name");

    
?>
<div class="col-lg-4 col-md-6  col-sm-12" style="margin-bottom:20px;">
    <a href="<?=base_url()?>user/trainers/trainer_details/<?= $bag->id;?>">

<div class="img_info img_info_circle" style="text-align:center;">

<?php 
if($bag->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>customers/<?=$bag->img?>" style="width:150px;height:150px !important;    bottom: 0px;" class="img-circle">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>customers/no_img.png" style="width:150px;height:150px !important;    bottom: 0px;" class="img-circle">
<?php }?>
</div>
<div class="col-md-12 info"  style="padding-top:75px;padding-bottom:15px;margin-top: -40px;">
    
<div class="col-md-12">
<h3 style="font-size:14px;font-weight:400;text-align:center"><?= mb_substr($bag->user_name,0,30);?></h3>
</div>


<div class="row"  style="color:#3f3f3f">

<div class="col-md-12" style="font-weight:400;font-size:15px;text-align:center;padding:5px"><?= mb_substr($category_name,0,50);?></div>


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

	
