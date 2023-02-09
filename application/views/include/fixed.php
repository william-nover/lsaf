<div class="right-fixed">
   <div class="acca-logo"></div>
   <?php if (!$email){ ?> 
   <a href="<?php echo BASE_URL;?>/Location">
      <div class="inquiry"><span>SUBMIT INQUIRY</span></div>
   </a>
   <a href="<?php echo BASE_URL;?>/ApplyOnline">
      <div class="apply"><span>APPLY ONLINE</span></div>
   </a>
   <a href="<?php echo BASE_URL;?>/brochure">
      <div class="brochure"><span>BROCHURE</span></div>
   </a>
   <?php }   else {?>    
   <a href="<?php echo BASE_URL;?>/Location">
      <div class="inquiry"><span>SUBMIT INQUIRY</span></div>
   </a>
   <a href="<?php echo BASE_URL;?>/Location">
      <div class="brochure"><span>BROCHURE</span></div>
   </a>
   <?php  }?>
 
</div>
<div class="right-wa">
    <ul class="ul_wa list-style-none">
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+628111047338&text=Hi%20LSAF,%20I%20want%20to%20ask%20you%20something."  target="_blank" title="whatsapp">
                <img whatsapp wa-1 src="<?= IMAGES_BASE_URL;?>/wa1.png" alt="628111047338">
            </a> 
        </li>    
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+6287785477338&text=Hi LSAF, I want to ask you something."  target="_blank" title="whatsapp">
                <img whatsapp wa-2 src="<?= IMAGES_BASE_URL;?>/wa2.png" alt="6287785477338">
            </a>
        </li>        
     </ul>
</div>

<style>
    .ul_wa {
    line-height: 28px;
    height: 100px;
    max-width: 8%;
    min-width: 100px;
    padding: 0px;
    position: fixed;
    right: 2%;
    text-align: center;
    bottom: 25%;
    z-index: 1;
}
.ul_wa > li {
    display: inline-grid;
}
.ul_wa > li a img {
    max-width: 100%;
    height: auto;
}
</style>