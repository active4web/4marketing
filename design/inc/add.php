
<script>
$(document).ready(function(){
$("#cvcx").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
    var idold=$("#idold").val();
     var idrep=$("#idrep").val();

    if(idold==2&&idrep==2){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
           // alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
$(".mainbutton").prop('disabled', false);
$("#idold").val(1);
$("#idrep").val(1);
$(":text").val('');
$(":password").val('');
        }  else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainbutton").prop('disabled', false);
        }
        
        }
    });
    }
    else {
       toastr.error("من فضلك ادخل البيانات  صحيحة"); 
       $(".mainbutton").prop('disabled', false);
    }
});
});
</script>


<script>
$(document).ready(function(){
$("#bankaccount").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
   var user_name=$("#user_name").val();
   var iban_number=$("#iban_number").val();
   var account_number=$("#account_number").val();
   var bank_name=$("#bank_name").val();
    var service_type=$("#service_type").val();
   if(bank_name==""){
  toastr.error("من فضلك ادخل اسم البنك  "); 
      $(".mainbutton").prop('disabled', false);
   }
         if(account_number==""){
  toastr.error("من فضلك ادخل رقم الحساب "); 
      $(".mainbutton").prop('disabled', false);
   }
      if(iban_number==""){
  toastr.error("من فضلك ادخل رقم الايبان"); 
      $(".mainbutton").prop('disabled', false);
   }

      if(user_name==""){
  toastr.error("من فضلك ادخل اسم صاحب الحساب "); 
      $(".mainbutton").prop('disabled', false);
   }

//alert(data);
if(bank_name!=""&& account_number!=""&& iban_number!=""&& user_name!=""){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
          //alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
$(".mainbutton").prop('disabled', false);
if(service_type==1){
$(":text").val('');
}
        }  else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainbutton").prop('disabled', false);
        }
        
        }
    });
    }

});
});
</script>



        <script>
$(document).ready(function(){
$(".add_test").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
var formData = new FormData(data);
var form = $('#myForm')[0];
var formx = $('#myForm');
var data = new FormData(form);
var title=$("#title").val();
var service_type=$("#service_type").val();
    var url=(formx.attr("action"));
    if(title!=""){
$.ajax({
        type:"POST",
          enctype: 'multipart/form-data',
        url:url,
        data:data,
         processData: false,
            contentType: false,
            cache: false,
        success: function(response){
       // alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
            $(":text").val('');
           }
           $(".mainbutton").prop('disabled', false);
        }  else {
            toastr.error("يوجد خطاء فى التنفيذ");
        
            $(".mainbutton").prop('disabled', false);
        }
        
        }
    });
    }
    else {
       toastr.error("من فضلك ادخل البيانات  صحيحة"); 
       $(".mainbutton").prop('disabled', false);
    }
});
});
</script>



<script>
$(document).ready(function(){
$(".teamworkbutton").click(function(){
$(".mainbutton").attr("disabled", "disabled");
var fname=$("#fname").val();
var sname=$("#sname").val();
var lname=$("#lname").val();
var email=$("#email").val();


if (fname==""){
toastr.error("الاسم الاول غير صحيح",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
} 
if (sname==""){
toastr.error("الاسم الثانى غير صحيح",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}

if (lname==""){
toastr.error("الاسم الاخير غير صحيح",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}

if (email==""){
toastr.error("الاسم الايميل غير صحيح",  {timeOut: 5000});
$(".mainbutton").prop('disabled', false);
}


var emailid=0;
var send_emailid=0;
var passwordid=0;
var send_email=$("#send_email").val();
var password=$("#password").val();
var conpassword=$("#conpassword").val();
var service_type=$("#service_type").val();	
var formData = new FormData(data);
var form = $('#myForm')[0];
var data = new FormData(form);

if(service_type==1){
  var url= "<?php echo base_url()?>admin/teamwork/product_action";
if (password=="") {passwordid=1;}
  }
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/teamwork/edit_action"; 
  }

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
if (!reg.test(email)){
toastr.error("البريد الألكترونى غير صحيح",  {timeOut: 5000});
emailid=1;
$(".mainbutton").prop('disabled', false);
} 



else { 
if(service_type==1){
 var emaildata={email:email};

  $.ajax({
        type:"POST",
        url:"<?php echo base_url()?>admin/teamwork/checkmail",
        data:emaildata,
        success: function(response){
        //alert(response);
if(response == 1){
toastr.error("البريد الألكترونى موجود سابقا",  {timeOut: 5000});
 $(".mainbutton").prop('disabled', false);
}
else {

if (!reg.test(send_email)&&send_email!="") {
toastr.error("البريد الألكترونى غير صحيح",  {timeOut: 5000});
send_emailid=1;
 $(".mainbutton").prop('disabled', false);
		}     
 if (password!="") {
if (password!=conpassword) {
toastr.error("كلمة السر غير متطابقة",  {timeOut: 5000});
passwordid=1;
 $(".mainbutton").prop('disabled', false);
}
else {
 passwordid=0;   
}

}


if(fname!=""&&sname!=""&&lname!=""&&email!=""&&passwordid==0&&send_emailid==0){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
         processData: false,
            contentType: false,
            cache: false,
        success: function(response){
      //alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
            $(":text").val('');
            $(":file").val('');
            $(":password").val('');
             }
        }  else {
            //show error
            toastr.error("يوجد خطاء فى التنفيذ");
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}
else {
toastr.error("من فضلك ادخل البيانات  صحيحة"); 
$(".mainbutton").prop('disabled', false);
    
}

    
}
}

});

    
}



else {
 if(fname!=""&&sname!=""&&lname!=""&&email!=""&&passwordid==0&&send_emailid==0){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
         processData: false,
            contentType: false,
            cache: false,
        success: function(response){
     // alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
            $(":text").val('');
            $(":file").val('');
            $(":password").val('');
             }
        }  else {
            //show error
            toastr.error("يوجد خطاء فى التنفيذ");
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}
else {
toastr.error("من فضلك ادخل البيانات  صحيحة"); 
$(".mainbutton").prop('disabled', false);
    
}   
}
    
    
}

		

});
});
</script>




<script>
$(document).ready(function(){
$(".coursesbutton").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
var title=$("#title").val();
var price=$("#price").val();
var currency=$("#currency").val();
var city_id=$(".city").val();
var category=$("#category").val();
var about=$("#about").val();
var phone=$("#phone").val();
var email=$("#email").val();

var service_type=$("#service_type").val();
  if(title==""){
      toastr.error("عنوان الأعلان مطلوب"); 
    $(".mainbutton").prop('disabled', false);
  }
if(price==""){
    toastr.error("من فضلك حدد سعر الأعلان"); 
    $(".mainbutton").prop('disabled', false);
}

if(currency==""){
    toastr.error("من فضلك حدد نوع العملة المطلوبة "); 
    $(".mainbutton").prop('disabled', false);
}
if(city_id==""){
    toastr.error("من فضلك حدد المدينة"); 
    $(".mainbutton").prop('disabled', false);
}
if(category==""){
    toastr.error("من فضلك حدد القسم الرئيسي "); 
    $(".mainbutton").prop('disabled', false);
}
if(about==""){
    toastr.error("من فضلك حدد وصف الأعلان"); 
    $(".mainbutton").prop('disabled', false);
}
if(phone==""){
    toastr.error("من فضلك حدد  التليفون"); 
    $(".mainbutton").prop('disabled', false);
}

if(email==""){
    toastr.error("من فضلك حدد البريد الألكترونى "); 
    $(".mainbutton").prop('disabled', false);
}

var form = $('#myForm')[0];
var data = new FormData(form);
if(service_type==1){
  var url= "<?php echo base_url()?>admin/courses/add_action";
  }
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/courses/edit_action"; 
  }


if(title!=""&&price!=""&&currency!=""&&city_id!=""&&category!=""&&about!=""&&phone!=""&&email!=""){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
              processData: false,
            contentType: false,
            cache: false,
        success: function(response){
 //alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
            $(":text").val('');
             $("textarea").val('');
            $("#select_manager_id option:first").attr('selected','selected');
            $(".typeproject").removeAttr('checked');
             }
             $(".mainbutton").prop('disabled', false);
            
        }  else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainbutton").prop('disabled', false);
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}  

});
});
</script>




<script>
$(document).ready(function(){
$(".bagbutton").click(function(){
 $(".mainbutton").attr("disabled", "disabled");
var title=$("#title").val();
var bage_hrs=$("#bage_hrs").val();
var week_bage_daies=$("#week_bage_daies").val();
var bage_total_daies=$("#bage_total_daies").val();
var bage_details=$("#bage_details").val();
var cat_id=$("#cat_id").val();

var service_type=$("#service_type").val();
  if(title==""){
      toastr.error("من فضلك حدد اسم الحقيبة"); 
    $(".mainbutton").prop('disabled', false);
  }
if(bage_hrs==""){
    toastr.error("من فضلك حدد عدد ساعات الحقيبة"); 
    $(".mainbutton").prop('disabled', false);
}
if(week_bage_daies==0){
    toastr.error("من فضلك حدد عدد ايام الحقيبة فى الاسبوع"); 
    $(".mainbutton").prop('disabled', false);
}
if(bage_total_daies==""){
    toastr.error("من فضلك حدد اجمالى ايام الحقيبة"); 
    $(".mainbutton").prop('disabled', false);
}
if(bage_details==""){
    toastr.error("من فضلك حدد تفاصيل الحفيبة"); 
    $(".mainbutton").prop('disabled', false);
}
if(cat_id==""){
    toastr.error("من فضلك حدد تصنيف الحقيبة"); 
    $(".mainbutton").prop('disabled', false);
}



var form = $('#myForm')[0];
var data = new FormData(form);
if(service_type==1){
  var url= "<?php echo base_url()?>admin/courses/bags_action";
  }
else   if(service_type==2){
var url= "<?php echo base_url()?>admin/courses/editbag_action"; 
  }


if(title!=""&&bage_hrs!=0&&bage_hrs!=""&&week_bage_daies!=""&&bage_total_daies!=""&&bage_details!=""&&cat_id!=""){
$.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:url,
        data:data,
              processData: false,
            contentType: false,
            cache: false,
        success: function(response){
          //alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
            $(":text").val('');
             $("textarea").val('');
            $("#select_manager_id option:first").attr('selected','selected');
            $(".typeproject").removeAttr('checked');
             }
             $(".mainbutton").prop('disabled', false);
            
        }  else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainbutton").prop('disabled', false);
        }
        $(".mainbutton").prop('disabled', false);
        }
    });
}  

});
});
</script>





<script>
$(document).ready(function(){
$(".paymentfinishbutton").click(function(){
         $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("input[name='status']:checked").val();
    var idresult=$("#idresult").val();
    if(title!=""&&idresult==0){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,

        success: function(response){
           // alert(response)
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");

           $("#idresult").val(2);
           window.history.back();

        }  else {
            //show error
            toastr.error("يوجد خطاء فى التنفيذ");
        }
        }
    });
    }
 else  if(title!=""&&idresult==2){  
     toastr.error("غير مسموح بتغير حالة المهمة");

 }
    else {
       toastr.error("من فضلك ادخل البيانات  صحيحة"); 
    }
});
});
</script>


<script>
$(document).ready(function(){
$(".taskfinishbutton").click(function(){
toastr.error("غير مسموح بتغير حالة المهمة");
});
});
</script>





<script>
$(document).ready(function(){
$(".projectstatusbutton").click(function(){
     $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("#status_executed").val();
    var idresult=$("#idresult").val();
    if(title!=""&&idresult==0){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,
        success: function(response){
        //   alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
            
             $(".mainubtton").addClass('projectfinishbutton')
            $(".mainubtton").removeClass('projectstatusbutton');
           $("#idresult").val(2);
if(title==1){
$(".status_project").html("<span class='label label-sm label-danger' style='background-color:#e7505a !important'>قيد العمل</span>");
}

if(title==2){
$(".status_project").html("<span class='label label-sm label-success'>قيد الانتظار</span>");
}

    if(title==3){
               $(".status_project").html("<span class='label label-sm label-success'>مستقبلى</span>");
           }
    if(title==4){
               $(".status_project").html("<span class='label label-sm label-success' style='background-color:#4099ff !important'>تم الانتهاء</span>");
           }         
          window.history.back();
        } 
        
        else {
            //show error
            toastr.error("يوجد خطاء فى التنفيذ");
        }
        }
    });
    }
 else  if(title!=""&&idresult==2){  
     toastr.error("غير مسموح بتغير حالة المهمة");

 }
    else {
       toastr.error("من فضلك ادخل البيانات  صحيحة"); 
    }
});
});
</script>


<script>
$(document).ready(function(){
$(".projectfinishbutton").click(function(){
toastr.error("غير مسموح بتغير حالة المهمة");
});
});
</script>





<script>
$(document).ready(function(){
$(".permissionsstatusbutton").click(function(){
         $(".mainubtton").attr("disabled", "disabled");
    var form=$("#myForm");
    var data=form.serialize();
    var title= $("input[type='checkbox']").val();
    var txt=$("#txt").val();
    var idresult=$("#idresult").val();
   var service_type=$("#service_type").val();
    if(title!=""&&idresult==0&&txt!=""){
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:data,
        success: function(response){
        //alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
           if(service_type==1){
             $("input").val('');
           }
           
       $(".mainubtton").prop('disabled', false);
        } 
        else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainubtton").prop('disabled', false);
        }
        
        }
    });
    }

else {
toastr.error("من فضلك ادخل البيانات  صحيحة"); 
$(".mainubtton").prop('disabled', false);
}
});
});
</script>


<script>
$(document).ready(function(){
$(".taskstartdatebutton").click(function(){
  var form=$("#myForm");
    var data=form.serialize();
 $(".mainubtton").attr("disabled", "disabled");
         var select_date = $("input[name='select_date']:checked").val();
         var select_enddate = $("input[name='select_enddate']:checked").val();
         var enddate = $("#enddate").val();
         var meeting_start = $("#meeting_start").val();
         var mainid=0;
         var mainend=0;

if(select_date==2&&meeting_start==""){
  toastr.error("من فضلك حدد تاريخ البداية"); 
$(".mainubtton").prop('disabled', false);  
mainid=1;
}

if(select_enddate==2&&enddate==""){
  toastr.error("من فضلك حدد تاريخ النهاية"); 
$(".mainubtton").prop('disabled', false);  
mainend=1;
} 

if(mainend==0&&mainid==0){
$.ajax({
        type:"POST",
        url:"<?php echo base_url() ?>admin/task/start_date_action",
        data:data,
        success: function(response){
      // alert(response);
        if(response == 1){
            toastr.success("تم التنفيذ بنجاح");
       $(".mainubtton").prop('disabled', false);
        } 
        else {
            toastr.error("يوجد خطاء فى التنفيذ");
            $(".mainubtton").prop('disabled', false);
        }
        
        }
    });
    }
   


});
});
</script>






<!----------------****************--------------------->
<!----------------****************--------------------->
<!----------------****************--------------------->


<script>
$(document).ready(function(e) {
$("#search_name").keyup(function(e) {
var username=$(this).val();
//alert(username);
var data={search_name:username};
 $.ajax({
url: "<?= base_url()?>admin/courses/search_name",
type: 'POST',
dataType: 'json',
data: data,				
success: function( data ) {
$(".ss li").remove();
if(username !=0){
for(i=0;i<data.length;i++){  
  var pdata=  data[i].split(",");
  
$(".ss").append($("<li>").append($("<a>").text(pdata[0]).attr('href','<?= base_url()?>admin/courses/advertising_search?id='+ pdata[1])));}
}
}
});
});
});
</script>


<!----------------****************--------------------->
<!----------------****************--------------------->
<!----------------****************--------------------->









