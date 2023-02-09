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
                        Access - List Access Module Privilege User Level <?php echo $user_level_name;?>
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
                              <div class="col-xl-4 order-1 order-xl-4 m--align-right">
                             <a href="<?php echo BASE_URL_BACKEND;?>/access/newprivilege/<?php echo $id;?>" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                                    <span> <i class="fa fa-plus"></i> <span> ADD</span>
                                    </span>
                            </a>
                            <a href="<?php echo BASE_URL_BACKEND;?>/access/" class="btn btn-warning btn-sm m-btn  m-btn m-btn--icon">
                                    <span> <i class="fa fa-chevron-left"></i> <span> Back</span>
                                    </span>
                            </a>
                            </div>
                           </div>
                           
                        </div>
                        <?php if(isset($error)){ ?>
                        <div class="panel-body">
                                <div class="form-module has-error">
                                        <label for="inputError" class="col-sm-2 control-label col-lg-2"><?php echo $error;?></label>
                                </div>
                        </div>
                        <?php } ?>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <div class="table-responsive">
                          <table class="table table-sm">
                        <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Module Name</th>
                                    <?php
                                       foreach($ListPrivilege as $privilege){
                                       
                                       echo "<th align=\"center\">".$privilege['privilege_name']."</th>";
                                       
                                       }
                                       
                                       ?>
                                 </tr>
                              </thead>
                        <tbody>
                                 <?php
                                    $no=0;                                    
                                    foreach($ListAccessModule as $accessmodule){                                    
                                    $no++;                                   
                                     ?>
                                 <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $accessmodule['module_group_name']." - ".$accessmodule['module_name'];?></td>
                                    <?php
                                       foreach($accessmodule['access'] as $access){                                       
                                       	echo "<td align=\"center\">";                                       
                                       	if($access['is_privilege'] == 1) {                                       
                                    if($access['access_privilege_status'] == 1) {?>
                                    <a class="btn-success btn-sm" href="<?php echo BASE_URL_BACKEND."/access/active/".$access['access_privilege_id']."/".$id;?>"><i class="la la-check-circle"></i></a> &nbsp; 
                                    <?php } else { ?>
                                    <a class="btn-danger btn-sm" href="<?php echo BASE_URL_BACKEND."/access/active/".$access['access_privilege_id']."/".$id;?>"><i class="la la-power-off"></i></a> &nbsp;
                                    <?php }
                                       } else {
                                       
                                       	echo "&nbsp;";
                                       
                                       }
                                       
                                       echo "</td>";
                                       
                                       }
                                       
                                       ?>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                     </table>
                     </div>
                    
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
   
   <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>