<link rel="stylesheet" href="<?= base_url();?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?= base_url();?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>

 <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
            <?php 
$id_cat=get_table_filed('products',array('id'=>base64_decode($this->input->get("ID"))),"cat_id");
$name_cat=get_table_filed('category',array('id'=>$id_cat),"name");

$dep_id=get_table_filed('products',array('id'=>base64_decode($this->input->get("ID"))),"dep_id");
$name_dep=get_table_filed('department',array('id'=>$dep_id),"name");
?>

<li class="home"> <a title="<?=$name_cat?>" href="<?= base_url()?>cat/grid?ID=<?= base64_encode($id_cat);?>"><?=$name_cat?>
</a><span>&raquo;</span></li>

<?php if($dep_id!=""){?>
<li class="home"> <a title="<?=$name_dep?>" href="<?= base_url()?>cat/subcategory?ID=<?= base64_encode($dep_id);?>"><?=$name_dep?>
</a><span>&raquo;</span></li>
<?php }?>

<li><strong><a title="كل الأعلانات" href="<?= base_url()?>cat/all">كل الأعلانات</a> </strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<?php
foreach($results as $pro)
$category_id=$pro->cat_id;
$category_name=get_table_filed('category',array('id'=>$category_id),"name");
$dep_id=$pro->dep_id;
$dep_name=get_table_filed('department',array('id'=>$dep_id),"name");
$maincount=0;
$favourite_key=0;
if($this->session->userdata("device_id")!=""){
  $customer_id=get_customer_id_forent($this->session->userdata("device_id")); 
  $id_fav =get_table_filed('favourites',array('user_id'=>$customer_id,'course_id'=>$pro->id),"id");
 
  if($id_fav!=""){
    $favourite_key=1;
  }
  else{
    $favourite_key=0;	
  }
  $where="user_archive_reciver='1'and user_archive_sender='1' and id_products=$pro->id AND (server_id=$customer_id OR send_id=$customer_id)";
  $maincount=get_message_total("messages",$where);
  $where1="id_reply=0 and user_archive_reciver='1'and user_archive_sender='1' and id_products=$pro->id AND (server_id=$customer_id OR send_id=$customer_id)";
  $idm=get_message_id('messages',$where1,"id");
  }
  
$special=$pro->special;
$currency=get_name('currency',$pro->currency_id);
$city=get_name('city',$pro->city_id);
?>




  <div class="main-container col2-left-layout">
    <div class="container">
<div class="row">

<div class="col-main col-sm-1"></div>
<div class="col-main col-sm-12  category-filter">
          <div class="product-view-area">


  <div class="col-md-6 product-details-area" >
              <div class="product-name">
                <h1><?= $pro->name?></h1>
              </div>
<div class="row details_row">
<div class="col-md-4"> <span class="price-label">السعر</span></div>
<div class="col-md-8">  <span class="price"> <?= $pro->price?><?= $currency;?></span></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4"> <span class="price-label">القسم الرئسى</span></div>
<div class="col-md-8">  <span class="price"><a href="<?=base_url()?>cat/lisiting?ID=<?= base64_encode($category_id);?>"> <?= $category_name;?></a></span></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4"> <span class="price-label">القسم الفرعى</span></div>
<div class="col-md-8">  <span class="price"> <a href="<?=base_url()?>cat/subcategory?ID=<?= base64_encode($dep_id);?>"><?= $dep_name;?></span></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4"> <span class="price-label">البلد</span></div>
<div class="col-md-8">  <span class="price"> <a href="<?=base_url()?>cat/city?ID=<?= $pro->city_id?>"><?= $city?></a></span></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4"> <span class="price-label">البريد الألكترونى</span></div>
<div class="col-md-8">  <span class="price"><a href="mailto:<?= $pro->user_email?>"><?= $pro->user_email?></a> </span></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4 phone_hide"> <span class="price-label">التليفون</span></div>
<div class="col-md-8 phone_hide">  <span class="price"> <a href="tel:<?= $pro->user_phone?>" class="Blondie"><?= $pro->user_phone?></a></span></div>

</div>
              <div class="price-box">
             
              </div>
<div class="product-cart-option">
                <ul>
                  <li>
<a class="add-to-fav" style="cursor: pointer;border: 0px;width:170px;"><i class="fa fa-heart add-to-fav bb"  style="color:#<?php if($favourite_key){?>e80f55;<?php }?>"></i>
<?php if($favourite_key==0){?><span class="fav_txt">اضف الى المفضلة</span><?php } else {?>احذف من المفضلة<?php }?></a>
<input type="hidden" class="advertising_ID" value="<?= $pro->id;?>">
</li>

                  <li class="show_hone"><a><i class="fa fa-retweet"></i><span>اظهر رقم التليفون</span></a></li>
                  <li class="phone_hide"><a><i class="fa fa-retweet"></i><span>اخفاء رقم التليفون</span></a></li>
    <li><?php if($maincount>0){?>
<a  href="<?= base_url()?>messages/message/<?= $idm;?>" title="الدردشة">
<?php echo $maincount;} else {?>
<a  href="<?= base_url()?>messages/send_message/<?= base64_encode($pro->id);?>"  title="الدردشة">
<?php }?>
 <i class="fa fa-envelope"></i><span>الدردشة</span>
</a>

  </li>
                </ul>
              </div>
            </div>


            <div class="col-md-6" style="text-align:center ">
  <!-- Main Slider -->
  <div class="product-name" >
                <h3><br><br><br></h3>
              </div>
<?php if(count($images)>0){?>
  <div class="main-slider">
            <div class="slider">
              <div id="mainSlider" class="nivoSlider slider-image">
                <?php
                
                  foreach($images as $imgdata){
                ?>
<a title="مشاهدة الصور" class="example-image-link" href="<?= DIR_DES_STYLE?>/products/<?= $imgdata->image;?>" data-lightbox="example-1">
<img src="<?= DIR_DES_STYLE ?>/products/<?= $imgdata->image?>" alt="اعلانات مجانية" title="<?= $pro->name?>" style="width:100%;height:400px" />
                </a>  
                <?php } ?>
              </div>
            </div>
          </div>
                  <?php } else {?>
                    <img src="<?= DIR_DES_STYLE ?>/products/no_img.png" alt="اعلانات مجانية" title="<?= $pro->name?>" />
                  <?php }?>
          <!-- End Main Slider -->
        </div>
     
  <!-- End Main Slider Area -->

  <div class="col-md-12"><br></div>  
</div>
 <div class="col-md-12"></div>         
          <div class="product-overview-tab col-md-12">
            <div class="product-tab-inner">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#description" data-toggle="tab"> الوصف </a> </li>
             
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <div class="std">
                    <p><?= $pro->details;?></p>
                  </div>
                </div>

     
      
              </div>
            </div>
          </div>
        </div>

        <div class="col-main col-sm-1"></div>





        </div>
      </div>
    </div>


  
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="related-product-area">
          <div class="title_block">
            <h3 class="products_title">اعلانات ذات صلة</h3>
          </div>
          <div class="related-products-pro">
            <div class="slider-items-products">
              <div id="related-product-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4">
<?php 
if(count($related_products)>0){
foreach($related_products as $data){
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
  
$special=$data->special;
$currency=get_name('currency',$data->currency_id);
$city=get_name('city',$data->city_id);

?>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                      <?php if($special==1){?>
                        <div class="icon-sale-label sale-left special-advertising">اعلان مميز</div>
                      <?php }?>
                       
                        <a href="<?=base_url()?>advertising/details?ID=<?= base64_encode($data->id);?>" class="product-item-photo" title="<?= $data->name?>"> 
                        <img class="product-image-photo" src="<?= $image?>" alt="اعلانات مجانية"></a> </div>
                      <div class="pro-box-info">
                 
                        <div class="box-hover">
                        <div class="pro-box-info">
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title">
                          <h4> <a title="<?= $data->name?>" href="<?=base_url()?>advertising/details?ID=<?= base64_encode($data->id);?>">عنوان المنتج او العرض </a></h4> </div>
                        <div class="item-content">
                          <div class="cat">
                          <span style="float:right">
                          <a href="<?=base_url()?>cat/city?ID=<?= $data->city_id?>"> <?=$city?></a></span>
                          <span  style="float:left"><a href="<?=base_url()?>cat/lisiting?ID=<?= base64_encode($category_id);?>"><?=mb_substr( $category_name,0,50)?></a></span>
<div style="width: 100%; clear:both"></div>
                          </div>
                          <div class="timing"> <span class="date">    <?= date("d",strtotime($data->creation_date))?>  
                                <?= $data->date_title?></span> </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-hover">
                      <div class="product-item-actions">
                        <div class="pro-actions"> <span class="pricing"><?= $data->price?> <?= $currency;?></span> </div>
                        <div class="add-to-links" data-role="add-to-links">
                          
<div  class="add-to-fav advertising-action"  style="color:#<?php if($favourite_key){?>e80f55;<?php }?>" title="اضف الى المفضلة" > 
<i class="fa fa-heart  myfav"></i>
</div>
<input type="hidden" class="advertising_ID" value="<?= $data->id;?>">
<?php if($maincount>0){?>
<a  href="<?= base_url()?>messages/message/<?= $idm;?>" class="advertising-action messages fa fa-envelope"  title="الدردشة">
<?php echo $maincount;} else {?>
<a  href="<?= base_url()?>messages/send_message/<?= base64_encode($data->id);?>" class="advertising-action messages fa fa-envelope"  title="الدردشة">
<?php }?></a>


                        </div>
                      </div>
                    </div>
                  </div>
                        </div>
                      </div>
                    </div>
                  </div>
<?php }?>
<?php }?>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Container End -->
  
  <!-- Footer -->
