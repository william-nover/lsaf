 <?php /*include VIEWS_PATH_BACKEND."/analytics.php";*/ ?>
 <style>
	html {
		position: absolute;
		width: 100%;
		height: 100%;
	}
	body {
		
		position: absolute;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: #fff;
		background-image: url(http://lsafglobal.com/assets/img/bg_footer_cms.png);
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: left bottom;
	}
	.wrapper {
		padding:0;
	}
	.panel {
		font-family: 'Open Sans', sans-serif;
		padding: 10px 50px;
		background: transparent;
	}
	ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
		background: transparent;
		color: #f49d00;
	}
	.btn-warning, .btn-warning:hover {
		background-color: transparent;
		border-color: #f49d00;
		color: #f49d00;
		font-size: 13px;
		padding: 10px 35px;
		border-radius: 0;
	}
	.btn-warning img {
		margin-right: 20px;
	}
	.panel-heading {
		border: 0px solid #fff;
		font-size: 30px;
		padding-bottom: 0;
		margin-bottom: -10px;
	}
	.panel-heading label {
		margin-bottom: 0;
	}
	h4 label {
		font-weight: normal;
	}
	#sidebar {
		z-index: 1;
	}
	.site-footer {
		position: fixed;
		bottom: 0;
		width: 100%;
		padding-left: 210px;
	}
	.powered {
		margin-right: 20px;
	}
	.panel-footer {
		background: transparent;
		border: 0px solid #fff;
	}
	#support{
		//position: fixed;
		
		
		margin-top: 30px;
		margin-left: -10px;
	
	}
	.right-footer {
		text-align: right;
	}
	.left-footer p {
		margin-left : 10px;
		display: inline-block;
		padding: 0 5px;
		background: #fff;
	}
	.ga {
		width: 1200px;
		padding: 15px;
		margin-left:-6%;
		float:left;
	}
	.row-ga {
		//width: 34%;
		float: left;
	}
	.clear {
		clear: both;
	}
</style>
<body>
	<section id="container" class="">
    <?php include 'analytics.php'; ?>
      <?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
	  
	  <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>

	   <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <section>
                  <div class="panel">
					  <header class="panel-heading">
						  <label for="exampleInputEmail1">WELCOME,</label>
					  </header>
					  <div class="panel-body">
						<p class="text-muted">Here you can publish, edit and modify content, organize, delete as well as maintain your website. </p>
					  </div>
                      <div class="panel-body">
                          <div class="row invoice-list">
                              <!--<div class="text-left corporate-id" style="margin-left:10px;">
								  <img src="<?php echo IMG_BASE_URL;?>/logo-balkat.png" alt="logo balkat">
                              </div>-->
                              <div class="col-lg-6 col-sm-4">
                                  <h4><label for="exampleInputEmail1">Website Information</label></h4>
                                  <p>
                                     Company : London School <br>
                                      URL : www.lsafglobal.com <br>
                                      Launch : ---<br>
                                  </p>
                              </div>
							  <div class="col-lg-6 col-sm-4">
                                  <h4><label for="exampleInputEmail1">CMS User Guide</label></h4>
                                  <p>
									<a class="btn btn-warning btn-lg" target="_blank" href="<?php echo BASE_URL?>/assets/pdf/LSAF_Manual.pdf"><img src="<?php echo IMG_BASE_URL;?>/pdf.png"> Download </a>
                                  </p>
                              </div>
                          </div>
                      </div>
					  
					<h5>&nbsp;&nbsp;&nbsp;Web Analytics </h5>
					  <div class="panel-body ga">
						<div class="row-ga">
							 <div id="chart_line"></div>
						</div>
						<div class="row-ga">
							 <div id="piechart"></div>
						</div>
						<div class="row-ga">						
							<div id="table_div"></div>
						</div>
					  </div>

					  <div class="panel-body panel-footer">
                          <div class="">
                              <div class="col-lg-6 col-sm-4" id="support">
                                  <p>
                                      For Maintenance and Support <br>
									  <span><i class="icon-envelope-alt"></i>&nbsp; support[@]balkat.com</span> &nbsp;&nbsp;&nbsp;&nbsp; <span><i class="icon-phone"></i>&nbsp; +62 21 629 6302</span>
                                  </p>
                              </div>
							  <div class="col-lg-6 col-sm-4 right-footer" id="support">
                                  <p>
									<span class="powered">powered by</span>
                                     <a href="http://balkat.com" target="_blank">  <img src="<?php echo IMG_BASE_URL;?>/logo-black.png" alt="logo balkat"></a>
								</p>
							  </div>
                          </div>
                      </div>
                  </div>
              </section>
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