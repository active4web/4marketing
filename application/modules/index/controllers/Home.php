<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Home extends MX_Controller {
    function __construct() {

		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
		@date_default_timezone_set('Asia/Riyadh');
    }

    function index() {
		if($this->session->userdata("customer_id")!=""){
			redirect(base_url()."user");
		  }
		  else {
		      redirect(base_url());
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['category']=$this->db->get_where('category',array("view"=>'1'))->result();
$data_conent['city']=$this->db->get_where('city',array("view"=>'1','country_id'=>'1'))->result();
$data_conent['outside_city']=$this->db->get_where('city',array("view"=>'1','country_id!='=>'1'))->result();
$data_conent['home_page']=$this->db->get_where('home_page')->result();
$data_conent['bags']=$this->db->order_by("id","desc")->limit(8)->get_where('bag_info',array("view"=>'1','delete_key'=>'1'))->result();
$data_conent['inside_courses']=$this->db->order_by("id","desc")->limit(8)->get_where('products',array("type"=>'1','view'=>'1','delete_key'=>'1'))->result();
$data_conent['outside_courses']=$this->db->order_by("id","desc")->limit(8)->get_where('products',array("type"=>'4','view'=>'1','delete_key'=>'1'))->result();
$data_conent['diplomas_courses']=$this->db->order_by("id","desc")->limit(8)->get_where('products',array("type"=>'3','view'=>'1','delete_key'=>'1'))->result();
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
	$this->load->view('include/head',$data );
$this->load->view('include/header',$data );
	$this->load->view('home',$data_conent);
		$this->load->view('include/js');
	$this->load->view('include/footer',$data);
		  }
    }

function test() {	$this->load->view('test');}
}


