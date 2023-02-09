<script language="javascript">
	function updateOrder(){
		var frm = document.formAssignment;
		var answer = confirm('are you sure want to update order?');
		
		if(answer){
			frm.action = '<?php echo BASE_URL_BACKEND;?>/module/doOrder';
			frm.submit();
		} else {
			return false;
		}
	}
	
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
                              Module - List
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
								<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/module/add/'">
								<input class="btn btn-primary btn-sm" type="button" value="Order" onClick="javascript:updateOrder()"><br><br>
							</div>
						  </div>
						  
						  <form class="form-inline" role="form" method="post" name="frmSearch" action="<?php echo BASE_URL_BACKEND."/module/view"; ?>">
						  <div class="panel-body">
							 <div class="col-lg-10">
								  <div class="form-group">
									  <select name="searchby" id="search-by" size="1" class="form-control">
										<option value="">Choose a search</option>
										<option value="module_group_name" <?php if($searchby == "module_group_name") { echo "selected"; }?>>Group Name</option>
										<option value="module_name" <?php if($searchby == "module_name") { echo "selected"; }?> >Module Name</option>
										<option value="module_path" <?php if($searchby == "module_path") { echo "selected"; }?> >Module Controller</option>
									</select>
								  </div>
								  <div class="form-group">
									  <input type="text" class="form-control" name="searchkey" placeholder="Keyword" value="<?php if(!empty($searchkey)){echo $searchkey;} ?>">
								  </div>
								  <input class="btn btn-success btn-sm" name="tbSearch" type="submit" value="Search">&nbsp;<label>Total : <?php echo $total;?></label>
							  </div>
							  <div class="col-lg-2" align="right">
								<div class="form-group">
									<select name="perpage" id="perpage" size="1" aria-controls="editable-sample" class="form-control xsmall">
										<option value="<?php echo PER_PAGE;?>" <?php if($perpage == "10") { echo "selected"; }?>><?php echo PER_PAGE;?></option>
										<option value="20" <?php if($perpage == "20") { echo "selected"; }?>>20</option>
										<option value="50" <?php if($perpage == "50") { echo "selected"; }?>>50</option>
										<option value="100" <?php if($perpage == "100") { echo "selected"; }?>>100</option>
									</select> 
								</div>
							</div>
                          </div>
						  </form>
						
                          <div class="panel-body">
                              <section id="unseen">
                                <table class="table table-bordered table-striped table-condensed">
                                  <thead>
                                  <tr>
                                      <th width="5">No</th>
                                      <th>Module Name</th>
									  <th>Group</th>
									  <th>Module Controller</th>
									  <th>Create Date</th>
									  <th>Order</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <form name="formAssignment" method="POST" action="" onsubmit="return false;">
								  <?php
									if(count($ListModule) > 0){
									$no=0;
									foreach($ListModule as $module){
										$no++;
								  ?>
								  <tr>
									  <input type="hidden" name="moduleid[<?php echo $module['module_id'];?>]" value="<?php echo $module['module_id'];?>">
									  <td><?php echo $no;?></td>
									  <td><?php echo $module['module_name'];?></td>
									  <td><?php echo $module['module_group_name'];?></td>
									  <td><?php echo $module['module_path'];?></td>
									  <td><?php echo $module['module_create_date'];?></td>
									  <td><input type="text" class="form-control" name="order[<?php echo $module['module_id'];?>]" size="1" maxlength="2" style="text-align:center;" value="<?php echo $module['module_order_value'];?>" onKeyPress="return isNumberKey(event)"></td>
									  <td align="center">
									  <?php if($module['module_active_status'] == 1) {?>
											<a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/module/active/".$module['module_id'];?>"><i class="icon-ok"></i></a> &nbsp; 
									  <?php } else { ?>	
											<a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/module/active/".$module['module_id'];?>"><i class="icon-remove"></i></a> &nbsp;
									  <?php } ?>
											<a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND;?>/module/edit/<?php echo $module['module_id'];?>"><i class="icon-pencil"></i></a> &nbsp; 
											<a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete grup <?php echo $module['module_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/module/delete/<?php echo $module['module_id'];?>';}"><span class="icon-trash"></span></a> &nbsp; 
											<a class="btn-warning btn-sm" title="Click to Privilege Module" href="<?php echo BASE_URL_BACKEND;?>/module/listmoduleprivilege/<?php echo $module['module_id'];?>"><i class="icon-lock"></i></a> &nbsp;  
									  </td>
								  </tr>
								  <?php } ?>
								  <?php } else {?>
								  <tr>
									<td align="center" colspan="10">Data Not Found</td>
								  </tr>
								  <?php } ?>
								  </form>
                                  </tbody>
                              </table>
                              </section>
                          </div>
						  <?php echo($paging); ?>
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
    <script src="<?php echo JS_BASE_URL; ?>/functionGlobal.js" ></script>

    <!--common script for all pages-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
</body>
</html	