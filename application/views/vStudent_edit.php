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
                <?php echo form_open(BASE_URL.'/Student_info/UpdateData', 'class="location-form" id="myform"'); ?>
                    <?php foreach ($getPersonal as $gp) { ?>
                
                <table class="gridtable2">        
                    <tr>
                        <th>Name</th><td> <input type="text" name="full_name" value="<?php echo $gp->full_name ;?>"></td>
                    </tr>
                    <tr>
                        <th>Date of Birth (YY-MM-DD)</th><td> <input type="text" name="dob" value="<?php echo $gp->date_of_birth ;?>"></td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>
                            <select name="nationality">
                                 <?php foreach($getNationality as $gn){ ?> 
                                    <option value="<?php echo $gn->country_id;?>" <?php if($gn->country_id ==  $gp->country_id) { echo "selected";} ?>> <?php echo $gn->country_name;?> </option>
                                <?php } ?>
                            </select>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>Phone Number</th><td><input type="text" name="phone" value="<?php echo $gp->phone ;?>"></td>
                    </tr>
                    <tr>
                        <th>Postal Address</th><td><input type="text" name="addr1" value="<?php echo $gp->address1 ;?>"> &nbsp; <input type="text" name="addr2" value="<?php echo $gp->address2 ;?>"></td>
                    </tr>
                    <tr>
                        <th>Email Address</th><td><input type="text" name="email" value="<?php echo $gp->email ;?>"></td>
                    </tr>
                     <tr>
                         <!--<th>Photo</th><td><input type="file" name="photo" class="photo"></td>-->
                    </tr>       
                 </table>
                
                    <input type="submit" class="edit-pro" value="Save"><input type="reset" class="edit-cancel" value="Cancel">
                
                <?php }?>  
                <?php echo form_close(); ?>
                </div>
            </div>
   
</div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>

</body>
</html>
