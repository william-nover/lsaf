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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/lecturer/doEdit/'.$rsLecturer[0]['lecturer_id']; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
                                <div class="form-group has-error">
                                        <div class="col-lg-12">
                                              <label for="inputError" class="control-label"><?php echo $error;?></label>
                                        </div>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Lecturer Name</label>
                                      <div class="col-lg-4">
                                        <input name="lecturer_name" type="text" class="form-control" placeholder="Menu Title" value="<?php echo $rsLecturer[0]['lecturer_name']; ?>">
                                        <input name="lecturer_nameOld" type="hidden" value="<?php echo $rsLecturer[0]['lecturer_name']; ?>">
                                </div>
                                  </div>
                                 <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label"> Gender </label>
                                      <div class="col-lg-6">
                                          <input type="radio" name="lecturer_gender" value="1" <?php if ($rsLecturer[0]['lecturer_gender']==1){echo 'checked="true"';} ;?>/>Male &nbsp;&nbsp;&nbsp;
                                          <input type="radio" name="lecturer_gender" value="2" <?php if ($rsLecturer[0]['lecturer_gender']==2){echo 'checked="true"';} ;?>/>Female
                                      </div>
                                 </div>                            
                                <div class="form-group">
                                      <label for="email" class="col-lg-2 col-sm-2 control-label"> Email</label>
                                      <div class="col-lg-4">
                                          <input name="lecturer_email" type="email" class="form-control" placeholder="email" value="<?php echo $rsLecturer[0]['lecturer_email']; ?>">
                                        </div>
                                </div>
                                <div class="form-group">
                                      <label for="address" class="col-lg-2 col-sm-2 control-label"> Address</label>
                                      <div class="col-lg-4">
                                          <textarea name="lecturer_address" class="form-control"><?php echo $rsLecturer[0]['lecturer_address']; ?></textarea> 
                                      </div>
                                </div>                             
				
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                        <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                        <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/lecturer'; ?>'">
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