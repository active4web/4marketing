<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
		foreach($results as $data)
		$cat_id=$data->cat_id;
		$cat_name =get_table_filed('category',array('id'=>$cat_id),"name");
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row" style="margin:0px"> 
			<div class="col-md-12 col-lg-1"></div>
			 <div class="col-md-5 col-lg-5">
                    <div class="page-title " style="text-align:right">
                        <ul class="list-inline">
							<li style="font-size:18px;font-weight:bold"><?= $data->user_name;?></li>
                        </ul>
                    </div>
				</div>
				
                <div class="col-md-7 col-lg-5">
                    <div class="page-title attr_title">
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
							<li><a href="<?=DIR ?>user/trainers">المدربين</a></li>
							<li><i class="fa fa-chevron-left"></i></li>
							<li><?= $data->user_name;?></li>

                        </ul>
                    </div>
				</div>
				<div class="col-md-12 col-lg-1"></div>
            </div>
        </div>
	</section>



		<div class="wrapper">
			<div class="container">
				<div class="row  pt-50 ">
<div class="col-md-5 col-lg-3" style="margin-bottom:30px;padding:10px;margin-top:60px">
<div class="row">
 <div class="col-md-12" style="margin-bottom:20px;">

<div class="img_info img_info_circle" style="background-color:#fff;text-align:center;border:1px solid #8181812b;border-radius:0.4em">

<?php 
if($data->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>customers/<?=$data->img?>" style="width:150px;height:150px !important;" class="img-circle img-circle_details">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>customers/no_img.png" style="width:150px;height:150px !important" class="img-circle img-circle_details">
<?php }?>
<h2 style="margin-top:-80px;padding-bottom:10px;text-align:center;line-height:30px;"><?= $data->user_name;?></h2>
<h4 style="font-weight:400;padding-bottom:10px;text-align:center;color:#818181;line-height:30px;" class="main_previw"><?= $cat_name;?></h4>
</div>

</div>   

</div>
</div>

<div class="col-md-7 col-lg-9" style="background-color:#fff;border-radius: 0.4em;border:1px solid #8181812b;border-radius:0.4em;margin-top: 70px;">
					<div class="row">
					    	<div class="col-md-12 ">
					    	    <div class="page-title text-right">
                        <h2 style="font-size:17px;font-weight:500">نبذة عن المدرب</h2>
                       
                    </div>
			</div>
				<div class="col-md-12 main_previw">
				    <?= $data->about; ?>
				</div>
				   <?php
             $trainer_certifactes=get_table_data("trainer_certifactes",array('user_id'=>$data->id));
             if(count($trainer_certifactes)>0){
                ?>
				<div class="col-md-12 mt-15">
				<div class="page-title text-right">
                <h2 style="font-size:17px;font-weight:500">المؤهل</h2>
                </div>
                </div>
                <hr style="width:100%">
             
			<div class="col-md-12 main_previw">
				  <ul class="courses_list">
				<?php 
				foreach($trainer_certifactes as $trainer_certif){
				?>
				<li><?= $trainer_certif->certification;?></li>
				<?php }?>
				  </ul>
				</div>
				<?php }?>
				 <hr style="width:100%">
				
				   <?php
             $trainer_experiences=get_table_data("trainer_experiences",array('user_id'=>$data->id),'','id','desc');
             if(count($trainer_experiences)>0){
                ?>
				<div class="col-md-12 mt-15">
				<div class="page-title text-right">
                <h2 style="font-size:17px;font-weight:500">الخبرات</h2>
                </div>
                </div>
             
			<div class="col-md-12 main_previw">
				  <ul class="courses_list">
				<?php 
				$main_count=0;
				foreach($trainer_experiences as $experience){
				    $main_count++;
				?>
				<li>
				    <ul class="courses_list list_experiences" >
				    <li class="courses_list_data"><?= $experience->experiences;?>&nbsp;-&nbsp;<?= $experience->company_name;?></li>
				    <li style="padding-right:20px"><?= $experience->start_moth;?>&nbsp;<?= $experience->start_date;?>
				    <?php if($experience->end_date!=""){?>
				    &nbsp;-&nbsp;
				    <?= $experience->end_month;?>&nbsp &nbsp<?= $experience->end_date;?>
				    <?php } else {?>&nbsp;-&nbsp; الأن <?php }?>
				    </li>
				    <?php if($main_count<count($trainer_experiences)){?>
				    <img src="<?= DIR_DES_STYLE?>site_setting/style.png" class="list_experiences_img"> 
				    <?php } else {?>
				    <img src="<?= DIR_DES_STYLE?>site_setting/end.png" class="list_experiences_img"> 
				    <?php }?>
				</ul>
				</li>
				<?php }?>
				  </ul>
				</div>
				<?php }?>
				
				
				</div>
		</div>

			</div>
		</div>
		

		</div>

	
