
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
                        <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> - Edit
                     </h3>
                  </div>
               </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-portlet">
                
                <!--begin::Form-->
                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/banner/doEdit/'.$rsBanner[0]['banner_id']; ?>" method="post" role="form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
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
                                      Banner Name:
                                </label>
                                <div class="col-lg-6">
                                   <input name="bannername" type="text" class="form-control" placeholder="Banner Name" value="<?php echo $rsBanner[0]['banner_name']; ?>">
                                    <input name="bannernameOld" type="hidden" value="<?php echo $rsBanner[0]['banner_name']; ?>">
                                    <span class="m-form__help">
                                            Please enter Banner name
                                    </span>
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Type :
                                </label>
                                <div class="col-lg-6">
                                      <select name="bannertype" id="bannertypeid" class="form-control" style="width:auto;">
                                                <option value="0">Choose a banner type</option>
                                                <option value="1" <?php if($rsBanner[0]['banner_type'] == 1) { echo "selected"; }?>>Home</option>
                                                <option value="2" <?php if($rsBanner[0]['banner_type'] == 2) { echo "selected"; }?>>Midle Slide</option>
                                                <p class="help-block" style="color:#00F;">width and height optimal is 1600px x 680px</p>
                                    </select>
                                </div>
                        </div> 
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Banner Images :
                                </label>
                                    <?php
                                        $banner_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$rsBanner[0]['banner_images']);
                                        $banner_image = BASE_URL.$rsBanner[0]['banner_images'];
                                        ?>
                                    <div class="col-lg-8">
                                          <div style="margin-bottom:10px;" class="imageurl"><img src="<?php echo $banner_image; ?>" style="max-width:400px; padding:5px; border:solid 1px #ccc;"></div>
                                          <input type="text" name="bannersimageurl" readonly="readonly" id="imageurl" class="form-control" value="<?php echo $banner_image ?>">
                                          <div style="margin-right:10px;">
                                                        <a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
                                                        <a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
                                          </div>
                                          <p class="help-block" style="color:#00F;">width and height optimal is 1600px x 680px</p>
                                  </div>
                        </div> 
                        <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Banner Desc:
                                </label>
                                <div class="col-lg-10">
                                    <textarea id="bannerdesc" name="bannerdesc" class="form-control ckeditor" placeholder="Content Description" rows="7"><?php echo $rsBanner[0]['banner_desc']; ?></textarea>
                                        <script>
                                        CKEDITOR.replace( 'IDbannerdesc', {
                                             
                                                width : 900,
                                                height: 300,
                                                bannersCss : ["<?php echo CSS_BASE_URL;?>/style.css"]
                                        });
                                        </script>
                                </div>
                        </div>
                     <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Banner URL:
                                </label>
                                <div class="col-lg-6">
                                    <input name="bannerurl" type="text" class="form-control" placeholder="Banner URL" value="<?php echo $rsBanner[0]['banner_url']; ?>">
                                    <span class="m-form__help">
                                            Please enter Banner url
                                    </span>
                                </div>
                        </div>
                            <input name="bannerstatus" type="hidden" class="form-control" placeholder="Banner Name" value="<?php echo $rsBanner[0]['banner_active_status']; ?>"> 
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-6">
                                                    <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Edit">&nbsp;
                                                    <input name="cancel" class="btn btn-danger btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/banner'; ?>'">                                                      
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