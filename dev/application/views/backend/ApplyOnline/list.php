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
							<div class="col-lg-12">
								<?php if(!$add){ ?>
									<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND;?>/ApplyOnline/add/'">
								<?php } ?>
							</div>
						  </div>
						  
						  <form class="form-inline" role="form" method="post" name="frmSearch" action="<?php echo BASE_URL_BACKEND."/ApplyOnline/view"; ?>">
						  <div class="panel-body">
							 <div class="col-lg-10">
								  <div class="form-group">
									  <select name="searchby" id="search-by" size="1" class="form-control">
										<option value="">Choose a search</option>
										<option value="full_name" <?php if($searchby == "full_name") { echo "selected"; }?> >ApplyOnline Title</option>
										<option value="ApplyOnline_short_desc" <?php if($searchby == "ApplyOnline_desc") { echo "selected"; }?> >ApplyOnline Description</option>
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
                                       <th>Register id</th>
                                      <th>Full Name</th>
                                      <th>Email</th>
                                      <th>Date of birth</th>
                                      <th>Address</th>
                                      <th>Postal Code</th>
                                      <th>Phone</th>
                                      <th>Country</th>                                 
                                      <th>SignUp Date</th>
                                      <th>Step Aply</th>
                                      <th width="140">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                        if(count($ListApplyOnline) > 0){
                                        $no=0;
                                        foreach($ListApplyOnline as $ao){
                                                $no++;
                                  ?>
                                  <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $ao['register_id'];?></td>
                                        <td><?php echo $ao['full_name'];?></td>
                                        <td><?php echo $ao['email'];?></td>
                                        <td><?php echo $ao['date_of_birth'];?></td>
                                        <td><?php echo $ao['address1'].'-'.$ao['address2'];?></;?></td>
                                        <td><?php echo $ao['postal_code'];?></td>
                                        <td><?php echo $ao['phone'];?></td>
                                        <td><?php echo $ao['country_name'];?></td>
                                     
                                        <td><?php echo $ao['signup_date'];?></td>
                                        <td>
                                            <?php  if ($ao['step']==1){
                                                    echo'EntryTest';
                                                }
                                                elseif ($ao['step']==2) {
                                                   echo'OfferLetter';
                                                }
                                                elseif ($ao['step']==3) {
                                                   echo'UploadNecesarryDocument';
                                                }
                                                elseif ($ao['step']==4) {
                                                   echo'InvoiceInstallmen';
                                                } 
                                                 elseif ($ao['step']==5) {
                                                    echo'LSAF Student';
                                                } ?>
                                        </td>
                                        <td>
                                            <?php if($approve){ ?>
                                                    <?php if($ao['status'] == 1) {?>
                                                            <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/ApplyOnline/active/".$ao['signup_id'];?>"><i class="icon-ok"></i></a> &nbsp; 
                                                    <?php } else { ?>
                                                            <a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/ApplyOnline/active/".$ao['signup_id'];?>"><i class="icon-remove"></i></a> &nbsp;
                                                    <?php } ?>
                                            <?php } ?>

                                                <?php if(!$edit){ ?>
                                                        <a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND;?>/ApplyOnline/edit/<?php echo $ao['signup_id'];?>"><i class="icon-pencil"></i></a> &nbsp; 
                                                <?php } ?>

                                                <?php if($delete){ ?>
                                                        <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $ao['full_name'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND;?>/ApplyOnline/delete/<?php echo $ao['signup_id'];?>';}"><span class="icon-trash"></span></a> &nbsp;
                                                <?php } ?>
                                          </td>
                                  </tr>
                                  <?php } ?>
                                  <?php } else {?>
                                  <tr>
                                        <td align="center" colspan="10">Data Not Found</td>
                                  </tr>
                                  <?php } ?>
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
	
	<!-- js placed at the end of the document so the ApplyOnline load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>

    <!--common script for all ApplyOnline-->
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
	function updateOrder(){
		var frm = document.formAssignment;
		var answer = confirm('are you sure want to update order?');
		
		if(answer){
			frm.action = '<?php echo BASE_URL_BACKEND;?>/ApplyOnline/doOrder';
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
		
		$("#langid\\[\\]").change(function(e){
			var val = $(this).val();
			mystring  = val.split("-");
			var size = mystring.length;
			
			if(size == 3){
				window.location = '<?php echo BASE_URL_BACKEND;?>/ApplyOnline/editLang/'+val;
			} else if(size == 2){
				window.location = '<?php echo BASE_URL_BACKEND;?>/ApplyOnline/addLang/'+val;
			}
		});

	});
	</script>
</body>
</html	