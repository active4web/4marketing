<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
						?>

<section class="page-title-bg pt-50 pb-30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center">
                        
                    </div>
                </div>
            </div>
        </div>
	</section>
	
		<div class="wrapper">
			<div class="container">
            <div style="    background-color: #f7f7fc;height:50px;"></div>

<?php
if(count($tickets)==0){
?>
<div class="row" style="    background-color: #fff;border:1px solid #ecebebde; border-radius:0.4em;">
<div class="col-lg-4" style="text-align:center"> </div>
<div class="col-lg-4" style="text-align:center"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/supporting.png">

<div class="col-md-12 ticket" style="text-align:center">
	<a href="#" class="mainheader stepsbutton" data-toggle="modal" data-target="#exampleModal"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-ticket-alt"></i> فتح تذكرة جديدة </span></a>
	</div>
            <div style="    background-color: #fff;height:50px;"></div>

 </div>
<div class="col-lg-4" style="text-align:center"> </div>
</div>


<?php } else {
	$myimg=$this->session->userdata("myimg");
	if($myimg==""){$main_img="no_img.png";}
	else {$main_img=$myimg;}
	?>
	<div class="col-lg-12 main_previw">
		<div class="row">
		<div class="col-md-6"><img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img">
		<p style="margin-top:30px;margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_name"),0,50);?></p>
		<p style="margin-bottom:0px;line-height:20px"><?= mb_substr($this->session->userdata("admin_email"),0,50);?></p>
	</div>

	<div class="col-md-6 ticket" style="">
	<a href="#" class="mainheader stepsbutton" data-toggle="modal" data-target="#exampleModal"><span style="padding:0px 15px 0px 15px"> <i class="fa fa-ticket-alt"></i> فتح تذكرة جديدة </span></a>
	</div>

	</div>
	</div>

	<div class="col-lg-12">
	<div class="row">
	<div class="col-lg-4 no_p scrollbar" id="style-7"  style="text-align: right;background-color: #fff;border: 1px solid #e7e7e8;border-radius: 0.4em;">

	<div class="col-12 main_tick no_p" >
<div class="row" style="margin:0px;padding: 10px;">
<div class="col-lg-8 col-sm-8  main_previw" >جميع التذاكر</div>	
<div class="col-lg-4 col-sm-4 main_previw"  style="text-align: center;    background-color: #cedcf7 !important;
    border-radius: 0.4em;color: #367dff !important;border: 1px solid;font-size: 18px;m">الحالة</div>	
</div>

</div>

<?php 
$tab_id="";

 $tab_id=$this->uri->segment(4);
 $count=0;
foreach($tickets as $tickets){
	$count++;
	$ticket_type_id=$tickets->ticket_type_id;
	$color=get_table_filed('tickets_types',array('id'=>$ticket_type_id),"color");
	$name=get_table_filed('tickets_types',array('id'=>$ticket_type_id),"name");
	$bg_c="";
	if($tab_id==$tickets->id){$bg_c="#eff5ff";}
	 if($count==1&&$tab_id==""){$bg_c="#eff5ff";}

?>
<div class="col-12 main_tick no_p" >
<a href="<?= DIR?>user/home/supporting/<?= $tickets->id;?>">
<div class="row" style="margin:0px;background:<?=$bg_c?>;padding: 10px;">
<div class="col-lg-8 col-sm-8  main_previw" ><?= mb_substr($tickets->title,0,20);?></div>	
<div class="col-lg-4 col-sm-4 main_previw"  style="text-align: center;"><?= mb_substr($tickets->created_at,0,20);?></div>	
</div>
<div class="row" style="margin:0px;background:<?=$bg_c?>;padding: 10px;">
<div class="col-lg-8 col-sm-8 main_previw"><?= mb_substr($tickets->content,0,20);?></div>	
<div class="col-lg-4 col-sm-4 main_previw"  style="text-align: center;background-color: <?=$color?>;color:#fff;border-radius:0.4em"><?= mb_substr($name,0,20);?></div>	
</div>
</a>
</div>
<hr style="width:100%;margin:0px">

<?php }?>
</div>
			
<div class="col-lg-8"  style="">
<?php
foreach($details_tickets as $details_tickets)

$update['status_id'] =1;
$update['updated_at'] = date('Y-m-d');
$this->db->update('tickets',$update,['id'=>$details_tickets->id]);
?>
<div class="row" style="background-color:#fff;margin:0px;padding:15px;border-top:1px solid #ecebebde;border-left:1px solid #ecebebde;border-right:1px solid #ecebebde;    border-top-left-radius: 0.4em;border-top-right-radius: 0.4em;">
<div class="col-lg-10 main_previw"  style="font-size:14px;font-weight:500;color:#000"><?= $details_tickets->title;?></div>	
<div class="col-lg-2 main_previw"  style="text-align:left"><?= $details_tickets->created_at;?></div>	
</div>

<div class="row" style="background-color:#fff;margin:0px;    width: 100%;border-bottom:1px solid #ecebebde;border-left:1px solid #ecebebde;border-right:1px solid #ecebebde;    border-bottom-left-radius: 0.4em;border-bottom-right-radius: 0.4em">
<div class="col-lg-12 main_previw" style="padding:0px">
<img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img" style="width:70px;height:60px;padding-left: 5px;border: 4px solid #f7f7fc;">
<p style="margin-top:30px;margin-bottom:0px;line-height:4px;padding-left: 30px;">
<span ><?= substr($this->session->userdata("admin_name"),0,50);?></span>
<span style="float:left"> 
<?= $details_tickets->created_at;?>&nbsp<?= date("h:i",strtotime($details_tickets->time));?></span>
</p>
</div>	

<div class="col-lg-12 main_previw" ><?= $details_tickets->content;?></div>	
<hr style="width:100%;margin:0px">
<?php
$tickets_reply=$this->db->get_where("tickets_replies",array("ticket_id"=>$details_tickets->id))->result();
if(count($tickets_reply)>0){
	foreach($tickets_reply as $tickreply){
?>

<div class="row" style="background-color:#fff;margin:0px;    width: 100%;">
	<?php
	if($tickreply->reply_type==1){
	?>
<div class="col-lg-12 main_previw" style="padding:0px">
<img src="<?= DIR_DES_STYLE; ?>customers/<?=$main_img?>" class="profile_img" style="width:70px;height:60px;padding-left: 5px;border: 4px solid #f7f7fc;">

<p style="margin-top:30px;margin-bottom:0px;line-height:4px;    padding-left: 30px;">
<span ><?= substr($this->session->userdata("admin_name"),0,50);?></span>
<span style="float:left"> 
<?= $tickreply->created_at;?>&nbsp<?= date("h:i",strtotime($tickreply->time));?></span>
</p>

</div>	
	<?php } else {?>
<div class="col-lg-12 main_previw" style="padding:0px">
<img src="<?= DIR_DES_STYLE; ?>site_setting/tec_sup.png" class="profile_img" style="width:70px;height:60px;padding-left: 5px;border: 4px solid #f7f7fc;">
<p style="margin-top:30px;margin-bottom:0px;line-height:4px;    padding-left: 30px;">
<span >الدعم الفنى</span>
<span style="float:left"> 
<?= $tickreply->created_at;?>&nbsp<?= date("h:i",strtotime($tickreply->time));?></span>
</p>
</div>	

	<?php }?>

<div class="col-lg-12 main_previw" ><?= $tickreply->content;?></div>	
</div>
<hr style="width:100%;margin:0px">
	<?php } }?>

<form method="POST" action="#" class="col-12 contact-form form" id="form">
<div class="row">
<input type="hidden"  name="ticket" value="<?= $details_tickets->id;?>">
<div class="col-md-8">
<textarea name="message" style="width:100%;height:70px;" id="message" class="theme-input-style main_input" placeholder="اكتب رسالتك"></textarea>
</div>
<div class="col-md-4 col-sm-6">
<button type="button" class="btn searchbutton mainheader reply_tickect" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><i class="fab fa-telegram-plane" style="background: transparent;float:right;    line-height: 45px;padding-right: 6px; font-size: 25px;"></i><span class="button_right"> ارسال الأن</span></span></button>
</div></div></form>











</div>



</div></div>

<?php }?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center;display: block; border:0px">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align:right">
          <span aria-hidden="true">&times;</span>
        </button>
	  <div class="page-title text-center">
                        <h2>فتح تذكرة جديدة</h2>
                        
                    </div>
     
      </div>
      <div class="modal-body">
	  <?php
		$user_type=$this->session->userdata("user_type");	
		$customer_id=$this->session->userdata("customer_id");

?>
<form method="POST" action="#" class="col-12 contact-form form" id="new_form">
<div class="row">
<input type="hidden"  name="customer_id" value="<?= $customer_id;?>">
<input type="hidden"  name="user_type" value="<?= $user_type;?>">
<input type="hidden"  name="tickets_types" value="1" id="tickets_types">
<div class="col-md-12">
<input class="theme-input-style input" type="text" placeholder="عنوان التذكرة" name="name" required="">
</div>
<div class="col-md-12">
<p class="main_previw">تحديد نوع التذكرة</p>
<div class="row">
<?php
foreach($tickets_types as $tickets_types){
?>
<div class="col-md-3 col-sm-4 ticket_tp"  style="cursor: pointer;margin-bottom:20px;background:<?= $tickets_types->color;?>;text-align:center;line-height:30px;margin-right:10px;color:#fff"><?= $tickets_types->name;?></div>
<input type="hidden"  class="div_txt" value="<?= $tickets_types->id;?>">
<?php }?>
</div>
</div>

<div class="col-md-12">
<textarea name="message" style="width:100%;height:100px;" id="message_new" class="theme-input-style main_input" placeholder="اكتب رسالتك"></textarea>
</div>
<div class="col-md-6 col-sm-6">
<button type="button" class="btn searchbutton mainheader new_tickect" style="border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><i class="fab fa-telegram-plane" style="background: transparent;float:right;    line-height: 45px;padding-right: 6px; font-size: 25px;"></i><span class="button_right"> ارسال الأن</span></span></button>
</div></div></form>

      </div>
      
    </div>
  </div>
</div>
<!-------End Model----------------------->

</div>
</div>

	
