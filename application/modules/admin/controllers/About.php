<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination'); 
    }

	public function gen_random_string()

{
$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
$final_rand='';
for($i=0;$i<4; $i++) {
 $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
return $final_rand;
}
    public function index(){
    redirect(base_url().'admin/about/show','refresh');
    }

    public function show(){
		$data['site_info']= $this->data->get_table_data('site_setting');
		$this->load->view("admin/about/show",$data); 
    }

	


	public function edit_about(){
$about_site=$this->input->post('about_site');
$data = array('about'=>$about_site);
$this->db->update('site_setting',$data,array('id'=>1));
if($_FILES['file']['name']!=""){
$file=$_FILES['file']['name'];
$file_name="file";
$config=get_img_config('site_setting','uploads/site_setting/',$file,$file_name,'about_img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>1),"650","450");
}
		
$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
$this->session->mark_as_flash('msg');
redirect('/admin/about/show');	

}






public function vision(){
	$data['site_info']= $this->data->get_table_data('site_setting');
	$this->load->view("admin/about/vision",$data); 
}




public function edit_vision(){
	$about_site=$this->input->post('vision_site');
	$data = array('vision'=>$about_site);
	$this->db->update('site_setting',$data,array('id'=>1));


if($_FILES['file']['name']!=""){
$file=$_FILES['file']['name'];
$file_name="file";
$config=get_img_config('site_setting','uploads/site_setting/',$file,$file_name,'vision_img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>1),"450","350");
}

$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
$this->session->mark_as_flash('msg');
redirect('/admin/about/vision');	

}




public function message(){
	$data['site_info']= $this->data->get_table_data('site_info');
	$this->load->view("admin/about/message",$data); 
}




public function edit_message(){
	$message_site=$this->input->post('message_site');
	$message_site_ar=$this->input->post('message_site_ar');
	$data = array('message_site'=>$message_site,'message_site_ar'=>$message_site_ar);
	$this->db->update('site_info',$data,array('id'=>1));

	if($_FILES['file']['name']!=""){
$file=$_FILES['file']['name'];
$file_name="file";
$config=get_img_config('site_info','uploads/site_setting/',$file,$file_name,'message_img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>1),"450","350");
}

		$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
		$this->session->mark_as_flash('msg');
		redirect('/admin/about/message');	

}





public function goals(){
	$data['site_info']= $this->data->get_table_data('site_info');
	$this->load->view("admin/about/goals",$data); 
}




public function edit_goals(){
	$message_site=$this->input->post('goals_site');
	$message_site_ar=$this->input->post('goals_site_ar');
	$data = array('goals_site'=>$message_site,'goals_site_ar'=>$message_site_ar);
	$this->db->update('site_info',$data,array('id'=>1));

	//die();
	//echo "fFF".$_FILES['file']['name'];
	if($_FILES['file']['name']!=""){
	  $logo = $this->data->get_table_row('site_info',array('id'=>1),'goals_img'); 
	  if ($logo != "") {
	  unlink("uploads/site_setting/$logo");
	  }
	  $img_name=$this->gen_random_string(); 
	  $imagename = $img_name;
	  $config['upload_path'] = 'uploads/site_setting/';
	  $config['allowed_types']        = 'gif|jpg|png|jpeg';
	  $config['max_size']             =600000;
	  $config['max_width']            = 600000;
	  $config['max_height']           = 600000;
	  $config['file_name'] = $imagename; 
	  $this->load->library('upload', $config);
	  $this->upload->initialize($config);
	  if (!$this->upload->do_upload('file')){
	  echo $this->upload->display_errors();
	   }
	  else {
	  $url= $_FILES['file']['name'];
	  $ext = explode(".",$url);
	  $file_extension = end($ext);
	  $data = array('goals_img'=>$imagename.".".$file_extension);
	  $this->db->update('site_info',$data,array('id'=>1));
	   //echo $this->db->last_query();
	 //die();
		}
	  
		}
		$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
		$this->session->mark_as_flash('msg');
		redirect('/admin/about/goals');	

}

public function bmi(){
	$data['site_info']= $this->data->get_table_data('home_page');
	$this->load->view("admin/about/bmi",$data); 
}

public function edit_bmi(){
	$bmi_site_ar=$this->input->post('bmi_site_ar');
	$bmi_site=$this->input->post('bmi_site');
	$bmi_base=$this->input->post('bmi_base');
	
	$data = array('bmi_base'=>$bmi_base,'bmi_site'=>$bmi_site,'bmi_site_ar'=>$bmi_site_ar);
	$this->db->update('home_page',$data,array('id'=>1));


		$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
		$this->session->mark_as_flash('msg');
		redirect('/admin/about/bmi');	

}

}
