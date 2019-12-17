
 <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
            <?php 
$id_cat=get_table_filed('products',array('id'=>base64_decode($this->input->get("ID"))),"cat_id");
$name_cat=get_table_filed('category',array('id'=>$id_cat),"name");

$dep_id=get_table_filed('products',array('id'=>base64_decode($this->input->get("ID"))),"dep_id");
$name_dep=get_table_filed('department',array('id'=>$dep_id),"name");
?>
<?php if($id_cat!=""){?>
<li class="home"> <a title="<?=$name_dep?>" href="<?= base_url()?>cat/subcategory?ID=<?= base64_encode($dep_id);?>"><?=$name_dep?>
</a><span>&raquo;</span></li>
<?php }?>
<li class="home"> <a title="<?=$name_cat?>" href="<?= base_url()?>cat/grid?ID=<?= base64_encode($id_cat);?>"><?=$name_cat?>
</a><span>&raquo;</span></li>

            <li><strong><a title="كل الأعلانات" href="<?= base_url()?>cat/all">كل الأعلانات</a> </strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>