<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
</head>

<body><?php include_once("analyticstracking.php") ?>

<?php include "include/fixed.php"; ?>

<div class="container">	
   <?php include "include/vheader.php"; ?>
    
    <div class="content">
    
       <?php foreach ($getpages as $gp) {?> 
            <?php if (!empty($gp['pages_image'])){?>
            <h1> <?php 
             echo (str_replace ("_", " & ",  $gp['pages_title']));?></h1>           
            <img src="<?php echo BASE_URL.'/'.$gp['pages_image'];?>">
            <?php } else {?>
            <h2> <?php echo (str_replace ("_", " & ",  $gp['pages_title']));?></h1> 
            <?php }?>
        <div class="clear"> </div>
         <p class="text-justify">
           <?php echo html_entity_decode($gp['pages_desc']) ;?> 
        </p>   
          <?php }?>
     
    </div>
   
    <div class="clear"> </div>
   <?php include "include/vfooter.php"; ?>
     
</div>

</body>
</html>
