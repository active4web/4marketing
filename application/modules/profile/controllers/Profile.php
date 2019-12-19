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


/*#______________Start Ticket___________________________#*/

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

	

public function ticket(){
if($this->session->userdata("admin_id")==""){
	redirect(base_url());
}
else {
$customer_id=$this->session->userdata('admin_id');
$ticket_id=$this->uri->segment(3);
$data['site_info'] =$this->db->get_where('site_info')->result(); 
$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
$data_conent['tickets_types'] =$this->db->get_where('tickets_types',array('view'=>'1'))->result(); 
$data_conent['tickets'] =$this->db->get_where('tickets',array('id'=>$ticket_id))->result(); 
$data_conent['tickets_replies'] =$this->db->get_where('tickets_replies',array('ticket_id'=>$ticket_id))->result(); 

$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("ticket", $data_conent); 
$this->load->view("index/include/footer",$data);
}
}



public function ticket_replay(){

	if($this->session->userdata("admin_id")==""){
		redirect(base_url()."index");
	}
	
	else {
	$customer_id=$this->session->userdata('admin_id');
	$store = [
		'reply_type '     =>1,
		'ticket_id' => $this->input->post('ticket_id'),
		'created_by'        =>$customer_id,
		'content'        => $this->input->post('comment'),
		'created_at'     => date('Y-m-d'),
		'time'     => date('h:i:s'),
	  ];
	$insert = $this->Main_model->insert('tickets_replies',$store);
	if($insert){
		$ticket_id=$this->input->post('ticket_id');
		redirect(base_url()."profile/ticket/$ticket_id");
	}
	}
	
	}
	
/*#______________END Ticket___________________________#*/



function share() {
	if($this->session->userdata("admin_id")==""){
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



/*#_____________Start MyAccount___________________________#*/
function index() {
	if($this->session->userdata("admin_id")==""){
		redirect(base_url()."index");
	}		
else {
	$customer_id=$this->session->userdata("admin_id");
	$data_conent['customers'] =$this->db->get_where('customers',array("id"=>$customer_id))->result(); 

	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
	$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
	$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 

	

$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('myaccount',$data_conent);
$this->load->view('index/include/footer',$data);  
}

}

public function edit_profile(){
	$customer_id=$this->session->userdata("admin_id");

	$phone=$this->input->post('phone');
	$email=$this->input->post('email');
	$city_id=$this->input->post('city_id');

	$exit_email=0;
	$exit_phone=0;
	$phone_old = get_this('customers',['id'=>$customer_id],'phone');
$email_old = get_this('customers',['id'=>$customer_id],'email');

if ($phone_old != $phone) {
$id_ext=get_table_filed('customers',array('phone'=>$phone),"id");
if($id_ext!=""){echo 2;$exit_phone=1;}
else {	$exit_phone=0;}}

	if ($email_old != $email) {
		$id_ext=	get_table_filed('customers',array('email'=>$email),"id");
		if($id_ext!=""){echo 3;$exit_email=1;
		}else {	$exit_email=0;}}

		$store['user_name'] = $this->input->post('title');
		$store['email'] = $this->input->post('email');
		$store['phone'] = $this->input->post('phone');
		$store['city_id'] = $this->input->post('city_id');		
		if($exit_email==0&&$exit_phone==0){
		$this->Main_model->update('customers',['id'=>$customer_id],$store);
        echo 	1;
		}

}


/*#_____________End MyAccount___________________________#*/


/*#_____________Start ChangePassword___________________________#*/
function changepassword() {
	if($this->session->userdata("admin_id")==""){
		redirect(base_url()."index");
	}		
else {
	$customer_id=$this->session->userdata("admin_id");
	
	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
	$data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
	$data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
	$data_conent['site_info'] =$this->db->get_where('site_info')->result(); 

$this->load->view('index/include/head',$data );
$this->load->view('index/include/header',$data );
$this->load->view('changepassword',$data_conent);
$this->load->view('index/include/footer',$data);  
}

}

public function check_password(){
	$customer_id=$this->session->userdata("admin_id");
	$oldpassword=$this->input->post('oldpassword');
	if ($oldpassword !="") {
	$id_ext=get_table_filed('customers',array('password'=>md5($oldpassword),'id'=>$customer_id),"id");
	if($id_ext!=""){echo 1;}
	else {echo 2;}
			}
	else{echo 0;}		

}

public function password_action(){
	$customer_id=$this->session->userdata("admin_id");
	$newpassword=$this->input->post('newpassword');
	$oldpassword=$this->input->post('oldpassword');
	$exit_phone=0;
if ($oldpassword!="") {
$id_ext=get_table_filed('customers',array('password'=>md5($oldpassword),'id'=>$customer_id),"id");
if($id_ext!=""){$exit_phone=0;}
else {	$exit_phone=1;echo 2;}
	}
$store['password'] = md5($newpassword);
		if($exit_phone==0){
		$this->Main_model->update('customers',['id'=>$customer_id],$store);
echo 	1;
unset($_SESSION['admin_id']);
		}
}


public function favorite(){
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
	$pg_config['sql'] = $this->data->get_sql('favourites',array("user_id"=>$customer_id),'id','DESC');
	$pg_config['per_page'] = 9;
	$data_conent = $this->lib_pagination->create_pagination($pg_config);
	$this->load->view("index/include/head",$data );
	$this->load->view("index/include/header",$data );
	$this->load->view("favorite", $data_conent); 
	$this->load->view("index/include/footer",$data);
	}
	}  
	function delete_fav(){
		
		$device_id=$this->session->userdata("device_id");
		$customer_id=get_customer_id_forent($device_id); 
		$fav_id=$this->input->post('fav_id');
		$id_fav=get_table_filed('favourites',array("course_id"=>$fav_id,'user_id'=>$customer_id),"id");
if($id_fav!=""){
	$this->db->delete("favourites",array("id"=>$id_fav));
		echo 1;
}

	}
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
