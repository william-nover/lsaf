
<div class="col-lg-11">                              
         <div class="clear"></div>
 <div id='ajax-list'>
    <script>
function doSave(id) {
   var id_accordion = id;
   
  var accordiontitle = $("#accordion_title"+id_accordion).val();
  var accordionDesc =  document.getElementById("trackingDiv"+id_accordion).value;

  saveAccordion(id_accordion, accordiontitle, accordionDesc);

  
}

function saveAccordion(id_accordion, accordiontitle, accordionDesc)
{

	  	$.ajax({
			url: '<?php echo BASE_URL_BACKEND;?>/Accordion/saveAccordion',
			type: 'post',
			data: {primary_key: id_accordion, title: accordiontitle, desc: accordionDesc},
                        
			beforeSend: function()
			{	
                                $('.loadergif'+id_accordion).show();
			},
			complete: function()
			{
				//alert("succesfull edited data");
				$('.loadergif'+id_accordion).hide();
                                
			}
			});
}



</script>

<?php if(!empty($ListAccordion)){?>	

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
                                          <div class="loadergif<?php echo $accordion['accordion_id']; ?> col-md-5 text-center" style="display: none;"><img src='<?php echo IMAGES_BASE_URL;?>/preloader.gif' /></div>
                                        <div class="form-group">
                                            <input type="text" class="ic-title-field form-control"  id="accordion_title<?php echo $accordion['accordion_id']; ?>" value="<?php echo $accordion['accordion_title']; ?>"autocomplete="off" />
					</div>
                                         <div class="clear"></div><?php }?>
                                        <?php if($accordion['accordion_desc'] !== null){ ?>
                                         <textarea id="trackingDiv<?php echo $accordion['accordion_id']; ?>" style="display: none"> </textarea>
                                       
                                         <div class="form-group">
                                             <textarea id="IDaccordesc<?php echo $accordion['accordion_id']; ?>" name="IDaccordesc<?php echo $accordion['accordion_id']; ?>" class="ic-description-field form-control ckeditor"><?php echo $accordion['accordion_desc']; ?></textarea>
					
                                             <script>
                                            
                                            
                                        CKEDITOR.replace( 'IDaccordesc<?php echo $accordion['accordion_id']; ?>', {
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
                                    timer = setInterval(updateDiv,100);
                                    function updateDiv(){
                                        var editorText = CKEDITOR.instances.IDaccordesc<?php echo $accordion['accordion_id']; ?>.getData();
                                        $('#trackingDiv<?php echo $accordion['accordion_id']; ?>').html(editorText);
                                    }
                                       
                                        
                                        
                                        </script> 
                                         </div>
                                       
                                        <div class="clear"></div>
                                        <?php }?>                                  
					<div class='delete-box'>
                                        <div class="form-group">
                                        <?php if($order){ ?>
                                           <input type="text" class="form-control" style="text-align:center; width:40px;" name="order[<?php echo $accordion['accordion_id'];?>]" size="1" maxlength="2" value="<?php echo $accordion['accordion_order'];?>">
                                         <?php } ?>                                
					</div>
                                                <a button class="btn-success btn-sm" id="<?php echo $accordion['accordion_id'];?>"  onclick="doSave(this.id)"><i class="icon-save"></i></a> &nbsp;
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