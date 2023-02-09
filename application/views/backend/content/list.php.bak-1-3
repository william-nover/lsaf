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
								<?php if($add){ ?>
									<input class="btn btn-primary btn-sm" type="button" value="Add" onclick="window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;?>/add/'">
								<?php } ?>
                                                                <?php if($order){ ?>
									<input class="btn btn-primary btn-sm" type="button" value="Order" onClick="javascript:updateOrder()"><br><br>
								<?php } ?>
							</div>
						  </div>
						  
						  <form class="form-inline" role="form" method="post" name="frmSearch" action="<?php echo BASE_URL_BACKEND.'/'.$controller.'/view'; ?>">
						  <div class="panel-body">
							 <div class="col-lg-10">
								  <div class="form-group">
									  <select name="searchby" id="search-by" size="1" class="form-control">
										<option value="">Choose a search</option>
										<option value="content_title" <?php if($searchby == "content_title") { echo "selected"; }?> >Content Title</option>
										<option value="content_short_desc" <?php if($searchby == "content_desc") { echo "selected"; }?> >Content Description</option>
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
                                      <th>Content Title</th>
                                      <th>Menu Title</th>
                                      <th>Content URL</th>
                                      <th>Content Images</th>          
                                      <th>Create Date</th>
                                      <th>Content Order</th>
                                      <th>Accordion</th>
                                      <th width="140">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <form name="formAssignment" method="POST" action="" onsubmit="return false;">
                                  <?php
                                    if(count($ListContent) > 0){
                                    $no=0;
                                    foreach($ListContent as $content){
                                            $no++;
                                    ?>
                                    <tr>
                                      <td><?php echo $no;?></td>
                                      <td><?php echo $content['content_title'];?></td>
                                       <td><?php echo $content['menu_title'];?></td>
                                      <td width="15">
                                            <?php if($content['content_alias'] == "") {?>
                                                    <?php echo BASE_URL."/".generateAlias($content['content_title'])?>
                                            <?php } else {
                                                     echo BASE_URL."/".$content['content_alias'];
                                            } ?>	
                                      </td>
                                      <td><?php 
                                            if(!empty($content['content_image'])){
                                            $content_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$content['content_image']);
                                            $content_image = BASE_URL.$content['content_image'];
                                            ?>
                                            <a id="viewBackend" href="#viewDataImage<?php echo $content['content_id'];?>">
                                                    <img src="<?php echo $content_image_thumbs;?>">
                                            </a>
                                            <div style="display: none;">
                                                    <div id="viewDataImage<?php echo $content['content_id'];?>">
                                                            <img src="<?php echo $content_image;?>" >
                                                    </div>
                                            </div>
                                            <?php } ?>
                                      </td>
                                      <td><?php echo $content['content_create_date'];?></td>
                                        <?php if($order){ ?>
                                            <td align="center"><input type="text" class="form-control" style="text-align:center;" name="order[<?php echo $content['content_id'];?>]" size="1" maxlength="2" value="<?php echo $content['content_order'];?>"></td>
                                         <?php } ?>
                                            <td>
                                                 <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/Accordion/".$content['content_id'];?>"><i class="icon-tasks"></i></a> &nbsp; 
                                            </td>    
                                            
                                      <td>
                                          
                                            <?php if($approve){ ?>
                                                    <?php if($content['content_active_status'] == 1) {?>
                                                            <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/".$controller."/active/".$content['content_id'];?>"><i class="icon-ok"></i></a> &nbsp; 
                                                    <?php } else { ?>
                                                            <a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/".$controller."/active/".$content['content_id'];?>"><i class="icon-remove"></i></a> &nbsp;
                                                    <?php } ?>
                                            <?php } ?>

                                            <?php if($edit){ ?>
                                                    <a class="btn-primary btn-sm" title="Click to Edit" href="<?php echo BASE_URL_BACKEND.'/'.$controller;?>/edit/<?php echo $content['content_id'];?>"><i class="icon-pencil"></i></a> &nbsp; 
                                            <?php } ?>

                                            <?php if($delete){ ?>
                                                    <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $content['content_title'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;?>/delete/<?php echo $content['content_id'];?>';}"><span class="icon-trash"></span></a> &nbsp;
                                            <?php } ?>
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
	
	<!-- js placed at the end of the document so the content load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>

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
	function updateOrder(){
		var frm = document.formAssignment;
		var answer = confirm('are you sure want to update order?');
		
		if(answer){
			frm.action = '<?php echo BASE_URL_BACKEND.'/'.$controller;?>/doOrder';
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
				window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;;?>/editLang/'+val;
			} else if(size == 2){
				window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;;?>/addLang/'+val;
			}
		});

	});
	</script>
</body>
</html	