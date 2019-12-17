<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codes extends MX_Controller{

public function __construct(){
        parent::__construct();
        $this->lang->load('admin', get_lang() );
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination');
        $this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../design/ckfinder/');      
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
        redirect(base_url().'admin/codes/user_codes','refresh');
    }
    
    

    public function user_codes(){
        $pg_config['sql'] = $this->data->get_sql('codes','','id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/codes/user_codes", $data); 
    }


       public function add(){
        $this->load->view("admin/codes/add"); 
    }

    public function add_action(){
 $code=$this->input->post('code');
        $discount=$this->input->post('discount');
        $total_used_user=$this->input->post('total_used_user');
         $start_date=$this->input->post('start_date');
          $enddate=$this->input->post('enddate');
           $total_used=$this->input->post('total_used');

        $data['code_name'] = $code;
        $data['discount'] = $discount;
        $data['user_using'] = $total_used_user;
        $data['total_used'] = $total_used;
        $data['end_date'] =$enddate;
        $data['start_date'] =$start_date;
        $this->db->insert('codes',$data);
 $id = $this->db->insert_id();
 if($id!=""){echo 1;}
 else {echo 1;}
    }





    public function delete_code(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('codes',array('id'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('codes',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/codes/user_codes','refresh');
    }


    
    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("codes",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("codes",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("codes",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('codes',array('id'=>$id));
        $this->load->view("admin/codes/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
$code=$this->input->post('code');
        $price=$this->input->post('price');
         $time_days=$this->input->post('time_days');
          $descrption=$this->input->post('descrption');
           $total_used=$this->input->post('total_used');

        $data['code_name'] = $code;
        $data['total_used'] = $total_used;
        $data['time_days'] =$time_days;
        $data['price'] =$price;
        $data['descrption'] =$descrption;

        $re=$this->db->update('codes',$data,array('id'=>$id));

if($_FILES['file']['name']!=""){
  $file=$_FILES['file']['name'];
  $file_name="file";
  $config=get_img_config('codes','uploads/icon/',$file,$file_name,'icon','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"60","60");


    }
  $this->session->set_flashdata('msg', 'تم تحديث البيانات بنجاح');
$this->session->mark_as_flash('msg'); 
redirect(base_url().'/admin/codes/user_codes', 'refresh'); 
    }    
/****************Terms*************************************/
 
      public function bank_accounts(){
        $pg_config['sql'] = $this->data->get_sql('bank_accounts','','id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/banks/bank_accounts", $data); 
    }

    public function add_bank_accounts(){
        $this->load->view("admin/banks/add_bank_accounts"); 
    }
 
 public function bank_accounts_action(){
        $title=$this->input->post('title');
        $account_number=$this->input->post('account_number');
        $iban_number=$this->input->post('iban_number');
         $user_name=$this->input->post('user_name');

        $data['name_bank'] = $title;
        $data['user_name'] = $user_name;
        $data['account_number'] = $account_number;
        $data['iban_number'] = $iban_number;
        $data['creation_date'] =date("Y-m-d");
        $this->db->insert('bank_accounts',$data);
 $id = $this->db->insert_id();
 if($id!=""){echo 1;}
 else {echo 1;}
    }
    
    
        function active_banks(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("bank_accounts",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("bank_accounts",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("bank_accounts",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
    
    public function delete_bank_accounts(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('bank_accounts',array('id'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('bank_accounts',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/banks/bank_accounts','refresh');
    }
       
    
        public function edit_bank_accounts(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('bank_accounts',array('id'=>$id));
        $this->load->view("admin/banks/edit_bank_accounts",$data); 
    }

    function edit_bank_accounts_action(){
        $id=$this->input->post('id');
        $title=$this->input->post('title');
        $account_number=$this->input->post('account_number');
        $iban_number=$this->input->post('iban_number');
         $user_name=$this->input->post('user_name');

        $data['name_bank'] = $title;
        $data['user_name'] = $user_name;
        $data['account_number'] = $account_number;
        $data['iban_number'] = $iban_number;
        $data['creation_date'] =date("Y-m-d");
        $this->db->update('bank_accounts',$data,array("id"=>$id));
 if($id!=""){echo 1;}
 else {echo 1;}
    }
    
    
/******************************************************************
********************Point Info***********************************************
*******************************************************************/
      public function point_info(){
        $pg_config['sql'] = $this->data->get_sql('points_terms','','id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/pages/point_info", $data); 
    }

    public function add_points_terms(){
        $this->load->view("admin/pages/add_points_terms"); 
    }
 
 public function points_terms_action(){
        $user_type=$this->input->post('user_type');
        $content=$this->input->post('content');
        $data['user_key'] = $user_type;
        $data['content'] = $content;
        $data['creation_date']=date("Y-m-d");
        $data['view'] = '1';
        $this->db->insert('points_terms',$data);
        $this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
      redirect(base_url().'admin/pages/point_info','refresh');
    }
    
    
    public function delete_points_terms(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('points_terms',array('id'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('points_terms',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/pages/point_info','refresh');
    }
       
    
        public function edit_points_terms(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('points_terms',array('id'=>$id));
        $this->load->view("admin/pages/edit_points_terms",$data); 
    }

    function edit_points_terms_action(){
        $id=$this->input->post('id');
     $user_type=$this->input->post('user_type');
        $content=$this->input->post('content');
        $data['content'] = $content;
        if($user_type!=""){
        $data['user_key'] = $user_type;
        }

        $re=$this->data->edit_table_id('points_terms',array('id'=>$id),$data);
        $this->session->set_flashdata('msg', 'تم التعديلا بنجاح');
        redirect(base_url().'admin/pages/point_info','refresh');
    }


}