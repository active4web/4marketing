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
          <div class="sidebar">           
            <ul>
              <li ><a href="<?= base_url()?>account/"><i class="fa fa-bullhorn" aria-hidden="true"></i> إعلاناتى</a></li>
              <li><a href="my_msg.html"><i class="fa fa-comments" aria-hidden="true"></i> الرسائل</a></li>
              <li class="current"><a href="<?= base_url()?>profile/technical_support"><i class="fa fa-support" aria-hidden="true"></i> الدعم الفنى</a></li>
              <li><a href="my_balance.html"><i class="fa fa-money" aria-hidden="true"></i> الرصيد الاعلانى </a></li>
			  <li><a href="<?= base_url()?>profile"><i class="fa fa-sliders" aria-hidden="true"></i> إعدادات الحساب</a></li>
			  <li><a href="<?= base_url()?>account/logout"><i class="fa fa-sliders" aria-hidden="true"></i> تسجيل الخروج</a></li>
            </ul>
          </div>
        </aside> <!--//Aside-->
        <div class="col-main col-sm-9 col-xs-12">

		  
		<div class="category-filter">
              <div class="row">
                <div class="col-md-12">
                  <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                      <li role="presentation" class="active"><a href="#active_ads" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">الدعم الفنى</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>profile/create_ticket" >انشاء تذكرة</a></li>

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
                                  <td class="view-message  dont-show td-header">التاريخ</td>
                                  <td class="view-message td-header ">العنوان</td>
                                  <td class="view-message  inbox-small-cells td-header">مشاهدة</td>
                </tr>
                
                              <?php

                              $count=0;
                              foreach($results as $data) {
                                $count++;
                                $ticket_type_name= get_table_filed('tickets_types',array('id'=>$data->ticket_type_id),"name");
                                $color= get_table_filed('tickets_types',array('id'=>$data->ticket_type_id),"color");
                   

							  ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <?= $count;?>
                                  </td>
								  <td class="inbox-small-cells"><?= $data->created_at;?></td>
                                  <td class="view-message  dont-show"><?php if(strlen($data->title)>40){echo  mb_substr($data->title,0,40)."...";}else {echo  mb_substr($data->title,0,40);}?></td>
                                  <td class="view-message"> <span style="background:<?= $color;?>" class="ticket"><?= $ticket_type_name;?></span></td>
                                  
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
<img src="<?= base_url()?>uploads/site_setting/supporting.png">
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