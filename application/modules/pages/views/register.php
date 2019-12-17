
  <!-- end header -->
  
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="<?= base_url()?>home">الرئيسية</a><span>&raquo;</span></li>
            <li><strong>حساب جديد</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
  <!--Container -->
  <div class="error-page">
    <div class="container">
      <div class="smart-forms smart-container wrap-2">
        
        	<div class="form-header header-primary">
            	<h4><i class="fa fa-flask"></i>حساب جديد</h4>
            </div><!-- end .form-header section -->
   	    
            
            <form method="post" action="#" id="form">
           
            <div class="form-body">
                    
                     
                    
                    <div class="frm-row">
                      <div class="section colm colm12">
                        <label class="field prepend-icon">
                          <input type="text" name="fullname" id="fullname" class="gui-input" placeholder="الاسم بالكامل">
                          <span class="field-icon"><i class="fa fa-user"></i></span>
                          <label class="error_fullname error"> الأسم بالكامل مطلوب </label>
                        </label>
                       </div>
                      
                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="text" name="phone" id="phone" class="gui-input" placeholder="رقم الجوال">
                          <span class="field-icon"><i class="fa fa-mobile"></i></span>
                          <label class="error_phone error"> رقم الجوال مطلوب</label>
                          <label class="error_phone_find error"> رقم الجوال موجود سابقا</label>
                          
                        </label>
                       </div>
                     
                      
                      
                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="text" name="email" id="email" class="gui-input" placeholder="البريد الالكترونى">
                          <span class="field-icon"><i class="fa fa-envelope"></i></span>
                          <label class="error_email error"> البريد الألكترونى مطلوب </label>
                          <label class="error_email_find error"> البريد الألكترونى موجود سابقا</label>
                        </label>
                       </div>
                       <div class="section colm colm12"></div>

                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="password" name="password" id="password" class="gui-input" placeholder="كلمة المرور">
                          <span class="field-icon"><i class="fa fa-key"></i></span>
                          <label class="error_password error">  كلمة المرور مطلوبة </label>
                        </label>
                       </div>
                      
                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="text" name="city" id="city" class="gui-input" placeholder="البلد">
                          <span class="field-icon"><i class="fa fa-map-marker"></i></span>
                          <label class="error_city error">  كلمة البلد مطلوبة </label>
                        </label>
                       </div>

                       <div class="section colm colm12">
                        <div class="option-group field">
                            <label class="option block" style="margin-top:10px;"><i class="fa fa-lock"></i>
                            <a href="<?= base_url()?>pages">تسجيل دخول</a>
                            </label>                              
                        </div><!-- end .option-group section --> 
                                                
                    </div><!-- end .colm section -->
                    </div><!-- end .frm-row section -->
                                        
                              
                    

                    
                </div>

                <div class="form-footer">
               <button type="button" class="button btn-primary register center">تسجيل</button>
               <input type="hidden"  id="module" >
               <input type="hidden" id="slug" >
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div>
  </div>
