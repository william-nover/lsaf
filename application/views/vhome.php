<!DOCTYPE html>
<html lang="en">
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
    	<h1> WHICH PROGRAM IS SUITABLE FOR YOU?</h1>
        <div class="home-intro-left">
        	<h1> PROFESSIONAL CERTIFICATES </h1>
            <p> <a href="https://lsafglobal.com/Courses/6/30/68/Introductory in Financial & Management Accounting">Introductory in Financial &amp; Management Accounting </a></p>
            <p> <a href="https://lsafglobal.com/Courses/6/30/69/IntermediateCertificateinFinancial&ManagementAccounting">Intermediate Certificate in Financial &amp; Management Accounting</a></p>
            <p><a href="https://lsafglobal.com/Courses/6/30/72/FoundationsCertificateinAudit"> Foundations Certificate in Audit </a></p>
            <p><a href="https://lsafglobal.com/Courses/6/30/73/FoundationsCertificateinFinancialManagement">Foundations Certificate in Financial Management </a></p>
           
        </div>
        <div class="home-intro-center">
            <h1 class="first"> PROFESSIONAL DIPLOMAS</h1>
            <p>	<a href="https://lsafglobal.com/Courses/6/35/70/DiplomainAccountingandBusiness">Diploma in Accounting and Business</a></p>
            <p> <a href="https://lsafglobal.com/Courses/6/35/71/AdvancedDiplomainAccountingandBusiness">Advanced Diploma in Accounting and Business </a></p>
            <h1 class="second"> BACHELOR DEGREE</h1>
            <p>	<a href="https://lsafglobal.com/Courses/6/64/ACCABScOxfordBrookesUniversityOBU">ACCA/ BSc Oxford Brookes University</a></p>
            <h1 class="thirth"> MASTER DEGREE</h1>
            <p>	<a href="https://lsafglobal.com/Courses/6/65/ACCA-MSc University of London-UOL">ACCA/ MSc University of London </a></p>		
		</div>
        <div class="home-intro-right">
            <h1> ARE YOU A...??</h1>
            <p> <a href="https://lsafglobal.com/Students/7/74/JuniorHighSchoolGraduatesGrade10">Junior High School (Graduate 10)</a></p>            
            <p> <a href="https://lsafglobal.com/Students/7/75/SeniorHighSchoolGraduatesGrade10-12">Senior High School (Graduate 11 – 12)</a></p>
			<p> <a href="https://lsafglobal.com/Students/7/76/UniversityGraduatesandWorkingAdults">University Graduate &  Working Adult</a></p>
			<p> <a href="https://lsafglobal.com/Students/7/77/Enterpreneurs">Enterpreneur</a></p>
        </div>
    </div>
    <div class="clear"> </div>
    <div class="learn">
    	<h1> LEARN MORE ABOUT LSAF & ACCA </h1>
        <div class="learn-left">
		<iframe class="youtube" src="https://www.youtube.com/embed/wmEIb2Rh99M" frameborder="0" allowfullscreen></iframe>
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
                <p>Achieve an ACCA qualification with a Bachelors’ degree from Oxford Brookes University and Masters’ degree from University of London</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">RECOGNIZED IN 180 COUNTRIES </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-2.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption2">
                <p>ACCA is a global professional accountancy body, and non-profit making organization, with 170,000 members and 436,000 students worldwide, as at September 2014.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">INTERNATIONAL CAREER PLACEMENT WITH ACCA PARTNERS </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-3.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption3">
                <p>As part of your journey to become a qualified ACCA member, you will need to demonstrate relevant skills and experience within a real work environment.</p>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <div class="item" style="display:none">
        	<div class="item-title">MSc DEGREE FROM UNIVERSITY OF LONDON </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-4.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption4">
                <p>The world’s first integrated masters’ program with the University of London now allows it to be taken at the same time as taking the ACCA qualification.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">LSAF LECTURERS ARE ACCA MEMBERS </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-5.png" alt="Cycliner" title="" width="333" height="250"/></a>
            <div class="caption5">
                <p>Our lecturers have either passed or received exemption from ACCA exams and are equipped with the competence and experience to deliver quality lectures.</p>
            </div>
        </div>
        
        <div class="item">
        	<div class="item-title">Bsc DEGREE FROM OXFORD BROOKES UNIVERSITY </div>
            <a href="#"><img src="<?php echo IMAGES_BASE_URL;?>/th-6.png" alt="Cycliner" title="" width="334" height="250"/></a>
            <div class="caption6">
                <p>ACCA and Oxford Brookes University have worked together to develop a BSc (Hons) Degree in Applied Accounting, which is available exclusively to ACCA students.</p>
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
<!-- js -->



<script type="text/javascript">
        jQuery(document).ready(function ($) {
            
            var jssor_1_SlideshowTransitions = [
              {$Duration:1000,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad},
              {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1000,x:-1,y:2,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.85}},
              {$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1000,x:4,y:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1500,x:0.3,y:-0.3,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}},
              {$Duration:1000,x:-3,y:1,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,y:-1,$Cols:8,$Rows:4,$Clip:15,$During:{$Top:[0.5,0.5],$Clip:[0,0.5]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$ScaleClip:0.5},
              {$Duration:1000,x:0.5,y:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1200,x:-0.6,y:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1500,y:-0.5,$Delay:60,$Cols:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:$Jease$.$InWave,$Round:{$Top:1.5}},
              {$Duration:1000,$Delay:30,$Cols:8,$Rows:4,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:$Jease$.$InQuad},
              {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];
            
            var jssor_1_SlideoTransitions = [
              [{b:-1.0,d:1.0,rY:90.0},{b:8500.0,d:1000.0,o:-1.0,rY:-90.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:0.0,d:480.0,x:-300.0,o:1.0},{b:1000.0,d:500.0,x:-370.0}],
              [{b:480.0,d:520.0,x:100.0,y:-320.0}],
              [{b:1500.0,d:500.0,y:250.0},{b:8500.0,d:1000.0,x:600.0}],
              [{b:-1.0,d:1.0,o:-1.0,sX:-0.6,sY:-0.6},{b:2000.0,d:500.0,o:1.0,r:360.0,sX:0.6,sY:0.6},{b:8500.0,d:1000.0,y:-150.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:2500.0,d:1000.0,o:1.0,tZ:200.0},{b:3500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:3500.0,d:1000.0,o:1.0,tZ:200.0},{b:4500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:4500.0,d:1000.0,o:1.0,tZ:200.0},{b:5500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:5500.0,d:1000.0,o:1.0,tZ:200.0},{b:6500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:6500.0,d:1000.0,o:1.0,tZ:200.0},{b:7500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,o:-1.0,tZ:-200.0},{b:7500.0,d:1000.0,o:1.0,tZ:200.0},{b:8500.0,d:1000.0,o:-1.0,tZ:200.0}],
              [{b:-1.0,d:1.0,c:{x:250.0,t:-250.0}},{b:0.0,d:1000.0,c:{x:-250.0,t:250.0}},{b:5000.0,d:1000.0,y:100.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:1000.0,d:1000.0,o:1.0},{b:5000.0,d:1000.0,y:280.0}],
              [{b:2000.0,d:1000.0,y:190.0,e:{y:28.0}},{b:5000.0,d:1000.0,x:280.0}],
              [{b:3000.0,d:520.0,y:50.0},{b:5000.0,d:1000.0,y:-50.0}],
              [{b:3520.0,d:480.0,x:-400.0},{b:5000.0,d:800.0,x:400.0,e:{x:7.0}}],
              [{b:4000.0,d:500.0,x:-400.0},{b:5000.0,d:800.0,x:400.0,e:{x:7.0}}],
              [{b:4500.0,d:500.0,x:-400.0},{b:5000.0,d:800.0,x:400.0,e:{x:7.0}}],
              [{b:-1.0,d:1.0,o:-0.4},{b:0.0,d:1000.0,y:140.0,o:0.4},{b:23000.0,d:1000.0,y:-140.0}],
              [{b:-1.0,d:1.0,c:{x:275.0,t:-275.0}},{b:1000.0,d:1000.0,c:{x:-275.0,t:275.0}},{b:23000.0,d:1000.0,y:100.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2000.0,d:1000.0,o:1.0},{b:23000.0,d:1000.0,o:-1.0}],
              [{b:-1.0,d:1.0,sX:-0.7,sY:-0.7},{b:5000.0,d:1000.0,sX:0.4,sY:0.4,e:{sX:16.0,sY:16.0}},{b:9000.0,d:1000.0,sX:-0.2,sY:-0.2,e:{sX:16.0,sY:16.0}},{b:13000.0,d:1000.0,sX:-0.3,sY:-0.3,e:{sX:16.0,sY:16.0}},{b:17000.0,d:1000.0,sX:0.4,sY:0.4,e:{sX:16.0,sY:16.0}},{b:21000.0,d:1000.0,sX:0.4,sY:0.4,e:{sX:16.0,sY:16.0}}],
              [{b:4000.0,d:1500.0,x:195.0,y:450.0,r:-90.0},{b:8000.0,d:1500.0,x:-225.0,y:-240.0,r:-90.0},{b:12000.0,d:1500.0,x:-220.0,y:-1140.0,r:120.0},{b:16000.0,d:1500.0,x:400.0,y:580.0,r:100.0},{b:20000.0,d:1500.0,x:350.0,y:350.0,r:90.0}],
              [{b:-1.0,d:1.0,tZ:1.0},{b:4000.0,d:1500.0,o:-0.6}],
              [{b:-1.0,d:1.0,o:-0.6,r:90.0,tZ:1.0},{b:4000.0,d:1500.0,o:0.6},{b:8000.0,d:1500.0,o:-0.6}],
              [{b:-1.0,d:1.0,o:-0.6,r:180.0,tZ:1.0},{b:8000.0,d:1500.0,o:0.6},{b:12000.0,d:1500.0,o:-0.6}],
              [{b:-1.0,d:1.0,o:-0.6,r:60.0,tZ:1.0},{b:12000.0,d:1500.0,o:0.6},{b:16000.0,d:1000.0,o:-0.6}],
              [{b:-1.0,d:1.0,o:-0.6,r:-40.0,tZ:1.0},{b:16000.0,d:1000.0,o:0.6},{b:20000.0,d:1500.0,o:-0.6}],
              [{b:-1.0,d:1.0,o:-0.6,r:-130.0,tZ:1.0},{b:20000.0,d:1500.0,o:0.6}],
              [{b:-1.0,d:1.0,c:{x:250.0,t:-250.0}},{b:0.0,d:1000.0,c:{x:-250.0,t:250.0}},{b:10000.0,d:500.0,y:90.0}],
              [{b:-1.0,d:1.0,c:{x:150.0,t:-150.0}},{b:1000.0,d:1000.0,c:{x:-150.0,t:150.0}},{b:10000.0,d:500.0,c:{y:150.0,m:-150.0}}],
              [{b:2000.0,d:500.0,x:220.0}],
              [{b:3500.0,d:500.0,rX:-20.0},{b:4000.0,d:1000.0,rX:40.0},{b:5000.0,d:500.0,rX:-10.0},{b:9500.0,d:500.0,o:-1.0}],
              [{b:3500.0,d:2000.0,r:360.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2500.0,d:500.0,x:76.0,y:-25.0,o:1.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2500.0,d:500.0,x:47.0,y:65.0,o:1.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2500.0,d:500.0,x:-47.0,y:65.0,o:1.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2500.0,d:500.0,x:-76.0,y:-25.0,o:1.0}],
              [{b:-1.0,d:1.0,o:-1.0},{b:2500.0,d:500.0,y:-80.0,o:1.0}],
              [{b:-1.0,d:1.0,c:{x:120.0,t:-120.0}},{b:6100.0,d:400.0,c:{x:-120.0,t:120.0}},{b:10000.0,d:500.0,y:-120.0}],
              [{b:6500.0,d:500.0,x:220.0}],
              [{b:-1.0,d:1.0,o:-1.0,r:180.0,sX:-0.5,sY:-0.5},{b:7000.0,d:500.0,o:1.0,r:180.0,sX:0.5,sY:0.5},{b:8000.0,d:500.0,o:-1.0,r:180.0,sX:9.0,sY:9.0}],
              [{b:-1.0,d:1.0,o:-1.0,r:180.0,sX:-0.5,sY:-0.5},{b:8000.0,d:500.0,o:1.0,r:180.0,sX:0.5,sY:0.5},{b:9000.0,d:500.0,o:-1.0,r:180.0,sX:9.0,sY:9.0}],
              [{b:-1.0,d:1.0,o:-1.0,r:180.0,sX:-0.5,sY:-0.5},{b:9000.0,d:500.0,o:1.0,r:180.0,sX:0.5,sY:0.5},{b:9500.0,d:500.0,o:-1.0,r:180.0,sX:9.0,sY:9.0}]
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 10,
              $SlideEasing: $Jease$.$OutQuint,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions,
                $Breaks: [
                  [{d:3000,b:8500,t:2}],
                  [{d:2000,b:5000}],
                  [{d:3000,b:23000}],
                  [{d:3000,b:9500,t:2}]
                ]
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1000);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
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
<style>
  .slick-dots li button:before {
      margin-top: 42px !important;
    }

</style>
</body>
</html>
