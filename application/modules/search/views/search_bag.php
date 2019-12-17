<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}

.fixed-top {
    box-shadow: none;
    position: fixed;}
</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-90 pb-30" style="border-bottom: 1px solid #e2e2e2;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        <h2>الحقائب</h2>
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li>الحقائب</li>
                        </ul>
                    </div>
                </div>
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
						    <div class="col-md-12" style="margin-bottom: 15px;border-bottom: 2px solid #fcfcfe;padding-bottom: 10px;">
	 <a>
       <div  class="display_courses">
			<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="th" role="img" xmlns="http://www.w3.org/2000/svg" 
			viewBox="0 0 512 512" class="svg-inline--fa fa-th fa-w-16 fa-lg"><path fill="currentColor" 
			d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM197.3 72h117.3v96H197.3zm0 136h117.3v96H197.3zm-40 232H52c-6.6 0-12-5.4-12-12v-84h117.3zm0-136H40v-96h117.3zm0-136H40V84c0-6.6 5.4-12 12-12h105.3zm157.4 272H197.3v-96h117.3v96zm157.3 0H354.7v-96H472zm0-136H354.7v-96H472zm0-136H354.7V72H472z" class=""  ></path></svg>
						</div>
						    </a>
						    
<a href="<?=base_url()?>courses/bags_list">
<div  class=" display_courses_notactive">
<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="th-list" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-th-list fa-w-16 fa-lg"><path fill="currentColor" d="M0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48H48C21.49 32 0 53.49 0 80zm472 224H197.333v-96H472v96zm0 40v84c0 6.627-5.373 12-12 12H197.333v-96H472zM40 208h117.333v96H40v-96zm157.333-40V72H460c6.627 0 12 5.373 12 12v84H197.333zm-40-96v96H40V84c0-6.627 5.373-12 12-12h105.333zM40 344h117.333v96H52c-6.627 0-12-5.373-12-12v-84z" class=""></path></svg>
</div></a>

						    
						    </div>
						    <?php
						    if(count($sql_product)==0){
						    ?>
						    <div class="col-md-12">
					<div class="page-title text-center" >
                        <h2 style="font-size:16px;padding-top:20px">لا يوجد اى محتوى حاليا</h2>
                        </div>
                        </div>
						    <?php } else {?>

<?php
foreach($sql_product as $bag){
?>
<div class="col-md-6 col-lg-4 col-sm-12" style="margin-bottom:20px;">
    <a href="<?=base_url()?>courses/bags_details/<?= $bag->id;?>">

<div class="img_info">

<?php 
if($bag->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>products/thumbnail_150/<?=$bag->img?>" style="width:100%;    border-top-left-radius: 0.4em;border-top-right-radius: 0.4em;" class="img_bags">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="width:100%;    border-top-left-radius: 0.4em;border-top-right-radius: 0.4em;" class="img_bags">
<?php }?>
</div>
<div class="col-md-12 info">
    
<div class="row" style="margin:0px; background:#fff;padding-top:10px;padding-bottom:6px">
<div class="col-md-12">
<h3 style="font-size:16px;text-align:right;font-weight:600;padding-bottom:12px;padding-top:15px;"><?= $bag->bage_name;?></h3>

</div>

<div class="col-12" style="font-size:13px;text-align:right;padding-bottom:6px;padding-top:15px;background:#fff;">
<?php 
$total_rate=$bag->total_rate;
for($i=0; $i<5; $i++){
if($total_rate>$i){
//$total_rate--;
?>
<i class="fa fa-star" style="color:#fec355;font-size:12px"></i>
<?php } else {?>
<i class="icon-star-empty" style="color:#3f3f3f"></i>
<?php } }?>
</div>
</div>
</div>

</a>
</div>

<?php  }?>
<div class="col-md-12 pagination justify-content-center" style="margin-bottom:20px;">						    
					    
						    <?php }?>
						    
						</div>
					</div>

			</div>
		</div>
		

		</div>

	
