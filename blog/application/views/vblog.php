<!DOCTYPE html>
<html lang="en">
<head>

<meta name="google-site-verification" content="ifppdmItQ2_0EOlLhd_w5reamOAw6RcRza-Yr08RJDE" />
<meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="London School of Accountancy  And Finance" />
<meta property="og:title" content="Your Keys to Global Careers" />
<meta property="og:image" content="https//lsafglobal.com/assets/images/logo-master.jpg" />
<meta property="og:description" content="Your Keys to Global Careers" />
<meta property="og:url" content="https//www.lsafglobal.com/" />

<meta property="og:image:type" content="image/jpeg" /> 
<meta property="og:image:width" content="650" /> 
<meta property="og:image:height" content="366" />
<meta charset="utf-8">

<title>London School of Accountancy  And Finance</title>
<link href="https://plus.google.com/115543368685609823179?hl=en" rel="publisher" />
<meta name="copyright" content="Lsafglobal" itemprop="dateline" />
<meta name="robots" content="index, follow" />
<meta name="description" content="" itemprop="description" />
<meta content="Your Keys to Global Careers" itemprop="headline" />
<meta name="keywords" content="Your Keys to Global Careers" itemprop="keywords" />
<meta name="thumbnailUrl" content="https//lsafglobal.com/assets/images/logo-master.jpg" itemprop="thumbnailUrl" />
<meta property="article:author" content="https://www.facebook.com/LSAF.ACCA.JAKARTA/" itemprop="author" />
<meta property="article:publisher" content="https://www.facebook.com/LSAF.ACCA.JAKARTA/" />
<meta name="pubdate" content="2016-04-06T12-12-35Z" itemprop="datePublished" />
<meta content="2016-04-06T12-12-35Z" itemprop="dateCreated" />
<meta content=https//www.lsafglobal.com/" itemprop="url" />
<link rel="canonical" href="https://www.lsafglobal.com/" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@LSAF_JKT" />
<meta name="twitter:site:id" content="@LSAF_JKT" />
<meta name="twitter:creator" content="@LSAF_JKT" />
 <?php include 'include/icon.php';?>
        <!-- animation -->
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
        <!--[if IE]>
            <script src="<?= FRONTEND_BASE_URL; ?>/js/html5shiv.js"></script>
        <![endif]-->
           <?php include 'include/analytics.php';?>
         
    </head>

    <body> 
         <?php include 'include/tagmanager.php';?>
        <?php include 'include/vheader.php';?>
        <!-- start page title section -->
        <section class="wow fadeIn bg-light-gray padding-35px-tb page-title-small top-space">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-md-6 d-flex flex-column justify-content-center text-center text-md-left">
                        <!-- start page title -->
                        <h1 class="alt-font text-extra-dark-gray font-weight-600 mb-0 text-uppercase">Blog</h1>
                        <!-- end page title -->
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- end page title section -->
        <!-- start portfolio section -->
        <section class="wow fadeIn padding-30px-top md-padding-50px-top sm-padding-30px-top">
            <div class="container-fluid" id="filter-container">
                <div class="row">
                         <div class="col-12 header" id="myFilter">
                        <!-- start filter navigation -->
                        <ul id="myUl" class="portfolio-filter nav nav-tabs justify-content-center border-0 portfolio-filter-tab-1 font-weight-600 alt-font text-uppercase text-center margin-80px-bottom text-small md-margin-40px-bottom sm-margin-20px-bottom">
                          <li class="nav active"><a href="javascript:void(0);" data-filter="*" class="light-gray-text-link text-very-small">All</a></li>
                              <?php
                              if($countCategory > 0){
                              $i=0;
                              foreach($ListCategory as $ls){
                              $i++;
                                
                              ?>  
                            
                            <li class="nav"><a href="javascript:void(0);" data-filter=".<?= generateCategory($ls['options_title'])?>" class="light-gray-text-link text-very-small"><?= $ls['options_title'];?></a></li>
                            
                            <?php } } ?>
                        </ul>                                                                           
                        <!-- end filter navigation -->
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 px-3 p-md-0">
                        <div class="filter-content overflow-hidden">
                            <ul class="portfolio-grid work-3col gutter-medium hover-option6 lightbox-portfolio">
                                <li class="grid-sizer"></li>
                                <!-- start portfolio-item item -->
                                <?php
                              if($countContent > 0){
                              $i=0;
                              foreach($ListContent as $ls){
                              $i++;
                              if ($ls['row_alias'] !=''){                          
                                  $ref =BASE_URL.'/'.$ls['row_alias'];
                                  }                       
                                  else {                          
                               $ref = BASE_URL.'/'.$controller.'/detail/'.$ls['row_id'];           
                               }  
                              ?>  
                                <li class="<?= generateCategory(html_entity_decode(contentValue($ls, 'category')));?> grid-item wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.<?=$i;?>s">
                                    <figure>
                                        <div class="portfolio-img bg-light-gray position-relative text-center overflow-hidden">
                                            <img src="<?= html_entity_decode(contentValue($ls, 'images'));?>" alt="<?= html_entity_decode(contentValue($ls, 'title'));?>">
                                            <div class="portfolio-icon">
                                                <a href="<?=$ref;?>" title="<?= html_entity_decode(contentValue($ls, 'title'));?>"><i class="fas fa-link text-extra-dark-gray" aria-hidden="true"></i></a>
                                                <a class="gallery-link" title="<?= html_entity_decode(contentValue($ls, 'title'));?>" href="<?= html_entity_decode(contentValue($ls, 'images'));?>"><i class="fas fa-search text-extra-dark-gray" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <figcaption class="bg-white">
                                            <div class="portfolio-hover-main text-left">
                                                <div class="portfolio-hover-box align-middle">
                                                    <div class="portfolio-hover-content position-relative">
                                                        <a href="<?=$ref;?>" title="<?= html_entity_decode(contentValue($ls, 'title'));?>">
                                                            <span class="text-uppercase"><?=html_entity_decode(contentValue($ls, 'category'))?></span> 
                                                            <span class="line-height-normal font-weight-600 text-small alt-font margin-5px-bottom text-extra-dark-gray text-uppercase d-block">
                                                            <?=html_entity_decode(contentValue($ls, 'title'));?></span>
                                                        </a>
                                                        <p class="text-medium-gray text-medium"><?= character_limiter(html_entity_decode(contentValue($ls, 'desc')),200);?>...</p>
                                                        <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                                                        <div class="author">
                                                            <span class="text-medium-gray text-uppercase text-extra-small d-inline-block">by <a href="https://lsafglobal.com" title="home" class="text-medium-gray">Lsafglobal</a>&nbsp;&nbsp;|&nbsp;&nbsp;<?= date_convert(contentValue($ls, 'publish_date'));?></span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </li>
                                <!-- end portfolio item -->
                                 <?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>
           
            <div class="text-center margin-100px-top md-margin-50px-top wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="pagination text-small text-uppercase text-extra-dark-gray">
                        <div class="mx-auto">
                            <?=$page_links?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end portfolio section -->
        <!-- start footer --> 
         <?php include 'include/vfooter.php';?>
        <!-- end footer -->
        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
        <!-- end scroll to top  -->
        <!-- javascript libraries -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myFilter");
var ulFix = document.getElementById("myUl");
var fixeds = header.offsetTop;
 var elem = document.querySelector('#filter-container');
function myFunction() {
    
  if (window.pageYOffset > fixeds) {
    header.classList.add("fixeds");
    ulFix.classList.add("filter-fixed");
    elem.classList.add("filter-container");

// Set color to purple
elem.style.color = 'purple';
  } else {
    header.classList.remove("fixeds");
    ulFix.classList.remove("filter-fixed");
    elem.classList.remove("filter-container");
  }
}
</script>
<style type="text/css"> 
.header { 
height: 50px;
z-index: 2;
background-color: #fff!important;
}
.filter-fixed{
padding-top: 15px;
     
}
.fixeds {
width: 100%;
position: fixed;
top: 0;
}
.filter-container {
 margin-top: 80px;
}
</style>
    </body>
</html>