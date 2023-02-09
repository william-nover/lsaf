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
                              <?php echo $breadcrump['module_group_name']; ?> - <?php echo $breadcrump['module_name']; ?> -  List
                          </header>
						  <?php if(isset($error)){ ?>
						  <div class="panel-body">
							  <div class="form-group has-error">
								  <label for="inputError" class="col-sm-2 control-label col-lg-2"><?php echo $error;?></label>
							  </div>
						  </div>
						  <?php } ?>
						  
                                                <div class="panel-body">
                                                    <div class="col-lg-12" id="frmadd">
                                                        <?php if($add){ ?>
                                                            <input class="btn btn-primary btn-sm" type="button" value="Add" onClick="javascript:showFormUpload()">
                                                        <?php } ?>
                                                            <?php if($order){ ?>
                                                                     <input class="btn btn-primary btn-sm" type="button" value="Order" onClick="javascript:updateOrder()"><br><br>
                                                         <?php } ?>
                                                    </div>
                                                    <div class="col-lg-12" id="frmUpload" style="display: none;">
                                                         <?php include 'vupload.php'; ?>
                                                    </div>
                                                   
                                                </div>
                                                <div class="panel-body">							
                                                    <div class="col-lg-12">		
                                                         
                                                    </div>                                                    
                                                </div>    
                                               			
                                                <div class="panel-body">
                                                    <section id="unseen">
                                                      <?php include 'vaccordion_list.php'; ?>
                                                    </section>
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
<link href="<?php echo CSS_BASE_URL; ?>/fineuploader.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_BASE_URL; ?>/colorbox.css" rel="stylesheet" type="text/css" />




	<!-- js placed at the end of the document so the content load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>

<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/fineuploader-3.2.min.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.colorbox-min.js"></script>
    <!--common script for all content-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
	
	<!-- fancybox -->
	<script src="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.js"></script>
	<link href="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		//fancybox
		jQuery("a#viewBackend").fancybox({
			'overlayShow'		: true,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'width'				: '100%',
			'height'			: '100%'
		});
	});
	</script>
	<!-- end fancybox -->
	
	<script language="javascript">
        function showFormUpload(){
       $("#frmadd").hide(); 
       $("#frmUpload").show();
	} 
        function hideFormUpload(){
       $("#frmadd").show(); 
       $("#frmUpload").hide();
	}     
            
	function updateOrder(){
		var frm = document.formAssignment;
		var answer = confirm('are you sure want to update order?');
		
		if(answer){
			frm.action = '<?php echo BASE_URL_BACKEND;?>/Accordion/doOrder';
			frm.submit();
		} else {
			return false;
		}
	}


	</script>
</body>
</html	