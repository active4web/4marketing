<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-80" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                    	<div class="about-nav-tab" style="text-align: center; margin: auto;margin-top:30px">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: inline-flex;margin-bottom:0px !important">
					<li class="nav-item">
					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#inside" role="tab" aria-controls="pills-inside" aria-selected="true">الرصيد الحالى
					</a></li>
					 <li class="nav-item">
					<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-outside" role="tab" aria-controls="pills-outside" aria-selected="false">شروط الاستفادة من النقاط
					</a></li>
					</ul>
					</div>

                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
			<div class="container">

            <div style="background-color: #f7f7fc;height:4px;"></div>
			<div class="about-nav-tab" style="text-align: center; margin: auto;margin-top:40px">
				
			
				<div class="tab-content" id="pills-tabContent" style="background-color:#fff;border:1px solid #ecebebde; border-radius:0.4em;">

<div class="tab-pane fade show active" id="inside" role="tabpanel" aria-labelledby="pills-inside-tab">
<div class="row">

<div class="col-lg-12" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/reward.png">
</div>
<div class="col-lg-4" style="text-align:center"> </div>
<div class="col-lg-4 main_previw" style="border:1px dashed;text-align:center">
<?php
$points=get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),"points");
if($points!=0){
?>
لديك الأن <span style="font-weight:bold;font-size:20px;color:#367dfe"><?= $points;?></span> ريال
<br>
ارباح الأن مبلغ 5% على كل دورة يتم حجزها عن طريق كود المشاركة 
<?php } else {?>
نأسف ليس لديك اى نقاط حاليا
<br>
ارباح الأن مبلغ 5% على كل دورة يتم حجزها عن طريق كود المشاركة 

<?php }?>
</div>
<div class="col-lg-4" style="text-align:center"> </div>

</div>
</div>


<div class="tab-pane fade" id="pills-outside" role="tabpanel" aria-labelledby="pills-outside-tab">
<div class="row">
<div class="col-lg-12"> 
<?php 
if(count($points_terms)>0){
?>
<div class="col-lg-12 main_previw">لتتمكن من الأستفادة من المبلغ يجب متابعة الشروط الأتية:</div>

<?php 	foreach($points_terms as $points_terms) {?>
<div class="col-md-12 main_previw" style="line-height:45px;"><span><i class=" fa fa-check iconstyle"></i></span><span><?= $points_terms->content;?></span></div>

	<?php }  }?>
</div>
</div>

</div>
<div class="col-md-12 main_previw" style="height:45px;"></div>
</div></div></div>	   

	
