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
}


