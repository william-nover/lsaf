<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo IMAGES_BASE_URL; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <title>Content Management System - <?php echo PROJECT_NAME;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo CSS_BASE_URL; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS_BASE_URL; ?>/bootstrap-reset.min.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo CSS_BASE_URL; ?>/style_backend.css" rel="stylesheet">
    <link href="<?php echo CSS_BASE_URL; ?>/style-responsive.min.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo JS_BASE_URL; ?>/html5shiv.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
      <form class="form-signin" name="signin" action="<?php echo BASE_URL_BACKEND; ?>/cekLogin" method="POST">
        <h2 class="form-signin-heading">CMS Login</h2>
         
		<div class="login-wrap">
			<!--<p><img src="<?php echo IMAGES_BASE_URL;?>/logo.png" alt="logo"></p>-->
			<?php if(isset($error)){ ?>
				<p style="color: #ff6c60;"><?php echo $error;?></p>
			<?php } ?>
			<input type="text" name="username"  class="form-control" placeholder="User Name" autofocus>
			<input type="password" name="password" class="form-control" placeholder="Password">
			<div class="pull-left controls" align="center">
				<span id="captcha"><?php echo $captcha;?></span> <a class="btn btn-sm" title="Refresh Security Code" id="refresh"><i class="icon-refresh"></i></a>
			</div>
			<div class="pull-left controls" style="margin-top:15px;">
				<input name="capctha" type="text" class="form-control" placeholder="Security Code">
			</div>
			<input name="tbSignin" class="btn btn-lg btn-login btn-block" type="submit" value="Sign in">
        </div>
      </form>
    </div>
	
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo JS_BASE_URL; ?>/jquery-1.11.0.min.js"></script>
    <script src="<?php echo JS_BASE_URL; ?>/bootstrap.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
	  $("#refresh").click(function(){
		$.ajax({
			url: "<?php echo BASE_URL_BACKEND; ?>/signin/reload_captcha",
			success: function(data){
				$("#captcha").html(data);
			}
		});
	  });
	});
	</script>
  </body>
</html>
