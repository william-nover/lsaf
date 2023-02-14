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
   <body class="bg-light-gray">
      <?php include 'include/tagmanager.php';?>
      <!-- start header -->
      <?php include 'include/vheader.php';?>
      <!-- end header -->
      
      <section class="wow fadeIn bg-light-gray">
         <div class="container card">
            <div class="row">
               <div class="col-md-auto">
                  <img src="<?= html_entity_decode(contentValue($content, 'images'));?>" alt="<?= html_entity_decode(contentValue($content, 'title'));?>" class="blog-img-circle" data-no-retina=""> 
               </div>
               <div class="col description">
                  <span class="text-uppercase"><?=html_entity_decode(contentValue($content, 'category'))?></span> 
                  <span class="line-height-normal font-weight-600 text-small alt-font margin-5px-bottom text-extra-dark-gray text-uppercase d-block">
                        <?=html_entity_decode(contentValue($content, 'title'));?>
                  </span>
                  <br>
                  <p class="text-medium-gray text-medium"><?=html_entity_decode(contentValue($content, 'desc'));?>...</p>
               </div>
            </div>
         </div>
      </section>
      <section class="wow fadeIn bg-light-gray related-post">
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
<style>
   .blog-img-circle{
      border-radius: 50%;
      width: 320px;
      height: 310px;
      margin:50px;
   }
   .port-row{
      display: inline;
      float: left;
   }
   .new-row{
      margin-left: auto;
      margin-right: auto;
   }
   .description{
      margin-top:50px;
      margin-bottom:50px;
      margin-right:50px;
   }
   .related-post{
      padding:20px 0;
   }
</style>