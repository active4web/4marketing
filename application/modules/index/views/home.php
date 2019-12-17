

    <!-- Preloader Begin -->
    
    <?php
                
                foreach($home_page as $home_page)
                foreach($site_info as $site_info)
                ?>
    <!-- Offcanvas Begin -->
    <div class="offcanvas-overlay fixed-top w-100 h-100"></div>

    <!-- Offcanvas End -->

    <!-- Slider Begin -->
    <section class=" section-pattern bg pt-130 pb-120">
        <!-- Banner Slider Begin -->
        <div class="container">
         <div class="row">
                <div class="col-md-4 col-ms-12">
                    <!-- Section Title Begin -->
                    <div class="section-title text-center" style="background-color: #fff;padding: 10px; border: 2px solid #fff;">
                        <p class="p" style="color: #000;margin-top: 7px; font-size: 15px; text-align: center;">ابحث عن افضل الدورات والحقائب التدريبة والدبلومات</p>
                       <form method="POST" action="<?= base_url()?>search/" class="contact-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="name" class="theme-input-style" placeholder="اسم الدورة">
                                </div>
                               <div class="col-md-12">
                                   <select name="course_key" class="theme-input-style" id="course_key_search">
                                       <option value="">تبحث عن</option>
                                       <option value="1">الدورات داخلية</option>
                                        <option value="2">الحقائب تدريبية</option>
                                         <option value="3">الدبلومات</option>
                                          <option value="4">الدورات  خارجية</option>
                                   </select>
                                </div>
                                <div class="col-md-12">
                          <select name="cat_id" class="theme-input-style">
                                       <option value="">التخصص</option>
                                        <?php 
                                       if(count($category)>0){
                                           foreach($category as $catid){
                                       ?>
                                       <option value="<?=$catid->id?>"><?=$catid->name?></option>
                                     <?php  } }?>
                                   </select> 
                                   </div>
                                <div class="col-md-12" id="city_search">
                              <select name="city_id" class="theme-input-style" id="city_id_inside">
                                       <option value="">المكان</option>
                                       <?php 
                                       if(count($city)>0){
                                           foreach($city as $city){
                                       ?>
                                       <option value="<?=$city->id?>"><?=$city->name?></option>
                                <?php } }?>
                                   </select>  
                                   
                                     <select name="outside_city_id" class="theme-input-style" style="display:none" id="city_id_outside">
                                       <option value="">المكان</option>
                                       <?php 
                                       if(count($outside_city)>0){
                                           foreach($outside_city as $outside_city){
                                       ?>
                                       <option value="<?=$outside_city->id?>"><?=$outside_city->name?></option>
                                <?php } }?>
                                   </select> 
                                   
                                   </div>
                                   
                                   
                                   
                                   

                                <div class="col-12">
                                    <button type="submit" class="btn searchbutton mainheader" style="background-color:#367dfe !important;width:100%">
                                       <span> <i class="fa fa-search"></i> بحث الأن</span></button>
                                </div>
                            </div>
                            <div class="form-response"></div>
                        </form>
                    </div>
                    
                    
               
                </div>
                <div class="col-md-1 col-ms-12"></div>
                <div class="col-md-7 col-ms-12">
                  <img src="<?= DIR_DES_STYLE?>site_setting/<?=$home_page->slider_background?>" style="width:100%">
                </div>
            </div>
              
                   
             </div>
        <!-- Banner Slider End -->
    </section>
    <!-- Slider End -->

  
    <section class=" section-pattern  pt-50 pb-20" style="margin-top:-190px;">
        <!-- Banner Slider Begin -->
        <div class="container">
         
              <div class="row" >
                      <div class="col-md-4 col-ms-12">
                     <img src="<?=DIR_DES_STYLE?>site_setting/<?=$home_page->img_step1?>" style="width:100%">  
                     <p class="p" style="text-align:center;font-size:15px"><?=$home_page->content_first?></p>
                    </div>
                      <div class="col-md-4 col-ms-12" style="">
                       <img src="<?=DIR_DES_STYLE?>site_setting/<?=$home_page->img_step2?>" style="width:100%"> 
                        <p class="p" style="text-align:center;font-size:15px"><?=$home_page->content_second?></p>
                    </div>
                      <div class="col-md-4 col-ms-12">
                     <img src="<?=DIR_DES_STYLE?>site_setting/<?=$home_page->img_step3?>" style="width:100%">    
                     <p class="p" style="text-align:center;font-size:15px"><?=$home_page->content_third?></p>
                    </div>
                            <div class="col-md-12 pt-30 pb-30" style="text-align:center">
                                <a href="#" class="mainheader stepsbutton" ><span style="padding:0px 15px 0px 15px"> <i class="fa fa-search"></i> اكتشف الأن </span></a>
                                
                            </div>    
                   </div>           
                   
             </div>
        <!-- Banner Slider End -->
    </section>


    <!-- Project Begin -->
    <section class="pt-10 pb-50 section-pattern" style="background-color: #f7f7fb;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title Begin -->
                      <div class="cta-content text-center text-white">
                        <hr class="hr">
                        <h2>تعلم الأن</h2>
                        <p class="p pb-30"> احدث الدورات والحقائب التدريبية والدبلومات </p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>






        

        </div>
        <div class="container">
            
                    <div class="about-nav-tab" style="text-align: center; margin: auto;">
                        
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: inline-flex;">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#inside" role="tab" aria-controls="pills-inside" aria-selected="true">دورات داخل المملكة
                                        </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-outside" role="tab" aria-controls="pills-outside" aria-selected="false">دورات خارج المملكة
                                        </a>
                             </li>
                             <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-bags" role="tab" aria-controls="pills-bags" aria-selected="false">الحقائب التدريبة
                                        </a>
                             </li>
                             <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-deploma" role="tab" aria-controls="pills-deploma" aria-selected="false">الدبلومات
                                        </a>
                             </li>
                             
                        </ul>
        
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="inside" role="tabpanel" aria-labelledby="pills-inside-tab">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="owl-carousel owl-courses">
                                            
                 <?php
                if(count($inside_courses)>0){
                foreach($inside_courses as $inside_course){
                $Institute_name=get_table_filed('Institute',array('id_course'=>$inside_course->id),"Institute_name");
 $Institute_about=get_table_filed('Institute',array('id_course'=>$inside_course->id),"Institute_about");  
  $Institute_img=get_table_filed('Institute',array('id_course'=>$inside_course->id),"Institute_img");  
  $city_id_bage=$inside_course->city_id;
$city =get_table_filed('city',array('id'=>$city_id_bage),"name");
$country_id =get_table_filed('city',array('id'=>$city_id_bage),"country_id");
$country=get_table_filed('country',array('id'=>$country_id),"title");

                ?>
                                            <div class="item"  style="background:#fff;">
                                                <div class="maincarousel ">
                                                <a href="<?=base_url()?>courses/courses_details/<?=$inside_course->id?>">
                                                <?php 
                                                if($inside_course->img!=""){
                                                ?>
                                                <img src="<?=DIR_DES_STYLE?>products/<?=$inside_course->img?>" style="height:130px">
                                                <?php }else {?>
                                                    <img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:130px">
                                                <?php }?>
                                                <div class="col-md-12"  style="position:relative;padding-bottom:10px;background:#fff">
                                                <h3 style="font-size:13px;line-height:25px;font-weight:600;text-align:right;padding-bottom:12px;padding-top:15px;">
                                                    
                                                    <?= trunc($inside_course->name,5); ?></h3>
                                                
                                            </div>
                                            <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                     
                                            <div class="col-4" style="font-size:13px;text-align:right;line-height:30px;"><i class="icon-map-marker" style="margin-left: 12px; font-size: 20px"></i><?= trunc($city,0,2,'utf-8');?></div>
                                         
                                            <div class="col-5" style="font-size:13px;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/buliding.png" style="width:30px;height:31px;float:right"><?= trunc($Institute_name,2,'utf-8');?></div>
                                          
                                            <div class="col-3" style="font-size:16px;color:#367dfe;text-align:left;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/chair.png" style="width:30px;height:31px;float:right"><?= $inside_course->num_seats;;?></div>
                                           
                                            
                                            </div>
                                    <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                    <div class="col-6" style="font-size:12px;text-align:right;">
                                     <?php
if($inside_course->price>$inside_course->discount&&$inside_course->discount!=""&&$inside_course->discount!=0){
  $discount=$inside_course->price; 
  $price=$inside_course->discount;
}
else{
if($inside_course->discount==""||$inside_course->discount==0){$discount="";}
else {$discount=$inside_course->discount; }
$price=$inside_course->price;   
}

?>
<div><span style="color:#367dfe;font-weight:bold"><?= $price."&nbsp"."ريال";?></span>

<?php 
if($discount!=""){
?>
<strike><?= $discount.""."ريال";?></strike>
<?php }?>
</div>
                                    </div>
                                    <div class="col-6" style="font-size:15px;text-align:left;font-weight:400">
                                        <?php 
                                        $total_rate=$inside_course->total_rate;
                                        for($i=0; $i<5; $i++){
                                            if($total_rate>$i){
                                                //$total_rate--;
                                        ?>
                                        <i class="fa fa-star" style="color:#fec355"></i>
                                        <?php } else {?>
                                         <i class="icon-star-empty"></i>
                                        <?php } }?>
                                    </div>
                                            </div>
                                        </a>
                                            </div>
                                            </div>
                                            
                                            <?php  } }?>
                                            
                                        </div>
                                    </div>
                                </div>  
                                <?php
                             if(count($inside_courses)>0){
                                ?>
                                <div class="col-md-12 pt-30 pb-30" style="text-align:center">
                                <a href="<?= base_url()?>courses/dawrat" class="mainheader stepsbutton"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-search"></i> اكتشف الأن </span></a>
                            </div>
                                <?php 
                             }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="pills-outside" role="tabpanel" aria-labelledby="pills-outside-tab">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="owl-carousel owl-courses">
                                           
                                           
                                            <?php
                if(count($outside_courses)>0){
                foreach($outside_courses as $outside_course){
                $Institute_name=get_table_filed('Institute',array('id_course'=>$outside_course->id),"Institute_name");
 $Institute_about=get_table_filed('Institute',array('id_course'=>$outside_course->id),"Institute_about");  
  $Institute_img=get_table_filed('Institute',array('id_course'=>$outside_course->id),"Institute_img");  
  $city_id_bage=$outside_course->city_id;
$city =get_table_filed('city',array('id'=>$city_id_bage),"name");
$country_id =get_table_filed('city',array('id'=>$city_id_bage),"country_id");
$country=get_table_filed('country',array('id'=>$country_id),"title");

                ?>
                
                
                
                      <div class="item"  style="background:#fff;">
                                                <div class="maincarousel ">
                                                <a href="<?=base_url()?>courses/courses_details/<?=$outside_course->id?>">
                                                <?php 
                                                if($outside_course->img!=""){
                                                ?>
                                                <img src="<?=DIR_DES_STYLE?>products/<?=$outside_course->img?>" style="height:130px">
                                                <?php }else {?>
                                                    <img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:130px">
                                                <?php }?>
                                                <div class="col-md-12"  style="position:relative;padding-bottom:10px;background:#fff">
                                                <h3 style="font-size:13px;line-height:25px;font-weight:600;text-align:right;padding-bottom:12px;padding-top:15px;">
                                                    <?= trunc($outside_course->name,5);?></h3>
                                                
                                            </div>
                                            <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                     
                                            <div class="col-4" style="font-size:13px;text-align:right;line-height:30px;"><i class="icon-map-marker" style="margin-left: 12px; font-size: 20px"></i><?= trunc($city,2,'utf-8');?></div>
                                         
                                            <div class="col-5" style="font-size:13px;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/buliding.png" style="width:30px;height:31px;float:right"><?= trunc($Institute_name,2,'utf-8');?></div>
                                          
                                            <div class="col-3" style="font-size:16px;color:#367dfe;text-align:left;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/chair.png" style="width:30px;height:31px;float:right"><?= $inside_course->num_seats;;?></div>
                                           
                                            
                                            </div>
                                    <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                    <div class="col-6" style="font-size:12px;text-align:right;">
                                     <?php
if($outside_course->price>$outside_course->discount&&$outside_course->discount!=""&&$outside_course->discount!=0){
  $discount=$outside_course->price; 
  $price=$outside_course->discount;
}
else{
if($outside_course->discount==""||$outside_course->discount==0){$discount="";}
else {$discount=$outside_course->discount; }
$price=$outside_course->price;   
}

?>
<div><span style="color:#367dfe;font-weight:bold"><?= $price."&nbsp"."ريال";?></span>

<?php 
if($discount!=""){
?>
<strike><?= $discount.""."ريال";?></strike>
<?php }?>
</div>
                                    </div>
                                    <div class="col-6" style="font-size:15px;text-align:left;font-weight:400">
                                        <?php 
                                        $total_rate=$outside_course->total_rate;
                                        for($i=0; $i<5; $i++){
                                            if($total_rate>$i){
                                                //$total_rate--;
                                        ?>
                                        <i class="fa fa-star" style="color:#fec355"></i>
                                        <?php } else {?>
                                         <i class="icon-star-empty"></i>
                                        <?php } }?>
                                    </div>
                                            </div>
                                        </a>
                                            </div>
                                            </div>
                
                
                                            
                                            <?php  } }?>
                                            
                                           
                                        </div>
                                    </div>
                                </div>  
                                <?php 
                                 if(count($outside_courses)>0){
                                ?>
                                <div class="col-md-12 pt-30 pb-30" style="text-align:center">
                                <a href="<?= base_url()?>courses/dawrat" class="mainheader stepsbutton"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-search"></i> اكتشف الأن </span></a>
                            </div>
                            <?php }?>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-bags" role="tabpanel" aria-labelledby="pills-bags-tab">
                             <div class="row">
                             <div class="col-lg-12"> 
                             <div class="owl-carousel owl-courses">
<?php
if(count($bags)>0){
foreach($bags as $bag){
?>
<div class="item"  style="background:#fff;">
<div class="maincarousel ">
    <a href="<?=base_url()?>courses/bags_details/<?=$bag->id?>">
<?php 
if($bag->img!=""){
?>
<img src="<?=DIR_DES_STYLE?>products/<?=$bag->img?>" style="height:140px">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:140px">
<?php }?>
<div class="row" style="margin:0px; background:#fff;padding-top:10px;padding-bottom:10px">
<div class="col-md-12">
<h3 style="font-size:13px;line-height:25px;text-align:right;font-weight:600;padding-bottom:12px;padding-top:15px;"><?= $bag->bage_name;?></h3>

</div>

<div class="col-12" style="font-size:16px;text-align:right;padding-bottom:12px;padding-top:15px;background:#fff;">
<?php 
$total_rate=$bag->total_rate;
for($i=0; $i<5; $i++){
if($total_rate>$i){
//$total_rate--;
?>
<i class="fa fa-star" style="color:#fec355"></i>
<?php } else {?>
<i class="icon-star-empty"></i>
<?php } }?>
</div>
</div>
</a>
</div>
</div>

<?php  } }?>
                                
                                 
                                 </div> </div>
                                
                                 <?php 
                                if(count($bags)>0){
                                ?>
                                <div class="col-md-12 pt-30 pb-30" style="text-align:center">
                                <a href="<?= base_url()?>courses/bags" class="mainheader stepsbutton"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-search"></i> اكتشف الأن </span></a>
                            </div>
                            <?php }?>
                                </div>
                            
                                </div>
                            
                            <div class="tab-pane fade" id="pills-deploma" role="tabpanel" aria-labelledby="pills-deploma-tab">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="owl-carousel owl-courses">
                                                                                       
<?php
                if(count($diplomas_courses)>0){
                foreach($diplomas_courses as $diplomas){
                $Institute_name=get_table_filed('Institute',array('id_course'=>$diplomas->id),"Institute_name");
 $Institute_about=get_table_filed('Institute',array('id_course'=>$diplomas->id),"Institute_about");  
  $Institute_img=get_table_filed('Institute',array('id_course'=>$diplomas->id),"Institute_img");  
  $city_id_bage=$diplomas->city_id;
$city =get_table_filed('city',array('id'=>$city_id_bage),"name");
$country_id =get_table_filed('city',array('id'=>$city_id_bage),"country_id");
$country=get_table_filed('country',array('id'=>$country_id),"title");

                ?>
      
    <div class="item"  style="background:#fff;">
                                                <div class="maincarousel ">
                                                <a href="<?=base_url()?>courses/diplomas_details/<?=$diplomas->id?>">
                                                <?php 
                                                if($diplomas->img!=""){
                                                ?>
                                                <img src="<?=DIR_DES_STYLE?>products/<?=$diplomas->img?>" style="height:130px">
                                                <?php }else {?>
                                                    <img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:130px">
                                                <?php }?>
                                                <div class="col-md-12"  style="position:relative;padding-bottom:10px;background:#fff">
                                                <h3 style="font-size:13px;line-height:25px;font-weight:600;text-align:right;padding-bottom:12px;padding-top:15px;">
                                                    <?= trunc($diplomas->name,5);?></h3>
                                                
                                            </div>
                                            <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                     
                                            <div class="col-4" style="font-size:13px;text-align:right;line-height:30px;"><i class="icon-map-marker" style="margin-left: 12px; font-size: 20px"></i><?= trunc($city,2,'utf-8');?></div>
                                         
                                            <div class="col-5" style="font-size:13px;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/buliding.png" style="width:30px;height:31px;float:right"><?= trunc($Institute_name,2,'utf-8');?></div>
                                          
                                            <div class="col-3" style="font-size:16px;color:#367dfe;text-align:left;line-height:30px;"><img src="<?=DIR_DES_STYLE?>site_setting/chair.png" style="width:30px;height:31px;float:right"><?= $inside_course->num_seats;;?></div>
                                           
                                            
                                            </div>
                                    <div class="row" style="background:#fff;padding-bottom:12px;margin:0px">
                                    <div class="col-6" style="font-size:12px;text-align:right;">
                                     <?php
if($diplomas->price>$diplomas->discount&&$diplomas->discount!=""&&$diplomas->discount!=0){
  $discount=$diplomas->price; 
  $price=$diplomas->discount;
}
else{
if($diplomas->discount==""||$diplomas->discount==0){$discount="";}
else {$discount=$diplomas->discount; }
$price=$diplomas->price;   
}

?>
<div><span style="color:#367dfe;font-weight:bold"><?= $price."&nbsp"."ريال";?></span>

<?php 
if($discount!=""){
?>
<strike><?= $discount.""."ريال";?></strike>
<?php }?>
</div>
                                    </div>
                                    <div class="col-6" style="font-size:15px;text-align:left;font-weight:400">
                                        <?php 
                                        $total_rate=$diplomas->total_rate;
                                        for($i=0; $i<5; $i++){
                                            if($total_rate>$i){
                                                //$total_rate--;
                                        ?>
                                        <i class="fa fa-star" style="color:#fec355"></i>
                                        <?php } else {?>
                                         <i class="icon-star-empty"></i>
                                        <?php } }?>
                                    </div>
                                            </div>
                                        </a>
                                            </div>
                                            </div>
                                            
                                            <?php  } }?>
                                        </div>
                                    </div>
                                </div> 
                                <?php 
                                if(count($diplomas_courses)>0){
                                ?>
                                <div class="col-md-12 pt-30 pb-30" style="text-align:center">
                                <a href="<?= base_url()?>courses/diplomas" class="mainheader stepsbutton"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-search"></i> اكتشف الأن </span></a>
                            </div>
                            <?php }?>
                            </div>
                            
                        </div>
                        
                    </div>
        
        </div>
    </section>
    <!-- Project End -->

    
        <section class="gradient_bg_db ">
        <div class="container">
            <div class="row">
               
                <div class="col-md-5 pt-50 pb-80 col-ms-12" style="direction:rtl;text-align:right"><?=$home_page->breif_txt_ar?>
                <div class="single-info" style="text-align:center">
                                    <p class="p">
               <a href="<?=$site_info->app_android?>" target="_blank"><img src="https://dawrahapp.com/uploads/site_setting/androide.png" style="width:150px;"></a> 
                <a href="<?=$site_info->app_ios?>" target="_blank"><img src="https://dawrahapp.com/uploads/site_setting/ios.png" style="width:150px;"></a>
                                    </p>
                                </div>
                </div>
                 <div class="col-md-1 col-ms-12"></div>
                <div class="col-md-6 col-ms-12"><img src="<?=DIR_DES_STYLE?>site_setting/<?=$home_page->breif_img?>" style="width:100%"></div>
            </div>
        </div>
    </section>

    <!-- CTA Begin -->
    <section class="gradient_bg_db pt-50 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- CTA Content Begin -->
                    <div class="cta-content text-center text-white">
                        <hr class="hr">
                        <h2>التخصصات</h2>
                        <p class="p pb-30">متوفر لدينا احدث التخصصات المقدمة من افضل الشركات والمدربين المتميزين</p>
                    </div>
                    <div class="row">
                        <?php
                        if(count($category)>0){
                        foreach($category as $data){
                        ?>
                        <div class="col-md-3 col-ms-12" style="margin-bottom:40px">
                            <div class="dephome"><?=$data->name?></div>
                            
                        </div>
                        
                        <?php } }?>
                        
                        
                    </div>
                    <!-- CTA Content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- CTA End -->



  <script type="text/javascript">
    </script>

</body>
</html>