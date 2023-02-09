<script type="text/javascript">
    function del_subpage(eleId) {
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
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label"><?php echo $breadcrump['module_name']; ?> Page Title</label>
                                      <div class="col-lg-4">
                                          <input name="gallery_title" type="text" class="form-control" placeholder="Content Page Title" value="<?php if(!empty($gallery_stitle)){echo $gallery_title;} ?>">
                                      </div>
                                </div>                        
                         
                            
    <div class="col-lg-10 right">
                <legend>Gallery List </legend>
                <section>         
                  <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Gallery Title</label>
                        <div class="col-lg-8">
                            <input name="subpage_title[]" id="subpage_title1" type="text" class="form-control" placeholder="Sub Page Title" value="">
                        </div>
                   </div>
                    <div class="form-group"> 
                          <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">SubPage Image</label>
                          <div class="col-lg-4">
                                    <div style="margin-bottom:2px;" class="imageurl1"></div>
                                    <input type="text" name="subpage_image[]" readonly="readonly" id="imageurl1" class="form-control" value="">
                                    <p class="help-block">width and height optimal is  900x600 px</p>
                                    <div style="margin-right:50px;">
                                        <a onClick="openKCFinder('imageurl1');" id="link-file" class="link" style="cursor:pointer;">Browse</a>
                                        <a onClick="reset_value('imageurl1');" id="link-file" class="link">Reset</a>                                               
                                    </div>
                             </div>          
                    </div> 
                    
                    <div id="moreSubPage"></div>
                    <div style="clear:both;"></div>
                    <div id="moreSubPageLink" style="">
                        <a href="javascript:void(0);" id="subpageMore">Add More field</a>
                    </div>
                    <script type="text/javascript">
    $(document).ready(function() {
        var subpage_number = 2;
        $('#subpageMore').click(function() {
            //add more file
            var moreSubPageTag = '';
           
                    moreSubPageTag += '<div class="form-group">';
                        moreSubPageTag += '<label for="inputsubpage" class="col-lg-2 col-sm-2 control-label">Sub Page Title</label>';
                        moreSubPageTag += '<div class="col-lg-8">';
                        moreSubPageTag += '<input id="subpage_title' + subpage_number + '" name="subpage_title[]" type="text" class="form-control" placeholder="Sub Page Title" value="">';
                        moreSubPageTag += '</div>';
                    moreSubPageTag += '</div>';
                    
                    moreSubPageTag += ' <div class="form-group">';
                    moreSubPageTag += '<label for="inputDescription" class="col-lg-2 col-sm-2 control-label">SubPage Image</label>';                            
                    moreSubPageTag += '<div class="col-lg-4">';
                    moreSubPageTag += '<div style="margin-bottom:2px;" class="imageurl' + subpage_number + '"></div>';
                    moreSubPageTag += ' <input type="text" name="subpage_image[]" readonly="readonly" id="imageurl' + subpage_number + '" class="form-control" value="">';
                    moreSubPageTag += ' <p class="help-block">width and height optimal is  900x600 px</p>';
                    moreSubPageTag += '<div style="margin-right:50px;">';
                    moreSubPageTag += '<a onclick="openKCFinder(&#39;imageurl' + subpage_number + '&#39;);" id="link-file" class="link" style="cursor:pointer;">Browse </a>';
                    moreSubPageTag += '<a onClick="reset_value(&#39;imageurl' + subpage_number + '&#39;);" id="link-file" class="link" style="cursor:pointer;">Reset</a>';                   
                    moreSubPageTag += '</div>';                               
                    moreSubPageTag += '</div>';
                    moreSubPageTag += '</div>';
                    
                   
                    moreSubPageTag += '&nbsp;<a href="javascript:del_subpage(' + subpage_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")">Delete ' + subpage_number + '</a></div>';
            
            
            $('<dl id="delete_file' + subpage_number + '">' + moreSubPageTag + '</dl>').fadeIn('slow').appendTo('#moreSubPage');
             
           // CKEDITOR.enableAutoInline = true;
           //  CKEDITOR.inline( 'IDaccordescs' + subpage_number );
            subpage_number++;
           
        });
        
        
         
    });
</script>
                </section>
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
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqsubpage.2.7.js"></script>
 
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