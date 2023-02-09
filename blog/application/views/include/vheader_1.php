<?php 
    $ci =& get_instance();
    $ci->load->model('web/Model_content');
    $ListSosmed =array();
    $ListLoc =array();
    
    $sosmed=121;
    $string =$sosmed;
    $arrayin=array_map('intval', explode(',', $string));
    $where_in = implode(",",$arrayin);
    $order_sosmed='';
    $order_sosmed .= " order by a.row_order ASC";
    $order_sosmed .= " limit  0, 8";
    $whereSosmed = '';
    $whereSosmed .= " WHERE a.row_active_status=1 and a.row_active_status=1 and a.row_parent=0 and a.module_id in(".$where_in.") ";            
    $ListSosmedAll = $ci->Model_content->getListContent($whereSosmed,$order_sosmed);        
    foreach ($ListSosmedAll as $lc){
                    if ($lc['module_id']== $sosmed){
                        $ListSosmed[]=$lc; 
                        $countSosmed = count($ListSosmed);
                    } 
                }
    ?>
<header>
            <!-- start navigation -->
            <nav class="navbar navbar-default bootsnav background-white navbar-expand-lg">
                <div class="container nav-header-container">
                    <!-- start logo -->
                    <div class="col-auto pl-0">
                        <a href="https://lsafglobal.com/" target="_blank" title="logo" class="logo">
                            <img src="<?=IMAGES_BASE_URL;?>/logo-color.png" data-rjs="<?=IMAGES_BASE_URL;?>/logo-color.png" class="logo-light default" alt="logo">
                        </a>
                    </div>
                    <!-- end logo -->
                    <div class="col accordion-menu pr-0 pr-md-3">
                        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
                            <ul id="accordion" class="nav navbar-nav navbar-left no-margin alt-font text-normal" data-in="fadeIn" data-out="fadeOut">
                                    <li class="">
                                        <a href="<?=BASE_URL;?>" title="home">Home</a>
                                    </li>    
                                    <li class="">
                                        <a href="https://lsafglobal.com" target="_blank" title="about us">About Us</a>
                                    </li>
                                    <!-- end menu item -->
                                  
                                    <li class="">
                                        <a href="<?=BASE_URL;?>/blog.html" title="Blog">Blog</a>
                                    </li>
                                   
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto pr-lg-0">
                        <div class="header-social-icon d-none d-md-inline-block">
                             <?php if($countSosmed > 0){
                                $i=0;
                                foreach($ListSosmed as $loc){  $i++;  
                                ?>
                                            <a title="facebook" href="<?= html_entity_decode(contentValue($loc, 'fb'));?>/" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                            <a title="twitter" href="<?= html_entity_decode(contentValue($loc, 'tw'));?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                            <a title="lk" href="<?= html_entity_decode(contentValue($loc, 'lk'));?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                                            <a title="youtube" href="<?= html_entity_decode(contentValue($loc, 'yt'));?>" target="_blank"><i class="fab fa-youtube no-margin-right" aria-hidden="true"></i></a>
                                        <?php }}?>  
                         </div>
                    </div>
                </div>
            </nav>
            <!-- end navigation --> 
        </header>
