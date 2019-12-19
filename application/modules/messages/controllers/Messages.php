<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Messages extends MX_Controller {

    function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->model('data','','true');
          $this->load->library('pagination');
          $this->load->library('lib_pagination'); 
		@date_default_timezone_set('Asia/Riyadh');
    }


/*#______________Start Ticket___________________________#*/

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
$pg_config['sql'] = $this->data->get_sql('messages',array("server_id"=>$customer_id,'id_reply'=>0,'user_archive'=>'1'),'id','DESC');
$pg_config['per_page'] = 10;
$data_conent = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("messages", $data_conent); 
$this->load->view("index/include/footer",$data);
}
}  


function archive_delete(){
$tab_id=$this->uri->segment(3);
$this->db->update("messages",array('user_archive'=>0),array("id"=>$tab_id));
redirect(base_url()."messages");
}

}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
