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
      $this->db->update("products",array("views"=>((int)$views)+1),array('id'=> $tab_id));

      $data_conent["results"] =$this->db->get_where('products',array('id'=>$tab_id))->result(); 

      $count_fav =$this->db->get_where('reviews',array('id_course'=>$tab_id,'course_key'=>'2'))->result();
      $rate_count=(int)count($count_fav);
      $this->db->select_sum('rate');
      $this->db->from('reviews');
      $this->db->where("id_course=$tab_id");
      $query = $this->db->get();
       $final_rate=$query->row()->rate;
       if($rate_count>0){
        $main_rata_data['total_rate']= round($final_rate/$rate_count);
       }
       else {
        $main_rata_data['total_rate']=0;
       }
      $this->db->update("bag_info",$main_rata_data,array("id"=>$tab_id));
    
    $data_conent['site_info']=$this->db->get_where('site_info')->result();
    $this->load->view("index/include/head",$data );
    $this->load->view("index/include/header",$data );
    $this->load->view('details',$data_conent);
    $this->load->view("index/include/footer",$data);
    
    }


public function add(){
  if($this->session->userdata("admin_id")==""){
    redirect(base_url());
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
        redirect(base_url());
      }
      else {
      $customers_id=$this->session->userdata('admin_id');

    $id_code=(int)get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"id_code");
          $expired_package=get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"expire_date");
          $count_package_used=get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"count");
          $total_used=get_table_filed('codes',array('id'=>$id_code),"total_used");
          $time_days=get_table_filed('codes',array('id'=>$id_code),"time_days");
          
          $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
          if($expired_package<date("Y-m-d")){
          $data_pacakage['package_end']='1';
          $this->db->update("coustomer_code",$data_pacakage,array('id'=>$id_code));
          echo 2;
           }
          
          else if($total_used<=$count_package_used){
            $data_pacakage['package_end']='1';
            $this->db->update("coustomer_code",$data_pacakage,array('id'=>$id_code));
            echo 2;
           } 
              else {
                $data_pacakage['count']=$count_package_used+1;
                $this->db->update("coustomer_code",$data_pacakage,array('id'=>$id_code));  
                  
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
echo 1;
                            }
                          }
                        }
    
}


