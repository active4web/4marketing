<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends MX_Controller
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
		redirect(base_url().'admin/places/countries','refresh');
    }

    public function countries(){
		$where = "";
        $pg_config['sql'] = $this->data->get_sql('country',$where,'id','DESC');
        $pg_config['per_page'] = 30;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/places/countries", $data); 
	
    }
        public function cities(){
		$where = "";
        $pg_config['sql'] = $this->data->get_sql('city',$where,'id','DESC');
        $pg_config['per_page'] = 30;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/places/cities", $data); 
	
    }
    
    
	
	public function add(){
        $this->load->view("admin/places/add"); 
    }

	public function details(){
		$id=$this->input->get('id');
		$data['services_type']=$this->db->get_where("country",array('id'=>$id))->result();
        $this->load->view("admin/places/details",$data); 
	}
	
    public function add_action(){
        $title=$this->input->post('title');
		$data['title'] = $title;
	     $this->db->insert('country',$data);
$id = $this->db->insert_id();
$this->session->set_flashdata('msg', 'تم الأضافة بنجاح');
$this->session->mark_as_flash('msg');
redirect(base_url().'admin/places/cities','refresh');

}
public function edit_action(){
	$update_date=date("Y-m-d h:i:s");
	$title=$this->input->post('title');
	$id=$this->input->post('id');
	$data_service['title'] = $title;
	$data['id_service'] =$id;
	 $this->db->update('country',$data_service,array('id'=>$id));
     $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
     $this->session->mark_as_flash('msg');
     redirect(base_url().'admin/places/cities','refresh');

}

	

	
	
	public function city_delete(){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');

        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('city',array('id'=>$id_notifications)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('city',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/places/cities','refresh');


    }


	public function delete(){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');

        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('country',array('id'=>$id_notifications)); 
       $this->data->delete_table_row('city',array('country_id'=>$id_notifications)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('country',array('id'=>$check[$i]));   
        $this->data->delete_table_row('city',array('country_id'=>$check[$i])); 
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/places','refresh');


    }
	
	


	function check_view_countries(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("country",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("country",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("country",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
    
  
  	function check_view_city(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("city",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("city",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("city",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
    
    
    	public function add_city(){
        $this->load->view("admin/places/add_city"); 
    }
    
    
    public function city_action(){
        $update_date=date("Y-m-d");
        $title=$this->input->post('title');
       // $country_id=$this->input->post('country_id');
		$data['name'] = $title;
		$data['date'] = $update_date;
	//	$data['country_id'] = $country_id;
	     $this->db->insert('city',$data);
$id = $this->db->insert_id();
$this->session->set_flashdata('msg', 'تم الأضافة بنجاح');
		$this->session->mark_as_flash('msg');
		redirect(base_url().'admin/places/cities','refresh');

}


public function city_details(){
		$id=$this->input->get('id');
		$data['services_type']=$this->db->get_where("city",array('id'=>$id))->result();
        $this->load->view("admin/places/city_details",$data); 
	}

public function edit_city_action(){
	$update_date=date("Y-m-d h:i:s");
	$title=$this->input->post('title');
	$id=$this->input->post('id');
	$data_service['name'] = $title;
/*	$country_id=$this->input->post('country_id');
	if($country_id!=""){
	$data_service['country_id'] = $country_id;    
	}*/
	 $this->db->update('city',$data_service,array('id'=>$id));
     $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
     $this->session->mark_as_flash('msg');
     redirect(base_url().'admin/places/cities','refresh');
}
    
}




