<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');
class Pages extends MX_Controller {
    
    function __construct() {

		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
    @date_default_timezone_set('Asia/Riyadh');
    $this->load->library('Authorization_Token');
    }


    
    

    public function register(){
 if($this->session->userdata("device_id")!=""){
redirect(base_url()."account/my_ads");
      }
else {
  $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $this->load->view("index/include/head",$data );
  $this->load->view("index/include/header",$data );
  $this->load->view('register',$data);
 $this->load->view("index/include/footer",$data);
}

}

    
    public function index(){
 if($this->session->userdata("device_id")!=""){
redirect(base_url()."account/my_ads");
      }
else {
  $data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $this->load->view("index/include/head",$data );
  $this->load->view("index/include/header",$data );
  $this->load->view('login',$data);
 $this->load->view("index/include/footer",$data);
}

}


function fogetpassword(){
  if($this->session->userdata("customer_id")!=""){
 redirect(base_url()."user");
       }
 else {
   $data['site_info'] =$this->db->get_where('site_info')->result(); 
   $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
   $data['cat_advert'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
   $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
   $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $this->load->view("index/include/head",$data );
   $this->load->view("index/include/header",$data );
   $this->load->view('fogetpassword',$data);
  $this->load->view("index/include/footer",$data);
 }
 
 }

public function terms(){
$user_type=$this->uri->segment(3);
	if($this->session->userdata("customer_id")!=""){
 redirect(base_url()."user");
			 }
 else {
	 $data['site_info'] =$this->db->get_where('site_info')->result(); 
	 $data['pages'] =$this->db->get_where('pages',array("flag"=>$user_type,'key_txt'=>"terms"))->result(); 
	 $this->load->view("index/include/head",$data );
	 $this->load->view("index/include/header",$data );
	 $this->load->view('terms',$data);
	 $this->load->view("index/include/footer",$data);
 }
 
 }

 

 function check_phone() {
$phone_find= get_table_filed('customers',array('phone'=>$this->input->post('phone')),"phone");
 if($phone_find!=""){ echo 1;}
else { echo 2;}
 }
 function check_email() {
  $email_find= get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
   if($email_find!=""){ echo 1;}
  else { echo 2;}
   }
 

 function register_action() {
 
  $email_find = get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
$phone_find= get_table_filed('customers',array('phone'=>$this->input->post('phone')),"phone");
if($email_find==""&&$phone_find==""){
  $store = [
  'user_name'          	=> $this->input->post('fullname'),
  'password'            => md5($this->input->post('password')),
  'email'          		=> $this->input->post('email'),
  'phone'               => $this->input->post('phone'),
  'city_id'    	=> $this->input->post('city'),
  'view'    	=> '1',
  'text_test'=>$this->input->post('password'),
  'creation_date'       => date('Y-m-d H:i:s'),
  ];
  $insert = $this->db->insert('customers',$store);
  $id= $this->db->insert_id(); 
  $customer = get_this('customers',['id'=>$id]);
  $id = $customer['id'];
  $customer_info =get_this('customers',['id'=>$id]);
  $payload = ['id' => $customer_info['id'],
  'phone' => $customer_info['phone'],
  'email' => $customer_info['email']
  ];
  $token = $this->authorization_token->generateToken($payload);
  $store_token = ['device_id' => $token];
   $this->db->update('customers',$store_token,array("id"=>$id));
  send_email($id,"user","register");
  
  $total_used=get_table_filed('codes',array('id'=>3),"total_used");
$time_days=get_table_filed('codes',array('id'=>3),"time_days");
$expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
$coustomer_code_id= get_table_filed('coustomer_code',array('id_customer'=>$id,'id_code'=>3,'count<='=>$total_used,'expire_date>'=>date("Y-m-d")),"id");
if($coustomer_code_id==""){
$data_code['id_customer']=$id;
$data_code['id_code']=3;
$data_code['count']=0;
$data_code['creation_date']=date('Y-m-d');
$data_code['expire_date']=$expire_date;
$data_code['success']='1';
$data_code['package_end']='0';
$insert = $this->db->insert('coustomer_code',$data_code);
}
$this->session->set_flashdata('msg_tosat', 'تم انشاء الحساب');
$this->session->mark_as_flash('msg_tosat');
   echo 1;
}
else if($phone_find!=""){ echo 2;}
else if($email_find!=""){ echo 3;}
 }
 function test() {
  send_email(26,"user","register");
 }

   function login_action() {
          $phone = $this->security->sanitize_filename($this->input->post('username'),true);
          $password = $this->security->sanitize_filename($this->input->post('password'),true);
          $passwordp=md5($password);
          $customer_id="";
          $customer_id = get_this('customers',['phone'=>$this->input->post('username'),'password'=>md5($this->input->post('password'))],'id');
          if($customer_id==""){
            $customer_id = get_this('customers',['email'=>$this->input->post('username'),'password'=>md5($this->input->post('password'))],'id');
                    }
 
if($customer_id != ""){
            $customer_info = get_this('customers',['id'=>$customer_id]);
            if ((int)$customer_info['view']=='0') {
              echo 3;
              }
      if ($customer_info['view'] == 1) {
        $customer_info =get_this('customers',['id'=>$customer_id]);
      
          $device_id= $customer_info['device_id'];
          $phone = $customer_info['phone'];
          $email= $customer_info['email'];
          $user_name = $customer_info['user_name'];

          $this->session->set_userdata(array('admin_id' => $customer_id));
          $this->session->set_userdata(array('device_id' => $device_id));
          $this->session->set_userdata(array('admin_email' => $email));
          $this->session->set_userdata(array('admin_name' => $user_name));
          $this->session->set_userdata(array('admin_phone' => $phone));
       /////////////////////////////////////////////////////
 echo 1;
}
              
    }
 else {echo 2;}
    
    

}

}


