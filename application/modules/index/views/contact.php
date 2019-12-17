<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-130 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>تواصل معانا</h2>
                        <ul class="list-inline">
                            <li><a href="index.html">الرئيسية</a></li>
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li>تواصل معانا</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
		<div class="wrapper">
			<div class="container">
				<div class="row  pt-50 ">
				
				
					<div class="col-md-6 " style="background:#367dfe;margin-left:-10px;z-index:999;margin-bottom:30px;">
<div  style="background-color:#367dfe;direction: rtl;text-align: right;font-size: 12px;color: #fff;line-height: 35px;">
    <div><br></div>

					<div><i class="fa fa-phone phone fa-lg info_contant"></i><?= $siteinfo->phone?></div>
					<div><i class="fas fa-envelope fa-lg info_contant"></i><?= $siteinfo->email?></div>
						
						</div>
							
							 <form method="post" action="<?= DIR?>index/Contact/contact_action" class="contact-form">
							 
						<div class="row">
							 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input class="theme-input-style input" type="text" placeholder="الاسم" name="name" required>
								 </div>
								 	 <div class="col-md-6 col-sm-6 col-xs-12">
								 <input class="theme-input-style input" type="text" placeholder="رقم الجوال" name="phone" required>
							 </div>
							
							 <div class="col-md-12">
								<textarea class="theme-input-style " placeholder="الرسالة" name="message"requied style="height:100px ;margin-bottom:0px"></textarea>
							 </div>
							 <div class="col-md-12" style="text-align:center;margin-bottom:-20px">
							 <button type="submit" class="btn loginbuuton mainheader" style=";width:200px">
                                       <span> <i class="fab fa-telegram-plane"></i> ارسال</span></button>
							 </div>
							 </div>
						 </form>
					</div>
					
					<div class="col-md-6" style="margin-right:-10px">
						
						<?php echo $siteinfo->map?>
					</div>

			</div>
		</div>
		

		</div>

	
