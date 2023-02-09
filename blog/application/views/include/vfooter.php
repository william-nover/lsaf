
<footer class="footer-strip-dark bg-black padding-50px-tb xs-padding-30px-tb">
            <div class="container">
                <div class="row equalize xs-equalize-auto">
                    <!-- start logo -->
                    <div class="col-md-3 col-sm-3 col-xs-12 display-table sm-text-center xs-margin-20px-bottom">
                        <div class="display-table-cell vertical-align-middle">
                            <a href="<?=BASE_URL;?>" title="home"><img class="footer-logo" src="<?= IMAGES_BASE_URL;?>/logo.png" data-rjs="<?= IMAGES_BASE_URL;?>/logo.png" alt="lsafglobal" style="max-height: 75px"></a>
                        </div>
                    </div> 
                    <!-- end logo -->
                    <!-- start copyright -->
                    <div class="col-md-6 col-sm-6 col-xs-12 text-center text-small alt-font display-table xs-margin-10px-bottom text-white">
                        <div class="display-table-cell vertical-align-middle">
                            &copy; <?= @date('Y')?> Powered by  <a href="<?=BASE_URL;?>" target="_blank" title="lsafglobal" style="color: #fff"> London School of Accountancy and Finance, All Rights Reserved</a><br>
                       
                        </div>
                    </div>
                    <!-- end copyright -->
                    <!-- start social media -->
                    <div class="col-md-3 col-sm-3 col-xs-12 display-table text-right sm-text-center">
                        <div class="display-table-cell vertical-align-middle">
                            <div class="social-icon-style-8 display-inline-block vertical-align-middle">
                                <ul class="small-icon no-margin-bottom">
                                     <?php if($countSosmed > 0){
                                        $i=0;
                                        foreach($ListSosmed as $loc){  $i++;  
                                        ?>
                                             <li><a class="facebook text-white" title="facebook" href="<?= html_entity_decode(contentValue($loc, 'fb'));?>/" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                             <li><a class="twitter text-white" title="twitter" href="<?= html_entity_decode(contentValue($loc, 'tw'));?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                             <li><a class="google text-white" title="linkedin" href="<?= html_entity_decode(contentValue($loc, 'lk'));?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                             <li><a class="instagram text-white" title="youtube" href="<?= html_entity_decode(contentValue($loc, 'ty'));?>" target="_blank"><i class="fab fa-youtube no-margin-right" aria-hidden="true"></i></a></li>                   
                                     <?php }}?>                        
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end social media -->
                </div>
            </div>
        </footer>
        
       
     <!-- start scroll to top -->
     <a class="scroll-top-arrow" href="javascript:void(0);" title="back to top"><i class="ti-arrow-up"></i></a>
      <!-- end scroll to top  -->
      <ul class="ul_wa list-style-none">
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+628111047338&text=Hi%20LSAF,%20I%20want%20to%20ask%20you%20something."  target="_blank" title="whatsapp">
                <img whatsapp wa-1 src="<?= IMAGES_BASE_URL;?>/wa1.png" alt="628111047338">
            </a> 
        </li>    
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+6287785477338&text=Hi%20LSAF,%20I%20want%20to%20ask%20you%20something."  target="_blank" title="whatsapp">
                <img whatsapp wa-2 src="<?= IMAGES_BASE_URL;?>/wa2.png" alt="6287785477338">
            </a>
            </li>   
     
     </ul>
           
</div>