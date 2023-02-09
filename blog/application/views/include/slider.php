<div class="swiper-auto-fade swiper-container z-index-minus2 position-absolute top-0 w-100 h-100">
        <div class="swiper-wrapper">
            <?php
            if($countBanner > 0){
            $i=0;
            foreach($ListBanner as $ls){
            $i++;  
            ?>  
            <!-- start slider item -->
            <div class="swiper-slide cover-background one-third-screen" style="background-image:url('<?= html_entity_decode(contentValue($ls, 'images'));?>');"></div>
            <!-- end slider item -->
            <?php } } ?>      
        </div>
        <div class="swiper-pagination swiper-auto-pagination d-none"></div>
    </div>