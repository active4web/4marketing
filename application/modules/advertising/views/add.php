
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
<?php if($id_cat!=""){?>
<li class="home"> <a title="<?=$name_dep?>" href="<?= base_url()?>cat/subcategory?ID=<?= base64_encode($dep_id);?>"><?=$name_dep?>
</a><span>&raquo;</span></li>
<?php }?>
<li class="home"> <a title="<?=$name_cat?>" href="<?= base_url()?>cat/grid?ID=<?= base64_encode($id_cat);?>"><?=$name_cat?>
</a><span>&raquo;</span></li>

            <li><strong><a title="كل الأعلانات" href="<?= base_url()?>cat/all">كل الأعلانات</a> </strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <div class="container">
      <div class="smart-forms smart-container wrap-2">
        
        	<div class="form-header header-primary">
            	<h4><i class="fa fa-flask"></i>اضافة الاعلان</h4>
            </div><!-- end .form-header section -->
   	    
            
            <form method="post" action="#" id="form-ui">
            	<div class="form-body">
                    
                    <div class="frm-row">
                    
                        <div class="colm colm12">
                        
                            <div class="section">
                                <label class="field">
                                    <input type="text" name="title" id="title" class="gui-input" placeholder="عنوان الاعلان">
                                </label>
                            </div><!-- end section -->                                            
                        
                        </div><!-- end .colm6 section -->
                                           
                    
                    </div><!-- end .frm-row section --> 
                     
                    
                    <div class="frm-row">
                      
                      <div class="section colm colm4">
                            <label class="field select">
                                <select id="city_id" name="city_id">
                                    <option value="">المدينة</option>
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
                                    <option value="">التصنيف</option>
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
                                    <option value="">القسم الفرعى</option>
                                </select>
                                    
                                    </select>
                                <i class="arrow"></i>                    
                            </label>  
                        </div><!-- end section -->

                        <div class="section colm colm6">
                            <label class="field select">
                                <select id="courrency" name="courrency">
                                    <option value="">العملة</option>
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
                          <input type="number" name="price" id="price" class="gui-input" placeholder="السعر">
                        </label>
                       </div>
                    
                    </div><!-- end .frm-row section -->
                    
                	<div class="section">
                    	<label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="وصف الاعلان"></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                            
                        </label>
                        <?php foreach($customers as $customers)?>
                    </div><!-- end section -->   
                    <div class="frm-row">

                    <div class="section colm colm6">
                        <label class="field">
                          <input type="text" name="phone" value="<?= $customers->phone?>" id="phone"  class="gui-input" placeholder="التليفون">
                        </label>
                       </div>

                       <div class="section colm colm6">
                        <label class="field">
                          <input type="text" name="email" value="<?= $customers->email?>" id="email" class="gui-input" placeholder="البريد الألكترونى">
                        </label>
                       </div>
                       <div class="section colm colm12">
                       <span style="padding:5px;"> <input type="radio" name="adv_type" checked value="0"> إعلان عادى
</span>
<span style="padding:5px;"><input type="radio" name="adv_type" value="1"> إعلان مميز</span>
                       </div>
                       </div>

                    <div class="spacer-t40 spacer-b40">
                    	<div class="tagline"><span>رفع الصور </span></div><!-- .tagline -->
                    </div>                    
                    
                    <div class="section">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img" id="file1" onchange="document.getElementById('uploader1').value = this.value;">
                            <input type="text" class="gui-input" id="uploader1" placeholder="no file selected" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->                     
                    
                    <div class="section">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img1" id="file2" onchange="document.getElementById('uploader2').value = this.value;">
                            <input type="text" class="gui-input" id="uploader2" placeholder="no file selected" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->

                    <div class="section">
                        <label class="field prepend-icon file">
                            <span class="button btn-primary"> إختر صورة </span>
                			<input type="file" class="gui-file" name="img2" id="file3" onchange="document.getElementById('uploader3').value = this.value;">
                            <input type="text" class="gui-input" id="uploader3" placeholder="no file selected" readonly="">
                            <span class="field-icon"><i class="fa fa-upload"></i></span>
                        </label>
                    </div><!-- end  section -->
                    
                </div><!-- end .form-body section -->
                <div class="form-footer">
                	<button type="button" class="button btn-primary add_adv_action">أضف إعلانك</button>
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div>