
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
                        </div>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <section id="unseen">
                         <form name="formAssignment" method="POST" action="" onsubmit="return false;">
                             <table class="m-datatable" id="html_table" width="100%">
                                 <thead>
                                    <tr>
                                      <th width="5">No</th>
                                      <th>From</th>  
                                      <th>Name</th>       
                                      <th>Email</th>
                                      <th>Message</th> 
                                      <th class="no-sort">Action</th>
                                  </tr>
                                 </thead>
                                 <tbody>
                                  
                                  <?php
                                    if(count($ListContactus) > 0){
                                    $no=0;
                                    foreach($ListContactus as $contactus){
                                            $no++;
                                    ?>
                                    <tr>
                                      <td width="5"><?php echo $no;?></td>
                                     <td><?php echo $contactus['contactus_from'];?></td>
                                      <td><?php echo $contactus['contactus_name'];?></td>
                                      <td><?php echo $contactus['contactus_email'];?></td>
                                       <td>
                                          <a href="#" class="btn-outline-primary btn-sm"  data-toggle="modal" data-target="#m_modal_<?php echo $contactus['contactus_id'];?>">
                                               <i class="la la-envelope"></i>
                                            </a> 
                                       </td>
                                       <div class="modal fade" id="m_modal_<?php echo $contactus['contactus_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">
											<?php echo $contactus['contactus_subject'];?> / <?php echo date_convert($contactus['contactus_date']) ;?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
										</button>
									</div>
                                                                    <div class="modal-body">      
                                                                      <?php echo html_entity_decode($contactus['contactus_message']);?>                                                             
                                                                    </div>
									
								</div>
							</div>
						</div> 
                                       <td>
                                             <?php if($delete){ ?>
                                                    <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $contactus['contactus_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;?>/delete/<?php echo $contactus['contactus_id'];?>';}"><span class="la la-trash"></span></a> &nbsp;
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
			frm.action = '<?php echo BASE_URL_BACKEND;?>/blog/doOrder';
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