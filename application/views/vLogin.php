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
						<div class="forget-pass">
							<a href="<?php echo BASE_URL.'/ForgetPassword';?>"><div class="started-info-left"> Forget pasword? </div></a>
							<a href="<?php echo BASE_URL.'/ApplyOnline/Signup';?>"><div class="started-info-right"> Sign Up </div></a>
						</div>
                 </form>
                </div>        
            </div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>


 
</body>
</html>
