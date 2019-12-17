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
  if($this->session->userdata("device_id")){
    $device_id=$this->session->userdata("device_id");
      $customer_id=get_customer_id_forent($device_id);    
    $this->db->where("(server_id=$customer_id OR send_id=$customer_id)");
    $query = $this->db->get('messages');
    $mychat_num=count($query->result());
  }
  else {
    $device_id=0;
  }


?>
<input type="hidden" value="<?= $device_id;?>" id="device_id">

<body class="404error_page">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="page"> 
  <!-- Offer banner -->

  <!-- Header -->
    <header id="header">
      <div class="header-container">
    
        <div class="container">
          <div class="row">

            <!-- Start Menu Area -->
            <div class="menu-area">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                   
                    <div class="main-menu">
                      <nav>
                      <div class="row">
                        <!-- Header Logo -->
                        <div class="logo col-lg-3 col-md-3 col-sm-4 col-xs-3">
                          <a title="e-commerce" href="<?= base_url()?>"><img alt="e-commerce" src="<?= DIR_DES_STYLE?>site_setting/<?= $site_info->logo?>">
                          </a>
                        </div>
                        
                        <!-- End Header Logo -->
                        <!-- Start Left Side -->
                        <div class="left_side col-lg-5 col-md-6 col-sm-7 col-xs-9">
                          <!--Start Add Your Adv.-->
                          <div class="add_adv">
                            <a href="#" data-toggle="modal" data-target="#myModal_popup">أضف إعلانك مجاناً !</a>
                            
                          </div>
                          <!--//End Add Your Adv.-->
                          <!--Start My Account-->
                          <div class="links">
                            <div class="jtv-user-info">
                            <?php if($this->session->userdata("device_id")!=""){?>
                              <div class="dropdown"> <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-user" aria-hidden="true"></i> <span>حسابى </span> <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="<?= base_url()?>account"><i class="fa fa-bullhorn" aria-hidden="true"></i> إعلاناتى</a></li>
                                  <li><a href="<?= base_url()?>account/my_msg"><i class="fa fa-comments" aria-hidden="true"></i> الرسائل 
<?php if($mychat_num>0){?><span>(<?= $mychat_num?>)</span><?php }?></a></li>
                                  <li><a href="<?= base_url()?>account/my_settings"><i class="fa fa-sliders" aria-hidden="true"></i> إعدادات الحساب</a></li>
                                  <li><a href="<?= base_url()?>account/logout"><i class="fa fa-power-off" aria-hidden="true"></i> تسجيل الخروج</a></li>
                                </ul>
                              </div>
                            <?php } else {?>

                              <div class="dropdown"> <a  href="<?= base_url();?>pages/"><i class="fa fa-user" aria-hidden="true"></i> <span>حسابى </span></a>
                              </div>
                            <?php }?>
                            </div>
                          </div>
                          <!--End My Account-->
                          <!--Start Icons Mobile Apps.-->
                          
                          <!--//End Icons Mobile Apps.-->
                        </div>
                        <!-- Start Left Side -->
                          </div>
                      </nav>
                    </div>
                    
                  
                  </div>

                </div>
              </div>
            </div>
            <!-- End Menu Area -->

          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="custom_popup modal fade" id="myModal_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">إختر التصنيف المناسب لإعلانك</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                 <?php 
                 foreach($cat as $cat){
                 ?>
                <div class="col-md-4 col-sm-6">
                  <div class="item_add">                    
                    <a href="<?= base_url()?>advertising/add">
<img src="<?= base_url()?>uploads/category/<?= $cat->icon?>" style="width:20px">
                      <span><?= $cat->name;?></span>
                    </a>
                  </div>
                </div> <!--//Item-->
                 <?php }?>
              </div>
            </div>

        
          </div>
        </div>
      </div>
      <div class="header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <!-- Search -->
<div class="row">
              <div class="top-search">
                <div id="search">
                  <form>
                    <div class="input-group">
                      <select class="cate-dropdown col-lg-5 col-md-5 col-sm-12 col-xs-12" name="category_id">
                        <option value="0">كل التصنيفات</option>
              <?php
              foreach($search_cat as $search_cat){
              ?>
                        <option value="<?= $search_cat->id?>"><?= $search_cat->name?></option>
              <?php }?>
                      </select>
                      <select class="cate-dropdown col-lg-5 col-md-5 col-sm-12 col-xs-12" name="area_id">
                        <option value="0">كل المدن</option>
                        <?php
              foreach($city as $city){
              ?>
                        <option value="<?= $city->id;?>"><?= $city->name;?></option>
              <?php }?>
                      </select>
                      <button class="btn-search" type="button"><i class="fa fa-search"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
      </div>

              <!-- End Search -->
            </div>

          </div>
        </div>
      </div>
  </div>
  </header>