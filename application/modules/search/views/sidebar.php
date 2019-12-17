 
 <?php
 
 $category=$this->db->get_where('category',array("view"=>'1'))->result();
$city=$this->db->get_where('city',array("view"=>'1','country_id'=>'1'))->result();
$outside_city=$this->db->get_where('city',array("view"=>'1','country_id!='=>'1'))->result();
 
 ?>
 <div class="section-title text-center" style="background-color: #fff;padding: 10px; border: 2px solid #fff;">
                        <p class="p" style="color:#615d5d;margin-top: 7px; font-size:14px; text-align: center;">ابحث عن افضل الدورات والحقائب التدريبة والدبلومات</p>
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