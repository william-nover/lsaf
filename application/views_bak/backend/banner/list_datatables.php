<script language="javascript">
	$(document).ready(function() {
		$("#perpage").change(function() {
			var n = $(this).val();
			frmSearch.submit();
		});
	});
</script>
<body>
	<section id="container" class="">
      <?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
	  
	  <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>

	   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> - List
                          </header>
						  <?php if(isset($error)){ ?>
						  <div class="panel-body">
							  <div class="form-group has-error">
								  <label for="inputError" class="col-sm-2 control-label col-lg-2"><?php echo $error;?></label>
							  </div>
						  </div>
						  <?php } ?>
						  
						  <div class="panel-body">
							  <div class="clearfix">
								  <div class="btn-group">
									  <?php if($add){ ?>
									  <button class="btn btn-primary btn-sm" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/banner/add/'">
										  Add
									  </button>
									  <?php } ?>
								  </div>
								  <div class="btn-group pull-right">
									  <!--<button class="btn btn-primary btn-sm"" data-toggle="dropdown">Tools</i>
									  </button>
									  <ul class="dropdown-menu pull-right">
										  <li><a href="#">Print</a></li>
										  <li><a href="#">Save as PDF</a></li>
										  <li><a href="#">Export to Excel</a></li>
									  </ul>-->
								  </div>
							  </div>
							  <div class="adv-table">
								<table class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th width="5">No</th> 
										  <th>Name</th>
                                          <th width="70">Type</th>
                                          <th width="70">Images</th>
                                          <th width="120">URL</th>
                                          <th width="70">Create Date</th>
										  <th width="150">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
									  <?php
										$no=0;
										foreach($ListBanner as $banner){
											$no++;
									  ?>
									  <tr class="gradeX">
                                          <td><?php echo $no;?></td>
										  <td><?php echo $banner['banner_name'];?></td>
                                          <td>
										  <?php 
										  if($banner['banner_type']==1){
											echo "Home";
										  } else if($banner['banner_type']==2){
											echo "Pricing";
										  } else if($banner['banner_type']==3){
											echo "Service Retina";
										  } else if($banner['banner_type']==4){
											echo "Service Cataract";
										  } else if($banner['banner_type']==5){
											echo "Service LASIK";
										  } else if($banner['banner_type']==6){
											echo "Promo Cataract";
										  } else if($banner['banner_type']==7){
											echo "Promo LASIK";
										  } else if($banner['banner_type']==8){
											echo "Service Cost LASIK";
										  }
										  ?>
										  
										  (<?php echo $banner['banner_type'];?>)
										  </td>
                                          <td><?php 
											$banner_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$banner['banner_images']);
											$banner_image = BASE_URL.$banner['banner_images'];
											?>
											<a id="viewBackend" href="#viewDataImage<?php echo $banner['banner_id'];?>">
												<img src="<?php echo $banner_image_thumbs;?>">
											</a>
											<div style="display: none;">
												<div id="viewDataImage<?php echo $banner['banner_id'];?>">
													<img src="<?php echo $banner_image;?>" >
												</div>
											</div>
										  </td>
                                          <td><?php echo $banner['banner_url'];?></td>
										  <td><?php echo $banner['banner_create_date'];?></td>
										  <td>
												<?php if($approve){ ?>
													<?php if($banner['banner_active_status'] == 1) {?>
														<a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/banner/active/".$banner['banner_id'];?>"><i class="icon-ok"></i></a> &nbsp; 
													<?php } else { ?>
														<a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/banner/active/".$banner['banner_id'];?>"><i class="icon-remove"></i></a> &nbsp;
													<?php } ?>
												<?php } ?>
												<?php if($edit){ ?>
													<a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND;?>/banner/edit/<?php echo $banner['banner_id'];?>"><i class="icon-pencil"></i></a> &nbsp; 
												<?php } ?>
												<?php if($delete){ ?>
													<a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $banner['banner_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/banner/delete/<?php echo $banner['banner_id'];?>';}"><span class="icon-trash"></span></a> &nbsp;
												<?php } ?>
										  </td>
                                      </tr>
									   <?php } ?>
									  </tbody>
								</table>
							  </div>
                          </div>
						  
					  </section>
                  </div>
              </div>
              <!-- page end-->		 
          </section>
      </section>
      <!--main content end-->
	  
	  <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>

	</section>
	
	<!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
	
	<!-- fancybox -->
	<script src="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.js"></script>
	<link href="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		//fancybox
		jQuery("a#viewBackend").fancybox({
			'overlayShow'		: true,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'width'				: '100%',
			'height'			: '100%'
		});
	});
	</script>
	<!-- end fancybox -->
	
	<link href="<?php echo TOOLS_BASE_URL; ?>/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo TOOLS_BASE_URL; ?>/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
	<script type="text/javascript" language="javascript" src="<?php echo TOOLS_BASE_URL; ?>/advanced-datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo TOOLS_BASE_URL; ?>/data-tables/DT_bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8">
	  $(document).ready(function() {
		  $('#example').dataTable( {
			   "aaSorting":[[0, "asc"]],
			   "sPaginationType": "bootstrap",
			   "iDisplayLength": 10,
			   "aLengthMenu": [
                    [10, 50, 100, -1],
                    [10, 50, 100, "All"] // change per page values here
                ],
		  } );
	  } );
  </script>
</body>
</html	