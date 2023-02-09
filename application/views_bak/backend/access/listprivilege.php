<script language="javascript">
	$(document).ready(function() {
		$("#perpage").change(function() {
			var n = $(this).val();
			frmSearch.submit();
		});
	});
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
                              Access - List Access Module Privilege User Level <?php echo $user_level_name;?>
                          </header>
						  <?php if(isset($error)){ ?>
						  <div class="panel-body">
							  <div class="form-module has-error">
								  <label for="inputError" class="col-sm-2 control-label col-lg-2"><?php echo $error;?></label>
							  </div>
						  </div>
						  <?php } ?>
						  
						  <div class="panel-body">
							<div class="col-lg-12">
								<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/access/newprivilege/<?php echo $id;?>'">
								<input class="btn btn-primary btn-sm" type="button" value="Back" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/access/'">
							</div>
						  </div>
						  
                          <div class="panel-body">
                              <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                  <thead>
                                  <tr>
                                      <th width="15">No</th>
                                      <th>Module Name</th>
                                      <?php
									   foreach($ListPrivilege as $privilege){
											echo "<th align=\"center\">".$privilege['privilege_name']."</th>";
									   }
									   ?>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
									$no=0;
									foreach($ListAccessModule as $accessmodule){
										$no++;
								  ?>
								  <tr>
									  <td><?php echo $no;?></td>
									  <td><?php echo $accessmodule['module_group_name']." - ".$accessmodule['module_name'];?></td>
									  <?php
										foreach($accessmodule['access'] as $access){
											echo "<td align=\"center\">";
											if($access['is_privilege'] == 1) {
												if($access['access_privilege_status'] == 1) {?>
													<a class="btn-success btn-sm" href="<?php echo BASE_URL_BACKEND."/access/active/".$access['access_privilege_id']."/".$id;?>"><i class="icon-ok"></i></a> &nbsp; 
												<?php } else { ?>
													<a class="btn-danger btn-sm" href="<?php echo BASE_URL_BACKEND."/access/active/".$access['access_privilege_id']."/".$id;?>"><i class="icon-remove"></i></a> &nbsp;
												<?php }
											} else {
												echo "&nbsp;";
											}
											echo "</td>";
										}
										?>
								  </tr>
								  <?php } ?>
                                  </tbody>
                              </table>
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