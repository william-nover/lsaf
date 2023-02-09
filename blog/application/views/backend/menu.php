 <!-- BEGIN: Header -->
         <header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
            <div class="m-container m-container--fluid m-container--full-height">
               <div class="m-stack m-stack--ver m-stack--desktop">
                  <!-- BEGIN: Brand -->
                  <div class="m-stack__item m-brand  m-brand--skin-dark ">
                     <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                           <a href="<?php echo BASE_URL; ?>/backend" class="m-brand__logo-wrapper">
                               <img alt="" src="<?php echo IMAGES_BASE_URL; ?>/logo.png" height="65px"/>
                           </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                           <!-- BEGIN: Left Aside Minimize Toggle -->
                           <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
                              ">
                           <span></span>
                           </a>
                           <!-- END -->
                           <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                           <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                           <span></span>
                           </a>
                           <!-- END -->
                           <!-- BEGIN: Responsive Header Menu Toggler -->
                           <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                           <span></span>
                           </a>
                           <!-- END -->
                           <!-- BEGIN: Topbar Toggler -->
                           <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                           <i class="flaticon-more"></i>
                           </a>
                           <!-- BEGIN: Topbar Toggler -->
                        </div>
                     </div>
                  </div>
                  <!-- END: Brand -->
                  <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                     <!-- BEGIN: Horizontal Menu -->
                     <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                     <i class="la la-close"></i>
                     </button>
                     
                     <!-- END: Horizontal Menu -->								<!-- BEGIN: Topbar -->
                     <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                           <ul class="m-topbar__nav m-nav m-nav--inline">
                              <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                 <a href="#" class="m-nav__link m-dropdown__toggle">
                                 <span class="m-topbar__userpic">
                                 <img src="<?php echo IMG_BASE_URL; ?>/usericon.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                 </span>
                                 <span class="m-topbar__username m--hide">
                                 <?php echo $_SESSION['admin_data']['user_name']; ?>
                                 </span>
                                 </a>
                                 <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                       <div class="m-dropdown__header m--align-center" style="background: url(<?php echo BACKEND_BASE_URL; ?>/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                          <div class="m-card-user m-card-user--skin-dark">
                                             <div class="m-card-user__pic">
                                                <img src="<?php echo IMG_BASE_URL; ?>/usericon.png" class="m--img-rounded m--marginless" alt=""/>
                                             </div>
                                             <div class="m-card-user__details">
                                                <span class="m-card-user__name m--font-weight-500">
                                               <?php echo $_SESSION['admin_data']['user_name']; ?>
                                                </span>
                                                
                                             </div>
                                          </div>
                                       </div>
                                       <div class="m-dropdown__body">
                                          <div class="m-dropdown__content">
                                             <ul class="m-nav m-nav--skin-light">
                                                <li class="m-nav__section m--hide">
                                                   <span class="m-nav__section-text">
                                                   Section
                                                   </span>
                                                </li>
                                                <li class="m-nav__item">
                                                   <a href="<?php echo BASE_URL_BACKEND; ?>/changePassword" class="m-nav__link">
                                                   <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                   <span class="m-nav__link-title">
                                                   <span class="m-nav__link-wrap">
                                                   <span class="m-nav__link-text">
                                                   Change password
                                                   </span>
                                                   
                                                   </span>
                                                   </span>
                                                   </a>
                                                </li>
                                                
                                               
                                               
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__item">
                                                   <a href="<?php echo BASE_URL_BACKEND; ?>/signout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                   Logout
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <!-- END: Topbar -->
                  </div>
               </div>
            </div>
         </header>
         <!-- END: Header -->