<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">تعديل</a> </strong></li>
	  </ul>
	</div>
  </div>
</div>
</div>

<link rel="stylesheet" href="<?= base_url();?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?= base_url();?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>

<div class="main-container col2-left-layout">
    <div class="container">
	  
      <div class="row">
      <aside class="profile col-sm-3 col-xs-12">
		<h3><br></h3>
         <?php include("assets/sidebar.php")?>
        </aside> <!--//Aside-->
        
        <div class="col-main col-sm-9 col-xs-12">

		  
		<div class="category-filter">
              <div class="row">
                <div class="col-md-12">
                  <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                      <li role="presentation" ><a href="<?= base_url()?>account"  >اعلاناتى</a></li>
                      <li role="presentation" class="active"><a href="" >تعديل</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="smart-forms smart-container wrap-2">
        <?php
        foreach ($products as $products)
        ?>
        <div class="form-header header-primary">
            <h4><i class="fa fa-bullhorn"></i>تعديل اعلانى</h4>
          </div><!-- end .form-header section -->
       
          <form method="post" action="#" id="form-ui">
            <input type="hidden" name="productid" value="<?= $products->id?>">
            <input type="hidden" id="service_type" value="2">
            	<div class="form-body">
                    
                    <div class="frm-row">
                    
<div class="section colm colm6">
  <?php if($products->img!=""){?>
<a title="مشاهدة الصور" class="example-image-link" href="<?= base_url('')?>uploads/products/<?= $products->img;?>" data-lightbox="example-1"><img src="<?= base_url('')?>uploads/products/<?= $products->img;?>" style="width:200px;height:120px"></a>
<a href="<?= base_url('') ?>account/delete_main_img?advertising_id=<?=$products->id;?>" style="line-height:35px"><i class="fa fa-remove"></i> حذف </a>
  <?php }?>
</div>
                    <div class="section colm colm6">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary">الصورة الرئيسية</span>
                			<input type="file" class="gui-file" name="mainimg" id="main_img" onchange="document.getElementById('mainimg').value = this.value;">
                            <input type="text" class="gui-input" id="mainimg" placeholder="الصورة الأعلانية الرئيسية" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->

                        <div class="colm colm12">
                        
                            <div class="section">
                                <label class="field">
                                    <input type="text" name="title" value="<?= $products->name;?>" id="title" class="gui-input" placeholder="عنوان الاعلان">
                                </label>
                            </div><!-- end section -->                                            
                        
                        </div><!-- end .colm6 section -->
                                           
                    
                    </div><!-- end .frm-row section --> 
                     
                    
                    <div class="frm-row">
                      
                      <div class="section colm colm4">
                            <label class="field select">
                                <select id="city_id" name="city_id">
                                <option value="<?= $products->city_id;?>">المدينة الحالية(<?= get_table_filed('city',array("id"=>$products->city_id),"name")?>)</option>
                                    <?php 
                                    foreach($city as $city){?>
                                    <option value="<?= $city->id?>"><?= $city->name?></option>

                                    <?php }?>
                                </select>
                                <i class="arrow"></i>                    
                            </label>  
                        </div><!-- end section -->                     
                        
                        <div class="section colm colm4">
                            <label class="field select">
                                <select id="category" name="category" onChange="getState(this.value);">
                                <option value="<?= $products->cat_id;?>">القسم الرئيسى(<?= get_table_filed('category',array("id"=>$products->cat_id),"name")?>)</option>
                                    <?php 
                                    foreach($category as $category){?>
                                    <option value="<?= $category->id?>"><?= $category->name?></option>

                                    <?php }?>
                                </select>
                                    
                                    </select>
                                <i class="arrow"></i>                    
                            </label>  
                        </div><!-- end section -->  

                        <div class="section colm colm4">
                            <label class="field select">
                                <select  name="dep_id"  class="form-control demoInputBox city_id"    id="state-list">
                                <option value="<?= $products->dep_id;?>">القسم الفرعى(<?= get_table_filed('department',array("id"=>$products->dep_id),"name")?>)</option>
                                </select>
                                    
                                    </select>
                                <i class="arrow"></i>                    
                            </label>  
                        </div><!-- end section -->

                        <div class="section colm colm6">
                            <label class="field select">
                                <select id="courrency" name="courrency">
                                    <option value="<?= $products->currency_id;?>">العملة الحالية(<?= get_table_filed('currency',array("id"=>$products->currency_id),"name")?>)</option>
                                    <?php 
                                    foreach($currency as $currency){?>
                                    <option value="<?= $currency->id?>"><?= $currency->name?></option>
                                    <?php }?>
                                </select>
                                    
                                    </select>
                                <i class="arrow"></i>                    
                            </label>  
                        </div><!-- end section -->                     
                        
                       <div class="section colm colm6">
                        <label class="field">
                          <input type="number" name="price" value="<?= $products->price;?>" id="price" class="gui-input" placeholder="السعر">
                        </label>
                       </div>
                    
                    </div><!-- end .frm-row section -->
                    
                	<div class="section">
                    	<label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="وصف الاعلان"><?= $products->details;?></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                            
                        </label>
                        <?php foreach($customers as $customers)?>
                    </div><!-- end section -->   
                    <div class="frm-row">

                    <div class="section colm colm6">
                        <label class="field">
                          <input type="text" name="phone" value="<?= $products->user_phone?>" id="phone"  class="gui-input" placeholder="التليفون">
                        </label>
                       </div>

                       <div class="section colm colm6">
                        <label class="field">
                          <input type="text" name="email" value="<?= $products->user_email?>" id="email" class="gui-input" placeholder="البريد الألكترونى">
                        </label>
                       </div>
                       <div class="section colm colm12">
                                    <span style="padding:5px;"> <input type="radio" name="adv_type" <?php if($products->special==0){?>checked<?php }?> value="0"> إعلان عادى
</span>
<span style="padding:5px;"><input type="radio" name="adv_type" value="1"  <?php if($products->special==1){?>checked<?php }?>> إعلان مميز</span>
                       </div>
                       </div>

                    <div class="spacer-t40 spacer-b40">
                    	<div class="tagline"><span>رفع الصور </span></div><!-- .tagline -->
                    </div>                    
                  
                    <div class="frm-row">
                    <div class="section colm colm6">
                    <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img" id="file1" onchange="document.getElementById('uploader1').value = this.value;">
                            <input type="text" class="gui-input" id="uploader1" placeholder="صورة الأعلان" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->                     
                    <div class="section colm colm6">
                    <?php if(count($images1)>0){
													foreach($images1 as $gallery1)
														?>
                          <a title="مشاهدة الصور" class="example-image-link" href="<?= base_url('')?>uploads/products/<?= $gallery1->image;?>" data-lightbox="example-1"><img src="<?= base_url('')?>uploads/products/<?= $gallery1->image;?>" style="width:100px;height:60px"></a>
											<a href="<?= base_url('') ?>account/delete_img?advertising_id=<?=$products->id;?>&id=<?=$gallery1->id;?>" style="line-height:35px"><i class="fa fa-remove"></i> حذف </a>
                    <?php  }?>    
                    </div><!-- end  section --> 


                    <div class="section section colm colm6">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img1" id="file2" onchange="document.getElementById('uploader2').value = this.value;">
                            <input type="text" class="gui-input" id="uploader2" placeholder="صورة الأعلان" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->
                    <div class="section colm colm6">
                    <?php if(count($images2)>0){
													foreach($images2 as $gallery2)
														?>
                          <a title="مشاهدة الصور" class="example-image-link" href="<?= base_url('')?>uploads/products/<?= $gallery2->image;?>" data-lightbox="example-1"><img src="<?= base_url('')?>uploads/products/<?= $gallery2->image;?>" style="width:100px;height:60px"></a>
											<a href="<?= base_url('') ?>account/delete_img?advertising_id=<?=$products->id;?>&id=<?=$gallery2->id;?>" style="line-height:35px"><i class="fa fa-remove"></i> حذف </a>
                    <?php  }?>    
                    </div><!-- end  section --> 


                    <div class="section section colm colm6">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img2" id="file3" onchange="document.getElementById('uploader3').value = this.value;">
                            <input type="text" class="gui-input" id="uploader3" placeholder="صورة الأعلان" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->

                    <div class="section colm colm6">
                    <?php if(count($images3)>0){
													foreach($images3 as $gallery3)
														?>
                          <a title="مشاهدة الصور" class="example-image-link" href="<?= base_url('')?>uploads/products/<?= $gallery3->image;?>" data-lightbox="example-1"><img src="<?= base_url('')?>uploads/products/<?= $gallery3->image;?>" style="width:100px;height:60px"></a>
											<a href="<?= base_url('') ?>account/delete_img?advertising_id=<?=$products->id;?>&id=<?=$gallery3->id;?>" style="line-height:35px"><i class="fa fa-remove"></i> حذف </a>
                    <?php  }?>    
                    </div><!-- end  section --> 

                    </div>

                </div><!-- end .form-body section -->
                <div class="form-footer">
                	<button type="button" class="button btn-primary add_adv_action">تعديل إعلانك</button>
                </div><!-- end .form-footer section -->
            </form>
          
      </div>
                      </div>
              </div>
                </div>
                      </div>

                      
                    </div>
                  </div>
                </div>  
              </div>
            </div>


            </div>
        </div>
        
      </div>
    </div>
  </div>