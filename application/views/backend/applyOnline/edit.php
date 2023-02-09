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
                                <form name="form1" action="<?php echo BASE_URL_BACKEND.'/ApplyOnline/doEdit/'.$rsApplyOnline[0]['signup_id']; ?>" method="post" class="form-horizontal" role="form">
                                <?php if(isset($error)){ ?>
                                <div class="form-group has-error">
                                        <div class="col-lg-12">
                                              <label for="inputError" class="control-label"><?php echo $error;?></label>
                                        </div>
                                </div>
                                <?php } ?>
                                    <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Full Name </label>
                                      <div class="col-lg-4">
                                        <input name="full_name" type="text" class="form-control" placeholder="Full Name" value="<?php echo $rsApplyOnline[0]['full_name']; ?>">
                                        <input name="menufull_nameOld" type="hidden" value="<?php echo $rsApplyOnline[0]['full_name']; ?>">
                                        </div>
                                    </div>
                                <div class="form-group">
                                      <label for="inputEmail" class="col-lg-2 col-sm-2 control-label">Email </label>
                                      <div class="col-lg-4">
                                        <input name="email" type="text" class="form-control" placeholder="email" value="<?php echo $rsApplyOnline[0]['email']; ?>">
                                       </div>
                                </div> 
                                <div class="form-group">
                                      <label for="address1" class="col-lg-2 col-sm-2 control-label">Address</label>
                                      <div class="col-lg-4">
                                        <input name="address1" type="text" class="form-control" placeholder="address1" value="<?php echo $rsApplyOnline[0]['address1']; ?>">
                                       </div>
                                </div>
                                <div class="form-group">
                                      <label for="address2" class="col-lg-2 col-sm-2 control-label">Address 2</label>
                                      <div class="col-lg-4">
                                        <input name="address2" type="text" class="form-control" placeholder="address2" value="<?php echo $rsApplyOnline[0]['address2']; ?>">
                                       </div>
                                </div>
                                <div class="form-group">
                                    <label for="dtp_input2" class="col-md-2 control-label">Date Of Birth</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="<?php echo $rsApplyOnline[0]['date_of_birth']; ?>" >
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="date_of_birth" name="date_of_birth" value="<?php echo $rsApplyOnline[0]['date_of_birth']; ?>" /><br/>
                                </div>                            
                                   <div class="form-group">
                                      <label for="postal" class="col-lg-2 col-sm-2 control-label">Postal Code</label>
                                      <div class="col-lg-4">
                                        <input name="postal" type="text" class="form-control" placeholder="postal" value="<?php echo $rsApplyOnline[0]['postal_code']; ?>">
                                       </div>
                                    </div> 
                                <div class="form-group">
                                      <label for="phone" class="col-lg-2 col-sm-2 control-label">Phone</label>
                                      <div class="col-lg-4">
                                        <input name="phone" type="text" class="form-control" placeholder="phone" value="<?php echo $rsApplyOnline[0]['phone']; ?>">
                                       </div>
                                </div>
                                    
				<div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Nationality</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="country_id" id="country_id">
                                             <?php foreach($Nationality as $nat){ ?> 
                                                    <option value="<?php echo $nat->country_id;?>" <?php if($nat->country_id == $rsApplyOnline[0]['country_id']) { echo "selected";} ?>> <?php echo $nat->country_name;?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                    <input name="stepOld" type="hidden" class="form-control" placeholder="stepOld" value="<?php echo $rsApplyOnline[0]['step']; ?>">
                                    <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Step Apply</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="step" id="step">
                                                    <option value="1" <?php if($rsApplyOnline[0]['step'] == 1) { echo "selected";} ?>> Entry Test</option>
                                                    <option value="2" <?php if($rsApplyOnline[0]['step'] == 2) { echo "selected";} ?>>UploadNecesarryDocument</option>
                                                    <option value="3" <?php if($rsApplyOnline[0]['step'] == 3) { echo "selected";} ?>>LSAF Student</option>                                           
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                        <input name="tbEdit" class="btn btn-info btn-sm" type="submit" value="Save">&nbsp;
                                        <input name="cancel" class="btn btn-info btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/ApplyOnline'; ?>'">
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
    
    <link href="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/sample/bootstrap/css/bootstrap_icon.css" rel="stylesheet" type="text/css">
    <link href="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    
    <script src="<?php echo TOOLS_BASE_URL; ?>/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script type="text/javascript">

    $('.form_date').datetimepicker({        
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

</script>
</body>
</html	