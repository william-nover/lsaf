<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entry Test Finish</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo IMAGES_BASE_URL;?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<!-- css -->
<link rel="stylesheet" href="<?php echo CSS_BASE_URL; ?>/style.css" type="text/css" media="screen">

<!-- js -->
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery-1.9.1.min.js"></script>
<link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>

<?php include "include/fixed.php"; ?>


<div class="container">	
    <?php include "include/vheader.php"; ?>
    <div class="content">
    	<h1> Entry Test Finish </h1>
         <div class="clear"> </div>
		 <p>
		 <?php echo $message;?>
		 </p>
    </div> 
    <div class="clear"> </div>
	<footer>
        <div class="footer-isi">
            <h1> @ London School of Accountancy and Finance . Indonesia 2015 . ALL RIGHT RESERVED </h1>
            <ul>
                <a href="#"> <li> SITEMAP </li> </a>
                <a href="#"> <li> LOCATION </li> </a>
                <a href="#"> <li> PRIVACY POLICY </li> </a>
                <a href="#"> <li> DOWNLOAD </li> </a>
            </ul>
        </div>
    </footer>   

     
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
