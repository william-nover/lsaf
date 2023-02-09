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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/'.$controller.'/doAdd'; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Title</label>
                                      <div class="col-lg-4">
                                          <input name="contenttitle" type="text" class="form-control" placeholder="Content Title" value="<?php if(!empty($contenttitle)){echo $contenttitle;} ?>">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Content Short Description</label>
                                      <div class="col-lg-10">
										  <textarea id="IDcontentshortdesc" name="contentshortdesc" class="form-control" placeholder="Content Short Description" rows="4"><?php if(!empty($contentshortdesc)){echo $contentshortdesc;} ?></textarea>
										  <script>
												CKEDITOR.replace( 'IDcontentshortdesc', {
													toolbar: [
														{ name: 'document', items : [ 'Source'] },
														{ name: 'insert', items : [ 'Table','HorizontalRule','SpecialChar','PageBreak'] },
														{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
														{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
														{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList'] },
													 ],
													width : 900,
													height: 200
												});
											</script>
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Content Description</label>
                                      <div class="col-lg-10">
										  <textarea id="IDcontentdesc" name="contentdesc" class="form-control ckeditor" placeholder="Content Description" rows="7"><?php if(!empty($contentdesc)){echo $contentdesc;} ?></textarea>
											<script>
												CKEDITOR.replace( 'IDcontentdesc', {
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
													height: 300,
													contentsCss : ["<?php echo CSS_BASE_URL;?>/style.css"]
												});
											</script>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Images</label>
                                      <div class="col-lg-4">
										  <div style="margin-bottom:10px;" class="imageurl"></div>
										  <input type="text" name="contentimageurl" readonly="readonly" id="imageurl" class="form-control" value="<?php if(!empty($contentimageurl)){echo $contentimageurl;} ?>">
										  <p class="help-block">width and height optimal is 400px x 400px</p>
										  <div style="margin-right:10px;">
												<a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
												<a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
											</div>
									  </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Alias URL</label>
                                      <div class="col-lg-4">
                                          <input name="contentalias" type="text" class="form-control" placeholder="Content Alias" value="<?php if(!empty($contentalias)){echo $contentalias;} ?>">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Description</label>
                                      <div class="col-lg-4">
                                          <input name="contentmetadescription" type="text" class="form-control" placeholder="Content Meta Description" value="<?php if(!empty($contentmetadescription)){echo $contentmetadescription;} ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Keywords</label>
                                      <div class="col-lg-4">
                                          <input name="contentmetakeywords" type="text" class="form-control" placeholder="Content Meta Keywords" value="<?php if(!empty($contentmetakeywords)){echo $contentmetakeywords;} ?>">
									 </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/content'; ?>'">
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
	
	<!-- js placed at the end of the document so the content load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>
	
	<script src="<?php echo JS_BASE_URL; ?>/select2.min.js"></script>
	<link rel="stylesheet" href="<?php echo CSS_BASE_URL; ?>/select2.min.css">
	<script>
	$(document).ready(function(){
		$("#IDnewstag").select2({
			 tags: true
		});
	});
	</script>
    
	<!--common script for all content-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
</body>
</html	