<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
   <!-- begin:: Page -->
   <div class="m-grid m-grid--hor m-grid--root m-page">
      <?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
      <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
         <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>	
         <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
               <div class="d-flex align-items-center">
                  <div class="mr-auto">
                     <h3 class="m-subheader__title m-subheader__title--separator">
                        User - List
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
               <div class="m-portlet m-portlet--mobile">
                  <div class="m-portlet__body">
                     <!--begin: Search Form -->
                     <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                           <div class="col-xl-8 order-2 order-xl-1">
                              <div class="form-group m-form__group row align-items-center">
                                
                                 <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                       <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                       <span class="m-input-icon__icon m-input-icon__icon--left">
                                       <span>
                                       <i class="la la-search"></i>
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 order-1 order-xl-4 m--align-right">
                             <a href="<?php echo BASE_URL_BACKEND;?>/user/add/" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                                    <span> <i class="fa fa-plus"></i> <span> ADD</span>
                                    </span>
                            </a>
                           </div>
                            
                        </div>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <table class="m-datatable" id="html_table" width="100%">
                        <thead>
                           <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Group</th>
                            <th>Create Date</th>
                            <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php
                                    if(count($ListUser) > 0){
                                    
                                    $no=0;
                                    
                                    foreach($ListUser as $user){
                                    
                                    	$no++;
                                    
                                     ?>
                                 <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $user['user_name'];?></td>
                                    <td><?php echo $user['user_email'];?></td>
                                    <td><?php echo $user['user_level_name'];?></td>
                                    <td><?php echo $user['user_create_date'];?></td>
                                    <td align="">
                                       <?php if($user['user_active_status'] == 1) {?>
                                       <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/user/active/".$user['user_id'];?>"><i class="la la-check-circle"></i></a> &nbsp; 
                                       <?php } else { ?>	
                                       <a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/user/active/".$user['user_id'];?>"><i class="la la-power-off"></i></a> &nbsp;
                                       <?php } ?>
                                       <a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND;?>/user/edit/<?php echo $user['user_id'];?>"><i class="la la-edit"></i></a> &nbsp; 
                                       <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete grup <?php echo $user['user_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/user/delete/<?php echo $user['user_id'];?>';}"><i class="la la-trash"></i></a>
                                    </td>
                                 </tr>
                                 <?php } ?>
                                 <?php } else {?>
                                 <tr>
                                    <td align="center" colspan="10">Data Not Found</td>
                                 </tr>
                                 <?php } ?>
                        </tbody>
                     </table>
                     <!--end: Datatable -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end:: Body -->
      <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>
   </div>
   <!-- end:: Page -->
  	
   <!--begin::Base Scripts -->
   <script src="<?php echo BACKEND_BASE_URL; ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
   <script src="<?php echo BACKEND_BASE_URL; ?>/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
   <!--end::Base Scripts -->   
   <!--begin::Page Vendors -->
   <script src="<?php echo BACKEND_BASE_URL; ?>/demo/default/custom/components/datatables/base/html-table.js" type="text/javascript"></script>
   <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>