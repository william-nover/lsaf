<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
	<title><?php echo "404 Halaman tidak ditemukan - ".PROJECT_NAME;?></title>
	<link href="<?php echo IMAGES_BASE_URL;?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Coda:400,800' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_URL;?>/examples.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_URL;?>/slick.css"/>
	<!-- Accordion styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_URL;?>/smk-accordion.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_URL;?>/style.css"/>

</head>
<body class="page-inside one-column">
<div class="header">
	<div class="header-top">
		<div class="search-form">
		
		</div>
	</div>
	<div class="header-middle">
		<div class="logo">
			<a href="<?php echo BASE_URL;?>" class="logo-button" title="Halaman Utama"></a>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="breadcrumb">
	<a href="<?php echo BASE_URL?>" class="home-bread" title="Halaman Utama"></a>
	<span>404 Halaman tidak ditemukan</span>
</div>

<div class="one-column-area">
	<div class="left-ca">
		&nbsp;
	</div>
	<div class="right-ca">
		<div class="area-about">
			<h1>Halaman yang anda cari tidak ditemukan</h1>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="footer">
	<div class="footer-bottom">Copyrights © 2015 <?php echo PROJECT_NAME;?>. All Rights Reserved.</div>
</div>
</body>
</html>