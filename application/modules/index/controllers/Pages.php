<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Pages extends MX_Controller {

    function __construct() {
		parent::__construct();
   $this->lang->load('main_lang', get_lang() );
        $this->db->order_by('id', 'DESC');
		$this->load->library('session');
		$this->load->library('pagination');
        if( isset($this->session->get_userdata('lang')['lang']) ){
        $lang = $this->session->get_userdata('lang')['lang'];
        }else{
        $lang = 'arabic';
        }
        $dir = ( $lang == 'arabic' )? 'left' : 'right' ;
		define( "LANGU" , $lang );
		$this->load->model('data','','true');
    }

public function lang_site( $lang = null ){
    $curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_sub =$_SESSION['curt'];
        if( $lang == 'ar' ){
            $newdata = array(
            'lang'  => 'arabic'
            );
            $this->session->set_userdata($newdata);
        }else{
            $newdata = array(
            'lang'  => 'english'
            );
            $this->session->set_userdata($newdata);
		}
redirect(DIR."site/".$controller_curt."/".$curt_sub);
    }


function about() {

		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['lang'] =$lang; 
		
		$data_contant['lang'] =$lang; 
	$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('about',$data);
	$this->load->view('include/footer',$data);
	}


	function international() {

		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['lang'] =$lang; 
		
		$data_contant['lang'] =$lang; 
	$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('international',$data);
	$this->load->view('include/footer',$data);
	}

	
	function contact() {
		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['lang'] =$lang; 
		$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
		$data_contant['contact_info']=$this->db->get_where('contact_info')->result();
		$data_contant['main_slider']=$this->db->get_where('slider',array('view'=>'1'))->result();
		$data_contant['home_products']=$this->db->order_by('id','desc')->limit(12)->get_where('product',array('view'=>'1'))->result()
		; 
		$data_contant['lang'] =$lang; 
	$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('contact',$data_contant);
	$this->load->view('include/footer',$data);    
}

function regulations() {
	global $lang;
	if( isset($this->session->get_userdata('lang')['lang']) ){
		$lang = $this->session->get_userdata('lang')['lang'];
		}else{
		$lang = 'arabic';
		}
	$data['site_info'] =$this->db->get_where('site_info')->result(); 
	$data['lang'] =$lang; 
	$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
	$data_contant['regulations_txt']=$this->db->order_by('id','desc')->get_where('regulations_txt',array('view'=>'1'))->result(); 
	$data_contant['lang'] =$lang; 
$this->load->view('include/head',$data );
$this->load->view('include/insideheader',$data );
$this->load->view('regulations',$data_contant);
$this->load->view('include/footer',$data);    
}


public function regulations_action(){
	$comname=$this->input->post('comname');
	$phone=$this->input->post('phone');
	$name=$this->input->post('name');
	$email=$this->input->post('email');

	$data['name'] = $name;
	$data['name_org'] = $comname;
	$data['phone'] = $phone;
	$data['mail'] = $email;
	$main_email = $this->data->get_table_row('site_info',array('id'=>1),'message_email');
	$logo = $this->data->get_table_row('site_info',array('id'=>1),'logo');
$main_msg="اسم ممثل المنشأة $name  <br>";
$main_msg.="رقم الجوال".":".$phone."<br>";
$main_msg.="البريد الألكترونى".":".$email."<br>";
$main_msg.="اسم المنشاة".":".$comname."<br>";
$logo=DIR."uploads/site_setting/$logo"		;	

		 $subject = "نموذج للتواصل مع المنشاة";
		 $mail_message= "<br>";
		 $mail_message.=
		 "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	 <html xmlns='http://www.w3.org/1999/xhtml'>
	 <head>
	   <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	   <meta name='viewport' content='width=device-width, initial-scale=1' />
	   <title>مجموعة القصير والتركي للمحاماة</title>
	 
		   <style type='text/css'>
		 /* Take care of image borders and formatting, client hacks */
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
		   font-family: Helvetica, Arial, sans-serif;
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
		   font-family: Helvetica, Arial, sans-serif;
		   font-size: 14px;
		   color: #777777;
		   text-align: center;
		   line-height: 21px;
		 }
	 
		 a {
		   color: #676767;
		   text-decoration: none !important;
		 }
	 
		 .pull-left {
		   text-align: left;
		 }
	 
		 .pull-right {
		   text-align: right;
		 }
	 
		 .header-lg,
		 .header-md,
		 .header-sm {
		   font-size:18px;
		   font-weight:500;
		   line-height: normal;
		   padding:10px 0 0;
		   color: #666;
		   text-align:right;
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
		 }

		 .headerlgb {
			font-size:17px;
			font-weight:500;
			line-height: 30px;
			padding:10px 10px 0;
			color: #666;
			text-align:right;
		 }
		 
		 .headerlgb1{
			font-size:17px;
			font-weight:500;
			line-height: 30px;
			padding:10px 10px 0;
			color: #666;
			text-align:right;
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
		 @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
	   </style>
	 
	   <style type='text/css' media='screen'>
		 @media screen {
		   /* Thanks Outlook 2013! */
		   * {
			 font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
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
						<img src='".$logo."' style='width:200px;height:49px;'>
						</center>
						</td>
						</tr>
	  
		 
	   <tr>
		 <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			   <tr>
				 <td class='header-lg'>عزيزى
				 <span style='color: #ffad18;'> </span>تحية طيبة وبعد
				 </td>
			   </tr>
			   <tr>
				 <td class='headerlgb'>".$main_msg."

				</td>
			   </tr>
			   
				
	   <tr>
		 <td align='center' valign='top' width='100%'' style='background-color: #f7f7f7; height: 100px;'>
		   <center>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			   <tr>
				 <td style='padding:5px 0 25px' class='free-text headerlgb1'>
				   &copy; جميع الحقوق محفوظة لدى شركة <a href='https://wisyst.com/'>مجموعة القصير والتركي للمحاماة</a>  <br />
				  <br /><br />
				 </td>
			   </tr>
			 </table>
		   </center>
		 </td>
	   </tr>
	 </table>
	 </html>
		 </div>";
		 $message = $mail_message;
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
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

			$result = $this->email
		  ->from('info@alkosir.wisyst.info')
		  ->reply_to('info@alkosir.wisyst.info')    // Optional, an account where a human being reads.
		  ->to($main_email)
		  ->subject($subject)
		  ->message($body)
		  ->send();
		 // return $ci->email->print_debugger();





	$this->db->insert('regulations_from',$data);
	$this->session->set_flashdata('msg',lang('sendmessage_result'));
	$this->session->mark_as_flash('msg');
	redirect(base_url("site/pages/regulations"));
	}



	
	public function subscribe_action(){
$email=$this->input->post('email');
	$data['email'] = $email;
	
		
				
				$id_e = $this->data->get_table_row('news_letter',array('email'=>$email),'id');
				if($id_e==""){
$this->db->insert('news_letter',$data);

				echo 1;
				}
				else {
					echo 0;
				}

		}
	

public function contact_action(){
	$fname=$this->input->post('name');
	$email=$this->input->post('email');
	$phone=$this->input->post('phone');
	$subjectmain=$this->input->post('subject');
	$message=$this->input->post('message');

	$data['name'] = $fname;
	$data['mail'] = $email;
	$data['subject'] = $subjectmain;
	$data['phone'] = $phone;
	$data['message'] = $message;
	$main_email = $this->data->get_table_row('site_info',array('id'=>1),'message_email');
	$logo = $this->data->get_table_row('site_info',array('id'=>1),'logo');
$main_msg="الأسم $fname  <br>";
$main_msg.="رقم الجوال".":".$phone."<br>";
$main_msg.="البريد الألكترونى".":".$email."<br>";
$main_msg.="الموضوع".":".$subjectmain."<br>";
$main_msg.="الرسالة".":".$message."<br>";
$logo=DIR."uploads/site_setting/$logo"		;	

		 $subject = "رسالة جديدة من موقع مجموعة القصير والتركي للمحاماة";
		 $mail_message= "<br>";
		 $mail_message.=
		 "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	 <html xmlns='http://www.w3.org/1999/xhtml'>
	 <head>
	   <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	   <meta name='viewport' content='width=device-width, initial-scale=1' />
	   <title>مجموعة القصير والتركي للمحاماة</title>
	 
		   <style type='text/css'>
		 /* Take care of image borders and formatting, client hacks */
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
		   font-family: Helvetica, Arial, sans-serif;
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
		   font-family: Helvetica, Arial, sans-serif;
		   font-size: 14px;
		   color: #777777;
		   text-align: center;
		   line-height: 21px;
		 }
	 
		 a {
		   color: #676767;
		   text-decoration: none !important;
		 }
	 
		 .pull-left {
		   text-align: left;
		 }
	 
		 .pull-right {
		   text-align: right;
		 }
	 
		 .header-lg,
		 .header-md,
		 .header-sm {
		   font-size:18px;
		   font-weight:500;
		   line-height: normal;
		   padding:10px 0 0;
		   color: #666;
		   text-align:right;
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
		 }

		 .headerlgb {
			font-size:17px;
			font-weight:500;
			line-height: 30px;
			padding:10px 10px 0;
			color: #666;
			text-align:right;
		 }
		 
		 .headerlgb1{
			font-size:17px;
			font-weight:500;
			line-height: 30px;
			padding:10px 10px 0;
			color: #666;
			text-align:right;
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
		 @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
	   </style>
	 
	   <style type='text/css' media='screen'>
		 @media screen {
		   /* Thanks Outlook 2013! */
		   * {
			 font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
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
						<img src='".$logo."' style='width:200px;height:49px;'>
						</center>
						</td>
						</tr>
	  
		 
	   <tr>
		 <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			   <tr>
				 <td class='header-lg'>عزيزى
				 <span style='color: #ffad18;'> </span>تحية طيبة وبعد
				 </td>
			   </tr>
			   <tr>
				 <td class='headerlgb'>".$main_msg."

				</td>
			   </tr>
			   
				
	   <tr>
		 <td align='center' valign='top' width='100%'' style='background-color: #f7f7f7; height: 100px;'>
		   <center>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			   <tr>
				 <td style='padding:5px 0 25px' class='free-text headerlgb1'>
				   &copy; جميع الحقوق محفوظة لدى شركة <a href='https://wisyst.com/'>مجموعة القصير والتركي للمحاماة</a>  <br />
				  <br /><br />
				 </td>
			   </tr>
			 </table>
		   </center>
		 </td>
	   </tr>
	 </table>
	 </html>
		 </div>";
		 $message = $mail_message;
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
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

			$result = $this->email
		  ->from('info@alkosir.wisyst.info')
		  ->reply_to('info@alkosir.wisyst.info')    // Optional, an account where a human being reads.
		  ->to($main_email)
		  ->subject($subject)
		  ->message($body)
		  ->send();
		 // return $ci->email->print_debugger();





	$this->db->insert('messages',$data);
	$this->session->set_flashdata('msg',lang('sendmessage_result'));
	$this->session->mark_as_flash('msg');
	redirect(base_url("site/pages/contact"));
	}
	   
	
	function highlights() {

		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['achievements_text'] =$this->db->get_where('achievements_text',array('view'=>'1'))->result(); 
		$data['lang'] =$lang; 

		$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('highlights',$data);
	$this->load->view('include/footer',$data);
	}
	
	
	
	function profiles() {
		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
        $tables = "profiles_files";
        $config['base_url'] = base_url().'site/pages/profiles'; 
        $config['total_rows'] = $this->data->record_count($tables,array('view'=>'1'),'','id','asc');
        $config['per_page'] =20;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';   
        $config['last_link'] = '»»';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '««';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
       // $config['suffix'] = '?' . http_build_query($_GET, '', "&");
       // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
        $page = ($this->uri->segment(4)) ;
        }
        else{
        $page =0;
        }
        $rs = $this->db->get($tables);
        if($rs->num_rows() == 0):
        $data["results"] = array();
        $data["links"] = array();
		$datahead['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['siteinfo']=$this->db->get_where('site_info')->result();
		$datahead['lang'] =$lang; 
		$data['lang'] =$lang;
		$data['result_amount'] =$this->db->get_where('profiles_files',array('view'=>'1'))->result(); 
        else:
        $data["results"] = $this->data->view_all_data($tables, array('view'=>'1'), $config["per_page"], $page,'id','asc');
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links);
		$datahead['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['siteinfo']=$this->db->get_where('site_info')->result();
		$datahead['lang'] =$lang; 
		$data['lang'] =$lang;
		$data['result_amount'] =$this->db->get_where('profiles_files',array('view'=>'1'))->result(); 
		endif;
		

		$this->load->view('include/head',$datahead);
		$this->load->view('include/insideheader',$datahead);
		$this->load->view('profiles',$data);
		$this->load->view('include/footer',$datahead);
    }
		
	
	
	
	
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */
