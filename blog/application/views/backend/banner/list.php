
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
                     <h4 class="m-subheader__title m-subheader__title--separator">
                        <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> - List
                     </h4>
                  </div>
               </div>
            </div>
            <?php if(isset($error)){ ?>
            <div class="panel-body">
                    <div class="form-group has-error">
                            <label for="inputError" class="col-sm-2 control-label col-lg-2"><?php echo $error;?></label>
                    </div>
            </div>
            <?php } ?>
            <!-- END: Subheader -->
            <div class="m-content">
               <div class="m-portlet m-portlet--mobile">
                  <div class="m-portlet__body">
                     <!--begin: Search Form -->
                     <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                           <div class="col-xl-8 order-2 order-xl-1">
                              <div class="form-group m-form__group row align-items-center">
                                
                                 <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                       <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                       <span class="m-input-icon__icon m-input-icon__icon--left">
                                       <span>
                                       <i class="la la-search"></i>
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 order-1 order-xl-4 m--align-right">
                             <a href="<?php echo BASE_URL_BACKEND;?>/banner/add/" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                                    <span> <i class="fa fa-plus"></i> <span> ADD</span>
                                    </span>
                            </a>
                             <button id="doOrder" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                                    <span> <i class="fa fa-repeat"></i> <span> Order</span>
                                    </span>
                            </button>
                            </div>
                            
                        </div>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <section id="unseen">
                         <form name="formAssignment" method="POST" action="" onsubmit="return false;">
                            <table class="m-datatable" id="html_table" width="100%">
                                  <thead>
                                  <tr>
                                   <th>No</th> 
                                    <th>Name</th>
                                    <th>Types</th>
                                    <th>Images</th>
                                    <th>Order</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                  </tr>
                                  </thead>
                              <tbody>
                                   <?php
                                    if(count($ListBanner) > 0){
                                    $no=0;
                                    foreach($ListBanner as $banner){
                                            $no++;
                                    ?>
                                    <tr>
                                      <td><?php echo $no;?></td>
                                      <td><?php echo $banner['banner_name'];?></td>
                                      <td>
                                      <?php 
                                      if($banner['banner_type']==1){
                                            echo "Home";
                                      } else if($banner['banner_type']==2){
                                            echo "Pricing";
                                      }
                                      ?>

                                      (<?php echo $banner['banner_type'];?>)
                                      </td>
                                      <td><?php 
                                            $banner_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$banner['banner_images']);
                                            $banner_image = BASE_URL.$banner['banner_images'];
                                            ?>
                                          <a href="#" data-toggle="modal" data-target="#m_modal_<?php echo $banner['banner_id'];?>">
                                              <img src="<?php echo $banner_image_thumbs;?>" class="img-thumbnail">
                                            </a>
                                            </td>
                                            <div class="modal fade" id="m_modal_<?php echo $banner['banner_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">
											<?php echo $banner['banner_name'];?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
										</button>
									</div>
                                                                    <div class="modal-body">      
                                                                    <img src="<?php echo $banner_image;?>" class="img-fluid img-responsive" alt="<?php echo $banner['banner_name'];?>">                                                                 
                                                                    </div>
									
								</div>
							</div>
						</div>
                                     <?php if($order){ ?>
                                            <td align="center"><input type="text" class="form-control" style="text-align:center;" name="order[<?php echo $banner['banner_id'];?>]" size="1" maxlength="2" value="<?php echo $banner['banner_order'];?>"></td>
                                      <?php } ?>
                                            <td><?php echo $banner['banner_url'];?></td>
                                             <td>
                                                    <?php if($approve){ ?>
                                                            <?php if($banner['banner_active_status'] == 1) {?>
                                                                    <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/banner/active/".$banner['banner_id'];?>"><i class="la la-check-circle"></i></a> 
                                                            <?php } else { ?>
                                                                    <a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/banner/active/".$banner['banner_id'];?>"><i class="la la-power-off"></i></a>
                                                            <?php } ?>
                                                    <?php } ?>
                                                    <?php if($edit){ ?>
                                                            <a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND;?>/banner/edit/<?php echo $banner['banner_id'];?>"><i class="la la-edit"></i></a>
                                                    <?php } ?>
                                                    <?php if($delete){ ?>
                                                            <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $banner['banner_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/banner/delete/<?php echo $banner['banner_id'];?>';}"><span class="la la-trash"></span></a>
                                                    <?php } ?>
                                            </td>
                                        </tr>
                                                
                                        <?php } ?>
                                        <?php } else {?>
                                        <tr>
                                              <td align="center" colspan="10">Data Not Found</td>
                                        </tr>
                                        <?php } ?>
                                  </tbody>
                                  
                           </table>
                            </form>
                        </section>
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