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
                  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/category/doEdit/'.$rsCategory[0]['category_id']; ?>" method="post" class="form-horizontal" role="form">
                     <div class="m-portlet__body">
                        <?php if(isset($error)){ ?>
                        <div class="form-group has-error">
                           <div class="col-lg-12">
                              <label for="inputError" class="control-label"><?php echo $error;?></label>
                           </div>
                        </div>
                        <?php } ?>
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">Category Title</label>
                           <div class="col-lg-6">
                              <input name="categorytitle" type="text" class="form-control" placeholder="Category Title" value="<?php echo $rsCategory[0]['category_title']; ?>">
                              <input name="categorytitleOld" type="hidden" value="<?php echo $rsCategory[0]['category_title']; ?>">
                              <span class="m-form__help">
                              Please enter Category Title
                              </span>
                           </div>
                        </div>
                         <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                      Category Images :
                                </label>
                       
                                <div class="col-lg-6">
                                     <?php
                                        $category_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$rsCategory[0]['category_image']);
                                        $category_image = BASE_URL.$rsCategory[0]['category_image'];
                                        ?>
                                    <div style="margin-bottom:10px;" class="imageurl">
                                    <img id="imgurl" src="<?php echo $category_image_thumbs; ?>" style="max-width:400px; padding:5px; border:solid 1px #ccc;">                                   
                                    </div>
                                    <input type="text" name="categoryimageurl" id="imageurl" class="form-control" value="<?php echo $category_image ?>" onchange="setVal(this);">
                                    <div style="margin-right:10px;">
                                         <a data-toggle="modal"  href="javascript:;" data-target="#Modalimageurl" onClick="openKCFinder('categoryimageurl');" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x" id="link-file" class="link"><i class="flaticon-attachment"></i></a>
                                        <a class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x" onClick="reset_value('imageurl');" id="link-file" class="link"><i class="fa fa-refresh"></i></a>
                                     </div>
                                    <span class="m-form__help" style="color:#00F;">
                                        width and height optimal is 600px x 400px (main) 400px x 400px (sub) 
                                    </span>
                                </div>
                        </div> 
                         <script>
                        function setVal(sel)
                            {
                                var url =sel.value;
                                 //alert(url);
                                setTimeout(function(){
                                $("#imgurl").attr("src", url);
                                }, 100);

                              }
                        </script>
                        <div class="modal fade" id="Modalimageurl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                        &times;
                                                                </span>
                                                        </button>
                                                </div>
                                            <div class="modal-body">
                                    <iframe class="filemanager" src="<?=TOOLS_BASE_URL;?>/filemanager/dialog.php?type=1&field_id=imageurl&akey=2063c1608d6e0baf80249c42e2be5804&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                                        </div>
                                        </div>
                                </div>
                        </div>
                   
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label"> Category </label>
                           <div class="col-lg-6">
                               <select class="form-control m-input" name="category_type_id" id="category_type_id" required="">
                                  <option value="">Select Category</option>
                                 <?php foreach($Cate_type as $type){ ?>
                                 <option value="<?php echo $type['category_type_id'];?>"> <?php echo $type['category_type_title'];?> </option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        
                        <div class="form-group m-form__group row id_child" style="display: none ">
                           <label class="col-lg-2 col-form-label">Category Sub Parent</label>
                           <div class="col-lg-6">
                              <select class="form-control m-input" name="categorysubparent" id="categorysubparent">
                                 <option value="0">Sub Menu</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group m-form__group row">
                           <label class="col-lg-2 col-form-label">Category URL</label>
                           <div class="col-lg-6">
                              <input name="categoryurl" type="text" class="form-control" placeholder="Category URL" value="<?php echo $rsCategory[0]['category_url']; ?>">
                              <span class="m-form__help">
                              Category URL
                              </span>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-offset-2 col-lg-10">
                              <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                              <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/category'; ?>'">
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
  
   
</body>
<!-- end::Body -->
</html>