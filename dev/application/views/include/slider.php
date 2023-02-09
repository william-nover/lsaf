

<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1000px; height: 400px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('assets/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
      
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1000px; height: 400px; overflow: hidden;">
              <?php if($countBannerHome > 0){ ?>
                    <?php $i= 0;foreach($dataBannerHome as $banner){ ?>
                            <?php if($banner['banner_type'] == 1){?>
        
                        <div data-b="<?php echo $i;?>" data-p="170.00" style="display: none;">
                             <?php if(!empty($banner['banner_url'])){?>
                                                <a  u=image href="<?php echo $banner['banner_url'];?>" target="_blank" id="slide-video" <?php if(!empty($banner['banner_name'])){?> title="<?php echo $banner['banner_name'];?>" <?php } ?>><img src="<?php echo BASE_URL.$banner['banner_images'];?>" <?php if(!empty($banner['banner_name'])){?> alt="<?php echo $banner['banner_name'];?>" <?php } ?>/></a>
                                        <?php } else { ?>
                                               <a u=image href="#">  <img src="<?php echo BASE_URL.$banner['banner_images'];?>" <?php if(!empty($banner['banner_name'])){?> alt="<?php echo $banner['banner_name'];?>" <?php } ?>/></a>
                                        <?php } ?> 
                 
                            <div data-u="caption" class="text_slider" data-t="18">
                            
                                <h3 class="title-banner">
                                    <?php echo html_entity_decode($banner['banner_name']);?>.<br />
                                 </h3>
                                <p class="content-banner">
                                    <?php echo html_entity_decode($banner['banner_desc']);?>        
                                </p>
                               

                            </div>
                            
                        </div>
                            
                        <?php } ?>
                    <?php $i++;} ?>
                <?php } ?>
            
          
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:10px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:10px;width:40px;height:58px;" data-autocenter="2"></span>
        
    </div>
