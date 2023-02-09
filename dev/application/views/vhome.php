<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
    <script type="text/javascript">
	$(window).on('load', function() {
	   //$(".loader").fadeOut( "slow" );
	  $(".loader").fadeOut(1600);
	   
	   var screenwidthcss =  $(window).width();
	   if(screenwidthcss < 1005){
			$("body").attr('id', 'resolusi');
	   } else {
			$("body").attr('id', '');
	   }
	});
	</script>
</head>

<body>
<?php include_once("analyticstracking.php") ?>

<div class="loader"></div>

<?php include "include/fixed.php"; ?>

<div class="container">	
   <?php include "include/vheader.php"; ?>
    <div class="slideshow">
         <?php include "include/slider.php"; ?>
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
		<iframe width="470" height="311" src="https://www.youtube.com/embed/yhWxYH-yWio" frameborder="0" allowfullscreen></iframe>
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
   <?php include 'include/person.php';?>
    <div class="clear"> </div>
    <div class="logos">
    	<h1> WORK PLACEMENT IN ACCA APPROVED EMPLOYERS </h1>
        <img src="<?php echo IMAGES_BASE_URL;?>/logos.png">
    </div>
    <div class="clear"> </div>
    <?php include "include/sosmed.php"; ?>
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
<script type="text/javascript">
  
  </script>
 
</body>
</html>
