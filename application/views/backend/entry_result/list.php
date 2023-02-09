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
								  <label for="inputError" class="col-sm-1 control-label col-lg-12"><?php echo $error;?></label>
							  </div>
						  </div>
						  <?php } ?>
						  
						  <div class="panel-body">
							<div class="col-lg-12">
								<?php if($add){ ?>
									<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/entry_group/add/'">
								<?php } ?>
								<?php if($order){ ?>

									<input class="btn btn-primary btn-sm" type="button" value="Order" onClick="javascript:updateOrder()"><br><br>

								<?php } ?>
							</div>
						  </div>
						  
						  <form class="form-inline" role="form" method="post" name="frmSearch" action="<?php echo BASE_URL_BACKEND."/entry_result/view"; ?>">
						  <div class="panel-body">
							 <div class="col-lg-10">
								  <div class="form-group">
									  <select name="searchby" id="search-by" size="1" class="form-control">
										<option value="">Choose a search</option>
										<option value="entry_group_title" <?php if($searchby == "entry_result_title") { echo "selected"; }?> >Question Title</option>
										
									</select>
								  </div>
								  <div class="form-group">
									  <input type="text" class="form-control" name="searchkey" placeholder="Keyword" value="<?php if(!empty($searchkey)){echo $searchkey;} ?>">
								  </div>
								  &nbsp;<input class="btn btn-success btn-sm" name="tbSearch" type="submit" value="Search">&nbsp;&nbsp;<label>Total : <?php echo $total;?></label>
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
                                      <th>ID</th>
                                      <th>Full Name</th>
                                      <th>Email</th>
                                      <th>Total Question</th>
                                      <th>Total Answered</th>
                                      <th>Total True Answer</th>
                                      <th>Result</th>
									  <th width="140">Create Date</th>
                                  </tr>
                                  </thead>
                                  <tbody>
								<form name="formAssignment" method="POST" action="" onsubmit="return false;">
                                  <?php
									if(count($List_entry_result) > 0){
									$no=0;
									foreach($List_entry_result as $data){
										$no++;
								  ?>
								  <tr>
									  <td><?php echo $no;?></td>
									  <td><?php echo $data['register_id'];?></td>
									  <td><?php echo $data['full_name'];?></td>
									  <td><?php echo $data['email'];?></td>
									  <td><?php echo $data['total_question'];?></td>
									  <td><?php echo $data['total_answered'];?></td>
									  <td><?php echo $data['entry_result_value'];?></td>
									  <td>
									  <?php
									  $result_test = round(100*($data['entry_result_value']/$data['total_question']), 2);
									  echo $result_test;
									  ?>
									  </td>
									  <td><?php echo $data['entry_result_create_date'];?></td>
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
	
	<!-- js placed at the end of the document so the entry_result load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>

    <!--common script for all entry_result-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
	
	<script language="javascript">
	$(document).ready(function() {
		$("#perpage").change(function() {
			var n = $(this).val();
			frmSearch.submit();
		});
	});
	</script>
	
</body>
</html	