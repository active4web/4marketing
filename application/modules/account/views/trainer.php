<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
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
			<div class="container">
<div class="row" style="height:1px;"></div>
			<div class="col-md-12">
<div class="row" style="background-color: #fff;margin:50px 0px 0px 0px">
<div class="col-lg-12 main_previw" style="text-align:center"><br></div>
<div class="col-lg-12 main_previw" style="text-align:center">

<img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img_trainer">
</div>
<div class="col-lg-12 main_previw" style="text-align:center;paddign:10px">
<?= $data_info->user_name;?>
</div>
<div class="col-lg-12 main_previw" style="text-align:center;paddign:10px">
<?= $cat_name?>
</div>

<div class="col-lg-12 main_previw" style="text-align:center;paddign:10px">
<?= $data_info->about;?>
</div>
<?php 
if(count($trainer_certifactes)==0&&count($trainer_experiences)==0){
?>
<div class="col-lg-12" style="text-align:center"> 
<p class="main_previw" style="text-align:center">اضف الأن جميع معلوماتك لتظهر للمستخدمين</p>
<div class="col-md-12 ticket" style="text-align:center">
	<a href="<?=DIR?>user/profile/myaccount" class="mainheader stepsbutton" ><span style="padding:0px 15px 0px 15px"> <i class="fa fa-user"></i> اضف معلوماتك</span></a>
	</div>

 </div>
<?php } else {?>


	<?php
             if(count($trainer_certifactes)>0){
                ?>
				<div class="col-md-12 mt-15">
				<div class="page-title text-right">
                <h2 style="font-size:17px;font-weight:500">المؤهل</h2>
                </div>
                </div>
             
			<div class="col-md-12 main_previw">
				  <ul class="courses_list">
				<?php 
				foreach($trainer_certifactes as $trainer_certif){
				?>
				<li><i class="fa fa-check" style="margin-left:10px;color:#367dfe"></i><?= $trainer_certif->certification;?></li>
				<?php }?>
				  </ul>
				</div>
				<hr style="width:100%;padding:10px">
				<?php }?>


				<?php
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


<?php }?>

<div class="col-lg-12" style="text-align:center;padding:20px"> </div>
</div>





</div>



</div></div>




<!-- Modal -->

<!-------End Model----------------------->

</div>
</div>

	
