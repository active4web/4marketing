<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
	?>


<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5cfe6b7d4351e90012650022&product=" inline-share-buttons async="async"></script>

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
            <div style="    background-color: #f7f7fc;height:50px;"></div>


<div class="row" style="background-color: #fff;border:1px solid #ecebebde; border-radius:0.4em;">
<div class="col-lg-4 main_previw" ></div>
<div class="col-lg-4" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/share.png">

<p style="main_previw">
قم بمشاركة كود الدعوة الخاص بك لمستخدمين جدد لتربح رصيد (مكفائتى) مبلغ 5% يمكن الاستفادة به
</p>
<p style="border:1px dashed;text-align:center" style="main_previw">
<?= get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),'invitation_code');
?>
</p>
<p class="main_previw" style="color:#367dff;text-align:center">
قم بمشاركة الكود من خلال
</p>
<p>

<div id="socialSharing">
    <a href="http://www.facebook.com/sharer.php?u=http://localhost/mywork/maahed/user/profile/share">
        <span id="facebook" class="fa-stack fa-lg">
            <i class="fab fa-facebook-f fa-stack-1x"></i>
        </span>
    </a>
    <a href="http://twitter.com/share?text=twitter&url=http://localhost/mywork/maahed/user/profile/share&hashtags=#كود">
        <span id="twitter" class="fa-stack fa-lg">
            <i class="fab fa-twitter fa-stack-1x"></i>
        </span>
    </a>
    <a href="http://instagram.com/pin/create/button/?url=[URL_FULL]&description=[TITLE]" class="pin-it-button" count-layout="horizontal">
        <span id="pinterest" class="fa-stack fa-lg">
            <i class="fab fa-pinterest-p fa-stack-1x"></i>
        </span>
    </a>
    <a href="https://plus.google.com/share?url=[URL_FULL]">
        <span id="googleplus" class="fa-stack fa-lg">
            <i class="fab fa-google-plus fa-stack-1x"></i>
        </span>
    </a>

    <a href="whatsapp://send?&text=[TITLE] [URL_FULL]" data-action="share/whatsapp/share">
        <span id="whatsapp" class="fa-stack fa-lg">
            <i class="fab fa-whatsapp fa-stack-1x"></i>
        </span>
    </a>
</div>


</p>
</div>

<div class="col-lg-4 main_previw" ></div>
</div>

</div></div>


	
