


<script type="text/javascript">
    function del_accordion(eleId) {
        var ele = document.getElementById("delete_file" + eleId);
        ele.parentNode.removeChild(ele);
    }
</script>
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
                                    <label for="menu" class="col-lg-2 col-sm-2 control-label">Selects Menu</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="menu_id" id="echoActive"  value="" style="display: none"/> 
                                         <?php include 'vopt_menu.php'; ?> 
                                    </div>                                      
                                </div>
                                <div class="form-group">
                                    <label for="menu" class="col-lg-2 col-sm-2 control-label">Content View</label>
                                        <div class="col-lg-4">
                                        <select class="form-control" name="page_type" id="id_type">
                                             <?php    
                                                foreach($Pageview as $pg)                    
                                                {                                                      
                                                     echo "<option value=".$pg->page_type.">".$pg->page_title."</option>";
                                                }
                                                ?>
                                        </select> 
                                        </div>
                                </div>
                  
                                <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Title</label>
                                      <div class="col-lg-4">
                                          <input name="content_title" type="text" class="form-control" placeholder="Content Title" value="<?php if(!empty($contenttitle)){echo $contenttitle;} ?>">
                                      </div>
                                </div>                        
                                
                                <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Content Description</label>
                                      <div class="col-lg-10">
                                    <textarea id="IDcontentdesc" name="content_desc" class="form-control ckeditor" placeholder="Content Description" rows="7"><?php if(!empty($contentdesc)){echo $contentdesc;} ?></textarea>
                                       
                                      </div>
                                </div>
                                    
                <div class="col-lg-10 right">
                <legend>Accordion</legend>
                <section>         
                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Accordion Title</label>
                                      <div class="col-lg-4">
                                          <input name="accordion_title[]" id="accordion_title1" type="text" class="form-control" placeholder="Accorddion Title" value="">
                                      </div>
                   </div>
                    <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Accordion Description</label>
                                      <div class="col-lg-8">
                                    <textarea id="IDaccordesc1" name="accordion_desc[]" class="form-control ckeditor" placeholder="Accordion Description" rows="7"></textarea>
                                       <script>
                                        CKEDITOR.replace( 'IDaccordesc1', {
                                                toolbar: [
                                                        { name: 'document', items : [ 'Source'] },
                                                        { name: 'insert', items : [ 'Table','HorizontalRule','SpecialChar','PageBreak'] },
                                                        { name: 'colors',      items : [ 'TextColor','BGColor' ] },
                                                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                                                        { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                                                        { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList'] },
                                                 ],
                                                width : 800,
                                                height: 100
                                        });
                                        </script> 
                                      </div>
                    </div>
                    <div id="moreAccordion"></div>
                    <div style="clear:both;"></div>
                    <div id="moreAccordionLink" style="">
                        <a href="javascript:void(0);" id="accordionMore">Add More field</a>
                    </div>
                    <script type="text/javascript">
    $(document).ready(function() {
        var accordion_number = 2;
        $('#accordionMore').click(function() {
            //add more file
            var moreAccordionTag = '';
           
             moreAccordionTag += '<div class="form-group">';
                    moreAccordionTag += '<label for="inputaccordion" class="col-lg-2 col-sm-2 control-label">Accordion Title</label>';
                    moreAccordionTag += '<div class="col-lg-4">';
                    moreAccordionTag += '<input id="accordion_title' + accordion_number + '" name="accordion_title[]" type="text" class="form-control" placeholder="Accorddion Title" value="">';
                    moreAccordionTag += '</div>';
                    moreAccordionTag += '</div>';
                    moreAccordionTag += ' <div class="form-group">';
                    moreAccordionTag += '<label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Accordion Description</label>';
                    moreAccordionTag += '<div class="col-lg-6">';
                    moreAccordionTag += '<textarea id="IDaccordescs' + accordion_number + '" name="accordion_desc[]" class="form-control ckeditor" placeholder="Accordion Description" rows="7"></textarea>';                                 
                    
                    moreAccordionTag += ' </div>';
                    moreAccordionTag += '</div>';
                    moreAccordionTag += '&nbsp;<a href="javascript:del_accordion(' + accordion_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")">Delete ' + accordion_number + '</a></div>';
            
            
            $('<dl id="delete_file' + accordion_number + '">' + moreAccordionTag + '</dl>').fadeIn('slow').appendTo('#moreAccordion');
              CKEDITOR.replace( 'IDaccordescs' + accordion_number , {
                                                toolbar: [
                                                        { name: 'document', items : [ 'Source'] },
                                                        { name: 'insert', items : [ 'Table','HorizontalRule','SpecialChar','PageBreak'] },
                                                        { name: 'colors',      items : [ 'TextColor','BGColor' ] },
                                                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                                                        { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                                                        { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList'] },
                                                 ],
                                                width : 800,
                                                height: 100
                                        });
           // CKEDITOR.enableAutoInline = true;
           //  CKEDITOR.inline( 'IDaccordescs' + accordion_number );
            accordion_number++;
           
        });
        
        
         
    });
</script>
                </section>
    </div>  
                     <div style="clear:both;"></div>   <div style="clear:both;"></div>                  
                                
                                
                                    
                                <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Images</label>
                                      <div class="col-lg-4">
                                            <div style="margin-bottom:10px;" class="imageurl"></div>
                                            <input type="text" name="content_imageurl" readonly="readonly" id="imageurl" class="form-control" value="<?php if(!empty($contentimageurl)){echo $contentimageurl;} ?>">
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
                                          <input name="content_alias" type="text" class="form-control" placeholder="Content Alias" value="<?php if(!empty($contentalias)){echo $contentalias;} ?>">
                                      </div>
                                </div>
				<div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Description</label>
                                    <div class="col-lg-4">
                                        <input name="content_metadescription" type="text" class="form-control" placeholder="Content Meta Description" value="<?php if(!empty($contentmetadescription)){echo $contentmetadescription;} ?>">
                                    </div>
                                </div>
				<div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Content Meta Keywords</label>
                                    <div class="col-lg-4">
                                          <input name="content_metakeywords" type="text" class="form-control" placeholder="Content Meta Keywords" value="<?php if(!empty($contentmetakeywords)){echo $contentmetakeywords;} ?>">
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                        <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
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
	
	
	<!-- js placed at the end of the document so the pages load faster -->
   <!--  <script src="<?php //echo JS_BASE_URL; ?>/jquery.js"></script>-->
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
 
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
    
	<!--common script for all pages-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
  
    
    
</body>
</html	