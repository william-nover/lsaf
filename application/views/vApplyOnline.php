<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
</head>

<body><?php include_once("analyticstracking.php") ?>

<?php include "include/fixed.php"; ?>

<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="reg-proses">
    	<h1> Registration Process </h1>
        <div class="step-line"> <div class="line"> </div> </div>
        <div class="step-isi">
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 1 </p></div>
                </div>
                <h2> Sign Up </h2>
                <p> Sign up requires personal data </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 2 </p></div>
                </div>
                <h2> Entry Test </h2>
                <p> Take an online test </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 3 </p></div>
                </div>
                <h2> Offer Letter </h2>
                <p> Upon successful attempt, an offer letter will be sent </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 4 </p></div>
                </div>
                <h2> Upload Necesarry Document </h2>
                <p> Recent transcript and personal information are required </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 5 </p></div>
                </div>
                <h2> Invoice & Installment </h2>
                <p> Upon full completion of sign up, an invoice will be sent </p>
            </div>
         </div>
         <div class="clear"> </div>
         <div class="button-started">
             
             <a href="<?php echo BASE_URL.'/ApplyOnline/Signup';?>"> <div class="started"> Get Started Now ! </div> </a>
            <div class="started-info">
            	<a href="<?php echo BASE_URL.'/Terms_Condition';?>"><div class="started-info-left"> Terms & Condition </div></a>
                <a href="<?php echo BASE_URL.'/Privacy_Policy';?>"><div class="started-info-right"> Read Privacy Policy </div></a>
            </div>
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
