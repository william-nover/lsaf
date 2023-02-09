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
            <div class="clear"> </div>
	<div class="dasboard">
            <?php include "include/dasboard-left.php"; ?>
            <div class="dasboard-right">
            	<div class="header-content">  </div> 
                <div class="clear"> </div>
                <table class="gridtable2">
                    <tr>
                        <th>Skype Title</th><td><?php echo $rsSkype_Lectures[0]['skype_lectures_title']; ?></td>
                    </tr>
                    <tr>
                        <th>Skype Date</th><td><?php echo $rsSkype_Lectures[0]['skype_lectures_date']; ?></td>
                    </tr> 
                    <tr>
                        <th>Skype Link</th><td>  <a href="<?php echo $rsSkype_Lectures[0]['skype_lectures_link']; ?>"> <button class="contact-box"> Live Chat </button> </a></td>
                    </tr> 
                  </table>
                 
                 
                   
            </div>
   
</div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>
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
