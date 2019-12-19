<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">اعدادات الحساب</a> </strong></li>
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
                      <li role="presentation" class="active"><a href="" >اعدادات الحساب</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>profile/changepassword"  >تغير كلمة السر</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="smart-forms smart-container wrap-2">
        
        <div class="form-header header-primary">
            <h4><i class="fa fa-user"></i>اعدادات الحساب</h4>
          </div><!-- end .form-header section -->
       
          
          <form method="post" action="#" id="form-ui">
            <div class="form-body">
                  <?php
                  foreach($customers as $customers)
                  ?>
                  <div class="frm-row">
                  
                      <div class="colm colm12">
                      
                          <div class="section">
                              <label class="field">
                                  <input type="text" name="title"  value="<?= $customers->user_name; ?>" id="title" class="gui-input" placeholder="الأسم بالكامل">
                              </label>
                          </div><!-- end section -->                                            
                      
                      </div><!-- end .colm6 section -->
                                         
                  
                  </div><!-- end .frm-row section --> 
                   
                  
                  <div class="frm-row">
                  
                  <div class="colm colm12">
                      <div class="section">
                          <label class="field">
                              <input type="text" name="phone" value="<?= $customers->phone; ?>"  id="phone" class="gui-input" placeholder="التليفون">
                          </label>
                      </div><!-- end section -->                                            
                  </div><!-- end .colm6 section -->
              </div><!-- end .form-body section -->

              <div class="frm-row">
                  
                  <div class="colm colm12">
                      <div class="section">
                          <label class="field">
                              <input type="text" name="email" id="email" value="<?= $customers->email; ?>" class="gui-input" placeholder="البريد الألكترونى">
                          </label>
                      </div><!-- end section -->                                            
                  </div><!-- end .colm6 section -->
              </div><!-- end .form-body section -->

              <div class="frm-row">
                  
                  <div class="colm colm12">
                      <div class="section">
                          <label class="field">
                              <input type="text" name="city_id" id="city_id" value="<?= $customers->city_id; ?>" class="gui-input" placeholder="البلد">
                          </label>
                      </div><!-- end section -->                                            
                  </div><!-- end .colm6 section -->
              </div><!-- end .form-body section -->

              <div class="form-footer">
                <button type="button" class="button btn-primary profile_action">حفظ</button>
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