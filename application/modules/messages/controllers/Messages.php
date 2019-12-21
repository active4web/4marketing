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


/*#______________Start Messages___________________________#*/

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
$pg_config['sql'] = $this->data->get_sql('messages',array("server_id"=>$customer_id,'id_reply'=>0,'user_archive_reciver	'=>'1'),'id','DESC');
$pg_config['per_page'] = 10;
$data_conent = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("index/include/head",$data );
$this->load->view("index/include/header",$data );
$this->load->view("messages", $data_conent); 
$this->load->view("index/include/footer",$data);
}
}  
public function send(){
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
  $pg_config['sql'] = $this->data->get_sql('messages',array("send_id"=>$customer_id,'id_reply'=>0,'user_archive_sender'=>'1'),'id','DESC');
  $pg_config['per_page'] = 10;
  $data_conent = $this->lib_pagination->create_pagination($pg_config);
  $this->load->view("index/include/head",$data );
  $this->load->view("index/include/header",$data );
  $this->load->view("send", $data_conent); 
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
    $pg_config['sql'] = $this->data->get_sql('messages_archive',array("id_user"=>$customer_id),'id','DESC');
    $pg_config['per_page'] = 10;
    $data_conent = $this->lib_pagination->create_pagination($pg_config);
    $this->load->view("index/include/head",$data );
    $this->load->view("index/include/header",$data );
    $this->load->view("archive", $data_conent); 
    $this->load->view("index/include/footer",$data);
    }
    }
  
  



function archive_delete(){
$tab_id=$this->uri->segment(3);
$main_data['id_message']=$tab_id;
$customer_id=$this->session->userdata('admin_id');
$main_data['id_user']=$customer_id;
$main_data['date']=date("Y-m-d");
$this->db->insert("messages_archive",$main_data);
$this->db->update("messages",array('user_archive_reciver'=>0),array("id"=>$tab_id));
redirect(base_url()."messages");
}
function archive_delete_send(){
  $customer_id=$this->session->userdata('admin_id');
  $tab_id=$this->uri->segment(3);
  $main_data['id_message']=$tab_id;
$main_data['id_user']=$customer_id;
$main_data['date']=date("Y-m-d");
$this->db->insert("messages_archive",$main_data);
  $this->db->update("messages",array('user_archive_sender'=>0),array("id"=>$tab_id));
  redirect(base_url()."messages/send");
  }
  

  function archive_delete_final(){
    $customer_id=$this->session->userdata('admin_id');
    $tab_id=$this->uri->segment(3);
   
    $this->db->delete("messages_archive",array('id_message'=>$tab_id,'id_user'=>$customer_id));
    redirect(base_url()."messages/archive");
    }
  
    


    public function send_message(){
      if($this->session->userdata("admin_id")==""){
        redirect(base_url());
      }
      else {
      $customer_id=$this->session->userdata('admin_id');
      $product_id=base64_decode($this->uri->segment(3));
      $data['site_info'] =$this->db->get_where('site_info')->result(); 
      $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
      $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
      $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
      $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
      $data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
      $data_conent['products'] =$this->db->get_where('products',array('id'=>$product_id))->result(); 
      $this->load->view("index/include/head",$data );
      $this->load->view("index/include/header",$data );
      $this->load->view("send_message", $data_conent); 
      $this->load->view("index/include/footer",$data);
      }
      }
    
    public function message_action(){
    
    if($this->session->userdata("admin_id")==""){
      echo 0;
    }
    
    else {
    $customer_id=$this->session->userdata('admin_id');
    $user_id=$this->input->post('user_id');
    $productid=$this->input->post('productid');
    $idmessages=get_table_filed('messages',array('id_reply'=>'0','server_id'=>$user_id,'send_id'=>$customer_id,'id_products'=>$productid),"id");
    $store = [
      'send_id'     =>$customer_id,
      'id_products' => $this->input->post('productid'),
      'server_id'        => $this->input->post('user_id'),
      'message'        => $this->input->post('comment'),
      'creation_date'                  => date('Y-m-d'),
      'date_title'                     => gen_month_name(date('m')),
      'id_reply'                       =>'0',
      'user_archive_reciver'           =>'1',
      'user_archive_sender'            =>'1',
      ];
      if($idmessages==""){
        $insert = $this->Main_model->insert('messages',$store);
      }
      echo 1;
    }
    
    }



    public function message(){
      if($this->session->userdata("admin_id")==""){
        redirect(base_url());
      }
      else {
      $customer_id=$this->session->userdata('admin_id');
      $ticket_id=$this->uri->segment(3);
       //echo $ticket_id;
      $data['site_info'] =$this->db->get_where('site_info')->result(); 
      $data['cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
      $data['search_cat'] =$this->db->get_where('category',array('view'=>'1'))->result(); 
      $data['pages'] =$this->db->get_where('pages',array('active'=>'1'))->result(); 
      $data['city'] =$this->db->get_where('city',array('view'=>'1'))->result(); 
      $data_conent['site_info'] =$this->db->get_where('site_info')->result(); 
      $data_conent['messages'] =$this->db->get_where('messages',array('id'=>$ticket_id))->result(); 
      $data_conent['messages_replies'] =$this->db->get_where('messages',array('id_reply'=>$ticket_id))->result(); 
      
    $this->load->view("index/include/head",$data );
    $this->load->view("index/include/header",$data );
    $this->load->view("message", $data_conent); 
    $this->load->view("index/include/footer",$data);
      }
      }
      
      
      
      public function message_replay(){
      
        if($this->session->userdata("admin_id")==""){
          redirect(base_url()."index");
        }
        
        else {
        $customer_id=$this->session->userdata('admin_id');
        $store = [
          'creation_date' =>date('Y-m-d'),
          'send_id'        =>$customer_id,
          'message'        => $this->input->post('comment'),
          'server_id'     => $this->input->post('userid'),
          'id_products'     =>$this->input->post("productid"),
          'id_reply'        =>$this->input->post('ticket_id'),
          'date_title'                     => gen_month_name(date('m')),
          'user_archive_reciver'           =>'1',
          'user_archive_sender'            =>'1',
          ];
        $insert = $this->Main_model->insert('messages',$store);
        if($insert){
          $ticket_id=$this->input->post('ticket_id');
          redirect(base_url()."messages/message/$ticket_id");
        }
        }
        
        }
        
      /*#______________END Message___________________________#*/
      


}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
