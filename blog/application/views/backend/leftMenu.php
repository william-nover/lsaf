<!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
               <!-- BEGIN: Aside Menu -->
               <div  id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true"  data-menu-scrollable="false" data-menu-dropdown-timeout="500"  >
                  <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                     <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="<?php echo BASE_URL_BACKEND."/home";?>" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                        Dashboard
                        </span>
                        
                        </span>
                        </span>
                        </a>
                     </li>
                     
                      <?php if($_SESSION['admin_data']['user_level_id'] == 1) {?>
                     <li class="m-menu__section">
                        <h4 class="m-menu__section-text">
                           General
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                     </li>
                    <li class="m-menu__item  m-menu__item--submenu <?php if($section == 'access'){echo 'm-menu__item--open m-menu__item--expanded'; }?>" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                        <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-user-settings"></i>
                        <span class="m-menu__link-text">
                        Access Management
                        </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                           <span class="m-menu__arrow"></span>
                           <ul class="m-menu__subnav">
                              <li class="m-menu__item <?php if($modul_id == '3'){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/userlevel" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                 <span class="m-menu__link-text">User Level</span>
                                 </a>
                              </li>
                              <li class="m-menu__item <?php if($modul_id == '2'){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/user" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                  <span class="m-menu__link-text"> User </span>
                                 </a>
                              </li>
                              <li class="m-menu__item <?php if($modul_id == '4'){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/module_group" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                 <span class="m-menu__link-text"> Module Group </span>
                                 </a>
                              </li>
                              <li class="m-menu__item <?php if($modul_id == '5'){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/module" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                 <span class="m-menu__link-text"> Modules </span>
                                 </a>
                              </li>
                              <li class="m-menu__item <?php if($modul_id == '6'){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/access" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                 <span class="m-menu__link-text"> Access </span>
                                 </a>
                              </li>
				  
                           </ul>
                        </div>
                     </li>
                       <?php } ?>
                     <li class="m-menu__section">
                        <h4 class="m-menu__section-text">
                           Components
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                     </li>
                     
                     <?php foreach($ListMenu as $menu){ ?>
                     
                     <li class="m-menu__item  m-menu__item--submenu <?php if($section != $menu['module_group_id']){echo ''; } else {echo 'm-menu__item--open m-menu__item--expanded'; }?>" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                        <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-list-1"></i>
                        <span class="m-menu__link-text">
                        <?php echo $menu['module_group_name'];?>
                        </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                           <span class="m-menu__arrow"></span>
                           <ul class="m-menu__subnav">      
                            <?php foreach($menu['module'] as $module){ ?>
                                  <?php if($module['access_privilege_status'] == 1){?>
                              <li class="m-menu__item <?php if($modul_id == $module['module_id']){ echo 'm-menu__item--active'; } ?>" aria-haspopup="true" >
                                 <a  href="<?php echo BASE_URL_BACKEND; ?>/<?php echo $module['module_path']?>" class="m-menu__link ">
                                 <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                 <span class="m-menu__link-text">
                                    <?php echo $module['module_name']?>
                                 </span>
                                 </a>
                              </li>
                              <?php } ?>
                            <?php } ?>
                           </ul>
                        </div>
                     </li>
                     <?php } ?> 
                  </ul>
               </div>
               <!-- END: Aside Menu -->
            </div>
            <!-- END: Left Aside -->