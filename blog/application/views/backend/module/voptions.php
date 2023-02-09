<?= form_open_multipart(BASE_URL_BACKEND."/module/insertOptions", array('id' => 'upload-file-form'));?>
<input type="hidden" name="label_id" readonly="readonly" id="label_id" class="form-control" value="<?= $label['label_id'];?>">
<input type="hidden" name="type_id" readonly="readonly" id="type_id" class="form-control" value="<?= $label['type_id'];?>">  
<div class="form-group m-form__group row">
         <label class="col-lg-2 col-form-label">
         Option Title:
         </label>
         <div class="col-lg-8">
            <input name="options_title[]" id="options_title1" type="text" class="form-control" placeholder="options Title" value="">
         </div>
      </div>

      <div id="moreAccordion<?= $label['label_id'];?>"></div>
      <div style="clear:both;"></div>
      <div id="moreAccordionLink<?= $label['label_id'];?>" style="">
      </div>
      
      <div class="form-group m-form__group row">  
         <a class="btn btn-sm btn-warning" href="javascript:void(0);" id="subpageMore<?= $label['label_id'];?>"><span> <i class="fa fa-plus"></i> <span></span></a>                       
         <input type="submit" name="file_upload" value="Save" class="btn btn-submit btn-sm"/>
         <input class="btn btn-sm btn-danger" id="<?= $label['label_id'];?>" type="button" value="Cancel" onClick="hideFormUpload(this.id)">
      </div>
<script type="text/javascript">
         $(function() {
             var subpage_number = 2;
             $('#subpageMore<?= $label['label_id'];?>').click(function() {
                 //add more file
                 var moreSubpageTag = '';

                         moreSubpageTag += '<div class="form-group m-form__group row">';
                                         moreSubpageTag += '<label for="inputsubpage" class="col-lg-2 col-sm-2 control-label">Gallery Title</label>';
                                         moreSubpageTag += '<div class="col-lg-8">';
                                         moreSubpageTag += '<input id="options_title' + subpage_number + '" name="options_title[]" type="text" class="form-control" placeholder="options Title" value="">';
                                         moreSubpageTag += '</div>';
                                     moreSubpageTag += '</div>';

                         moreSubpageTag += '<div class="form-group m-form__group row">';

                                         moreSubpageTag += '<div class="m-form__group">';
                                         moreSubpageTag += '<div class="col-lg-12">';
                                         moreSubpageTag += '&nbsp;<a class="btn-danger btn-sm"  href="javascript:del_accordion(' + subpage_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")"><span class="la la-trash"></span> ' + subpage_number + '</span></a>';                                                                                      
                                         moreSubpageTag += '</div>';
                                     moreSubpageTag += '</div>';         



                 $('<dl id="delete_file' + subpage_number + '">' + moreSubpageTag + '</dl>').fadeIn('slow').appendTo('#moreAccordion<?= $label['label_id'];?>');

                // CKEDITOR.enableAutoInline = true;
                //  CKEDITOR.inline( 'IDaccordescs' + subpage_number );
                 subpage_number++;

             });
         });
      </script>	
<?php
   echo form_close();
   ?>
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