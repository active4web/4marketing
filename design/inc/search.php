
<style>
    
form.ssform input {
    border: 1px solid gray;
    padding: 8px 10px;
    text-align:right;
    direction:rtl;
    border-radius: 6px;
    color: black;
    margin: 0 0 5px 10px;
    box-shadow: 0px 0px 7px -1px #595959 !important;
    font-size:15px;
    width: 270px;
  }
  ul.ss {
    text-decoration: none;
    box-shadow: 0px 2px 12px -1px rgb(192, 191, 191);
    position: absolute;
    z-index: 100;
    width: 272px;
    background-color: rgb(239, 239, 239);
    list-style: outside none none;
    margin-right: 4px;
    overflow-y: scroll;
    max-height:250px;
    overflow-x: hidden;
  }
  ul.ss li {
    text-decoration: none;
    padding: 10px 2px 10px 2px;
    border: 1px solid rgb(210, 207, 207);
    text-align:right;
    margin-bottom: -1px;
    font-size:14px;
  }
</style>

<script>
$(document).ready(function(e) {
$("#username_search").keyup(function(e) {
var username=$(this).val();

 var data={phone:username};
 $.ajax({
url: '<?=base_url()?>admin/users/search_username',
type: 'POST',
dataType: 'json',
data: data,				
success: function( data ) {
$(".ss li").remove();
if(username !=0){
for(i=0;i<data.length;i++){  
$(".ss").append($("<li>").append($("<a>").text(data[i]).attr('href','<?=base_url()?>admin/users/customer_search?phone='+ data[i])));}
}
}
});
});
});
</script>


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
