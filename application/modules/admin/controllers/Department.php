<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MX_Controller
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
		redirect(base_url().'admin/department/department','refresh');
    }

    public function department(){
	
		if($this->session->userdata('id_admin')!=""){
		$where = "";
        $pg_config['sql'] = $this->data->get_sql('department',$where,'id','DESC');
        $pg_config['per_page'] = 30;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/department/department", $data); 
		}
		else {
			redirect(base_url().'admin/login','refresh');
		}
    }
	
	public function add(){
	    	if($this->session->userdata('id_admin')!=""){
	   	$data['services_type']=$this->db->get_where("category",array('view'=>'1'))->result();
        $this->load->view("admin/department/add",$data); 
	    	}
	    	else {
	 redirect(base_url().'admin/','refresh');   	    
	    	}
    }

	public function details(){
		$id=$this->input->get('id');
		$data['services_type']=$this->db->get_where("category",array('view'=>'1'))->result();
			$data['department']=$this->db->get_where("department",array('id'=>$id))->result();
        $this->load->view("admin/department/details",$data); 
	}

public function add_action(){
$title=$this->input->post('title');
$cat_id=$this->input->post('cat_id');
$data['name'] = $title;
$data['id_cat'] = $cat_id;
$data['creation_date'] = date("Y-d-m");
$this->db->insert('department',$data);
$id_Institute= $this->db->insert_id();
$this->session->set_flashdata('msg','تم الاضافة بنجاح');
$this->session->mark_as_flash('msg');
redirect(base_url().'admin/department/','refresh');
}


public function edit_action(){
    ob_start();
	$update_date=date("Y-m-d h:i:s");
	if($this->session->userdata('id_admin')!=""){
	$title=$this->input->post('title');
	$cat_id=$this->input->post('cat_id');
	
	$id=$this->input->post('id');

	if($cat_id!=0){
	  	$data_service['id_cat'] = $cat_id;  
	}
	$data_service['name'] = $title;
	 $this->db->update('department',$data_service,array('id'=>$id));


}
	$this->session->set_flashdata('msg', 'تم التعديل بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/department','refresh');
}

	

	
	public function delete(){
	if($this->session->userdata('id_admin')!=""){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');

        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('department',array('id'=>$id_notifications)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('department',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/department','refresh');
	}
	else {
		redirect(base_url().'admin/','refresh');	
	}

    }
	
	
	function check_view_department(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("department",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("department",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("department",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
}
