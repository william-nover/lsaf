<?php 
    $menuFooterAA = PATH_ASSETS."/json/menuFooterAA.json";
    $arrFooterAA = json_decode(file_get_contents($menuFooterAA),TRUE);
    $FooterAA = $arrFooterAA;
    
    $menuFooterAB = PATH_ASSETS."/json/menuFooterAB.json";
    $arrFooterAB = json_decode(file_get_contents($menuFooterAB),TRUE);
    $FooterAB = $arrFooterAB;
    
    $menuFooterBA = PATH_ASSETS."/json/menuFooterBA.json";
    $arrFooterBA = json_decode(file_get_contents($menuFooterBA),TRUE);
    $FooterBA = $arrFooterBA;
    
    $menuFooterBB = PATH_ASSETS."/json/menuFooterBB.json";
    $arrFooterBB = json_decode(file_get_contents($menuFooterBB),TRUE);
    $FooterBB = $arrFooterBB;
 
    $menuFooterC = PATH_ASSETS."/json/menuFooterC.json";
    $arrFooterC = json_decode(file_get_contents($menuFooterC),TRUE);
    $FooterC = $arrFooterC;
?>
<div class="footer-link">
    	<div class="footer-link-1">
        <?php if($FooterAA){  ?>
            <?php $no=1; foreach($FooterAA as $fa){ ?>
                <div class="footer-link-1a">        
                <?php if(empty($fa['child_first'])){  ?>
                <h1> <?php echo $fa['menu_title']; ?></h1>
                <?php }else {?> 
                <h1> <?php echo $fa['menu_title']; ?></h1>
                    <?php foreach ($fa['child_first'] as $af) { ?>
                    <a href='<?php echo $af['menu_url'];?>'><p><?php echo $af['menu_title'];?></p></a>                  
                    <?php } ?>
               
                <?php } ?> 
                </div>
             <?php $no ++;} ?>
        <?php } ?> 
            
        <?php if($FooterAB){  ?>
            <?php $no=1; foreach($FooterAB as $fa){ ?>
                <div class="footer-link-1b">        
                <?php if(empty($fa['child_first'])){  ?>
                <h1> <?php echo $fa['menu_title']; ?></h1>
                <?php }else {?> 
                <h1> <?php echo $fa['menu_title']; ?></h1>
                    <?php foreach ($fa['child_first'] as $af) { ?>
                    <a href='<?php echo $af['menu_url'];?>'><p><?php echo $af['menu_title'];?></p></a>                  
                    <?php } ?>
               
                <?php } ?> 
                </div>
             <?php $no ++;} ?>
        <?php } ?>
               
        </div>
        <div class="footer-link-2">
             <?php if($FooterBA){  ?>
            <?php $no=1; foreach($FooterBA as $ba){ ?>
                <div class="footer-link-2a">        
                <?php if(empty($ba['child_first'])){  ?>
                <h1> <?php echo $ba['menu_title']; ?></h1>
                <?php }else {?> 
                <h1> <?php echo $ba['menu_title']; ?></h1>
                <?php foreach ($ba['child_first'] as $af) { ?>
                <a href='<?php echo $af['menu_url'];?>'><p class="color-grey"><?php echo $af['menu_title'];?></p></a> 
                   <?php if($af['child_second']){  ?>
                 <?php foreach ( $af['child_second'] as $cs) { ?>
                        <a href='<?php echo $cs['menu_url'];?>'><p class="sub"><?php echo $cs['menu_title'];?></p></a> 
                    <?php } ?>
                        <?php } ?> 
                <?php } ?>
               
                <?php } ?> 
                </div>
             <?php $no ++;} ?>
        <?php } ?>
    	</div>
        <div class="footer-link-3">
            <div class="footer-link-3a">            
                <?php foreach($FooterC as $fc){ ?> 
                <?php if(empty($fc['child_first'])){  ?>
                <h1> <?php echo $fc['menu_title']; ?></h1>
                <?php }else {?> 
                <h1> <?php echo $fc['menu_title']; ?></h1>
                    <?php foreach ($fc['child_first'] as $cf) { ?>
                    <a href='<?php echo $cf['menu_url'];?>'><p> <?php echo $cf['menu_title'];?></p></a>                  
                    <?php } ?>
                 <?php } ?>
                <?php } ?>
            </div>
            <div class="footer-link-3b">
               <div class="footer-link-3b">
                <?php if (!$email){ ?>
                    <a href='<?php echo BASE_URL;?>/ApplyOnline'><p> Apply Online</p> </a>
                    <a href='<?php echo BASE_URL;?>/Mylsaf'><p> Mylsaf</p> </a>
                    <?php } 
                    else {?>
                    <a href='<?php echo BASE_URL;?>/Signin/signout'><p>logout</p> </a>
             <?php  }?>               
            </div>
            </div>
        </div>
    </div>
    <div class="clear"> </div>
	<footer>
        <div class="footer-isi">
            <h1> © COPYRIGHT <?php date_default_timezone_set('UTC'); echo $today  = date("Y");?>  LONDON SCHOOL OF ACCOUNTANCY AND FINANCE, ALL RIGHTS RESERVED</h1>
            <ul>
                <a href="#"> <li> SITEMAP </li> </a>
                <a href="<?php echo BASE_URL.'/location';?>"> <li> LOCATION </li> </a>
                <a href="<?php echo BASE_URL.'/Privacy_Policy';?>"> <li> PRIVACY POLICY </li> </a>
                
            </ul>
        </div>
    </footer>   

