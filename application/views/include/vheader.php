    
<div class="intro-header">
        <div class="intro-isi">
            <img src="<?php echo IMAGES_BASE_URL;?>/ACCA-logo.png">
            <div class="intro-email"> <span> info@lsafglobal.com </span> </div>
            <div class="intro-telp"> <span> +6221 2936 4793 / 96 </span> </div>
            <div class="intro-whats"> <span> +62877 8547 7388 </span> </div>
            <div class="intro-right">
			<form action="" method="post" class="search">
                     <!--  <input id="name" type="text" name="name" placeholder="search.." />-->
                 </form>
				<a href="https://www.facebook.com/LSAF.ACCA.JAKARTA/" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/fb.png"> </a>
                <a href="https://twitter.com/LSAF_JKT" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/tw.png"> </a>                
				<a href="https://plus.google.com/115543368685609823179/posts?hl=en" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/g+.png"> </a>               
				<a href="https://www.linkedin.com/in/lsaf-london-school-of-accountancy-and-finance-823629b8" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/in.png"> </a>                <a href="https://www.youtube.com/channel/UCvVRqGBzsqHZN-2QY0ML_9g" target="_blank"> <img src="<?php echo IMAGES_BASE_URL;?>/yt.png"> </a>                
                 
            </div>
        </div>
 </div>
<div class="clear"> </div>
<header>
    <div class="new-header">
        <div class="Column">
            <a href="<?php echo BASE_URL;?>"><img src="<?php echo IMAGES_BASE_URL;?>/logo-master.jpg" ></a> 
        </div>
        <div style="float:right; width:300px; " class="Column logo">
            <a href="https://myglobalguru.com/" target="_blank" style="float:left;margin-top:10px">
                <img src="<?php echo IMAGES_BASE_URL;?>/GLP Logo.png" style="width:86px;height:86px;margin-right:10px">
            </a>
            <br>
            <div class="myglobalguru">
                <b>MyGlobalGuru</b><br>
                <b>Join Global Profesional</b><br>
                <b>Certification Community</b>
            </div>
        </div>
        <div class="Column arrow" style="width:86px;margin-left:10px;">
            <a href="https://myglobalguru.com/" target="_blank" >
                <img src="<?php echo IMAGES_BASE_URL;?>/arrow_white_right.gif" style="width:50px;height:30px;margin-bottom:30px">
            </a>
        </div>
    </div>
    <div class="clear"> </div>
    <?php 
    $pathBannerHome = PATH_ASSETS."/json/menu.json";
    $arrBannerHome = json_decode(file_get_contents($pathBannerHome),TRUE);
    $Menu_all = $arrBannerHome;
        ?>
    
    <div id='menu'>
        <ul>
            <!-- <li class="home-menu">
                <a href='<?php echo BASE_URL;?>'></a>
            </li> -->
            <?php foreach($Menu_all as $mall){ ?>                   
            <?php if(empty($mall['child_first'])){  ?> 
            <li>
                <a href='<?php echo BASE_URL.'/'.$mall['menu_url'];?>'>
                    <?php echo $mall['menu_title'];?>
                </a>
            </li>
                <?php }else{?> 
            <li class='active1'>
                <a href='<?php echo $mall['menu_url'];?>'>
                    <?php echo $mall['menu_title'];?>
                </a>
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
            <!-- <li class='active'><a href='<?php echo BASE_URL;?>/ApplyOnline'>Apply Online</a></li> -->
            <li class='active mylsaf' style="display:none;"><a href='<?php echo BASE_URL;?>/mylsaf'>My LSAF</a></li>
            <?php } 
            else {?>
            <li class='active'><a href='<?php echo BASE_URL;?>/Signin/signout'>Logout</a></li>
            <?php  }?>
            <!-- <li class='active'><a href='<?php echo BASE_URL;?>/blog'>Success Story</a></li> -->
        </ul>
    </div>
</header>


<style>
    @font-face {
        font-family: sansation;
        src: <?php echo FONT_BASE_URL;?>/Sansation_Bold.ttf";
    }
    .new-header {
        background-color: #071F89;
        display:inline;
        width:100%;
        display: table;
        table-layout: fixed; /*Optional*/
        border-spacing: 5px; /*Optional*/
        height:100px
    }
    .Column {
        display: table-cell;
    }
    .new-header a img{
        height: 100px;
        width:300px;
    }
    .myglobalguru{
        margin-top:5px;
        margin-left:5px;
    }
    .myglobalguru b{
        font-family:"Lucida Sans", "lucida-sans";
        font-size:"24px";
        color:white;
    }

    @media screen and (max-width: 1150px) {
        .arrow{
            /* background-color:#000; */
            display:none;
        }
        .logo{
            display:none;
        }
        .myglobalguru{
            display:none;
        }
        #menu li:hover>ul{
            left:0px;
            top:0px;
        }
    }
</style>