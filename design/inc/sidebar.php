        <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start <?php if($curt=='home'){echo'active open';}?>">
                        <a href="<?=$url;?>admin" class="nav-link ">
                            <i class="icon-home"></i>
                                        <span class="title">لوحة التحكم</span>
                                        <span class="selected"></span>
                                    </a>
                    </li>
<?
$reply_counts=$this->db->get_where("tickets",array("status_id"=>'0'))->result();
$users_accounts=$this->db->get_where("customers")->result();
$products_accounts=$this->db->get_where("products",array("view"=>'0'))->result();
$payments_accounts=$this->db->get_where("soical_advertising",array("view"=>'0'))->result();
$total_new_message=$this->db->get_where("messages",array("watch_admin"=>'0','id_reply'=>'0'))->result();
$payments_accounts_only=$this->db->get_where("bank_accounts_forms",array("status"=>'0'))->result();
$social_archive=$this->db->get_where("soical_advertising",array("view"=>'1','status'=>'1'))->result();
?>
	<li class="nav-item start <?php if($curt=='setting'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
								<span class="title">الاعدادات <span style="color:red" class="ticket_nofiy"><? if(count($reply_counts)>0){echo "(".count($reply_counts).")"; };?></span></span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
                                <li class="nav-item  <?php if($curt=='setting'){echo'active open';}?>">
                              
                                    <a href="<?=base_url()?>admin/setting" class="nav-link ">
                                        <span class="title">الاعدادات</span>
                                    </a>
                                </li>
							 <li class="nav-item <?php if($curt=='services'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/services/" class="nav-link ">
                                        <i class="fa fa-file"></i>
                                        <span class="title">التصنيفات</span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($curt=='department'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/department/" class="nav-link ">
                                        <i class="fa fa-file"></i>
                                        <span class="title">الأقسام الفرعية</span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($curt=='currency'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/currency/" class="nav-link ">
                                        <i class="fa fa-file"></i>
                                        <span class="title">العملات</span>
                                    </a>
                                </li>
							
							 <li class="nav-item  <?php if($curt=='tickets'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/tickets_types/" class="nav-link ">
                                        <i class="icon-envelope"></i>
                                        <span class="title">انواع التذاكر</span>
                                    </a>
								</li>
								
                                <li class="nav-item  <?php if($curt=='tickets'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/tickets/" class="nav-link ">
                                        <i class="icon-envelope"></i>
                                        <span class="title">التذاكر <span style="color:red" class="ticket_nofiy"><? if(count($reply_counts)>0){echo "(".count($reply_counts).")"; };?></span></span>
                                    </a>
								</li>
								
 <li class="nav-item  <?php if($curt=='package'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/codes/user_codes" class="nav-link ">
                                        <i class="icon-note"></i>
                                        <span class="title">الباقات</span>
                                    </a>
								</li>
							
                                 
                            </ul>
                    </li>
                    
                    

                      
<li class="nav-item start <?php if($curt=='team_work'){echo'active open';}?>">
<a href="<?=$url;?>admin/team_work" class="nav-link ">
<i class="icon-users"></i>
<span class="title">المشرفين</span>
<span class="selected"></span>
</a>
</li>
				
<li class="nav-item start <?php if($curt=='homepage'){echo'active open';}?>">
<a href="<?=$url;?>admin/pages/steps" class="nav-link ">
<i class="fa fa-photo"></i>
<span class="title">المساحات الاعلانية</span>
<span class="selected"></span>
</a>
</li>

					
                    
                    	<li class="nav-item start <?php if($curt=='places'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
								<span class="title">الأماكن</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
							
							<li class="nav-item  ">
							
								<a href="<?=base_url()?>admin/places/cities" class="nav-link">
                                <i class="icon-eye"></i>
									<span class="title">المدن</span>
								</a>
							</li>
							</ul>
                    </li>
                    
                                        
                      <li class="nav-item start <?php if($curt=='customers'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-users"></i>
								<span class="title">العضويات 
					<span style="color:red" class="user_nofiy"><? if(count($users_accounts)>0){echo "(".count($users_accounts).")"; };?></span>
								</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
                            <li class="nav-item">
                                    <a href="<?=base_url()?>admin/users/customers" class="nav-link ">
                                        <i class="icon-users"></i>
                                        <span class="title">العضويات <span style="color:red" class="user_nofiy"><? if(count($users_accounts)>0){echo "(".count($users_accounts).")"; };?></span></span>
                                    </a>
								</li>

                               
								

                                </ul>
                    </li>
                    
                    
                    
                      <li class="nav-item start <?php if($curt=='courses'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-opencart"></i>
                                <span class="title">الاعلانات</span>
                                <span style="color:red" class="products_notifation"><? if(count($products_accounts)>0){echo "(".count($products_accounts).")"; };?></span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
                            <li class="nav-item">
                                    <a href="<?=base_url()?>admin/courses/inside" class="nav-link ">
                                        <i class="fa fa-opencart"></i>
                                        <span style="color:red" class="products_notifation"><? if(count($products_accounts)>0){echo "(".count($products_accounts).")"; };?></span>
                                        <span class="title">الاعلانات </span>
                                    </a>
								</li>

                             <li class="nav-item">
                                    <a href="<?=base_url()?>admin/courses/advertising_deleted" class="nav-link ">
                                        <i class="fa fa-trash"></i>
                                        <span class="title">الأعلانات المحذوفة </span>
                                    </a>
								</li>
								                        

                                </ul>
                    </li>
                    
		
                               
						

<li class="nav-item start <?php if($curt=='payment_type'||$curt=='bank_accounts'||$curt=='bank_payments'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-credit-card"></i>
								<span class="title">الحسابات
		<span style="color:red" class="banks_nofiy"><? if((count($payments_accounts)+count($payments_accounts_only))>0){echo "(".(count($payments_accounts)+count($payments_accounts_only)).")"; };?></span>							
								</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
							    
							    	
						 <li class="nav-item  <?php if($curt=='bank_accounts'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/banks/bank_accounts" class="nav-link ">
                                        <i class="fa fa-credit-card"></i>
                                        <span class="title"> الحسابات البنكية</span>
                                    </a>
								</li>
								
									 <li class="nav-item  <?php if($curt=='bank_payments'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/banks/bank_payments" class="nav-link ">
                                        <i class="fa fa-credit-card"></i>
                                        <span class="title"> الدفع البنكى 
  <span style="color:red" class="bank_payments"><? if(count($payments_accounts_only)>0){echo "(".count($payments_accounts_only).")"; };?></span>                                      
                                    </span>
                                    </a>
								</li>
								
								<li class="nav-item  <?php if($curt=='social'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/banks/requested_courses" class="nav-link ">
                                        <i class="fa fa-cart-plus"></i>
                                        <span class="title">طلبات الحملات الاعلانية
                 <span style="color:red" class="banks_nofiy"><? if(count($payments_accounts)>0){echo "(".count($payments_accounts).")"; };?></span>                       
                                        
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item  <?php if($curt=='social_archive'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/banks/social_archive" class="nav-link ">
                                        <i class="fa fa-cart-plus"></i>
                                        <span class="title">ارشيف الحملات الاعلانية
                 <span style="color:red" class="banks_nofiy"></span>                       
                                        
                                        </span>
                                    </a>
								</li>

                                
							</ul>
                    </li>



                      <li class="nav-item start <?php if($curt=='pages'){echo'active open';}?>">
						<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-info"></i>
								<span class="title">صفحات فرعية</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
                            <li class="nav-item">
                                    <a href="<?=base_url()?>admin/pages/" class="nav-link ">
                                        <i class="icon-notebook"></i>
                                        <span class="title">الصفحات الفرعية</span>
                                    </a>
                                </li>

                                <li class="nav-item <?php if($curt=='faq'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/pages/terms" class="nav-link ">
                                        <i class="icon-question"></i>
                                        <span class="title">صفحات الشروط والأحكام</span>
                                    </a>
                                </li>
							
                                
						
                            </ul>
                    </li>


								<li class="nav-item  <?php if($curt=='update_contact'){echo'active open';}?>">
                                    <a href="<?=base_url()?>admin/messages" class="nav-link ">
                                        <i class="icon-call-end"></i>
                                        <span class="title">رسائل الأعلانات</span>
                                          <span style="color:red" class="total_messages_notifation"><? if(count($total_new_message)>0){echo "(".count($total_new_message).")"; };?></span>
                                    </a>
                                </li>
                             	
                            </ul>
                        </li>
                        
                            </ul>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
