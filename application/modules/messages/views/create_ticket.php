<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">الدعم الفنى</a> </strong></li>
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
                      <li role="presentation" ><a href="<?= base_url()?>profile/technical_support"  >الدعم الفنى</a></li>
                      <li role="presentation" class="active"><a href="" >انشاء تذكرة</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="smart-forms smart-container wrap-2">
        
        <div class="form-header header-primary">
            <h4><i class="fa fa-support"></i>فتح تذكرة</h4>
          </div><!-- end .form-header section -->
       
          
          <form method="post" action="#" id="form-ui">
            <div class="form-body">
                  
                  <div class="frm-row">
                  
                      <div class="colm colm12">
                      
                          <div class="section">
                              <label class="field">
                                  <input type="text" name="title" id="title" class="gui-input" placeholder="العنوان">
                              </label>
                          </div><!-- end section -->                                            
                      
                      </div><!-- end .colm6 section -->
                                         
                  
                  </div><!-- end .frm-row section --> 
                   
                  
                  <div class="frm-row">
                    
                    <div class="section colm colm12">
                          <label class="field select">
                              <select id="tickets_types" name="tickets_types">
                                  <option value="">توع التذكرة</option>
                                 <?php foreach($tickets_types as $tickets_types){ ?>
                                  <option value="<?= $tickets_types->id?>"><?= $tickets_types->name?></option>
                                 <?php }?>
                              </select>
                              <i class="arrow"></i>                    
                          </label>  
                      </div><!-- end section -->
                    
                  
                <div class="section">
                    <label class="field prepend-icon">
                        <textarea class="gui-textarea" id="comment" name="comment" placeholder="محتوى التذكرة"></textarea>
                          <span class="field-icon"><i class="fa fa-comments"></i></span>
                          <span class="input-hint"> 
                            <strong>تنبيه :</strong> محتوى التذكرة
                          </span>   
                      </label>
                  </div><!-- end section -->                     
                                    
                  
              </div><!-- end .form-body section -->
              <div class="form-footer">
                <button type="button" class="button btn-primary ticket_action">إنشاء تذكرة</button>
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