<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="الرسائل">الرسائل</a> </strong></li>
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
                      <li role="presentation"><a href="<?= base_url()?>messages/archive"  >الرسائل الواردة</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>messages/send" >الرسائل الصادرة</a></li>
                      <li role="presentation"  class="active"><a href="" >أرشيف الرسائل</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                         <?php if(!empty($results)){?>

                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td  class="view-message  dont-show td-header">
                                     م
                                  </td>
                                  <td class="view-message  dont-show td-header">الرسائل</td>
                                  <td class="view-message td-header ">الإعلانات	</td>
                                  <td class="view-message  inbox-small-cells td-header">التاريخ</td>
                </tr>
                              <?php
                              $count=0;
                              foreach($results as $arch) {
                                $res=$this->db->get_where("messages",array("id"=>$arch->id_message))->result();
                                foreach($res as $data)
                                $count++;
                                $productname= get_table_filed('products',array('id'=>$data->id_products),"name");
                                if($data->send_id==$this->session->userdata('admin_id')){
                                  $sender_name="انت";
                                }
                                else {
                                  $sender_name= get_table_filed('customers',array('id'=>$data->send_id),"user_name");
                                }

                                if($data->server_id==$this->session->userdata('admin_id')){
                                  $reciver_name="انت";
                                }
                                else {
                                  $reciver_name= get_table_filed('customers',array('id'=>$data->server_id),"user_name");
                                }
                                $total=get_table_total("messages",array("id_reply"=>$data->id));
							  ?>
                              <tr class="unread">

                              <a href="<?= base_url()?>profile/ticket/<?= $data->id;?>">
                                  <td class="inbox-small-cells">
                                      <?= $count;?>
                                  </td>
                                  </a>
                                 
								  <td class="inbox-small-cells"> 
                 <a href="<?= base_url()?>messages/archive_delete_final/<?= $data->id;?>" title="حذف نهائى"><i class="fa fa-trash"></i></a> 
                  <a href="<?= base_url()?>messages/message/<?= $data->id;?>">
                   <?php if(strlen($sender_name)>10){echo  mb_substr($sender_name,0,10)."...";}else {echo  mb_substr($sender_name,0,10);}?>
                   ,
                   
                   <?php if(strlen($reciver_name)>10){echo  mb_substr($reciver_name,0,10)."...";}else {echo  mb_substr($reciver_name,0,10);}?>

                   <?php if( $total>0){?>(<?=  $total?>)<?php }?>
                  </a>
                </td>
                 
                   <td class="view-message  dont-show">
                   <a href="<?= base_url()?>messages/message/<?= $data->id;?>">
                   <div style="font-size:14px">
                   <?php if(strlen($productname)>30){echo  mb_substr($productname,0,30)."...";}else {echo  mb_substr($dproductname,0,30);}?>
                   </div>
                   <div style="font-size:13px;padding-top:10px">
                   <?php if(strlen($data->message)>40){echo  mb_substr($data->message,0,40)."...";}else {echo  mb_substr($data->message,0,40);}?>
                  </div>
                  </a>
                  
                  </td>

                  <td class="view-message  dont-show">
                   <a href="<?= base_url()?>messages/message/<?= $data->id;?>">
                   <?= $data->creation_date?>
                  </a>
                  </td>
                              
                           
                                 
                                    </tr>

                              <tr><td colspan="4"><br></td></tr>
							 <?php }?>
                          </tbody>
                          </table>
                          <div class="col-md-12">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
                                        </div>
                                    </div>
                              <?php } else {?>
<div class="ticket-txt">
<img src="<?= base_url()?>uploads/site_setting/messages.png">
<p style="padding-top:40px;font-weight:400;font-size:14px;">لأ يوجد رسائل حاليا</p>
</div>
                              <?php }?>
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