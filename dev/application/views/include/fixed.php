<div class="right-fixed">   
    <div class="acca-logo"></div>   
    <?php if (!$email){ ?> 
        <a href="<?php echo BASE_URL;?>/ApplyOnline">
            <div class="apply"><span>APPLY ONLINE</span></div>
        </a> 
        <a href="<?php echo BASE_URL;?>/Location">
            <div class="inquiry"/><span>SUBMIT INQUIRY</span></div>
        </a>
        <a href="<?php echo BASE_URL;?>/Location">
            <div class="brochure"/><span>BROCHURE</span></div>
        </a>  
    <?php }   else {?>    
        <a href="<?php echo BASE_URL;?>/Location">
            <div class="inquiry"><span>SUBMIT INQUIRY</span></div>
        </a>
        <a href="<?php echo BASE_URL;?>/Location">
            <div class="brochure"/><span>BROCHURE</span></div>
        </a> 
        <?php  }?>    
</div>