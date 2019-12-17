<?php
$inside_course=get_table_data("products",array("type"=>'1','view'=>'1','delete_key'=>'1'));
$diploma_course=get_table_data("products",array("type"=>'3','view'=>'1','delete_key'=>'1'));
$outside_course=get_table_data("products",array("type"=>'4','view'=>'1','delete_key'=>'1'));
$bags_course=get_table_data("bag_info",array('view'=>'1','delete_key'=>'1','delete_key'=>'1'));
$category=get_table_data("category",array('view'=>'1'),'','name','asc');
?>

<div class="row">
<form action="<?=base_url()?>user/search/inside_filter" method="post" class="contact-form">
							 <div class="col-md-12" style="position: relative;">
								 <input class="theme-input-style input" style="margin-bottom:0px" type="text" name="name" placeholder="اسم الكورس">
								 <button type="submit" class="btn searchbutton" style="line-height: 35px;width:50px;background-color:#367dfe !important;text-align: center;position: absolute;top: 0px;left: -9px;">
<i class="fa fa-search " style="color: #fff;"></i>
</button>
								 
								 </div>
</form>								 	
<form action="<?=base_url()?>user/search/inside_filter" method="post" class="contact-form">							
<div class="page-title text-center">
<h2 calss="col-md-12" style="text-align:right;font-size:16px;padding:10px;margin-bottom:0px">الأقسام</h2>
</div>
<?php
$inside_course=get_table_data("products",array("type"=>'1','view'=>'1','delete_key'=>'1'));
$diploma_course=get_table_data("products",array("type"=>'3','view'=>'1','delete_key'=>'1'));
$outside_course=get_table_data("products",array("type"=>'4','view'=>'1','delete_key'=>'1'));
$bags_course=get_table_data("bag_info",array('view'=>'1','delete_key'=>'1','delete_key'=>'1'));
$category=get_table_data("category",array('view'=>'1'),'20','name','asc');
?>

<div class="col-md-12">
<ul class="courses_list">
<li class="  ">    
<label class="cont_check">
<input type="checkbox" name="courses_key[]" value="1">
<span class="checkmark"></span>
<span class=" ">دورات داخل المملكة</span>
<?php if(count($inside_course)>0){?><span  class="dep_count"><?= count($inside_course);?></span><?php } ?>
</label>

</li>

<li class=" ">
 <label class="cont_check">   
<input type="checkbox" name="courses_key[]" value="4">
<span class="checkmark"></span>
<span class="couses_span">دورات خارج المملكة</span>
<?php if(count($outside_course)>0){?><span class="dep_count"><?= count($outside_course);?></span><?php } ?>
</label>
</li>

<li class=" ">
    <label class="cont_check">
<input type="checkbox" name="courses_key[]" value="3">
<span class="checkmark"></span>
<span class="couses_span"> دبلومات </span>
<?php if(count($diploma_course)>0){?><span class="dep_count"><?= count($diploma_course);?></span><?php } ?>
</label>
</li>


<li class=" ">
<label class="cont_check">
<input type="checkbox" name="courses_key[]" value="2">
<span class="checkmark"></span>
<span class="couses_span">حقائب تدريبة</span>
<?php if(count($bags_course)>0){?><span class="dep_count"><?= count($bags_course);?></span><?php } ?>
</label>
</li>

   </ul>
   
</div>
<div class="col-md-12">
<div class="page-title text-center">
    
<h2 calss="col-md-12" style="text-align:right;font-size:16px;padding:10px;margin-bottom:0px">التخصصات</h2>
</div>
<?php 
if(count($category)>0){
    
?>


<ul class="courses_list">
    <?php foreach($category as $cat){
    $id_cat=$cat->id;
  $dep_courses=get_table_data("products",array("cat_id"=>$id_cat,'view'=>'1','delete_key'=>'1'));
$dep_bags=get_table_data("bag_info",array('dep_id'=>$id_cat,'view'=>'1','delete_key'=>'1'));  
$total=count($dep_courses)+count($dep_bags);
    ?>
<li class=" ">
<label class="cont_check">
<input type="checkbox" name="dep_id[]" value="<?= $cat->id?>">
<span class="checkmark"></span>
<span class="couses_span"><?= $cat->name?></span>
<?php if($total>0){?><span  class="dep_count"><?= $total;?></span><?php }?>
</label>
</li>
<?php }?>
   </ul>

<?php }?>
</div>
<button type="submit" class="btn searchbutton mainheader" style="border-radius:0.4em;background-color:#367dfe !important;width:100%; font-size:17px">
    <i class="fa fa-search" style="margin-right:5px;font-size:13px;background: transparent"></i>
    فلتر
</button>
  </form>  
</div>