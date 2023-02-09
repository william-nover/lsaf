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
                        Module  - ADD
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet">
                
                <!--begin::Form-->
                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/module/doAdd'; ?>" method="post" role="form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
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
                                       Group Name:
                                </label>
                                <div class="col-lg-6">
                                       <select class="form-control" name="module_group_id" id="module_group_id">
                                            <option value="0">Choose a module group</option>
                                            <?php foreach($ListGroup as $group){ ?>
                                            <option value="<?php echo $group['module_group_id'];?>" <?php if($group['module_group_id'] == $modulegroupid) { echo "selected";} ?>> <?php echo $group['module_group_name']?> </option>
                                            <?php } ?>
                                          </select> 
                                        <span class="m-form__help">
                                                Please enter Group name
                                        </span>
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Module Name:
                                </label>
                                <div class="col-lg-6">
                                    <input name="modulename" type="text" class="form-control m-input" placeholder="Module Name" value="<?php if(!empty($modulename)){echo $modulename;} ?>">
                                    <span class="m-form__help">
                                            Please enter Module name
                                    </span>
                                </div>
                        </div>  
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Module Path:
                                </label>
                                <div class="col-lg-6">
                                        <input name="modulepath" type="text" class="form-control m-input" placeholder="Module Controller" value="<?php if(!empty($modulepath)){echo $modulepath;} ?>">
                                        <span class="m-form__help">
                                                Please enter path
                                        </span>
                                </div>
                        </div>  
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Module Type:
                                </label>
                                <div class="col-lg-6">  
                                    <select class="form-control" name="moduletype" id="moduletype">
                                       <option value="0">Default</option>
                                       <option value="1">Pages</option>

                                    </select>
                                </div>
                        </div> 
                        
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-6">
                                                    <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                                    <input name="cancel" class="btn btn-danger btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/module'; ?>'">                                                      
                                                </div>
                                        </div>
                                </div>
                        </div>
                </form>
                <!--end::Form-->
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