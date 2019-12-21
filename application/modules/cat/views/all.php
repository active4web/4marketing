 <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
            <li><strong><a title="كل الأعلانات" href="<?= base_url()?>cat/all">كل الأعلانات</a> </strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>



<div class="home-tab">
    <div class="container">
      <div class="row">
   <div class="col-md-12">
   <div class="page-title">
              <h2>

<?= 

get_table_filed('category',array('id'=>base64_decode($this->input->get("ID"))),"name");

?>

 </h2></div></div>





				<?php

				if(count($result_count)==0){

				?>

				<div class="col-md-12">

				<div class="page-title text-center" >

				<h2 style="font-size:16px;padding-top:20px">لا يوجد اى محتوى حاليا</h2>

				</div>

				</div>

				<?php } else {?>



          <div  class="col-md-12 col-sm-12 col-xs-12">

         

			<div class="toolbar" style="border-bottom:1px solid #8181812e">

              <div class="view-mode">

                <ul>
                <li class="active"> <a href="#"> <i class="fa fa-th-large"></i> </a> </li>
                  <li > <a href="<?=base_url()?>cat/all_lisit"> <i class="fa fa-th-list"></i> </a> </li>

                </ul>
              </div>
              <div class="sorter">
                <div class="short-by breadcrumbs"   style="border-bottom:0px;    margin: 0 1px 0 1px;">
                  <label>ترتيب حسب:</label>
<?php
if($this->input->get("arrange")!=""){
?>
<span class="arrange"><a href="<?=base_url()?>cat/all?>" style="color:#003b67db">الاحدث</a></span>
<?php } else {?><span class="arrange">الاحدث</span><?php }?>
<span>|</span>
<?php
if($this->input->get("arrange")=="low_price"||$this->input->get("arrange")==""){
?>

<span class="arrange"><a href="<?=base_url()?>cat/all?arrange=heigh_price" style="color:#003b67db">الأعلى سعر</a></span>
<?php } else if($this->input->get("arrange")=="heigh_price") {?><span class="arrange">الأعلى سعر</span><?php }?>
<span>|</span>
<?php
if($this->input->get("arrange")=="heigh_price"||$this->input->get("arrange")==""){
?>
<span class="arrange"><a href="<?=base_url()?>cat/all?arrange=low_price" style="color:#003b67db"> الأقل سعر</a></span>
<?php } else if($this->input->get("arrange")=="low_price"){?><span class="arrange"> الأقل سعر</span><?php }?>		
                </div>
              </div>
            </div>		
			</div>	
      <div  class="col-md-12 col-sm-12 col-xs-12" style="height:12px"></div>
			<div  class="col-md-12 col-sm-12 col-xs-12">
 <?php 

          foreach($results as $data){
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
$special=$data->special;

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

                          <a href="<?=base_url()?>cat/city?ID=<?= $data->city_id?>"> <?=mb_substr( $city_name,0,50)?></a></span>

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

                        <div class="pro-actions"> <span class="pricing"><?= $data->price?> <?= $currency_name?></span></div>
                        <?php 
                                if($special==1){
                                ?>
                                
                                <div class="ads__item__featured">اعلان مميز</div>
                                
                                <?php }?>
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

              <?php }?>

</div>

<div class="col-md-12 pagination text-center" style="margin-bottom:20px;">						    

<ul class="nav align-items-center" style="visibility: visible;margin:auto">

<?php foreach($links as $link){?><?php echo $link;?><?php } ?> 

</ul>	

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

