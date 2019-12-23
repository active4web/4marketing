<div style="    background-color: #f7f7fc;height: 50px;"></div>
<footer>
<?php foreach($site_info as $siteinfo)?>
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
          <div class="footer-content">
            <div class="email"> <i class="fa fa-envelope"></i>
              <p><?= $siteinfo->email;?></p>
            </div>
            <div class="phone"> <i class="fa fa-phone"></i>
              <p><?= $siteinfo->phone;?></p>
            </div>

            <div class="address"> <i class="fa fa-map-marker"></i>
              <p><?= $siteinfo->address;?></p>
            </div>
            <div class="social">
              <ul class="inline-mode">
                <li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="<?= $siteinfo->facebook;?>"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="<?= $siteinfo->google_pluse;?>"><i class="fa fa-google-plus"></i></a>
                </li>
                <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="<?= $siteinfo->twitter;?>"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="<?= $siteinfo->instagram;?>"><i class="fa fa-instagram"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-xs-12 col-lg-4 collapsed-block">
          <div class="footer-links">
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
              <?php
              foreach($cat as $cat){
              ?>
                <li><a href="<?=base_url()?>cat?ID=<?= base64_encode($cat->id);?>"> <?= $cat->name?> </a>
                </li>
              <?php }?>
                
              </ul>
            </div>
          </div>
        </div>
        
<div class="col-sm-12 col-md-2 col-xs-12 col-lg-2">
 
  <div class="footer-links">
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
              <?php
              foreach($pages as $pages){
              ?>
                <li class="link_important"><a href="<?= base_url()?>pages/<?= $pages->id?>" ><?= $pages->title?></a>
                </li>
              <?php }?>                
              </ul>
            </div>
          </div>   
    
</div>        
        
        
        <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
             <div class="footer-logo">
            <a href="<?= base_url()?>"><img src="<?= DIR_DES_STYLE?>site_setting/<?= $siteinfo->logo;?>" alt="footer logo">
            </a>
            <div class="icon_app"  style="margin-top:20px">
               <a href="<?= $siteinfo->app_android;?>"> <img src="<?= DIR_DES_STYLE?>site_setting/android_store.png" alt=""></a>            
               <a href="<?= $siteinfo->app_ios;?>"><img src="<?= DIR_DES_STYLE?>site_setting/apple_store.png" alt=""></a>            
           </div>
          </div>
         
        </div>
      </div>
    </div>
   
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12 coppyright"> &copy; جميع الحقوق محفوظة <a href="#"> فورماركتنج </a>| 2019 </div>
          <div class="col-sm-6 col-xs-12">
            <div class="powered">
              <p>تصميم و برمجة شركة <a href="http://active4web.com/"> اكتف فور ويب </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="#" class="totop"> </a> 
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script type="text/javascript" src="<?= DIR_DES?>js/jquery.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.meanmenu.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery-ui.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/countdown.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/wow.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/main.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.nivo.slider.js"></script> 
<!-- flexslider js --> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.flexslider.js"></script>
<script src="<?= DIR ?>assets/toastr/toastr.min.js"></script>

<link href="<?= DIR ?>assets/toastr/toastr.min.css" rel="stylesheet">


  <?php 
  include("js.php");
  ?>