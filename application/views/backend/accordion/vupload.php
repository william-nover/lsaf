       <div class="col-lg-6 center-block">    
        <div class="message_box">
            <?php
            if (isset($success) && strlen($success)) {
                echo '<div class="success">';
                echo '<p>' . $success . '</p>';
                echo '</div>';
            }
 
            if (isset($errors) && strlen($errors)) {
                echo '<div class="error">';
                echo '<p>' . $errors . '</p>';
                echo '</div>';
            }
 
            if (validation_errors()) {
                echo validation_errors('<div class="error">', '</div>');
            }
            ?>
        </div>
        <div>
              <?php echo form_open_multipart(BASE_URL_BACKEND."/Accordion/insert", array('id' => 'upload-file-form'));
            ?>
           <?php //echo form_open_multipart("backend/accordion/doupload","id='categoryForm'","method='method='","class='form-horizontal'");?>
            
             <div class="col-sm-8 col-md-8">
                            <div class="product-image-wrapper panel panel-default ">
                            <div class="panel-body">
                            <div class="productinfo text-center">
				<div class='photo-box'>
				<div class="form-group">
                                      
                                    
                                        <input type="text" class="ic-title-field form-control" name="accordion_title[]" id="accordion_title1" type="text" class="form-control" placeholder="Accorddion Title" value="">
                                      
                               </div>
                    <div class="form-group">
                                      
                                    <textarea id="IDaccordesc1" name="accordion_desc[]" class="ic-description-field form-control ckeditor" placeholder="Accordion Description" rows="7"></textarea>
                                       <script>
                                        CKEDITOR.replace( 'IDaccordesc1', {
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
                    <div id="moreAccordion"></div>
                    <div style="clear:both;"></div>
                    <div id="moreAccordionLink" style="">
                       
                    </div>
                    <script type="text/javascript">
    $(function() {
        var accordion_number = 2;
        $('#accordionMore').click(function() {
            //add more file
            var moreAccordionTag = '';
           
                    moreAccordionTag += '<div class="form-group">';
                  
                    moreAccordionTag += '<input id="accordion_title' + accordion_number + '" name="accordion_title[]" type="text" class="ic-title-field form-control" placeholder="Accorddion Title">';
                   
                    moreAccordionTag += '</div>';
                    moreAccordionTag += ' <div class="form-group">';
                    
                    moreAccordionTag += '<textarea id="IDaccordescs' + accordion_number + '" name="accordion_desc[]" class="ic-description-field form-control ckeditor" placeholder="Accordion Description" rows="7">Accorddion Desc</textarea>';                                 
                  
                    moreAccordionTag += '</div>';
                    moreAccordionTag += '&nbsp;<a href="javascript:del_accordion(' + accordion_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")">Delete ' + accordion_number + '</a></div>';
            
            
            $('<dl id="delete_file' + accordion_number + '">' + moreAccordionTag + '</dl>').fadeIn('slow').appendTo('#moreAccordion');
              CKEDITOR.replace( 'IDaccordescs' + accordion_number , {
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
           // CKEDITOR.enableAutoInline = true;
           //  CKEDITOR.inline( 'IDaccordescs' + accordion_number );
            accordion_number++;
           
        });
        
        
         
    });
</script>	

  
                    <footer>
                <a href="#" id="accordionMore" class="btn btn-outline">Add More field</a>                        
                 <input type="submit" name="file_upload" value="Upload" class="btn btn-submit btn-outline btn-primary"/>
                 <input class="btn btn-primary btn-danger" type="button" value="Cancel" onClick="javascript:hideFormUpload()">
                    </footer>
				</div>
                            </div>
                            </div>
                            </div>
                            </div>
            
            
            
         
            
            <?php
            echo form_close();
            ?>
        </div>       
</div> 
<script type="text/javascript">
    function del_accordion(eleId) {
        var ele = document.getElementById("delete_file" + eleId);
        ele.parentNode.removeChild(ele);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[id^='upload_file']").each(function() {
            var id = parseInt(this.id.replace("upload_file", ""));
            $("#upload_file" + id).change(function() {
                if ($("#upload_file" + id).val() !== "") {
                    $("#moreImageUploadLink").show();
                }
            });
        });
    });
</script>

           
<script language="javascript">
	function Confirm_hapus(){
		if(confirm("KONFIRMASI PENGHAPUSAN DATA\nTekan OK untuk melanjutkan penghapusan data")==true){
			return true;
		}else{
			return false;
		}
	}
</script>