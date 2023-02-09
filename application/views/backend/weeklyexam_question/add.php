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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/weekly_exam_question/doAdd'; ?>" method="post" class="form-horizontal" role="form">
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
										  <select class="form-control" tabindex="1" name="weekly_exam_group_id" style="width:400px;">
										  <option value="0">- Please Choose Group -</option>
												<?php if($countGroup > 0){?>
												<?php foreach($rsGroup as $group){ ?>
												<option value="<?php echo $group['weekly_exam_group_id'];?>" <?php if($group['weekly_exam_group_id'] == $weekly_exam_group_id) { echo "selected";} ?>> <?php echo $group['subject_title']?> - <?php echo $group['weekly_exam_group_title']?> </option>
												<?php } ?>
												<?php } ?>
										  </select>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Type</label>
                                      <div class="col-lg-4">
										  <select class="form-control" tabindex="1" name="weekly_exam_question_type" id="question_type" style="width:400px;">
											<option value="0">- Please Choose Question Type -</option>
											<option value="1"> Multiple Choice </option>
											<option value="2"> Essay </option>
										  </select>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Images</label>
                                      <div class="col-lg-4">
										  <div style="margin-bottom:10px;" class="imageurl"></div>
										  <input type="text" name="weekly_exam_question_images" readonly="readonly" id="imageurl" class="form-control" placeholder="Question Images" value="<?php if(!empty($weekly_exam_question_images)){echo $weekly_exam_question_images;} ?>">
										  <div style="margin-right:10px;">
												<a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
												<a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
											</div>
									  </div>
                                  </div>
								  <div id="DivMultiChoice" style="display:none;">
									  <div class="form-group">
										  <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Title</label>
										  <div class="col-lg-4">
												<textarea id="IDweekly_exam_questiontitle1" name="weekly_exam_questiontitle1" class="form-control" placeholder="Question Title" rows="7"><?php if(!empty($weekly_exam_questiontitle1)){echo $weekly_exam_questiontitle1;} ?></textarea>
												<script>
													CKEDITOR.replace( 'IDweekly_exam_questiontitle1', {
														toolbar: [
															{ name: 'document', items : [ 'Source'] },
															{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
															{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak'] },'/',
															{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
															{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
															{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
														 ],
														width : 900,
														height: 300
													});
												</script>
										  </div>
									  </div>
									  <div class="form-group">
										  <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Answer</label>
										  <div class="col-lg-4">
											  <div style="float:left;"><input name="weekly_exam_answer1" type="text" class="form-control" placeholder="Answer 1" value="<?php if(!empty($weekly_exam_answer1)){echo $weekly_exam_answer1;} ?>" style="width:290px;"></div>
											  <div style="float:left; margin-left:20px;"><input name="weekly_exam_status1" type="text" class="form-control" value="<?php if(!empty($weekly_exam_status1)){echo $weekly_exam_status1;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
											  <div style="clear:both;"></div><br>
											  <div style="float:left;"><input name="weekly_exam_answer2" type="text" class="form-control" placeholder="Answer 2" value="<?php if(!empty($weekly_exam_answer2)){echo $weekly_exam_answer2;} ?>" style="width:290px;"></div>
											  <div style="float:left; margin-left:20px;"><input name="weekly_exam_status2" type="text" class="form-control" value="<?php if(!empty($weekly_exam_status2)){echo $weekly_exam_status2;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
											  <div style="clear:both;"></div><br>
											  <div style="float:left;"><input name="weekly_exam_answer3" type="text" class="form-control" placeholder="Answer 3" value="<?php if(!empty($weekly_exam_answer3)){echo $weekly_exam_answer3;} ?>" style="width:290px;"></div>
											  <div style="float:left; margin-left:20px;"><input name="weekly_exam_status3" type="text" class="form-control" value="<?php if(!empty($weekly_exam_status3)){echo $weekly_exam_status3;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
											  <div style="clear:both;"></div><br>
											  <div style="float:left;"><input name="weekly_exam_answer4" type="text" class="form-control" placeholder="Answer 4" value="<?php if(!empty($weekly_exam_answer4)){echo $weekly_exam_answer4;} ?>" style="width:290px;"></div>
											  <div style="float:left; margin-left:20px;"><input name="weekly_exam_status4" type="text" class="form-control" value="<?php if(!empty($weekly_exam_status4)){echo $weekly_exam_status4;} else { echo 0; } ?>" style="float:left; width:35px;" maxlength="1" onkeypress="return isAnswerKey(event)"></div>
											  <div style="clear:both;"></div><br>
											   
										  </div>
									  </div>
								  </div>
								  <div id="DivEssay" style="display:none;">
									  <div class="form-group">
											<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Question Title</label>
											<div class="col-lg-4">
												<textarea id="IDweekly_exam_questiontitle2" name="weekly_exam_questiontitle2" class="form-control" placeholder="Question Title" rows="7"><?php if(!empty($weekly_exam_questiontitle2)){echo $weekly_exam_questiontitle2;} ?></textarea>
												<script>
													CKEDITOR.replace( 'IDweekly_exam_questiontitle2', {
														toolbar: [
															{ name: 'document', items : [ 'Source'] },
															{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
															{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak'] },'/',
															{ name: 'styles', items : [ 'Styles','Format' ] },
															{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
															{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
															{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
														 ],
														width : 900,
														height: 300
													});
												</script>

											</div>
									  </div>	  
								  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/weekly_exam_question'; ?>'">
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
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('#question_type').change(function(){
			var question_type 	= $("#question_type").val();
		
			if (question_type == '0') {
				$("#DivMultiChoice").hide();
				$("#DivEssay").hide();
			} else if (question_type == '1') {
				$("#DivMultiChoice").show();
				$("#DivEssay").hide();
			} else if (question_type == '2') {
				$("#DivMultiChoice").hide();
				$("#DivEssay").show();
			} 
			
			
			return false;
		});
	});
	</script>
</body>
</html	