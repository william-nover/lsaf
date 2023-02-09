<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
   <!-- begin:: Page -->
   <div class="m-grid m-grid--hor m-grid--root m-page">
      <?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
         <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>	
         <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
               <div class="d-flex align-items-center">
                  <div class="mr-auto">
                     <h3 class="m-subheader__title m-subheader__title--separator">
                        <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> -  ADD
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
               <div class="m-portlet">
                  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/menu_frontend/doAdd'; ?>" method="post" class="form-horizontal" role="form">
                     <div class="m-portlet__body">
                        <?php if(isset($error)){ ?>
                        <div class="form-group has-error">
                           <div class="col-lg-12">
                              <label for="inputError" class="col-form-label"><?php echo $error;?></label>
                           </div>
                        </div>
                        <?php } ?>
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">Menu Title</label>
                           <div class="col-lg-6">
                              <input name="menutitle" type="text" class="form-control m-input" placeholder="Menu Title" value="<?php if(!empty($menutitle)){echo $menutitle;} ?>">
                              <span class="m-form__help">
                              Please enter Menu Title
                              </span>
                           </div>
                        </div>
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label"> Module </label>
                           <div class="col-lg-6">
                              <select class="form-control m-input" name="module_id" id="module_id">
                                 <?php foreach($Module as $Modul){ ?>
                                 <option value="<?php echo $Modul->module_id;?>" <?php if($Modul->module_id == $modul_id) { echo "selected";} ?>> <?php echo $Modul->module_name;?> </option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">Menu Parent</label>
                           <div class="col-lg-6">
                              <select class="form-control m-input" name="menuparent" id="menuparent">
                                 <option value="0">Parent Menu</option>
                                 <?php foreach($MenuParent as $parent){ ?>
                                 <option value="<?php echo $parent['menu_id'];?>" <?php if($parent['menu_id'] == $menuparent) { echo "selected";} ?>> <?php echo $parent['menu_title']?> </option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <script language="javascript">
                           $(document).ready(function(){      
                           
                           $('#menuparent').change(function(){
                           
                                var id_menu = $('#menuparent').val();
                           
                                //alert(id_menu);
                           
                              if(id_menu == 0) {
                           
                           
                           
                                  $(".id_child").hide();
                           
                              }
                           
                              else{
                           
                                 $.post("<?php echo BASE_URL_BACKEND.'/menu_frontend/getParent';?>/"+id_menu+"",
                           
                               function(obj){
                           
                                   $(".id_child").show();                   
                           
                                   $('#menusubparent').html(obj);
                           
                               });  
                           
                              }
                           
                           
                           
                           });
                           
                           });
                           
                        </script>
                        <div class="form-group m-form__group row id_child" style="display: none">
                           <label class="col-lg-2 col-form-label">Menu Sub Parent</label>
                           <div class="col-lg-6">
                              <select class="form-control m-input" name="menusubparent" id="menusubparent">
                                 <option value="0">Sub Menu</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group m-form__group row">
                           <label for="inputEmail1" class="col-lg-2 col-form-label">Menu URL</label>
                           <div class="col-lg-6">
                              <input name="menuurl" type="text" class="form-control m-input" placeholder="Menu URL" value="<?php if(!empty($menuurl)){echo $menuurl;} ?>">
                              <span class="m-form__help">
                              Please enter menu url
                              </span>
                           </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                           <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                 <div class="col-lg-2"></div>
                                 <div class="col-lg-6">
                                    <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                    <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/menu_frontend'; ?>'">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
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
   <script language="javascript">
      $(document).ready(function(){
      $("#doOrder").click(function() {
         var frm = document.formAssignment;
      var answer = confirm('are you sure want to update order?');
      if(answer){
      frm.action = '<?php echo BASE_URL_BACKEND;?>/banner/doOrder';
      frm.submit();
      } else {
      return false;
      }
      });
      });
   </script>
</body>
<!-- end::Body -->
</html>