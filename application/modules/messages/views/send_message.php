<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="الدردشة">الدردشة</a> </strong></li>
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
                    <li role="presentation" ><a href="<?= base_url()?>messages">الرسائل الواردة</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>messages/send" >الرسائل الصادرة</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>messages/archive" >أرشيف الرسائل</a></li>
                      <li role="presentation"  class="active"><a href="" >الدردشة</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="smart-forms smart-container wrap-2">
                         <?php
       foreach($products as $products)
       ?>
        <div class="form-header header-primary">
            <h4><i class="fa fa-comment"></i>فتح تذكرة
            <span style="font-size:14px;padding-right:5px"><?= get_table_filed('customers',array('id'=>$products->user_id),"user_name");?></span>
            </h4>
          </div><!-- end .form-header section -->
      
          
          <form method="post" action="#" id="form-ui">
          <input type="hidden" value="<?= $products->id?>" name="productid">
          <input type="hidden" value="<?= $products->user_id?>" name="user_id">

            <div class="form-body">
                  
                  <div class="frm-row">
                  
                      <div class="colm colm12">
                      
                          <div class="section">
                              <label class="field">
                                  <input type="text" readonly name="title" id="title" class="gui-input"  value="<?= $products->name?>">
                              </label>
                          </div><!-- end section -->                                            
                      
                      </div><!-- end .colm6 section -->
                                         
                  
                  </div><!-- end .frm-row section --> 
                   
                  
                  <div class="frm-row">
                    
                    
                    
                  
                <div class="section">
                    <label class="field prepend-icon">
                        <textarea class="gui-textarea" id="comment" name="comment" placeholder="محتوى الرسالة"></textarea>
                          <span class="field-icon"><i class="fa fa-comments"></i></span>
                          <span class="input-hint"> 
                            <strong>تنبيه :</strong> محتوى الرسالة
                          </span>   
                      </label>
                  </div><!-- end section -->                     
                                    
                  
              </div><!-- end .form-body section -->
              <div class="form-footer">
                <button type="button" class="button btn-primary message_action">إرسال</button>
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