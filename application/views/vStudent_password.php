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
                <div class="edit-profil">
                <?php echo form_open(BASE_URL.'/Student_info/SavePassword', 'class="location-form" id="myform"'); ?>
                   <?php echo $notif; ?>
                
                <table class="gridtable2">        
                    <tr>
                        <th>Old Password</th>
                        <td> <input type="password" id="oldpassword" name="oldpassword" value="">
                         <?php echo form_error('oldpassword'); ?></td>
                    </tr>
                 
                   
                    <tr>
                        <th>New Password</th>
                        <td><input type="password" name="newpassword" value="" placeholder="min 6 character lenght">
                        <?php echo form_error('newpassword'); ?></td>
                    </tr>
                    
                    <tr>
                        <th>Conf. Password</th>
                        <td><input type="password" name="confpassword" value="" placeholder="min 6 character lenght ">  
                         <?php echo form_error('confpassword'); ?> </td>
                    </tr>
                        
                 </table>
                
                    <input type="submit" class="edit-pro" value="Save"><input type="reset" class="edit-cancel" value="Cancel">
                
               
                <?php echo form_close(); ?>
                </div>
            </div>
   
</div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>

</body>
</html>
