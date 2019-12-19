<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="المفضلة">المفضلة</a> </strong></li>
	  </ul>
	</div>
  </div>
</div>
</div>

<div class="home-tab">
    <div class="container">
      <div class="row">
      <aside class="profile col-sm-3 col-xs-12">
		<h3><br></h3>
         <?php include("assets/sidebar.php")?>
        </aside> <!--//Aside-->

        <div class="col-main col-sm-9 col-xs-12">
      <?php if(!empty($results)){?>

 <?php 
          foreach($results as $fav){
            $image_product=$this->db->get_where("products",array("id"=>$fav->course_id))->result();
            foreach($image_product as $data)    
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
}
$special=$data->special;
$currency=get_name('currency',$data->currency_id);
$city=get_name('city',$data->city_id);
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
                          <a href="<?=base_url()?>city?ID=city_id"> <?=$city?></a></span>
                          <span  style="float:left"><a href="<?=base_url()?>cat/lisiting?ID=<?= base64_encode($category_id);?>"><?=mb_substr( $category_name,0,50)?></a></span>
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
                        <div class="pro-actions"> <span class="pricing"><?= $data->price?> <?= $currency;?></span></div>
                        <?php if($special==1){?>
                                <div class="ads__item__featured">اعلان مميز</div>
                                <?php }?>
<div class="add-to-links" data-role="add-to-links">
<div  class="add-to-remove advertising-action"  style="color:#<?php if($favourite_key){?>e80f55;<?php }?>" title="حذف من المفضلة" > 
<i class="fa fa-trash  myfav"></i>
</div>
<input type="hidden" class="advertising_ID" value="<?= $data->id;?>">
 <a  class="advertising-action messages fa fa-envelope" title="الدردشة"></a>
                                </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php }?>
</div>
<div class="col-md-12">
<div style="text-align:center;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
<ul class="pagination" style="visibility: visible;">
<?php echo $pagination; ?>
</ul>
</div>
</div>
<?php } else {?>

  <div class="ticket-txt" style="height: 300px;line-height:200px">
المفضلة فارغة الأن
</div>

<?php }?>
      </div>
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
