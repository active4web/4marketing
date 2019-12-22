<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->model('paging','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination'); 
    }

    public function index(){
		redirect(base_url().'admin/Courses/inside','refresh');
    }
	
	public function gen_random_string()
    {
        $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
        $final_rand='';
        for($i=0;$i<4; $i++) {
            $final_rand .= $chars[ rand(0,strlen($chars)-1)];
        }
        return $final_rand;
    }
	
    public function advertising_search(){
        $id=$this->input->get('id');
    $w=get_table_filed('products',array('id'=>$id),"name");;
    $tables = "products";
    $config = array();
    $config['base_url'] = base_url().'admin/courses/advertising_search'; 
    $config['total_rows'] = $this->data->record_count($tables,array('name'=>$w,'delete_key'=>'1'),'','id','desc');
    $config['per_page'] =30;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';   
    $config['last_link'] = '»»';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '««';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
    
    $this->pagination->initialize($config);
    if($this->uri->segment(4)){
    $page = ($this->uri->segment(4)) ;
    }
    else{
    $page =0;
    }
    
    $rs = $this->db->get($tables);
    if($rs->num_rows() == 0):
    $data["results"] = array();
    $data["links"] = array();
    else:
    $data["results"] = $this->data->view_all_data($tables, array('name'=>$w,'delete_key'=>'1'), $config["per_page"], $page,'id','desc');
    $str_links = $this->pagination->create_links();
    $data["links"] = explode('&nbsp;',$str_links);
    endif;
    $this->load->view("admin/courses/advertising_search", $data); 
    }
    
    
    public function inside(){
        $pg_config['sql'] = $this->data->get_sql('products',"delete_key='1'",'id','DESC');
        $pg_config['per_page'] = 40;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/courses/inside", $data); 
    }
    public function advertising_deleted(){
        $pg_config['sql'] = $this->data->get_sql('products',"delete_key='0'",'id','DESC');
        $pg_config['per_page'] = 40;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/courses/advertising_deleted", $data); 
    }
    
public function category_advertising(){
$cat_id=$this->input->get("cat_id");
$tables = "products";
$config = array();
$config['base_url'] = base_url().'admin/courses/category_advertising'; 
$config['total_rows'] = $this->data->record_count($tables,array('cat_id'=>$cat_id,'delete_key'=>'1'),'','id','desc');
$config['per_page'] =30;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';   
$config['last_link'] = '»»';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['first_link'] = '««';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['prev_link'] = '<';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a>';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['suffix'] = '?' . http_build_query($_GET, '', "&");
$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

$this->pagination->initialize($config);
if($this->uri->segment(4)){
$page = ($this->uri->segment(4)) ;
}
else{
$page =0;
}

$rs = $this->db->get($tables);
if($rs->num_rows() == 0):
$data["results"] = array();
$data["links"] = array();
else:
$data["results"] = $this->data->view_all_data($tables, array('cat_id'=>$cat_id,'delete_key'=>'1'), $config["per_page"], $page,'id','desc');
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
$this->load->view("admin/courses/category_advertising", $data); 
    }  
    
 
         public function add_course_content(){
        $this->load->view("admin/courses/add_course_content"); 
    }  
    
    
    
	

    public  function search_name(){
        $search_name=$this->input->post('search_name');
        $len=strlen($search_name);
        $a=array();
        $sql=$this->db->get_where('products',array('view'=>'1','name!='=>""))->result();
        if(count($sql)>0){
        foreach($sql as $sql){
        $user_name=$sql->name;
        $products_id=$sql->id;
        if(substr($user_name,0,$len)==$search_name){
            $arr=$user_name.",".$products_id;
        array_push($a,$arr);
        
        }
        }
    }
echo json_encode($a);    
    }
	
	public function edit(){
		$id=$this->input->get('id');
  $data['category'] = $this->data->get_table_data('category',array('view'=>'1'));
   $data['currency'] = $this->data->get_table_data('currency',array('view'=>'1'));
    $data['city'] = $this->data->get_table_data('city',array('view'=>'1'));
    $data['data'] = $this->data->get_table_data('products',array('id'=>$id));
        $this->load->view("admin/courses/edit",$data); 
	}
	
public function edit_action(){
$id_courses=$this->input->post('id');


          
      $store['name']=$this->input->post('title');
       $store['details']=$this->input->post('about');
        $store['price']=$this->input->post('price');
        if($this->input->post('category')!=0){
         $store['cat_id']=$this->input->post('category');
        }
        if($this->input->post('city')!=0){
         $store['city_id']=$this->input->post('city');
        }if($this->input->post('dep_id')!=0){
         $store['dep_id']=$this->input->post('dep_id');
        }if($this->input->post('currency')!=0){
         $store['currency_id']=$this->input->post('currency');
        }
         $store['user_phone']=$this->input->post('phone');
         $store['user_email']=$this->input->post('email');
       if($this->input->post('special')!=0){
    $store['special']=$this->input->post('special');
     }
                                
                              
        $this->db->update('products',$store,array("id"=>$id_courses));
     

if(isset($_FILES['img']['name'])){
  $file=$_FILES['img']['name'];
  $file_name="img";
  get_img_config_course('products','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_courses),"600","450");
  $id_img=get_table_filed('images',array('id_products'=>$productid,'index_img'=>1),"id");
  if($id_img!=""){
  get_img_config_course('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_img),"600","450");
  }
  else{
  get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$productid),"600","450",0,$productid,1);
  }
    }           

if(isset($_FILES['img1']['name'])){
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

if(isset($_FILES['img2']['name'])){
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



if($id_courses!=""){
echo 1;
}
else {
echo 0;
}

	}
	


    

    
 public function add_course(){
  $data['category'] = $this->data->get_table_data('category',array('view'=>'1'));
   $data['currency'] = $this->data->get_table_data('currency',array('view'=>'1'));
    $data['city'] = $this->data->get_table_data('city',array('view'=>'1'));
 $this->load->view("admin/courses/add_course",$data); 
    }

    public function add_action(){
        $title=$this->input->post('title');
        $price=$this->input->post('price');
        $city=$this->input->post('city');
        $currency=$this->input->post('currency');
        $category=$this->input->post('category');
        $country_id=$this->input->post('country_id');
        $dep_id=$this->input->post('dep_id');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $about=$this->input->post('about');
        
      $point_count=get_table_filed('site_info',array('id'=>1),"point_count");
       $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $point_count days"));

          
      $store = [
                                'user_id'          	=> 1,
                                'name'           =>$this->input->post('title'),
                                'details'        => $this->input->post('about'),
                                'cat_id'            => $this->input->post('category'),
                                'city_id'        => $this->input->post('city'),
                                'date_title'    => gen_month_name(date('m')),
                                'price'         =>$this->input->post('price'),
                                'dep_id'         =>$this->input->post('dep_id'),
                                'currency_id'         =>$this->input->post('currency'),
                                'creation_date'       => date('Y-m-d'),
                                'delete_key'=>'1',
                                'expired_date'=>'1',
                                'expired_date_Val'=>$expire_date,
                                'user_phone'=>$this->input->post('phone'),
                                'user_email'=>$this->input->post('email') ,
                                 'special'=>$this->input->post('special') 

                              ];
        $this->db->insert('products',$store);
        
$id_courses = $this->db->insert_id();

if(isset($_FILES['img']['name'])){
  $file=$_FILES['img']['name'];
  $file_name="img";
  get_img_config_course('products','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_courses),"600","450");
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_courses),"600","450",0,$id_courses,1);
  }           

if(isset($_FILES['img1']['name'])){
$file=$_FILES['img1']['name'];
$file_name="img1";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_courses),"600","450",0,$id_courses,2);
}  

if(isset($_FILES['img2']['name'])){
$file=$_FILES['img2']['name'];
$file_name="img2";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id_courses),"600","450",0,$id_courses,3);
}  


if($id_courses!=""){
echo 1;
}
else {
echo 0;
}
    }

public function test(){
do_resize(42);  

}

public function courses_details(){
$id=$this->input->get('id');
$course_type=$this->input->get('course_type');
$data['data'] = $this->data->get_table_data('products',array('id'=>$id));
$data['course_info'] = $this->data->get_table_data('course_info',array('id_course'=>$id,'type'=>$course_type,'view'=>'1'));
$this->load->view("admin/courses/courses_details",$data); 
}




public function change_review(){
    $id=$this->input->get('id');
    $course_type=$this->input->get('course_type');
    $data['data'] = $this->data->get_table_data('products',array('id'=>$id));
    $this->load->view("admin/courses/change_review",$data); 
    }


    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("products",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

  
  
  

function expired_action(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"expired_date" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("expired_date" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("products",array("expired_date" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    
    public function restore(){
        $id_customers = $this->input->get('id_customers');
        $check=$this->input->post('check');

        if($id_customers!=""){
        $ret_value=$this->db->update('products',array('delete_key'=>'1'),array('id'=>$id_customers)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$$this->db->update('products',array('delete_key'=>'1'),array('id_customers'=>$check[$i]));    
        }
        }

$this->session->set_flashdata('msg', 'تم استرجاع الأعلان بنجاح');
redirect(base_url().'admin/courses/advertising_deleted/','refresh');

    }
    public function delete(){
        $id_customers = $this->input->get('id_customers');
        $check=$this->input->post('check');

        if($id_customers!=""){
        $ret_value=$this->db->update('products',array('delete_key'=>'0'),array('id'=>$id_customers)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$$this->db->update('products',array('delete_key'=>'0'),array('id_customers'=>$check[$i]));    
        }
        }

$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
redirect(base_url().'admin/courses/inside/','refresh');

    }
    
      
    public function delete_img(){
        $product_id = $this->input->get('id');
        $advertising_id = $this->input->get('advertising_id');
        if($product_id!=""){
        $img = get_this('images',['id' => $product_id],'image');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
        $ret_value=$this->data->delete_table_row('images',array('id'=>$product_id));
        }
        if(isset($check)&&$check!=""){  
            
          $check=$this->input->post('check');
          $length=count($check);
          for($i=0;$i<$length;$i++){
              $img = get_this('images',['id' => $check[$i]],'img');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
        $ret_value=$this->data->delete_table_row('images',array('id'=>$check[$i]));     
         }
         }
         $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         redirect(base_url()."admin/courses/courses_details?id=$advertising_id", 'refresh');
          }
    
        public function delete_images(){
        $product_id = $this->input->get('id');
        $advertising_id = $this->input->get('advertising_id');
        if($product_id!=""){
        $img = get_this('images',['id' => $product_id],'image');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
        $ret_value=$this->data->delete_table_row('images',array('id'=>$product_id));
        }

         $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         redirect(base_url()."admin/courses/edit?id=$advertising_id", 'refresh');
          }
 
    
    
    
        function change_expired(){
        $id = $this->input->get("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"expired_date" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("expired_date" => "0"),array("id"=>$id));
        }
        if ($ser == 0) {
            $this->db->update("products",array("expired_date" => "1"),array("id"=>$id));
        } 
                $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         redirect(base_url()."admin/courses/courses_details?id=$id", 'refresh'); 
        
    }
    
            function change_archive(){
        $id = $this->input->get("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"delete_key" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("delete_key" => "0"),array("id"=>$id));
        }
        if ($ser == 0) {
            $this->db->update("products",array("delete_key" => "1"),array("id"=>$id));
        } 
                $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         redirect(base_url()."admin/courses/courses_details?id=$id", 'refresh'); 
        
    }
    
function change_date(){
        $id = $this->input->get("id");
    $point_count=get_table_filed('site_info',array('id'=>1),"point_count");
       $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $point_count days"));
       $this->db->update("products",array("expired_date_Val" =>$expire_date,"expired_date" => "1"),array("id"=>$id));
         $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         redirect(base_url()."admin/courses/courses_details?id=$id", 'refresh'); 
        
    }




    public function final_delete(){
        $product_id = $this->input->get('id');
        $check=$this->input->post('check');
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
        if(isset($check)&&$check!=""){  
            
          $check=$this->input->post('check');
          $length=count($check);
          for($i=0;$i<$length;$i++){
            $img = get_this('products',['id' => $check[$i]],'img');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
              $img = get_this('images',['id' => $check[$i]],'image');
        if ($img != "") {
        unlink("uploads/products/$img");
        }
        $ret_value=$this->data->delete_table_row('products',array('id'=>$check[$i]));
        $ret_value=$this->data->delete_table_row('images',array('id_products'=>$check[$i]));
        $ret_value=$this->data->delete_table_row('favourites',array('course_id'=>$check[$i]));
        $ret_value=$this->data->delete_table_row('messages',array('id_products'=>$check[$i]));    
         }
         }
         $this->load->helper('url');
         $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
         $this->session->mark_as_flash('msg');
         if($this->input->post("main_adv")=="main_adv"){
     redirect(base_url()."admin/courses/inside", 'refresh');
         }
         else {
        redirect(base_url()."admin/courses/advertising_deleted", 'refresh');
         }
          }
    


          public function status_action(){
            $id_status=$this->input->post('id_status');
            $status=$this->input->post('status');
            $data['view'] =$status;
    $this->db->update("products",$data,array('id'=>$id_status));
    if($id_status!=""){	
     send_email($id_status,"advertising","change_status");
          }    
          $this->session->set_flashdata('msg', 'تم التحديث بنجاح');
         $this->session->mark_as_flash('msg');
     redirect(base_url()."admin/courses/inside", 'refresh');
        }

}