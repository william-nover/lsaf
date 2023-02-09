<div class="content-menu">
            <ul>               
                <?php if (!empty($MenuContent)){?>
                <?php foreach($MenuContent as $mc):?>                
                <a href="<?php echo $mc->menu_url;?>"><li <?php if ($mc->menu_id==$menu_id){echo 'class="content-menu-act"';};?>><?php echo $mc->menu_title ?></li> </a>              
                <?php endforeach;?>
                <?php } ?>
            </ul>
</div>
