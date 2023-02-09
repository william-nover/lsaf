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
                              Access - Add Access Module Privilege User Level <?php echo $user_level_name;?>
                          </header>
                          <div class="panel-body">
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/access/doNewprivilege/'.$id; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Module Name</label>
                                      <div class="col-lg-4">
										  <input name="userlevelname" type="text" class="form-control" placeholder="User Level Name" readonly value="<?php if(!empty($userlevelname)){echo $userlevelname;} ?>">
										  <input name="userlevelid" type="hidden" value="<?php echo $id;?>">
									  </div>
                                  </div>
								  <div class="form-group ">
									  <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Module Privilege</label>
									  <div class="col-lg-10">
										  <select name="moduleid[]" id="moduleid" multiple class="form-control" size="10">
											<?php foreach($ListModule as $module){ ?>
												<option value="<?php echo $module['module_id'];?>" <?php if($module['is_selected'] == 1) echo "selected"; ?>> <?php echo $module['module_group_name']?> - <?php echo $module['module_name']?> </option>
											<?php } ?>
										  </select>
									  </div>
								  </div>
                                  <div class="form-module">
                                      <div class="col-lg-offset-2 col-lg-10">
										  <input name="tbSave" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
										  <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/access/listprivilege/'.$id; ?>'">
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