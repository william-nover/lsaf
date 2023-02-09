<div class="clear"> </div>

<?php if(!empty($getContent)){?>  
        
    <?php foreach ($getContent as $gc) { ?> 
         <?php if ($gc->page_type== 2){?>
            <h1>  <?php echo $gc->content_title ;?></h1>
            <img src="<?php echo BASE_URL.'/'.$gc->content_image;?>">
            <?php } else {?>
            <h2> <?php echo $gc->content_title ;?></h2>   
            <?php }?>
        <div class="clear"> </div>
         <p class="text-justify">
           <?php echo html_entity_decode($gc->content_desc) ;?> 
        </p> 
        
        <?php if(!empty($gc->accordion)){?>        
         <div class="accordion">
        
            <script src="<?php echo JS_BASE_URL ;?>/woco.accordion.min.js"></script>
            <script src="<?php echo JS_BASE_URL ;?>/script.js"></script>
            <?php foreach ($gc->accordion as $ga) { ?>
            <h1><?php echo strtoupper($ga->accordion_title);?></h1>
            <div>
             <p class="text-justify">
                <?php echo html_entity_decode($ga->accordion_desc) ;?> 
                </p>   
            </div>
                
            <?php }?>
            <script>
            $(".accordion").accordion();
            </script>          
             </div>
       
<?php }?>
        
        
    <?php }?>
<?php }?> 
               


        <div class="content-closing">
        	<div class="share">
            	<h1> SHARE </h1>
                <a href="#"> <img src="<?php echo IMAGES_BASE_URL;?>/sosmed-a.png"> </a>
                <a href="#"> <img src="<?php echo IMAGES_BASE_URL;?>/sosmed-b.png"> </a>
                <a href="#"> <img src="<?php echo IMAGES_BASE_URL;?>/sosmed-c.png"> </a>
            </div>
            <a href="#"> <button class="back-top"> back to top </button> </a>
        </div>


    	
        
        
      
        
        
        
       