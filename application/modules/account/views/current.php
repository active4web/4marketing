<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="الرئيسية" href="<?= base_url()?>/home">الرئيسية</a><span>&raquo;</span></li>
		<li><strong><a title="إعلاناتى">إعلاناتى </a> </strong></li>
	  </ul>
	</div>
  </div>
</div>
</div>

<div class="main-container col2-left-layout">
    <div class="container">
	  
      <div class="row">
        <aside class="profile col-sm-3 col-xs-12">
		<h3><br></h3>
          <div class="sidebar">           
            <ul>
              <li class="current"><a href="my_ads.html"><i class="fa fa-bullhorn" aria-hidden="true"></i> إعلاناتى</a></li>
              <li><a href="my_msg.html"><i class="fa fa-comments" aria-hidden="true"></i> الرسائل</a></li>
              <li><a href="my_balance.html"><i class="fa fa-money" aria-hidden="true"></i> الرصيد الاعلانى </a></li>
			  <li><a href="my_settings.html"><i class="fa fa-sliders" aria-hidden="true"></i> إعدادات الحساب</a></li>
			  <li><a href="my_settings.html"><i class="fa fa-sliders" aria-hidden="true"></i> تسجيل الخروج</a></li>
            </ul>
          </div>
        </aside> <!--//Aside-->
        <div class="col-main col-sm-9 col-xs-12">

		  
		<div class="category-filter">
              <div class="row">
                <div class="col-md-12">
                  <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                      <li role="presentation" class="active"><a href="#active_ads" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">إعلانات حالية</a></li>
                      <li role="presentation"><a href="#wait" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">إعلانات منتظرة</a></li>
                      <li><a href="#dropdown1" role="reject" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">إعلانات مرفوضة</a></li>
                      <li><a href="#dropdown2" role="exite" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">إعلانات منتهية</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                   
                      <div class="tab-pane fade in active" role="tabpanel" id="active_ads" aria-labelledby="profile-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                            
                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="1">
                                  </td>
                                  <td class="view-message  dont-show">التاريخ</td>
                                  <td class="view-message ">اسم الأعلان</td>
                                  <td class="view-message  inbox-small-cells">السعر</td>
								  <td class="view-message  text-right">الدردشة</td>
								  <td class="view-message  text-right">العمليات</td>
							  </tr>
							  <?php
							 foreach($active as $active){
								$currency= get_table_filed('currency',array('id'=>$active->currency_id),"name");
							  ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="2">
                                  </td>
								  <td class="inbox-small-cells"><?= "<span class='txt'>من:</span>".date("Y-m-d",strtotime($active->creation_date));?><br>
								<?= "<span class='txt'>الى:</span>".$active->expired_date_Val?>
								</td>
                                  <td class="view-message  dont-show"><?php if(strlen($active->name)>25){echo  mb_substr($active->name,0,25)."...";}else {echo  mb_substr($active->name,0,25);}?></td>
                                  <td class="view-message"> <?= $active->price."".$currency;?></td>
                                  <td class="view-message inbox-small-cells"></td>
								  <td class="view-message text-right"><a href="" title="حذف"><i class="fa fa-trash"></i></a>
								  <a href="" title="حذف"><i class="fa fa-edit"></i></a>
								</td>
							  </tr>
							 <?php }?>
                          </tbody>
                          </table>
                      </div>
              </div>
                </div>
                      </div>
                      <div class="tab-pane fade" role="tabpanel" id="dropdown1" aria-labelledby="dropdown1-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" id="selectall">
                                 <div class="btn-group">
                                     <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         الكل
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> لا شئ</a></li>
                                         <li><a href="#"> مقروء</a></li>
                                         <li><a href="#"> غير مقروء</a></li>
                                     </ul>
                                 </div>
                             </div>

                             <div class="btn-group">
                                 <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     المزيد
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> مقروءة</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> ممنوعة</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> مسح</a></li>
                                 </ul>
                             </div>
                             <div class="btn-group">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     نقل الى
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> مقروءة</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> ممنوعة</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> مسح</a></li>
                                 </ul>
                             </div>

                             <ul class="unstyled inbox-pagination">
                                 <li><span>1-23 من 123</span></li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="1">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message  text-right">9:15 صباحا</td>
                              </tr>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="2">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">15 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="3">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">15 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="4">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">1 ابريل</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="5">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد <span class="label label-danger pull-right">مهمة</span> </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">23 مايو</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="6">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message text-right">14 يناير</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="7">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message text-right">19 فراير</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="8">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message dont-show">الاسم او البريد<span class="label label-success pull-right">مجلة</span></td>
                                  <td class="view-message view-message">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">4 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="9">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">13 يونيو</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="10">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد <span class="label label-info pull-right">عائلية</span> </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">24 مارس</td>
                              </tr>
                            
                          </tbody>
                          </table>
                      </div>
              </div>
                </div>
                      </div>
                      <div class="tab-pane fade" role="tabpanel" id="dropdown2" aria-labelledby="dropdown2-tab">
                        <div class="row">
                <div class="col-xs-12">
                  <div class="inbox-body">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" id="selectall">
                                 <div class="btn-group">
                                     <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         الكل
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> لا شئ</a></li>
                                         <li><a href="#"> مقروء</a></li>
                                         <li><a href="#"> غير مقروء</a></li>
                                     </ul>
                                 </div>
                             </div>

                             <div class="btn-group">
                                 <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     المزيد
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> مقروءة</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> ممنوعة</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> مسح</a></li>
                                 </ul>
                             </div>
                             <div class="btn-group">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     نقل الى
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> مقروءة</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> ممنوعة</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> مسح</a></li>
                                 </ul>
                             </div>

                             <ul class="unstyled inbox-pagination">
                                 <li><span>1-23 من 123</span></li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="1">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message  text-right">9:15 صباحا</td>
                              </tr>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="2">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">15 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="3">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">15 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="4">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">1 ابريل</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="5">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد <span class="label label-danger pull-right">مهمة</span> </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">23 مايو</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="6">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message text-right">14 يناير</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="7">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message text-right">19 فراير</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="8">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message dont-show">الاسم او البريد<span class="label label-success pull-right">مجلة</span></td>
                                  <td class="view-message view-message">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">4 مارس</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="9">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">13 يونيو</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox case" name="case" value="10">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">الاسم او البريد <span class="label label-info pull-right">عائلية</span> </td>
                                  <td class="view-message ">محتوى نصي بما يتضمنه الرسالة او حاجة مماثلة</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">24 مارس</td>
                              </tr>
                            
                          </tbody>
                          </table>
                      </div>
              </div>
                </div>
                      </div>
                    </div>
                  </div>
                </div>  
              </div>
            </div>



        </div>
        
      </div>
    </div>
  </div>