<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Api extends API_Controller
{
    public function __construct() {
        parent::__construct();
		$this->load->model('data','','true');
		date_default_timezone_set('Asia/Riyadh');
		$this->load->library('Authorization_Token');
    }
	
	public function checkLang()
    {
       // $language = $this->input->post('lang');
       $language= "ar";
		if ($language == "ar") {
            $this->lang->load('api_lang', "arabic");
            $this->lang->load('form_validation_lang', "arabic");
        } else {
            $this->lang->load('api_lang', "english");
            $this->lang->load('form_validation_lang', "english");
        }
    }

    /**
     * Check API Key
     *
     * @return key|string
     */
    private function key()
    {
        // use database query for get valid key
        return 1234567890;
    }
       
       
       
     public function get_test_city(){
 $this->_apiConfig(['methods' => ['POST']
 //,'key' => ['POST', $this->key()]
 ]);
	$home_city=$this->db->order_by('id','desc')->get_where('city',array('view'=>'1','country_id'=>1))->result();
		if (count($home_city)>0) {
            	
        foreach ($home_city as $page) {
            $result['city_name']=$page->name;
             $result['city_id']=(int)$page->id;
        $data['cities'][]= $result;
        }
		            if ($data) {
              $this->api_return([
						'errNum' => 405, //active4web copyright 2019
						'status' => true,
						"result" => $data
					],200);
            }
      }
      else{
        $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'errNum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }
    }
 
 
    public function get_all_city(){
        header("Access-Control-Allow-Origin: *");
        // API Configuration #endregion
        //this configration for any api
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
    $this->checkLang($lang); 
	$home_city=$this->db->order_by('id','desc')->get_where('city',array('view'=>'1','country_id'=>1))->result();
		if (count($home_city)>0) {
            	
        foreach ($home_city as $page) {
            $result['city_name']=$page->name;
             $result['city_id']=(int)$page->id;
        $data['cities'][]= $result;
        }
		            if ($data) {
              $this->api_return([
						'errNum' => 405, //active4web copyright 2019
						'status' => true,
						"result" => $data
					],200);
            }
      }
      else{
        $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'errNum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }
    }
    
    
public function get_advertsing_messages(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
$this->form_validation->set_rules('message_id', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}


if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 0);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 1);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 0);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 1);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{



$query = $this->db->get('messages');
$customer_infop['mychat_num']=count($query->result());
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id!=""){
$limit=$this->input->post('limit');
$page_number=$this->input->post('page_number');
$this->db->where("(server_id=$customers_id OR send_id=$customers_id)");
$this->db->where("view='1'");
$query_t= $this->db->get('messages');
$main_t=$query_t->result();
$total =count($main_t);
         
$offset =$limit * $page_number;
$this->db->where("(server_id=$customers_id OR send_id=$customers_id)");
$this->db->where("view='1'");
$this->db->order_by('id','DESC');
$this->db->limit($limit, $offset);
$query = $this->db->get('messages');
$sql_product=$query->result();

if (count($sql_product)>0) {
foreach ($sql_product as $page) {
$result['description']=mb_substr($page->message,0,120);
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
$result['id']=(int)$page->id;
$data['all_message'][]= $result;
}
                   
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_bage'] = [];
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              "result" => $data
              ],200);
                }
                
}
else {$this->api_return([ 'message' => lang('Customer ID notcorrect'), 'errNum' => 402, 'status' => false, ],200);}
}
}


    
        public function get_all_category(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
        //this for lang check it
    $this->checkLang($lang); 
	$home_city=$this->db->order_by('id','desc')->get_where('category',array('view'=>'1'))->result();
		if (count($home_city)>0) {
        foreach ($home_city as $page) {
            $result['category_name']=$page->name;
             $result['category_id']=(int)$page->id;
        $data['categories'][]= $result;
        }
		            if ($data) {
              $this->api_return([
						'errNum' => 405, //active4web copyright 2019
						'status' => true,
						"result" => $data
					],200);
            }
      }
      else{
        $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'errNum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }
    }
    



 public function get_all_sub_category(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
        //this for lang check it
    $this->checkLang($lang); 
$this->load->library('form_validation');
$this->form_validation->set_rules('cat_id', lang('Customer ID'), 'trim|required');

  if($this->form_validation->run() === FALSE){
      
if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=> strip_tags(lang('Cat Id')),"errNum" => 0);
}	
}

$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$home_city=$this->db->order_by('id','desc')->get_where('department',array('id_cat'=>$this->input->post('cat_id'),'view'=>'1'))->result();
		if (count($home_city)>0) {
        foreach ($home_city as $page) {
            $result['dep_name']=$page->name;
             $result['de_id']=(int)$page->id;
        $data['All Departments'][]= $result;
        }
		            if ($data) {
              $this->api_return([
						'errNum' => 405, //active4web copyright 2019
						'status' => true,
						"result" => $data
					],200);
            }
      }
      else{
        $data['All Departments'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'errNum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }
}
    }
    



public function get_all_department(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
        ]);
       $lang = "ar";
    $this->checkLang($lang); 
$home_city=$this->db->order_by('id','desc')->get_where('category',array('view'=>'1'))->result();
if (count($home_city)>0) {   
    foreach ($home_city as $page) {
        $result['cat_name']=$page->name;
         $result['cat_id']=(int)$page->id;
         $result['cat_icon']=base_url()."uploads/category/".$page->icon;
         $result['Departments']=[];
    $home_dep=$this->db->order_by('id','desc')->get_where('department',array('id_cat'=>(int)$page->id,'view'=>'1'))->result();
		if (count($home_dep)>0) {
        foreach ($home_dep as $pages) {
            $depart['dep_name']=$pages->name;
             $depart['dep_id']=(int)$pages->id;
        $result['Departments'][]= $depart;
        }
      }
      else {$result['Departments']=[];}
     
      $data['Categories'][]= $result;
            }
            $this->api_return([
              'errNum' => 405, //active4web copyright 2019
              'status' => true,
              "result" => $data
            ],200);
      }
      else{
        $data['Categories'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'errNum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }

      

    }
    



public function preparation_search(){
    
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
	
    $home_city=$this->db->order_by('id','desc')->get_where('city',array('view'=>'1'))->result();
		if (count($home_city)>0) {
            	
        foreach ($home_city as $page) {
            $result['city_name']=$page->name;
             $result['city_id']=(int)$page->id;
        $data['cities'][]= $result;
        }
        
        
		}
	    else{
	         $result['city_name']="";
             $result['city_id']="";
        $data['cities'][]= $result;
        	$data['cities'][]=$data;
       }
    
    
	$home_category=$this->db->order_by('id','desc')->get_where('category',array('view'=>'1'))->result();
		if (count($home_category)>0) {
            	
        foreach ($home_category as $page_home) {
            $result_cat['category_name']=$page_home->name;
             $result_cat['category_id']=(int)$page_home->id;
        $data['categories'][]= $result_cat;
        }
             
            }
      
      else{
           $result_cat['category_name']="";
             $result_cat['category_id']="";
        $data['categories'][]= $result_cat;
       }
       
       
 
       
if($data){
$this->api_return([
'keynum' => 405, //active4web copyright 2019
'status' => true,
"result" => $data
],200); 
}

else {
         $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);   
}
       

       
    }
    
	
	public function set_register(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
       $lang ="ar";
      $this->checkLang($lang);
        $this->load->library('Authorization_Token');
		$this->load->library('form_validation');
$this->form_validation->set_rules('name',lang('Username'), 'trim|required');
$this->form_validation->set_rules('phone', lang('Phone Number'), 'trim|required|numeric');
$this->form_validation->set_rules('email', lang('Email'), 'trim|required|valid_email');
$this->form_validation->set_rules('password', lang('Password'), 'trim|required|min_length[8]');
$this->form_validation->set_rules('city', lang('city'), 'trim|required');

if($this->form_validation->run() === FALSE){ 

$email_find = get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
$phone_find= get_table_filed('customers',array('phone'=>$this->input->post('phone')),"phone");


if(form_error('name')){
if($this->input->post('name')==="" || !$this->input->post('name')){
$data[] = array('message'=> strip_tags(lang('Username')),"errNum" => 0);
}
}


if(form_error('email')){
if($this->input->post('email')==="" || !$this->input->post('email')){
$data[] = array('message'=> strip_tags(lang('Email')),"errNum" => 1);
}elseif($email_find!=""){
$data[] = array('message'=> strip_tags(lang('Email')),"errNum" =>2);
}else{
$data[] = array('message'=> strip_tags(lang('error_email')),"errNum" =>3);
}
}
//**************** */
if(form_error('phone')){
if($this->input->post('phone')==="" || !$this->input->post('phone')){
$data[] = array('message'=> strip_tags(lang('Phone Number')),"errNum" =>4);
}elseif($phone_find!=""){
$data[] = array('message'=> strip_tags(lang('Phone Number')),"errNum" =>5);
}else{
$data[] = array('message'=> strip_tags(lang('error_phone')),"errNum" =>6);
}
}


if(form_error('password')){
if($this->input->post('password')==="" || !$this->input->post('password')){
$data[] = array('message'=> strip_tags(lang('Password')),"errNum" =>7);
}else{
$data[] = array('message'=> strip_tags(lang('Password Leng')),"errNum" =>8);
}
}


if(form_error('city')){
if($this->input->post('city')==="" || !$this->input->post('city')){
$data[] = array('message'=> strip_tags(lang('city')),"errNum" =>9);
} 
}
       
$this->api_return([
'message' => $data[0]['message'],
'errNum' => $data[0]['errNum'],
'status' => false
],200); 
}
       
else{

$email_find = get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
$phone_find= get_table_filed('customers',array('phone'=>$this->input->post('phone')),"phone");

if($phone_find!=""){
$data[] = array('message'=> strip_tags(lang("phone_anthor")),"errNum" =>10);
}
if($email_find!=""){
$data[] = array('message'=> strip_tags(lang("email_anthor")),"errNum" =>11);
}
if($phone_find!=""||$email_find!=""){
$this->api_return([
'message' => $data[0]['message'],
'errNum' => $data[0]['errNum'],
'status' => false
],200);
}

else if($phone_find==""&&$email_find==""){
date_default_timezone_set('Asia/Riyadh');
$store = [
'user_name'          	=> $this->input->post('name'),
'password'            => md5($this->input->post('password')),
'email'          		=> $this->input->post('email'),
'phone'               => $this->input->post('phone'),
'city_id'    	=> $this->input->post('city'),
'view'    	=> '1',
'creation_date'       => date('Y-m-d H:i:s'),
];

$insert = $this->db->insert('customers',$store);
$id= $this->db->insert_id();    


if($insert){
$customer = get_this('customers',['id'=>$id]);
if ($customer) {
$id = $customer['id'];
$customer_info =get_this('customers',['id'=>$id]);
$payload = ['id' => $customer_info['id'],
'phone' => $customer_info['phone'],
'email' => $customer_info['email']
];
$token = $this->authorization_token->generateToken($payload);
$token_data['token'] = $token;
$token_data['id_customer'] = $id;
$this->db->insert("customers_token",$token_data);
$this->db->update("customers",array("device_id"=>$token),array("id"=>$customer_info['id']));
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['city'] =$customer_info['city_id'];
$customer_infop['token_id'] =$token;
$data['customer_info'] = $customer_infop;

send_email($id,"user","register");
$total_used=get_table_filed('codes',array('id'=>3),"total_used");
$time_days=get_table_filed('codes',array('id'=>3),"time_days");
$expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
$coustomer_code_id= get_table_filed('coustomer_code',array('id_customer'=>$id,'id_code'=>3,'count<='=>$total_used,'expire_date>'=>date("Y-m-d")),"id");
if($coustomer_code_id==""){

$data_code['id_customer']=$id;
$data_code['id_code']=3;
$data_code['count']=0;
$data_code['creation_date']=date('Y-m-d');
$data_code['expire_date']=$expire_date;
$data_code['success']='1';
$data_code['package_end']='0';
$insert = $this->db->insert('coustomer_code',$data_code);
}
$this->api_return([
'message' => lang('register message'),
'errNum' => 405,
'status' => true,
"result" => $data
],200);

}
else {
$data['customer_info'] = [];
$this->api_return([
'message' => lang('no_data'),
'keynum' =>401,
'status' => false,
"result" => $data
],200);   
}
}
}


else{
$data['customer_info'] =$customer_infop['using_share'];
$this->api_return([
'message' => lang('An error in the register'),
'errNum' =>402,
'status' => false,
'data'=>$data,
],200);
}




    
}
       
}





public function preparation_profile() {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
        ]);
        
 $lang = "ar";
 $this->checkLang($lang); 
	$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
 if($this->form_validation->run() === FALSE){
            if(form_error('token_id')) {
                if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
                $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
                }
            }

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);


        }
        else{
   $customer_id= get_customer_id($this->input->post('token_id')); //get_this('customers',['device_reg_id'=>$this->input->post('token_id')]);

if ($customer_id!="") {
$id = $customer_id;
   $customer_info =get_this('customers',['id'=>$id]);
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['city'] = $customer_info['city_id'];
$customer_infop['token'] =$this->input->post('token_id');
 $data['customer_info'] = $customer_infop;
 
                              $this->api_return([
								'message' => lang('Operation completed successfully'),
								'errNum' => 405,
								'status' => true,
								"result" => $data
								],200);
							 
                     }
                     else {
                         $this->api_return([
'message' => lang('device_token_id_error'),
'errNum' => 4,
'status' => false
],200);
                     }
               
            
        }
	}



public function edit_profile() {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
			//'requireAuthorization' => true
        ]);
        
 $lang = "ar";
 $this->checkLang($lang); 
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('name',lang('Username'), 'trim|required');
$this->form_validation->set_rules('phone', lang('Phone Number'), 'trim|required|numeric');
$this->form_validation->set_rules('email', lang('Email'), 'trim|required|valid_email');
$this->form_validation->set_rules('city', lang('city'), 'trim|required');

$customer_id= get_customer_id($this->input->post('token_id'));
$phone = get_this('customers',['id'=>$customer_id],'phone');
$email = get_this('customers',['id'=>$customer_id],'email');

if($this->input->post('phone') === "" || $this->input->post('phone') != null){
if ($phone != $this->input->post('phone')) {
$this->form_validation->set_rules('phone', lang('phone_anthor'), 'trim|required|is_unique[customers.phone]');
}
}

if($this->input->post('email') === "" || $this->input->post('email') != null){
if ($email != $this->input->post('email')) {
$this->form_validation->set_rules('email', lang('email_anthor'), 'trim|required|valid_email|is_unique[customers.email]');
}
}
		

		
        if($this->form_validation->run() === FALSE){
            
            if(form_error('token_id')) {
                if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
                $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
                }
                else{
		$data[] = array('message'=> strip_tags(lang('Customer ID_notfind')),"errNum" => 1);
				}
            }
           
				
            if(form_error('name')){
                if($this->input->post('name')==="" || !$this->input->post('name')){
                $data[] = array('message'=> strip_tags(lang('Username')),"errNum" => 0);
                }
            }
  //**************** */
    if(form_error('email')){
	if($this->input->post('email')==="" || !$this->input->post('email')){
	$data[] = array('message'=> strip_tags(lang('Email')),"errNum" => 0);
				}else{
		$data[] = array('message'=> strip_tags(lang('email_anthor')),"errNum" => 1);
				}
            }
              //**************** */
            if(form_error('phone')){
				if($this->input->post('phone')==="" || !$this->input->post('phone')){
					$data[] = array('message'=> strip_tags(lang('Phone Number')),"errNum" => 0);
				}else{
					$data[] = array('message'=> strip_tags(lang('phone_anthor')),"errNum" => 1);
				}
            }
     
if(form_error('city')){
if($this->input->post('city')==="" || !$this->input->post('city')){
$data[] = array('message'=> strip_tags(lang('city')),"errNum" =>9);
} 
}

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);


        }
        else{
$customerid =    $customer_id= get_customer_id($this->input->post('token_id'));
$customer = get_this('customers',['id'=>$customerid]);
if ($customer) {
$id = $customer['id'];
$store['user_name'] = $this->input->post('name');
$store['email'] = $this->input->post('email');
$store['phone'] = $this->input->post('phone');
$store['city_id'] = $this->input->post('city');

$this->Main_model->update('customers',['id'=>$id],$store);
$customer_info =get_this('customers',['id'=>$id]);
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['city'] = $customer_info['city_id'];
$customer_infop['token_id'] =$this->input->post('token_id');
 $data['customer_info'] = $customer_infop;

							  
                              $this->api_return([
								'message' => lang('Successfully updated'),
								'errNum' => 405,
								'status' => true,
								"result" => $data
								],200);
							 
                     }
                     else {
                          $this->api_return([
						'message' => lang('Customer ID notcorrect'),
						'errNum' => 402,
						'status' => false
						],200);
                     }
               
            
        }
	}





public function change_password() {
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
        $lang = "ar";
$this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('current_password', lang('Current Password'), 'trim|required');
 $this->form_validation->set_rules('new_password', lang('New Password'), 'trim|required|min_length[8]');

		 if($this->form_validation->run() === FALSE){
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
		  
if(form_error('current_password')){
$data[] = array('message'=> strip_tags(lang('Current Password')),"errNum" =>2);
}

if(form_error('new_password')){
if($this->input->post('new_password')==="" || !$this->input->post('new_password')){
$data[] = array('message'=> strip_tags(lang('New Password')),"errNum" =>3);
}else{
$data[] = array('message'=> strip_tags(lang('New Password')),"errNum" =>4);
}
}
		  
$this->api_return([
'message' => $data[0]['message'],
'errNum' => $data[0]['errNum'],
'status' => false
],200);
        }
        else{
			$customerid =    $customer_id= get_customer_id($this->input->post('token_id'));
			
             $customeremail = get_table_filed('customers',array('id'=>$customerid),"email");
			if($customeremail!=""){
			    $password = get_table_filed('customers',array('id'=>$customerid),"password");
				if ($password == md5($this->input->post('current_password')) ) {
					$update = ['password' => md5($this->input->post('new_password'))];
					$this->Main_model->update('customers',['id'=>$customerid],$update);
				   $this->api_return([
					   'message' => lang('Password changed successfully'),
						'errNum' => 405,
						'status' => true
					],200);

				}else{
				$this->api_return([
						'message' => lang('Sorry, the current password is incorrect'),
						'errNum' => 3,
						'status' => false
						],200);
				}
			}else{
				   $this->api_return([
						'message' => lang('Customer ID notcorrect'),
						'errNum' => 402,
						'status' => false
						],200);
			}
        }		
	}

	
	


     public function get_all_category_icon(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
        //this for lang check it
    $this->checkLang($lang); 
	$home_city=$this->db->order_by('id','desc')->get_where('category',array('view'=>'1'))->result();
		if (count($home_city)>0) {
            	
        foreach ($home_city as $page) {
            $result['cat_name']=$page->name;
             $result['cat_id']=$page->id;
             $result['cat_icon']=base_url()."uploads/category/".$page->icon;
        $data['departments'][]= $result;
        }
		            if ($data) {
              $this->api_return([
						'keynum' => 405, //active4web copyright 2019
						'status' => true,
						"result" => $data
					],200);
            }
      }
      else{
        $data['departments'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);
       }
    }

    //____________________Message____________________//

public function get_all_messages(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}


if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 0);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 1);}
}

if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 0);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 1);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{



$query = $this->db->get('messages');
$customer_infop['mychat_num']=count($query->result());
$customers_id=(int)get_customer_id($this->input->post('token_id'));    
if($customers_id!=""){
    $limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
    
$this->db->where("server_id=$customers_id");
$this->db->or_where("send_id=$customers_id");
$this->db->where("view='1'");
$this->db->where("id_reply=0");

$query_t= $this->db->get('messages');
$main_t=$query_t->result();
$total =count($main_t);
         
$offset =$limit * $page_number;
$this->db->where("server_id=$customers_id");
$this->db->or_where("send_id=$customers_id");
$this->db->where("view='1'");
$this->db->where("id_reply=0");
$this->db->order_by('id','DESC');
$this->db->limit($limit, $offset);
$query = $this->db->get('messages');
$sql_product=$query->result();

if (count($sql_product)>0) {
foreach ($sql_product as $page) {
$result['description']=mb_substr($page->message,0,120);
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
$result['advertsing_name']=get_table_filed('products',array('id'=>$page->id_products),"name");
if($customers_id==$page->send_id){
    $result['user_sender']="انت";
}
else {
$result['user_sender']=get_table_filed('customers',array('id'=>$page->send_id),"user_name");
}
$result['advertsing_name']=get_table_filed('products',array('id'=>$page->id_products),"name");
$result['id']=(int)$page->id;
$data['all_message'][]= $result;
}
                   
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_message'] = [];
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              "result" => $customers_id
              ],200);
                }
                
}
else {$this->api_return([ 'message' => lang('Customer ID notcorrect'), 'errNum' => 402, 'status' => false, ],200);}
}
}




public function message_details(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('message_id', lang('Message ID'), 'trim|required|numeric');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}


if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 2);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" =>3);}
}

if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" =>4);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" =>5);
  }
}

if(form_error('message_id')){
  if($this->input->post('message_id')==="" || !$this->input->post('message_id')){
    $data[] = array('message'=> strip_tags(lang('Message ID')),"errNum" =>6);
  }else{
    $data[] = array('message'=> strip_tags(lang('Message ID_error')),"errNum" =>7);
  }
}

            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{



$query = $this->db->get('messages');
$customer_infop['mychat_num']=count($query->result());
$customers_id=(int)get_customer_id($this->input->post('token_id'));    
if($customers_id!=""){
    $limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
  $message_id= $this->input->post('message_id');
$this->db->where("id_reply=$message_id");
$this->db->where("view='1'");
$this->db->where("id_reply!=0");

$query_t= $this->db->get('messages');
$main_t=$query_t->result();
$total =count($main_t);
         
$offset =$limit * $page_number;
$this->db->where("id","$message_id");
$this->db->order_by('id','asc');
$this->db->limit($limit, $offset);
$query = $this->db->get('messages');
$sql_product=$query->result();

$main_send_id=get_table_filed('messages',array('id'=>$message_id,'id_reply'=>0),"send_id");
$main_server_id=get_table_filed('messages',array('id'=>$message_id,'id_reply'=>0),"server_id");
if($customers_id==$main_send_id){$username=get_table_filed('customers',array('id'=>$main_server_id),"user_name");}
else{
  $username=get_table_filed('customers',array('id'=>$main_send_id),"user_name");  
}
$data['username']= $username;
if (count($sql_product)>0) {
foreach ($sql_product as $page) {
$send_id=$page->send_id;
$server_id=$page->server_id;

$result['description']=$page->message;
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;

if($send_id==$customers_id){$result['key']=1;$result['sender']="انت";}else{$result['key']=2;$result['sender']=$username;}
$result['message_id']=(int)$message_id;
$data['all_message'][]= $result;
}
//
                   
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_message'] = [];
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              "result" => $customers_id
              ],200);
                }
                
}
else {$this->api_return([ 'message' => lang('Customer ID notcorrect'), 'errNum' => 402, 'status' => false, ],200);}
}
}



	public function message_reply()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang = $this->input->post('lang');
        $this->checkLang($lang);

		$this->load->library('form_validation');
        $this->form_validation->set_rules('message_id', lang('Message ID'), 'trim|required|numeric');
        $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
        $this->form_validation->set_rules('content', lang('Content'), 'trim|required');
        if($this->form_validation->run() === FALSE){
            if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
            
            
            if(form_error('message_id')){
				if($this->input->post('message_id')==="" || !$this->input->post('message_id')){
					$data[] = array('message'=> strip_tags(lang('Message ID')),"errNum" =>2);
				}else{
					$data[] = array('message'=> strip_tags(lang('Message ID_error')),"errNum" =>3);
				}
			}
			

			
            if(form_error('content'))
				$data[] = array('message'=> strip_tags(lang('Content')),"errNum" =>4);
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));
              $customer = get_this('customers',['id'=>$customers_id]);
               if ($customer) {
                            $ticket = get_this('messages',['id'=>$this->input->post('message_id')]);
                            if ($ticket) {
                            $id_products=get_table_filed('messages',array('id'=>$this->input->post('message_id')),"id_products");
                            $server_id=get_table_filed('messages',array('id'=>$this->input->post('message_id')),"server_id");
if( $server_id==$customers_id){$server_id=get_table_filed('messages',array('id'=>$this->input->post('message_id')),"send_id");}
								date_default_timezone_set('Asia/Riyadh');
                                $store = [
                                        'send_id' => $customers_id,
                                        'server_id'        => $server_id,
                                        'message'        => $this->input->post('content'),
                                        'creation_date'     => date('Y-m-d'),
                                        'id_products'     => $id_products,
                                        'id_reply'     => $this->input->post('message_id'),
                                        'view'           => '1',
                                        'date_title' =>gen_month_name(date('m'))
                                      ];
                                       $insert = $this->db->update('messages',array('watch_admin'=>'0'),array('id'=>$this->input->post('message_id')));
                                      
                                $insert = $this->Main_model->insert('messages',$store);
								
								if($insert){
									$tickets_replies = get_this('messages',['id' => $insert]);
if($customers_id==$tickets_replies['send_id']){$user_sender="انت";}
else {$user_sender=get_this('customers',['id' =>$tickets_replies['send_id']],'user_name');}

									//print_r($tickets_replies);die;
									

										$replies = [
											'id'=>(int)$tickets_replies['id'],
                                            'created_at' => $tickets_replies['date_title'],
                                            'content'    => $tickets_replies['message'],
											'sender'	=>$user_sender
										];
										

									$data['replies'] = $replies;
                                    $this->api_return([
											'message' => lang('Your reply has been sent successfully'),
											'errNum' => 405,
											'status' => true,
											"result" => $data
										],200);
                                }else{
                                    $this->api_return([
											'message' => lang('Error In Sending'),
											'errNum' => 9,
											'status' => false
										],200);
                                }
                            }else{
                                $this->api_return([
										'message' => lang('Sorry there are no tickets for this number'),
										'errNum' => 5,
										'status' => false
									],200);
                            }
                       
                   
               }
               else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
               }
        }
	}



public function new_message(){
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
        $lang ="ar";
        $this->checkLang($lang);

$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('advertsing_id',lang('advertsing_id'), 'trim|required|numeric');
$this->form_validation->set_rules('content', lang('Content'), 'trim|required');
if($this->form_validation->run() === FALSE){
if(form_error('token_id')) {
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}
}
if(form_error('advertsing_id')){
if($this->input->post('advertsing_id')==="" || !$this->input->post("advertsing_id")){
$data[] = array('message'=> strip_tags(lang('course_key')),"errNum" =>1);
}
else{
$data[] = array('message'=> strip_tags(lang('course_key')),"errNum" =>2);
}
}

if(form_error('title'))
				$data[] = array('message'=> strip_tags(lang('Title')),"errNum" => 5);
			
            if(form_error('content'))
				$data[] = array('message'=> strip_tags(lang('Content')),"errNum" =>6);
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));
              $customer = get_this('customers',['id'=>$customers_id]);
               if ($customers_id) {
                   $user_id =get_table_filed('products',array('id'=>$this->input->post('advertsing_id'),'view'=>'1'),"user_id");
                   
							date_default_timezone_set('Asia/Riyadh');
                            $store = [
                                        'send_id' => $customers_id,
                                        'server_id'        => $user_id,
                                        'message'        => $this->input->post('content'),
                                        'creation_date'     => date('Y-m-d'),
                                        'id_products'     => $this->input->post('advertsing_id'),
                                        'view'           => '1',
                                        'date_title' =>gen_month_name(date('m'))
                                      ];
                            $insert = $this->Main_model->insert('messages',$store);
                            $id= $this->db->insert_id(); 
                            
										$replies = [
											'id'=>(int)$id,
                                            'created_at' =>date('Y-m-d'),
                                            'content'    =>$this->input->post('content'),
											'sender'	=>$customers_id
										];
										

									$data['message'] = $replies;
                            if($insert){
                                
                                $this->api_return([
										'message' => lang('Your reply has been sent successfully'),
										'errNum' => 405,
										'status' => true,
										"result" => $data
										
									],200);
                            }else{
                                $data['message'] ="";
                                $this->api_return([
										'message' => lang('Error in added'),
										'errNum' => 9,
										'status' => false,
											"result" => $data
									],200);
                            }
						
            }else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
               }
        }
	}

  //__________________END MESSAGE_________________________________//

public function test(){
    echo gen_month_name(date('m'));
}

public function filter_advertising(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      


if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
 

$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{


    $limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
     $offset =$limit * $page_number;
   
$customers_id=get_customer_id($this->input->post('token_id'));    


$this->db->select('*');
$this->db->from('products');


if($this->input->post('advertising_name')!=""){
$this->db->like('name', $this->input->post('advertising_name'));
}
if($this->input->post('city_id')!=""){
  $this->db->where('city_id', $this->input->post('city_id'));
  }
  

if($this->input->post('cat_id')!=""){
$this->db->where('cat_id',$this->input->post('cat_id'));
}
if($this->input->post('dep_id')!=""){
  $this->db->where('dep_id',$this->input->post('dep_id'));
  }

if($this->input->post('price_from')!=""){
  $price_from=$this->input->post('price_from');
  $this->db->where("price >= $price_from");
  }

if($this->input->post('price_to')!=""){
 $price_to=$this->input->post('price_to');
    $this->db->where("price <= $price_to");
    }

 

$this->db->where('view', '1');
$this->db->where('delete_key', '1');
$this->db->where('expired_date', '1');
$this->db->order_by('id','desc');
$this->db->limit($limit, $offset);
$query = $this->db->get();
$sql_product=$query->result();
$total =count($sql_product);
   

if (count($sql_product)>0) {
  foreach ($sql_product as $page) {
      
  if($this->input->post('token_id')!=""){
  $customers_id=get_customer_id($this->input->post('token_id'));    
  if($customers_id){
  $id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
  if($id_fav!=""){
    $result['favourite_key']=1;
  }
  else{
    $result['favourite_key']=0;	
  }
  }else {	$result['favourite_key']=0;}
  }else {	$result['favourite_key']=0;}
  
  $result['id']=(int)$page->id;
  $result['category id']=(int)$page->cat_id;
  $category_name=get_table_filed('category',array('id'=>$page->cat_id),"name");
  if($category_name!=""){
    $result['category name']=$category_name;
    }
    else {
    $result['category name']="";    
    }
    
    $dep_id=$page->dep_id;
    if($dep_id!=0){
      $result['dep_id'] =(int)$dep_id;
    $result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
    }
    else {$result['department']="";$result['dep_id'] ="";}


  $result['name']=$page->name;
  if($page->city_id!=""){
  $result['city']=get_name('city',$page->city_id);
  }
  else {
  $result['city']="";    
  }
  if($page->views!=""){
  $result['views']=$page->views;
  }
  else {
  $result['views']="";    
  }
  
  if($page->special!=""){
    $result['special']=$page->special;
    }
    else {
    $result['special']="";    
    }

  if($page->price!=""){
  $result['price']=$page->price."".get_name('currency',$page->currency_id);
  }
  else{
  $result['price']=""; 
  }
  if($page->date_title!=""){
  $result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
  }
  else{
  $result['date_title']=" "; 
  }
  
  
  
  
  if($page->img!=""){
  $result['image']=base_url()."uploads/products/".$page->img;
  }
  else {
  $result['image']=base_url()."uploads/products/no_img.png";
  }
  
  $data['search_result'][]= $result;
                  }
                      // $total = count($total);
               //$data['my_favourite'] = $result;
               $this->api_return([
                'message' => lang('Operation completed successfully'),
                'errNum' => 405,
                'status' => true,
                'total' => $total,
                "result" => $data
              ],200);
                  
                  
                  }
                  else {
               $data['search_result'] = [];
              // $total = count($total);
               $this->api_return([
                'message' => lang('no_data'),
                'errNum' => 401,
                'status' => false,
                'total' => $total,
                "result" => $data
                ],200);
                  }



}
}




public function get_all_cat_advertsing(){
    
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
$this->form_validation->set_rules('cat_id', lang('Key Depart'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=>strip_tags(lang('Key Depart')),"errNum" => 3);
}else{$data[] = array('message'=>strip_tags(lang('Key Depart')),"errNum" => 4);}
}

if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$limit=$this->input->post('limit');
$page_number=$this->input->post('page_number');
         $total = $this->data->get_table_data('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','cat_id'=>$this->input->post('cat_id')));
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','cat_id'=>$this->input->post('cat_id')),$limit, $offset)->result();

$cat_name=get_table_filed('category',array('id'=>$this->input->post('cat_id')),"name");
//$result['category name']=$cat_name;
if (count($sql_product)>0) {
foreach ($sql_product as $page) {
    
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
if($id_fav!=""){
	$result['favourite_key']=1;
}
else{
	$result['favourite_key']=0;	
}
}else {	$result['favourite_key']=0;}
}else {	$result['favourite_key']=0;}


$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}
if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}

if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);;
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

$result['id']=(int)$page->id;


if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}
else {
$result['image']=base_url()."uploads/products/no_img.png";
}
$data['category_id']=$this->input->post('cat_id');
$data['category_name']= $cat_name;
$data['all_cat_advertsing'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_cat_advertsing'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              'total' => $total,
              "result" => $data
              ],200);
                }
}
}





public function get_all_advertsing(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      

if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$limit=$this->input->post('limit');
$page_number=$this->input->post('page_number');
$total = $this->data->get_table_data('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1',));
$offset =$limit * $page_number;
$sql_product=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1'),$limit, $offset)->result();


if (count($sql_product)>0) {
foreach ($sql_product as $page) {
    
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
if($id_fav!=""){
	$result['favourite_key']=1;
}
else{
	$result['favourite_key']=0;	
}
}else {	$result['favourite_key']=0;}
}else {	$result['favourite_key']=0;}


$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}

if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }

if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

$result['id']=(int)$page->id;
$result['category id']=(int)$page->cat_id;
$category_name=get_table_filed('category',array('id'=>$page->cat_id),"name");
if($category_name!=""){
$result['category name']=$category_name;
}
else {
$result['category name']="";    
}

$dep_id=$page->dep_id;
if($dep_id!=0){
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";}
$result['dep_id'] =$dep_id; 

if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}
else {
$result['image']=base_url()."uploads/products/no_img.png";
}

$data['all_advertsing'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_advertsing'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              'total' => $total,
              "result" => $data
              ],200);
                }
}
}






public function get_all_cat_special_advertsing(){
    
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
$this->form_validation->set_rules('cat_id', lang('Key Depart'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=>strip_tags(lang('Key Depart')),"errNum" => 3);
}else{$data[] = array('message'=>strip_tags(lang('Key Depart')),"errNum" => 4);}
}

if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
         $total = $this->data->get_table_data('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','special'=>'1','cat_id'=>$this->input->post('cat_id')));
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','special'=>'1','cat_id'=>$this->input->post('cat_id')),$limit, $offset)->result();



 $cat_name=get_table_filed('category',array('id'=>$this->input->post('cat_id')),"name");
 
if (count($sql_product)>0) {
foreach ($sql_product as $page) {
    
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
if($id_fav!=""){
	$result['favourite_key']=1;
}
else{
	$result['favourite_key']=0;	
}
}else {	$result['favourite_key']=0;}
}else {	$result['favourite_key']=0;}


$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}
if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}

if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

if($page->cat_id!=""){
  $result['category id']=(int)$page->cat_id;
  $result['category name']=get_name("category",$page->cat_id);
} 
else{
  $result['category id']="";
  $result['category name']=""; 
}

$dep_id=$page->dep_id;
if($page->dep_id!=""){
$result['dep_id'] =(int)$dep_id;  
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";$result['dep_id'] =""; }


if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}

else {
$result['image']=base_url()."uploads/products/no_img.png";
}
$data['category_id']=(int)$this->input->post('cat_id');
$data['category name']=$cat_name;
$data['all_cat_advertsing'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_cat_advertsing'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              'total' => $total,
              "result" => $data
              ],200);
                }
}
}





public function get_all_subcat_advertsing(){
    
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
$this->form_validation->set_rules('dep_id', lang('dep_id'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
if(form_error('dep_id')){
if($this->input->post('dep_id')==="" || !$this->input->post('dep_id')){
$data[] = array('message'=>strip_tags(lang('dep_id')),"errNum" => 3);
}else{$data[] = array('message'=>strip_tags(lang('Key Depart')),"errNum" => 4);}
}

if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
         $total = $this->data->get_table_data('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','dep_id'=>$this->input->post('dep_id')));
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','dep_id'=>$this->input->post('dep_id')),$limit, $offset)->result();



 
 
if (count($sql_product)>0) {
foreach ($sql_product as $page) {
    
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
if($id_fav!=""){
	$result['favourite_key']=1;
}
else{
	$result['favourite_key']=0;	
}
}else {	$result['favourite_key']=0;}
}else {	$result['favourite_key']=0;}


$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}
if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}
$cag_id=$page->cat_id;

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

$cat_name=get_table_filed('category',array('id'=>$cag_id),"name");
$result['category id']=(int)$cag_id;
$result['category name']=$cat_name;

$dep_id=$page->dep_id;
if($dep_id!=0){
 $result['dep_id'] =(int)$dep_id;   
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";$result['dep_id'] ="";}

if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }
  
$result['id']=(int)$page->id;

if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}

else {
$result['image']=base_url()."uploads/products/no_img.png";
}


$data['all_cat_advertsing'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_cat_advertsing'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              'total' => $total,
              "result" => $data
              ],200);
                }
}
}





public function get_all_special_advertising(){
    
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      


if(form_error('limit')){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 5);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 6);}
}

      if(form_error('page_number')){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 7);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 8);
  }
}
            $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{

$limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
         $total = $this->data->get_table_data('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','special'=>'1'));
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','expired_date'=>'1','view'=>'1','special'=>'1'))->result();



 $cat_name=get_table_filed('category',array('id'=>$this->input->post('cat_id')),"name");
 $count=0;
if (count($sql_product)>0) {
foreach ($sql_product as $page) {
    $count++;
    $result['Total Count']=$count;
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
if($id_fav!=""){
	$result['favourite_key']=1;
}
else{
	$result['favourite_key']=0;	
}
}else {	$result['favourite_key']=0;}
}else {	$result['favourite_key']=0;}


$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}
if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

$result['category id']=(int)$page->cat_id;
$result['category name']=get_name("category",$page->cat_id);

$dep_id=$page->dep_id;
if($dep_id!=0){
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
$result['dep_id'] =(int)$dep_id; 
}
else {$result['department']="";$result['dep_id'] ="";}

if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }


$result['id']=(int)$page->id;

if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}

else {
$result['image']=base_url()."uploads/products/no_img.png";
}


$data['all_cat_advertsing'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
             $data['all_cat_advertsing'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              'total' => $total,
              "result" => $data
              ],200);
                }
}
}



public function get_all_myfavorite(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
   // ,'requireAuthorization' => true //this used if reqired token valye
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$customer_id=get_customer_id($this->input->post('token_id'));

$total = $this->db->get_where('favourites',array('user_id'=>$customer_id))->result();
if(count($total)>20){
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
}
  if($this->form_validation->run() === FALSE){
		if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

$total = $this->db->get_where('favourites',array('user_id'=>$customer_id))->result();

if(form_error('limit')&&count($total)>20){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 0);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 1);}
}

 if(form_error('page_number')&&count($total)>20){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" =>0);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 1);
  }
}

$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);


  }
else{
$limit=$this->input->post('limit');
$customer_id=get_customer_id($this->input->post('token_id'));
    $page_number=$this->input->post('page_number');
         $total = $this->data->get_table_data('favourites',array('user_id'=>$customer_id));
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('favourites',array('user_id'=>$customer_id),$limit, $offset)->result();
         if (count($sql_product)>0) {
foreach ($sql_product as $bage) {
$course_id=(int)$bage->course_id;
 $sql_bag=$this->db->order_by('id','DESC')->get_where('products',array('id'=>$course_id,'view'=>'1'))->result();
  foreach ($sql_bag as $page)
$result['name']=$page->name;
if($page->city_id!=""){
$result['city']=get_name('city',$page->city_id);
}
else {
$result['city']="";    
}
if($page->views!=""){
$result['views']=$page->views;
}
else {
$result['views']="";    
}

if($page->price!=""){
$result['price']=$page->price."".get_name('currency',$page->currency_id);
}
else{
$result['price']=""; 
}
if($page->date_title!=""){
$result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
}
else{
$result['date_title']=" "; 
}

$result['id']=(int)$page->id;

$category_name=get_table_filed('category',array('id'=>$page->cat_id),"name");
if($category_name!=""){
  $result['category id']=(int)$page->cat_id;
$result['category name']=$category_name;
}
else {
  $result['category id']=""; 
$result['category name']="";    
}

$dep_id=$page->dep_id;
if($dep_id!=0){
 $result['dep_id'] =$dep_id;   
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";$result['dep_id'] ="";}


if($page->special!=""){
  $result['special']=$page->special;
  }
  else {
  $result['special']="";    
  }

if($page->img!=""){
$result['image']=base_url()."uploads/products/".$page->img;
}
else {
$result['image']=base_url()."uploads/products/no_img.png";
}



$data['all favorites'][]= $result;
                }
                     $total = count($total);
             //$data['my_favourite'] = $result;
             $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => $total,
              "result" => $data
            ],200);
                
                
                }
                else {
			$data['all favorites'] = [];
             $total = count($total);
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              "result" => $data
              ],200);
                }
}

}






public function update_myfavorite(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');

$this->form_validation->set_rules('id_product', lang('Course ID'), 'trim|required|numeric');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('action_type', lang('action_type'), 'trim|required|numeric|in_list[1,2]');

  if($this->form_validation->run() === FALSE){
      
if(form_error('id_product')){
if($this->input->post('id_product')==="" || !$this->input->post('id_product')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 1);
}	
}

if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}
else {
$id=get_customer_id($this->input->post('token_id'));
if($id==""){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}
}	
}





if(form_error('action_type')){
if($this->input->post('action_type')==="" || !$this->input->post('action_type')){
$data[] = array('message'=> strip_tags(lang('action_type')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('action_type')),"errNum" => 1);
}	
}

$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);

  }
else{
    $idcustomers=get_customer_id($this->input->post('token_id'));
    if($idcustomers!=""){
    if($this->input->post('action_type')==2){
    $this->db->delete("favourites",array("user_id"=>$idcustomers,'course_id'=>$this->input->post('id_product')));
$this->api_return([
'message' => lang('delete_fav'),
'errNum' => 405,
'status' => true
],200);
    }
 else  if($this->input->post('action_type')==1){
$total_find= $this->db->get_where("favourites",array("user_id"=>$idcustomers,'course_id'=>$this->input->post('id_product')))->result();
if(count($total_find)>0){
 $this->api_return([
'message' => lang('exite_fav'),
'errNum' => 405,
'status' => true
],200);   
}
else {
    $data_fav['user_id']=$idcustomers;
    $data_fav['course_id']=$this->input->post('id_product');
    $data_fav['creation_date']=date("Y-m-d");
    $this->db->insert("favourites",$data_fav);
     $this->api_return([
'message' => lang('add_fav'),
'errNum' => 405,
'status' => true
],200);  
}
    }
 

}
   else  {
$this->api_return([
'message' => lang('Customer ID_notfind'),
'errNum' => 4,
'status' => false
],200);
    }


}
}

public function get_advertsing_details(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
    //,'requireAuthorization' => true //this used if reqired token valye
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('advertising_id', lang('Course ID'), 'trim|required|numeric');
 if($this->form_validation->run() === FALSE){


if(form_error('advertising_id')){
if($this->input->post('advertising_id')==="" || !$this->input->post('advertising_id')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 2);
}else if(get_table_filed('products',array('id'=>$this->input->post('advertising_id')),"id")==""){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 3);
}	
}
$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
}

else{
$sql_bag=$this->db->order_by('id','DESC')->get_where('products',array('delete_key'=>'1','id'=>$this->input->post('advertising_id'),'view'=>'1'))->result();
if(count($sql_bag)>0){
foreach ($sql_bag as $bage){
$result['id']=(int)$bage->id;
$result['name']=$bage->name; 

$user_id=$bage->user_id;
$result['user_id']=(int)$user_id;
if($this->input->post('token_id')!=""){
$customers_id=get_customer_id($this->input->post('token_id'));    
if($customers_id){
    
if($customers_id==$user_id){
$total_messages =count($this->db->get_where('messages',array('id_products'=>$this->input->post('advertising_id')))->result());  
$result['Total messages']=$total_messages;
}
else {$result['Total messages']="";}
$id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$bage->id),"id");
if($id_fav!=""){$result['favourite_key']=1;}
else{$result['favourite_key']=0;	}
}
else {$result['favourite_key']=0;$result['Total messages']="";}
}
else {$result['favourite_key']=0;$result['Total messages']="";}

if($bage->city_id!=""){
$result['city'] =get_name('city',$bage->city_id);
}
else {
 $result['city']="";
}
if($bage->details!=""){
$result['details']=$bage->details;
}else {$result['details']="";}


if($bage->views!=""){
$result['views']=$bage->views;

}else {$result['views']="";}

if($bage->special!=""){
  $result['special']=$bage->special;
  }
  else {
  $result['special']="";    
  }

$this->db->update("products",array("views"=>((int)$bage->views)+1),array('id'=>$bage->id));
if($bage->date_title!=""){
$result['date']=$bage->date_title;
}
else {$result['date']="";}

if($bage->price!=""){$result['price']=$bage->price."".get_name('currency',$bage->currency_id);;}
else {$result['price']="";}

$cat_id=$bage->cat_id;
if($cat_id!=0){
  $result['category id'] =$cat_id;
$result['category name'] =get_table_filed('category',array('id'=>$cat_id),"name");
}
else {$result['category name']="";$result['category id'] ="";}

$dep_id=$bage->dep_id;
if($dep_id!=0){
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";}


$result['user_email'] =$bage->user_email;
$result['user_phone'] =$bage->user_phone;


$images_g=$this->db->get_where('images',array('id_products'=>$bage->id))->result();
if(count($images_g)>0){
foreach($images_g as $images){$result_img['images'][]=base_url()."uploads/products/".$images->image; }
}
if($bage->img!=""){$result_img['images'][]=base_url()."uploads/products/".$bage->img;}
else {$result_img['images'][]=base_url()."uploads/products/no_img.png";} 

$data['Advertising details'][]= $result;
$data['Gallery']= $result_img;
$this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              "result" => $data
            ],200);



}   ///////////////////////////////END FOREACH 

    
}//______________//END IF for count
else {
$data['Advertising details'] = [];
$this->api_return([
'message' => lang('no_data'),
'errNum' => 401,
'status' => false,
"result" => $data
],200);     
}
    
}

}
public function get_bank_accounts(){
    
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
        ]);
       $lang = "ar";
    $this->checkLang($lang);
$this->load->library('form_validation');

$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

  if($this->form_validation->run() === FALSE){
	if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);
    
  }
else {	
    $home_city=$this->db->order_by('id','desc')->get_where('bank_accounts',array('view'=>'1'))->result();
		if (count($home_city)>0) {

        foreach ($home_city as $page) {
            $result['name_bank']=$page->name_bank;
             $result['user account name']=$page->user_name;
             $result['account_number']=$page->account_number;
             $result['iban_number']=$page->iban_number;
        $data['Bank Accounts'][]= $result;
        }
        
        
		}
	    else{
        	$data['Bank Accounts'][]= lang('no_data');
       }
    
    
	
if($data){
$this->api_return([
'keynum' => 405, //active4web copyright 2019
'status' => true,
"result" => $data
],200); 
}

else {
         $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);   
}
       
}

 }






public function preparation_from_bank(){
    
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
    $this->checkLang($lang);
$this->load->library('form_validation');
 
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

  if($this->form_validation->run() === FALSE){
		if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);
    
    
  }
else {	
    $bank_accounts=$this->db->order_by('id','desc')->get_where('bank_accounts',array('view'=>'1'))->result();
		if (count($bank_accounts)>0) {
        foreach ($bank_accounts as $page) {
      $result['bank_name']=$page->name_bank;
      $result['bank_id']=$page->id;
        $data['Bank Accounts Select'][]= $result;
        }
        
        
		}
	    else{
        $data['bank_accounts'][]= lang('no_data');
       }
    
    $home_city=$this->db->order_by('id','desc')->get_where('bank_accounts',array('view'=>'1'))->result();
		if (count($home_city)>0) {

        foreach ($home_city as $banks) {
            $result_display['name_bank']=$banks->name_bank;
             $result_display['user account name']=$banks->user_name;
             $result_display['account_number']=$banks->account_number;
             $result_display['iban_number']=$banks->iban_number;
        $data['Bank Accounts'][]= $result_display;
        }
        
        
		}
	    else{
        	$data['Bank Accounts'][]= lang('no_data');
       }
       
       
       
       
if($data){
$this->api_return([
'keynum' => 405, //active4web copyright 2019
'status' => true,
"result" => $data
],200); 
}

else {
         $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);   
}
       
}

}




public function payment_from_bank(){
    
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
    $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

$this->form_validation->set_rules('user_name', lang('Name converter'), 'trim|required');

  
    $this->form_validation->set_rules('convert_number', lang('convert_number_error'), 'trim|required');
$this->form_validation->set_rules('id_order', lang('soical_id_error'), 'trim|required');

if($this->form_validation->run() === FALSE){
			
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

if(form_error('user_name')){
if($this->input->post('user_name')==="" || !$this->input->post('user_name')){
$data[] = array('message'=> strip_tags(lang('Name converter')),"errNum" => 2);
}else {
$data[] = array('message'=> strip_tags(lang('Name converter')),"errNum" => 3);
}	
}




if(form_error('convert_number')){
if($this->input->post('convert_number')==="" || !$this->input->post('convert_number')){
$data[] = array('message'=> strip_tags(lang('convert_number_error')),"errNum" => 4);
}
}


if(form_error('id_order')){
if($this->input->post('order_id')==="" || !$this->input->post('order_id')){
$data[] = array('message'=> strip_tags(lang('soical_id_error')),"errNum" => 8);
}
}

if(form_error('namebank')){
if($this->input->post('bank_id')==="" || !$this->input->post('bank_id')){
$data[] = array('message'=> strip_tags(lang('Bank name')),"errNum" => 10);
}else {
$data[] = array('message'=> strip_tags(lang('Bank name')),"errNum" => 11);
}	
}




$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);
    
    
  }
else {	
    
     $customers_id=get_customer_id($this->input->post('token_id'));
 if($customers_id!=""){
    
 date_default_timezone_set('Asia/Riyadh');
            $store = [
                      'id_bank'      => $this->input->post('bank_id'),
                      'id_user'      => $customers_id,
                      'id_order'    => $this->input->post('id_order'),
                      'name_payment' => $this->input->post('user_name'),
                      'convert_type' => $this->input->post('convert_number'),
                      'creation_date'     => date("Y-m-d")
                    ];
                    $insert = $this->db->insert('bank_accounts_forms',$store);
                   $id= $this->db->insert_id();
                   $date_payment_type['payment_type']='1';
                   $this->Main_model->update('soical_advertising',['id'=>$this->input->post('id_order')],$date_payment_type);



if($_FILES['bank_img']['name']!=""){
$file=$_FILES['bank_img']['name'];
$file_name="bank_img";
get_img_config_course('bank_accounts_forms','uploads/Banks_accounts/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450");
}    

                    
            //////////////////////////////////////////////Send SMS Code
             //Check Insert User Data
            if($insert){


   $store_request = [
                      'id_bank'      => $id,
                      'id_user'      => $customers_id,
                      'id_course'    => $this->input->post('course_id'),
                      'final_price' => $this->input->post('final_price'),
                      'type'     => $this->input->post('course_key'),
                      'creation_date'     => date("Y-m-d"),
                       'request_code'     => gen_random_string_code(),
                       'type_payment'=>'1'
                    ];
                    $insert = $this->db->insert('request_courses',$store_request);
                   //$id= $this->db->insert_id();

$customer = get_this('bank_accounts_forms',['id'=>$id]);

  if ($customer) {
$customer_infop['id'] =$id;
$customer_infop['name converter'] = $this->input->post('user_name');
$customer_infop['conver_number'] =get_table_filed('bank_accounts_forms',array('id'=>$id),"convert_type");
$customer_infop['bank name'] =get_table_filed('bank_accounts',array('id'=> $this->input->post('bank_id')),"name_bank");
$customer_infop['order id'] =(int)get_table_filed('bank_accounts_forms',array('id'=>$id),"id_order");
if(get_table_filed('bank_accounts_forms',array('id'=>$id),"img")!=""){
$customer_infop['img'] = base_url()."uploads/Banks_accounts/".get_table_filed('bank_accounts_forms',array('id'=>$id),"img");
}
else {
$customer_infop['img'] = base_url()."uploads/Banks_accounts/no_img.png";   
}
 $data['payment_info'] = $customer_infop;

  }
       
       
       
       
if($data){
    
$this->api_return([
'message' => ('تم اضافة بيانات الدفع بنجاح وسوف يتم مراجعتها من الادارة'),
'keynum' => 405, //active4web copyright 2019
'status' => true,
"result" => $data
],200); 
}

else {
         $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);   
}
       

}
}


else {
$this->api_return([
'message' => lang('Customer ID notcorrect'),
'errNum' => 402,
'status' => false
],200);    
}

}
}




public function requested_bags(){
    
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'], //This Function by default request method GET
            'key' => ['POST', $this->key()]
          // ,'requireAuthorization' => true //this used if reqired token valye
        ]);
       $lang = "ar";
    $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('course_id', lang('Course ID'), 'trim|required');
     
if($this->form_validation->run() === FALSE){
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

if(form_error('course_id')){
if($this->input->post('course_id')==="" || !$this->input->post('course_id')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>2);
}else {
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>3);
}	
}




$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);
    
    
  }
else {	
    
     $customers_id=get_customer_id($this->input->post('token_id'));
 if($customers_id!=""){
    
 date_default_timezone_set('Asia/Riyadh');


   $store_request = [
                      'id_user'      => $customers_id,
                      'id_course'    => $this->input->post('course_id'),
                      'type'     => $this->input->post('course_key'),
                      'creation_date'     => date("Y-m-d"),
                       'request_code'     => gen_random_string_code(),
                       'type_payment'=>'2',
                       'view'=>'0'
                    ];
                    $insert = $this->db->insert('request_courses',$store_request);
                    $id= $this->db->insert_id();
 
if($id){
$this->api_return([
'message' =>"تم اضافة طلبكم بنجاح",
'keynum' => 405, //active4web copyright 2019
'status' => true
],200); 
}

else {
         $data['pages'] = [];
        $this->api_return([
		'message' => lang('no_data'),
				'keynum' =>401,
				'status' => false,
				"result" => $data
				],200);   
}
       


}


else {
$this->api_return([
'message' => lang('Customer ID notcorrect'),
'errNum' =>402,
'status' => false
],200);    
}

}
}









/******* Start 22-4-2019*******************/

/*************API_1**********/
public function get_all_review(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
  //  ,'requireAuthorization' => true //this used if reqired token valye
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('id_course', lang('Course ID'), 'trim|required|numeric');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

$total = $this->db->get_where('reviews',array('id_course'=>$this->input->post('id_course')))->result();
if(count($total)>20){
$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
}
  if($this->form_validation->run() === FALSE){
		if(form_error('id_course')){
if($this->input->post('id_course')==="" || !$this->input->post('id_course')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 1);
}	
}

if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

$total = $this->db->get_where('reviews',array('id_course'=>$this->input->post('id_course'),'course_key'=>$this->input->post('course_key')))->result();

if(form_error('limit')&&count($total)>20){
if($this->input->post('limit')==="" || !$this->input->post('limit')){
$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 0);
}else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 1);}
}

 if(form_error('page_number')&&count($total)>20){
  if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" =>0);
  }else{
    $data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 1);
  }
}
$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);


  }
else{
$limit=$this->input->post('limit');
    $page_number=$this->input->post('page_number');
       $total = $this->db->get_where('reviews',array('id_course'=>$this->input->post('id_course'),'course_key'=>$this->input->post('course_key')))->result();
         $offset =$limit * $page_number;
         $sql_product=$this->db->order_by('id','DESC')->get_where('reviews',array('id_course'=>$this->input->post('id_course'),'course_key'=>$this->input->post('course_key')),$limit, $offset)->result();
         if (count($sql_product)>0) {
            foreach ($sql_product as $page) {
                $user_id=$page->user_id;
				$comment=$page->comment;
				$rate=$page->rate;
				
$result['user_name']=get_table_filed('customers',array('id'=>$user_id),"user_name");
$result['comment']=$page->comment;
$result['rate_value']=(int)$page->rate;
$result['rate_id']=(int)$page->id;
$data['all reviews'][]= $result;
			}

 $this->api_return([
              'message' => lang('Operation completed successfully'),
              'errNum' => 405,
              'status' => true,
              'total' => count($total),
              "result" => $data
            ],200);

                }

                else {
			$data['all reviews'] = [];
             $this->api_return([
              'message' => lang('no_data'),
              'errNum' => 401,
              'status' => false,
              "result" => $data
              ],200);
                }
}

}




/***************ADD REVIEW****************************/

public function add_new_review(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
  //  ,'requireAuthorization' => true //this used if reqired token valye
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('id_course', lang('Course ID'), 'trim|required|numeric');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('comment', lang('Review comment'), 'trim|required');
$this->form_validation->set_rules('course_key', lang('course_key'), 'trim|required|numeric');
$this->form_validation->set_rules('rate_value', lang('rate_value'), 'trim|required|numeric|in_list[1,2,3,4,5]');

  if($this->form_validation->run() === FALSE){
      
if(form_error('id_course')){
if($this->input->post('id_course')==="" || !$this->input->post('id_course')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 1);
}	
}

if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}
else {
$id=get_customer_id($this->input->post('token_id'));
if($id==""){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}
}	
}


if(form_error('course_key')){
if($this->input->post('course_key')==="" || !$this->input->post('course_key')){
$data[] = array('message'=> strip_tags(lang('course_key')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('course_key')),"errNum" => 1);
}	
}


if(form_error('rate_value')){
if($this->input->post('rate_value')==="" || !$this->input->post('rate_value')){
$data[] = array('message'=> strip_tags(lang('rate_value')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('rate_value')),"errNum" => 1);
}	
}


if(form_error('comment')){
if($this->input->post('comment')==="" || !$this->input->post('comment')){
$data[] = array('message'=> strip_tags(lang('Review comment')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Review comment')),"errNum" => 1);
}	
}


$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);


  }
else{
$customers_id=get_customer_id($this->input->post('token_id'));
if($customers_id==""){
$data[] = array('message'=> strip_tags(lang('Customer ID_notfind')),"errNum" =>8);
$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
}
  

else {
$sql_product=$this->db->get_where('reviews',array('id_course'=>$this->input->post('id_course'),
'course_key'=>$this->input->post('course_key'),'user_id'=>$customers_id))->result();    


if(count($sql_product)>0){
$result['Review_Key'] =0;
$data['Evaluation']=$result;
$this->api_return([
'message' => lang('review add prev'),
'errNum' => 405,
'status' => false,
"result" => $data
],200);

} 
   
   else {
       
$datap['id_course']=$this->input->post('id_course');
$datap['course_key']=$this->input->post('course_key');
$datap['user_id']=$customers_id;
$datap['comment']=$this->input->post('comment');
$datap['rate']=$this->input->post('rate_value');
$this->db->insert("reviews",$datap);
 $id= $this->db->insert_id();
 if($id){
    $id_course= $this->input->post('id_course');
   $count_rate= $this->db->get_where("reviews",array("id_course"=>$id_course))->result();
  
$this->db->select_sum('rate');
    $this->db->from('reviews');
    $this->db->where("id_course=$id_course");
    $query = $this->db->get();
     $final_rate=$query->row()->rate;
         $main_rata_data['total_rate']= round($final_rate/count($count_rate));

     if($this->input->post('course_key')==2){
    $this->db->update("bag_info",$main_rata_data,array("id"=>$this->input->post('id_course')));
     }
     else {
    $this->db->update("products",$main_rata_data,array("id"=>$this->input->post('id_course')));
     }
$result['Review_Key'] =1;
$data['add_review'][]=$result;
$this->api_return([
'message' => lang('review add success'),
'errNum' => 405,
'status' => true,
"result" => $data
],200);
    
}

else {
$this->api_return([
'message' => lang('An error in the review'),
'errNum' => 4,
'status' => false
],200);
}


       
   }
    
}
}

}
    

public function add_advertising(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
       $lang ="ar";
      $this->checkLang($lang);
        $this->load->library('Authorization_Token');
		$this->load->library('form_validation');
        $this->form_validation->set_rules('name',lang('bage_name'), 'trim|required');
        $this->form_validation->set_rules('about', lang('about_bage'), 'trim|required');
        $this->form_validation->set_rules('price', lang('price id'), 'trim|required');
		    $this->form_validation->set_rules('cat_id', lang('Cat id'), 'trim|required|numeric');
        $this->form_validation->set_rules('city_id', lang('City id'), 'trim|required');
        $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
        $this->form_validation->set_rules('phone', lang('Phone Number'), 'trim|required|numeric');
        $this->form_validation->set_rules('email', lang('Email'), 'trim|required|valid_email');
   //   $this->form_validation->set_rules('dep_id', lang('dep_id'), 'trim|required');
         $this->form_validation->set_rules('currency_id', lang('currency_id'), 'trim|required');
            

            
          
//$this->form_validation->set_rules('content_bage', lang('content_bage'), 'trim|required'); 
        if($this->form_validation->run() === FALSE){
		
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
      

              //**************** */
if(form_error('name')){
if($this->input->post('name')==="" || !$this->input->post('name')){
$data[] = array('message'=> strip_tags(lang('bage_name')),"errNum" =>2);
}
}              
              
if(form_error('about')){
if($this->input->post('about')==="" || !$this->input->post('about')){
$data[] = array('message'=> strip_tags(lang('about_bage')),"errNum" =>3);
}
}
if(form_error('price')){
if($this->input->post('price')==="" || !$this->input->post('price')){
$data[] = array('message'=> strip_tags(lang('Total daies')),"errNum" => 5);
}
}
            
          
if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=> strip_tags(lang('Daies week')),"errNum" =>6);
}
}

/*if(form_error('dep_id')){
if($this->input->post('dep_id')==="" || !$this->input->post('dep_id')){
$data[] = array('message'=> strip_tags(lang('dep_id')),"errNum" =>6);
}
}*/
if(form_error('currency_id')){
if($this->input->post('currency_id')==="" || !$this->input->post('currency_id')){
$data[] = array('message'=> strip_tags(lang('currency_id')),"errNum" =>8);                                                                                                        
}
}

 

  if(form_error('city_id')){
    if($this->input->post('city_id')==="" || !$this->input->post('city_id')){
    $data[] = array('message'=> strip_tags(lang('city')),"errNum" =>7);
    }
    }


if(form_error('email')){
if($this->input->post('email')==="" || !$this->input->post('email')){
$data[] = array('message'=> strip_tags(lang('Email')),"errNum" => 0);
}else{
$data[] = array('message'=> strip_tags(lang('email_anthor')),"errNum" => 1);
}
    }
      //**************** */
    if(form_error('phone')){
if($this->input->post('phone')==="" || !$this->input->post('phone')){
  $data[] = array('message'=> strip_tags(lang('Phone Number')),"errNum" => 0);
}else{
  $data[] = array('message'=> strip_tags(lang('phone_anthor')),"errNum" => 1);
}
    }

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);



        }

        else{
      
          
          $customers_id=get_customer_id($this->input->post('token_id'));
          date_default_timezone_set('Asia/Riyadh');
          
   $code_t=get_row("coustomer_code",array('id_customer'=>$customers_id,'package_end'=>'0'),1,"id","desc");
   if(count($code_t)>0){
     foreach($code_t as $code_t)
   $id_code=(int)$code_t->id_code;
   $customer_code=(int)$code_t->id;
   $expired_package=(int)$code_t->expire_date;
   $count_package_used=(int)$code_t->count;
          $total_used=get_table_filed('codes',array('id'=>$id_code),"total_used");
          $time_days=get_table_filed('codes',array('id'=>$id_code),"time_days");
          
          $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
          if($expired_package<date("Y-m-d")){
          $data_pacakage['package_end']='1';
          $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));
          $this->api_return([
            'message' => "نأسف لنتهاء الباقة الخاصة بيك",
            'errNum' => 405,
            'status' => $expire_date,
          ],200);
           }
          
          else if($total_used<=$count_package_used){
            $data_pacakage['package_end']='1';
            $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));
             $this->api_return([
            'message' => "نأسف لنتهاء الباقة الخاصة بيك",
            'errNum' => 405,
            'status' => true,
          ],200);
           } 
              else {
                $data_pacakage['count']=$count_package_used+1;
                $this->db->update("coustomer_code",$data_pacakage,array('id'=>$customer_code));  
                  
                      $store = [
                                'user_id'          	=> $customers_id,
                                'name'              =>$this->input->post('name'),
                                'details'           => $this->input->post('about'),
                                'cat_id'            => $this->input->post('cat_id'),
                                'dep_id'            => $this->input->post('dep_id'),
                                'currency_id'          => $this->input->post("currency_id"),
                                'city_id'           => $this->input->post('city_id'),
                                'date_title'        => gen_month_name(date('m')),
                                'price'             =>$this->input->post('price'),
                                'creation_date'     => date('Y-m-d'),
                                'special'           =>$this->input->post('special'),
                                'delete_key'        =>'1',
                                'expired_date'      =>'1',
                                 'view'             =>'0',
                                'expired_date_Val'  =>$expire_date,
                                'user_phone'        =>$this->input->post('phone'),
                                'user_email'        =>$this->input->post('email')
                              ];
                              $insert = $this->db->insert('products',$store);
                             $id= $this->db->insert_id();
           
          
                       //Check Insert User Data
          if($id!=""){
           // $this->load->library('upload');
            if(isset($_FILES['img']['name'])){
              $file=$_FILES['img']['name'];
              $file_name="img";
              get_img_config_course('products','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450");
     get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,1);
              }           

if(isset($_FILES['img1']['name'])){
$file=$_FILES['img1']['name'];
$file_name="img1";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,2);
}  

if(isset($_FILES['img2']['name'])){
$file=$_FILES['img2']['name'];
$file_name="img2";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$id,3);
}  

          $result['advertising_id']=(int)$id;
          $result['info']=get_table_filed('site_info',array('id'=>1),"success_message");;
          $data['details']= $result;
          send_email($id,"user","add_advertising");
          $this->api_return([
                        'message' => lang('add_bages_result'),
                        'errNum' => 405,
                        'status' => true,
                        "result" => $data
                      ],200);
          }
     
          else {
          $data['details'] = [];
          $this->api_return([
          'message' => lang('add_bages_error'),
          'errNum' => 401,
          'status' => false,
          "result" => $data
          ],200); 
          } 
        }
        else {
          $this->api_return([
            'message' => "نأسف لنتهاء الباقة الخاصة بيك",
            'errNum' => 405,
            'status' => true,
          ],200);
          } 

        }
///////////////////////////////////////////////////////////////////////////////////////////////////////////
}


        }





public function edit_advertising(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
'key' => ['POST', $this->key()]
  ]);
 $lang ="ar";
$this->checkLang($lang);
  $this->load->library('Authorization_Token');
$this->load->library('form_validation');

$this->form_validation->set_rules('name',lang('bage_name'), 'trim|required');
$this->form_validation->set_rules('about', lang('about_bage'), 'trim|required');
$this->form_validation->set_rules('price', lang('price id'), 'trim|required');
$this->form_validation->set_rules('cat_id', lang('Cat id'), 'trim|required|numeric');
$this->form_validation->set_rules('city_id', lang('City id'), 'trim|required');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('phone', lang('Phone Number'), 'trim|required|numeric');
$this->form_validation->set_rules('email', lang('Email'), 'trim|required|valid_email');
$this->form_validation->set_rules('dep_id', lang('dep_id'), 'trim|required');
 $this->form_validation->set_rules('currency_id', lang('currency_id'), 'trim|required');
    

    
  
//$this->form_validation->set_rules('content_bage', lang('content_bage'), 'trim|required'); 
if($this->form_validation->run() === FALSE){

if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}


      //**************** */
if(form_error('name')){
if($this->input->post('name')==="" || !$this->input->post('name')){
$data[] = array('message'=> strip_tags(lang('bage_name')),"errNum" =>2);
}
}              
      
if(form_error('about')){
if($this->input->post('about')==="" || !$this->input->post('about')){
$data[] = array('message'=> strip_tags(lang('about_bage')),"errNum" =>3);
}
}
if(form_error('price')){
if($this->input->post('price')==="" || !$this->input->post('price')){
$data[] = array('message'=> strip_tags(lang('Total daies')),"errNum" => 5);
}
}
    
  
if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=> strip_tags(lang('Daies week')),"errNum" =>6);
}
}

if(form_error('dep_id')){
if($this->input->post('dep_id')==="" || !$this->input->post('dep_id')){
$data[] = array('message'=> strip_tags(lang('dep_id')),"errNum" =>6);
}
}
if(form_error('currency_id')){
if($this->input->post('currency_id')==="" || !$this->input->post('currency_id')){
$data[] = array('message'=> strip_tags(lang('currency_id')),"errNum" =>8);
}
}



if(form_error('city_id')){
if($this->input->post('city_id')==="" || !$this->input->post('city_id')){
$data[] = array('message'=> strip_tags(lang('city')),"errNum" =>7);
}
}


if(form_error('email')){
if($this->input->post('email')==="" || !$this->input->post('email')){
$data[] = array('message'=> strip_tags(lang('Email')),"errNum" => 0);
}else{
$data[] = array('message'=> strip_tags(lang('email_anthor')),"errNum" => 1);
}
}
//**************** */
if(form_error('phone')){
if($this->input->post('phone')==="" || !$this->input->post('phone')){
$data[] = array('message'=> strip_tags(lang('Phone Number')),"errNum" => 0);
}else{
$data[] = array('message'=> strip_tags(lang('phone_anthor')),"errNum" => 1);
}
}



if(form_error('advertising_id')){
  if($this->input->post('advertising_id')==="" || !$this->input->post('advertising_id')){
  $data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>8);
  }else if(get_table_filed('products',array('id'=>$this->input->post('advertising_id')),"id")==""){
  $data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>9);
  }	
  }


      
$this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);



  }

  else{

    $customers_id=get_customer_id($this->input->post('token_id'));
    date_default_timezone_set('Asia/Riyadh');
    

   
            
                $store = [
                          'name'              =>$this->input->post('name'),
                          'details'           => $this->input->post('about'),
                          'cat_id'            => $this->input->post('cat_id'),
                          'dep_id'            => $this->input->post('dep_id'),
                          'currency_id'          => $this->input->post("currency_id"),
                          'city_id'           => $this->input->post('city_id'),
                          'price'             =>$this->input->post('price'),
                          'special'           =>$this->input->post('special'),
                          'user_phone'        =>$this->input->post('phone'),
                          'user_email'        =>$this->input->post('email')
                        ];
         $this->db->update('products',$store,array('id'=>(int)$this->input->post('advertising_id')));
         
                       $id= (int)$this->input->post('advertising_id');
     
    
                 //Check Insert User Data
    if($id){

      if(isset($_FILES['img']['name'])){
        $file=$_FILES['img']['name'];
        $file_name="img";
        get_img_config_course('products','uploads/products/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$advertising_id),"600","450");
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"600","450",0,$advertising_id,1);
        }           

if(isset($_FILES['img1']['name'])){
$file=$_FILES['img1']['name'];
$file_name="img1";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$advertising_id),"600","450",0,$advertising_id,2);
}  

if(isset($_FILES['img2']['name'])){
$file=$_FILES['img2']['name'];
$file_name="img2";
get_img_config_insert('images','uploads/products/',$file,$file_name,'image','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$advertising_id),"600","450",0,$advertising_id,3);
}  

    $result['advertising_id']=(int)$this->input->post('advertising_id');;
    $data['details'][]= $result;
    $this->api_return([
                  'message' => 'تم تعديل الاعلان بنجاح',
                  'errNum' => 405,
                  'status' => true,
                  "result" => $data
                ],200);
    }
    else {
    $data['details'] = [];
    $this->api_return([
    'message' => "فشل تعديل الاعلان",
    'errNum' => 401,
    'status' => false,
    "result" => $data
    ],200); 
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////
}

        }





public function forget_password(){
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
        ]);
		ob_start();
        $lang = "ar";
        $this->checkLang($lang);

		$this->load->library('form_validation');
			$this->form_validation->set_rules('email', lang('Email'), 'trim|required|valid_email');
        if($this->form_validation->run() === FALSE){
      $email_find = get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
      
  //**************** */
    if(form_error('email')){
	if($this->input->post('email')==="" || !$this->input->post('email')){
	$data[] = array('message'=> strip_tags(lang('Email')),"errNum" =>1);
				}elseif($email_find==""){
					$data[] = array('message'=> strip_tags(lang('email_error')),"errNum" =>2);
				}else{
					$data[] = array('message'=> strip_tags(lang('email_error')),"errNum" =>3);
				}
            }
		  
		            $this->api_return([
					'message' => $data[0]['message'],
					'errNum' => $data[0]['errNum'],
					'status' => false
					],200);
        }else{


        $email_find = get_table_filed('customers',array('email'=>$this->input->post('email')),"email");
        $email_id= get_table_filed('customers',array('email'=>$this->input->post('email')),"id");
if($email_find==""){
              $this->api_return([
					'message' => lang('not_found_email'),
					'errNum' =>2,
					'status' => false
					],200);  
    
}
    else {
        if($email_find!=""){
             send_email($email_id,"forgetpassword","password");
            $this->api_return([
					'message' => lang('Please check email'),
					'errNum' =>405,
					'status' => true
					],200);
	
        }

         else{
					$this->api_return([
					'message' => lang('error_send_email'),
					'errNum' =>401,
					'status' => false
					],200);
              }
              
    }
              
            }
            
        
	}



/*****************END 24-4-2019*****************************/



	
	public function login()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);

		ob_start();
        $lang = "ar";
        $this->checkLang($lang);
		$this->load->library('form_validation');
        $this->form_validation->set_rules('password', lang('Password'), 'required');
			$this->form_validation->set_rules('username', lang('phone_email'), 'trim|required');
        if($this->form_validation->run() === FALSE){

          $user_name = get_table_filed('customers',array('email'=>$this->input->post('username')),"email");
        if($user_name==""){
          $user_name= get_table_filed('customers',array('phone'=>$this->input->post('username')),"phone");
        }        
if(form_error('username')){
	if($this->input->post('username')==="" || !$this->input->post('username')){
	$data[] = array('message'=> strip_tags(lang('phone_email')),"errNum" =>1);
				}elseif($user_name==""){
					$data[] = array('message'=> strip_tags(lang('phone_email_error')),"errNum" => 2);
				}else{
					$data[] = array('message'=> strip_tags(lang('phone_email_error')),"errNum" => 3);
				}
            }
            
                
            if(form_error('password'))
                $data[] = array('message'=> strip_tags(lang('Password')),"errNum" => 6);
            
			//print_r($data);die;
			$this->api_return([
			'message' => $data[0]['message'],
			'errNum' => $data[0]['errNum'],
			'status' => false
			],200);
        }else{
 $cust_info = get_this('customers',['phone'=>$this->input->post('username'),'password'=>md5($this->input->post('password'))],'id');
if($cust_info==""){
  $cust_info = get_this('customers',['email'=>$this->input->post('username'),'password'=>md5($this->input->post('password'))],'id');
          }
if ($cust_info!="") {
  $customer_info = get_this('customers',['id'=>$cust_info]);
  if ((int)$customer_info['view']== 0) {
					 $payload = [
							'id' => $customer_info['id'],
							'phone' => $customer_info['phone'],
							'email' => $customer_info['email']
						];
				$this->load->library('authorization_token');
				$token = $this->authorization_token->generateToken($payload);
					$data_token['token'] =$token;
					$data_token['id_customer'] =$cust_info;
					$this->db->insert('customers_token',$data_token);
					
					///////////////////////////////////////////////////////////////////////////////
$customer_info =get_this('customers',['id'=>$cust_info]);
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['city'] =$customer_info['city_id'];
$customer_infop['token_id'] =$token;
$data['customer_info'] = $customer_infop;
$data['customer_info']['activation_status'] = lang('Account Not Activated');

					 $this->api_return([
					 'message' => lang('Account Not Activated'),
					'errNum' => 401,
					'status' => true,
					"result" => $data
					],200);
                }else{
                     if ($customer_info['view'] == 1) {
                         
						$id = $cust_info;
					 $customer_info =get_this('customers',['id'=>$id]);
					
	
					 $payload = [
							'id' => $customer_info['id'],
							'phone' => $customer_info['phone'],
							'email' => $customer_info['email']
						];
						$this->load->library('authorization_token');
						$token = $this->authorization_token->generateToken($payload);
					$data_token['token'] =$token;
					$data_token['id_customer'] =$id;
					$this->db->insert('customers_token',$data_token);
					///////////////////////////////////////////////////////////////////////////////
$customer_info =get_this('customers',['id'=>$id]);
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['city'] =$customer_info['city_id'];;
$customer_infop['token_id'] =$token;
$data['customer_info'] = $customer_infop;
$data['customer_info']['activation_status'] = lang('Account activated_status');

						 $this->api_return([
						 'message' => lang('Account activated'),
						'errNum' => 405,
						'status' => true,
						"result" => $data
						],200);
                     }
				
                }
            }else{
				$this->api_return([
					'message' => lang('wrong credential or password wrong'),
					'errNum' => 402,
					'status' => false
					],200);
            } 
        }
	}
	



	public function pages(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
        ]);
        
 $lang = "ar";
 $this->checkLang($lang); 
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
//$this->form_validation->set_rules('key_user',lang('key_user'), 'trim|required|numeric|min_length[1]|max_length[1]');

 if($this->form_validation->run() === FALSE){
            if(form_error('token_id')) {
                if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
                $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
                }
    }
/*if(form_error('key_user')){
if($this->input->post('key_user')==="" || !$this->input->post('key_user')){
$data[] = array('message'=> strip_tags(lang('user_type')),"errNum" =>1);
}
else{
$data[] = array('message'=> strip_tags(lang('user_type_error')),"errNum" =>2);
}
}*/

$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);

 }
 else {
		$pages_value=$this->db->get_where("site_info")->result();
		if(count($pages_value)>0){
		foreach($pages_value as $pages_value)

		$result['facebook']=$pages_value->facebook;
		$result['twitter']=$pages_value->twitter;
		$result['instagram']=$pages_value->instagram;
		$result['whatsapp']=$pages_value->whatsapp;
		$result['google_pluse']=$pages_value->google_pluse;
		$result['phone']=$pages_value->phone;
		$result['email']=$pages_value->email;
		$result['address']=$pages_value->address;
		$result['map']=$pages_value->map;
		//$result['content']= strip_tags(trim(preg_replace('/\s\s+/', ' ', $pages_value->content)));
            if ($result) {
              $data['pages'] = $result;
              $this->api_return([
						'message' => lang('Operation completed successfully'),
						'errNum' => 405,
						'status' => true,
						"result" => $data
					],200);
            }
      }
      
      else{
        $data['pages'] = [];
        $this->api_return([
				'message' => lang('Sorry, you do not have any pages stored in the database'),
				'errNum' => 5,
				'status' => true,
				"result" => $data
				],200);
       }
 }
     
 }
	
	public function page()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
        ]);
		ob_start();
        $lang ="ar";
        $this->checkLang($lang);

		$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('key_user',lang('key_user'), 'trim|required|numeric|min_length[1]|max_length[1]');

        $this->form_validation->set_rules('page_id', lang('Page ID'), 'required|numeric');
        if($this->form_validation->run() === FALSE){
            
             if(form_error('token_id')) {
                if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
                $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
                }
    }
if(form_error('key_user')){
if($this->input->post('key_user')==="" || !$this->input->post('key_user')){
$data[] = array('message'=> strip_tags(lang('user_type')),"errNum" =>1);
}
else{
$data[] = array('message'=> strip_tags(lang('user_type_error')),"errNum" =>2);
}
}
            
            if(form_error('page_id')){
                if($this->input->post('page_id')==="" || !$this->input->post('page_id')){
					$data[] = array('message'=> strip_tags(lang('page_id')),"errNum" =>3);
				}else{
					$data[] = array('message'=> strip_tags(lang('page_id')),"errNum" => 3);
				}
			}
			$this->api_return([
				'message' => $data[0]['message'],
				'errNum' => $data[0]['errNum'],
				'status' => false
			],200);
        }else{
            $page = get_this('pages',["flag"=>$this->input->post('key_user'),'id'=>$this->input->post('page_id'),'active'=>'1']);
            if ($page) {
                  $result = [
                                  'page_id' => (int)$page['id'],
								  'title'   => $page['title'],
                                  'content' => strip_tags(trim(preg_replace('/\s\s+/', ' ', $page['content'])))
                              ];
                 if ($result) {
							///////////////////////////////////////////////////////////////
					  
                      $data['page'] = $result;
                      $this->api_return([
						'message' => lang('Operation completed successfully'),
						'errNum' => 405,
						'status' => true,
						"result" => $data
					],200);
                 }
            }else{
                $data['page'] = [];
                $this->api_return([
						'message' => lang('Sorry, there are no pages for this ID'),
						'errNum' => 5,
						'status' => false
						//"result" => $data
					],200);
            } 
        }
	}
	
	public function tickets_types()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()],
        ]);

        $lang = "ar";
        $this->checkLang($lang);
	
			$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

if($this->form_validation->run() === FALSE){
if(form_error('token_id')) {
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}
}
$this->api_return([
'message' => $data[0]['message'],
'errNum' => $data[0]['errNum'],
'status' => false
],200);
        }else{
			$this->db->select('id,name,color');
				$this->db->where('view','1');
			$tickets = $this->db->get('tickets_types');
	$tickets_types=$tickets->result();
		
		if ($tickets_types) {
        foreach ($tickets_types as $method) {
          $result['id'] =(int)$method->id;
          $result['name'] =$method->name;
          $result['color'] =$method->color;
          $data['tickets_types'][]= $result;
        }
            if ($result) {
              
              $this->api_return([
						'message' => lang('Operation completed successfully'),
						'errNum' => 405,
						'status' => true,
						"result" => $data
					],200);
            }
      }else{
        $data['tickets_types'] = [];
        $this->api_return([
						'message' => lang('Sorry, there are no types of tickets stored in the database'),
						'errNum' => 5,
						'status' => true,
						"result" => $data
					],200);
       }
        }
	}
	
	public function new_ticket()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
        $lang ="ar";
        $this->checkLang($lang);

		$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('ticket_type_id', lang('Ticket Type'), 'trim|required|numeric');
$this->form_validation->set_rules('title', lang('Title'), 'trim|required');
$this->form_validation->set_rules('content', lang('Content'), 'trim|required');
        if($this->form_validation->run() === FALSE){


if(form_error('token_id')) {
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}
}

			
            if(form_error('ticket_type_id')){
				if($this->input->post('ticket_type_id')==="" || !$this->input->post('ticket_type_id')){
					$data[] = array('message'=> strip_tags(lang('Ticket Type')),"errNum" => 3);
				}else{
					$data[] = array('message'=> strip_tags(lang('Ticket Type_error')),"errNum" =>4);
				}
			}
			
			if(form_error('title'))
				$data[] = array('message'=> strip_tags(lang('Title')),"errNum" => 5);
			
            if(form_error('content'))
				$data[] = array('message'=> strip_tags(lang('Content')),"errNum" =>6);
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));
              $customer = get_this('customers',['id'=>$customers_id]);
               if ($customers_id) {
						$ticket_type = get_this('tickets_types',['id'=>$this->input->post('ticket_type_id')]);
						if($ticket_type){
							date_default_timezone_set('Asia/Riyadh');
                            $store = [
                                        'created_by'     =>$customers_id,
                                        'ticket_type_id' => $this->input->post('ticket_type_id'),
                                        'title'        => $this->input->post('title'),
                                        'content'        => $this->input->post('content'),
                                        'created_at'     => date('Y-m-d'),
                                        'time'     => date('h:i:s'),
                                        'type'           => 1,
                                      ];
                            $insert = $this->Main_model->insert('tickets',$store);
                            if($insert){
                                
                                $this->api_return([
										'message' => lang('Ticket successfully created'),
										'errNum' => 405,
										'status' => true
									],200);
                            }else{
                                $this->api_return([
										'message' => lang('Error in added'),
										'errNum' => 9,
										'status' => false
									],200);
                            }
						}else{
							$this->api_return([
							   'message' => lang('No Tickets Types With This Id'),
								'errNum' => 5,
								'status' => false
							],200);
						}
                       
              
               }else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
               }
        }
	}
	
	public function new_reply()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang = $this->input->post('lang');
        $this->checkLang($lang);

		$this->load->library('form_validation');
        $this->form_validation->set_rules('ticket_id', lang('Ticket ID'), 'trim|required|numeric');
        $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
        $this->form_validation->set_rules('content', lang('Content'), 'trim|required');
        if($this->form_validation->run() === FALSE){
            if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
            
            
            if(form_error('ticket_id')){
				if($this->input->post('ticket_id')==="" || !$this->input->post('ticket_id')){
					$data[] = array('message'=> strip_tags(lang('Ticket ID')),"errNum" =>2);
				}else{
					$data[] = array('message'=> strip_tags(lang('Ticket ID_error')),"errNum" =>3);
				}
			}
			

			
            if(form_error('content'))
				$data[] = array('message'=> strip_tags(lang('Content')),"errNum" =>4);
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));
              $customer = get_this('customers',['id'=>$customers_id]);
               if ($customer) {
                            $ticket = get_this('tickets',['id'=>$this->input->post('ticket_id')]);
                            if ($ticket) {
								date_default_timezone_set('Asia/Riyadh');
                                $store = [
                                      'created_by' => $customers_id,
                                      'ticket_id'  => $this->input->post('ticket_id'),
                                      'content'    => $this->input->post('content'),
                                      'created_at' => date('Y-m-d'),
                                      'reply_type' => 1,
                                      'created_at' => date('Y-m-d'),
                                      'time'       => date('H:i:s')
                                    ];
                                $insert = $this->Main_model->insert('tickets_replies',$store);
								
								//Update action to Unread ticket For Admin Panel
								$update['status_id'] = 0;
								$update['updated_at'] = date('Y-m-d');
								$this->Main_model->update('tickets',['id'=>$this->input->post('ticket_id')],$update);
                                //////////////////////////////////////////////////////////////
								
								if($insert){
									$tickets_replies = get_this('tickets_replies',['id' => $insert]);
									//print_r($tickets_replies);die;

										$replies = [
											'id'=> $tickets_replies['id'],
                                            'created_at' => $tickets_replies['created_at'],
                                            'time'       => $tickets_replies['time'],
                                            'content'    => $tickets_replies['content'],
											'sender'	=>get_this('customers',['id' =>$tickets_replies['created_by']],'user_name')
										];

									$data['replies'] = $replies;
                                    $this->api_return([
											'message' => lang('Your reply has been sent successfully'),
											'errNum' => 405,
											'status' => true,
											"result" => $data
										],200);
                                }else{
                                    $this->api_return([
											'message' => lang('Error In Sending'),
											'errNum' => 9,
											'status' => false
										],200);
                                }
                            }else{
                                $this->api_return([
										'message' => lang('Sorry there are no tickets for this number'),
										'errNum' => 5,
										'status' => false
									],200);
                            }
                       
                   
               }
               else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
               }
        }
	}
	
	public function tickets()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
        $lang ="ar";
        $this->checkLang($lang);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
		$this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
		$this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric');
		if($this->form_validation->run() === FALSE){

if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
			
            if(form_error('limit')){
				if($this->input->post('limit')==="" || !$this->input->post('limit')){
					$data[] = array('message'=> strip_tags(lang('limit')),"errNum" => 2);
				}else{
					$data[] = array('message'=> strip_tags(lang('limit_error')),"errNum" => 3);
				}
			}
			
            if(form_error('page_number')){
				if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
					$data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 4);
				}else{
					$data[] = array('message'=> strip_tags(lang('page_number_error')),"errNum" => 5);
				}
			}
            $this->api_return([
						'message' => $data[0]['message'],
				'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));
          $user_info = get_this('customers',['id' =>$customers_id]);
          if ($user_info) {
			  $total = get_this_limit('tickets',['created_by'=>$user_info['id']]);
                      $offset = $this->input->post('limit') * $this->input->post('page_number');
                      $where['created_by'] = (int)$user_info['id'];
                     
                      $tickets = $this->db->order_by('id','DESC')
										  //->select('id, title_ar')
                                          ->get_where('tickets',$where,$this->input->post('limit'),$offset)
                                          ->result();
                      if ($tickets) {
						
                        foreach ($tickets as $ticket) {
						$color = get_this('tickets_types',['id' => $ticket->ticket_type_id],'color');
						$type = get_this('tickets_types',['id' => $ticket->ticket_type_id],'name');
					
                          $result[] = [
                                            'id'      => (int)$ticket->id,
                                            'title'   => $ticket->title,
                                            'type'   => $type,
                                            'sender_type'   => $ticket->type,
                                            'color'   => $color,
                                            'content' => strip_tags(trim(preg_replace('/\s\s+/', ' ', $ticket->content))),
                                            'created_at' => $ticket->created_at
                                      ];
                        }
                        
						
						if($lang=='arabic' || $lang=="" || $lang!="english"){
						}else{
						}
						$total = count($total);
						if ($result) {
                                  $data['my_tickets'] = $result;
                                  $this->api_return([
										'message' => lang('Operation completed successfully'),
										'errNum' => 405,
										'status' => true,
										'total' => $total,
										"result" => $data
									],200);
                              }
						}else{
							$data['my_tickets'] = [];
                            $this->api_return([
									'message' => lang('Sorry, there are no special tickets for you'),
									'errNum' => 5,
									'status' => true,
									"result" => $data
								],200);
                     } 

          
          }else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
          }
        }
	}
	
	public function ticket()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang = $this->input->post('lang');
        $this->checkLang($lang);

		$this->load->library('form_validation');
        $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
        $this->form_validation->set_rules('ticket_id', lang('Ticket ID'), 'required|numeric');
        if($this->form_validation->run() === FALSE){
            
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
			
            if(form_error('ticket_id')){
				if($this->input->post('ticket_id')==="" || !$this->input->post('ticket_id')){
					$data[] = array('message'=> strip_tags(lang('Ticket ID')),"errNum" => 2);
				}else{
					$data[] = array('message'=> strip_tags(lang('Ticket ID_error')),"errNum" => 3);
				}
			}
			 
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
        }else{
            $customers_id=get_customer_id($this->input->post('token_id'));

          $user_info = get_this('customers',['id' =>$customers_id]);
          if ($user_info) {
                      $ticket = get_this('tickets',['id'=>$this->input->post('ticket_id'),'created_by'=>$customers_id]);
                      if ($ticket) {
							$color = get_this('tickets_types',['id' => $ticket['ticket_type_id']],'color');
							$type = get_this('tickets_types',['id' => $ticket['ticket_type_id']],'name');
							
                            $result = [
                                            'ticket_id' => (int)$ticket['id'],
                                            'title' => $ticket['title'],
                                            'type'     => $type,
                                            'color'     => $color,
                                            'content'   => strip_tags(trim(preg_replace('/\s\s+/', ' ', $ticket['content']))),
                                            'created_at'   => $ticket['created_at']
                                        ];
                           if ($result) {
                                $data['ticket_info']['ticket'] = $result;
                                $ticket_replies = get_table('tickets_replies',['ticket_id'=>(int)$ticket['id']]);
                                $replies = [];
						

                                if ($ticket_replies) {
                                  foreach ($ticket_replies as $reply) {
                                            $replies[] =[
                                                          'id'         => (int)$reply->id,
                                                          'created_at' => $reply->created_at,
                                                          'time'       => $reply->time,
                                                          'content'    => strip_tags(trim(preg_replace('/\s\s+/', ' ', $reply->content))),
                                                          'sender'     => ($reply->reply_type == '0') ? 'خدمة العملاء' : get_this('customers',['id' => $reply->created_by],'user_name'),
                                     'sender_type'=>(int)$reply->reply_type
                                                        ]; 
                                 }
                                 $data['ticket_info']['replies_number'] = get_table('tickets_replies',['ticket_id'=>(int)$ticket['id']],'count');
                                 $data['ticket_info']['ticket_replies'] = $replies;
                                }else{
									$data['ticket_info']['replies_number']=1;
                                  $data['ticket_info']['ticket_replies'] = $replies;
                                }
                                $this->api_return([
										'message' => lang('Operation completed successfully'),
										'errNum' => 405,
										'status' => true,
										"result" => $data
									],200);
                           }
                      }else{
                          $data['ticket'] = [];
                          $this->api_return([
									'message' => lang('Sorry, there are no tickets with this ID'),
									'errNum' => 5,
									'status' => false
									//"result" => $data
								],200);
                      } 
       
          }else{
                   $this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
          }
        }
	}
	

	
	public function custom_menu()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang ="ar";
        $this->checkLang($lang);
		
		$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
		if($this->form_validation->run() === FALSE){
					
	if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
$this->api_return([
'message' => $data[0]['message'],
'errNum' => $data[0]['errNum'],
'status' => false
],200);
					
		}
		else{
$user_mode_key=$this->input->post('user_mode_key');

$customer_id=get_customer_id($this->input->post('token_id'));    


if($customer_id!=""&&$customer_id!=-1){

$customers_id=get_table_filed('customers',array('id'=>(int)$customer_id),"id");
$customer_info = get_this('customers',['id'=>$customers_id]);    

					
$customer_info =get_this('customers',['id'=>$customers_id]);
$customer_infop['id'] =(int)$customer_info['id'];
$customer_infop['name'] = $customer_info['user_name'];
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
$customer_infop['fav_num'] = count($this->db->get_where('favourites',['user_id'=>$customers_id])->result());
$customer_infop['city'] =$customer_info['city_id'];;
$customer_infop['myadv_num']=count($this->db->get_where("products",array("user_id"=>$customers_id))->result());

$this->db->where("(server_id=$customers_id OR send_id=$customers_id)");
$query = $this->db->get('messages');
$customer_infop['mychat_num']=count($query->result());
$data['customer_info']= $customer_infop;
		
	
$this->api_return([
'message' => lang('Operation completed successfully'),
'errNum' => 405,
'status' => true,
"result" => $data
],200);	
	
	
		}

else {
$this->api_return([
'message' => lang('Sorry, there are no data for this user'),
'errNum' => 402,
'status' => false
],200);	    
	    
	}
     

		 
       
		}
		
	}
	

	public function logout()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang = "ar";
        $this->checkLang($lang);
		
		$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');

		if($this->form_validation->run() === FALSE){
if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

	
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
					
		}else{
		    
		 $token_id= get_customer_id($this->input->post('token_id'));
		 $tok_id=get_table_filed('customers_token',array('token'=>$this->input->post('token_id')),"id");
        	if ($token_id!="") {
					$this->db->delete('customers_token', array('id'=>$tok_id)); 
					///////////////////////////////////////////////////////////////////////////////
					$this->api_return([
						'message' =>"تم تسجيل الخروج بنجاح",
						'errNum' => 405,
						'status' => true
					],200);
        		
        	}else{
				$this->api_return([
						'message' => lang('Sorry, there are no data for this user'),
						'errNum' => 402,
						'status' => false
					],200);
        	}
		}
		
	}



	
public function get_all_package() {
header("Access-Control-Allow-Origin: *");
// API Configuration
$this->_apiConfig(['methods' => ['POST'],'key' => ['POST', $this->key()],]);
 $lang = "ar";
 $this->checkLang($lang); 
$customers_id=get_customer_id($this->input->post('token_id'));

$packages = $this->db->get_where('codes',array('view'=>'1'))->result();
if(count($packages)>0){
foreach($packages as $package){
$title=$package->code_name;
$result['package id']= (int)$package->id;
$result['package name']= $title;
$result['package descrption']=$package->descrption;
$result['package price']= $package->price;
$result['package time_days']= $package->time_days;
$result['package total_used']= $package->total_used;

$result['package icon']= base_url()."uploads/icons/".$package->icon;
if($customers_id!=""){
  $coustomer_code_id= get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'id_code'=>$package->id,'count<='=>$package->total_used,'expire_date!='=>date("Y-m-d")),"id");
  if($coustomer_code_id!=""){ $result['user_registered']=1; }else {$result['user_registered']=0;}
}
else {
 $result['user_registered']=0;   
}
$data['All Packages'][] = $result;
}	

$this->api_return([
						'message' => lang('Operation completed successfully'),
						'errNum' => 405,
						'status' => true,
						"result" => $data
					],200);
}
else {
$data['packages'] = [];
        $this->api_return([
				'message' => lang('Sorry there is no data to display'),
				'errNum' => 5,
				'status' => true,
				"result" => $data
				],200);
}


}


public function subscribe_package(){
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
		ob_start();
        $lang ="ar";
        $this->checkLang($lang);
		
		$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('package_id',lang('key_user'), 'trim|required|numeric|min_length[1]|max_length[1]');

		if($this->form_validation->run() === FALSE){
					
	if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}

if(form_error('package_id')){
if($this->input->post('package_id')==="" || !$this->input->post('package_id')){
$data[] = array('message'=> strip_tags(lang('package_code')),"errNum" =>1);
}
else{
$data[] = array('message'=> strip_tags(lang('package_code')),"errNum" =>2);
}
}
			
            $this->api_return([
						'message' => $data[0]['message'],
						'errNum' => $data[0]['errNum'],
						'status' => false
					],200);
					
		}
else{
    $customers_id=get_customer_id($this->input->post('token_id'));
if ($customers_id) {
    $total_used=get_table_filed('codes',array('id'=>$this->input->post('package_id')),"total_used");
    $time_days=get_table_filed('codes',array('id'=>$this->input->post('package_id')),"time_days");
    
    $expire_date=date('Y-m-d', strtotime(date("Y-m-d"). " + $time_days days"));
  $coustomer_code_id= get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'id_code'=>$this->input->post('package_id'),'count<='=>$total_used,'expire_date>'=>date("Y-m-d")),"id");
   if($coustomer_code_id==""){
            date_default_timezone_set('Asia/Riyadh');
            $store = [
            'id_customer' => $customers_id,
            'id_code'        => $this->input->post('package_id'),
            'creation_date'     => date('Y-m-d'),
            'count'            =>'0',
            'expire_date'     => $expire_date,
             'success'     => '1'
            ];
            $insert = $this->Main_model->insert('coustomer_code',$store);
            if($insert){
            
            $this->api_return([
            'message' => lang('package_success'),
            'errNum' => 405,
            'status' => true
            ],200);
            }else{
            $this->api_return([
            'message' => lang('Error in added'),
            'errNum' => 9,
            'status' => false
            ],200);
            }
   }
   else {$this->api_return([
            'message' => 'انت مشترك بالفعل فى الباقة الحالية',
            'errNum' =>406,
            'status' => false
            ],200);}
            }
            else{
            $this->api_return([
            'message' => lang('Sorry, there are no data for this user'),
            'errNum' => 402,
            'status' => false
            ],200);
            }

		}
		
	}



  public function get_all_myadvertising(){
    header("Access-Control-Allow-Origin: *");
    $this->_apiConfig([
        'methods' => ['POST'],
        'key' => ['POST', $this->key()]
  ]);
    $lang ="ar";
    $this->checkLang($lang);
  $this->load->library('form_validation');
  $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
  $this->form_validation->set_rules('limit', lang('Number of visible elements'), 'trim|required|numeric');
  $this->form_validation->set_rules('page_number', lang('Page Number'), 'trim|required|numeric'); 
  $this->form_validation->set_rules('key_id', lang('my_advertising_code'), 'trim|required|numeric'); 
    if($this->form_validation->run() === FALSE){
        
      if(form_error('token_id')){
        if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
        $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
        }else {
        $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
        }	
        }

  if(form_error('limit')){
  if($this->input->post('limit')==="" || !$this->input->post('limit')){
  $data[] = array('message'=>strip_tags(lang('limit')),"errNum" =>2);
  }else{$data[] = array('message'=>strip_tags(lang('limit')),"errNum" => 3);}
  }
  
if(form_error('page_number')){
if($this->input->post('page_number')==="" || !$this->input->post('page_number')){
$data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 4);
}else{
$data[] = array('message'=> strip_tags(lang('page_number')),"errNum" => 5);
}
}

if(form_error('key_id')){
  if($this->input->post('key_id')==="" || !$this->input->post('key_id')){
  $data[] = array('message'=> strip_tags(lang('my_advertising_code')),"errNum" => 6);
  }else{
  $data[] = array('message'=> strip_tags(lang('my_advertising_code')),"errNum" => 7);
  }
  }

  
              $this->api_return([
    'message' => $data[0]['message'],
    'errNum' => $data[0]['errNum'],
    'status' => false
  ],200);
    }
  else{
    $customers_id=get_customer_id($this->input->post('token_id'));
if ($customers_id) {
  $key_id=$this->input->post('key_id');
  $limit=$this->input->post('limit');
  $page_number=$this->input->post('page_number');
  if($key_id==1){$array=array('user_id'=>$customers_id,'delete_key'=>'1','expired_date'=>'1','view'=>'1');}
  if($key_id==2){$array=array('user_id'=>$customers_id,'expired_date'=>'0');}
  if($key_id==3){$array=array('user_id'=>$customers_id,'delete_key'=>'0');}
  if($key_id==4){$array=array('user_id'=>$customers_id,'view'=>'0');}
  $total = $this->data->get_table_data('products',$array);
  $offset =$limit * $page_number;
  $sql_product=$this->db->order_by('id','DESC')->get_where('products',$array,$limit, $offset)->result();
  
  
  if (count($sql_product)>0) {
  foreach ($sql_product as $page) {
      
  if($this->input->post('token_id')!=""){
  $customers_id=get_customer_id($this->input->post('token_id'));    
  if($customers_id){
  $id_fav =get_table_filed('favourites',array('user_id'=>$customers_id,'course_id'=>$page->id),"id");
  if($id_fav!=""){
    $result['favourite_key']=1;
  }
  else{
    $result['favourite_key']=0;	
  }
  }else {	$result['favourite_key']=0;}
  }else {	$result['favourite_key']=0;}
  
  
  $result['name']=$page->name;
  if($page->city_id!=""){
  $result['city']=get_name('city',$page->city_id);
  }
  else {
  $result['city']="";    
  }
  if($page->views!=""){
  $result['views']=$page->views;
  }
  else {
  $result['views']="";    
  }
  
  if($page->special!=""){
    $result['special']=$page->special;
    }
    else {
    $result['special']="";    
    }

  if($page->price!=""){
  $result['price']=$page->price."".get_name('currency',$page->currency_id);
  }
  else{
  $result['price']=""; 
  }
  if($page->date_title!=""){
  $result['date_title']=date("d",strtotime($page->creation_date))."".$page->date_title;
  }
  else{
  $result['date_title']=" "; 
  }
  
  $result['id']=(int)$page->id;
  
  $category_name=get_table_filed('category',array('id'=>$page->cat_id),"name");
  if($category_name!=""){
    $result['category id']=(int)$page->cat_id;  
  $result['category name']=$category_name;
  }
  else {
    $result['category id']=""; 
  $result['category name']="";    
  }
  
  $dep_id=$page->dep_id;
if($dep_id!=0){
 $result['dep_id'] =(int)$dep_id;   
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";$result['dep_id'] ="";}

  if($page->img!=""){
  $result['image']=base_url()."uploads/products/".$page->img;
  }
  else {
  $result['image']=base_url()."uploads/products/no_img.png";
  }
  
  $data['all_myadvertising'][]= $result;
                  }
                       $total = count($total);
               //$data['my_favourite'] = $result;
               $this->api_return([
                'message' => lang('Operation completed successfully'),
                'errNum' => 405,
                'status' => true,
                'total' => $total,
                "result" => $data
              ],200);
                  
                  
                  }
                  else {
               $data['all_myadvertising'] = [];
               $total = count($total);
               $this->api_return([
                'message' => lang('no_data'),
                'errNum' => 401,
                'status' => false,
                'total' => $total,
                "result" => $data
                ],200);
                  }
                }
                else{
                $this->api_return([
                'message' => lang('Sorry, there are no data for this user'),
                'errNum' => 402,
                'status' => false
                ],200);
                }

  }
}




public function update_myadvertising()
{
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'],
      'key' => ['POST', $this->key()]
]);
  $lang ="ar";
  $this->checkLang($lang);
$this->load->library('form_validation');
$this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('advertising_id', lang('Course ID'), 'trim|required|numeric');
$this->form_validation->set_rules('key_id', lang('my_advertising_code'), 'trim|required|numeric'); 
  if($this->form_validation->run() === FALSE){
      
    if(form_error('token_id')){
      if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
      $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
      }else {
      $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
      }	
      }

if(form_error('advertising_id')){
if($this->input->post('advertising_id')==="" || !$this->input->post('advertising_id')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 2);
}else if(get_table_filed('products',array('id'=>$this->input->post('advertising_id')),"id")==""){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 3);
}	
}

if(form_error('key_id')){
if($this->input->post('key_id')==="" || !$this->input->post('key_id')){
$data[] = array('message'=> strip_tags(lang('my_advertising_code')),"errNum" => 6);
}else{
$data[] = array('message'=> strip_tags(lang('my_advertising_code')),"errNum" => 7);
}
}


  $this->api_return([
  'message' => $data[0]['message'],
  'errNum' => $data[0]['errNum'],
  'status' => false
],200);
  }
else{
  $customers_id=get_customer_id($this->input->post('token_id'));
  $advertising_id=$this->input->post('advertising_id');
if ($customers_id) {
$key_id=$this->input->post('key_id');
if($key_id==3){$array=array('user_id'=>$customers_id,'delete_key'=>'0');}
if($key_id==4){$array=array('user_id'=>$customers_id,'view'=>'0');}
$product_view= (int)get_table_filed('products',array('id'=>$advertising_id),"view");
if($key_id==5&&$product_view==0){
$coustomer_code_id= (int)get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"id");
if($coustomer_code_id!=""){
  $id_code=(int)get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"id_code");
  $expired_package=get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"expire_date");
  $count_package_used=get_table_filed('coustomer_code',array('id_customer'=>$customers_id,'package_end'=>'0'),"count");
  $total_used=get_table_filed('codes',array('id'=>$id_code),"total_used");

  if($expired_package<date("Y-m-d")){
$data_pacakage['package_end']='1';
$this->db->update("coustomer_code",$data_pacakage,array('id'=>$coustomer_code_id));
                                    }

else if($total_used<=$count_package_used){
    $data_pacakage['package_end']='1';
    $this->db->update("coustomer_code",$data_pacakage,array('id'=>$coustomer_code_id));
                                         } 
      else {
        $data_pacakage['count']=$count_package_used+1;
        $this->db->update("coustomer_code",$data_pacakage,array('id'=>$coustomer_code_id));  
           }
           $data_products['view']='1';
           $this->db->update("products",$data_products,array('id'=>$advertising_id));  
           $data['key']=4;
           $this->api_return([
            'message' => "تم اعادة نشر الاعلان بنجاح",
            'errNum' => 405,
            'status' => true,
            "result" => $data
          ],200);
                          }

else {
  $this->api_return([
  'message' => "نأسف لنتهاء الباقة الخاصة بيك",
  'errNum' => 405,
  'status' => true,
],200);
      }
 }
 else if($key_id==5&&$product_view==1){
  $data['key']=4;
  $this->api_return([
    'message' => "تم عرض اعلانك بالفعل فى قائمة الاعلانات",
    'errNum' => 405,
    'status' => true,
    "result" => $data
  ],200);

 }

else if($key_id==4){
  $data['key']=5;
  $data_products['view']='0';
  $this->db->update("products",$data_products,array('id'=>$advertising_id)); 
  $this->api_return([
    'message' => "تم ايقاف ظهور الأعلان",
    'errNum' => 405,
    'status' => true,
    "result" => $data
  ],200); 
                   }
 else if($key_id==3){
                    $data['key']=3;
                    $data_products['delete_key']='0';
                    $this->db->update("products",$data_products,array('id'=>$advertising_id)); 
                    $this->api_return([
                      'message' => "تم حذف اعلانك بالفعل",
                      'errNum' => 405,
                      'status' => true,
                      "result" => $data
                    ],200); 
           }

else{
  $this->api_return([
  'message' => lang('Sorry, there are no data for this user'),
  'errNum' => 402,
  'status' => false
  ],200);
  }
    
                 }

}

}




public function preparation_edit_advertising(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
    // ,'requireAuthorization' => true //this used if reqired token valye
  ]);
 $lang = "ar";
 $this->load->library('form_validation');
 $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
 $this->form_validation->set_rules('advertising_id', lang('Course ID'), 'trim|required|numeric');
   if($this->form_validation->run() === FALSE){
     if(form_error('token_id')){
       if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
       $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
       }else {
       $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
       }	
       }
 
 if(form_error('advertising_id')){
 if($this->input->post('advertising_id')==="" || !$this->input->post('advertising_id')){
 $data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 2);
 }else if(get_table_filed('products',array('id'=>$this->input->post('advertising_id')),"id")==""){
 $data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" => 3);
 }	
 }
   $this->api_return([
   'message' => $data[0]['message'],
   'errNum' => $data[0]['errNum'],
   'status' => false
 ],200);

   }

   else{
    $sql_bag=$this->db->get_where('products',array('delete_key'=>'1','id'=>$this->input->post('advertising_id')))->result();
    if(count($sql_bag)>0){
    
      foreach ($sql_bag as $bage)
    $result['id']=(int)$bage->id;
    $result['name']=$bage->name; 
    $user_id=$bage->user_id;
    $result['user_id']=(int)$user_id;

$result['city_id'] =$bage->city_id;   
if($bage->city_id!=""){
$result['city'] =get_name('city',$bage->city_id);
}
else {
 $result['city']="";
}
    if($bage->details!=""){
    $result['details']=$bage->details;
    }else {$result['details']="";}

    $result['currency_id']= $bage->currency_id;

    if($bage->price!=""){$result['price']=$bage->price;}
    else {$result['price']="";}
   

    $cat_id=$bage->cat_id;
    if($cat_id!=0){
    $result['category id'] =(int)$cat_id;
    $result['category name'] =get_table_filed('category',array('id'=>$cat_id),"name");
    }
 else { $result['category name']=""; $result['category id'] ="";}

    $dep_id=$bage->dep_id;
if($dep_id!=0){
  $result['dep_id'] =(int)$dep_id; 
$result['department'] =get_table_filed('department',array('id'=>$dep_id),"name");
}
else {$result['department']="";$result['dep_id'] ="";}

   

    $result['user_email'] =$bage->user_email;
    $result['user_phone'] =$bage->user_phone;

    $images_g=$this->db->get_where('images',array('id_products'=>$bage->id))->result();
    if(count($images_g)>0){
    foreach($images_g as $images){$result_img['images'][]=base_url()."uploads/products/".$images->image; }
    }
    if($bage->img!=""){$result_img['images'][]=base_url()."uploads/products/".$bage->img;}
    else {$result_img['image'][]=base_url()."uploads/products/no_img.png";} 
    
    $data['Advertising details']= $result;
    $data['Gallery']= $result_img;
    $this->api_return([
                  'message' => lang('Operation completed successfully'),
                  'errNum' => 405,
                  'status' => true,
                  "result" => $data
                ],200);
    
        
    }//______________//END IF for count
    else {
    $data['Advertising details'] = [];
    $this->api_return([
    'message' => lang('no_data'),
    'errNum' => 401,
    'status' => false,
    "result" => $data
    ],200);     
    }

  }
}







public function preparation_add_advertising(){
  header("Access-Control-Allow-Origin: *");
  $this->_apiConfig([
      'methods' => ['POST'], //This Function by default request method GET
      'key' => ['POST', $this->key()]
    // ,'requireAuthorization' => true //this used if reqired token valye
  ]);
 $lang = "ar";
 $this->load->library('form_validation');
 $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
   if($this->form_validation->run() === FALSE){
     if(form_error('token_id')){
       if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
       $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
       }else {
       $data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
       }	
       }
 
   $this->api_return([
   'message' => $data[0]['message'],
   'errNum' => $data[0]['errNum'],
   'status' => false
 ],200);

   }

   else{
   $customer_id= get_customer_id($this->input->post('token_id')); //get_this('customers',['device_reg_id'=>$this->input->post('token_id')]);

if ($customer_id!="") {
$id = $customer_id;
   $customer_info =get_this('customers',['id'=>$id]);
$customer_infop['phone'] =$customer_info['phone'];
$customer_infop['email'] =$customer_info['email'];
 $data['customer_info'] = $customer_infop;
 
 
 
 $currency=$this->db->order_by('id','desc')->get_where('currency',array('view'=>'1'))->result();
		if (count($currency)>0) {
            	
        foreach ($currency as $page) {
            $resultp['currency_name']=$page->name;
             $resultp['currency_id']=(int)$page->id;
        $data['all_currency'][]= $resultp;
        }
        
        
		}
	    else{
	         $resultp['currency_name']="";
             $resultp['currency_id']="";
        $data['all_currency'][]= $resultp;
       }
       
 $all_city=$this->db->order_by('id','desc')->get_where('city',array('view'=>'1'))->result();
		if (count($all_city)>0) {
            	
        foreach ($all_city as $page) {
            $resultcity['city_name']=$page->name;
             $resultcity['city_id']=(int)$page->id;
        $data['all_cities'][]= $resultcity;
        }
        
        
		}
	    else{
	         $resultp['city_name']="";
             $resultp['city_id']="";
        $data['all_cities'][]= $resultcity;
       }
                              $this->api_return([
								'message' => lang('Operation completed successfully'),
								'errNum' => 405,
								'status' => true,
								"result" => $data
								],200);
							 
                     }
                     
                     
                     
                     
                     else {
                         $this->api_return([
'message' => lang('device_token_id_error'),
'errNum' => 4,
'status' => false
],200);
                     }
                     
  
                     

   }
            
        }



public function add_soical(){
        header("Access-Control-Allow-Origin: *");
        $this->_apiConfig([
            'methods' => ['POST'],
			'key' => ['POST', $this->key()]
        ]);
       $lang ="ar";
      $this->checkLang($lang);
        $this->load->library('Authorization_Token');
		$this->load->library('form_validation');
        $this->form_validation->set_rules('social_type',lang('social_type'), 'trim|required');
        $this->form_validation->set_rules('price', lang('price_advert'), 'trim|required');
        $this->form_validation->set_rules('cat_id', lang('cat_id'), 'trim|required');
        $this->form_validation->set_rules('token_id', lang('Customer ID'), 'trim|required');
$this->form_validation->set_rules('advertising_id', lang('Course ID'), 'trim|required|numeric');

        if($this->form_validation->run() === FALSE){
		
		if(form_error('token_id')){
if($this->input->post('token_id')==="" || !$this->input->post('token_id')){
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 0);
}else {
$data[] = array('message'=> strip_tags(lang('Customer ID')),"errNum" => 1);
}	
}
      

              //**************** */
if(form_error('social_type')){
if($this->input->post('social_type')==="" || !$this->input->post('social_type')){
$data[] = array('message'=> strip_tags(lang('social_type_error')),"errNum" =>2);
}
}              

            
 if(form_error('price')){
if($this->input->post('price')==="" || !$this->input->post('price')){
$data[] = array('message'=> strip_tags(lang('price_advert')),"errNum" =>7);
}
}

if(form_error('advertising_id')){
if($this->input->post('advertising_id')==="" || !$this->input->post('advertising_id')){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>8);
}else if(get_table_filed('products',array('id'=>$this->input->post('advertising_id')),"id")==""){
$data[] = array('message'=> strip_tags(lang('Course ID')),"errNum" =>9);
}	
}

if(form_error('cat_id')){
if($this->input->post('cat_id')==="" || !$this->input->post('cat_id')){
$data[] = array('message'=> strip_tags(lang('cat_id')),"errNum" =>11);
}	
}


$this->api_return([
        'message' => $data[0]['message'],
        'errNum' => $data[0]['errNum'],
        'status' => false
    ],200);



        }

        else{
			
          $customers_id=get_customer_id($this->input->post('token_id'));
          date_default_timezone_set('Asia/Riyadh');
          

  
                  
                      $store = [
                                'user_id'          	=> $customers_id,
                                'adversiting_id'    => $this->input->post('advertising_id'),
                                'social_type'           =>$this->input->post('social_type'),
                                'sex'        => $this->input->post('sex'),
                                'age_f'            => $this->input->post('age_f'),
                                'age_t'        => $this->input->post('age_t'),
                                'places'      =>$this->input->post('places'),
                                'timing'      =>$this->input->post('timing'),
                                'hr_f'      =>$this->input->post('hr_f'),
                                'hr_t'      =>$this->input->post('hr_t'),
                                'img_type'      =>$this->input->post('img_type'),
                                'date_title'    => gen_month_name(date('m'))." ".date("d"),
                                'price'         =>$this->input->post('price'),
                                'date'       => date('Y-m-d'),
                                'cat_id'       => $this->input->post("cat_id"),
                                
                              ];
                              $insert = $this->db->insert('soical_advertising',$store);
                             $id= $this->db->insert_id();
           
          
                       //Check Insert User Data
          if($id){

            if(isset($_FILES['img']['name'])){
              $file=$_FILES['img']['name'];
              $file_name="img";
              get_img_config_course('soical_advertising','uploads/soical_advertising/',$file,$file_name,'img','gif|jpg|png|jpeg',600000,600000,600000,array('id'=>$id),"800","600");
              }           
 

          $result['id_order']=(int)$id;
      
          $this->api_return([
                        'message' =>"تم اضافة بيانات اعلان السوشيل بنجاح",
                        'errNum' => 405,
                        'status' => true,
                        "result" => $result
                      ],200);
          }
          else {
          $data['details'] = [];
          $this->api_return([
          'message' => "فشل اضافة البيانات",
          'errNum' => 401,
          'status' => false,
          "result" => $data
          ],200); 
          }
///////////////////////////////////////////////////////////////////////////////////////////////////////////
}


        }

}