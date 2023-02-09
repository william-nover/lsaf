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
                            <form name="form1" action="<?php echo BASE_URL_BACKEND.'/student_list/doEdit/'.$rsStudent[0]['student_id']; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
                                <div class="form-group has-error">
                                        <div class="col-lg-12">
                                              <label for="inputError" class="control-label"><?php echo $error;?></label>
                                        </div>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Student Name</label>
                                      <div class="col-lg-4">
                                          <input name="student_name" type="text" class="form-control" readonly="true" placeholder="Menu Title" value="<?php echo $rsStudent[0]['full_name']; ?>">
                                        <input name="student_nameOld" type="hidden" value="<?php echo $rsStudent[0]['student_name']; ?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Student PID</label>
                                      <div class="col-lg-4">
                                        <input name="student_pid" type="text" class="form-control" placeholder="Student PID" value="<?php echo $rsStudent[0]['student_pid']; ?>">       
                                    </div>
                                </div>                          
				<div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label"> Module Name </label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="module_level_id" id="module_level_id">                                            
                                            <?php foreach($moduleLevel as $gl){ ?>
                                                    <option value="<?php echo $gl->module_level_id;?>" <?php if($gl->module_level_id ==  $rsStudent[0]['module_level_id']) { echo "selected";} ?>> <?php echo $gl->module_level_title;?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                 </div> 
                                  </div>
                                <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/student_list'; ?>'">
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