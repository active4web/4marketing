<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Profile extends MX_Controller {

    function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
		@date_default_timezone_set('Asia/Riyadh');
    }




	

public function technical_support(){
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
$pg_config['sql'] = $this->data->get_sql('tickets',array("created_by"=>$customer_id),'id','DESC');
$pg_config['per_page'] = 10;
$data_conent = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("technical_support", $data_conent); 
$this->load->view("index/include/footer",$data);

		
}
}  

public function create_ticket(){
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
	$data_conent['tickets_types'] =$this->db->get_where('tickets_types',array('view'=>'1'))->result(); 
	$this->load->view("index/include/head",$data );
	$this->load->view("index/include/header",$data );
	$this->load->view("create_ticket", $data_conent); 
	$this->load->view("index/include/footer",$data);
	}
	}

public function ticket_action(){

if($this->session->userdata("admin_id")==""){
	echo 0;
}

else {
$customer_id=$this->session->userdata('admin_id');
$store = [
	'created_by'     =>$customer_id,
	'ticket_type_id' => $this->input->post('tickets_types'),
	'title'        => $this->input->post('title'),
	'content'        => $this->input->post('comment'),
	'created_at'     => date('Y-m-d'),
	'time'     => date('h:i:s'),
	'type'           => 1,
  ];
$insert = $this->Main_model->insert('tickets',$store);
if($insert){
	echo 1;
}
}

	}

function share() {
	if($this->session->userdata("customer_id")==""){
		redirect(base_url()."index");
	}		
else {

	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
$this->load->view('index/include/head',$data );
$this->load->view('include/header',$data );
$this->load->view('share',$data_contant);
$this->load->view('index/include/footer',$data);  
}

}

function myaccount() {
	if($this->session->userdata("customer_id")==""){
		redirect(base_url()."index");
	}		
else {
	$customer_id=$this->session->userdata("customer_id");
	$data_contant['customers'] =$this->db->get_where('customers',array("id"=>$customer_id))->result(); 
	$cat_id=get_table_filed('customers',array("id"=>$customer_id),"cat_id");
	$city_id=get_table_filed('customers',array("id"=>$customer_id),"city_id");
	$cat_name=get_table_filed('category',array("id"=>$cat_id),"name");
	$city_name=get_table_filed('city',array("id"=>$city_id),"name");

	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
	$data_contant['category']=$this->db->get_where('category',array("view"=>'1','id!='=>$cat_id))->result();
	$data_contant['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1','id!='=>$city_id))->result();
	$data_contant['city_name']=$city_name;
	$data_contant['cat_name']=$cat_name;

$this->load->view('index/include/head',$data );
$this->load->view('include/header',$data );
$this->load->view('myaccount',$data_contant);
$this->load->view('index/include/footer',$data);  
}

}

function changepassword() {
	if($this->session->userdata("customer_id")==""){
		redirect(base_url()."index");
	}		
else {
	$customer_id=$this->session->userdata("customer_id");
	$data_contant['customers'] =$this->db->get_where('customers',array("id"=>$customer_id))->result(); 
	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();

$this->load->view('index/include/head',$data );
$this->load->view('include/header',$data );
$this->load->view('changepassword',$data_contant);
$this->load->view('index/include/footer',$data);  
}

}





function update_info() {
	if($this->session->userdata("customer_id")==""){
		redirect(base_url()."index");
	}		
else {
	$customer_id=$this->session->userdata("customer_id");
	$data_contant['customers'] =$this->db->get_where('customers',array("id"=>$customer_id))->result(); 
	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
	$data_contant['trainer_certifactes']=$this->db->order_by("id","desc")->get_where('trainer_certifactes',array("user_id"=>$customer_id))->result();
$data_contant['trainer_experiences']=$this->db->order_by("id","desc")->get_where('trainer_experiences',array("user_id"=>$customer_id))->result();
$this->load->view('index/include/head',$data );
$this->load->view('include/header',$data );
$this->load->view('update_info',$data_contant);
$this->load->view('index/include/footer',$data);  
}
}


public function edit_profile(){
	$customer_id=$this->session->userdata("customer_id");
	$user_type=$this->session->userdata("user_type");
	$name=$this->input->post('name');
	$phone=$this->input->post('phone');
	$email=$this->input->post('email');
	$age=$this->input->post('age');
	$city_id=$this->input->post('city_id');
	$cat_id=$this->input->post('cat_id');
	$exit_email=0;
	$exit_phone=0;
	$phone_old = get_this('customers',['id'=>$customer_id],'phone');
$email_old = get_this('customers',['id'=>$customer_id],'email');
if ($phone_old != $phone) {
$id_ext=	get_table_filed('customers',array('phone'=>$phone,'status'=>$user_type),"id");
if($id_ext!=""){echo 3;$exit_phone=1;
}
else {	$exit_phone=0;}
	}
	if ($email_old != $email) {
		$id_ext=	get_table_filed('customers',array('email'=>$email,'status'=>$user_type),"id");
		if($id_ext!=""){echo 4;$exit_email=1;
		}
		else {	$exit_email=0;}
		}


		if($_FILES['img']['name']!=""){
			$file=$_FILES['img']['name'];
			$file_name="img";
			$config=get_img_config('customers','uploads/customers/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$customer_id),"400","400",$customer_id);
			$store['img'] = $config;
			$this->session->set_userdata(array('myimg' => $config));
			}

			
	
		if ($this->input->post('city_id')) {
		$store['city_id'] = $city_id;
		}
		if ($this->input->post('cat_id')) {
			$store['cat_id'] = $cat_id;
			}
		$store['user_name'] = $this->input->post('name');
		$store['email'] = $this->input->post('email');
		$store['phone'] = $this->input->post('phone');
		$store['age'] = $this->input->post('age');

		$this->session->set_userdata(array('admin_email' => $email));
		$this->session->set_userdata(array('admin_name' => $name));
		$this->session->set_userdata(array('admin_phone' => $phone));

		
		if($exit_email==0&&$exit_phone==0){

		$this->Main_model->update('customers',['id'=>$customer_id],$store);
	
echo 	1;
		}

			
}


public function password_action(){
	$customer_id=$this->session->userdata("customer_id");
	$user_type=$this->session->userdata("user_type");
	$curr_pass=$this->input->post('curr_pass');
	$new_pass=$this->input->post('new_pass');


	$exit_phone=0;

if ($curr_pass !="") {
$id_ext=	get_table_filed('customers',array('password'=>md5($curr_pass),'id'=>$customer_id,'status'=>$user_type),"id");
if($id_ext!=""){$exit_phone=0;}
else {	$exit_phone=1;echo 2;}
	}
$store['password'] = md5($new_pass);

		if($exit_phone==0){
		$this->Main_model->update('customers',['id'=>$customer_id],$store);
echo 	1;
unset($_SESSION['customer_id']);
unset($_SESSION['admin_email']);
unset($_SESSION['admin_name']);
unset($_SESSION['admin_phone']);
unset($_SESSION['user_type']);
unset($_SESSION['myimg']);
		}

			
}




public function update_info_action(){
	$customer_id=$this->session->userdata("customer_id");
	$user_type=$this->session->userdata("user_type");
	$about=$this->input->post('about');
$store['about'] = $about;
$this->Main_model->update('customers',['id'=>$customer_id],$store);

$field_values_array =$this->input->post('field_name');
$exp =$this->input->post('exp');
$com =$this->input->post('comp');
$start_month =$this->input->post('start_month');
$start_year =$this->input->post('start_year');
$end_month =$this->input->post('end_month');
$end_year =$this->input->post('end_year');

if(count($field_values_array)>0){
	$this->db->delete("trainer_certifactes",array("user_id"=>	$customer_id));
}
if(count($exp)>0){
	$this->db->delete("trainer_experiences",array("user_id"=>	$customer_id));
}

for($i=0; $i<count($field_values_array); $i++){
$data['certification'] = $field_values_array[$i];
$data['user_id'] = $customer_id;
$data['creation_date'] =date("Y-d-m");
$this->db->insert('trainer_certifactes',$data);
}

for($i=0; $i<count($exp); $i++){
	$data_exp['experiences'] = $exp[$i];
	$data_exp['company_name'] = $com[$i];
	$data_exp['start_date'] = $start_year[$i];
	$data_exp['start_moth'] = $start_month[$i];
	if($end_year[$i]==1){
	$data_exp['end_key'] = 0;
	}
	else {
		$data_exp['end_date'] = $end_year[$i];
		$data_exp['end_month'] = $end_month[$i];	
	}
	$data_exp['user_id'] = $customer_id;
	$data_exp['creation_date'] =date("Y-d-m");
	$this->db->insert('trainer_experiences',$data_exp);
}


echo 1;
}
		



function register() {
	if($this->session->userdata("customer_id")!=""){
		redirect(base_url()."user");
	}		
else {


	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
	$data_contant['category']=$this->db->get_where('category',array("view"=>'1'))->result();
	$data_contant['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1'))->result();

$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('register',$data_contant);
$this->load->view('index/include/footer',$data);  
}

}






public function register_action(){
	$usertype=$this->input->post("usertype");
	$name=$this->input->post('name');
	$phone=$this->input->post('phone');
	$email=$this->input->post('email');
	$age=$this->input->post('age');
	$city_id=$this->input->post('city_id');
	$cat_id=$this->input->post('cat_id');
	$password=$this->input->post('password');
	$exit_email=0;
	$exit_phone=0;
	$phone_old = get_this('customers',['status'=>$usertype],'phone');
$email_old = get_this('customers',['status'=>$usertype],'email');
if ($phone_old != $phone) {
$id_ext=	get_table_filed('customers',array('phone'=>$phone,'status'=>$usertype),"id");
if($id_ext!=""){echo 3;$exit_phone=1;}
else {	$exit_phone=0;}
	}
	if ($email_old != $email) {
		$id_ext=	get_table_filed('customers',array('email'=>$email,'status'=>$usertype),"id");
		if($id_ext!=""){echo 4;$exit_email=1;	}
		else {	$exit_email=0;}
		}

	
if ($this->input->post('city_id')) {
		$store['city_id'] = $city_id;
		}
		if ($this->input->post('cat_id')) {
			$store['cat_id'] = $cat_id;
			}
		$store['user_name'] = $this->input->post('name');
		$store['email'] = $this->input->post('email');
		$store['phone'] = $this->input->post('phone');
		$store['age'] = $this->input->post('age');
		$store['status'] = $this->input->post('usertype');
		$store['password'] = md5($this->input->post('pass'));
		$store['creation_date'] = date('Y-m-d H:i:s');
		$store['invitation_code'] =gen_random_string();
		$store['using_invitation_code'] =$this->input->post('invitation_code');

		if($usertype==1){$store['view'] = '1';}
		else {$store['view'] = '0';}

   if($exit_email==0&&$exit_phone==0){
		$this->Main_model->insert('customers',$store);
		$customer_id=$this->db->insert_id();
		if($_FILES['img']['name']!=""){
			$file=$_FILES['img']['name'];
			$file_name="img";
			$config=get_img_config('customers','uploads/customers/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$customer_id),"400","400");
			$store_p['img'] = $config;
			$this->Main_model->update('customers',array("id"=>$customer_id),$store_p);
			}

echo 	1;
		}

			
}




}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
