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
        	<div class="get-pass">                    
                  
                    <?php echo form_open(BASE_URL.'/ForgetPassword/getPassword', 'class="login" id="myform"'); ?>
                       <?php if (isset($error)): ?>                     
                        <span style="color: #ff6c60;"><?php echo $error; ?></span>    
                        <?php endif; ?>
                        <input id="name" type="text" name="email" placeholder="email" style="margin-left: 9%;"/>
                         <?php echo form_error('email'); ?>
                        <input type="submit" class="login-butt" name="tbSignin" value="Request Password" />	
                    <?php echo form_close(); ?>           
                    </div>          
            </div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>


 
</body>
</html>
