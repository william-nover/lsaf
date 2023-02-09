<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
   <!-- begin:: Page -->
   <div class="m-grid m-grid--hor m-grid--root m-page">
      <?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
      <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
         <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>	
         <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
               <div class="d-flex align-items-center">
                  <div class="mr-auto">
                     <h4 class="m-subheader__title m-subheader__title--separator">
                        Module - <?= $module_name; ?> - Label
                     </h4>
                  </div>
               </div>
            </div>
            <?php if(isset($error)){ ?>
            <div class="panel-body">
               <div class="form-group has-error">
                  <label for="inputError" class="col-sm-2 control-label col-lg-2"><?= $error;?></label>
               </div>
            </div>
            <?php } ?>
            <!-- END: Subheader -->
            <div class="m-content">
               <div class="m-portlet m-portlet--mobile">
                  <div class="m-portlet__body">
                     <!--begin: Search Form -->
                     <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                           <div class="col-xl-8 order-2 order-xl-1">
                              <div class="form-group m-form__group row align-items-center">
                                 <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                       <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                       <span class="m-input-icon__icon m-input-icon__icon--left">
                                       <span>
                                       <i class="la la-search"></i>
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 order-1 order-xl-4 m--align-right">
                              <a href="<?= BASE_URL_BACKEND;?>/module/addLabel/<?= $module_id;?>" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                              <span> <i class="fa fa-plus"></i> <span> ADD</span>
                              </span>
                              </a>
                              <button id="doOrder" class="btn btn-success btn-sm m-btn  m-btn m-btn--icon">
                              <span> <i class="fa fa-repeat"></i> <span> Order</span>
                              </span>
                              </button>
                           </div>
                        </div>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <section id="unseen">
                         <form name="formLabel" method="POST" action="" onsubmit="return false;">
                               <table class="" id="html_table" width="100%">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Label </th>
                                 <th>Name</th>
                                 <th>Type</th>
                                 <th>Options</th>
                                 <th>Child</th>
                                 <th>Vicible</th>
                                 <th>Show Landing</th>
                                 <th>Order</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 if(count($ListLabel) > 0){
                                 $no=0;
                                 foreach($ListLabel as $label){
                                         $no++;
                                 ?>
                              <tr>
                                 <td><?= $no;?></td>
                                 <td><?= $label['label_title'];?></td>
                                 <td><?= $label['label_name'];?></td>
                                 <td><?= $label['type_title'];?></td>
                                 <td>
                                    <?php if($label['type_id'] == 6 || $label['type_id'] == 7 || $label['type_id']==9) {?>
                                    <a href="#" class="btn-outline-warning btn-sm" data-toggle="modal" data-target="#m_modal_<?= $label['label_id'];?>">
                                    <i class="la la-list"></i>
                                    </a>
                                    <?php } ?>
                                 </td>
                                 <td>
                                    <?php if($label['type_id'] == 8) {?>
                                    <a href="#" class="btn-outline-warning btn-sm" data-toggle="modal" data-target="#m_modal_c<?= $label['label_id'];?>">
                                    <i class="la la-list"></i>
                                     <?php } ?>
                                    </a>
                                 </td>
                                 <td><?= $label['label_view'];?></td>
                                 <td><?= $label['label_page'];?></td>
                                 <td align="center"><input type="text" class="form-control" style="text-align:center;" name="order[<?= $label['label_id'];?>]" size="1" maxlength="2" value="<?= $label['label_order'];?>"></td>
                                  <td>                                         
                                    <?php if($label['label_active_status'] == 1) {?>
                                    <a class="btn-outline-success btn-sm" title="Click to Inactive" href="<?= BASE_URL_BACKEND."/module/activeLabel/".$label['label_id'];?>"><i class="la la-check-circle"></i></a> 
                                    <?php } else { ?>
                                    <a class="btn-outline-danger btn-sm" title="Click to Active" href="<?= BASE_URL_BACKEND."/module/activeLabel/".$label['label_id'];?>"><i class="la la-power-off"></i></a>
                                    <?php } ?>                                           
                                    <a class="btn-outline-primary btn-sm" title="Click to Edit" href="<?= BASE_URL_BACKEND;?>/module/editLabel/<?= $label['label_id'];?>"><i class="la la-edit"></i></a>                                        
                                    <a class="btn-outline-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?= $label['label_title'];?> ?'); if (answer){window.location = '<?= BASE_URL_BACKEND;?>/module/deleteLabel/<?= $label['label_id'];?>';}"><span class="la la-trash"></span></a>
                                 </td>
                              </tr>
                              <?php } ?>
                              <?php } else {?>
                              <tr>
                                 <td align="center" colspan="10">Data Not Found</td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                      
                         </form>
                      
                     </section>
                     <?php foreach($ListLabel as $label){ if($label['type_id'] == 6 || $label['type_id'] == 7 || $label['type_id']==9) {?>
                     <div class="modal fade" id="m_modal_<?= $label['label_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">
                                    <?= $label['label_title'];?>
                                 </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">
                                 &times;
                                 </span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12" id="frmadd">
                                    <input class="btn btn-primary btn-sm" id="<?= $label['label_id'];?>"  type="button" value="Add" onClick="showFormUpload(this.id)">
                                 </div>
                                 <div class="col-lg-12" id="frmUpload<?= $label['label_id'];?>" style="display: none;">
                                    <?php include 'voptions.php'; ?>
                                 </div>
                                 <div class="form-group m-form__group row">
                                    <?php
                                       if(count($label['options']) > 0){
                                       $no=0;
                                       foreach($label['options'] as $opt){ $no++;
                                       ?>
                                    <div class="col-sm-12 form-group m-form__group row">
                                       <label class="col-sm-2 col-form-label">
                                       <?= $no;?> :
                                       </label>
                                       <div class="col-sm-6">
                                          <input name="options_title" id="options_title<?= $opt['options_id'];?>" type="text" class="form-control m-input" placeholder="" value="<?= $opt['options_title'] ?>">                                                                                                                                                                  
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="m-loader m-loader--brand" id="loadergif<?= $opt['options_id'];?>" style="width: 30px; display:none;"></div>
                                          <a button class="btn-success btn-sm btn<?= $opt['options_id'];?>" id="<?= $opt['options_id'];?>"  onclick="doSave(this.id)"><i class="la la-save"></i></a> &nbsp;
                                          <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?= $opt['options_title'];?> ?'); if (answer){window.location = '<?= BASE_URL_BACKEND.'/module';?>/deleteOptions/<?= $opt['options_id'];?>';}"><span class="la la-trash"></span></a> &nbsp;                                                                                
                                       </div>
                                    </div>
                                    <?php } 
                                       } ?> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } } ?>
                     <?php foreach($ListLabel as $label){?>
                     <div class="modal fade" id="m_modal_c<?= $label['label_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">
                                    Child - <?= $label['label_title'];?>
                                 </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">
                                 &times;
                                 </span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12" id="frmaddChild<?= $label['label_id'];?>">
                                    <input class="btn btn-primary btn-sm" type="button" id="<?= $label['label_id'];?>" value="Add" onClick="showFormChild(this.id)">
                                 </div>
                                  
                                 <div class="col-lg-12" id="frmChild<?= $label['label_id'];?>" style="display: none;">
                                    <?php include 'vchildlabel.php'; ?>
                                 </div>
                                 <div class="form-group m-form__group row">
                                    <table class="" id="html_table" width="100%">
                                       <thead>
                                          <tr>
                                              <th colspan="2">No</th>
                                             <th>Label </th>
                                             <th>Name</th>
                                             <th>Type</th>
                                             <th>Vicible</th>
                                             <th>Order</th>
                                             <th>Notif</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             if(count($label['label_child']) > 0){
                                             $i=0;
                                             foreach($label['label_child'] as $ch){
                                                     $i++;
                                             ?>
                                          <tr>
                                             <td colspan="2">
                                                <?= $i;?>
                                                <div class="m-loader m-loader--brand" id="loadergifChl<?= $ch['label_id'];?>" style="margin-top: -10px; width: 30px; display:none;"></div>
                                             </td>
                                             <td>
                                                 <input size="1" name="label_parent" id="label_parent<?= $ch['label_id'];?>" type="hidden" readonly="" value="<?= $ch['label_parent']; ?>">
                                                 <input size="1" name="label_title" id="label_title<?= $ch['label_id'];?>" type="text" class="form-control m-input" placeholder="" value="<?= $ch['label_title']; ?>">
                                             </td>
                                             <td><input size="1" name="label_name" id="label_name<?= $ch['label_id'];?>" type="text" class="form-control m-input" placeholder="" value="<?= $ch['label_name']; ?>"></td>
                                             <td>
                                             <select class="form-control" name="type_id" id="type_id<?= $ch['label_id'];?>">
                                                <option value="0">Type</option>
                                                    <?php foreach($ListType as $type){ ?>
                                                    <option value="<?= $type['type_id'];?>" <?php if($type['type_id'] ==$ch['type_id']) { echo "selected";} ?>> <?= $type['type_title']?> </option>
                                                    <?php } ?>

                                            </select> 
                                             </td>
                                             <td><select class="form-control" name="label_view" id="label_view<?= $ch['label_id'];?>">
                                                    <option value="1" <?php if($ch['type_id'] == 1) { echo "selected";} ?>>Show</option>
                                                    <option value="0" <?php if($ch == 0) { echo "selected";} ?>>Hide</option>
                                                 </select>
                                             </td>
                                             <td><input type="text" class="form-control" name="label_order" id="label_orders<?= $ch['label_id'];?>" size="1" maxlength="2" value="<?= $ch['label_order'];?>"></td>
                                             <td><input type="text" class="form-control" name="label_notif" id="label_notif<?= $ch['label_id'];?>" value="<?= $ch['label_notif'];?>"></td>
                                             
                                             <td>                                         
                                                <?php if($ch['label_active_status'] == 1) {?>
                                                <a class="btn-success btn-sm" title="Click to Inactive" href="<?= BASE_URL_BACKEND."/module/activeLabel/".$ch['label_id'];?>"><i class="la la-check-circle"></i></a> 
                                                <?php } else { ?>
                                                <a class="btn-danger btn-sm" title="Click to Active" href="<?= BASE_URL_BACKEND."/module/activeLabel/".$ch['label_id'];?>"><i class="la la-power-off"></i></a>
                                                <?php } ?> 
                                                <a button class="btn-success btn-sm btnChl<?= $ch['label_id'];?>" id="<?= $ch['label_id'];?>"  onclick="doSaveChild(this.id)"><i class="la la-edit"></i></a>                                  
                                                <a class="btn-danger btn-sm" title="Click to Delete" onclick="var answer = confirm('delete <?= $ch['label_title'];?> ?'); if (answer){window.location = '<?= BASE_URL_BACKEND;?>/module/deleteLabel/<?= $ch['label_id'];?>';}"><span class="la la-trash"></span></a>
                                             </td>
                                          </tr>
                                          <?php } ?>
                                          <?php } else {?>
                                          <tr>
                                             <td align="center" colspan="10">Data Not Found</td>
                                          </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                     
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php }  ?>
                     <!--end: Datatable -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end:: Body -->
      <?php include VIEWS_PATH_BACKEND."/footer.php"; ?>
   </div>
   <!-- end:: Page -->
   <!--begin::Base Scripts -->
   <script src="<?= BACKEND_BASE_URL; ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
   <script src="<?= BACKEND_BASE_URL; ?>/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
   <!--end::Base Scripts -->   
   <!--begin::Page Vendors -->
   <script src="<?= BACKEND_BASE_URL; ?>/demo/default/custom/components/datatables/base/html-table.js" type="text/javascript"></script>
   <!--end::Page Snippets -->
   <script language="javascript">
      $(document).ready(function(){
      $("#doOrder").click(function() {
         var frm = document.formLabel;
      var answer = confirm('are you sure want to update order?');
      if(answer){
      frm.action = '<?= BASE_URL_BACKEND;?>/module/doOrderLabel';
      frm.submit();
      } else {
      return false;
      }
      });
      
    $("#doOrderChild").click(function() {
         var frm = document.formLabelChild;
      var answer = confirm('are you sure want to update order?');
      if(answer){
      frm.action = '<?= BASE_URL_BACKEND;?>/module/doOrderLabel';
      frm.submit();
      } else {
      return false;
      }
      });
      });
   </script>
   <script language="javascript">
      function showFormUpload(id){
      $("#frmadd"+id).hide(); 
      $("#frmUpload"+id).show();
      } 
      function hideFormUpload(id){
      $("#frmadd"+id).show(); 
      $("#frmUpload"+id).hide();
      }  
      
      function showFormChild(id){
      $("#frmaddChild"+id).hide(); 
      $("#frmChild"+id).show();
      } 
      function hideFormChild(id){
      $("#frmaddChild"+id).show(); 
      $("#frmChild"+id).hide();
      } 
   </script>
   
   
   
   
   <script>
      function doSave(id) {
        var id_options = id;            
        var optionstitle = $("#options_title"+id_options).val();           
        saveSubpage(id_options, optionstitle);        
      }       
      function saveSubpage(id_options, optionstitle)
      {        
         $.ajax({
                 url: '<?= BASE_URL_BACKEND.'/Module';?>/editOptions',
                 type: 'post',
                 data: {primary_key: id_options, title: optionstitle},
      
                 beforeSend: function()
                 {	
                     $('.btn'+id_options).hide();
                     $('#loadergif'+id_options).show();
                 },
                 complete: function()
                 {
                     //alert("succesfull edited data");
                     $('#loadergif'+id_options).hide();
                     $('.btn'+id_options).show();
      
                 }
                 });
      }
   </script>
   
   
   <script>
      function doSaveChild(id) {
        var id_label = id;   
        var tbEdit='tbEdit';
        var parent = $("#label_parent"+id_label).val(); 
        var titles = $("#label_title"+id_label).val(); 
        var names = $("#label_name"+id_label).val(); 
        var type = $("#type_id"+id_label).val(); 
        var views = $("#label_view"+id_label).val(); 
        var orders = $("#label_orders"+id_label).val(); 
        var notif = $("#label_notif"+id_label).val(); 
       
        saveChild(tbEdit,id_label,parent, titles, names ,type ,views ,orders,notif);        
      }       
      function saveChild(tbEdit,id_label, parent, titles, names ,type ,views ,orders,notif)
      {   
          
         $.ajax({
                 url: '<?= BASE_URL_BACKEND.'/module';?>/doEditLabel/'+id_label,
                 type: 'post',
                 data: {tbEdit:tbEdit, label_parent: parent, label_title: titles, label_name: names, type_id:type, label_view:views, label_order:orders, label_notif:notif},
      
                 beforeSend: function()
                 {	
                     $('.btnChl'+id_label).hide();
                     $('#loadergifChl'+id_label).show();
                 },
                 complete: function()
                 {
                     //alert("succesfull edited data");
                     $('#loadergifChl'+id_label).hide();
                     $('.btnChl'+id_label).show();
      
                 }
                 });
      }
      
      
      
   </script>
   
</body>
<!-- end::Body -->
</html>