 <div class="person">
    	<h1> DO YOU WANT TO BE SUCCESSFUL LIKE ACCA MEMBERS?</h1>
        <div class="person-responsive">           
        <?php if($countBannerHome > 0){ ?>
            <?php foreach($dataBannerHome as $banner){ ?>
            <?php if($banner['banner_type'] == 2){?>
            <div class="foto">
            	<img src="<?php echo $banner['banner_images'];?>">
                <div class="ket">
                    <h1> <?php echo $banner['banner_name'];?></h1>
                    <div class="col col-lg-2"><?php echo html_entity_decode($banner['banner_desc']);?></div> 
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        <?php } ?>
        </div>
</div>