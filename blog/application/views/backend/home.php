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
                        Actions
                     </h3>
                     <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                           <a href="#" class="m-nav__link m-nav__link--icon">
                           <i class="m-nav__link-icon la la-home"></i>
                           </a>
                        </li>
                        <li class="m-nav__separator">
                           -
                        </li>
                        <li class="m-nav__item">
                           <a href="" class="m-nav__link">
                           <span class="m-nav__link-text">
                           Actions
                           </span>
                           </a>
                        </li>
                        <li class="m-nav__separator">
                           -
                        </li>
                        <li class="m-nav__item">
                           <a href="" class="m-nav__link">
                           <span class="m-nav__link-text">
                           Create New Post
                           </span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
              Traffict etc
            </div>
         </div>
      </div>
      <!-- end:: Body -->
      <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>
   </div>
   <!-- end:: Page -->
   <!-- begin::Quick Nav -->
   <!-- begin::Quick Nav -->	
   <!--begin::Base Scripts -->
   <!-- begin::Quick Nav -->	
   <!--begin::Base Scripts -->
   <script src="<?php echo BACKEND_BASE_URL; ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
   <script src="<?php echo BACKEND_BASE_URL; ?>/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
   <!--end::Base Scripts -->   
   <!--begin::Page Vendors -->
   <script src="<?php echo BACKEND_BASE_URL; ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
   <!--end::Page Vendors -->  
   <!--begin::Page Snippets -->
   <script src="<?php echo BACKEND_BASE_URL; ?>/app/js/dashboard.js" type="text/javascript"></script>
   <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>