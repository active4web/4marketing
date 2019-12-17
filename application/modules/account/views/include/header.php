</head>
<body>	

<?php


		$day_d=date('d');
		$month_d=date('m'); 
		$year_d=date('Y'); 
		$ip=$this->input->ip_address();
		$customer_id = $this->data->get_table_row('visiting',array('ip'=>$ip,'day_t'=>$day_d,'month_d'=>$month_d,'year_d'=>$year_d),'id');
		if($customer_id!=""){
		$visit_num = $this->data->get_table_row('visiting',array('ip'=>$ip,'day_t'=>$day_d,'month_d'=>$month_d,'year_d'=>$year_d),'visit_num');
		$data['visit_num']=$visit_num+1;
		
		$this->db->update('visiting',$data,array('ip'=>$ip,'day_t'=>$day_d,'month_d'=>$month_d,'year_d'=>$year_d));
		}
		else {
		$data['ip']=$ip;
		$data['day_t']=$day_d;
		$data['month_d']=$month_d;
		$data['year_d']=$year_d;
		$data['visit_num']=1;
		$data['date']=$year_d."-".$month_d."-".$day_d;;
		$this->db->insert('visiting',$data);
		}

$curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_id = $this->uri->segment(4);
$this->session->set_userdata(array('curt' => $curt));
$this->session->set_userdata(array('curt_id' => $curt_id));
//echo "dfgfdg".$controller_curt;
  foreach($site_info as $site_info)
?>

<div class='preloader w-100 h-100 position-fixed'>
        <div class="loader">
            <img class="icon"  src="<?=base_url()?>assets/img/preloader.png" alt="">
        </div>
    </div>

    <header class="header fixed-top">
        <!-- Header Style One Begin -->
        <div class="fixed-top header-main style--one">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-sm-4 col-4" style="text-align:right;">
                        <!-- Logo Begin -->
                        <div class="logo">
                            <a href="<?= DIR ?>index">
                                <img class="default-logo" src="<?=DIR_DES_STYLE?>site_setting/<?= $site_info->logo;?>" data-rjs="2" alt="الكورسات ودورات">
                                <img class="sticky-logo" src="<?=DIR_DES_STYLE?>site_setting/<?= $site_info->logo;?>" data-rjs="2" alt="دورات">
                            </a>
                        </div>
                        <!-- Logo End -->
                    </div>

                    <div class="col-lg-10 col-sm-8 col-8" style="padding-left:0px;padding-right:0px">
                        <!-- Main Menu Begin -->
                        <div class="main-menu d-flex align-items-center justify-content-end">
<ul class="nav align-items-center" style="padding-right:0px">
<li class="menu-item-has-children <?php if($curt==""||$curt=="diplomas"||$curt=="bags"||$curt=="allbags"||$curt=="dawrat_list"||$curt=="dawrat"||$curt=="courses_details"||$curt=="bags_details"||$curt=="diplomas_details"||$curt=="trainer_details"){?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user">الرئيسية</a>
                                   
								</li>
								<?php
								if($this->session->userdata("user_type")==1){

								?>
                                <li class="<?php if($curt=="myrequested"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/request/myrequested">طلباتى
                                </a>
								</li>
								<?php }  	if($this->session->userdata("user_type")==3){?>
                                <li class="<?php if($curt=="add_new"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/bags/add_new">اضافة حقيبة
								</a></li>
								<?php }  	if($this->session->userdata("user_type")==4){?>
                                <li class="<?php if($curt=="add_new"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/company/add_new">اضافة دورة
								</a></li>
								<?php }?>

                                <li class="<?php if($curt=="reward"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/home/reward">مكافأتى</a>
								</li>
								
                                <li class="<?php if($curt=="share"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/profile/share">مشاركة مع الأصدقاء</a>
                                  
                                </li>
                                <li class="<?php if($curt=="supporting"||$curt=="new_ticket"){ ?>current-menu-parent<?php }?>">
                                    <a href="<?= base_url()?>user/home/supporting/">الدعم الفنى</a>
                                  
                                </li>
                       
                                
                            </ul>
                            
                            <!-- Offcanvas Holder Trigger -->
                          
							<!-- Offcanvas Trigger End -->
							<?php if($this->session->userdata("user_type")==1){?>
                             <a href="<?= base_url()?>user/search/advanced_search" class="mainheader searchbutton" style="margin-left: 25px;"><span style="padding:0px 15px 0px 15px;color:#367cff"><i class="fa fa-search"></i> بحث متقدم</span></a>
							<?php }?>

<div class="mobile" style="display:none;position:absolute;left:0px;">

<a href="<?=base_url()?>user/notification/view_notification" style="margin-right:7px;position: relative;" class="header_icon"><i class="fa fa-bell"></i>
<?php
if(get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),"notifications_num")>0){  ?>
<span class="badge badge-danger total_notification notfy_bell"><?= get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),"notifications_num");?> </span>
</a>
<?php }?> 
<?php if($this->session->userdata("user_type")==1){?>
<a href="<?=base_url()?>user/profile/myaccount" style="margin-right:7px;margin-left:7px;position: relative;" ><i class="fa fa-heart"></i>
<?php if(count(get_favourites($this->session->userdata("customer_id")))>0){  ?>
<span class="badge badge-danger total_notification notfy myfavourites"><?=count(get_favourites($this->session->userdata("customer_id")));?> </span><?php }?>
</a>
<?php  }?>

<a href="<?=base_url()?>user/profile/myaccount" style="margin-right:7px;margin-left:7px" ><i class="fa fa-user"></i> </a>
</div>
							
							 
<ul class="nav align-items-center" style="padding-right:0px;position:absolute;left:-90px;">
							 <li class="menu-item-has-children has-sub-item"><span class="submenu-button"></span>
                                    <a href="#" style="line-height:50px"><i class="fa fa-bell"></i>
									<?php
								if(get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),"notifications_num")>0){  ?>
<span class="badge badge-danger total_notification notfy_bell"><?= get_table_filed('customers',array('id'=>$this->session->userdata("customer_id")),"notifications_num");?> </span>
<?php }?>
									</a>
                                    <ul class="sub-menu scrollbar" id="style-7">
										<?php
										if(count(get_notifactions($this->session->userdata("customer_id")))>0){
											$main_nofiy=get_notifactions($this->session->userdata("customer_id"));
											foreach($main_nofiy as $main_nofiy){
										
				if($main_nofiy->course_key==2&&$main_nofiy->course_id!=""&&$main_nofiy->course_key!=""){
				$course_name=get_table_filed('bag_info',array('id'=>(int)$main_nofiy->course_id),"bage_name");
				$img =get_table_filed('bag_info',array('id'=>(int)$main_nofiy->course_id),"img");
				if($img!=""){
				$image=base_url()."uploads/products/".$img;
				}
				else {
				$image=base_url()."uploads/products/no_img.png";
				}  
				}
				else if($main_nofiy->course_key!=2&&$main_nofiy->course_id!=""&&$main_nofiy->course_key!=""){
				$course_name =get_table_filed('products',array('id'=>(int)$main_nofiy->course_id),"name"); 
				$img =get_table_filed('products',array('id'=>(int)$main_nofiy->course_id),"img");
				if($img!=""){
				$image=base_url()."uploads/products/".$img;
				}
				else {
				$image=base_url()."uploads/products/no_img.png";
				}  	
				}
				if($main_nofiy->type!=1) {
					$image=base_url()."uploads/site_setting/nofication.png";
				}
			
				?>
                <li>
<div class="row" style="margin:0px">
<div class="col-2 main_previw"><img src="<?=$image?>" style="width:60px; height:50px;"></div>
<div class="col-10 main_previw">
<div class="row" style="margin:0px">
<div class="col-8 main_previw"><?= mb_substr($main_nofiy->title,0,80)?></div>
	<div class="col-4 main_previw"><?= $main_nofiy->creation_date?></div>
	<div class="col-12 main_previw"><?= mb_substr($main_nofiy->description,0,80)?></div>
</div>
</div>
	

	
	<div class="col-12"><hr style="width:100%"></div>
</div>

				</li>
											<?php }?>
			<li style="text-align:center">
			<span><a href="<?=base_url()?>user/notification/view_notification"> مشاهدة الكل <i class="fa fa-eye"></i></a></span>	
		</li>
											<?php }?>
                                    </ul>
								</li>
								<?php if($this->session->userdata("user_type")==1){?>
								<li class="menu-item-has-children has-sub-item"><span class="submenu-button"></span>
                                    <a href="#"><i class="fa fa-heart"></i><?php
								if(count(get_favourites($this->session->userdata("customer_id")))>0){  ?>
<span class="badge badge-danger total_notification notfy myfavourites"><?=count(get_favourites($this->session->userdata("customer_id")));?> </span>
<?php }?></a>

								</li>
								<?php }?>
								<li class="menu-item-has-children has-sub-item">
								<span class="submenu-button"></span>
								<?php
									$myimg=$this->session->userdata("myimg");
									if($myimg==""){$main_img="no_img.png";}
									else {$main_img=$myimg;}
								?>
                                    <a href="#" style="line-height:70px"><img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img_header" >
									<span style="font-size:12px;position: relative;top:25px;right:-60px;"><i class="fa fa-chevron-down" style="margin-left:8px"></i><?= substr($this->session->userdata("admin_name"),0,8);?></span>
									</a>
									<ul class="sub-menu" style="text-align:right;width:330px">
									<li>
<div class="row" style="margin:0px">
		<div class="col-md-12">
			<img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img_trainer" 
			style="float:right;width: 85px;height: 80px;">
		<p style="margin-top:30px;margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_name"),0,50);?></p>
		<p style="margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_email"),0,50);?></p>
	</div>
</div>
<hr style="width:100%;margin-bottom:6px;margin-top:6px">
	

	


									</li>
										<li style="padding-bottom:10px"><a href="<?=base_url()?>user/profile/myaccount"> <i class="fa fa-user"></i> حسابى</a></li>
										<?php
										$pages_value=$this->db->get_where("pages",array('active'=>'1','key_txt!='=>'Points','key_txt!='=>'terms',"flag"=>$this->session->userdata("user_type")))->result();
										if(count($pages_value)>0){
										foreach($pages_value as $pages_value){
										?>
				<li style="padding-bottom:10px"><a href="<?=base_url()?>user/profile/pages/<?= $pages_value->id?>"><i class="fa fa-info-circle"></i> <?= mb_substr($pages_value->title,0,30);?> </a></li>
										<?php } }?>
                                        <li style="padding-bottom:10px"><a href="<?=base_url()?>user/profile/logout"><i class="fa fa-sign-out-alt"></i> تسجيل الخروج </a></li>
                                    </ul>
                                </li>


</ul>

                        </div>
                       
                        <!-- Main Menu ENd -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Style One End -->
    </header>
    <!-- Header End -->
	  