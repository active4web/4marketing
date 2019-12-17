<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Cat extends MX_Controller {
    function __construct() {

		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
		@date_default_timezone_set('Asia/Riyadh');
    }


    public function index(){
      redirect(base_url().'cat/grid?ID='.$this->input->get("ID"),'refresh');
  }


  


  function subcategory(){
    $tables = "products";
    $ID=base64_decode($this->input->get("ID"));
    $id_cat=get_table_filed('department',array('id'=>$ID),"id_cat");
    $arrange=$this->input->get("arrange");
    $featured=$this->input->get("featured");
    if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
    else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
    else {$arr="id";$arr_type="asc";}

    if($featured==""||$featured=="yes"){
      $total=$this->db->get_where($tables,array('special'=>'1','dep_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
      $arr_condition= array('special'=>'1','dep_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
        if(count($total)==0){$arr_condition= array('dep_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');}
  
      }
      else{
       // $featured_val='0';
        $arr_condition= array('dep_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
      }

    $config = array();
    $config['base_url'] = base_url().'cat/subcategory'; 
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
$data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id!='=>$ID,'id_cat'=>$id_cat))->result(); 
else:
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['result_count'] =$this->db->get_where($tables,$arr_condition)->result(); 
$data_conent["results"] = $this->data->view_all_data($tables,$arr_condition, $config["per_page"], $page,$arr,$arr_type);

$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
$data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id!='=>$ID,'id_cat'=>$id_cat))->result(); 
$str_links = $this->pagination->create_links();
$data_conent["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('subcategory',$data_conent);
$this->load->view("index/include/footer",$data);
  }



  function grid(){
    $tables = "products";
    $ID=base64_decode($this->input->get("ID"));
    
    $arrange=$this->input->get("arrange");
    $featured=$this->input->get("featured");
    if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
    else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
    else {$arr="id";$arr_type="asc";}

    if($featured==""||$featured=="yes"){
      $total=$this->db->get_where($tables,array('special'=>'1','cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
      $arr_condition= array('special'=>'1','cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
        if(count($total)==0){$arr_condition= array('cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');}
  
      }
      else{
       // $featured_val='0';
        $arr_condition= array('cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
      }

    $config = array();
    $config['base_url'] = base_url().'cat/grid'; 
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
$data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id_cat'=>$ID))->result(); 
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
$data_conent['dep'] =$this->db->get_where('department',array('view'=>'1','id_cat'=>$ID))->result(); 
$str_links = $this->pagination->create_links();
$data_conent["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('lisiting',$data_conent);
$this->load->view("index/include/footer",$data);
  }


  function list(){
    $tables = "products";
    $ID=base64_decode($this->input->get("ID"));
    
    $arrange=$this->input->get("arrange");
    $featured=$this->input->get("featured");
    if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
    else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
    else {$arr="id";$arr_type="asc";}
    if($featured==""||$featured=="yes"){
    $total=$this->db->get_where($tables,array('special'=>'1','cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
    $arr_condition= array('special'=>'1','cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
      if(count($total)==0){$arr_condition= array('cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');}

    }
    else{
     // $featured_val='0';
      $arr_condition= array('cat_id'=>$ID,'delete_key'=>'1','expired_date'=>'1','view'=>'1');
    
    }


   
    $config = array();
    $config['base_url'] = base_url().'cat/list'; 
    $config['total_rows'] = $this->data->record_count($tables,$arr,'',$arr_condition,$arr_type);
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

$str_links = $this->pagination->create_links();
$data_conent["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('list',$data_conent);
$this->load->view("index/include/footer",$data);
  }
  

  



  function all_lisit(){
    $tables = "products";
    $ID=base64_decode($this->input->get("ID"));
    
    $arrange=$this->input->get("arrange");
    if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
    else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
    else {$arr="id";$arr_type="asc";}
    $config = array();
    $config['base_url'] = base_url().'cat/all_lisit'; 
    $config['total_rows'] = $this->data->record_count($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'),'',$arr,$arr_type);
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
$data_conent['result_count'] =$this->db->get_where($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
else:
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['result_count'] =$this->db->get_where($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
$data_conent["results"] = $this->data->view_all_data($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'), $config["per_page"], $page,$arr,$arr_type);

$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 

$str_links = $this->pagination->create_links();
$data_conent["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('all_lisit',$data_conent);
$this->load->view("index/include/footer",$data);
  }


  function all(){
    $tables = "products";
    $ID=base64_decode($this->input->get("ID"));
    $arrange=$this->input->get("arrange");
    if($arrange!="" &&$arrange=="heigh_price"){$arr="price"; $arr_type="desc";}
    else if($arrange!="" &&$arrange=="low_price"){$arr="price";$arr_type="asc";}
    else {$arr="id";$arr_type="asc";}
    $config = array();
    $config['base_url'] = base_url().'cat/all'; 
    $config['total_rows'] = $this->data->record_count($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'),'',$arr,$arr_type);
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
$data_conent['result_count'] =$this->db->get_where($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
else:
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['result_count'] =$this->db->get_where($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
$data_conent["results"] = $this->data->view_all_data($tables,array('delete_key'=>'1','expired_date'=>'1','view'=>'1'), $config["per_page"], $page,$arr,$arr_type);

$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 

$str_links = $this->pagination->create_links();
$data_conent["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('all',$data_conent);
$this->load->view("index/include/footer",$data);
  }

  
function bags_details(){
  $tab_id=$this->uri->segment(3);
  $data_conent["results"] =$this->db->get_where('bag_info',array('view'=>'1','id'=>$tab_id))->result(); 
  $data_conent["course_info"] =$this->db->get_where('course_info',array('id_course'=>$tab_id))->result(); 
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
   


$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info']=$this->db->get_where('site_info')->result();
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('bags_details',$data_conent);
$this->load->view("index/include/footer",$data);

}


    
    

}


