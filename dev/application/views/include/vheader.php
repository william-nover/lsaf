    
<div class="intro-header">
        <div class="intro-isi">
            <img src="<?php echo IMAGES_BASE_URL;?>/ACCA-logo.png">
            <div class="intro-email"> <span> info@lsaf.eu </span> </div>
            <div class="intro-telp"> <span> +6221 2936 4793 / 96 </span> </div>
            <div class="intro-whats"> <span> +62877 8547 7388 </span> </div>
            <div class="intro-right">
				<a href="https://www.facebook.com/LSAF.ACCA.JAKARTA/" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/fb.png"> </a>                <a href="https://twitter.com/LSAF_JKT" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/tw.png"> </a>                <a href="https://plus.google.com/115543368685609823179/posts?hl=en" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/g+.png"> </a>                <a href="https://www.linkedin.com/in/lsaf-london-school-of-accountancy-and-finance-823629b8" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/in.png"> </a>                <a href="https://www.youtube.com/channel/UCvVRqGBzsqHZN-2QY0ML_9g" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/yt.png"> </a>                
                 <form action="" method="post" class="search">
                        <input id="name" type="text" name="name" placeholder="search.." />
                 </form>
            </div>
        </div>
 </div>
<div class="clear"> </div>
<header>
    	<div class="header-left">
        	<img src="<?php echo IMAGES_BASE_URL;?>/logo-master.jpg">
        </div>
		<div class="hide-mylsaf" style="display:none;"><a href="#"> <img src="<?php echo IMAGES_BASE_URL;?>/my-lsaf-logo-home-res.png"></a> </div>
    	<div class="header-right">
        	<a href="<?php echo BASE_URL.'/Mylsaf';?>"><img src="<?php echo IMAGES_BASE_URL;?>/my-lsaf-logo-home.png"></a>
            <div class="clear"> </div>
            <?php 
            $pathBannerHome = PATH_ASSETS."/json/menu.json";
            $arrBannerHome = json_decode(file_get_contents($pathBannerHome),TRUE);
            $Menu_all = $arrBannerHome;
                ?>
           
            <div id='menu'>
                <ul>
                   <li class="home-menu"><a href='<?php echo BASE_URL;?>'></a></li>
                   <?php foreach($Menu_all as $mall){ ?>                   
                    <?php if(empty($mall['child_first'])){  ?> 
                    <li><a href='<?php echo BASE_URL.'/'.$mall['menu_url'];?>'><?php echo $mall['menu_title'];?></a></li>
                     <?php }else
                         {?> 
                    <li class='active'><a href='<?php echo $mall['menu_url'];?>'><?php echo $mall['menu_title'];?></a>
                        <ul>
                        <?php foreach ($mall['child_first'] as $cf) { ?>
                        <?php if(empty($cf['child_second'])){ ?>                         

                           <li><a href='<?php echo $cf['menu_url'];?>'><?php echo $cf['menu_title'];?></a> </li>            

                         <?php } else { ?>                         

                           <li><a href='<?php echo $cf['menu_url'];?>'><?php echo $cf['menu_title'];?></a>
                              <ul>
                                  <?php foreach ($cf['child_second'] as $cs) { ?>
                                 <li><a href='<?php echo $cs['menu_url'];?>'><?php echo $cs['menu_title'];?></a></li>
                                  <?php } ?>    
                              </ul>
                           </li>            

                         <?php } ?>
                         <?php } ?> 
                        </ul>
                    </li>
                  <?php } ?> 
                    <?php } ?>
                  <?php if (!$email){ ?>
                  <li class='active'><a href='<?php echo BASE_URL;?>/ApplyOnline'>Apply Online</a></li>
                    <?php } 
                    else {?>
                 <li class='active'><a href='<?php echo BASE_URL;?>/Signin/signout'>Logout</a></li>
                    <?php  }?>
                </ul>
                </div>
          </div>
    </header>