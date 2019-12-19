<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">تغير كلمة السر</a> </strong></li>
	  </ul>
	</div>
  </div>
</div>
</div>

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
                      <li role="presentation" ><a href="<?= base_url()?>profile" >اعدادات الحساب</a></li>
                      <li role="presentation" class="active"><a href="">تغير كلمة السر</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="smart-forms smart-container wrap-2">
        
        <div class="form-header header-primary">
            <h4><i class="fa fa-key  "></i>تغير كلمة السر</h4>
          </div><!-- end .form-header section -->
       
          
          <form method="post" action="#" id="form-ui">
            <div class="form-body">
                  
                  <div class="frm-row">
                  
                      <div class="colm colm12">
                      
                          <div class="section">
                              <label class="field">
                                <label>كلمة السر الحالية</label>
                                  <input type="password" name="oldpassword"   id="oldpassword" class="gui-input" placeholder="كلمة السر الحالية">
                                  <label class="error_currentpassword error">كلمة السر الحالية غير صحيحة</label>
                              </label>
                          </div><!-- end section -->                                            
                      
                      </div><!-- end .colm6 section -->
                                         
                  
                  </div><!-- end .frm-row section --> 
                   
                  
                  <div class="frm-row">
                  
                  <div class="colm colm12">
                      <div class="section">
                          <label class="field">
                          <label>كلمة السر الجديدة</label>
                              <input type="password" name="newpassword"   id="newpassword" class="gui-input" placeholder="كلمة السر الجديدة">
                          </label>
                      </div><!-- end section -->                                            
                  </div><!-- end .colm6 section -->
              </div><!-- end .form-body section -->

              <div class="frm-row">
                  
                  <div class="colm colm12">
                      <div class="section">
                          <label class="field">
                          <label>تأكيد كلمة السر</label>
                              <input type="password" name="confirmpassword" id="confirmpassword"  class="gui-input" placeholder="تأكيد كلمة السر">
                              <label class="error_confirmpassword error">كلمة السر غير متطابقة</label>
                          </label>
                      </div><!-- end section -->                                            
                  </div><!-- end .colm6 section -->
              </div><!-- end .form-body section -->

          
              <div class="form-footer">
                <button type="button" class="button btn-primary changepassword_action">حفظ</button>
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