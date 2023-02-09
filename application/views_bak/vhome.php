<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
</head>

<body>


<?php include "include/fixed.php"; ?>

<div class="container">	
   <?php include "include/vheader.php"; ?>
    <div class="slideshow">
        <div class="acca">
            <h1> ACCA AWARDS </h1>
            <p> Diploma Level Awards </p>
            <a href="#"> <p class="acca-blue"> Diploma in Accounting & Business </p> </a>
            <a href="#"> <p class="acca-blue"> Diploma in International Finance </p> </a>
            <p> Single Awards </p>
            <a href="#"> <p class="acca-blue"> BSc (Hons) Oxford Brookes University (OBU) </p> </a>
            <p> Dual Awards </p>
            <a href="#"> <p class="acca-blue"> BSc (Hons) + ACCA </p> </a>
            <p> Triple Crown tAwards </p>
            <a href="#"> <p class="acca-blue"> BSc (Hons) + ACCA + MSc  </p> </a>
        </div>
        <!-- Jssor Slider Begin --> 
        <div id="sliderb_container" class="slider_poss">
            <!-- Slides Container -->
            <div u="slides" class="slide">
                
                <?php if($countBannerHome > 0){ ?>
                    <?php foreach($dataBannerHome as $banner){ ?>
                            <?php if($banner['banner_type'] == 1){?>
                            <div>
                                
                                   
                                            <?php if(!empty($banner['banner_url'])){?>
                                                    <a  u=image href="<?php echo $banner['banner_url'];?>" target="_blank" id="slide-video" <?php if(!empty($banner['banner_name'])){?> title="<?php echo $banner['banner_name'];?>" <?php } ?>><img src="<?php echo BASE_URL.$banner['banner_images'];?>" <?php if(!empty($banner['banner_name'])){?> alt="<?php echo $banner['banner_name'];?>" <?php } ?>/></a>
                                            <?php } else { ?>
                                                   <a u=image href="#">  <img src="<?php echo BASE_URL.$banner['banner_images'];?>" <?php if(!empty($banner['banner_name'])){?> alt="<?php echo $banner['banner_name'];?>" <?php } ?>/></a>
                                            <?php } ?>
                                   
                            </div>
                            <?php } ?>
                    <?php } ?>
                <?php } ?>
                              
            </div>
    
            <div class="slide-nav-pos">
                <!-- bullet navigator container -->
                <div u="navigator" class="jssorb01">
                    <!-- bullet navigator item prototype -->
                    <div u="prototype"></div>
                </div>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssora05l" style="top: 123px; left: 8px;">
                </span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora05r" style="top: 123px; right: 8px;">
                </span>
            </div>
        </div>
        <!-- Jssor Slider End -->
    </div>
    <div class="clear"> </div>
    <div class="home-intro">
    	<h1> WHICH PROGRAMMES IS SUITABLE FOR YOU? </h1>
        <div class="home-intro-left">
        	<h1> PROFESSIONAL CERTIFICATES </h1>
            <p> Sed ut perspiciatis unde omnis iste natus </p>
            <p> Sit voluptatem accusantium doloremque laudantium </p>
            <p> Iste natus error sit voluptatem alaudantium </p>
            <p> Sit voluptatem accusantium laudantium </p>
            <p> Sed ut perspiciatis </p>
            <p> Unde omnis iste natus </p>
        </div>
        <div class="home-intro-center">
        	<h1> PROFESSIONAL DIPLOMAS</h1>
            <p> Sed ut perspiciatis </p>
            <p> Unde omnis iste natus </p>
        </div>
        <div class="home-intro-right">
        	<h1> SINGLE DEGREE AWARDS</h1>
            <p> Sed ut perspiciatis </p>
            <h1> DUAL AWARDS</h1>
            <p> Sed ut perspiciatis </p>
            <h1> TRIPLE CROWN AWARDS</h1>
            <p> Sed ut perspiciatis </p>
        </div>
    </div>
    <div class="clear"> </div>
    <div class="learn">
    	<h1> LEARN MORE ABOUT LSAF & ACCA </h1>
        <div class="learn-left">
        </div>
        
        <div class="learn-right">
        	<p> Every <b> 5 minutes </b>, one new student registers for <b> ACCA </b>  around the world in for 180 countries !! </p>
        </div>
    </div>
    <div class="clear"> </div>
    <div class="why-std">
    	<h1> WHY STUDY ACCA AT LSAF? </h1>
        <div class="item">
        	<div class="item-title">TRIPLE CROWN SKILLS </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-1.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption1">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">RECOGNIZED IN 180 COUNTRIES </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-2.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption2">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">INTERNATIONAL CAREER PLACEMENT WITH ACCA PARTNERS </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-3.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption3">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <div class="item">
        	<div class="item-title">MSc DEGREE FROM UNIVERSITY OF LONDON </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-4.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption4">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">LSAF LECTURERS ARE ACCA MEMBERS </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-5.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption5">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">Bsc DEGREE FROM OXFORD BROOKES UNIVERSITY </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-6.png" alt="Cycliner" title="" width="334" height="250"/></a>
            <div class="caption6">
                <p>Get a UK degree in Jakarta Within 2-2.5 years, obtaining a Bachelor degree from  Oxford Brookes University,listed in the Top 50 university in UK.</p>
            </div>
        </div>
        
    </div>
    <div class="clear"> </div>
    <div class="person">
    	<h1> DO YOU WANT TO BE SUCCESSFUL LIKE ACCA MEMBERS?  </h1>
        <div class="person-responsive">
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-1.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-2.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-3.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-4.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-1.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-2.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-3.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
            <div class="foto">
            	<img src="<?php echo IMAGES_BASE_URL;?>/foto-4.png">
                <div class="ket">
                    <h1> Irhoan Tanudiredja </h1>
                    <p> Managing Partner </p>
                    <p> Pricewaterhouse Cooper </p>
                </div>
            </div>
         </div>
    </div>
    <div class="clear"> </div>
    <div class="logos">
    	<h1> WORK PLACEMENT IN ACCA APPROVED EMPLOYERS </h1>
        <img src="<?php echo IMAGES_BASE_URL;?>/logos.png">
    </div>
    <div class="clear"> </div>
  	<div class="sosmed">
    	<h1> SOCIAL MEDIA LIVE FEEDS </h1>
        <div class="space-for-fb">
        	<img src="<?php echo IMAGES_BASE_URL;?>/sosmed-1.png">
        </div>
        <div class="space-for-in">
        	<img src="<?php echo IMAGES_BASE_URL;?>/sosmed-2.png">
        </div>
        <div class="space-for-tw">
        	<img src="<?php echo IMAGES_BASE_URL;?>/sosmed-3.png">
        </div>
    </div>
    <div class="clear"> </div>
   <?php include "include/vfooter.php"; ?>
     
</div>
<script>

$(document).ready(function() {

	//move the image in pixel
	var move = -15;
	
	//zoom percentage, 1.2 =120%
	var zoom = 1.1;

	//On mouse over those thumbnail
	$('.item').hover(function() {
		
		//Set the width and height according to the zoom percentage
		width = $('.item').width() * zoom;
		height = $('.item').height() * zoom;
		
		//Move and zoom the image
		$(this).find('img').stop(false,true).animate({'width':width, 'height':height, 'top':move, 'left':move}, {duration:200});
		
		//Display the caption
		$(this).find('div.caption1').stop(false,true).fadeIn(200);
		//Display the caption
		$(this).find('div.caption2').stop(false,true).fadeIn(200);
		//Display the caption
		$(this).find('div.caption3').stop(false,true).fadeIn(200);
		//Display the caption
		$(this).find('div.caption4').stop(false,true).fadeIn(200);
		//Display the caption
		$(this).find('div.caption5').stop(false,true).fadeIn(200);
		//Display the caption
		$(this).find('div.caption6').stop(false,true).fadeIn(200);
	},
	function() {
		//Reset the image
		$(this).find('img').stop(false,true).animate({'width':$('.item').width(), 'height':$('.item').height(), 'top':'0', 'left':'0'}, {duration:100});	

		//Hide the caption
		$(this).find('div.caption1').stop(false,true).fadeOut(200);
		//Hide the caption
		$(this).find('div.caption2').stop(false,true).fadeOut(200);
		//Hide the caption
		$(this).find('div.caption3').stop(false,true).fadeOut(200);
		//Hide the caption
		$(this).find('div.caption4').stop(false,true).fadeOut(200);
		//Hide the caption
		$(this).find('div.caption5').stop(false,true).fadeOut(200);
		//Hide the caption
		$(this).find('div.caption6').stop(false,true).fadeOut(200);
	
	});

});

</script>

<script type="text/javascript">
$('.person-responsive').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
	{
	  breakpoint: 1024,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 3,
		infinite: true,
		dots: true
	  }
	},
	{
	  breakpoint: 600,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 2
	  }
	},
	{
	  breakpoint: 480,
	  settings: {
		slidesToShow: 1,
		slidesToScroll: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});
</script> 
</body>
</html>
