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
            <?php foreach ($getPersonal as $gp) { ?>
                <table class="gridtable2">        
                    <tr>
                        <th>Name</th><td><?php echo $gp->full_name ;?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th><td><?php echo $gp->date_of_birth ;?></td>
                    </tr>
                    <tr>
                        <th>Nationality</th><td><?php echo $gp->country_name ;?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th><td><?php echo $gp->phone ;?></td>
                    </tr>
                    <tr>
                        <th>Postal Address</th><td><?php echo $gp->address1 ;?> &nbsp; <?php echo $gp->address2 ;?></td>
                    </tr>
                    <tr>
                        <th>Email Address</th><td><?php echo $gp->email ;?></td>
                    </tr>
                   <div class="foto-das"> <img src="<?php echo IMAGES_BASE_URL ;?>/foto-das.png" width="100px" height="100px"> </div>
                 </table>
                 
                <a style="display: none" href="<?php echo BASE_URL;?>/Student_info/edit"> <button class="edit-pro"> edit student profile </button> </a>
              <a href="<?php echo BASE_URL;?>/Student_info/changepassword"> <button class="edit-pro"> change password </button> </a>
                <?php }?>    
            </div>
   
</div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>

</body>
</html>
