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
							<div class="col-lg-12">
								<?php if($add){ ?>
									<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/banner/add/'">
								<?php } ?>
							</div>
							
						  </div>
						  
						  <form class="form-inline" role="form" method="post" name="frmSearch" action="<?php echo BASE_URL_BACKEND."/banner/view"; ?>">
						  <div class="panel-body">
							 <div class="col-lg-10">
								  <div class="form-group">
									  <select name="searchby" id="search-by" size="1" class="form-control">
										<option value="">Choose a search</option>
										<option value="banner_name" <?php if($searchby == "banner_name") { echo "selected"; }?> >Banner Name</option>
										<option value="banner_type" <?php if($searchby == "banner_type") { echo "selected"; }?> >Banner Type</option>
									</select>
								  </div>
								  <div class="form-group">
									  <input type="text" class="form-control" name="searchkey" placeholder="Keyword" value="<?php if(!empty($searchkey)){echo $searchkey;} ?>">
								  </div>
								  <input class="btn btn-success btn-sm" name="tbSearch" type="submit" value="Search">&nbsp;<label>Total : <?php echo $total;?></label>
							</div>
							<div class="col-lg-2" align="right">
								<div class="form-group">
									<select name="perpage" id="perpage" size="1" aria-controls="editable-sample" class="form-control xsmall">
										<option value="<?php echo PER_PAGE;?>" <?php if($perpage == "10") { echo "selected"; }?>><?php echo PER_PAGE;?></option>
										<option value="20" <?php if($perpage == "20") { echo "selected"; }?>>20</option>
										<option value="50" <?php if($perpage == "50") { echo "selected"; }?>>50</option>
										<option value="100" <?php if($perpage == "100") { echo "selected"; }?>>100</option>
									</select> 
								</div>
							</div>
                          </div>
						  </form>
						
                          <div class="panel-body">
                              <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                  <thead>
                                  <tr>
                                      <th width="5">No</th> 
                                      <th width="150">Name</th>
                                      <th width="120">Type</th>
									  <th width="80">Images</th>
									  <th width="120">URL</th>
									  <th width="80">Create Date</th>
                                      <th width="120">Action</th>
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
								  <?php } else {?>
								  <tr>
									<td align="center" colspan="10">Data Not Found</td>
								  </tr>
								  <?php } ?>
                                  </tbody>
                              </table>
                              </section>
                          </div>
						  <?php echo($paging); ?>
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
</body>
</html	