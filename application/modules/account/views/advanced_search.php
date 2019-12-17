

<style>
    .gradient-bg, .owl-carousel button.owl-dot.active, .bg-overlay:after, .bg-hover-gradient:after, .pagination li a:after, 
    .pagination li span:after, .widget.widget_tag_cloud .tagcloud a:after, .single-service.style--two:after, .pricing-navtab 
    .nav-tabs .nav-link:after, .theme-input-group input, .btn:before, .btn:after,
    .btn span:before, .btn span:after, 
    .back-to-top, -thumb.offcanvas-wrapper::-webkit-scrollbar, .coming-soon-content h1{background: none;}
    
</style>
    <!-- Preloader Begin -->
    
    <?php
                
                foreach($home_page as $home_page)
                foreach($site_info as $site_info)
                ?>
    <!-- Offcanvas Begin -->
    <div class="offcanvas-overlay fixed-top w-100 h-100"></div>

    <!-- Offcanvas End -->

      <section class=" section-pattern bg pt-130 pb-0">
        <!-- Banner Slider Begin -->
        <div class="container">
         <div class="row">
                <div class="col-md-2 col-sm-12"></div>
                <div class="col-md-8 col-sm-12">
                    <!-- Section Title Begin -->
                    <div class="section-title text-center" style="background-color: #fff;padding: 10px;border:1px solid #ecebebde; border-radius:0.4em;">
                        <p class="p" style="color: #000;margin-top: 7px; font-size: 15px; text-align: center;">ابحث عن افضل الدورات والحقائب التدريبة والدبلومات</p>
                     
                            <div class="row">
                                  <form method="POST" action="<?= base_url()?>user/search/advancedsearch" class="contact-form col-md-12">
                                <div class="col-md-12">
                                    <input type="text" name="name" class="theme-input-style" style="border-radius:0.4em;height:40px;" placeholder="اكتب ما تبحث عنه">
<button type="submit" class="btn searchbutton" style="line-height:30px;width:50px;background-color:transparent !important;text-align: center;position: absolute;top:8px;left:0px;">
<i class="fa fa-search " style="color:#777; font-size:22px"></i>
</button>
                                </div>
                                </form>
            <form method="POST" action="<?= base_url()?>user/search/advancedsearch" class="contact-form col-md-12">   
            <input type="hidden" id="inside" value="1" name="courses_key">
              <input type="hidden" id="arrange" value="1" name="arrange">
               <input type="hidden" class="dep_id" value="1" name="dep_id[]">
              
            <div class="col-md-12"><p class="p" style="color: #000;margin-bottom:10px;margin-top: 7px; font-size: 15px; text-align: right;font-weight:500;">تبحث عن</p></div>
            <div class="row" style="margin:0px 0px 23px 0px;">
            <div class="col-md-3 " style="margin-bottom:15px;cursor: pointer;"><div  class="mainheader advencedbutton_active inside" style="margin-right:0px;"><span>دورات داخل المملكة</span></div></div>
            <div class="col-md-3 " style="margin-bottom:15px;cursor: pointer;"><div class="mainheader advencedbutton outside" style="margin-right: 5px;"><span >دورات خارج المملكة</span></div></div>
            <div class="col-md-3 " style="margin-bottom:15px;cursor: pointer;"><div  class="mainheader advencedbutton Diplomas" style="margin-right: 5px;"><span >الدبلومات</span></div></div>
            <div class="col-md-3 " style="margin-bottom:15px;cursor: pointer;"><div class="mainheader advencedbutton bags" style="margin-right: 5px;"><span >الحقائب التدربية</span></div></div>
            
                               
                <div class="col-md-6 outside_country" style="margin-top:0px;margin-bottom:10px;"  >
                          <select name="country_id" class="theme-input-style country_id" id="country_id"  style="height:40px;margin-bottom:5px;" onChange="getState(this.value);">
                              <option value="">البلد</option>
                                   </select> 
                </div>
               
                                   
                        <div class="col-md-6" id="city_search" style="margin-top:0px;margin-bottom:10px;">
                              <select name="city_id" class="theme-input-style" id="state-list" style="height:40px;margin-bottom:5px;">
                              <option value="">المدينة</option>
                            </select>  
                        </div>
                                   
<div class="col-md-12"><p class="p" style="color: #000;margin-bottom:10px;margin-top: 7px; font-size: 15px; text-align: right;font-weight:500;">ترتيب حسب السعر</p></div>
                                   
                                   
               <div class="col-md-5" style="margin-bottom:15px;cursor: pointer;"><div  class="mainheader advencedbutton_active asc" style="margin-right:0px;"><span>السعر من الأقل الى الأعلى </span>
               </div></div>
               <div class="col-md-1"></div>
            <div class="col-md-5" style="margin-bottom:15px;cursor: pointer;">
            <div class="mainheader advencedbutton desc"><span>السعر من الأعلى الى الأقل  </span></div></div>

         <div class="col-md-12"><p class="p" style="color: #000;margin-bottom:10px;margin-top: 7px; font-size: 15px; text-align: right;font-weight:500;"> التصنفيات </p></div>
    
     <?php
                        if(count($cat)>0){
                            $main_count=0;
                        foreach($cat as $data){
                            $main_count++;
                        ?>
                        <div class="col-md-4 col-ms-12 " style="margin-bottom:20px;cursor: pointer;">
                            <input id='<?=$data->id?>' <?php if($main_count==1){?> checked <?php }?> type="checkbox" class="search_custom_input" value="<?=$data->id?>" name="search_custom_input">
                            <label for='<?=$data->id?>' class="search_custom_service" style="cursor: pointer;"><?=$data->name?></label>

                        </div>
                        
                        <?php } }?>
                        
                        
                                   </div>
                                   
                                   
                                   

                                <div class="col-12">
                                    <button type="submit" class="btn searchbutton mainheader col-md-4" style="background-color:#367dfe !important;">
                                       <span> <i class="fa fa-search"></i> بحث الأن</span></button>
                                       
                                         <button type="reset" class="reset btn searchbutton mainheader col-md-4" style="background-color:#fff !important;color:#367dfe !important ;">
                                       <span> <i class="fa fa-undo" style="color:#367dfe !important"> </i> إعادة المعلومات</span></button>
                                </div>
                            </div>
                            <div class="form-response"></div>
                        </form>
                    </div>
                    
                    
               
                </div>
                <div class="col-md-2 col-sm-12"></div>
               
            </div>
              
                   
             </div>
        <!-- Banner Slider End -->
    </section>
    <!-- Slider End -->

  


  



  <script type="text/javascript">
    </script>

</body>
</html>