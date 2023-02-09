<!--sidebar start-->
<aside>
  <div id="sidebar"  class="nav-collapse ">
	  <!-- sidebar menu start-->
	  <ul class="sidebar-menu" id="nav-accordion">
		  <li>
			  <a href="<?php echo BASE_URL_BACKEND."/home";?>">
				  <i class="icon-dashboard"></i>
				  <span>Dashboard</span>
			  </a>
		  </li>
		  <?php if($_SESSION['admin_data']['user_level_id'] == 1) {?>
		  <li class="sub-menu">
			  <a <?php if($section == 'access'){echo ' class="active"'; }?> href="javascript:;">
				  <i class="icon-cogs"></i>
				  <span>Access Management</span>
			  </a>
			  <ul class="sub">
				  <li <?php if($modul_id == '3'){ echo ' class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/userlevel">User Level</a></li>
				  <li <?php if($modul_id == '2'){ echo ' class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/user">User</a></li>
				  <li <?php if($modul_id == '4'){ echo ' class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/module_group">Module Group</a></li>
				  <li <?php if($modul_id == '5'){ echo ' class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/module">Module</a></li>
				  <li <?php if($modul_id == '6'){ echo ' class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/access">Access</a></li>
			  </ul>
		  </li>
		  <?php } ?>
		  
		 
		  <?php foreach($ListMenu as $menu){ ?>
		  <li class="sub-menu">
			  <a <?php if($section != $menu['module_group_id']){echo ''; } else {echo 'class="active"'; }?> href="javascript:;">
				  <i class="icon-tasks"></i>
				  <span><?php echo $menu['module_group_name'];?></span>
			  </a>
			  <ul class="sub">
			  <?php foreach($menu['module'] as $module){ ?>
				 <?php if($module['access_privilege_status'] == 1){?>
				 <li <?php if($modul_id == $module['module_id']){ echo 'class="active"'; } ?>><a href="<?php echo BASE_URL_BACKEND; ?>/<?php echo $module['module_path']?>"><?php echo $module['module_name']?></a></li>
				<?php } ?>
			  <?php } ?>
			  </ul>
		  </li>	  
		  <?php } ?>
	  </ul>
	  <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->