  <!-- Main Slider Area -->
<?php
foreach($home_page as $home_page)
?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=127511844584426&autoLogAppEvents=1"></script>

  <!-- End Main Slider Area -->
  <!-- Banner block-->
  <div class="categories">
    <div class="container">
      <div class="row" style="margin:0px;">
         <div class="jtv-banner-block">
          <?php 
          foreach($cat as $cat){
          ?>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="category">
              <a href="<?=base_url()?>cat?ID=<?= base64_encode($cat->id);?>"><img src="<?= base_url()?>uploads/category/<?= $cat->icon?>"> <span><?= $cat->name?> </span> </a>
            </div>
          </div>
          <?php }?>
          <!--//Item-->
      
      
          <!--//Item-->        
        </div>
       
      </div>
    </div>
  </div>
  <!-- main container -->
  
  <!--Start Video-->
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="ads_banner">
          <img src="<?= DIR_DES_STYLE?>site_setting/<?= $home_page->img_step2?>" alt="">
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <div class="ads_banner">
          <img src="<?= DIR_DES_STYLE?>site_setting/<?= $home_page->img_step1?>" alt="">
        </div>
      </div>
    </div>
  </div>
  <!--//End Video-->
  <div class="home-tab">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <!-- Home Tabs  -->
          <div class="tab-info">
            <h3 class="new-product-title pull-left">الإعلانات المضافة حديثاً</h3>
          </div>
          </div>

          <div  class="col-md-12 col-sm-12 col-xs-12">
          <div id="productTabContent" class="tab-content">
            <div class="tab-pane active in" id="all">
            <style>
.product-item .item-inner .pro-box-info .box-hover .add-to-links .action.add-to-wishlist:before {
color:#333 ;
}
</style>
              <?php 
              foreach($products as $data){
                $maincount=0;
                if($data->img!=""){
                    $image=DIR_DES_STYLE."products/".$data->img;
                    }
                    else {
                    $image=DIR_DES_STYLE."products/no_img.png";
                    }

                    $category_id=$data->cat_id;
$category_name=get_table_filed('category',array('id'=>$category_id),"name");
$favourite_key=0;
if($this->session->userdata("device_id")!=""){
  $customer_id=get_customer_id_forent($this->session->userdata("device_id")); 
  $id_fav =get_table_filed('favourites',array('user_id'=>$customer_id,'course_id'=>$data->id),"id");
 
  if($id_fav!=""){
    $favourite_key=1;
  }
  else{
    $favourite_key=0;	
  }
$where="user_archive_reciver='1'and user_archive_sender='1' and id_products=$data->id AND (server_id=$customer_id OR send_id=$customer_id)";
$maincount=get_message_total("messages",$where);
$where1="id_reply=0 and user_archive_reciver='1'and user_archive_sender='1' and id_products=$data->id AND (server_id=$customer_id OR send_id=$customer_id)";
$idm=get_message_id('messages',$where1,"id");
}
$city_name=get_table_filed('city',array('id'=>$data->city_id),"name");
$currency_name=get_table_filed('currency',array('id'=>$data->currency_id),"name");

?>

              <!--//Item-->
              <div class="product-item col-md-4 col-sm-6">
                <div class="item-inner">
                  <div class="product-thumbnail">
                 
                    <a href="<?=base_url()?>advertising/details?ID=<?= base64_encode($data->id);?>" class="product-item-photo"> 
                        <img class="product-image-photo" src="<?= $image?>" alt=""> </a>
                  </div>
                  <div class="pro-box-info">
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title">
                          <h4> <a title="<?=mb_substr( $data->name,0,120)?>" alt="اعلانات مجانية"  href="<?=base_url()?>advertising/details?ID=<?= base64_encode($data->id);?>"> 
                             <?=mb_substr( $data->name,0,120)?>  </a></h4> </div>
                        <div class="item-content">
                          <div class="row">
                          <div class="cat col-md-12"> <span style="float:right">
                          <a href="<?=base_url()?>city?ID=city_id"> <?=mb_substr( $city_name,0,50);?></a></span>
                          <span  style="float:left"><a href="<?=base_url()?>cat/grid?ID=<?= base64_encode($category_id);?>"><?=mb_substr( $category_name,0,50)?></a></span>
                        </div>
                          <div class="timing col-md-12">
                             <span class="date"  style="float:right"><span class="time">
                             <?= date("d",strtotime($data->creation_date))?>  
                                <?= $data->date_title?></span> </span>
                                <span  style="float:left; font-size: 14px;color: #12224a;font-weight: 600;">
                                 <?= $data->views?><i class="fa fa-eye" style="font-size: 14px;padding-right: 7px;color: #12224a;font-weight: bold;"></i></span>
                                </div>
                                </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-hover">
                      <div class="product-item-actions">
                        <div class="pro-actions"> <span class="pricing"><?= $data->price?> <?= $currency_name;?></span></div>
                        <div class="add-to-links" data-role="add-to-links">

<div  class="add-to-fav advertising-action"  style="color:#<?php if($favourite_key){?>e80f55;<?php }?>" title="اضف الى المفضلة" > 
<i class="fa fa-heart  myfav"></i>
</div>

<input type="hidden" class="advertising_ID" value="<?= $data->id;?>">
<?php if($maincount>0){?>
         <a  href="<?= base_url()?>messages/message/<?= $idm;?>" class="advertising-action messages fa fa-envelope"  title="الدردشة">
<?php echo $maincount;} else {?>
  <a  href="<?= base_url()?>messages/send_message/<?= base64_encode($data->id);?>" class="advertising-action messages fa fa-envelope"  title="الدردشة">

<?php }?>

                       </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php }?>
              <!--//Item-->
           
              <!--//Item-->
            
              <!--//Item-->
             
              <!--//Item-->
           
              <!--//Item-->
            
              <!--//Item-->
          
              <!--//Item-->
            </div>
           
        
          </div>
          </div>

        </div>

        <!-- Best selling -->
    
        <!-- Offer banner -->
  
      </div>
    </div>
  </div>
  <div class="container">
    <!-- service section -->
    <div class="jtv-service-area">
      <div class="row">
        <div class="col col-md-9 col-sm-9 col-xs-12 no-padding">
          <div class="block-wrapper ship">
            <div class="text-des"> <i class="icon-rocket"></i>
              <p>
             <?php foreach($site_info as $site_info)
             echo $site_info->intro_home;
             ?>
              </p>
            </div>
          </div>
        </div>
       
        <div class="col col-md-3 col-sm-3 col-xs-12 no-padding">
          <div class="block-wrapper support">
            <div class="text-des" > 
              <h3 style="float:left">تواصل معانا <br><i class="fa fa-headphones"></i></h3>
              <p><div class="fb-like" data-href="https://www.facebook.com/Web4Active/" data-width="" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>