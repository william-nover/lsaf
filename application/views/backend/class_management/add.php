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
                              <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> - Add
                          </header>
                          <div class="panel-body">
                            <form name="form1" action="<?php echo BASE_URL_BACKEND.'/class_management/doAdd'; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
                                <div class="form-group has-error">
                                        <div class="col-lg-12">
                                              <label for="inputError" class="control-label"><?php echo $error;?></label>
                                        </div>
                                </div>
                                <?php } ?>
                                
                                <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label"> Student Name</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="student_id" id="student_id">                                            
                                            <?php  foreach($getStudent as $gst){ ?>
                                                    <option value="<?php echo $gst->student_id;?>"> <?php echo $gst->full_name;?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                 </div> 
                                <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label"> Subject Title </label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="subject_id" id="subject_id">                                            
                                            <?php foreach($getSubject as $gs){ ?>
                                                    <option value="<?php echo $gs->subject_id;?>"> <?php echo $gs->subject_title;?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                 </div> 
                              
                                 <div class="form-group">
                                    <label for="dtp_input2" class="col-md-2 control-label">Start Date</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="" >
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" name="class_management_start_date" value="" /><br/>
                                </div>
                                <div class="form-group">
                                    <label for="dtp_input2" class="col-md-2 control-label">End Date</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="" >
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="dtp_input2" name="class_management_end_date" value="" /><br/>
                                </div>
                                 
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                        <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                        <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/module_lectures'; ?>'">
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
    <!--date pic-->
    <link href="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/sample/bootstrap/css/bootstrap_icon.css" rel="stylesheet" type="text/css">
    <link href="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    
    <script src="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
   <script type="text/javascript">

	$('.form_date').datetimepicker({        
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

</script>
    <!--common script for all pages-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
</body>
</html	