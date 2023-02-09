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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/general/doEdit/'.$rsGeneral[0]['general_id']; ?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Title</label>
                                      <div class="col-lg-4">
                                          <input name="generaltitle" type="text" class="form-control" placeholder="Title" value="<?php echo $rsGeneral[0]['general_title']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Desciption</label>
                                      <div class="col-lg-4">
                                          <input name="generaldescription" type="text" class="form-control" placeholder="Desciption" value="<?php echo $rsGeneral[0]['general_description']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Keywords</label>
                                      <div class="col-lg-4">
                                          <input name="generalkeywords" type="text" class="form-control" placeholder="Keywords" value="<?php echo $rsGeneral[0]['general_keyword']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Facebook</label>
                                      <div class="col-lg-4">
                                          <input name="generalfacebook" type="text" class="form-control" placeholder="Facebook" value="<?php echo $rsGeneral[0]['general_facebook']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Twitter</label>
                                      <div class="col-lg-4">
                                          <input name="generaltwitter" type="text" class="form-control" placeholder="Twitter" value="<?php echo $rsGeneral[0]['general_twitter']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Custumer Care Phone Number</label>
                                      <div class="col-lg-4">
                                          <input name="generalcsphonenumber" type="text" class="form-control" placeholder="Custumer Care Phone Number" value="<?php echo $rsGeneral[0]['general_cs_phonenumber']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Custumer Care Email</label>
                                      <div class="col-lg-4">
                                          <input name="generalcsemail" type="text" class="form-control" placeholder="Custumer Care Email" value="<?php echo $rsGeneral[0]['general_cs_email']; ?>">
									 </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/general'; ?>'">
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