<?php 
	foreach($site_info as $siteinfo)
	?>
<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?= lang("download_file");?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							  <li><a href="<?= DIR?>site/"><?= lang("home_page");?></a></li>
							  <li class="active"><a href="#"><?= lang("download_file");?></a></li>
							</ol>	
						</div>
					</div>
				</div>		
				<div class="clearfix"></div>
			</div>
		</div>
			<div class="trin three hidden-xs hidden-sm">
			</div>			
			</div>
        </div>
        
        <div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="systems">
                    <?php if($result_amount>0){
						foreach($results as $prod) {
						?>
					<div class="col-md-3 col-sm-4 col-xs-6" style="text-align:center">
					<?php
					if($prod->file_pdf!=""&&$prod->file_pdf!="#"){
					?>
					<a href="<?=DIR?>uploads/files/<?=$prod->file_pdf;?>" target="_blank">
					<?php } else {?>
					<a>
					<?php }?>
					<div class="system2" >
<div class="row">
<div class="col-md-12" style="text-align:center;with:100%">
<i class="fas fa-download fa-4x" style="color:#666" title="<?php 
if($lang == 'arabic'){	echo $prod->title_ar;}
else {echo $prod->title_eng;}
?>"></i>
</div>
<div class="col-md-12" style="text-align:center;with:100%">
<h5>
<?php 
if($lang == 'arabic'){
    if(strlen($prod->title_ar)>120){	echo mb_substr($prod->title_ar,0,120)."...";}
    else {echo mb_substr($prod->title_ar,0,120);}
}
else {
if(strlen($prod->title_eng)>120){	echo mb_substr($prod->title_eng,0,120)."...";}
    else {echo mb_substr($prod->title_eng,0,120);}    
}
?>
</h5>
</div></div>			
	</div></a>
                    </div>
                    <?php }?>
						<?php } else {?>
							<div class="col-md-12"><?= lang("no_data");?></div>
						<?php }?>
                
                    </div>
                    <div class="col-md-12" style="text-align:center;min-height:140px"><?php foreach($links as $link){?><?php echo $link;?><?php } ?></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>