<?php defined('BASEPATH') OR exit('No direct script access allowed');



function get_table_filed($table, $where = array() , $filed = null)

{
	$ci= & get_instance();
	$query = $ci->db->get_where($table, $where);
	foreach($query->result() as $row) {
		return $row->$filed;
	}
}

function get_table_total($table, $where = array())

{
	$ci= & get_instance();
	$query = $ci->db->get_where($table, $where)->result();
		return count($query);
}
function get_message_total($table,$where)

{
	$ci= & get_instance();
	$ci->db->where($where);
    $query = $ci->db->get($table);
	$mychat_num=count($query->result());
	return $mychat_num;
}



function get_message_id($table,$where, $filed = null)

{
	$ci= & get_instance();
	$ci->db->where($where);
    $query = $ci->db->get($table);
	foreach($query->result() as $row) {
		return $row->$filed;
	}
}
function get_name($table,$filed)

{

	$ci= & get_instance();

	$query = $ci->db->get_where($table,array('id'=>$filed));

	foreach($query->result() as $row) {

		return $row->name;

	}

}




function gen_random_string(){

$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36

$final_rand='';

for($i=0;$i<4; $i++) {

 $final_rand .= $chars[ rand(0,strlen($chars)-1)];

    }

return $final_rand;

}



function limit_text($text, $limit) {

      if (str_word_count($text, 0) > $limit) {

          $words = str_word_count($text, 2);

          $pos = array_keys($words);

          $text = substr($text, 0, $pos[$limit]) . '...';

      }

      return $text;

    }

    

    function trunc($phrase, $max_words) {

   $phrase_array = explode(' ',$phrase);

   if(count($phrase_array) > $max_words && $max_words > 0)

      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';

   return $phrase;

}

    

function gen_random_string_code(){

$chars ="1234567890";//length:36

$final_rand='';

for($i=0;$i<6; $i++) {

 $final_rand .= $chars[ rand(0,strlen($chars)-1)];

    }

return $final_rand;

}



function gen_month_name($dt){



    switch ($dt) {

    case 1:

        $tdx= "يناير";

        break;

    case 2:

         $tdx= "فبراير";

        break;

    case 3:

         $tdx= "مارس";

        break;

        case 4:

         $tdx= "أبريل";

        break;

        case 5:

         $tdx= "مايو";

        break;

        case 6:

         $tdx= "يوينو";

        break;

        case 7:

         $tdx= "يوليو";

        break;

        case 8:

         $tdx= "أغسطس";

        break;

        case 9:

         $tdx= "سبتمبر";

        break;

        case 10:

         $tdx= "اكتوبر";

        break;

        case 11:

         $tdx= "نوفمبر";

        break;

        case 12:

         $tdx= "ديسمبر";

        break;

        

    default:

         $tdx= "الشهر غير صحيح";

}



return $tdx;

}





 /*function do_resize($id_courses){

$ci= & get_instance();

$img=get_table_filed('products',array('id'=>$id_courses),"img");



    $config_manip = array(

        'image_library' => 'gd2',

        'source_image' => "uploads/products/$img",

        'new_image' => "uploads/products/thumbnail/",

        'maintain_ratio' => TRUE,

        'create_thumb' => TRUE,

        'thumb_marker' => '_thumb',

        'width' => 255,

        'height' => 150

    );

    $ci->load->library('image_lib', $config_manip);

    if (!$ci->image_lib->resize()) {

        echo $ci->image_lib->display_errors();

         return $ci->image_lib->display_errors();

    }

   // $ci->image_lib->clear();

    

   if($img!=""){

$data_150['img_150']=$img;

$ci->db->update("products",$data_150,array("id"=>$id_courses));

} 

   

}*/





 function get_customer_id($token){
    $id_customer=get_table_filed('customers_token',array('token'=>$token),"id_customer");
        return $id_customer;
	}
	

	function get_customer_id_forent($token){
		$id_customer=get_table_filed('customers',array('device_id'=>$token),"id");
			return $id_customer;
		}

		function get_notifactions($customer){

			$ci= & get_instance();

	$query = $ci->db->order_by("id","desc")->get_where("notifications", array("customer_id"=>$customer))->result();

		return $query;

	}

			

	function get_favourites($customer){

		$ci= & get_instance();

$query = $ci->db->get_where("favourites", array("user_id"=>$customer))->result();

	return $query;

}



function get_img_size($key){

    	$ci= & get_instance();

	$query = $ci->db->get_where("system_setting", array("key_txt"=>$key))->result();

		foreach($query as $row) {

		return $row->txt_value;

	}

 }

 

 function get_img_resize($url,$width,$height){

 $ci= & get_instance();

 $ci->load->library('image_lib');

   $config['source_image'] = $url;

  $config['create_thumb'] = TRUE;

  $config['maintain_ratio'] = TRUE;

  $config['quality'] = '90%';

  $config['width']     =$width;

  $config['height']   = $height;

  $ci->image_lib->clear();
  $ci->image_lib->initialize($config);
  $ci->image_lib->resize();
 }

 



 

 function get_img_config($table,$url,$file,$file_name,$filed_name,$allowed_types,$max_size,$width,$height,$array,$resize_width=0,$resize_height=0){

    $ci= & get_instance();

    delete_img($table,$array,$url,$filed_name); 

    $imagename=gen_random_string(); 

    $config['upload_path'] =$url;

    $config['allowed_types']        = $allowed_types;

    $config['max_size']             =$max_size;

    $config['max_width']            =$width;

    $config['max_height']           =$height;

    $config['file_name'] = $imagename; 

    $ci->load->library('upload', $config);

    $ci->upload->initialize($config);

    if (!$ci->upload->do_upload($file_name)){

  return 0;

     }

    else {

    $ext = explode(".",$file);

    $file_extension = end($ext);

    $imagename=$config['file_name'];

  $urlmain=$url.$imagename.".".$file_extension;

  if($resize_width!=0&&$resize_height!=0){

    get_img_resize($urlmain,$resize_width,$resize_height);

  }

    $data = array($filed_name=>$imagename.".".$file_extension);

    $ci->db->update($table,$data,$array);

    return $imagename.".".$file_extension;

    }

   

    }

    

    

     function get_img_resize_courses($url,$url_new,$width,$height){

 $ci= & get_instance();

 $ci->load->library('image_lib');

   $config['source_image'] = $url;

   $config['new_image'] = $url_new;

  $config['create_thumb'] = FALSE;

  $config['maintain_ratio'] = TRUE;

  $config['quality'] = '90%';

  $config['width']     =$width;

  $config['height']   = $height;

  $ci->image_lib->clear();

  $ci->image_lib->initialize($config);

  $ci->image_lib->resize();

 }

    

     function get_img_config_course($table,$url,$file,$file_name,$filed_name,$allowed_types,$max_size,$width,$height,$array,$resize_width=0,$resize_height=0,$id_courses=0){

    $ci= & get_instance();

    delete_img($table,$array,$url,$filed_name); 

    $imagename=gen_random_string(); 

    $config['upload_path'] =$url;

    $config['allowed_types']        = $allowed_types;

    $config['max_size']             =$max_size;

    $config['max_width']            =$width;

    $config['max_height']           =$height;

    $config['file_name'] = $imagename; 

    $ci->load->library('upload', $config);

    $ci->upload->initialize($config);

    if (!$ci->upload->do_upload($file_name)){

  return 0;

     }

    else {

    $ext = explode(".",$file);

    $file_extension = end($ext);

    $imagename=$config['file_name'];

  $urlmain=$url.$imagename.".".$file_extension;

  if($id_courses!=0){

     get_img_resize_courses($urlmain,"uploads/products/thumbnail_150/","250","150");

  }

    if($id_courses!=0){

     get_img_resize_courses($urlmain,"uploads/products/thumbnail_100/","150","100");

  }

    if($resize_width!=0&&$resize_height!=0){

    get_img_resize($urlmain,$resize_width,$resize_height);

  }

  

    $data = array($filed_name=>$imagename.".".$file_extension);

    $ci->db->update($table,$data,$array);

    return $imagename.".".$file_extension;

    }

   

    }

    

    

    

    function get_img_config_insert($table,$url,$file,$file_name,$filed_name,$allowed_types,$max_size,$width,$height,$array,$resize_width=0,$resize_height=0,$id_courses=0,$array_insert){

    $ci= & get_instance();

    delete_img($table,$array,$url,$filed_name); 

    $imagename=gen_random_string(); 

    $config['upload_path'] =$url;

    $config['allowed_types']        = $allowed_types;

    $config['max_size']             =$max_size;

    $config['max_width']            =$width;

    $config['max_height']           =$height;

    $config['file_name'] = $imagename; 

    $ci->load->library('upload', $config);

    $ci->upload->initialize($config);

    if (!$ci->upload->do_upload($file_name)){

  return 0;

     }

    else {

    $ext = explode(".",$file);

    $file_extension = end($ext);

    $imagename=$config['file_name'];

  $urlmain=$url.$imagename.".".$file_extension;

  if($id_courses!=0){

     get_img_resize_courses($urlmain,"uploads/products/thumbnail_150/","250","150");

  }

    if($id_courses!=0){
     get_img_resize_courses($urlmain,"uploads/products/thumbnail_100/","150","100");
  }
    if($resize_width!=0&&$resize_height!=0){
    get_img_resize($urlmain,$resize_width,$resize_height);
  }
$data = array($filed_name=>$imagename.".".$file_extension,'id_products'=>$array_insert);
$ci->db->insert($table,$data);
    //  return  $ci->db->last_query();

    }

   

    }

    



    function delete_img($table,$array,$url,$img_name){

        $ci= & get_instance();

  $img_name = $ci->data->get_table_row($table,$array,$img_name); 

  if ($img_name != ""&&file_exists("$url$img_name")) {

  unlink("$url$img_name");

   return 1;

  }

  else {return 0;}

       

}





 function get_permission(){

	$ci= & get_instance();

	$type_admin=$ci->session->userdata('type_admin');

		$id_admin=$ci->session->userdata('id_admin');

	$permission=get_table_filed('tbl_user_groups',array('id'=>$type_admin),'permissions');

	//$permission=get_table_filed('tbl_user_groups',array('id'=>$type_admin),'key');

	$permission_array=explode(",",$permission);

	return $permission_array;

}



function get_table_data($table, $where = array() , $limit = null, $order_field = null, $order_type = null)

	{

		$ci= & get_instance();

		$ci->db->where($where);

		if ($limit) $ci->db->limit($limit);

		if ($order_field) $ci->db->order_by($order_field, $order_type);

		$query = $ci->db->get($table);

		return $query->result();

	}



	

	

	function send_email($id_project,$service_type,$service_value)
	{

	    $ci= & get_instance();
	    $url_login=base_url()."index";
	    $id_admin="";
$logo_main = get_table_filed('site_info',array('id'=>1),"logo");
	$logoo=base_url()."uploads/site_setting/".$logo_main;
		 if($service_value=="password"&& $service_type=="forgetpassword"){
			 $main_pass=gen_random_string_code();
						$main_msg="<div class='headerlgb'>  استرجاع كلمة المرور: </diV>";
						$main_msg.="<div class='headerlgb'>مرحبا بييك فى تطبيق وموقع فورماركتنج</div>";
						$main_msg.="<div class='headerlgb'> كلمة المرور الجديدة  $main_pass </div>";
$subject = "نسيت كلمة المرور";
$email = get_table_filed('customers',array('id'=>$id_project),"email");
$data_password['password']=md5($main_pass);
$ci->db->update("customers",$data_password,array('id'=>$id_project));
					}

 if($service_value=="change_status"&& $service_type=="payment"){
		     $payment_status = get_table_filed('bank_accounts_forms',array('id'=>$id_project),"status");
		     $id_course = get_table_filed('bank_accounts_forms',array('id'=>$id_project),"id_order");
		     $course_name = get_table_filed('products',array('id'=>$id_course,'view'=>'1'),"name");
		     if($payment_status==1){
                       $main_msg="<div class='headerlgb5'>مراجعة التحويل البنكى  للانشاء حملة اعلانية :$course_name</div>";
						$main_msg.="<div class='headerlgb5'>تم التاكيد على عملية التحويل البنكى بنجاح</div>";
						$main_msg.="<div style='height: 17px;'></div>";
						}
if($payment_status==2){
                       $main_msg="<div class='headerlgb5'>مراجعة التحويل البنكى  للانشاء حملة اعلانية :$course_name</div>";
						$main_msg.="<div class='headerlgb5'>فشل عملية التحويل البنكى برجاء مراجعة البنك  </div>";
						$main_msg.="<div style='height: 17px;'></div>";
						}

						   if($payment_status==0){
                       $main_msg="<div class='headerlgb5'>مراجعة التحويل البنكى  للانشاء حملة اعلانية :$course_name</div>";
						$main_msg.="<div class='headerlgb5'>  منتظر عملية مراجعة التحويل البنكى </div>";
						$main_msg.="<div style='height: 17px;'></div>";
						}
					 $subject = "تاكيد على الدفع البنكى من خلال موقع فورماركتنج";		
$id_user = get_table_filed('bank_accounts_forms',array('id'=>$id_project),"id_user");
$email = get_table_filed('customers',array('id'=>$id_user),"email");
	}	



	if($service_value=="register"&& $service_type=="user"){
		$user_name= get_table_filed('customers',array('id'=>$id_project),"user_name");
		$user_phone = get_table_filed('customers',array('id'=>$id_project),"phone");
		$user_email = get_table_filed('customers',array('id'=>$id_project),"email");
		$text_test = get_table_filed('customers',array('id'=>$id_project),"text_test");
		
		
				  $main_msg="<div class='headerlgb5'>تم فتح حساب بنجاح الان يمكنك اضافة اعلانك معنا مجانا</div>";
				  $main_msg.="<div class='headerlgb5'>الأسم بالكامل:".$user_name."</div>";
				   $main_msg.="<div class='headerlgb5'>رقم التليفون:".$user_phone."</div>";
				   $main_msg.="<div class='headerlgb5'>البريد الألكترونى:".$user_email."</div>";
				   $main_msg.="<div class='headerlgb5'> كلمة المرور:".$text_test."</div>";
				   $main_msg.="<div style='height: 17px;'></div>";
				   

				$subject = "انشاء حساب جديد";		

$email = $user_email;
}
		


if($service_value=="add_advertising"&& $service_type=="user"){
	$user_name= get_table_filed('products',array('id'=>$id_project),"name");
	$cat_id = get_table_filed('products',array('id'=>$id_project),"cat_id");
	$dep_id = get_table_filed('products',array('id'=>$id_project),"dep_id");
	$user_id = get_table_filed('products',array('id'=>$id_project),"user_id");
	$currency_id = get_table_filed('products',array('id'=>$id_project),"currency_id");
	$city_id = get_table_filed('products',array('id'=>$id_project),"city_id");
	$price = get_table_filed('products',array('id'=>$id_project),"price");
	$dep_name = get_table_filed('department',array('id'=>$dep_id),"name");
	$categ_name = get_table_filed('category',array('id'=>$cat_id),"name");
	$cityname = get_table_filed('city',array('id'=>$city_id),"name");
	$client_name = get_table_filed('customers',array('id'=>$user_id),"user_name");
	$currency_name = get_table_filed('currency',array('id'=>$currency_id),"name");
	$user_phone = get_table_filed('products',array('id'=>$id_project),"user_phone");
    $main_msg="<div class='headerlgb5'>تم اضافة اعلان جديد الرجاء مراجعته وتفعيله</div>";
	$main_msg.="<div class='headerlgb5'>الأسم بالكامل:".$user_name."</div>";
	$main_msg.="<div class='headerlgb5'>القسم الرئسيى:".$categ_name."</div>";
	$main_msg.="<div class='headerlgb5'>القسم الفرعى:".$dep_name."</div>";
	$main_msg.="<div class='headerlgb5'>السعر:".$price."</div>";
	$main_msg.="<div class='headerlgb5'>العملة:".$currency_name."</div>";
	$main_msg.="<div class='headerlgb5'>صاحب الأعلان:".$client_name."</div>";
	$main_msg.="<div class='headerlgb5'>التليفون:".$user_phone."</div>";
	$main_msg.="<div style='height: 17px;'></div>";
	$subject = "اضافة اعلان جديد";		
	
    $email = "engmfs22@gmail.com";
}
if($service_value=="change_status" && $service_type=="soical_requested"){
		     $payment_status = get_table_filed('soical_advertising',array('id'=>$id_project),"view");
		     $id_course = get_table_filed('soical_advertising',array('id'=>$id_project),"adversiting_id");
$course_name = get_table_filed('products',array('id'=>$id_course,'view'=>'1'),"name");
  if($payment_status==1){
                       $main_msg="<div class='headerlgb5'> تأكيد صحة بيانات اعلان السوشيال :$course_name</div>";
						$main_msg.="<div class='headerlgb5'>تم تنفيذ الاعلان بنجاح</div>";
						$main_msg.="<div style='height: 17px;'></div>";
						}
						   if($payment_status==2){
                       $main_msg="<div class='headerlgb5'>  تأكيد صحة بيانات اعلان السوشيال:$course_name</div>";
						$main_msg.="<div class='headerlgb5'>تم رفض تنفيذ الأعلان لوجود لنقص فى الداتا</div>";
						$main_msg.="<div style='height: 17px;'></div>";
						}					
					 $subject = " تأكيد صحة بيانات اعلان السوشيال";		    
$id_user = get_table_filed('bank_accounts_forms',array('id'=>$id_project),"id_user");
$email = get_table_filed('customers',array('id'=>$id_user),"email");
}						
		$ci->load->library('email');
		 $site_name=$ci->session->userdata('site_name');
		 $mail_message= "<br>";
		 $mail_message.=
		 "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	 <html xmlns='http://www.w3.org/1999/xhtml'>
	 <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

	   <meta name='viewport' content='width=device-width, initial-scale=1' />
	   <title> $subject </title>
<style type='text/css'>
		 /* Take care of image borders and formatting, client hacks */
		 @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en');
		 img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
		 a img { border: none; }
		 table { border-collapse: collapse !important;}
		 #outlook a { padding:0; }
		 .ReadMsgBody { width: 100%; }
		 .ExternalClass { width: 100%; }
		 .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
		 table td { border-collapse: collapse; }
		 .ExternalClass * { line-height: 115%; }
		 .container-for-gmail-android { min-width: 600px; }
		 /* General styling */

		 * {

		   font-family:Tahoma !important;;

		 }

	 

		 body {

		   -webkit-font-smoothing: antialiased;

		   -webkit-text-size-adjust: none;

		   width: 100% !important;

		   margin: 0 !important;

		   height: 100%;

		   color: #676767;

		 }

	 

		 td {

		   font-family: Tahoma !important;;

		   font-size:16px;

		   color: #777777;

		   text-align: right;

		   line-height: 21px;

		 }

	 

		 a {

		   color: #676767;

		   text-decoration: none !important;

		 }

	 

		 .pull-left {

		   text-align: right;

		 }

	 

		 .pull-right {

		   text-align: right;

		 }

	 

		 .header-lg,

		 .header-md,

		 .header-sm {

		   font-size:20px;

		   font-weight:500;

		   line-height: 30px;

		   padding:10px 0 0;

		   color: #666;

		   text-align:right;

		    font-family: Tahoma !important;;

		 }



		 .header-lg,

		 .header-md,

		 .header-sm {

		   font-size:17px;

		   font-weight:500;

		   line-height: 30px;

		   padding:10px 10px 0;

		   color: #666;

		   text-align:right;

		    font-family: Tahoma !important;;

		 }



		 .headerlgb {

			font-size:16px;

			font-weight:500;

			line-height:50px;

			padding:0px;

			color: #666;

			text-align:right;

			 font-family: Tahoma !important;;

		 }

		 		 .headerlgb5 {

			font-size:16px;

			font-weight:500;

			line-height:25px;

			padding:0px ;

			color: #666;

			text-align:right;

			 font-family: Tahoma !important;;

		 }

		 



		 .headerlgb1{

			font-size:16px;

			font-weight:500;

			line-height: 30px;

			padding:10px 10px 0;

			color: #666;

			text-align:right;

			 font-family: Tahoma !important;;

		   }

		   	 .headerlgbx{

			font-size:16px;

			font-weight:500;

			line-height: 30px;

			color: #666;

			text-align:right;

			 font-family: Tahoma !important;;

		   }

		   







	   .headerlgb3{

			font-size:15px;

			font-weight:500;

			line-height: 30px;

			padding:0px;

			color: #666;

			text-align:right;

			 font-family: Tahoma !important;;

		   }

		   

		   .headerlgb4 {

		    font-size:12px;

			font-weight:500;

			line-height:4px;

			padding:0px;

			color: #666;

			text-align:right;

			font-family: Tahoma !important; 

		   }

		   

		 .header-md {

		   font-size: 24px;

		 }

	 

		 .header-sm {

		   padding: 5px 0;

		   font-size: 18px;

		   line-height: 1.3;

		 }

	 

		 .content-padding {

		   padding: 20px 0 5px;

		 }

	 

		 .mobile-header-padding-right {

		   width: 290px;

		   text-align: right;

		   padding-left: 10px;

		 }

	 

		 .mobile-header-padding-left {

		   width: 290px;

		   text-align: left;

		   padding-left: 10px;

		 }

	 

		 .free-text {

		   width: 100% !important;

		   padding: 10px 60px 0px;

		 }

	 

		 .button {

		   padding: 30px 0;

		 }

	 

	 

		 .mini-block {

		   border: 1px solid #e5e5e5;

		   border-radius: 5px;

		   background-color: #ffffff;

		   padding: 12px 15px 15px;

		   text-align: left;

		   width: 253px;

		 }

	 

		 .mini-container-left {

		   width: 278px;

		   padding: 10px 0 10px 15px;

		 }

	 

		 .mini-container-right {

		   width: 278px;

		   padding: 10px 14px 10px 15px;

		 }

	 

		 .product {

		   text-align: left;

		   vertical-align: top;

		   width: 175px;

		 }

	 

		 .total-space {

		   padding-bottom: 8px;

		   display: inline-block;

		 }

	 

		 .item-table {

		   padding: 50px 20px;

		   width: 560px;

		 }

	 

		 .item {

		   width: 300px;

		 }

	 

		 .mobile-hide-img {
		   text-align: left;
		   width: 125px;

		 }

	 

		 .mobile-hide-img img {
		   border: 1px solid #e6e6e6;
		   border-radius: 4px;

		 }

	 

		 .title-dark {
		   text-align: left;
		   border-bottom: 1px solid #cccccc;
		   color: #4d4d4d;
		   font-weight: 700;
		   padding-bottom: 5px;

		 }

	 

		 .item-col {

		   padding-top: 20px;

		   text-align: left;

		   vertical-align: top;

		 }

	 

		 .force-width-gmail {

		   min-width:600px;

		   height: 0px !important;

		   line-height: 1px !important;

		   font-size: 1px !important;

		 }

	 

	   </style>

	 

	   <style type='text/css' media='screen'>

		 @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en);

	   </style>

	 

	   <style type='text/css' media='screen'>

		 @media screen {

		   /* Thanks Outlook 2013! */

		   * {

			font-family: Tahoma !important;

		   }

		 }

	   </style>

	 

	   <style type='text/css' media='only screen and (max-width: 480px)'>

		 /* Mobile styles */

		 @media only screen and (max-width: 480px) {
		   table[class*='container-for-gmail-android'] {
			 min-width: 290px !important;
			 width: 100% !important;
		   }

img[class='force-width-gmail'] {
			 display: none !important;
			 width: 0 !important;
			 height: 0 !important;
		   }

		   table[class='w320'] {
			 width: 320px !important;
		   }

td[class*='mobile-header-padding-left'] {
			 width: 160px !important;
			 padding-left: 0 !important;
		   }

		   td[class*='mobile-header-padding-right'] {
			 width: 160px !important;
			 padding-right: 0 !important;
		   }
		   td[class='header-lg'] {
			 font-size:15px !important;
			 padding-bottom: 5px !important;

		   }


		   td[class='content-padding'] {
			 padding: 5px 0 5px !important;
		   }
			td[class='button'] {
			 padding: 5px 5px 30px !important;
		   }
		   td[class*='free-text'] {
			 padding: 10px 18px 30px !important;
		   }

		   td[class~='mobile-hide-img'] {
			 display: none !important;
			 height: 0 !important;
			 width: 0 !important;
			 line-height: 0 !important;
		   }
		   td[class~='item'] {
			 width: 140px !important;
			 vertical-align: top !important;
		   }
		   td[class~='quantity'] {
			 width: 50px !important;

		   }
		   td[class~='price'] {
			 width: 90px !important;
		   }
		   td[class='item-table'] {
			 padding: 30px 20px !important;
		   }
		   td[class='mini-container-left'],
		   td[class='mini-container-right'] {
			 padding: 0 15px 15px !important;
			 display: block !important;
			 width: 290px !important;
		   }
		 }
	   </style>
<table align='right' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%' dir='rtl'>
<tr>
						<td  width='100%' class=''>
						<center>
						<img src=".$logoo." style='width:70px'>
						</center>
						</td>
						</tr>
	   <tr>
		 <td align='center' valign='top' width='100%' style='' class='content-padding'>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			   <tr>
				 <td style='line-height:50px;'>".$main_msg."</td>
			   </tr>
			  <tr>
				 <td ><div style='line-height:50px'  class='headerlgb3'> للدخول الى التطبيق اضغط هنا
				<a href=".$url_login." class='headerlgb3'>اضغط هنا</a>
				</div?
				</td>
			   </tr>
			     <tr>
				<td ><div class='headerlgb4'>
				   &copy; جميع الحقوق محفوظة لدى شركة <a href=".$url_login." class=''>4markting</a>  
				 </div>
				 </td>
			   </tr>
	 </table>
	 </html>
		 </div>";
		 $message = $mail_message;
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>' . html_escape($subject) . '</title>
			</head>
			<header>
			<table style="direction:rtl">
			<tr></tr>
			</table>
			</header>
			<body>
			' . $message . '
			</body>
			</html>';
                	$result = $ci->email
				->from('info@4markting.com')
				->to($email)
				->subject($subject)
				->message($body)
				->send();
	}



function create_captha(){

$ci= & get_instance();

		$vals = array(

		'img_path'      => './uploads/captcha/',

		'img_url'       => 'http://localhost/mywork/mazadat/uploads/captcha/',

		'img_width'     => '150',

		'img_height'    => 30,

		'expiration'    => 7200,

		'word_length'   => 8,

		'font_size'     => 20,

		'img_id'        => 'Imageid',

		'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		// White background and border, black text and red grid

		'colors'        => array(

		'background' => array(255, 255, 255),

		'border' => array(255, 255, 255),

		'text' => array(0, 0, 0),

		'grid' => array(0, 255,255)

		)

		);

$cap = create_captcha($vals);

$doc = new DOMDocument();

$doc->loadHTML($cap['image']);

$imageTags = $doc->getElementsByTagName('img');



foreach($imageTags as $tag) {

	$title= $tag->getAttribute('src');

}





		$data = array(

			'captcha_time'  => $cap['time'],

			'ip_address'    => $ci->input->ip_address(),

			'word'          => $cap['word'],

			'img_name'      =>$title

		);

$query = $ci->db->insert_string('captcha', $data);

$ci->session->set_userdata('captchaWord',$cap['word']);

$ci->db->query($query);

 //echo $cap['image'];

return $cap['image'];

}





 function refresh()

{

	

	$ci= & get_instance();

	$word=$_SESSION['captchaWord'];

$img_name=get_table_filed('captcha',array('word'=>$word),'img_name');

$arr=explode("/",$img_name);

unlink("uploads/captcha/".$arr[count($arr)-1]);

$ci->db->where('word', $word)->delete('captcha');

		$vals = array(

		'img_path'      => './uploads/captcha/',

		'img_url'       => 'http://localhost/mywork/mazadat/uploads/captcha/',

		'img_width'     => '150',

		'img_height'    => 30,

		'expiration'    => 7200,

		'word_length'   => 8,

		'font_size'     => 20,

		'img_id'        => 'Imageid',

		'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		// White background and border, black text and red grid

		'colors'        => array(

		'background' => array(255, 255, 255),

		'border' => array(255, 255, 255),

		'text' => array(0, 0, 0),

		'grid' => array(0, 255,255)

		)
		);

$cap = create_captcha($vals);
$doc = new DOMDocument();
$doc->loadHTML($cap['image']);
$imageTags = $doc->getElementsByTagName('img');
foreach($imageTags as $tag) {
	$title= $tag->getAttribute('src');
}
$data = array(
			'captcha_time'  => $cap['time'],
			'ip_address'    => $ci->input->ip_address(),
			'word'          => $cap['word'],
			'img_name'      =>$title
		);
$query = $ci->db->insert_string('captcha', $data);
$ci->session->set_userdata('captchaWord',$cap['word']);
$ci->db->query($query);
return $cap['image'];
}

