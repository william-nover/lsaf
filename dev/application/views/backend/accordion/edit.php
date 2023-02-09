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
                                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/'.$controller.'/doEdit/'.$rsContent[0]['content_id']; ?>" method="post" class="form-horizontal" role="form">
                              <?php if(isset($error)){ ?>
                                        <div class="form-group has-error">
                                                <div class="col-lg-12">
                                                      <label for="inputError" class="control-label"><?php echo $error;?></label>
                                                </div>
                                        </div>
                                        <?php } ?>
                                
                                <div class="form-group">
                                    <label for="menu" class="col-lg-2 col-sm-2 control-label">Selects Menu</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="menu_id" id="echoActive"  value="<?php echo $rsContent[0]['menu_id']; ?>" style="display: none"/> 
                                         <?php include 'vopt_menu.php'; ?> 
                                    </div>                                      
                                </div>
                                 <div class="form-group">
                                    <label for="menu" class="col-lg-2 col-sm-2 control-label">Content View</label>
                                        <div class="col-lg-4">
                                        <select class="form-control" name="page_type" id="id_type">
                                            <?php foreach($Pageview as $pg):?>
                                            <option <?php if($rsContent[0]['page_type'] == $pg->page_type ) echo 'selected';?> value='<?php echo $pg->page_type;?>'><?php echo $pg->page_title;?> </option>
                                            <?php endforeach ?>
                                        </select> 
                                        </div>
                                </div>
                               <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Title</label>
                                      <div class="col-lg-4">
                                          <input name="content_title" type="text" class="form-control" placeholder="Content Title" value="<?php echo $rsContent[0]['content_title']; ?>">
                                         <input name="content_titleOld" type="hidden" value="<?php echo $rsContent[0]['content_title']; ?>">
                                       </div>
                                  </div>
                                <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Content Short Description</label>
                                      <div class="col-lg-10">
										  <textarea id="IDcontentshortdesc" name="content_shortdesc" class="form-control" placeholder="Content Short Description" rows="4"><?php echo $rsContent[0]['content_short_desc']; ?></textarea>
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
										  <textarea id="IDcontentdesc" name="content_desc" class="form-control ckeditor" placeholder="Content Description" rows="7"><?php echo $rsContent[0]['content_desc']; ?></textarea>
											<script>
												CKEDITOR.replace( 'IDcontentdesc', {
													
													width : 900,
													height: 300,
													contentsCss : ["<?php echo CSS_BASE_URL;?>/style.css"]
												});
											</script>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Images</label>
                                                <?php
                                                      $content_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$rsContent[0]['content_image']);
                                                      if(!empty($rsContent[0]['content_image'])){
                                                              $content_image = BASE_URL.$rsContent[0]['content_image'];
                                                      } else {
                                                              $content_image = "";
                                                      }
                                                      ?>
                                      <div class="col-lg-4">
                                        <div style="margin-bottom:10px;" class="imageurl"><?php if(!empty($rsContent[0]['content_image'])){ ?><img src="<?php echo $content_image; ?>" style="max-width:400px; padding:5px; border:solid 1px #ccc;"><?php } ?></div>
                                        <input type="text" name="content_imageurl" readonly="readonly" id="imageurl" class="form-control" value="<?php echo $content_image ?>">
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
                                          <input name="content_alias" type="text" class="form-control" placeholder="Content Alias" value="<?php echo $rsContent[0]['content_alias']; ?>">
                                                    <input name="newsaliasOld" type="hidden" value="<?php echo $rsContent[0]['content_alias']; ?>">
                                           </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Description</label>
                                      <div class="col-lg-4">
                                          <input name="content_metadescription" type="text" class="form-control" placeholder="Content Meta Description" value="<?php echo $rsContent[0]['content_meta_description']; ?>">
									 </div>
                                  </div>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Keywords</label>
                                      <div class="col-lg-4">
                                          <input name="content_metakeywords" type="text" class="form-control" placeholder="Content Meta Keywords" value="<?php echo $rsContent[0]['content_meta_keywords']; ?>">
									 </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/'.$controller; ?>'">
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
     <!--  <script src="<?php //echo JS_BASE_URL; ?>/jquery.js"></script>-->
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