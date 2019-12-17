<style>.wrapper {background-color:#f7f7fc} iframe{height:330px}</style>
		<?php 
	foreach($site_info as $siteinfo)
	foreach($customers as $data_info)
	$cat_id=$data_info->cat_id;
	$cat_name= get_table_filed('category',array('id'=>$cat_id),'name');

	$myimg=$this->session->userdata("myimg");
									if($myimg==""){$main_img="no_img.png";}
									else {$main_img=$myimg;}
						?>

<section class="page-title-bg pt-130 pb-30" >
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


<?php 
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

	

	</div>
	</div>



<div class="row">
<!--<div class="col-lg-3" style="background:#fff;text-align: right;border-radius: 0.4em;height:130px;margin:50px 0px 30px 0px">
<div class="row" style="margin:0px;">
<div class="col-lg-12 main_previw" style="padding-top:10px; color:#367cff">
<a href="<?=base_url()?>user/profile/myaccount" style="color:#367cff">
	الطلبات الحالية <span style="float:left"><i class="fa fa-chevron-left"></i></span>
	</a>
</div>
<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>
<div class="col-lg-12 main_previw" style=""><a href="<?=base_url()?>user/profile/changepassword">
     الطلبات المنتهية
</a>
</div>

<div class="col-lg-12"><hr style="width:100%;margin:5px 0px 5px 0px"></div>

</div>
</div>-->


<div class="col-md-12">
<div class="row" style="margin:0px">

<div class="col-lg-12 main_previw" style="text-align:center">
<div class="row" style="margin:50px 0px 30px 0px;">

<?php 
if(count($result_count)==0){
?>

<div class="col-lg-12" style="text-align:center;padding:50px 0px 10px 0px;background:#fff;"> 
<img src="<?= DIR_DES_STYLE ?>site_setting/no_request.png
">
</div>
<div class="col-lg-12" style="text-align:center;padding:20px 0px 50px 0px"> 
<p class="main_previw" style="text-align:center"> لا يوجد طالبات حاليا   </p>
 </div>
<?php } else {?>

	<?php
foreach($results as $bag){
    
    $type=$bag->type;
                 $id_course=$bag->id_course;
                $request_code=$bag->request_code;
                $type_payment=$bag->type_payment;
                $status=$bag->status;
                $creation_date=$bag->creation_date;
                
                $view=$bag->view;
                if($type==2){
  $course_name=get_table_filed('bag_info',array('id'=>$id_course,'view'=>'1'),"bage_name");                   
	$course_img=get_table_filed('bag_info',array('id'=>$id_course),"img");   
	$total_rate=get_table_filed('bag_info',array('id'=>$id_course),"total_rate");     
	
  
                }
                else {
 $course_name=get_table_filed('products',array('id'=>$id_course,'view'=>'1'),"name"); 
 $course_img=get_table_filed('products',array('id'=>$id_course),"img"); 
 $city_id_bage=get_table_filed('products',array('id'=>$id_course),"city_id");
 $total_rate=get_table_filed('products',array('id'=>$id_course),"total_rate");
$city =get_table_filed('city',array('id'=>$city_id_bage),"name");

 $Institute_name=get_table_filed('Institute',array('id_course'=>$id_course),"Institute_name");


                }
                if($type_payment==1){
                    $type_payment_final="حوالة بنكية"  ;
                }
                 if($type_payment==2){
                    $type_payment_final="طلب حقيبة"  ;
                }
                 if($type_payment==3){
                    $type_payment_final="باى بال"  ;
                }

                
?>
<div class="col-md-12" style="margin-bottom:20px;background:#fff;padding-top:15px">
    <div class="row" style="margin:0px">
    
        <div class="col-md-3" style="direction:ltr">تاريخ الطلب:  <?= date("Y-d-m",strtotime($creation_date))?></div>
        <div class="col-md-3">رقم الطلب :  <?= $request_code;?></div>
        <div class="col-md-3">طريقة الدفع : <?= $type_payment_final;?></div>
        <div class="col-md-3">الأجمالى : <?= $bag->final_price;?></div>
<div style="height:20px"></div>
<?php 
if($bag->view=='0'&&$bag->status=='0'){
?>
 <div class="col-md-12"><img src="<?=base_url()?>uploads/site_setting/payment_1.png" style="width:100%"></div>
 <?php } if($bag->view=='1'&&$bag->status=='0'){?>
  <div class="col-md-12"><img src="<?=base_url()?>uploads/site_setting/payment_2.png" style="width:100%"></div>

  <?php } if($bag->view=='1'&&$bag->status=='1'){?>
   <div class="col-md-12"><img src="<?=base_url()?>uploads/site_setting/payment_3.png" style="width:100%"></div>

  <?php }?>
 <div class="col-md-2 col-ms-6" style="text-align:right">       
<div class="img_info" >

<?php 
if($course_img!=""){
?>
<img src="<?=DIR_DES_STYLE?>products/thumbnail_100/<?=$course_img?>" style="height:100px !important;width:100px" class="img_bags">
<?php }else {?>
<img src="<?=DIR_DES_STYLE?>products/no_img.png" style="height:100px !important;width:100px" class="img_bags">
<?php }?>
</div>
</div>



 <div class="col-md-10 col-ms-6" style="text-align:right;">

<h3 style="font-size:14px;text-align:right;font-weight:600;padding-top:29px;color:#797979"><?= $course_name;?></h3>
<?php if($bag->type!=2){?>
<div class="row"  style="color:#797979;padding-top:15px">
<div class="col-md-4" style="font-weight:500;font-size:14px;text-align:right">
<i class="fa fa-map-marker" style="margin-left:5px;"></i><?= mb_substr($city,0,20);?></div>
<div class="col-md-5" style="font-size:14px;text-align:right;font-weight:500;">
<i class="fa fa-hotel" style="margin-left:5px"></i><?= mb_substr($Institute_name,0,20);?></div>
</div>
<?php }?>


<div class="row"  style="color:#3f3f3f;padding-top:15px;padding-bottom: 15px;">

<div class="col-md-12" style="font-size:12px;text-align:right">
<?php 

for($i=0; $i<5; $i++){
if($total_rate>$i){
//$total_rate--;
?>
<i class="fa fa-star rate_view " style="color:#fec355"></i>
<?php } else {?>
<i class="fa fa-star rate_view"></i>
<?php } }?>
</div>
</div>



</div>



</div>
    
   
<div style="height:40px"></div>


</div>


<?php  }?>
<div class="col-md-12 pagination justify-content-center" style="margin-bottom:20px;">						    
 <ul class="nav align-items-center" style="visibility: visible;margin:auto">
            <?php foreach($links as $link){?><?php echo $link;?><?php } ?>
</div>
                                            </ul>


<?php }?>

<div class="col-lg-12" style="text-align:center"> </div>
</div>





</div>
<div class="col-lg-12" style="height:60px"> </div>

</div>
</div>

</div>
</div>









<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="padding:0px">
      <div class="modal-header" style="text-align:center;display: block; border:0px;padding:0px">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align:right">
          <span aria-hidden="true">&times;</span>
        </button>
				<p class="main_previw" style="text-align:center">هل تريد حذف الحقيبة ؟</p>

     
      </div>
	  <div class="modal-body" style="padding:0px">

	  <div class="col-md-12">
<div class="row">
<div class="col-md-3"></div>
<input type="hidden" id="delete_bag">
<div class="col-md-3">
<button type="button" class=" searchbutton mainheader delete_bag" style="margin:10px 0px 10px 0px;border-radius:0.4em;background-color: #fe3642 !important;border:1px solid #fe3642;width:100%">
<span style="padding:0px"><span class="">نعم</span></span></button></div>

<div class="col-md-3">
<button type="button" data-dismiss="modal" aria-label="Close" class="searchbutton mainheader close"
 style="padding:1px;margin:10px 0px 10px 0px;border-radius:0.4em;background-color:#367dfe !important;width:100%">
<span style="padding:0px"><span class="">لا</span></span></button>
</div>

<div class="col-md-3"></div>
</div>
</div>




</div>
      
    </div>
  </div>
</div>
<!-------End Model----------------------->





</div>
</div>

	
