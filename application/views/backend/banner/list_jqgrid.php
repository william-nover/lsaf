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
						  <form name="order" id="orderForm" method="post" action="<?php echo BASE_URL_BACKEND; ?>/faq/order">
						  <div class="panel-body">
							<table id="grid"></table> <!--Grid table-->
							<div id="paging"></div>  <!--pagination div-->
                          </div>
						  
						  <script type="text/javascript">
								 $(document).ready(function () {
									$("#grid").jqGrid({
									url:'<?php echo BASE_URL_BACKEND.'/banner/loadDataGrid'?>',      //another controller function for generating data
										mtype : "POST",             //Ajax request type. It also could be GET
										datatype: "json",            //supported formats XML, JSON or Arrray
										colNames:['ID','Banner Name', 'Banner Type', 'Banner Images','Banner URL','Create Date','Active',<?php if($approve || $edit || $delete){?>'Action' <?php } ?>],       //Grid column headings
										colModel:[
											{name:'banner_id',index:'banner_id',width:5, sorttype:'int', align:'center', hidden:true},
											{name:'banner_name',index:'banner_name', width:20, align:"left",search: true},
											{name:'banner_type',index:'banner_type', width:20, align:"center",search: true},
											{name:'banner_images',index:'banner_images', width:20, align:"center",search: false},
											{name:'banner_url',index:'banner_title', width:20, align:"left",search: true},
											{name:'banner_create_date',index:'banner_create_date', width:15, align:"left",search: false},
											{name:'banner_active_status',index:'banner_active_status', width:15, align:'center',hidden: true, search: false, sortable:false},
											<?php if($approve || $edit || $delete){?>{name:'act',index:'act', width:8,sortable:false, align:'center',search: false},<?php } ?>
										],
										rowNum:10,
										width: 1100,
										height: 300,
										rowList:[10,50,100],
										pager: '#paging',
										sortname: 'banner_id',
										viewrecords: true,
										sortorder: "desc",
										toolbar: [true,"top"],
										<?php if($delete){?>
										multiselect: true,
										<?php } else { ?>
										multiselect: false,
										<?php } ?>
										rownumbers: true,
										caption:"<i class=\"icon-tasks\"></i>&nbsp;<?php echo $title_grid;?>",
										gridComplete: function(){
											var ids = $("#grid").jqGrid('getDataIDs');
											var arr = new Array();
											for (var j = 0; j < ids.length; j++) {                
												var k = ids[j];
												var l = $("#grid").jqGrid ('getRowData', k);	
												var m = l.module_group_order_value;
												arr.push(m);
											}
											var minvalue = Math.min.apply(Math,arr);
											var maxvalue = Math.max.apply(Math,arr);
											
											for (var i = 0; i < ids.length; i++) {                
												var rowId = ids[i];
												var rowData = $("#grid").jqGrid ('getRowData', rowId);
												
												var cl = ids[i];
												
												<?php if($approve){?>
													var active_status = rowData.banner_active_status;
													if(active_status == 1){
														var active = "<a href='#' customValActive="+cl+" class='actives' title='Change Status' style='color:#000; padding-top:2px; padding-bottom:2px; margin-top:5px; margin-bottom:5px;'><span id='jq-active'></span></a>";
													} else {
														var active = "<a href='#' customValActive="+cl+" class='actives' title='Change Status' style='color:#000; padding-top:2px; padding-bottom:2px; margin-top:5px; margin-bottom:5px;'><span id='jq-inactive'></span></a>";
													}
												<?php } else { ?>
													var active = "";
												<?php } ?>
												
												<?php if($edit){?>
													var edit = "<a href='#' customValEdit="+cl+" class='edit' title='Edit' style='color:#000; padding-top:2px; padding-bottom:2px; margin-top:5px; margin-bottom:5px;'><span id='jq-edit'></span></a>";
												<?php } else { ?>
													var edit = "";
												<?php } ?>
												
												<?php if($delete){?>
													var titledel = rowData.banner_title;
													var del = "<a href='#' style='color:#000; padding-top:2px; padding-bottom:2px; margin-top:5px; margin-bottom:5px;' onclick=\"var answer = confirm('are you sure to delete "+titledel+" ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND."/banner/"; ?>/delete/"+cl+"';}\" title='Delete'><span id='jq-delete'></span></a>";
												<?php } else { ?>			
													var del = "";
												<?php } ?>
												
												var divider = "<span id='jq-divider'></span>";

												$("#grid").jqGrid('setRowData', ids[i], { 
													act: active+divider+edit+divider+del
												});
												
											}
											
											// Button Active / Inactivite
											$("a.actives").click(function() {
												var gridRowID = $(this).attr("customValActive");
												var inside = $(this);
												
												$.ajax({
													type : 'POST',
													url : '<?php echo BASE_URL_BACKEND;?>/banner/active/',
													async:    false,
													dataType : 'json',
													data: {
														id : gridRowID
													},
													success : function(data){
														if (data.error === true){
															if(data.active_status==1){
																inside.html("<span id='jq-active'></span>");
															} else {
																inside.html("<span id='jq-inactive'></span>");
															}
														} else {
															alert('Error function active');
														}
													},
													error : function(XMLHttpRequest, textStatus, errorThrown) {
														alert(errorThrown);
													}
												});
												
												return false;
											})
											
											// Button Edit
											$("a.edit").click(function() {
												var gridRowID = $(this).attr("customValEdit");
												window.open('<?php echo BASE_URL_BACKEND;?>/banner/edit/'+gridRowID, '_top');
											})
										},	
									});
									
									$("#grid").jqGrid('navGrid','#paging',{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true, multipleGroup:true, resize: true, closeOnEscape: true});
									$("#grid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
									
									// tambah button di top
									$("#t_grid").append("<div style='padding-left:4px;'><?php if($add){?><div id='adddata' style='width:50px; float:left;'><input type='button' value=' ' style='height:19px;padding-top:3px;' class='button-add' title='add data'/>Add</div><?php } ?><?php if($delete){?><div id='deletedata' style='width:65px; float:left;'><input type='button' value=' ' style='height:19px;padding-top:3px;' class='button-delete' title='delete selected data'/>Delete</div><?php } ?><?php if($order){?><div id='orderdata' style='width:60px;float:left;margin-top:2px;'><input type='button' value='' title='order' class='button-order'>Order</div><?php } ?></div>");
									
									<?php if($order){?>
									// Button Order di klik
									$("#orderdata").click(function(){
										$("#orderForm").submit();
									});
									<?php } ?>
									
									<?php if($add){?>
									// Button Add di klik
									$("#adddata").click(function(){
										window.open('<?php echo BASE_URL_BACKEND;?>/banner/add', '_top');
									});
									<?php } ?>
									
									<?php if($delete){?>
									// get selection data to delete all selected data
									$("#deletedata").click( function() {
										var del = $("#grid").jqGrid('getGridParam','selarrrow');
										jml = del.length;
										del = del.toString();
										var a;
										for(a=1;a<=jml;a++){
											del = del.replace(",","-");
										}
										
										if (del != "") {
											 var answer = confirm('are you sure to delete this ?');
											if (answer){
												var ret = $("#grid").jqGrid('getRowData',del);
												window.open('<?php echo BASE_URL_BACKEND;?>/banner/deleteSelectedData/'+del, '_top', 'width=700,height=600');
											}
										} else {
											alert("Please check <?php echo $caption; ?> to delete");
										}
									});
									<?php } ?>
								});
						  </script>
						  </form>
					  </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
	  
	  <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>

	</section>
	
	<!-- js placed at the end of the document so the banner load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.scrollTo.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js" ></script>
	
	<!-- start jqgrid -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TOOLS_BASE_URL; ?>/jqgrid/themes/start/jquery-ui-1.9.2.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TOOLS_BASE_URL; ?>/jqgrid/themes/ui.jqgrid.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TOOLS_BASE_URL; ?>/jqgrid/themes/ui.multiselect.css" />

	<link href="<?php echo CSS_BASE_URL; ?>/custom-jqgrid.css" rel="stylesheet" type="text/css">
	<script src="<?php echo TOOLS_BASE_URL; ?>/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="<?php echo TOOLS_BASE_URL; ?>/jqgrid/js/jquery.jqGrid.update.min.js" type="text/javascript"></script>
	<!-- end jqgrid -->
	
    <!--common script for all banner-->
    <script src="<?php echo JS_BASE_URL; ?>/common-scripts.js"></script>
	<script>
	$(window).bind('resize', function() {
		$("#grid").setGridWidth($('.panel-body').width(), true);
	}).trigger('resize');
	</script>
	
	<!-- fancybox -->
	<script src="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.js"></script>
	<link href="<?php echo TOOLS_BASE_URL; ?>/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		//fancybox
		$("a#viewBackend").fancybox({
			'overlayShow'		: true,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'width'				: '100%',
			'height'			: '100%'
		});
	});
	</script>
	<!-- end fancybox -->
	
</body>
</html	