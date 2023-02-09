<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>

<?php include "include/fixed.php"; ?>
<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="clear"> </div>
             <div class="sign-up">
    	<div class="sign-up-left">
        	<h1> Location </h1>
            <h2> London School of Accountancy and Finance </h2>
            <p> Italian Walk Block B no. 36 Kelapa Gading Square <br> Jl. Raya Boulevard Barat, Kelapa Gading, Jakarta-14240</p>
            <div class="clear"> </div>
            <div class="map-poss">
            	<h4> Direction to here</h4>
				<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                    <div style='overflow:hidden; margin-left:20px; height:170px;width:95%;'><div id='gmap_canvas' style='height:170px;width:95%;'></div>
                    <style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div>
                <script type='text/javascript'> function init_map(){
                    var myOptions = {
                    zoom:12,center:new google.maps.LatLng(-6.1744,106.82940000000008),
                    mapTypeId: google.maps.MapTypeId.ROADMAP};
                    map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                    marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-6.1744,106.82940000000008)});
                    
                    google.maps.event.addListener(marker, 'click', function(){
                    infowindow.open(map,marker);
                    });
                    infowindow.open(map,marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>
           </div>
           <div class="clear"> </div>
           <div class="phone-left">
           		<h4> Contact</h4>
           		<div class="phone-left-1"> 2346B69F </div>
                <div class="phone-left-2"> 0877-8547-7388 </div>
                <div class="phone-left-3"> <button class="contact-box"> Live Chat </button> </div>
           </div>
           <div class="phone-right">
           		<h4> Media Sosial</h4>
           		<div class="phone-right-1"> <button class="contact-box"> Add </button>  <button class="contact-box"> Share </button>  </div>
                <div class="phone-right-2"> <button class="contact-box"> Like </button>  <button class="contact-box"> Share </button>  </div>
                <div class="phone-right-3"> <button class="contact-box"> Follow </button>  <button class="contact-box"> Share </button>  </div>
           </div>
         </div>
         <div class="sign-up-right">
         	<h1>Request More Info </h1>
            <form action="" method="post" class="location-form">
                <label>
                    <span> Name </span>
                    <input id="name" type="text" name="email" />
                </label>
               <div class="clear"> </div>
                <label>
                    <span> Phone Number </span>
                    <input style="width:80px" id="name" type="text" name="name"/>
                    <input class="phn-display" style="margin-left:10px; width:295px;" id="name" type="text" name="name"/>
                </label>
                 <div class="clear"> </div> 
                <label>
                    <span>Email </span>
                    <input id="name" type="text" name="email" />
                </label>
               <div class="clear"> </div>
               <label>
                    <span>Message </span>
                    <input id="name" type="text" name="email" />
                    <div class="clear"> </div>
                    <input style="margin-left:130px;" id="name" type="text" name="email" />
                </label> 
                <div class="clear"> </div> 
                <label>
                    <input type="button" class="button" value="Submit" />
                </label> 
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
