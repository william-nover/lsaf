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
							  <form name="form1" action="<?php echo BASE_URL_BACKEND.'/menu_frontend/doAdd'; ?>" method="post" class="form-horizontal" role="form">
                                  <?php if(isset($error)){ ?>
								  <div class="form-group has-error">
									  <div class="col-lg-12">
										<label for="inputError" class="control-label"><?php echo $error;?></label>
									  </div>
								  </div>
								  <?php } ?>
								  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Menu Title</label>
                                      <div class="col-lg-4">
                                                <input name="menutitle" type="text" class="form-control" placeholder="Menu Title" value="<?php if(!empty($menutitle)){echo $menutitle;} ?>">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label"> Module </label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="module_id" id="module_id">                                            
                                            <?php foreach($Module as $Modul){ ?>
                                                    <option value="<?php echo $Modul->module_id;?>" <?php if($Modul->module_id == $modul_id) { echo "selected";} ?>> <?php echo $Modul->module_name;?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                 </div>                            
                                <div class="form-group">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Menu Parent</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="menuparent" id="menuparent">
                                            <option value="0">Parent Menu</option>
                                            <?php foreach($MenuParent as $parent){ ?>
                                                    <option value="<?php echo $parent['menu_id'];?>" <?php if($parent['menu_id'] == $menuparent) { echo "selected";} ?>> <?php echo $parent['menu_title']?> </option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                 </div>
                                    <script language="javascript">
                                                $(document).ready(function(){      
                                                $('#menuparent').change(function(){
                                                     var id_menu = $('#menuparent').val();
                                                     //alert(id_menu);
                                                   if(id_menu == 0) {

                                                       $(".id_child").hide();
                                                   }
                                                   else{
                                                      $.post("<?php echo BASE_URL_BACKEND.'/menu_frontend/getParent';?>/"+id_menu+"",
                                                    function(obj){
                                                        $(".id_child").show();                   
                                                        $('#menusubparent').html(obj);
                                                    });  
                                                   }

                                                });
                                                });
                                    </script>
                                    <div class="form-group id_child" style="display: none">
                                      <label for="inputDescription" class="col-lg-2 col-sm-2 control-label">Menu Sub Parent</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="menusubparent" id="menusubparent">
                                            <option value="0">Sub Menu</option>
                                            
                                          </select>
                                      </div>
                                    </div>                              
                                <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Menu URL</label>
                                      <div class="col-lg-4">
										  <input name="menuurl" type="text" class="form-control" placeholder="Menu URL" value="<?php if(!empty($menuurl)){echo $menuurl;} ?>">
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
</body>
</html	