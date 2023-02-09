<script src="<?php echo JS_BASE_URL; ?>/jquery/jquery-ui.custom.js" type="text/javascript"></script>
<script src="<?php echo JS_BASE_URL; ?>/jquery/jquery.cookie.js" type="text/javascript"></script>

<link href="<?php echo TOOLS_BASE_URL; ?>/jqtree/skin-vista/ui.dynatree.css" rel="stylesheet" type="text/css">
<script src="<?php echo TOOLS_BASE_URL; ?>/jqtree/jquery.dynatree.js" type="text/javascript"></script>
                <div id="tree">
                 <a href="#" id="btnToggleExpand">Menu expand</a>                     
                <ul> 
                 <?php if (!empty($MenuContent)){?>
                 <?php foreach($MenuContent as $mc):?>
                  <li id="<?php echo $mc->menu_id ?>" class="folder"><?php echo $mc->menu_title ?>
                        <ul>
                        <?php if($mc->child_first != ""){ foreach ($mc->child_first as $cf) { ?>
                            <li id="<?php echo $cf->menu_id ?>"><?php echo $cf->menu_title ?>                                            
                                <ul>
                                    <?php if($cf->child_second != ""){foreach ($cf->child_second as $cs) { ?>						
                                        <li id="<?php echo $cs->menu_id ?>"><?php echo $cs->menu_title ?></li>
                                    <?php  } } ?>
                                </ul>
                             </li>
                        <?php  }} ?> 
                        </ul>
                     </li>
                    <?php endforeach;?>
                    <?php };?>
                </ul>
                </div>


 <script type="text/javascript">
	$(function(){
		// Initialize the tree inside the <div>element.
		// The tree structure is read from the contained <ul> tag.
		$("#tree").dynatree({
			
			onActivate: function(node) {
                            
				$("#echoActive").val(node.data.key);
				//alert(node.getKeyPath());
				if( node.data.url )
					window.open(node.data.url, node.data.target);
			}
		});



		$("#btnToggleExpand").click(function(){
			$("#tree").dynatree("getRoot").visit(function(node){
				node.toggleExpand();
			});
			return false;
		});
		$("#btnCollapseAll").click(function(){
			$("#tree").dynatree("getRoot").visit(function(node){
				node.expand(false);
			});
			return false;
		});
		$("#btnExpandAll").click(function(){
			$("#tree").dynatree("getRoot").visit(function(node){
				node.expand(true);
			});
			return false;
		});
		
	});
</script>