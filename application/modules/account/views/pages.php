<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
		$tit="";
		$content="";
	foreach($site_info as $siteinfo)
	if(count($pages)>0){
	foreach($pages as $pages){
		$tit=$pages->title;
		$content=$pages->content;
	}
	}
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
						<?php 
						if($tit!=""){
						?>
						<h2><?= $tit?></h2>
						<?php } else {?>
							<h2>الصفحة الفرعية</h2>
						<?php }?>
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
							<?php 
						if($tit!=""){
						?>
						<li><?= $tit?></li>
						<?php } else {?>
							<li>الصفحة الفرعية</li>
						<?php }?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
			<div class="container">


<div class="row" style="    background-color: #fff;">
<div class="col-lg-8 main_previw" >
<?php 
						if($content!=""){
						?>
<?= $content?>
						<?php } else {?>
لأيوجد محتوى حاليا
						<?php }?>

</div>

<div class="col-lg-4" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/pages.png">
</div>
</div>

</div></div>


	
