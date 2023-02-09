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
                              <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> - Edit
                          </header>
                          <div class="panel-body">
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/banner/doEdit/'.$rsBanner[0]['banner_id']; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Banner Title</label>
                                      <div class="col-lg-4">
                                          <input name="bannername" type="text" class="form-control" placeholder="Banner Name" value="<?php echo $rsBanner[0]['banner_name']; ?>">
										  <input name="bannernameOld" type="hidden" value="<?php echo $rsBanner[0]['banner_name']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Banner Type</label>
                                      <div class="col-lg-4">
                                          <select name="bannertype" id="bannertypeid" class="form-control" style="width:auto;">
											<option value="0">Choose a banner type</option>
											<option value="1" <?php if($rsBanner[0]['banner_type'] == 1) { echo "selected"; }?>>Home</option>
											<option value="2" <?php if($rsBanner[0]['banner_type'] == 2) { echo "selected"; }?>>Midle Slide</option>
											
										  </select>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Banner Images</label>
									  <?php
										$banner_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$rsBanner[0]['banner_images']);
										$banner_image = BASE_URL.$rsBanner[0]['banner_images'];
										?>
                                      <div class="col-lg-4">
										  <div style="margin-bottom:10px;" class="imageurl"><img src="<?php echo $banner_image; ?>" style="max-width:400px; padding:5px; border:solid 1px #ccc;"></div>
										  <input type="text" name="bannersimageurl" readonly="readonly" id="imageurl" class="form-control" value="<?php echo $banner_image ?>">
										  <div style="margin-right:10px;">
												<a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
												<a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
										  </div>
										<p class="help-block" style="color:#00F;">width and height optimal is 1000 x 400px (Home) & 200 x 250px(Midle) </p>
									  </div>
                                  </div>
                                    <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Banner URL</label>
                                      <div class="col-lg-4">
                                          <input name="bannerurl" type="text" class="form-control" placeholder="Banner URL" value="<?php echo $rsBanner[0]['banner_url']; ?>">
                                    </div>
                                  </div>
                                                              <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Banner Description</label>
                                      <div class="col-lg-10">
										  <textarea id="bannerdesc" name="bannerdesc" class="form-control ckeditor" placeholder="Content Description" rows="7"><?php echo $rsBanner[0]['banner_desc']; ?></textarea>
											<script>
												CKEDITOR.replace( 'bannerdesc', {
													
													width : 900,
													height: 300,
													contentsCss : ["<?php echo CSS_BASE_URL;?>/style.css"]
												});
											</script>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/banner'; ?>'">
                                      </div>
                                  </div>
                              </form>
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
</body>
</html	