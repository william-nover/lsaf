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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/progress_exam_group/doEdit/'.$rsGroup[0]['progress_exam_group_id']; ?>" method="post" class="form-horizontal" role="form">
                                 <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>

								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Group Title</label>
                                      <div class="col-lg-4">
                                          <input name="progress_exam_grouptitle" type="text" class="form-control" placeholder="Group Title" value="<?php echo $rsGroup[0]['progress_exam_group_title']; ?>">
                                          <input name="progress_exam_grouptitleOld" type="hidden" class="form-control" placeholder="Group Title" value="<?php echo $rsGroup[0]['progress_exam_group_title']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Subject</label>
                                      <div class="col-lg-4">
										  <select class="form-control" tabindex="1" name="subject_id" style="width:400px;">
										  <option value="0">- Please Choose Subject -</option>
												<?php if($countSubject > 0){?>
												<?php foreach($rsSubject as $subject){ ?>
												<option value="<?php echo $subject['subject_id'];?>" <?php if($subject['subject_id'] == $rsGroup[0]['subject_id']) { echo "selected";} ?>> <?php echo $subject['subject_title']?> </option>
												<?php } ?>
												<?php } ?>
										  </select>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Start Date</label>
                                      <div class="col-lg-4">
                                          <input name="progress_exam_groupstart" id="progress_exam_groupstart" type="text" class="form-control" readonly placeholder="Start Date" value="<?php echo $rsGroup[0]['progress_exam_group_start']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Start End</label>
                                      <div class="col-lg-4">
                                          <input name="progress_exam_groupend" id="progress_exam_groupend" type="text" class="form-control" readonly placeholder="End Date" value="<?php echo $rsGroup[0]['progress_exam_group_end']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Group Timer</label>
                                      <div class="col-lg-4">
                                          <input name="progress_exam_grouptimer" type="text" class="form-control" placeholder="Group Timer" value="<?php echo $rsGroup[0]['progress_exam_group_timer']; ?>">
										  <p class="help-block" style="color:#00F;">in seconds</p>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Group Timer Essay</label>
                                      <div class="col-lg-4">
                                          <input name="progress_exam_grouptimeressay" type="text" class="form-control" placeholder="Group Timer Essay" value="<?php echo $rsGroup[0]['progress_exam_group_timer_essay']; ?>">
										  <p class="help-block" style="color:#00F;">in seconds</p>
									  </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/progress_exam_group'; ?>'">
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
	
	<script src="<?php echo JS_BASE_URL;?>/jquery-ui-1.9.1.min.js"></script>
	<link href="<?php echo CSS_BASE_URL;?>/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script>
		$(function() {
			$("#progress_exam_groupstart").datepicker({
				numberOfMonths: 2,
				dateFormat: 'yy-mm-dd',
				onSelect: function(selected) {
				  $("#progress_exam_groupend").datepicker("option","minDate", selected)
				}
			});
			$("#progress_exam_groupend").datepicker({ 
				numberOfMonths: 2,
				dateFormat: 'yy-mm-dd',
				onSelect: function(selected) {
				   $("#progress_exam_groupstart").datepicker("option","maxDate", selected)
				}
			});  
		});
	</script>
</body>
</html	