<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends MX_Controller
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
		  $this->lang->load('admin', get_lang() );
    }
	
	

    public function index(){
		redirect(base_url().'admin/currency/currency','refresh');
    }

        public function currency(){
		$where = "";
        $pg_config['sql'] = $this->data->get_sql('currency',$where,'id','DESC');
        $pg_config['per_page'] = 30;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/currency/currency", $data); 
	
    }
    
    

	public function currency_delete(){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');

        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('currency',array('id'=>$id_notifications)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('currency',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/currency/currency','refresh');


    }


  
  	function check_view_currency(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("currency",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("currency",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("currency",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
    
    
    	public function add_currency(){
        $this->load->view("admin/currency/add_currency"); 
    }
    
    
    public function currency_action(){
        $update_date=date("Y-m-d");
        $title=$this->input->post('title');
		$data['name'] = $title;
 	     $this->db->insert('currency',$data);
$id = $this->db->insert_id();
$this->session->set_flashdata('msg', 'تم الأضافة بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/currency/currency','refresh');

}


public function currency_details(){
		$id=$this->input->get('id');
		$data['services_type']=$this->db->get_where("currency",array('id'=>$id))->result();
        $this->load->view("admin/currency/currency_details",$data); 
	}

public function edit_currency_action(){
	$title=$this->input->post('title');
	$id=$this->input->post('id');
	$data_service['name'] = $title;
	 $this->db->update('currency',$data_service,array('id'=>$id));
     $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
     $this->session->mark_as_flash('msg');
     redirect(base_url().'admin/currency/currency','refresh');
}
    
}




