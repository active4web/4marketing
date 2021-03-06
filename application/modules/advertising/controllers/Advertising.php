<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Advertising extends MX_Controller {
    function __construct() {

		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
		@date_default_timezone_set('Asia/Riyadh');
    }


    public function index(){
      $tab_id=$this->uri->segment(3);
      redirect(base_url().'advertising/details/'.$tab_id,'refresh');
  }


  
    public function details(){
      $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 

      $tab_id=base64_decode($this->input->get("ID"));

      $views=get_table_filed('products',array("id"=>$tab_id),"views");
      $cat_id=get_table_filed('products',array("id"=>$tab_id),"cat_id");
      $this->db->update("products",array("views"=>((int)$views)+1),array('id'=> $tab_id));
      $data_contact["results"] =$this->db->get_where('products',array('id'=>$tab_id))->result(); 
      $data_contact["images"] =$this->db->get_where('images',array('id_products'=>$tab_id))->result(); 

      $data_contact['related_products']=$this->db->order_by("id","desc")->limit(10)->get_where('products',array('id!='=>$tab_id,'cat_id'=>$cat_id))->result();
    $data_contact['site_info']=$this->db->get_where('site_info')->result();
    $this->load->view("index/include/head",$data );
    $this->load->view("index/include/header",$data );
    $this->load->view('details',$data_contact);
    $this->load->view("index/include/footer",$data);
    
    }


public function add(){
  if($this->session->userdata("admin_id")==""){
    redirect(base_url()."pages");
  }
  else {
  $customer_id=$this->session->userdata('admin_id');
  $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $data_contact['site_info']=$this->db->get_where('site_info')->result();
  $data_contact['city'] =$this->db->get_where('city',array("view"=>'1'))->result(); 
  $data_contact['currency'] =$this->db->get_where('currency',array("view"=>'1'))->result(); 
  $data_contact['category'] =$this->db->get_where('category',array("view"=>'1'))->result(); 
  $data_contact['customers'] =$this->db->get_where('customers',array("view"=>'1','id'=>$customer_id))->result(); 

  $this->load->view("index/include/head",$data );
    $this->load->view("index/include/header",$data );
    $this->load->view('add',$data_contact);
    $this->load->view("index/include/footer",$data);
  }
    
    }

    public function add_action(){
      if($this->session->userdata("admin_id")==""){
        echo 3;
      }
      else {
      $customers_id=$this->session->userdata('admin_id');

   $code_t=get_row("coustomer_code",array('id_customer'=>$customers_id,'package_end'=>'0'),1,"id","desc");
   if(count($code_t)>0){
     foreach($code_t as $code_t)
   $id_code=$code_t->id_code;
   $customer_code=$code_t->id;
   $expired_package=$code_t->expire_date;
   $count_package_used=$code_t->count;
   $total_used=get_table_filed('codes',array('id'=>$id_code),"total_used");
   $time_days=get_table_filed('codes',array('id'=>$id_code),"time_days");
   $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
   if($expired_package<date("Y-m-d")){
          $data_pacakage['package_end']='1';
          $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));
          echo 2;
           }
          
          else if($total_used<=$count_package_used){
            $data_pacakage['package_end']='1';
            $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));
            echo 2;
           } 
              else {
                $data_pacakage['count']=$count_package_used+1;
                $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));  
                  
                      $store = [
                                'user_id'          	=> $customers_id,
                                'name'              =>$this->input->post('title'),
                                'details'           => $this->input->post('comment'),
                                'cat_id'            => $this->input->post('category'),
                                'dep_id'            => $this->input->post('dep_id'),
                                'currency_id'          => $this->input->post("courrency"),
                                'city_id'           => $this->input->post('city_id'),
                                'date_title'        => gen_month_name(date('m')),
                                'price'             =>$this->input->post('price'),
                                'creation_date'     => date('Y-m-d'),
                                'special'           =>$this->input->post('adv_type'),
                                'delete_key'        =>'1',
                                'expired_date'      =>'1',
                                 'view'             =>'0',
                                'expired_date_Val'  =>$expire_date,
                                'user_phone'        =>$this->input->post('phone'),
                                'user_email'        =>$this->input->post('email')
                              ];
                              $insert = $this->db->insert('products',$store);
                             $id= $this->db->insert_id();
if($id!=""){
                             if(isset($_FILES['img']['name'])){
                              $file=$_FILES['img']['name'];
                              $file_name="img";
                              get_img_config_course('products','/uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450");
                     get_img_config_insert('images','/uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,1);
                              }           
                
                if(isset($_FILES['img1']['name'])){
                $file=$_FILES['img1']['name'];
                $file_name="img1";
                get_img_config_insert('images','/uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,2);
                }  
                
                if(isset($_FILES['img2']['name'])){
                $file=$_FILES['img2']['name'];
                $file_name="img2";
                get_img_config_insert('images','/uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,3);
                }
send_email($id,"user","add_advertising");                
echo 1;
              }
              else {echo 2;}
                            }
                          }
                          else {echo 2;}
                        }
                        
 }
    



    function search(){
      $tables = "products";
      $cat_id=$this->input->get("category_id");
      $dep_id=$this->input->get("dep_id");
      $area_id=$this->input->get("area_id");
      $arr_condition['delete_key']='1';
      $arr_condition['expired_date']='1';
      $arr_condition['view']='1';

if($cat_id!=""){
  $arr_condition['cat_id']=$cat_id;
}
if($area_id!=""){
  $arr_condition['city_id']=$area_id;
}
if($dep_id!=""){
  $arr_condition['dep_id']=$dep_id;
}
//print_r($arr_condition) ;
//die();
      $arrange=$this->input->get("arrange");

      if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
      else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
      else {$arr="id";$arr_type="desc";}
      $config = array();
      $config['base_url'] = base_url().'advertising/search'; 
      $config['total_rows'] = $this->data->record_count($tables,$arr_condition,'',$arr,$arr_type);
      $config['per_page'] =33;
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';   
      $config['last_link'] = '»»';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['first_link'] = '««';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = 'السابق';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'التالى';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active" style="padding:0px"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
      $this->pagination->initialize($config);
  if($this->uri->segment(3)){
  $page = ($this->uri->segment(3)) ;
  }
  else{
  $page =0;
  }
  
  $rs = $this->db->get($tables);
  if($rs->num_rows() == 0):
  $data_conent["results"] = array();
  $data_conent["links"] = array();
  $data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data_conent['result_count'] =$this->db->get_where($tables,$arr_condition)->result(); 

  $data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id_cat'=>$cat_id))->result(); 
  else:
  $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
  $data_conent['result_count'] =$this->db->get_where($tables,$arr_condition)->result(); 
  $data_conent["results"] = $this->data->view_all_data($tables,$arr_condition, $config["per_page"], $page,$arr,$arr_type);
  //echo $this->db->last_query();
  //die();
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id_cat'=>$cat_id))->result(); 
  $str_links = $this->pagination->create_links();
  $data_conent["links"] = explode('&nbsp;',$str_links);
  endif;
  $this->load->view("index/include/head",$data );
  $this->load->view("index/include/header",$data );
  $this->load->view('search',$data_conent);
  $this->load->view("index/include/footer",$data);
  
  }
}


