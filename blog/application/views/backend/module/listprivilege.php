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
                        Module - List Privilege
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__body">
                    <div class="col-xl-4 order-1 order-xl-4 m--align-left">
                      <button class="btn btn-success btn-sm m-btn  m-btn m-btn--icon" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/module/addmoduleprivilege/<?php echo $id;?>'">
                                          <span> <i class="fa fa-plus"></i> <span> ADD</span>
                                          </span>
                      </button>
                      <button class="btn btn-warning btn-sm m-btn  m-btn m-btn--icon" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/module/'">
                             <span> <i class="fa fa-chevron-left"></i> <span> Back</span>
                             </span>
                     </button>
                     </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--mobile">
                     <div class="m-portlet__body">
                         <table class="table table-bordered table-striped table-condensed">
                            <thead>
                               <tr>
                                  <th width="5">No</th>
                                  <th>Privilege</th>
                                  <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                               <?php
                                  $no=0;

                                  foreach($ListModulePrivilege as $moduleprivilege){

                                         $no++;

                                   ?>
                               <tr>
                                  <td><?php echo $no;?></td>
                                  <td><?php echo $moduleprivilege['privilege_name'];?></td>
                                  <td>
                                     <a class="btn-outline-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete privilege <?php echo $moduleprivilege['privilege_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/module/deletemoduleprivilege/<?php echo $moduleprivilege['module_privilege_id'];?>/<?php echo $id;?>';}"><span class="la la-trash"></span></a> &nbsp; 
                                  </td>
                               </tr>
                               <?php } ?>
                            </tbody>
                         </table>
                     </div>
                </div>
            </div>
         </div>
      </div>
      <!-- end:: Body -->
      <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>
   </div>
   <!-- end:: Page -->
 
   <script src="<?php echo BACKEND_BASE_URL; ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
   <script src="<?php echo BACKEND_BASE_URL; ?>/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
 
</body>
<!-- end::Body -->
</html>