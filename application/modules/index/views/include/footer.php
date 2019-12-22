<div style="    background-color: #f7f7fc;height: 50px;"></div>
<footer>
<?php foreach($site_info as $siteinfo)?>
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
          <div class="footer-content">
            <div class="email"> <i class="fa fa-envelope"></i>
              <p><?= $siteinfo->email;?></p>
            </div>
            <div class="phone"> <i class="fa fa-phone"></i>
              <p><?= $siteinfo->phone;?></p>
            </div>

            <div class="address"> <i class="fa fa-map-marker"></i>
              <p><?= $siteinfo->address;?></p>
            </div>
            <div class="social">
              <ul class="inline-mode">
                <li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="<?= $siteinfo->facebook;?>"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="<?= $siteinfo->google_pluse;?>"><i class="fa fa-google-plus"></i></a>
                </li>
                <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="<?= $siteinfo->twitter;?>"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="<?= $siteinfo->instagram;?>"><i class="fa fa-instagram"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-xs-12 col-lg-4 collapsed-block">
          <div class="footer-links">
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
              <?php
              foreach($cat as $cat){
              ?>
                <li><a href="<?=base_url()?>cat?ID=<?= base64_encode($cat->id);?>"> <?= $cat->name?> </a>
                </li>
              <?php }?>
                
              </ul>
            </div>
          </div>
        </div>
        
<div class="col-sm-12 col-md-2 col-xs-12 col-lg-2">
 
  <div class="footer-links">
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
              <?php
              foreach($pages as $pages){
              ?>
                <li class="link_important"><a href="<?= base_url()?>pages/<?= $pages->id?>" ><?= $pages->title?></a>
                </li>
              <?php }?>                
              </ul>
            </div>
          </div>   
    
</div>        
        
        
        <div class="col-sm-12 col-md-3 col-xs-12 col-lg-3">
             <div class="footer-logo">
            <a href="<?= base_url()?>"><img src="<?= DIR_DES_STYLE?>site_setting/<?= $siteinfo->logo;?>" alt="footer logo">
            </a>
            <div class="icon_app"  style="margin-top:20px">
               <a href="<?= $siteinfo->app_android;?>"> <img src="<?= DIR_DES_STYLE?>site_setting/android_store.png" alt=""></a>            
               <a href="<?= $siteinfo->app_ios;?>"><img src="<?= DIR_DES_STYLE?>site_setting/apple_store.png" alt=""></a>            
           </div>
          </div>
         
        </div>
      </div>
    </div>
   
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12 coppyright"> &copy; جميع الحقوق محفوظة <a href="#"> فورماركتنج </a>| 2019 </div>
          <div class="col-sm-6 col-xs-12">
            <div class="powered">
              <p>تصميم و برمجة شركة <a href="http://active4web.com/"> اكتف فور ويب </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="#" class="totop"> </a> 
  

<script type="text/javascript" src="<?= DIR_DES?>js/jquery.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.meanmenu.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery-ui.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/countdown.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/wow.min.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/main.js"></script> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.nivo.slider.js"></script> 
<!-- flexslider js --> 
<script type="text/javascript" src="<?= DIR_DES?>js/jquery.flexslider.js"></script>
<script src="<?= DIR ?>assets/toastr/toastr.min.js"></script>

<link href="<?= DIR ?>assets/toastr/toastr.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php 
	if(isset($_SESSION['msg']) && $_SESSION['msg']!=''&& $this->uri->segment(2)=="contact"){?>
<script>
$(document).ready(function(e) {
	toastr.info("<?=$_SESSION['msg'];?>",  {timeOut: 5000})
});
</script>
<?php } ?>

<script>
jQuery(document).ready(function(e) {
  $('#show_password').click(function(){
    if($(this).prop("checked") == true){
      $("#password").prop('type','text');
            }
            else {
              $("#password").prop('type','password');     
            }
    });       
});
</script>


<script>
$(document).ready(function(){
$(".login").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
    var password=$("#password").val();
     var username=$("#username").val();
if(username==""){
 $(".error_user").fadeIn();
 $("#username").css("border","1px solid #ff0000");
}
if(username==""){
  $(".error_password").fadeIn();
  $("#password").css("border","1px solid #ff0000");
}

//alert(data);

if(password!=""&&username!=""){
$.ajax({
        type:"POST",
        url:"<?php echo base_url()?>pages/login_action",
        data:data,
        success: function(response){
        if(response == 1){
           location.assign("<?php echo base_url()?>account");
             }
        
        else if(response == 2){
          $(".error_login").fadeIn();
          $(".error_password").fadeOut();
          $(".error_user").fadeOut();
        }
        else if(response == 3){
          $(".account_no_active").fadeIn();
 $(".error_password").fadeOut();
  $(".error_user").fadeOut();
  } 
        }
    });
}
});
});
</script>




<!-----Register AJAX------------>
<script>
$(document).ready(function(){
$(".register").click(function(){
 $(".register").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
    var fullname=$("#fullname").val();
    var phone=$("#phone").val();
    var email=$("#email").val();
    var slug=$("#slug").val();
    var module_email=$("#module").val();
     var password=$("#password").val();
     var city=$("#city").val();
     $(".error_phone_find").fadeOut();
     $(".error_email_find").fadeOut();
if(fullname==""){
 $(".error_fullname").fadeIn();
 $("#fullname").css("border","1px solid #ff0000");
 $(".register").attr("disabled",false);
}
else {
  $(".error_fullname").fadeOut();
 $("#fullname").css("border","1px solid"); 
}
if(phone==""){
  $(".error_phone").fadeIn();
  $("#phone").css("border","1px solid #ff0000");
  $(".register").attr("disabled", false);
}

else {
  $(".error_phone").fadeOut();
 $("#phone").css("border","1px solid"); 
}

if(email==""){
  $(".error_email").fadeIn();
  $("#email").css("border","1px solid #ff0000");
  $(".register").attr("disabled",false);
}

else {
  $(".error_email").fadeOut();
 $("#email").css("border","1px solid"); 
}

if(password==""){
  $(".error_password").fadeIn();
  $("#password").css("border","1px solid #ff0000");
  $(".register").attr("disabled",false);
}
else {
  $(".error_password").fadeOut();
 $("#password").css("border","1px solid"); 
}

if(city==""){
  $(".error_city").fadeIn();
  $("#city").css("border","1px solid #ff0000");
  $(".register").attr("disabled",false);
}
else {
  $(".error_city").fadeOut();
 $("#city").css("border","1px solid"); 
}
//alert(data);

if(fullname!=""&&email!=""&&phone!=""&&city!=""&&password!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>pages/register_action",
        data:data,
        success: function(response){
      
      if(response == 1){
           //toastr.info("تم انشاء حسابك بنجاح",  {timeOut:20})
           location.assign("<?php echo base_url()?>pages?register=true");
        }
        
    else if(response == 2){
          $(".error_phone_find").fadeIn();
          if(module_email==0){$(".error_email_find").fadeOut(); }
          else { $(".error_email_find").fadeIn();}
          $(".register").attr("disabled",false);
    }
        else if(response == 3){
          if(slug==0){$(".error_phone_find").fadeOut();}
          else {$(".error_email_find").fadeIn();}
          $(".error_email_find").fadeIn();
          $(".register").attr("disabled",false);
          } 

        }
    });
}
});
});
</script>



<script>
$(document).ready(function(){
$("#phone").keyup(function(){
 $(".register").attr("disabled", "disabled");
    var phone=$("#phone").val();
     $(".error_phone_find").fadeOut();
if(phone!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>pages/check_phone",
        data:{phone:phone},
        success: function(response){
      if(response == 1){
          $(".error_phone_find").fadeIn();
          $("#slug").val(1);
          $(".register").attr("disabled",false);
        }
        else if(response ==2){
          $("#slug").val(0);
          $(".error_phone_find").fadeOut();
          $(".register").attr("disabled",false);
          } 

        }
    });
}
});
});
</script>

<script>
$(document).ready(function(){
$("#email").keyup(function(){
 $(".register").attr("disabled", "disabled");
    var email=$("#email").val();
     $(".error_email_find").fadeOut();
if(email!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>pages/check_email",
        data:{email:email},
        success: function(response){
      if(response == 1){
        $("#module").val(1);
          $(".error_email_find").fadeIn();
          $(".register").attr("disabled",false);
        }
        else if(response ==2){
          $("#module").val(0);
          $(".error_email_find").fadeOut();
          $(".register").attr("disabled",false);
          } 

        }
    });
}
});
});
</script>

<script>
$(document).ready(function(){
$(".add-to-fav").click(function(){
var advertising_ID=$(this).next(".advertising_ID").val();
var device_id=$("#device_id").val();
if(device_id==0){
  location.assign("<?php echo base_url()?>pages");
}
else {
  //alert("sss");
var data={advertising_ID:advertising_ID}
var $t = $(this);
  $.ajax({
        type:"POST",
        url:"<?php echo base_url()?>account/fav_action",
        data:data,
        success: function(response){
        if(response == 1){
          toastr.info("تم اضافة الأعلان فى المفضلة",  {timeOut: 5000});
        $t.css({"color":"#e80f55"});
             }
        else {
          toastr.info("تم حذف الأعلان من المفضلة",  {timeOut: 5000});
          $t.css({"color":"#333","background":"#fff"});s
        }
        }
    });


}
});
});
  </script>


<script>

if (typeof(EventSource) !== 'undefined') {

var expired_advert = new EventSource('<?=DIR?>admin/notfiy/expired_advertising');
expired_advert.addEventListener('message', function(e) {
	}, false);
}

 else {
    alert('Your browser does not support Server-sent events! Please upgrade it!');
    console.error('Connection aborted');
}
</script>

<!--------------Start-Ticket Create----------------->
<script>
$(document).ready(function(){
$(".ticket_action").click(function(){
 $(".ticket_action").attr("disabled", "disabled");
    var form=$("#form-ui");
    var data=form.serialize();
    var title=$("#title").val();
     var tickets_types=$("#tickets_types").val();
     var comment=$("#comment").val();
     
if(title==""){

 $("#title").css("border","1px solid #ff0000");
 $(".ticket_action").attr("disabled",false);
}
if(tickets_types==""){
  $("#tickets_types").css("border","1px solid #ff0000");
  $(".ticket_action").attr("disabled",false);
}
if(comment==""){
  $("#comment").css("border","1px solid #ff0000");
  $(".ticket_action").attr("disabled",false);
}

//alert(data);

if(title!=""&&tickets_types!=""&&comment!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>profile/ticket_action",
        data:data,
        success: function(response){
        if(response == 1){
          toastr.success("تم فتح التذكرة بنجاح",  {timeOut: 2000});
          //location.assign("<?php echo base_url()?>profile/technical_support");
          $(":text").val('');
          $("textarea").val("");
          $("#tickets_types option:first").attr('selected','selected');
          $(".ticket_action").attr("disabled",false);
             }
        
        else if(response == 0){
          location.assign("<?php echo base_url()?>");
        }
        
        }
    });
}
});
});
</script>
<!--------------------------End Ticket---------------------------------------->
<!-----------------------My account----------------------------------->

<script>
$(document).ready(function(){
$(".profile_action").click(function(){
 $(".profile_action").attr("disabled", "disabled");
    var form=$("#form-ui");
    var data=form.serialize();
    var title=$("#title").val();
     var phone=$("#phone").val();
     var email=$("#email").val();
     var city_id=$("#city_id").val();
if(title==""){

 $("#title").css("border","1px solid #ff0000");
 $(".profile_action").attr("disabled",false);
}
if(phone==""){
  $("#phone").css("border","1px solid #ff0000");
  $(".profile_action").attr("disabled",false);
}
if(email==""){
  $("#email").css("border","1px solid #ff0000");
  $(".profile_action").attr("disabled",false);
}

if(city_id==""){
  $("#city_id").css("border","1px solid #ff0000");
  $(".profile_action").attr("disabled",false);
}
//alert(data);

if(title!=""&&city_id!=""&&email!=""&&phone!=""&&title!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>profile/edit_profile",
        data:data,
        success: function(response){
          //alert(response);
        if(response == 1){
          location.assign("<?php echo base_url()?>profile");
          $(".profile_action").attr("disabled",false);
             }
        
        else if(response ==2){
          toastr.error("رقم التليفون موجود سابقا",  {timeOut: 2000});
          $(".profile_action").attr("disabled",false);
        }
        else if(response ==3){
          toastr.error("البريد الألكترونى موجد سابقا",  {timeOut: 2000});
          $(".profile_action").attr("disabled",false);
        }
        
        }
    });
}
});
});
</script>
<!------------------------------------------------------------------>
<!----------------------------Password------------------------------>


<script>
$(document).ready(function(){
$("#oldpassword").keyup(function(){
var oldpassword=$("#oldpassword").val();
if(oldpassword==""){
 $("#oldpassword").css("border","1px solid #ff0000");
 $(".changepassword_action").attr("disabled",false);
}

var data={oldpassword:oldpassword}
if(oldpassword!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>profile/check_password",
        data:data,
        success: function(response){
         //alert(response);
        if(response == 1){
          $("#oldpassword").css("border","1px solid #CFCFCF");
          $(".changepassword_action").attr("disabled",false);
          $(".error_currentpassword").fadeOut();
             }
        
        else if(response ==2){
          $(".error_currentpassword").fadeIn();
          $("#oldpassword").css("border","1px solid #ff0000");
          $(".changepassword_action").attr("disabled","disabled");
        }
        else if(response ==0){
          $("#oldpassword").css("border","1px solid #ff0000");
          $(".changepassword_action").attr("disabled","disabled");
        }
        
        }
    });
}
});
});
</script>


<script>
$(document).ready(function(){
$("#confirmpassword").keyup(function(){
var confirmpassword=$("#confirmpassword").val();
var newpassword=$("#newpassword").val();

if(confirmpassword==""){
 $("#confirmpassword").css("border","1px solid #ff0000");
 $(".changepassword_action").attr("disabled","disabled");
}
if(newpassword!=confirmpassword){
 $("#newpassword").css("border","1px solid #ff0000");
 $("#confirmpassword").css("border","1px solid #ff0000");
 $(".error_confirmpassword").fadeIn();
 $(".changepassword_action").attr("disabled","disabled");
}
else if(newpassword==confirmpassword){
  $("#newpassword").css("border","1px solid #CFCFCF");
 $("#confirmpassword").css("border","1px solid #CFCFCF");
$(".error_confirmpassword").fadeOut();
$(".changepassword_action").attr("disabled",false);
}

});
});
</script>

<script>
$(document).ready(function(){
$(".changepassword_action").click(function(){
 $(".changepassword_action").attr("disabled", "disabled");
    var form=$("#form-ui");
    var data=form.serialize();
    var newpassword=$("#newpassword").val();
     var confirmpassword=$("#confirmpassword").val();
     var oldpassword=$("#oldpassword").val();

if(oldpassword==""){
 $("#oldpassword").css("border","1px solid #ff0000");
 $(".changepassword_action").attr("disabled",false);
}
if(newpassword==""){
  $("#newpassword").css("border","1px solid #ff0000");
  $(".changepassword_action").attr("disabled",false);
}
if(confirmpassword==""){
  $("#confirmpassword").css("border","1px solid #ff0000");
  $(".changepassword_action").attr("disabled",false);
}



if(oldpassword!=""&&newpassword!=""&&confirmpassword!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>profile/password_action",
        data:data,
        success: function(response){
          alert(response);
        if(response == 1){
          location.assign("<?php echo base_url()?>profile");
             }
        
        else if(response ==2){
          $(".error_currentpassword").fadeIn();
          $("#oldpassword").css("border","1px solid #ff0000");
        }
       
        
        }
    });
}
});
});
</script>


<script>
$(document).ready(function(){
$(".add-to-remove").click(function(){
var fav_id=$(this).nextAll("input").val();
var data={fav_id:fav_id}
$.ajax({
        type:"POST",
        url:"<?= base_url()?>profile/delete_fav",
        data:data,
        success: function(response){
        if(response == 1){
          location.assign("<?php echo base_url()?>profile/favorite");
             }
    }
    });
});
});
</script>



<!--------------Start-message Create----------------->
<script>
$(document).ready(function(){
$(".message_action").click(function(){
 $(".message_action").attr("disabled", "disabled");
    var form=$("#form-ui");
    var data=form.serialize();
    var title=$("#title").val();
     var comment=$("#comment").val();
     
if(title==""){
 $("#title").css("border","1px solid #ff0000");
 $(".message_action").attr("disabled",false);
}

if(comment==""){
  $("#comment").css("border","1px solid #ff0000");
  $(".message_action").attr("disabled",false);
}

//alert(data);

if(title!=""&&comment!=""){
$.ajax({
        type:"POST",
        url:"<?= base_url()?>messages/message_action",
        data:data,
        success: function(response){
         // alert(response);
        if(response == 1){
          toastr.success("تم ارسال الرسالة بنجاح",  {timeOut: 2000});
          //location.assign("<?php echo base_url()?>profile/technical_support");
          $("textarea").val("");
          $(".message_action").attr("disabled",false);
             }
        
        else if(response == 0){
          location.assign("<?php echo base_url()?>");
        }
        
        }
    });
}
});
});
</script>
<!------------------------------------------------------------------>
<!-----------------------End Message----------------------------------->

<!--------------Start-Add Advertising----------------->


<script>
function getState(val) {
   // alert(val);
$.ajax({
	type: "POST",
	url: "<?=base_url()?>admin/users/get_state",
	data:'country_id='+val,
	success: function(data){
	  //alert(data);
		$("#state-list").html(data);
	}
	});
}
</script>


<script>
$(document).ready(function(){
$(".add_adv_action").click(function(){
 $(".add_adv_action").attr("disabled", "disabled");
    var form = $('#form-ui')[0];
var data = new FormData(form);
    var title=$("#title").val();
    var city_id=$("#city_id").val();
    var category=$("#category").val();
     var courrency=$("#courrency").val();
     var price=$("#price").val();
     var comment=$("#comment").val();
     
if(title==""){

 $("#title").css("border","1px solid #ff0000");
 $(".add_adv_action").attr("disabled",false);
}
if(city_id==""){
  $("#city_id").css("border","1px solid #ff0000");
  $(".add_adv_action").attr("disabled",false);
}
if(category==""){
  $("#category").css("border","1px solid #ff0000");
  $(".add_adv_action").attr("disabled",false);
}
if(courrency==""){
  $("#courrency").css("border","1px solid #ff0000");
  $(".add_adv_action").attr("disabled",false);
}

if(price==""){
  $("#price").css("border","1px solid #ff0000");
  $(".add_adv_action").attr("disabled",false);
}
if(comment==""){
  $("#comment").css("border","1px solid #ff0000");
  $(".add_aadd_adv_actiondv").attr("disabled",false);
}

//alert(data);

if(title!=""&&courrency!=""&&price!=""&&category!=""&&comment!=""&&city_id!=""){
$.ajax({
  type:"POST",
        enctype: 'multipart/form-data',
        data:data,
        processData: false,
        contentType: false,
        cache: false,
        url:"<?= base_url()?>advertising/add_action",
        success: function(response){
          //alert(response);
        if(response == 1){
          toastr.success("تم اضافة الأعلان بنجاح وسوف يتم مراجعته فى اقرب وقت ",  {timeOut: 2000});
          location.assign("<?php echo base_url()?>account");
          $(":text").val('');
          $("textarea").val("");
          $("select").attr('selected','selected');
          $(".add_adv_action").attr("disabled",false);
             }
        
        else if(response ==2){
          toastr.success("نأسف للأنتهاء الباقة الخاصة بيك",  {timeOut: 2000});
          $(".add_adv_action").attr("disabled",false);

        }
        
        }
    });
}
});
});
</script>
<!------------------------------------------------------------------>
<!-----------------------End Add action----------------------------------->
