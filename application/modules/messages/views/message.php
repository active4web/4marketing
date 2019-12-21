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
                      <li role="presentation" class="active"><a >التفاصيل</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <div class="col-md-12" style="min-height:500px"> 
                           <?php foreach($messages as $main)
                           
                           $productname= get_table_filed('products',array('id'=>$main->id_products),"name");
                           if($this->session->userdata('admin_id')==$main->server_id){
                             $userid=$main->send_id;
                            $reciver_name="انت";
                           }
                           else{
                            $reciver_name= get_table_filed('customers',array('id'=>$main->server_id),"user_name");
                            $userid=$main->server_id;
                           }

                           if($this->session->userdata('admin_id')==$main->send_id){
                            $sender_name="انت";
                           }
                           else{
                            $sender_name= get_table_filed('customers',array('id'=>$main->send_id),"user_name");
                           }
                           ?>
<div class="ticket-title"><?= $productname?></div>
<div class="row user">
<div class="col-md-4 text-left"><?= $main->creation_date?></div>
<div class="col-md-4 text-center" >المرسل:<?=  mb_substr($sender_name,0,50)?></div>
<div class="col-md-4 text-center" >المرسل اليه:<?=  mb_substr($reciver_name,0,50)?></div>

<div class="col-md-12 content"><?= $main->message?></div>
</div>
<?php 
if(count($messages_replies)>0){
  foreach($messages_replies as $data){

?>
<?php if($data->send_id==$this->session->userdata('admin_id')){?>
<div class="row user">
<div class="col-md-12 content management">
<?= $data->message?>

<div class="row">
<div class="col-md-3 text-center" style="font-size:13px;float:left">المرسل:انت</div>
<div class="col-md-2 text-center" style="font-size:13px;float:left"><?= $data->creation_date?></div>
  </div>

</div>

</div>
<?php } else { 
  $username=get_table_filed('customers',array('id'=>$data->send_id),"user_name");
  ?>
  <div class="row user">
  <div class="col-md-12 content">
  <?= $data->message?>

  <div class="row">
  <div class="col-md-6 text-center" style="font-size:13px;float:left">المرسل:<?=  mb_substr($username,0,30)?></div>
  <div class="col-md-2 text-center"  style="font-size:13px;float:left"><?= $data->creation_date?></div>

  </div>

  </div>

  </div>


<?php }?>
  <?php }?>
<?php }?>
                         </div>
<div class="col-md-12">
<form method="post" action="<?= base_url()?>messages/message_replay" id="form-ui">
<input type="hidden" value="<?= $this->uri->segment(3);?>" name="ticket_id">
<input type="hidden" value="<?= $main->id_products?>" name="productid">
 <input type="hidden" value="<?= $userid?>" name="userid">

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