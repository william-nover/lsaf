<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="clear"> </div>
            <div class="my-lsaf">
        	<div class="my-lsaf-logo"></div>
        	<div class="login-cont">
                    <form action="<?php echo BASE_URL;?>/signin/cekLogin" method="post" class="login">
                       <?php if (isset($error)): ?>
                        <span style="color: #ff6c60;"><?php echo $error; ?></span>
                            <?php endif; ?>
                        
                        <input id="name" type="text" name="email" placeholder="email" style="margin-left: 9%;"/>
                        <input id="password" type="password" name="password" placeholder="password" />
                        <div class="pull-left controls" align="center">
                        <span id="captcha"><?php echo $captcha;?></span> <a class="btn btn-sm" title="Refresh Security Code" id="refresh"><i class="icon-refresh"></i></a>			
				<input name="capctha" type="text" class="form-control" placeholder="Security Code" style="margin-left: 9%;">
                                <!--<input name="capt" type="text" class="form-control" value="<?php //echo $capt;?>">-->
			</div>
                        <input type="submit" class="login-butt" name="tbSignin" value="Login" />
                     
                 </form>
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
