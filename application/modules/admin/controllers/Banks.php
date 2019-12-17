<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banks extends MX_Controller
{
    	private $API_ACCESS_KEY     = 'AAAAprRdHDg:APA91bE0FyVm16v9s2ud1rphBOyrOWD6aiZpg68wJ1B_XbriEf5rRP_hCunGUxYJ_bB6VlrgM7-KzitL_7F8P0lt-ObRkZfNmE1wM3TMjHEV57oYJPtWf4FyzI1m0sQpr-d_nfQrzrsX';


    public function __construct()
    {
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
    
    
    function send_notification($token,$title,$message)
	{
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		$notification = [
            'title' =>$title,
            'body' => $message,
            'date' => date("Y-m-d")
        ];
        $extraNotificationData = ["message" => $notification];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

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
        redirect(base_url().'admin/banks/payment_type','refresh');
    }
    
    

    public function payment_type(){
        $pg_config['sql'] = $this->data->get_sql('bank_payment_type','','id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/banks/payment_type", $data); 
    }

    public function requested_courses(){
        $pg_config['sql'] = $this->data->get_sql('soical_advertising',array("view"=>'0'),'id','DESC');
        $pg_config['per_page'] = 20;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/banks/requested_courses", $data); 
    }


    public function archive_social(){
        $pg_config['sql'] = $this->data->get_sql('soical_advertising',array("status"=>'1','view'=>'1'),'id','DESC');
        $pg_config['per_page'] = 20;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/banks/archive_social", $data); 
    }   


 public function change_status(){
 $id_pages = $this->input->get('id');     
  $data['data'] = $this->data->get_table_data('bank_accounts_forms',array('id'=>$id_pages));
  $this->load->view("admin/banks/change_status",$data); 
    }
 public function request_courses_status(){
 $id_pages = $this->input->get('id');     
  $data['data'] = $this->data->get_table_data('soical_advertising',array('id'=>$id_pages));
  $this->load->view("admin/banks/request_courses_status",$data); 
    }    
    
    
       public function add(){
        $this->load->view("admin/banks/add"); 
    }

    public function add_action(){
        $title=$this->input->post('title');
         $data['name'] = $title;
        $this->db->insert('bank_payment_type',$data);
        $this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
        redirect(base_url().'admin/banks/payment_type','refresh');
    }



public function requestedstatus_action(){
		$id=$this->input->post('id');
        $status=$this->input->post('status');
       // $id_order = get_table_filed('bank_accounts_forms',array('id'=>$id),"id_order");
       // $data['status'] = $status;
        $data['view']=$status;
        $data['status'] = $status;
        $this->db->update("soical_advertising",$data,array('id'=>$id));
       // $this->db->update("bank_accounts_forms",array("status"=>$status),array('id'=>$id));
/*$id_user = get_table_filed('request_courses',array('id'=>$id),"id_user");
$key_type = get_table_filed('request_courses',array('id'=>$id),"type");
$id_course = get_table_filed('request_courses',array('id'=>$id),"id_course");


$social_id = get_table_filed('customers',array('id'=>$id_user),"social_id");
$notifications_num = get_table_filed('customers',array('id'=>$id_user),"notifications_num");


	
if($key_type!=2){
$course_name = get_table_filed('products',array('id'=>$id_course,'view'=>'1'),"name");
}
else {
 $course_name = get_table_filed('bag_info',array('id'=>$id_course,'view'=>'1'),"bage_name");
}

$notifydata['notifications_num']=$notifications_num+1;


$title="تأكيد طلب حجز دورة";
if($status==1){
$data_notify['description'] =" تم تأكيد طلب حجز دورة   $course_name " ;
$content =" تم  تأكيد طلب حجز دورة $course_name " ;
}
else if($status==2){ 
$data_notify['description'] =" تم رفض طلب حجز دورة    $course_name " ;
$content ="تم رفض طلب حجز دورة     $course_name " ;
}
else if($status==0){ 
$data_notify['description'] =" منتظر رد الأدارة على طلب حجز الدورة   $course_name " ;
$content ="منتظر رد الادارة على طلب حجز دورة $course_name " ;
}

        $data_notify['title'] = "تاكيد طلب حجز الدورة";
        $data_notify['type'] = '1';
        $data_notify['course_key']=$key_type;
        $data_notify['creation_date'] =date("Y-m-d");
		$data_notify['customer_id'] =$id_user;
		$data_notify['course_id	'] =$id_course;
		$this->db->insert('notifications',$data_notify);
$this->db->update("customers",$notifydata,array("id"=>$id_user));
$this->send_notification($social_id,$title,$content);*/


if($id!=""){	
send_email($id,"soical_requested","change_status");
echo 1;
}
else {
echo 0;
}


	}



public function status_action(){
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$data['status'] = $status;

		$id=$this->input->post('id');
        $status=$this->input->post('status');
        $id_order = get_table_filed('bank_accounts_forms',array('id'=>$id),"id_order");
        $data['status'] = $status;
        $data['view']='1';
        $this->db->update("soical_advertising",array("status"=>$status),array('id'=>$id_order));
        $this->db->update("bank_accounts_forms",array("status"=>$status),array('id'=>$id));

if($id!=""){	
 send_email($id,"payment","change_status");
echo 1;
}
else {
echo 0;
}


	}



    public function delete(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('bank_payment_type',array('id'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('bank_payment_type',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/banks/payment_type','refresh');
    }


    
        function delete_payment(){
    $id_pages = $this->input->get('id_pages');
        if($id_pages!=""){
        $ret_value=$this->db->update('bank_accounts_forms',array("admin_delete"=>'2'),array('id'=>$id_pages)); 
        }
        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/banks/bank_payments','refresh');
    }
    
    
    
    
    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("pages",array("id"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("pages",array("active" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("pages",array("active" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('bank_payment_type',array('id'=>$id));
        $this->load->view("admin/banks/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
        $title=$this->input->post('title');
   

        $data['name'] = $title;
      
        $re=$this->data->edit_table_id('bank_payment_type',array('id'=>$id),$data);
        $this->session->set_flashdata('msg', 'Success Edited');
        redirect(base_url().'admin/banks/payment_type','refresh');
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
    
    
        
    public function delete_advert_soical(){
        $id_pages = $this->input->get('id_pages');
        $check=$this->input->post('check');

        if($id_pages!=""){
        $ret_value=$this->data->delete_table_row('soical_advertising',array('id'=>$id_pages)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('soical_advertising',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/banks/requested_courses','refresh');
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




 public function bank_payments(){
        $pg_config['sql'] = $this->data->get_sql('bank_accounts_forms',array("admin_delete"=>'1'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/banks/bank_payments", $data); 
    }

    

    public function requested_soical(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('soical_advertising',array('id'=>$id));
        $this->load->view("admin/banks/requested_soical",$data); 
        
    }
}