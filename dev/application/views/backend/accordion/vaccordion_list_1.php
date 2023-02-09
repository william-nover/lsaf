
<div class="col-lg-11">                              
         <div class="clear"></div>
 <div id='ajax-list'>
    <script>


function saveTitle(data_id, data_title)
{

	  	$.ajax({
			url: '<?php echo BASE_URL_BACKEND;?>/Accordion/saveTitle',
			type: 'post',
			data: {primary_key: data_id, value: data_title},
                        
			beforeSend: function()
			{
				$('.file-upload-messages-container:first').show();
				$('.file-upload-message').html("<?php echo 'saving_title';?>");
			},
			complete: function()
			{
				$('.file-upload-messages-container').hide();
				$('.file-upload-message').html('');
                                //alert("succesfull edited " + data_title);
			}
			});
}

function saveDescription(data_id, data_description)
{
	
	  	$.ajax({
			url: '<?php echo BASE_URL_BACKEND;?>/Accordion/saveDescription',
			type: 'post',
			data: {primary_key: data_id, value: data_description},
			beforeSend: function()
			{
				$('.file-upload-messages-container:first').show();
				$('.file-upload-message').html("<?php echo 'saving_description';?>");
				//alert("begin " + data_description + " id " + data_id);
			},
			complete: function()
			{
				$('.file-upload-messages-container').hide();
				$('.file-upload-message').html('');
				//alert("succesfull edited " + data_description );
			}
			});
}

</script>

<?php if(!empty($ListAccordion)){?>
	
	<script type='text/javascript'>
		$(function(){
			
    	
    		$('.ic-title-field').keyup(function(e) {
    			if(e.keyCode == 13) {
					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();
                                  alert(data_title);
					saveTitle(data_id, data_title);
    			}
    		});

    		$('.ic-title-field').bind({
    			  click: function() {
    				$(this).css('resize','both');
    			    $(this).css('overflow','auto');
    			    $(this).animate({height:30},30);
    			  },
    			  blur: function() {
      			    $(this).css('resize','none');
      			  	$(this).css('overflow','hidden');
      			  	$(this).animate({height:30},30);

					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();
                                        //alert(data_title);
					saveTitle(data_id, data_title);
    			  }
    		});
		$('.ic-description-field').keyup(function(e) {
    			if(e.keyCode == 13) {
					var data_id = $(this).attr('data-id');
					var data_description = $(this).val();

					saveDescription(data_id, data_description);
    			}
    		});

    		$('.ic-description-field').bind({
    			  click: function() {
                            $(this).css('resize','both');
    			    $(this).css('overflow','auto');
    			    $(this).animate({height:50},45);
    			  },
    			  blur: function() {
      			    $(this).css('resize','none');
      			  	$(this).css('overflow','hidden');
      			  	$(this).animate({height:50},45);

					var data_id = $(this).attr('data-id');
					var data_description = $(this).val();

					saveDescription(data_id, data_description);
    			  }
    		});
		});
	</script>

    <ul class='photos-crud'>
        <form name="formAssignment" method="POST" action="" onsubmit="return false;">
    <?php if(count($ListAccordion) > 0){
        $no=1; foreach($ListAccordion as $accordion){
                $no++;
        ?>
            <li id="photos_<?php echo $accordion['accordion_id']; ?>">              
                            
                            <div class="col-sm-8 col-md-8">
                            <div class="product-image-wrapper panel panel-default ">
                            <div class="panel-body">
                            <div class="productinfo text-center">
				<div class='photo-box'>
                                   
                                    
                                        <?php if($accordion['accordion_title'] !== null){ ?>
                                        
                                        <div class="form-group">
                                            <input type="text" class="ic-title-field form-control"  data-id="<?php echo $accordion['accordion_id']; ?>" value="<?php echo $accordion['accordion_title']; ?>"autocomplete="off" />
					</div>
                                         <div class="clear"></div><?php }?>
                                        <?php if($accordion['accordion_desc'] !== null){ ?>
					 <div class="form-group">
                                        <textarea id="IDaccordesc<?php echo $no;?>" class="ic-description-field form-control ckeditor" data-id="<?php echo $accordion['accordion_id']; ?>" autocomplete="off" ><?php echo $accordion['accordion_desc']; ?></textarea>
					 <script>
                                        CKEDITOR.replace( 'IDaccordesc<?php echo $no;?>', {
                                                toolbar: [
                                                        { name: 'document', items : [ 'Source'] },
                                                        { name: 'insert', items : [ 'Table','HorizontalRule','SpecialChar','PageBreak'] },
                                                        { name: 'colors',      items : [ 'TextColor','BGColor' ] },
                                                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                                                        { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                                                        { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList'] },
                                                 ],
                                                width : 800,
                                                height: 100
                                        });
                                        </script> 
                                         </div>
                                        <div class="clear"></div><?php }?>
    
                                        
					<div class='delete-box'>
                                        <div class="form-group">
                                        <?php if($order){ ?>
                                           <input type="text" class="form-control" style="text-align:center; width:40px;" name="order[<?php echo $accordion['accordion_id'];?>]" size="1" maxlength="2" value="<?php echo $accordion['accordion_order'];?>">
                                         <?php } ?>                                
					</div>
                                                <a button class="btn-success btn-sm" title="Click to Inactive" href="#"><i class="icon-save"></i></a> &nbsp;
                                                 <?php if($approve){ ?>
                                                            <?php if($accordion['accordion_active_status'] == 1) {?>
                                                        &nbsp;   <a class="btn-success btn-sm" title="Click to Inactive" href="<?php echo BASE_URL_BACKEND."/".$controller."/active/".$accordion['accordion_id'];?>"><i class="icon-ok"></i></a> &nbsp; 
                                                            <?php } else { ?>
                                                        &nbsp;    <a class="btn-danger btn-sm" title="Click to Active" href="<?php echo BASE_URL_BACKEND."/".$controller."/active/".$accordion['accordion_id'];?>"><i class="icon-remove"></i></a> &nbsp;
                                                            <?php } ?>
                                                    <?php } ?>

                                                    <?php if($delete){ ?>
                                                          &nbsp;  <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?php echo $accordion['accordion_title'];?> ?'); if (answer){window.location = '<?php echo BASE_URL_BACKEND.'/'.$controller;?>/delete/<?php echo $accordion['accordion_id'];?>';}"><span class="icon-trash"></span></a> &nbsp;
                                                    <?php } ?>
                                           
						
					</div>
					
				</div>
                            </div>
                            </div>
                            </div>
                            </div>
			</li>                          
                                    

                         <?php } ?> <?php }else {?>      
                        <li> data not found </li>                         
                            <?php } ?>
                </form>  
		</ul>
        <?php }?>

</div>     
    

</div> 