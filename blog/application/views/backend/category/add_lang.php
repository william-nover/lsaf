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
                              Menu - Add Language <?php echo $Lang['language_title']?>
                          </header>
                          <div class="panel-body">
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/menu_frontend/doAddLang'; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <?php if($countMenuDefault > 0){?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Menu Title (Default)</label>
                                      <div class="col-lg-4">
										  <input name="menutitlelangdefault" type="text" class="form-control" placeholder="Menu Title" value="<?php echo $rsMenuDefault[0]['menu_title']; ?>" readonly>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <hr>
                                  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Menu Title</label>
                                      <div class="col-lg-4">
                                          <input name="language_id" type="hidden" value="<?php echo $language_id; ?>">
										  <input name="menu_id" type="hidden" value="<?php echo $menu_id; ?>">
										  <input name="menutitlelang" type="text" class="form-control" placeholder="Menu Title" value="<?php if(!empty($menutitlelang)){echo $menutitlelang;} ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/menu_frontend'; ?>'">
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
		$('#newstypeid').change(function() {
			if ($(this).val() === '2') {
				$('#typedescstandar').hide();
				$('#typedesctab').show();
				$('#typedescaccording').hide();
				
				$('#desctab2').show();
				$('#desctab3').hide();
			} else if ($(this).val() === '3') {
				$('#typedescstandar').hide();
				$('#typedesctab').hide();
				$('#typedescaccording').show();
			} else {
				$('#typedescstandar').show();
				$('#typedesctab').hide();
				$('#typedescaccording').hide();
			}
		});
		
		$('#totaltabid').change(function() {
			if ($(this).val() === '2') {
				$('#desctab2').show();
				$('#desctab3').hide();
			} else if ($(this).val() === '3') {
				$('#desctab2').hide();
				$('#desctab3').show();
			} 
		});
	});
	</script>
</body>
</html	