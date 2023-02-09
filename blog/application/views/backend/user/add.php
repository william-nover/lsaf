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
                        User - ADD
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet">
                
                <!--begin::Form-->
                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/user/doAdd'; ?>" method="post" role="form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
                    <?php if(isset($error)){ ?>
                        <div class="form-group has-error">
                                <div class="col-lg-12">
                                      <label for="inputError" class="control-label"><?php echo $error;?></label>
                                </div>
                        </div>

                        <?php } ?>    
                    <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                                User Level:
                                        </label>
                                        <div class="col-lg-6">
                                               <select class="form-control m-input" name="userlevelid" id="userlevelid">

                                            <option value="0">Choose a group</option>

                                                    <?php foreach($ListUserLevel as $userlevel){ ?>

                                                    <option value="<?php echo $userlevel['user_level_id'];?>" <?php if($userlevel['user_level_id'] == $userlevelid) { echo "selected";} ?>> <?php echo $userlevel['user_level_name']?> </option>

                                                    <?php } ?>

                                          </select>

                                        </div>
                                </div>
                        
                        
                                <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                               User Name:
                                        </label>
                                        <div class="col-lg-6">
                                                <input name="username" type="text" class="form-control m-input" placeholder="User Name" value="<?php if(!empty($username)){echo $username;} ?>">
                                                <span class="m-form__help">
                                                        Please enter your full name
                                                </span>
                                        </div>
                                </div>
                        
                                <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                                Email address:
                                        </label>
                                        <div class="col-lg-6">
                                               <input name="email" type="text" class="form-control m-input" placeholder="Email" value="<?php if(!empty($email)){echo $email;} ?>">
                                                <span class="m-form__help">
                                                        We'll never share your email with anyone else
                                                </span>
                                        </div>
                                </div>
                                 <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                                Password
                                        </label>
                                        <div class="col-lg-6">
                                               <input name="password" type="password" class="form-control m-input" placeholder="Password"> 
                                               <span class="m-form__help">
                                                        We'll never share your password with anyone else
                                                </span>
                                        </div>
                                </div>
                        <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">
                                                Retype Password
                                        </label>
                                        <div class="col-lg-6">
                                                <input name="retypepassword" type="password" class="form-control m-input" placeholder="Retype-Password">
                                               <span class="m-form__help">
                                                        Must the same input to password
                                                </span>
                                        </div>
                                </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-6">
                                                    <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                                    <input name="cancel" class="btn btn-danger btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/user'; ?>'">
                                                        
                                                </div>
                                        </div>
                                </div>
                        </div>
                </form>
                <!--end::Form-->
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