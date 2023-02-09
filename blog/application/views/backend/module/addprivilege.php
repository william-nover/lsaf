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
                        Add -  Privilege || <?php echo $modulename;?>
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet m-portlet--mobile">
                     <div class="m-portlet__body">
                         <form name="form1" action="<?php echo BASE_URL_BACKEND.'/module/doAddmoduleprivilege'; ?>" method="post" class="form-horizontal" role="form">
                           <?php if(isset($error)){ ?>
                           <div class="form-group has-error">
                              <div class="col-lg-12">
                                 <label for="inputError" class="control-label"><?php echo $error;?></label>
                              </div>
                           </div>
                           <?php } ?>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                       Module Path:
                                </label>
                                <div class="col-lg-6">
                                <input name="modulename" readonly type="text" class="form-control m-input" placeholder="Module Name" value="<?php echo $modulename;?>">
                                 <input name="moduleid" type="hidden" value="<?php echo $id;?>">      
                                </div>
                            </div>  
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Check  All
                                </label>
                                <div class="col-lg-6">
                                 <span class="m-switch m-switch--icon">
                                    <label>
                                           <input type="checkbox" name="checkedAll" id="checkedAll" /> 
                                            <span></span>
                                    </label>
                                           
                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Privilege Name
                                </label>
                                <div class="col-lg-6">
                                 <?php foreach($ListPrivilege as $privilege){ ?>
                                    <span class="m-switch m-switch--icon">
                                            <label>
                                                    <?php echo $privilege['privilege_name'];?>
                                                    <input class="checkSingle" type="checkbox" name="privilegeid[]" id="inlineCheckbox1" value="<?php echo $privilege['privilege_id'];?>">
                                                    <span></span>
                                            </label>
                                    </span>
                                    <br/>
                                 <?php } ?>
                                </div>
                            </div>
                             
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-6">
                                                <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                                <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/module/listmoduleprivilege/'.$id; ?>'">    
                                                </div>
                                        </div>
                                </div>
                            </div>
                         
                        </form>
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
 <script type="text/javascript">
  $(document).ready(function() {
  $("#checkedAll").change(function(){
    if(this.checked){
      $(".checkSingle").each(function(){
        this.checked=true;
      });              
    }else{
      $(".checkSingle").each(function(){
        this.checked=false;
      });             
    }
  });

  $(".checkSingle").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".checkSingle").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }     
    }else {
      $("#checkedAll").prop("checked", false);
    }
  });
});
  </script>
</body>
<!-- end::Body -->
</html>