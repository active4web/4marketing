<?php 
	if(isset($_SESSION['msg']) && $_SESSION['msg']!=''&& $this->uri->segment(2)=="contact"){?>
<script>
$(document).ready(function(e) {
	toastr.info("<?=$_SESSION['msg'];?>",  {timeOut: 5000});
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

<!-----------------------------------------#Login------------------------------------------------------>
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

<!--------------------------------#ENDLogin--------------------------------->

<!---------------------------#START REGISTER--------------------------------->

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

<!-----------------------------------------##END REGISTER------------------------------------------>
<!--------------------------------##START CHECK PHONE-------------------------------------->
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
<!--------------------------------##END CHECK PHONE-------------------------------------->
<!--------------------------------##START EMAIL PHONE-------------------------------------->
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
<!--------------------------------##END EMAIL-------------------------------------->
<!--------------------------------##START FAV-------------------------------------->
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
var t = $(this);
  $.ajax({
        type:"POST",
        url:"<?php echo base_url()?>account/fav_action",
        data:data,
        success: function(response){
        if(response == 1){
          toastr.info("تم اضافة الأعلان فى المفضلة",  {timeOut: 1000});
        $(t).css({"color":"#e80f55"});
        $(".bb").css({"color":"#e80f55"});
        $(".fav_txt").text("احذف من المفضلة");
             }
        else {
          toastr.info("تم حذف الأعلان من المفضلة",  {timeOut: 1000});
          $(t).css({"color":"#333","background":"#fff"});
          $(".bb").css({"color":"#636363"});
          $(".fav_txt").text("اضف الى المفضلة");
        }
        }
    });


}
});
});
  </script>

  <!--------------------------------##END FAV-------------------------------------->
<!--------------------------------##START EventSource------------------------------>
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
<!--------------------------------##END EventSource------------------------------>

<!--------------##START Ticket-------------------------->
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
<!--------------------------##END TICKET------------------------------------->
<!--------------------------##START MY ACCOUNT-------------------------------->

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
<!-----------------------##END MY ACCOUNT--------------------------->
<!----------------------------CHANG PASSWORD------------------------------>
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
<!-----------------------##END CHANG PASSWOR--------------------------->
<!----------------------------CHANG PASSWORD--------------------------->
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
<!-----------------------##END CHANG PASSWOR--------------------------->
<!----------------------------CHANG PASSWORD--------------------------->

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
<!-----------------------##END CHANG PASSWOR--------------------------->
<!-------------------------##START DELETE FAV-------------------------->

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
<!-------------------------##END DELETE FAV-------------------------->

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
<!------------------------------End Message------------------------------------>
<!-----------------------START getState----------------------------------->
<script>
function getState(val) {
$.ajax({
	type: "POST",
	url: "<?=base_url()?>admin/users/get_state",
	data:'country_id='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});
}
</script>
<!------------------------------End Message------------------------------------>
<!-----------------------START getState----------------------------------->
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
     var service_type=$("#service_type").val();
     
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
  $(".add_adv_action").attr("disabled",false);
}

if(service_type==1){
  var url="<?= base_url()?>advertising/add_action";
}
if(service_type==2){
  var url="<?= base_url()?>account/edit_action";
}

if(service_type!=""&&title!=""&&courrency!=""&&price!=""&&category!=""&&comment!=""&&city_id!=""){
$.ajax({
  type:"POST",
        enctype: 'multipart/form-data',
        data:data,
        processData: false,
        contentType: false,
        cache: false,
        url:url,
        success: function(response){
        if(response == 1){
          toastr.success("تم تعديل الأعلان بنجاح",  {timeOut: 2000});
          location.assign("<?php echo base_url()?>account/edit?ID=" +<?= $this->input->get("ID");?>);
          $(":text").val('');
          $("textarea").val("");
          $("select").attr('selected','selected');
          $(".add_adv_action").attr("disabled",false);
             }
        
        else if(response ==2){
          toastr.success("نأسف للأنتهاء الباقة الخاصة بيك",  {timeOut: 2000});
          $(".add_adv_action").attr("disabled",false);
        }
        else if(response == 3){
          location.assign("<?php echo base_url()?>");
             }
        
        }
    });
}
});
});
</script>


<script>
$(document).ready(function(){
$(".show_hone").click(function(){
    $(".phone_hide").show();
    $(".show_hone").hide();
});

$(".phone_hide").click(function(){
    $(".show_hone").show();
    $(".phone_hide").hide();
});

});
</script>