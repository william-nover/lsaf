<!DOCTYPE>
<html>
<head>
<title>404 Not Found</title>
<?php include "include/style.php"; ?>
<link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="content">
    	<h1> 404 Not Found </h1>
         <div class="clear"> </div>
		 <p>
		 <?php echo $message;?>
		 </p>
    </div>
	<footer>
        <div class="footer-isi">
            <h1> © COPYRIGHT <?php date_default_timezone_set('UTC'); echo $today  = date("Y");?>  LONDON SCHOOL OF ACCOUNTANCY AND FINANCE, ALL RIGHTS RESERVED</h1>
            <ul>
                <a href="#"> <li> SITEMAP </li> </a>
                <a href="<?php echo BASE_URL.'/location';?>"> <li> LOCATION </li> </a>
                <a href="<?php echo BASE_URL.'/Privacy_Policy';?>"> <li> PRIVACY POLICY </li> </a>
                
            </ul>
        </div>
    </footer>     
</div>
 
</body>
</html>
