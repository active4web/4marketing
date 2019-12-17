<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".base_url()."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='tasks';
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>مهام قيد العمل</title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include ("design/inc/sidebar.php");?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$url.'admin';?>"><?= lang('admin_panel'); ?> </a>
							<i class="fa fa-circle"></i>
						</li>
												
<?php
$id_projects=$this->input->get("id_project");
$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
if($status==1){
?>
<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>">المشاريع الحالية</a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($status==4){
?>

<li>
<a href="<?= $url . 'admin/projects/finished'; ?>">المشاريع المنتهية</a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						<li>
							<span class="active">مهام قيد العمل</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase">المهام
										<span style="margin-right:10px"><i class="icon-notebook"></i>
										<?php
										$id_projects=$this->input->get("id_project");
										$logo_projects=get_table_filed("tbl_projects",array("id"=>$id_projects),"logo");

										$select_tasks=get_table_data('tbl_tasks',array('project_id'=>$id_projects),1,'start_date','asc');
										$email_send=get_table_filed("tbl_projects",array("id"=>$id_projects),"name");
										echo $email_send;
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;">
										
								   <?php if($logo_projects !=""){?>
								   <img src="<?=DIR?>uploads/projects/<?=$logo_projects?>" style="width:50px;height:50px;border-radius:50%;">
									<?php }else {?>
                                 
								  <img src="<?=DIR?>uploads/projects/avatar.png" style="width:50px;height:50px;">
								 <?php }  ?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-user"></i>
										مدير المشروع :
										<?php
										$finish_date_task="";
										$start_date_task="";
										$id_projects=$this->input->get("id_project");
										
										$id_magager=get_table_filed("tbl_projects",array("id"=>$id_projects),"id_magager");
										$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										$start_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"creation_date");
										$update_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"update_date");
										 //echo "ffff".$start_date_project;

                                        if(count($select_tasks)>0){
										$sql_finished_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'finished_date!='=>""),1,'finished_date','desc');
										$sql_start_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'select_date'=>'2'),1,'start_date','asc');
									
									
									if(count($sql_finished_date)>0){
									    	foreach($sql_finished_date as $sql_finished_date)
											$data_finishsql['finish_date']=$sql_finished_date->finished_date;
									    $finish_date_task=$sql_finished_date->finished_date;
									    	$this->db->update("tbl_projects",$data_finishsql,array('id'=>$id_projects));
									}
									    
									    
										if(count($sql_start_date)>0){
										    foreach($sql_start_date as $sql_start_date)
											$data_startsql['task_start_date']=$sql_start_date->start_date;
											$this->db->update("tbl_projects",$data_startsql,array('id'=>$id_projects));
										   $start_date_task=$sql_start_date->start_date;
										}
										
										
										}
										$fname=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
										$lname=get_table_filed("tbl_users",array("id"=>$id_magager),"lname");
										
										switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>قيد العمل</span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>قيد الانتظار</span>";
													  break;
													  case 3:
													  $status="<span class='label label-sm label-success'>مستقبلى</span>";
													  break;
													  case 4:
													  $status="<span class='label label-sm label-success' style='background-color:#4099ff !important'>تم الانتهاء</span>";
													  break;
													default:
													  break; 
												}
										echo $fname."&nbsp".$lname;
										?></span>
										<?php #endregion
										if(count($select_tasks)>0){
										?>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										مدة التنفيذ:
										<?php

									$query = $this->db->query("select  sum(total_hrs) as total_hrs from tbl_tasks where project_id=$id_projects group by project_id");

									foreach ($query->result() as $row)
										{
										echo $row->total_hrs."&nbspساعة &nbsp&nbsp".ceil(($row->total_hrs/8))."&nbspيوم &nbsp&nbsp";
										     }
										?>
										</span>


										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										مدة المشروع الفعلى:
										<?php
										if($finish_date_task!=""&&$start_date_task!=""){
							$total_hrs_project=(strtotime($finish_date_task)- strtotime($start_date_task))/(60*60);
							$total_daies=ceil($total_hrs_project/24);
							echo $total_daies."&nbspيوم &nbsp&nbsp";
										}
										else {

											echo "غير معلومة";
										}
										?>
										</span>

											<?php }?>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ إنشاء المشروع:
										<?php
									echo date("Y-m-d H:i",strtotime($start_date_project));
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ تعديل المشروع

										<?php
									if($update_date_project!=""){echo date("Y-m-d H:i",strtotime($update_date_project));}
										?>
										</span>
										<?php if(count($select_tasks)>0){?>

											<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ بداية المشروع
										<?php
									if($start_date_task!=""){echo date("Y-m-d H:i",strtotime($start_date_task));}
									else {

										echo "غير معلومة";
									}
										?>
										</span>

										<span style="margin-right:10px;direction:rtl;"> <i class="fa fa-calendar"></i>
										تاريخ الانتهاء
										<?php
									if($finish_date_task!=""){echo date("Y-m-d H:i",strtotime($finish_date_task));}
									else {

										echo "غير معلومة";
									}
										?>
										</span>
										<?php }?>
										<span style="margin-right:10px;direction:rtl;"><i class="icon-note"></i>
										الحالة
										<?php
									echo $status;
										?>
										</span>
										<?php
										if($this->session->userdata('files_projects_view')=="files_projects_view"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/projects/files?id_project=<?php echo $id_projects;?>"> <i class="fa fa-file-pdf-o"></i>ملفات المشروع</a>
										</span>
										<?php }?>
										<?php
										if($this->session->userdata('project_users')=="project_users"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/task/project_users?id_project=<?php echo $id_projects;?>"> <i class="fa fa-users"></i>فريق العمل المشروع </a>
										</span>
										<?php }?>
										
											<?php
											if($this->session->userdata('chat')=="chat"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/chat?id_project=<?php echo $id_projects;?>" target="new"> <i class="fa fa-comments-o"></i> الدردشة </a>
										</span>
										<?php }?>
										
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
										    <?php
										    	$statusp=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										    	if($statusp!=4){
										    ?>
											<div class="col-md-12">
												<?php if($result_amount>0){
													if($this->session->userdata('multitasks_delete')=="multitasks_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton_task"> حذف مجموعة
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('tasks_add')=="tasks_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> إضافة مهمة
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
														</div>
														<?php }?>
													
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="<?=$url?>admin/task/delete" method="POST" id="form">
									<input type="hidden" value="<?= $id_projects?>" name="id_project">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th><i class="fa fa-sticky-note"></i> المهمة</th>
												<th>الساعات</th>
												<th>الاجمالى</th>
												<th> البداية</th>
												<th> النهاية</th>
												<th>المتبقى</th>
												<th>مراجعة اولى</th>
												<th>مراجعة تانية</th>
												<th> الحالة</th>
												<th>الموظف</th>
												<th> العمليات </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
										<?php
										$current_date=date("Y-m-d H:i");
                                            foreach($results as $data) {
											$project_id=$data->project_id;
											$name=$data->name;
											$user_id=$data->user_id;
											$total_hrs=$data->total_hrs;
											$select_date=$data->select_date;
											$code=$data->code;
											$start_date=$data->start_date;
											$select_enddate=$data->select_enddate;
											$finished_date=$data->finished_date;
											$status_review=$data->status_review;
											$status_review1=$data->status_review1;
											$review_date=$data->review_date;
											$review1_date=$data->review1_date;
if($start_date!=""&&$select_date==2&&$finished_date!=""&&$select_enddate==2&&(strtotime($finished_date)>=strtotime($current_date))){


												if(round((strtotime($finished_date)-strtotime($current_date))/(60*60*24))<1){
													$reaming_time="اليوم";
												}
                                         else {
										$reaming_time=ceil((strtotime($finished_date)-strtotime($current_date))/(60*60*24))."يوم";
										 }
										 $reaming_value=1;
										
										 
											}
											else if($start_date!=""&&$select_date==2&&$finished_date!=""&&$select_enddate==2&&(strtotime($finished_date)<strtotime($current_date))){
												$reaming_time="0 يوم";
												$reaming_value=2;
											}
											else if(($start_date==""||$select_date==1||$finished_date==""||$select_enddate==1)||(strtotime($finished_date)<=strtotime($current_date))){
												$reaming_time="غير محدد";
												$reaming_value=0;
											}
										//	$manager_name=get_table_filed("tbl_pr",array("id"=>$project_id),"fname");
											$user_name=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$email=get_table_filed("tbl_config",array("config_key"=>"site_email"),"config_value");
											if($user_id!=""){
												$user_main_name=$user_name;
												}
												else {
													$user_main_name="غير محدد";
												}

											if($data->select_date==1){
												$main_start=1;
											$start_date="غير محدد";
											$finished_date="غير محدد";
											}
											else {
												$start_date=$start_date	;
												$main_start=2;
												if($start_date==date("Y-m-d H:i")){
													$data_status['status']='1';
													$this->db->update('tbl_tasks',$data_status,array('id'=>$data->id));
												}
												$finished_date=$data->finished_date;
											}
											
											
											
if($status_review==0){
$main_review=1;
$review_date="<span class='label label-sm label-danger'>غير محدد</span>";
}
else {
$main_review=2;
if($status_review==1){$main_review="يوجد ملاحظة";
$review_date="<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".date("Y-m-d H:i",strtotime($data->review_date))."</span><br>".
"<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".$main_review."</span>";
}
else{$main_review="تم التنفيذ";
$review_date="<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".date("Y-m-d H:i",strtotime($data->review_date))."</span><br>".
"<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".$main_review."</span>";
}
}											
											

if($status_review1==0){
$main_review1=1;
$review1_date="<span class='label label-sm label-danger'>غير محدد</span>";
}

else {
$main_review1=2;
if($status_review1==1){$main_review1="يوجد ملاحظة";
$review1_date="<span class='label label-sm label-Grey'  style='color:#000; background-color:#eceef1'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".$main_review1."</span>";
}
else{$main_review1="تم التنفيذ";
$review1_date="<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".$main_review1."</span>";
}
}

											$status=$data->status	;
												switch($status){
													case 0:
													  $status="<span class='label label-sm label-danger'> لم تبدا</span>";
													  break;
													case 1:
													  $status="<span class='label label-sm label-success'>قيد العمل</span>";
													  break;
													  case 2:
													  $status="<span class='label label-sm label-success' style='background-color: #2276bf;color: #fff !important;'>تم الانتهاء</span>";
													  break;
													default:
													  break; 
												}
												
												$minutes=0;
												$total_hrs_m=($total_hrs*60);
				$query_hrs = $this->db->query("select  sum(total_hrs) as final_total_hrs from user_task_log where id_task=$data->id and enddate IS NOT NULL group by id_task");
				if(count($query_hrs->result())>0){
					foreach ($query_hrs->result() as $query_hrs)
					$minutes=$query_hrs->final_total_hrs;
					//$intdiv="(".$minutes.")".intdiv($minutes, 60).':'. ($minutes % 60);
					$intdiv=intdiv($minutes, 60).':'. ($minutes % 60);
					if($total_hrs_m>=$minutes){$final_reaming=$total_hrs_m-$minutes;
						$reaming=intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
						else {$final_reaming=$minutes-$total_hrs_m;
							$reaming="-".intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
					
				$total_muites="<span class='label label-sm label-success'>$intdiv</span><br>
				<span class='label label-sm label-success'>$reaming</span>
				";
				
				$minutes_compare=$minutes;
			}
			else {
				$reaming=intdiv((($total_hrs*60)-$minutes), 60).':'. ((($total_hrs*60)-$minutes) % 60);
				$minutes_compare=0;
					$total_muites="<span class='label label-sm label-success'>غير محدد</span><br>
					<span class='label label-sm label-success' >$reaming</span>";;
						}		


?>
<tr class="odd gradeX" style="<?php if($reaming_value==2){?>background-color:#fff <?php } else if($reaming_value==1){ ?>background-color:#f3f5f9<?php }?>">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td><a title="ملاحظات المهمة" href="<?=DIR?>admin/task/details?id_project=<?php echo $project_id;?>&id_status=<?php echo $data->id;?>"> <i class="fa fa-sticky-note" style="margin-left:5px"></i><?=mb_substr($name,0,15);?></a> </td>
												<td> <?=$total_hrs;?> </td>
												<td  style="direction:ltr"> <?=$total_muites;?> </td>
												
												<td style="direction:ltr"><?php if($main_start==2){echo date("Y-m-d H:i",strtotime($start_date));} else {echo $start_date;}?> </td>
												<td style="direction:ltr"> <?php if($main_start==2){echo date("Y-m-d H:i",strtotime($finished_date));} else {echo $finished_date;}?> </td>

												<td> <?=$reaming_time;?> </td>
												
												
<td style="direction:ltr">
<?php
if($this->session->userdata('task_review')=="task_review" &&$status_review!=2&&$data->status==2){
?>
<a  href="<?=DIR?>admin/task/change_review?type=0&id_project=<?php echo $project_id;?>&id_status=<?php echo $data->id;?>" title="مراجعة اولى">
<i class="fa fa-edit" title="مراجعة اولى"></i>
<?php } else {?>
<a  title="مراجعة اولى"	>
<?php }?>
<?php  if($main_review==2){ date("Y-m-d H:i",strtotime($review_date));}else { echo $review_date;}?></a>
</td>
												 
												 
												 
												 <td style="direction:ltr">
<?php if($this->session->userdata('task_review1')=="task_review1" &&$status_review1!=2&&$data->status==2){	?>
<a  href="<?=DIR?>admin/task/change_review?type=1&id_project=<?php echo $project_id;?>&id_status=<?php echo $data->id;?>" title="مراجعة تانية" >
<i class="fa fa-edit" title="مراجعة تانية"></i>
<?php } else if($status_review1==2&&$data->status==2) {?>
<a  title="مراجعة تانية"><?php } else {?>
<a  title="مراجعة تانية">
<?php }?>
<?php  if($main_review==2){date("Y-m-d H:i",strtotime($review1_date));} else {echo $review1_date;}?> 
												</a>
												</td>
												

												<td>
												<?php
												if($minutes_compare>($total_hrs*60)){
												if(($status_review1!=2||$status_review!=2)&&$data->status!=2){
												?>
<a  href="<?=DIR?>admin/task/change_status?id_project=<?=$project_id;?>&id_status=<?php echo $data->id;?>" title="تغير الحالة" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="تغير الحالة"></i>
												<span><?php echo $status;?></span>
												<br>
                                              <span class='label label-sm label-danger'>يوجد تاخير</span>
												</a>
												<?php } else if($status_review1==2&&$status_review==2&&$data->status==2){?>
													<span><?php echo $status;?></span>
												<br>
                                              <span class='label label-sm label-danger'>يوجد تاخير</span>
												<?php }  else if(($status_review1!=2||$status_review!=2)&&$data->status==2){?>
													<a  title="تغير الحالة" style="padding: 1px 0px;background-color:#fff">
												<span><?php echo $status;?></span>
												<br>
												<span class='label label-sm label-danger'>يوجد تاخير</span>
												</a>
												<?php }?>
												<?php }else {?>
												<?php
		                 if(($status_review1!=2||$status_review!=2)&&$data->status!=2){
														?>
												<a  href="<?=DIR?>admin/task/change_status?id_project=<?=$project_id;?>&id_status=<?php echo $data->id;?>" title="تغير الحالة" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="تغير الحالة"></i>
												<?php } else {?>
													<a  title="تغير الحالة" style="padding: 1px 0px;background-color:#fff">
												<?php }?>
												<span><?php echo $status;?></span>
											<?php	 if($data->status==2){ ?>
												<span class='label label-sm label-success'  style="background-color: #2276bf;color: #fff !important;">يوجد انجاز</span>
												<?php }?>
												</a>
												<?php }?>
												</td>

												<td> <?=$user_main_name;?> </td>
												
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<?php if($this->session->userdata('user_statistics')=="user_statistics"){	?>
															<li><a href="<?= DIR?>admin/task/user_statistics?id_project=<?=$project_id?>&id=<?=$data->id?>"><i class="fa fa-eye"></i> احصائيات المهمة </a></li>
															<?php }	if($this->session->userdata('review_statistics')=="review_statistics"){?>

															<li><a href="<?= DIR?>admin/task/review_statistics?id_project=<?=$project_id?>&id=<?=$data->id?>"><i class="fa fa-eye"></i>  احصائيات المراجعة </a></li>
															<?php }?>
															<?php
														if($this->session->userdata('task_details')=="task_details"){
														?>
															<li><a href="<?=$url?>admin/task/details?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-eye"></i> تفاصيل </a></li>
														<?php }?>
															<?php if($data->status!=2) {?>
													<?php
														if($this->session->userdata('tasks_edit')=="tasks_edit"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
														<li><a href="<?=$url?>admin/task/edit?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-pencil"></i> تعديل </a></li>
														<li><a href="<?=$url?>admin/task/start_date?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-calendar"></i> تاريخ البداية </a></li>
														<?php
														}
														if($this->session->userdata('tasks_delete')=="tasks_delete"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/task/delete?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-remove"></i> حذف </a></li>
														<?php 
														}
														?>
															<?php
															if($this->session->userdata('start_time')=="start_time"&&$status_review1==0&&$status_review==0&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/task/start_time?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-remove"></i> وقت البداية </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }}?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase">عفوا لاتوجد بيانات للعرض</span></center>
									<?php }?>
								<div class="row">
								     <?php
										    	$statusp=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										    	if($statusp!=4){
										    ?>
								    <div class="col-md-12" style="margin-top:20px">
													<button id="sample_editable_1_2_new" class="btn sbold GREY allbutton">الكل
													</button>
												
													<button id="sample_editable_1_2_new" class="btn sbold GREY waitbutton">  قيد الانتظار
													</button>
													
													<button id="sample_editable_1_2_new" class="btn sbold GREY workedbuuton">  قيد العمل
													</button>
													<button id="sample_editable_1_2_new" class="btn sbold GREY reviewbutton"> قيد المراجعة
													</button>
													<button id="sample_editable_1_2_new" class="btn sbold GREY errorbutton"> اخطاء المهام
													</button>
												
													<button id="sample_editable_1_2_new" class="btn sbold GREY finishedbuuton">مهام تمت
													</button>
													
									<?php
									
									if($this->session->userdata('end_project')=="end_project"){?>
 <a href="<?=DIR?>admin/projects/chaneg_finished?project_id=<?=$id_projects?>"><button id="sample_editable_1_2_new" class="btn sbold red"> انهاء المشروع</button></a>
<?php }?>
											</div>
											<?php }?>
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> مجموع السجلات :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								</div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END Table Data-->

				</div>
				<!-- END CONTENT -->
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
		<script>
$(document).ready(function(e) {
	
    $(".addbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/add?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".errorbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_error?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".workedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_working?id_project="+<?=$this->input->get('id_project');?>);
    });
    $(".finishedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_finished?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".allbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks?id_project="+<?=$this->input->get('id_project');?>);
    });

	$(".reviewbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_wait_review?id_project="+<?=$this->input->get('id_project');?>);
    });
	$(".waitbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_wait?id_project="+<?=$this->input->get('id_project');?>);
    });
	
	
	$(".delbutton").click(function(e) {
        window.location.assign("delete");
	});
});
</script>

<script>
$(document).ready(function(e) {
    $("#checkAll").change(function(){
		$("input[type=checkbox]").not("#checkAll").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton_task").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
var b=confirm("هل متاكد من حذف مجموعة من المهام");
if(b==true){
$('#form').unbind('submit').submit();//renable submit
}		}
	    else{
			window.stop();
			//alert("<?=lang('row_one_alert');?>");
			toastr.warning("<?=lang('row_one_alert');?>");
	}
	});
});
</script>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
	toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>


<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/services/check_view_service") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation-"+id).html("<span class='label label-sm label-success'> مفعل</span>");
                	}
                	if (data == "0") {
                		$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>غير مفعل</span>");
                	}
				}
         });
	});
});
</script>
</body>
</html>
