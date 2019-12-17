
  <!-- end header -->
  
  <!-- Breadcrumbs -->
  
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="<?= base_url()?>home">الرئيسية</a><span>&raquo;</span></li>
            <li><strong>تسجيل الدخول</strong></li>
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
            	<h4><i class="fa fa-flask"></i>تسجيل الدخول</h4>
            </div><!-- end .form-header section -->
   	    
            
            <form method="post" action="#" id="form">
            	<div class="form-body">
              
              <?php if($this->input->get("register")=="true"){?>
              <div class="section colm colm12" style="text-align:center">   
              <label class="success center"  style="color: #2757ce;">تم انشاء حسابك بنجاح ويمكن الان تسجيل الدخول</label>
              </div>
              <?php }?>
                    
                    <div class="frm-row">
                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="text" name="username" id="username" class="gui-input" placeholder="البريد الألكترونى-رقم التليفون">
                          <label class="error_user error">رقم التليفون او البريد الألكترونى مطلوب</label>
                          <span class="field-icon"><i class="fa fa-envelope"></i></span>
                        </label>
                       </div>
                      
                      <div class="section colm colm6">
                        <label class="field prepend-icon">
                          <input type="password" name="password" id="password" class="gui-input" placeholder="كلمة المرور">
                          <label class="error_password error">  كلمة المرور مطلوبة </label>
                          <span class="field-icon"><i class="fa fa-key"></i></span>
                        </label>
                       </div>
                       <div class="col-md-12"></div>
                       <div class="col-md-12 text-center"> <label class="error_login error">كلمة المرور او رقم التليفون او البريد الألكترونى غير صحيح</label></div>
                       <div class="col-md-12 text-center"> <label class="account_no_active error">نأسف  حيث انه تم ايقاف الحساب من قبل الأدارة للتواصل مع الادارة 
                       <a href="<?= base_url()?>ticket" taregt="_blank">اضغط هنا</a>
                       </label></div>
                      <div class="section colm colm6">
                        
                            <div class="option-group field">
                            
                                <label class="option block">
                                    <input type="checkbox" name="mobileos" id="show_password"  value="FR">
                                    <span class="checkbox"></span> إظهار كلمة المرور          
                                </label>                              
                                
                            </div><!-- end .option-group section --> 
                                                    
                        </div><!-- end .colm section -->
                    
                    
                     <div class="section colm colm6">
                        
                            <div class="option-group field">
                            
                                <label class="option block" style="margin-top:10px;"><i class="fa fa-lock"></i>
                                <a href="<?= base_url()?>pages/fogetpassword">نسيت كلمة المرور؟</a>
                                </label>                              
                                
                            </div><!-- end .option-group section --> 
                                                    
                        </div><!-- end .colm section -->
                    
                    </div><!-- end .frm-row section -->
             
                </div><!-- end .form-body section -->
                <div class="form-footer">
                  <button type="button" class="button btn-primary login" title="تسجيل الدخول">تسجيل الدخول</button>
                <a href="<?= DIR?>pages/register" title=" حساب جديد"><button type="button" class="button btn-primary left"> حساب جديد</button></a>  
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div>
  </div>
