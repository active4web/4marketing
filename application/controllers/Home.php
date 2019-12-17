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
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
  $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
  $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
  $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
  $data['home_page'] =$this->db->get_where('home_page')->result(); 
  $data['products'] =$this->db->order_by("id","desc")->limit(24)->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1'))->result(); 
  $this->load->view("index/include/head",$data );
  $this->load->view("index/include/header",$data );
  $this->load->view('home',$data);
 $this->load->view("index/include/footer",$data);

    }

function test() {	$this->load->view('test');}
}


