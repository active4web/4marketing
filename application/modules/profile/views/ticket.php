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
                      <li role="presentation" ><a href="<?= base_url()?>profile/technical_support" >الدعم الفنى</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>profile/create_ticket" >انشاء تذكرة</a></li>
                      <li role="presentation" class="active"><a >التفاصيل</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="col-md-12" style="min-height:500px"> 
                           <?php foreach($tickets as $main)
                           
                           $color= get_table_filed('tickets_types',array('id'=>$main->ticket_type_id),"color");
                           $username= get_table_filed('customers',array('id'=>$main->created_by),"user_name");
                           ?>
<div class="ticket-title" style="color:<?= $color?>"><?= $main->title?></div>
<div class="row user"><div class="col-md-2 text-left" style="color:<?= $color?>"><?= $main->created_at?></div><div class="col-md-2 text-center" style="color:<?= $color?>"><?=  mb_substr($username,0,10)?></div><div class="col-md-8 content"><?= $main->content?></div></div>
<?php 
if(count($tickets_replies)>0){
  foreach($tickets_replies as $data){

?>
<?php if($data->reply_type==0){?>
<div class="row user"><div class="col-md-8 content management"><?= $data->content?></div><div class="col-md-2 text-center" style="color:<?= $color?>">الأدارة</div><div class="col-md-2 text-center" style="color:<?= $color?>"><?= $data->created_at?></div></div>
<?php } else { 
  $username=get_table_filed('customers',array('id'=>$data->created_by),"user_name");
  ?>
  <div class="row user"><div class="col-md-2 text-center" style="color:<?= $color?>"><?= $data->created_at?></div><div class="col-md-2 text-center" style="color:<?= $color?>"><?=  mb_substr($username,0,10)?></div><div class="col-md-8 content"><?= $data->content?></div></div>


<?php }?>
  <?php }?>
<?php }?>
                         </div>
<div class="col-md-12">
<form method="post" action="<?= base_url()?>profile/ticket_replay" id="form-ui">
<input type="hidden" value="<?= $this->uri->segment(3);?>" name="ticket_id">
            <div class="form-body">
                  
            <div class="frm-row">
                <div class="section col-md-10">
                <textarea class="gui-textarea" style="width: 100%;height:60px" id="comment" name="comment" placeholder="الرد"></textarea>
                      </div>
                  </div><!-- end section -->                     
                                    
                  
              </div><!-- end .form-body section -->
              <div class="form-footer">
                <button type="submit" class="button btn-primary">ارسال</button>
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