<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Forgetpassword extends MX_Controller {
    function __construct() {

		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
		@date_default_timezone_set('Asia/Riyadh');
    }


    
    
    
    public function index(){
      if($this->session->userdata("customer_id")!=""){
        redirect(base_url()."user");
              }
              else {
      $data['site_info'] =$this->db->get_where('site_info')->result(); 
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('forgetpassword',$data);
$this->load->view("index/include/footer",$data);
              }
    }

    public function forget_action() {

          $user_type = $this->security->sanitize_filename($this->input->post('user_type'),true);
          $email = $this->security->sanitize_filename($this->input->post('email'),true);
        $email_id= get_table_filed('customers',array('email'=>$email,'status'=>$user_type),"id");
  if($email_id==""){
    echo 2;
  }
  else {
    send_email($email_id,"forgetpassword","password");
    echo 1;
  }
      

    }
 
    
    public function confirmation(){
      if($this->session->userdata("customer_id")!=""){
        redirect(base_url()."user");
              }
              else {
      $data['site_info'] =$this->db->get_where('site_info')->result(); 
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view('confirmation',$data);
$this->load->view("index/include/footer",$data);
              }
  }

}


