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



	  


public function edit(){

if($this->session->userdata("admin_id")==""){
redirect(base_url());
}		

else{
	$customer_id=$this->session->userdata('admin_id');
	$product_id=$this->input->get('ID');
	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
	$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
	$data_contact['site_info']=$this->db->get_where('site_info')->result();
	$data_contact['city'] =$this->db->get_where('city',array("view"=>'1'))->result(); 
	$data_contact['currency'] =$this->db->get_where('currency',array("view"=>'1'))->result(); 
	$data_contact['category'] =$this->db->get_where('category',array("view"=>'1'))->result(); 
	$data_contact['products'] =$this->db->get_where('products',array('id'=>$product_id))->result(); 
	$data_contact['customers'] =$this->db->get_where('customers',array("view"=>'1','id'=>$customer_id))->result(); 
	$data_contact['images1'] =$this->db->get_where('images',array('id_products'=>$product_id,'index_img'=>1))->result(); 
	$data_contact['images2'] =$this->db->get_where('images',array('id_products'=>$product_id,'index_img'=>2))->result(); 
	$data_contact['images3'] =$this->db->get_where('images',array('id_products'=>$product_id,'index_img'=>3))->result(); 

	$this->load->view("index/include/head",$data );
	  $this->load->view("index/include/header",$data );
	  $this->load->view('edit',$data_contact);
	  $this->load->view("index/include/footer",$data);
}

}



	  public function edit_action(){
			if($this->session->userdata("admin_id")==""){
				echo 3;
			}		
else {
	$productid=$this->input->post("productid");
			$store = [
				'name'              =>$this->input->post('title'),
				'details'           => $this->input->post('comment'),
				'price'             =>$this->input->post('price'),
				'user_phone'        =>$this->input->post('phone'),
				'user_email'        =>$this->input->post('email'),
				'cat_id'            => $this->input->post('category'),
				'dep_id'            => $this->input->post('dep_id'),
				'currency_id'          => $this->input->post("courrency"),
				'city_id'           => $this->input->post('city_id'),
				'special'           =>$this->input->post('adv_type')
			  ];
			  $insert = $this->db->update('products',$store,array("id"=>$productid));
if($productid!=""){
if($_FILES['mainimg']['name']!=""){
$file=$_FILES['mainimg']['name'];
$file_name="mainimg";
get_img_config_course('products','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$productid),"600","450");
}           

if($_FILES['img']['name']){

	$file=$_FILES['img']['name'];
	$file_name="img";

$id_img=get_table_filed('images',array('id_products'=>$productid,'index_img'=>1),"id");
if($id_img!=""){
get_img_config_course('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_img),"600","450");
}
else{
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$productid),"600","450",0,$productid,1);
}
} 

if($_FILES['img1']['name']){
$file=$_FILES['img1']['name'];
$file_name="img1";
$id_img=get_table_filed('images',array('id_products'=>$productid,'index_img'=>2),"id");
if($id_img!=""){
get_img_config_course('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_img),"600","450");
}
else{
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$productid),"600","450",0,$productid,2);
}

}  

if($_FILES['img2']['name']){
$file=$_FILES['img2']['name'];
$file_name="img2";
$id_img=get_table_filed('images',array('id_products'=>$productid,'index_img'=>3),"id");
if($id_img!=""){
get_img_config_course('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_img),"600","450");
}
else{
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$productid),"600","450",0,$productid,3);
}
}
send_email($productid,"user","edit_advertising");                
echo 1;
}
}
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
    
public function delete_main_img(){
$advertising_id = $this->input->get('advertising_id');
if($advertising_id!=""){
$img = get_this('products',['id' => $advertising_id],'img');
if ($img != "") {
unlink("uploads/products/$img");
}
$ret_value=$this->db->update('products',array('img'=>""),array('id'=>$advertising_id));
}
$this->load->helper('url');
	redirect(base_url()."account/edit?ID=$advertising_id", 'refresh');
	}



}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
