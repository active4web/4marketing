<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
	foreach($pages as $pages)
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        <h2>شروط التسجيل</h2>
                        <ul class="list-inline">
                            <li><a href="<?=DIR ?>index">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li>شروط التسجيل</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
		<div class="wrapper">
			<div class="container">
            <div class="row" style="height:20px"></div>
<div class="row  pt-50 " style="margin-top:30px;background-color:#fff;">
<div class="col-md-7">
<div class="col-md-12 ">

<div class="page-title text-center" >
<h2 style="font-size:17px;font-weight:bold;text-align:right"><?=$pages->title;?></h2>
</div>
<p class="main_previw" style="text-align:right"><?=$pages->content;?></p>
</div>

</div>
<div class="col-md-5 pt-120">
<img src="<?= DIR_DES_STYLE ?>site_setting/terms.png">

</div>

 </div>
<div class="row  pt-50 " style="height:20px"></div>
</div>

	
