<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entry Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo IMAGES_BASE_URL;?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<!-- css -->
<link rel="stylesheet" href="<?php echo CSS_BASE_URL; ?>/style.css" type="text/css" media="screen">

<!-- js -->
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery-1.9.1.min.js"></script>
<link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
<script language="javascript" type="text/javascript">
$(document).ready(function() {
    
        var width = $(window).width();
        if ((width > 750)) {
            $('div.started').attr('id','go');
             goentry();   
           
        } 
        
        else {
            $('#go').removeAttr('id');
                
        }
        
        
jQuery(window).resize(function () {
        if (jQuery(window).width() > 750) {
            $('div.started').attr('id','go');
            goentry();  
        }
        else {
             $('#go').removeAttr('id');
                  
        }
});


function goentry(){
 
            $("#go").click(function(e){
		/*var width = Number(screen.width);  
		var height = Number(screen.height);
		var leftscr = Number((screen.width/2)-(width/2)); // center the window
		var topscr = Number((screen.height/2)-(height/2));
		var url = "<?php echo BASE_URL; ?>/Entrytest/Start";
		var title = 'popup';
		var properties = 'width='+width+', height='+height+', top='+topscr+', left='+leftscr+',resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,fullscreen=yes,dialog=yes';
		var popup = window.open(url, title, properties); */
		
		var url = "<?php echo BASE_URL; ?>/Entrytest/Start";
		window.location = url;
		return false;
	});
}	
    
});




</script>
</head>

<body>

<?php include "include/fixed.php"; ?>


<div class="container">	
    <?php include "include/vheader.php"; ?>
    <div class="reg-proses">
    	<h1> Entry Test </h1>
        <div class="step-line"> <div class="line"> </div> </div>
        <div class="step-isi">
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 1 </p></div>
                </div>
                <h2> Sign Up </h2>
                <p> Sign up takes just seconds and requires only Personal Information </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 2 </p></div>
                </div>
                <h2> Entry Test </h2>
                <p> Sign up takes just seconds and requires only Personal Information </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 3 </p></div>
                </div>
                <h2> Offer Letter </h2>
                <p> Sign up takes just seconds and requires only Personal Information </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 4 </p></div>
                </div>
                <h2> Upload Necesarry Document </h2>
                <p> Sign up takes just seconds and requires only Personal Information </p>
            </div>
            <div id="step">
                <div id="bullet">
                    <div id="bullet-inner"> <p> 5 </p></div>
                </div>
                <h2> Invoice & Installment </h2>
                <p> Sign up takes just seconds and requires only Personal Information </p>
            </div>
         </div>
         <div class="clear"> </div>
         <div class="button-started">
            <div class="started" id="go"> Click to Start Entry Test </div>
           
                <p> <strong> Notice </strong> <br/> Entry test is only available on desktop, notebook or laptop device  </p>
         </div>
            
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
