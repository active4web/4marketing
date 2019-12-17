<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Search extends MX_Controller {
    function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
		$this->load->library('pagination');
        $this->load->library('lib_pagination'); 
    }




    function index() {
		if($this->session->userdata("customer_id")!=""){
			redirect(base_url()."user");
		  }
		  else {

$limit=198;
if($this->input->get('page_number')!=""&&$this->input->get('page_number')){
$name_course=$this->input->get('name');
$city_id=$this->input->get('city_id');
$course_key=$this->input->get('course_key');
$cat_id=$this->input->get('cat_id');
$page_number=$this->input->get('page_number');
$offset =$limit * $page_number;
}
else {
 $name_course=$this->input->post('name');
$city_id=$this->input->post('city_id');
$course_key=$this->input->post('course_key');
$cat_id=$this->input->post('cat_id');   
$outside_city_id=$this->input->post('outside_city_id');   
$offset =0;
}

//echo $course_key;

$this->db->select('*');
if($course_key==""){
$this->db->from('products');   
if($city_id!=""){
$this->db->where('city_id',$city_id);  
}
if($name_course!=""){
$this->db->like('name', $name_course);
}
}

else if($course_key==2){
$this->db->from('bag_info');    
if($this->input->post('name')!=""){
$this->db->like('bage_name', $name_course);
}
}
else {
$this->db->from('products');
if($city_id!=""){
$this->db->where('city_id',$city_id);  
}
if($outside_city_id!=""){
$this->db->where('city_id',$outside_city_id);  
}

if($name_course!=""){
$this->db->like('name', $name_course);
}
$this->db->where('type',$course_key);

}
if($cat_id!=""){
 $this->db->where('cat_id',$cat_id); 
}

$this->db->where('view', '1');
$this->db->where('delete_key', '1');

$this->db->order_by('id',"desc");
$this->db->limit($limit, $offset);
$query = $this->db->get();

$sql_product=$query->result();
$total=count($sql_product);

/*echo  $this->db->last_query();
print_r($sql_product)."<br>";
echo count($sql_product);
die();*/



$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result();
$data_conent['sql_product'] =$sql_product;
$data_conent['count'] =$total;

$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
if($course_key==2){$this->load->view('search_bag',$data_conent);}
else{$this->load->view('search',$data_conent);}
$this->load->view('index/include/footer',$data);


 }

}


    function inside_filter() {
        $sql_product_bag=array();
        $sql_product=array();
if($this->session->userdata("customer_id")!=""){
redirect(base_url()."user");
		  }
		  else {

$limit=198;

 $name_course=$this->input->post('name');
$course_key=$this->input->post('courses_key');
$dep_id=$this->input->post('dep_id');


if($this->input->post('dep_id')&&count($dep_id)>0){
   $dep_id_array=array(); 
   for($i=0; $i<count($dep_id); $i++){array_push($dep_id_array,$dep_id[$i]);}

}

$this->db->select('*');
if(!$this->input->post('courses_key')){
$this->db->from('products');   
if($name_course!=""){$this->db->like('name', $name_course);}
if($this->input->post('dep_id')){$this->db->where_in('cat_id',$dep_id_array);}
$this->db->where('view','1');
$this->db->where('delete_key','1');
$this->db->order_by('id',"desc");
$this->db->limit($limit);
$query = $this->db->get();    
$sql_product=$query->result();  


$this->db->from('bag_info');    
if($this->input->post('name')!=""){
$this->db->like('bage_name', $name_course);
}
if($this->input->post('dep_id')){$this->db->where_in('dep_id',$dep_id_array);}
$this->db->where('view', '1');
$this->db->where('delete_key', '1');
$this->db->order_by('id',"desc");
$this->db->limit($limit);
$query_bag= $this->db->get();
$sql_product_bag=$query_bag->result();

}




else if(count($course_key)>0){
    $bag_table=0;
    $prod_table=0;
    
$array=array();
for($i=0; $i<count($course_key); $i++){if($course_key[$i]==2){$bag_table="1";}else {$prod_table="1";array_push($array,$course_key[$i]);} }


if($bag_table==1){
$this->db->from('bag_info');    
if($this->input->post('name')!=""){
$this->db->like('bage_name', $name_course);
}
$this->db->where('view', '1');
$this->db->where('delete_key', '1');
$this->db->order_by('id',"desc");
if($this->input->post('dep_id')){$this->db->where_in('dep_id',$dep_id_array);}
$this->db->limit($limit);
$query_bag= $this->db->get();
$sql_product_bag=$query_bag->result();
}


if($prod_table==1){
$this->db->from('products');
if($name_course!=""){$this->db->like('name', $name_course);}
$this->db->where_in('type',$array);
$this->db->where('view','1');
$this->db->where('delete_key','1');
if($this->input->post('dep_id')){$this->db->where_in('cat_id',$dep_id_array);}
$this->db->order_by('id',"desc");
$this->db->limit($limit);
$query = $this->db->get();    
$sql_product=$query->result();  
}
}

/*echo  $this->db->last_query()."<br><br><br>";
echo count($sql_product)."<br><br><br>";
echo count($sql_product_bag)."<br><br><br>";
die();*/



$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result();
$data_conent['sql_product'] =$sql_product;
$data_conent['sql_product_bag'] =$sql_product_bag;
$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('inside_filter',$data_conent);
$this->load->view('index/include/footer',$data);

}

}




function advanced_search() {
if($this->session->userdata("customer_id")!=""){
redirect(base_url()."user");
}
else {
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['category']=$this->db->get_where('country',array("view"=>'1'))->result();
$data_conent['cat']=$this->db->get_where('category',array("view"=>'1'))->result();
$data_conent['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1'))->result();
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('advanced_search',$data_conent);
$this->load->view('index/include/js');
$this->load->view('index/include/footer',$data);
}
}







    function advancedsearch() {
        $sql_product_bag=array();
        $sql_product=array();
if($this->session->userdata("customer_id")!=""){
redirect(base_url()."user");
		  }
		  else {

$limit=198;

 $name_course=$this->input->post('name');
$course_key=$this->input->post('courses_key');
$dep_id=$this->input->post('dep_id');


if($this->input->post('dep_id')&&count($dep_id)>0){
   $dep_id_array=array(); 
   for($i=0; $i<count($dep_id); $i++){array_push($dep_id_array,$dep_id[$i]);}

}

$this->db->select('*');
if(!$this->input->post('courses_key')){
$this->db->from('products');   
if($name_course!=""){$this->db->like('name', $name_course);}
if($this->input->post('dep_id')){$this->db->where_in('cat_id',$dep_id_array);}
$this->db->where('view','1');
$this->db->where('delete_key','1');
$this->db->order_by('id',"desc");
$this->db->limit($limit);
$query = $this->db->get();    
$sql_product=$query->result();  


$this->db->from('bag_info');    
if($this->input->post('name')!=""){
$this->db->like('bage_name', $name_course);
}
if($this->input->post('dep_id')){$this->db->where_in('dep_id',$dep_id_array);}
$this->db->where('view', '1');
$this->db->where('delete_key', '1');
$this->db->order_by('id',"desc");
$this->db->limit($limit);
$query_bag= $this->db->get();
$sql_product_bag=$query_bag->result();

}




else if(count($course_key)>0){
$arrange=$this->input->post('arrange');    
    $bag_table=0;
    $prod_table=0;
    
$array=array();
for($i=0; $i<count($course_key); $i++){if($course_key[$i]==2){$bag_table="1";}else {$prod_table="1";array_push($array,$course_key[$i]);} }


if($bag_table==1){
$this->db->from('bag_info');    
if($this->input->post('name')!=""){
$this->db->like('bage_name', $name_course);
}
$this->db->where('view', '1');
$this->db->where('delete_key', '1');
$this->db->order_by('id',"desc");
if($this->input->post('dep_id')){$this->db->where_in('dep_id',$dep_id_array);}
$this->db->limit($limit);
$query_bag= $this->db->get();
$sql_product_bag=$query_bag->result();
}


if($prod_table==1){
$this->db->from('products');
if($name_course!=""){$this->db->like('name', $name_course);}
$this->db->where_in('type',$array);
$this->db->where('view','1');
$this->db->where('delete_key','1');
if($this->input->post('city_id')!=""){
$this->db->where('city_id',$this->input->post('city_id'));  
}
if($this->input->post('dep_id')){$this->db->where_in('cat_id',$dep_id_array);}

if($arrange==1){
$this->db->order_by("price",'asc');
}
else if($arrange==2){
$this->db->order_by("price",'desc');    
}

$this->db->limit($limit);
$query = $this->db->get();    
$sql_product=$query->result();  
}
}

/*echo  $this->db->last_query()."<br><br><br>";
echo count($sql_product)."<br><br><br>";
echo count($sql_product_bag)."<br><br><br>";
die();*/



$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result();
$data_conent['sql_product'] =$sql_product;
$data_conent['sql_product_bag'] =$sql_product_bag;
$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('advancedsearch',$data_conent);
$this->load->view('index/include/footer',$data);

}

}


public function get_state(){
header ('Content-Type: text/html; charset=UTF-8'); 
$country_id=$this->input->post('country_id');
$data_p=$this->db->get_where('city',array('view'=>'1','country_id'=>$country_id))->result();
if(count($data_p)>0){
echo "<option value=''>حدد المدينة</option>";
foreach($data_p as $data_p){
echo "<option value='$data_p->id'>$data_p->name</option>";
}
}
else {
echo "<option value=''>لا يوجد حاليا اى بيانات</option>";   
}
}

public function getcountry(){
header ('Content-Type: text/html; charset=UTF-8'); 
$data_p=$this->db->get_where('country',array('view'=>'1','id!='=>1))->result();
if(count($data_p)>0){
echo "<option value=''>حدد البلد</option>";
foreach($data_p as $data_p){
echo "<option value='$data_p->id'>$data_p->title</option>";
}
}
else {
echo "<option value=''>لا يوجد اى بلد حاليا</option>";   
}
}

public function getallcountry(){
header ('Content-Type: text/html; charset=UTF-8'); 
$data_p=$this->db->get_where('country',array('view'=>'1'))->result();
if(count($data_p)>0){
echo "<option value=''>حدد البلد</option>";
foreach($data_p as $data_p){
echo "<option value='$data_p->id'>$data_p->title</option>";
}
}
else {
echo "<option value=''>لا يوجد اى مدن حاليا</option>";   
}
}


function test() {	$this->load->view('test');}
}


