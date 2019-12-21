<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Account extends MX_Controller {

    function __construct() {
		parent::__construct();
        $this->db->order_by('id', 'DESC');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('data','','true');
		$this->load->library('lib_pagination');

    }



	public function index(){
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
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['active'] =$this->db->order_by("id","desc")->get_where('products',array("user_id"=>$customer_id,'expired_date'=>'1','delete_key'=>'1'))->result(); 
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("current", $data_conent); 
$this->load->view("index/include/footer",$data);
		}
	}  
	
	public function archive(){
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
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$this->db->where('user_id',$customer_id);
$this->db->where("(delete_key='0' OR expired_date='0')");
$this->db->order_by("id","desc");
$query = $this->db->get('products');
$data_conent['active'] =$query->result();
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("archive", $data_conent); 
$this->load->view("index/include/footer",$data);
		}
    } 

	

	public function logout(){
		unset($_SESSION['admin_id']);
		unset($_SESSION['device_id']);
	 unset($_SESSION['admin_email']);
	 unset($_SESSION['admin_name']);
	 unset($_SESSION['admin_phone']);
	 redirect(base_url());
	}


	function add_new() {
		if($this->session->userdata("customer_id")==""){
			redirect(base_url()."index");
		}		
	else {
		$customer_id=$this->session->userdata("customer_id");
		$data_contant['customers'] =$this->db->get_where('customers',array("id"=>$customer_id))->result(); 
		$data_contant['category']=$this->db->get_where('category',array("view"=>'1'))->result();
		$data_contant['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1'))->result();
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
     	$this->load->view('index/include/head',$data );
	    $this->load->view('include/header',$data );
	    $this->load->view('add_new',$data_contant);
	    $this->load->view('index/include/footer',$data);  
	}
	}


	


	 function fav_action(){
		
		$device_id=$this->session->userdata("device_id");
		$customer_id=get_customer_id_forent($device_id); 

	
		$advertising_ID=$this->input->post('advertising_ID');
		$data_fav['user_id']=$customer_id;
		$data_fav['course_id']=$advertising_ID;
		$data_fav['creation_date']=date("Y-m-d");
		$id_fav=get_table_filed('favourites',array("course_id"=>$advertising_ID,'user_id'=>$customer_id),"id");
if($id_fav!=""){
	echo 2;
	$this->db->delete("favourites",array("id"=>$id_fav));
}
else {$this->db->insert("favourites",$data_fav);echo 1;}
		
	}



	  


	  public function edit_dawrat(){

			if($this->session->userdata("customer_id")==""){
				redirect(base_url()."index");
			}		

		$tab_id=$this->uri->segment(4);

		$cat_id=get_table_filed('products',array("id"=>$tab_id),"cat_id");
		$city_id=get_table_filed('products',array("id"=>$tab_id),"city_id");
		$cat_name=get_table_filed('category',array("id"=>$cat_id),"name");
		$city_name=get_table_filed('city',array("id"=>$city_id),"name");
		$data_conent["results"] =$this->db->get_where('bag_info',array('view'=>'1','id'=>$tab_id))->result(); 
		$data_conent["course_info"] =$this->db->get_where('course_info',array('id_course'=>$tab_id))->result(); 
		$data_conent["bag_info"] =$this->db->get_where('products',array('id'=>$tab_id))->result(); 
		$data_conent['category']=$this->db->get_where('category',array("view"=>'1','id!='=>	$cat_id))->result();
		$data_conent['institute']=$this->db->get_where('Institute',array('id_course'=>	$tab_id))->result();
		$data_conent['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1','id!='=>	$city_id))->result();
		$data_conent['city_name']=$city_name;
		$data_conent['cat_name']=$cat_name;

	


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
		$this->db->update("products",$main_rata_data,array("id"=>$tab_id));
		 
	  
	  
	  $data['site_info'] =$this->db->get_where('site_info')->result(); 
	  $data_conent['site_info']=$this->db->get_where('site_info')->result();
	  $this->load->view("index/include/head",$data );
	  $this->load->view("include/header",$data );
	  $this->load->view('edit_dawrat',$data_conent);
	  $this->load->view("index/include/footer",$data);
	  
	  }



	  public function editbag_action(){
			if($this->session->userdata("customer_id")==""){
				redirect(base_url()."index");
			}		

		$customer_id=$this->session->userdata("customer_id");
		$bag_id=$this->input->post("bag_id");
		$user_type=$this->session->userdata("user_type");


		$name=$this->input->post('name');
		$about=$this->input->post('about');
		$price=$this->input->post('price');
		$discount=$this->input->post('discount');
		$city_id=$this->input->post('city_id');
		$cat_id=$this->input->post('cat_id');
		$duration=$this->input->post('duration');
		$Institute_name=$this->input->post('Institute_name');
		$Institute_about=$this->input->post('Institute_about');
		$num_seats=$this->input->post('num_seats');
		$course_type=$this->input->post('course_type');
		$date_course=$this->input->post('date_course');
		$accreditation_number=$this->input->post('accreditation_number');

	$store['name'] = $name;
	$store['city_id'] = $city_id;
	$store['details'] =	$about;
	$store['duration_course'] = 	$duration;
	$store['cat_id'] =	$cat_id;
	$store['accreditation_number'] = $accreditation_number;
	$store['date_course'] =$date_course;
	$store['type'] =$course_type;
	$store['num_seats'] = $num_seats;
	$store['price'] =$price;
	$store['discount'] =$discount;

 $this->db->update('products',$store,array("id"=>$bag_id));
	$field_values_array =$this->input->post('field_name');
	if(count($field_values_array)>0){
	$this->db->delete("course_info",array("id_course"=>$bag_id));
	}

	for($i=0; $i<count($field_values_array); $i++){
	$data['content'] = $field_values_array[$i];
	$data['id_user'] = $customer_id;
	$data['id_course'] =$bag_id;
	$data['type'] =$course_type;
	$data['view'] ='1';
	$this->db->insert('course_info',$data);
	}

	if($_FILES['img']['name']!=""){
		$file=$_FILES['img']['name'];
		$file_name="img";
		$config=get_img_config('customers','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$bag_id),"400","400");
		$storeb['img'] = $config;
		$this->Main_model->update('bag_info',array("id"=>$bag_id),$storeb);

		if($bag_id!=0){
			get_img_resize_courses("uploads/products/".$config,"uploads/products/thumbnail_100/","150","100");
		 }
		 if($bag_id!=0){
			get_img_resize_courses("uploads/products/".$config,"uploads/products/thumbnail_150/","250","150");
		 }

		}
				$Institute_id= $bag_id;
		$Institute['Institute_name'] =$Institute_name;
		$Institute['Institute_about'] =		$Institute_about;
		$this->db->update('institute',$Institute,array("id_course"=>$Institute_id));

	
	
	
		if($_FILES['Institute_img']['name']!=""){
			$file=$_FILES['Institute_img']['name'];
			$file_name="Institute_img";
			$config_instit=get_img_config('institute','uploads/products/',$file,$file_name,'Institute_img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$Institute_id),"400","400");
			$Instituteimg['Institute_img'] = $config_instit;
			$this->db->update('institute',$Instituteimg,array("id_course"=>$Institute_id));
			}
	


	echo $bag_id;
	}

	
public function delete(){    
if($this->session->userdata("admin_id")==""){
redirect(base_url());
}
else {
$tab_id=base64_decode($this->input->get("ID"));;
$this->db->update("products",array("delete_key" => "0"),array("id"=>$tab_id));
redirect(base_url()."account");	
	}   
}
	


	public function archive_delete(){
    
		$product_id=base64_decode($this->input->get("ID"));
        if($product_id!=""){
        $img = get_this('products',['id' => $product_id],'img');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
       $img = get_this('images',['id_products' => $product_id],'image');
            if ($img != "") {
            unlink("uploads/products/$img");
            }

        $ret_value=$this->data->delete_table_row('products',array('id'=>$product_id));
        $ret_value=$this->data->delete_table_row('images',array('id_products'=>$product_id));
        $ret_value=$this->data->delete_table_row('favourites',array('course_id'=>$product_id));
        $ret_value=$this->data->delete_table_row('messages',array('id_products'=>$product_id));
        }
 
 
     redirect(base_url()."account/archive", 'refresh');
         
        
          }
    

}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
