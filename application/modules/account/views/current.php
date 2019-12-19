<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">إعلاناتى </a> </strong></li>
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
                      <li role="presentation" class="active"><a href="#active_ads" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">الأعلانات</a></li>
                      <li role="presentation" ><a href="<?= base_url()?>account/archive"  title="ارشيف الأعلانات">أرشيف الأعلانات</a></li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                            
                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td  class="view-message  dont-show td-header">
                                     م
                                  </td>
                                  <td class="view-message  dont-show td-header">التاريخ</td>
                                  <td class="view-message td-header ">اسم الأعلان</td>
                                  <td class="view-message  inbox-small-cells td-header">السعر</td>
                                  <td class="view-message  text-right td-header">الحالة</td>
								  <td class="view-message  text-right td-header">الدردشة</td>
							  </tr>
                              <?php
                              $count=0;
							 foreach($active as $active){
                                $count++;
                                $currency= get_table_filed('currency',array('id'=>$active->currency_id),"name");
                                $view=$active->view;
										$expired_date=$active->expired_date;
										switch($view){
													case 0:
													  $view="<span class='label label-sm label-danger'>منتظر</span>";
													  break;
													case 1:
													  $view="<span class='label label-sm label-success'>مفعل</span>";
													  break;
													  case 2:
														$view="<span class='label label-sm label-success'>مرفوض</span>";
														break;
													default:
													  break; 
												}

												switch($expired_date){
													case 0:
													  $expired_date="<span class='label label-sm label-danger'>منتهى</span>";
													  break;
													case 1:
													  $expired_date="<span class='label label-sm label-success'>متواجد</span>";
													  break;
													default:
													  break; 
												}

							  ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <?= $count;?>
                                  </td>
								  <td class="inbox-small-cells"><?= "<span class='txt'>من:</span>".date("Y-m-d",strtotime($active->creation_date));?><br>
								<?= "<span class='txt'>الى:</span>".$active->expired_date_Val?>
								</td>
                                  <td class="view-message  dont-show"><?php if(strlen($active->name)>25){echo  mb_substr($active->name,0,25)."...";}else {echo  mb_substr($active->name,0,25);}?></td>
                                  <td class="view-message"> <?= $active->price."".$currency;?></td>
                                  <td class="view-message"> <?= $view." ".$expired_date;?></td>
                                  <td class="view-message inbox-small-cells">
                             <span class="<?php if(get_table_total("messages",array("id_products"=>$active->id))){?>txt_mess<?php } else {?> txt_noactmess<?php }?>">
                                <i class="fa fa-envelope"></i> <?php if(get_table_total("messages",array("id_products"=>$active->id))){?>(<?= get_table_total("messages",array("id_products"=>$active->id));?>)<?php }?> 
                                </span>
                                  </td>
                                    </tr>

                              <tr style="border-bottom: 2px solid #1550e2;">
                                  <td style="border-left: 1px solid #cecece;text-align:center;font-size:12px">الاحصائيات</td>
                                  <td  style="border-left: 1px solid #cecece;text-align:center;font-size:12px">
                                <span> <i class="fa fa-eye" style="padding-left:5px;"></i>مشاهدات:</span><span><?= $active->views;?></span>
                                </td>
                                <td  style="border-left: 1px solid #cecece;text-align:center">
                                <span> <i class="fa fa-heart" style="padding-left:5px;text-align:center; font-size:12px"></i>المفضلة:</span><span><?= get_table_total("favourites",array("course_id"=>$active->id));?></span>
                                </td>
                                <td class="view-message text-right"><a href="<?=base_url()?>account/delete?ID=<?= base64_encode($active->id);?>" title="<?= $active->name;?>" class="action-txt"><i class="fa fa-trash action" ></i>حذف</a>
                                  <a href="" title="حذف"  class="action-txt"><i class="fa fa-edit action"></i>تعديل</a>
                                  <a href="<?=base_url()?>advertising/details?ID=<?= base64_encode($active->id);?>" title="<?= $active->name;?>"  class="action-txt"><i class="fa fa-external-link action"></i>مشاهدة</a>
                                </td>
                                
                                  <td colspan="3" style="border-left: 1px solid #cecece;text-align:center" >
                                  <span class="txt_mess">زود المبيعات</span>
                                  <span class="txt_mess">مشاركة الأعلان </span>
                                </td>

                              </tr>
                              <tr><td colspan="6s"><br></td></tr>
							 <?php }?>
                          </tbody>
                          </table>
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