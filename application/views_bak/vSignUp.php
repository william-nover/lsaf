<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
</head>

<body>


<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>

   <div class="sign-up">
    	<div class="sign-up-left">
        	<a href="#"> <img src=" <?php echo IMAGES_BASE_URL; ?>/sign-up-prev.png"> </a>
            <div class="step-line-small"> <div class="line-small"> </div> </div>
            <div class="step-isi-small">
                <div id="step-small">
                    <div id="bullet-small">
                        <div id="bullet-inner-small"> <p> 1 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 2 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 3 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 4 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 5 </p></div>
                    </div>
                </div>
             </div>
         </div>
         <div class="sign-up-right">
         	<h1>Step 01 - Sign up </h1>
            <form action="<?php echo BASE_URL;?>/ApplyOnline/SignUp" method="post" class="register-page">
                <label>
                    <span> Full Name </span>
                    <input id="name" type="text" name="full_name" />
                </label>
               <div class="clear"> </div>
               <label>
                    <?php echo date_dropdown();?>
                </label>
               <div class="clear"> </div>
                <label>
                <label>
                    <span> Phone Number </span>
                    <input class="date-dis-a" style="width:80px" id="name" type="text" name="phone1"/>
                    <input class="date-dis-a" style="margin-left:10px; width:295px" id="name" type="text" name="phone2"/>                  
                </label>
               <div class="clear"> </div>
                    <span style="padding-top:0px;">
                    	Postel Address
                        <h4> for corespondence LSAF  </h4>
                    </span>
                    <input id="name" type="text" name="addr1" />
                    <div class="clear"> </div>
                    <input class="addres-poss" style="margin-left:130px;" id="name" type="text" name="addr2" />
                </label> 
                <div class="clear"> </div> 
                <label>
                    <span>Postal Code</span>
                    <input class="date-dis-a" style="width:80px" id="postal" type="text" name="postal_code"/>
                </label>
                <div class="clear"> </div> 
                <label>
                     <span style="padding-top:0px;">
                    	Email Address
                        <h4> for corespondence LSAF  </h4>
                    </span>                  
                    <input id="name" type="text" name="email" />
                </label>
                <div class="clear"> </div> 
                <label>
                    <span>Nationality </span>
                     <select id="country_id" class="" name="country_id">
                        <?php foreach ($Nationality as $nat) { ?>
                         <option value="<?php echo $nat-> country_id;?>"><?php echo $nat->country_name ;?></option>       
                        <?php } ?>                    
                    </select>
                </label>
                <div class="clear"> </div> 
                <label>
                    <input type="submit" class="button" value="Sign Up" />
                </label> 
                <p> By Clicking Sign Up, You Agree to our Terms and that you have read and understand our data use policy including our cookies use.</p>
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
