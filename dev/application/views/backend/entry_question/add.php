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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/entry_question/doAdd'; ?>" method="post" class="form-horizontal" role="form">
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
										  <select class="form-control" tabindex="1" name="entry_groupid" style="width:400px;">
										  <option value="0">- Please Choose Group -</option>
												<?php if($countGroup > 0){?>
												<?php foreach($rsGroup as $group){ ?>
												<option value="<?php echo $group['entry_group_id'];?>" <?php if($group['entry_group_id'] == $entry_groupid) { echo "selected";} ?>> <?php echo $group['entry_group_title']?> </option>
												<?php } ?>
												<?php } ?>
										  </select>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Title</label>
                                      <div class="col-lg-4">
                                          <input name="entry_questiontitle" type="text" class="form-control" placeholder="Question Title" value="<?php if(!empty($entry_questiontitle)){echo $entry_questiontitle;} ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Answer</label>
                                      <div class="col-lg-4">
                                          <div style="float:left;"><input name="entry_answer1" type="text" class="form-control" placeholder="Answer 1" value="<?php if(!empty($entry_answer1)){echo $entry_answer1;} ?>" style="width:290px;"></div>
                                          <div style="float:left; margin-left:20px;"><input name="entry_status1" type="text" class="form-control" value="<?php if(!empty($entry_status1)){echo $entry_status1;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
                                          <div style="clear:both;"></div><br>
                                          <div style="float:left;"><input name="entry_answer2" type="text" class="form-control" placeholder="Answer 2" value="<?php if(!empty($entry_answer2)){echo $entry_answer2;} ?>" style="width:290px;"></div>
                                          <div style="float:left; margin-left:20px;"><input name="entry_status2" type="text" class="form-control" value="<?php if(!empty($entry_status2)){echo $entry_status2;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
                                          <div style="clear:both;"></div><br>
                                          <div style="float:left;"><input name="entry_answer3" type="text" class="form-control" placeholder="Answer 3" value="<?php if(!empty($entry_answer3)){echo $entry_answer3;} ?>" style="width:290px;"></div>
                                          <div style="float:left; margin-left:20px;"><input name="entry_status3" type="text" class="form-control" value="<?php if(!empty($entry_status3)){echo $entry_status3;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
                                          <div style="clear:both;"></div><br>
                                          <div style="float:left;"><input name="entry_answer4" type="text" class="form-control" placeholder="Answer 4" value="<?php if(!empty($entry_answer4)){echo $entry_answer4;} ?>" style="width:290px;"></div>
                                          <div style="float:left; margin-left:20px;"><input name="entry_status4" type="text" class="form-control" value="<?php if(!empty($entry_status4)){echo $entry_status4;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
                                          <div style="clear:both;"></div><br>
										   
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/entry_question'; ?>'">
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