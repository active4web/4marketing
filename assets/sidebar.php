<?php
$curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_id = $this->uri->segment(4);

?>


 <div class="sidebar">           
            <ul>
<li <?php if(($controller_curt ==''||$controller_curt =='archive')&&$main_curt=="account"){?>class="current" <?php }?>><a href="<?= base_url()?>account/"><i class="fa fa-bullhorn" aria-hidden="true"></i> إعلاناتى</a></li>
<li <?php if($controller_curt =='message'||$controller_curt =='send_message'||$controller_curt =='archive'||$controller_curt =='archive'||$controller_curt =='send'||$controller_curt ==''&&$main_curt=="messages"){?>class="current" <?php }?>><a href="<?= base_url()?>messages"><i class="fa fa-comments" aria-hidden="true"></i> الرسائل</a></li>
<li <?php if(($controller_curt =='ticket'||$controller_curt =='technical_support')&&$main_curt=="profile"){?>class="current" <?php }?>><a href="<?= base_url()?>profile/technical_support"><i class="fa fa-support" aria-hidden="true"></i> الدعم الفنى</a></li>
<li><a href="my_balance.html"><i class="fa fa-money" aria-hidden="true"></i> الرصيد الاعلانى </a></li>
<li <?php if($controller_curt =='favorite'&&$main_curt=="profile"){?>class="current" <?php }?>><a href="<?= base_url()?>profile/favorite"><i class="fa fa-heart" aria-hidden="true" style="margin-left:5px"></i>المفضلة</a></li>
<li <?php if($controller_curt ==''&&$main_curt=="profile"){?>class="current" <?php }?>><a href="<?= base_url()?>profile"><i class="fa fa-user" aria-hidden="true"></i> إعدادات الحساب</a></li>
<li <?php if($controller_curt =='changepassword'&&$main_curt=="profile"){?>class="current" <?php }?>><a href="<?= base_url()?>profile/changepassword"><i class="fa fa-key" aria-hidden="true" style="margin-left:5px"></i>تغير كلمة السر</a></li>       
<li><a href="<?= base_url()?>account/logout"><i class="fa fa-lock" aria-hidden="true"></i> تسجيل الخروج</a></li>
            </ul>
          </div>