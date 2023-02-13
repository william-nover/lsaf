<!doctype html>
<html class="no-js" lang="id">
   <?php
   $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
      if($countContent > 0){
      $i=0;
      foreach($ListContent as $content){
              $i++;
      ?> 
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- title -->
      <title><?= html_entity_decode(contentValue($content, 'category'));?> | <?= html_entity_decode(contentValue($content, 'title'));?>  -  London School of Accountancy  And Finance</title>
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
      <meta name="author" content="London School of Accountancy  And Finance">
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="London School of Accountancy  And Finance" />
        <meta property="og:title" content="<?= html_entity_decode(contentValue($content, 'category'));?> | <?= html_entity_decode(contentValue($content, 'title'));?>" />
        <meta property="og:image" content="<?= html_entity_decode(contentValue($content, 'images'));?>" />
        <meta property="og:description" content="<?= html_entity_decode(contentValue($content, 'meta_description'));?>" />
        <meta property="og:url" content="<?=$link?>" />
        <link rel="canonical" href="https://www.lsafglobal.com/" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@LSAF_JKT" />
        <meta name="twitter:site:id" content="@LSAF_JKT" />
        <meta name="twitter:creator" content="@LSAF_JKT" />
      <!-- description -->
      <meta name="description" content="<?= html_entity_decode(contentValue($content, 'meta_description'));?>">
      <!-- keywords -->
      <meta name="keywords" content="<?= html_entity_decode(contentValue($content, 'meta_keywords'));?>">
      <!-- favicon -->
      <?php include 'include/icon.php';?>
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/animate.css" />
        <!-- bootstrap -->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" media="all">
      
        <!-- et line icon --> 
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/et-line-icons.css" />
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/font-awesome.min.css" />
        <!-- themify icon -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/themify-icons.css">
        <!-- justified gallery  -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/justified-gallery.min.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/magnific-popup.css" />
        <!-- revolution slider -->
        
        <!-- bootsnav -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/bootsnav.css">
        <!-- style -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/style.css" />
        <!-- responsive css -->
        <link rel="stylesheet" href="<?= FRONTEND_BASE_URL; ?>/css/responsive.css" />
       <link rel="stylesheet" type="text/css" href="<?= FRONTEND_BASE_URL; ?>/share/jssocials.css" />
      <link rel="stylesheet" type="text/css" href="<?= FRONTEND_BASE_URL; ?>/share/jssocials-theme-flat.css" />
      <script>
         !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
      </script>
      <!--[if IE]>
      <script src="<?= FRONTEND_BASE_URL; ?>/js/html5shiv.js" defer></script>
      <![endif]-->
    
      
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="<?= FRONTEND_BASE_URL; ?>/share/jssocials.js"></script>
      <?php include 'include/analytics.php';?>
   </head>
   <body>
      <?php include 'include/tagmanager.php';?>
      <!-- start header -->
      <?php include 'include/vheader.php';?>
      <!-- end header -->
      <section class="wow fadeIn bg-light-gray padding-35px-tb page-title-small top-space" style="margin-top: 72px; visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-md-6 d-flex flex-column justify-content-center text-center text-md-left">
                        <!-- start page title -->
                       <h1 class="text-black alt-font font-weight-400 letter-spacing-minus-1 margin-10px-bottom"><?= html_entity_decode(contentValue($content, 'title'));?></h1>
                        <!-- end page title -->
                    </div>
                    <div class="col-xl-4 col-md-6 alt-font breadcrumb justify-content-center justify-content-md-end text-small sm-margin-10px-top">
                        <!-- start breadcrumb -->
                        <span class="text-dark-gray opacity6 alt-font no-margin-bottom text-uppercase text-small">
                         <a href="<?=BASE_URL?>/blog" title="blog" class="text-dark-gray">Blog</a>
                         &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;by <a href="<?=BASE_URL?>"  title="lsafglobal" class="text-dark-gray">lsafglobal</a>
                         &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                         <a href="#" title="<?= html_entity_decode(contentValue($content, 'category'));?>" class="text-dark-gray"><?= html_entity_decode(contentValue($content, 'category'));?></a>
                         &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <?= date_convert(contentValue($content, 'publish_date'));?>
                     </span>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
      
      <section class="wow fadeIn">
         <div class="container">
            <div class="row">
               <main class="col-12 col-lg-9 right-sidebar md-margin-60px-bottom sm-margin-40px-bottom md-padding-15px-lr">
                  <img src="<?= html_entity_decode(contentValue($content, 'images'));?>" alt="<?= html_entity_decode(contentValue($content, 'title'));?>" class="width-100" data-no-retina="">       
                  <hr>
                  <?= html_entity_decode(contentValue($content, 'desc'));?> 
                 <!-- 
                  <span class="d-block text-medium-gray text-small" ><i class="fas fa-eye"><?=$content['views']?></i></span>
                 --> 
                 <br/>
                 
                  <strong>Share</strong>
                  <div id="sharePopup"></div>
                  <script>
                            $(function() {

                                //url = get url page to share 
                                //text= title share
                                 var url = window.location.href;
                                 var text ='<?= html_entity_decode(contentValue($content, 'title'));?>';
                                   
                                 $("#sharePopup").jsSocials({
                                     url: url,
                                     text: text,
                                     showLabel: false,
                                     showCount: false,
                                     shares: ["facebook","whatsapp", "twitter", "email", "line", "telegram", "messenger"]
                                 });

                             });
                         </script>
                    <hr>
                    
                    <script src="https://www.powr.io/powr.js?platform=html"></script><div class="powr-comments" id="831b07c2_1571127538"></div>
               
               </main>
               
                <aside class="col-12 col-lg-3">
                    <div class="margin-45px-bottom sm-margin-25px-bottom">
                            <div class="text-extra-dark-gray margin-25px-bottom alt-font text-uppercase font-weight-600 text-small aside-title"><span>Popular Blog</span></div>
                            <ul class="latest-post position-relative">
                                 <?php
                                if($countLatestBlog > 0){
                                $i=0;
                                foreach($LatestBlog as $lb){
                                $i++;
                                if ($lb['row_alias'] !=''){                          
                                    $ref1 =BASE_URL.'/'.$lb['row_alias'];
                                    }                       
                                    else {                          
                                 $ref1 = BASE_URL.'/'.$controller.'/detail/'.$lb['row_id'];           
                                 }  
                                ?> 
                                <li class="media">
                                    <figure>
                                        <a href="<?=$ref1;?>" title="<?= html_entity_decode(contentValue($lb, 'title'));?>">
                                         <img src="<?=str_replace('/admin/','/admin/.thumbs/',contentValue($lb, 'images'));?>" alt="<?= html_entity_decode(contentValue($lb, 'title'));?>">
                                        </a>
                                    </figure>
                                    <div class="media-body text-small">
                                        <a href="<?=$ref1;?>" title="<?= html_entity_decode(contentValue($lb, 'title'));?>" class="text-extra-dark-gray">
                                            <span class="d-block margin-5px-bottom"><?= html_entity_decode(contentValue($lb, 'title'));?></span>
                                        </a> 
                                        <span class="d-block text-medium-gray text-small"><?= date_convert(contentValue($lb, 'publish_date'));?></span>
                                    </div>
                                </li>
                          <?php } } ?>        
                            </ul>
                        </div>
                </aside>
                
                
                
            </div>
         </div>
      </section>
      <section class="wow fadeIn bg-light-gray">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12 center-col text-center margin-80px-bottom xs-margin-40px-bottom">
                  <div class="position-relative overflow-hidden width-100">
                     <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">Related Posts</span>
                  </div>
               </div>
            </div>
            <div class="row col-4-nth sm-col-2-nth">
               <?php
                  if($countPr > 0){
                  $i=0;
                  foreach($ListPr as $ls){
                  $i++;
                  if ($ls['row_alias'] !=''){                          
                      $ref =BASE_URL.'/'.$ls['row_alias'];
                      }                       
                      else {                          
                   $ref = BASE_URL.'/'.$controller.'/detail/'.$ls['row_id'];           
                   }  
                  ?>  
               <!-- start post item -->
               <div class="col-md-3 col-sm-6 col-xs-12 last-paragraph-no-margin sm-margin-50px-bottom xs-margin-30px-bottom wow fadeInUp">
                  <div class="blog-post blog-post-style1 xs-text-center">
                     <div class="blog-post-images overflow-hidden margin-25px-bottom sm-margin-20px-bottom">
                        <a href="<?=$ref;?>">
                            <img width="150" height="150" src="<?= html_entity_decode(contentValue($ls, 'images'));?>" alt="<?= html_entity_decode(contentValue($ls, 'title'));?>">
                        </a>
                     </div>
                     <div class="post-details">
                        <span class="post-author text-extra-small text-medium-gray text-uppercase display-block margin-10px-bottom xs-margin-5px-bottom"><?= date_convert(contentValue($ls, 'date'));?> | <?= contentValue($ls, 'category');?></span>
                        <a href="<?=$ref;?>" class="post-title text-medium text-extra-dark-gray width-90 display-block sm-width-100" title="<?= html_entity_decode(contentValue($ls, 'title'));?>"><h2 class="text-medium"><?= html_entity_decode(contentValue($ls, 'title'));?></h2></a>
                        <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb sm-margin-15px-tb"></div>
                   
                     </div>
                  </div>
               </div>
               <!-- end post item -->
               <?php } } ?>
            </div>
         </div>
      </section>
      <!-- start blog navigation bar section -->
      <section class="wow fadeIn border-top border-width-1 border-color-medium-gray no-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="display-table width-100 padding-30px-lr sm-padding-15px-lr">
                  <?php if($prev){?>
                  <div class="width-45 text-left display-table-cell vertical-align-middle">
                     <div class="blog-nav-link blog-nav-link-prev text-extra-dark-gray">
                        <a href="<?= $prev?>">
                        <i class="ti-arrow-left blog-nav-icon"></i>
                        Previous Blog
                        </a>
                     </div>
                  </div>
                  <?php }?>
                  <div class="width-10 text-center display-table-cell vertical-align-middle">
                     <a href="services.html" class="blog-nav-link blog-nav-home"><i class="ti-layout-grid"></i></a>
                  </div>
                  <?php if($next){?>
                  <div class="width-45 text-right display-table-cell vertical-align-middle">
                     <div class="blog-nav-link blog-nav-link-next text-extra-dark-gray">
                        <a href="<?= $next?>">
                        <i class="ti-arrow-right blog-nav-icon"></i>
                        Next Blog
                        </a>
                     </div>
                  </div>
                  <?php }?>
               </div>
            </div>
         </div>
      </section>
      <!-- end blog navigation bar section -->
      <!-- start footer -->
      <?php include 'include/vfooter.php';?>
      <!-- javascript libraries -->
      <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/modernizr.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/skrollr.min.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/smooth-scroll.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/jquery.appear.js"></script>
        <!-- menu navigation -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/bootsnav.js"></script>
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/jquery.nav.js"></script>
        <!-- animation -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/wow.min.js"></script>
        <!-- page scroll -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/page-scroll.js"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/swiper.min.js"></script>
      
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/jquery.magnific-popup.min.js"></script>
        <!-- portfolio with shorting tab -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/isotope.pkgd.min.js"></script>
        <!-- images loaded -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/imagesloaded.pkgd.min.js"></script>
        <!-- pull menu -->
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/classie.js"></script>
    
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/justified-gallery.min.js"></script>
   
        <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/retina.min.js"></script>
     
          <script type="text/javascript" src="<?= FRONTEND_BASE_URL; ?>/js/main.js"></script>

   </body>
   <?php  } } ?>
</html>