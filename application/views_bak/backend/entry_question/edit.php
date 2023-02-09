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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/entry_question/doEdit/'.$rsQuestion[0]['entry_question_id']; ?>" method="post" class="form-horizontal" role="form">
                                 <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>

								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Title</label>
                                      <div class="col-lg-4">
                                          <input name="entry_questiontitle" type="text" class="form-control" placeholder="Question Title" value="<?php echo $rsQuestion[0]['entry_question_title']; ?>">
									 </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Answer</label>
                                      <div class="col-lg-4">
                                          <?php foreach($rsAnswer as $key => $value){ ?>
                                          <div style="float:left;"><input name="entry_answer<?php echo $key+1; ?>" type="text" class="form-control" placeholder="Answer <?php echo $key+1; ?>" value="<?php echo $value['entry_answer_title']; ?>" style="width:290px;"></div>
                                          <div style="float:left; margin-left:20px;"><input name="entry_status<?php echo $key+1; ?>" type="text" class="form-control" value="<?php echo $value['entry_answer_status']; ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
                                          <div style="clear:both;"></div><br>
                                          <?php } ?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
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