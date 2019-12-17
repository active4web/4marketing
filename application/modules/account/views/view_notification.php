<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        <h2>النتفوكيشن</h2>
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li>النتفوكيشن</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
			<div class="container">

<?php
if(count($notifications)==0){
?>
<div class="row" style="    background-color: #fff;">
<div class="col-lg-4" style="text-align:center"> </div>

<div class="col-lg-4" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/notification.png">

<div class="col-md-12 ticket" style="text-align:center;font-size:20px">
لأ يوجد محتوى الان	</div>

 </div>

 </div>
<div class="col-lg-4" style="text-align:center"> </div>
</div>


<?php } else {
	

	foreach($notifications as $main_nofiy){
		if($main_nofiy->course_key==2&&$main_nofiy->course_id!=""&&$main_nofiy->course_key!=""){
		$course_name=get_table_filed('bag_info',array('id'=>(int)$main_nofiy->course_id),"bage_name");
		$img =get_table_filed('bag_info',array('id'=>(int)$main_nofiy->course_id),"img");
		if($img!=""){
		$image=base_url()."uploads/products/".$img;
		}
		else {
		$image=base_url()."uploads/products/no_img.png";
		}  
		}
		else if($main_nofiy->course_key!=2&&$main_nofiy->course_id!=""&&$main_nofiy->course_key!=""){
		$course_name =get_table_filed('products',array('id'=>(int)$main_nofiy->course_id),"name"); 
		$img =get_table_filed('products',array('id'=>(int)$main_nofiy->course_id),"img");
		if($img!=""){
		$image=base_url()."uploads/products/".$img;
		}
		else {
		$image=base_url()."uploads/products/no_img.png";
		}  	
		}
		if($main_nofiy->type!=1) {
			$image=base_url()."uploads/site_setting/nofication.png";
		}
	?>
<div class="row" style="margin:0px">
<div class="col-2 main_previw"><img src="<?=$image?>" style="width:60px; height:50px;"></div>
<div class="col-10 main_previw">
<div class="row" style="margin:0px">
<div class="col-8 main_previw"><?= $main_nofiy->title?></div>
	<div class="col-4 main_previw"><?= $main_nofiy->creation_date?></div>
	<div class="col-12 main_previw"><?= $main_nofiy->description?></div>
</div>
</div>
	<div class="col-12"><hr style="width:100%"></div>
</div>
	<?php }?>
	



<?php }?>



      
</div>
<!-------End Model----------------------->

</div>
</div>

	
