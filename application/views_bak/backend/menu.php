<!--header start-->
<header class="header white-bg">
	  <div class="sidebar-toggle-box">
		  <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
	  </div>
	  <!--logo start-->
	  <a href="<?php echo BASE_URL_BACKEND."/home";?>" class="logo"><!--<img src="<?php echo IMAGES_BASE_URL;?>/logo.png" alt="logo">-->CMS <span></span></a>
	  <!--logo end-->
	  <div class="top-nav ">
		  <ul class="nav pull-right top-menu">
			  <!-- user login dropdown start-->
			  <li class="dropdown">
				  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
					  <span class="username"><?php echo $admin_data['user_name']; ?></span>
					  <b class="caret"></b>
				  </a>
				  <ul class="dropdown-menu extended">
					  <div class="log-arrow-up"></div>
                      <li><a href="<?php echo BASE_URL_BACKEND; ?>/changePassword"><i class=" icon-suitcase"></i> Change Password</a></li>
					  <li><a href="<?php echo BASE_URL_BACKEND; ?>/signout"><i class="icon-key"></i> Log Out</a></li>
				  </ul>
			  </li>
			  <!-- user login dropdown end -->
		  </ul>
	  </div>
  </header>
  <!--header end-->
