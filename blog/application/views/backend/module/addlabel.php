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
                        Label  - ADD
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet">
                
                <!--begin::Form-->
                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/module/doAddLabel'; ?>" method="post" role="form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
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
                                       Label Title:
                                </label>
                                <div class="col-lg-6">
                                    <input name="label_parent" type="hidden" class="form-control m-input" placeholder="Label title" value="<?php if(!empty($label_parent)){echo $label_parent;} ?>">
                                    <input name="label_title" type="text" class="form-control m-input" placeholder="Label title" value="<?php if(!empty($label_title)){echo $label_title;} ?>">
                                    <span class="m-form__help">
                                            Please enter Label title
                                    </span>
                                </div>
                        </div> 
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Label Name:
                                </label>
                                <div class="col-lg-6">
                                    <input name="label_name" type="text" class="form-control m-input" placeholder="Label Name" value="<?php if(!empty($label_name)){echo $label_name;} ?>">
                                    <span class="m-form__help">
                                            Please enter Label Name
                                    </span>
                                </div>
                        </div> 
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Type:
                                </label>
                                <div class="col-lg-6">
                                       <select class="form-control" name="type_id" id="type_id">
                                            <option value="0">Choose a Type</option>
                                            <?php foreach($ListType as $type){ ?>
                                            <option value="<?php echo $type['type_id'];?>" <?php if($type['type_id'] == $type_id) { echo "selected";} ?>> <?php echo $type['type_title']?> </option>
                                            <?php } ?>
                                          </select> 
                                        <span class="m-form__help">
                                                Please choose type
                                        </span>
                                </div>
                        </div>
                        
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Set vicible:
                                </label>
                                <div class="col-lg-6">  
                                    <select class="form-control" name="label_view" id="label_view">
                                       <option value="1" <?php if($label_view == 1) { echo "selected";} ?>>Show</option>
                                       <option value="0" <?php if($label_view == 0) { echo "selected";} ?>>Hide</option>
                                    </select>
                                </div>
                        </div>
                         <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Set View On:
                                </label>
                                <div class="col-lg-6">
                                    <span class="m-switch m-switch--icon">
                                    <label>
                                           <input type="checkbox" value="1" name="label_page" id="label_page"  checked/> 
                                            <span></span>
                                    </label>
                                    </span>     
                                </div>
                        </div>  
                        
                        
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Label Notif:
                                </label>
                                <div class="col-lg-6">
                                    <input name="label_notif" type="text" class="form-control m-input" placeholder="Label Notif" value="<?php if(!empty($label_notif)){echo $label_notif;} ?>">
                                    <span class="m-form__help">
                                            Please enter Label notif
                                    </span>
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