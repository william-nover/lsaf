<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $title?> - <?php echo PROJECT_NAME;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
	<link href="<?php echo IMAGES_BASE_URL; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_BASE_URL;?>/contents.css" />
	
	<?php if(!empty($meta_title)) {?><meta name="title" content="<?php echo $meta_title;?>"/> <?php } ?>
	<?php if(!empty($meta_description)) { ?><meta name="description" content="<?php echo $meta_description;?>"/> <?php } ?>
	<?php if(!empty($meta_keywords)) { ?><meta name="keywords" content="<?php echo $meta_keywords;?>"/> <?php } ?>
	
	<!-- Facebook Metadata /-->
	<meta property="og:type" content="website" />
	<?php if(!empty($meta_title)) {?><meta property="og:title" content="<?php echo $meta_title;?>"/><?php } ?>
	<?php if(!empty($meta_description)) { ?><meta property="og:description" content="<?php echo $meta_description;?>"/><?php } ?>
	<?php if(!empty($pages['pages_image'])) { ?><meta property="og:image" content="<?php echo BASE_URL.$pages['pages_image']?>" /><?php } ?>
	

	<!-- Google+ Metadata /-->
	<?php if(!empty($meta_title)) {?><meta itemprop="name" content="<?php echo $meta_title;?>"><?php } ?>
	<?php if(!empty($meta_description)) { ?><meta itemprop="description" content="<?php echo $meta_description;?>"><?php } ?>
	<?php if(!empty($pages['pages_image'])) { ?><meta itemprop="image" content="<?php echo BASE_URL.$pages['pages_image']?>"><?php } ?>
	
	<!-- Twitter Metadata /-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="<?php echo PROJECT_NAME;?>">
	<?php if(!empty($meta_title)) {?><meta name="twitter:title" content="<?php echo $meta_title;?>"><?php } ?>
	<?php if(!empty($meta_description)) { ?><meta name="twitter:description" content="<?php echo $meta_description;?>"><?php } ?>
	<?php if(!empty($pages['pages_image'])) { ?><meta name="twitter:image:src" content="<?php echo BASE_URL.$pages['pages_image']?>"><?php } ?>
	<meta name="twitter:domain" content="<?php echo BASE_URL;?>">
	<meta name="twitter:url" content="<?php echo BASE_URL;?>/<?php echo $pages['web_alias'];?>">
</head>

<body class="page-inside one-column">

<?php include VIEWS_PATH_FRONTEND."/header.php"; ?>

<div class="breadcrumb">
	<a href="<?php echo BASE_URL?>" class="home-bread" title="Halaman Utama"></a>
	<span><?php echo $pages['pages_title'];?></span>
</div>

<div class="one-column-area">
	<div class="right-ca">
		<div class="area-about">
			<?php echo $pages['pages_desc']; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php include VIEWS_PATH_FRONTEND."/footer.php"; ?>
	
<script type="text/javascript" src="<?php echo JS_BASE_URL;?>/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL;?>/jquery-migrate-1.2.1.min.js"></script>

</body>
</html>