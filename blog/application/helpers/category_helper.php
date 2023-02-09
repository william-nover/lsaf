<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('category')){
	function category(){
		$CI = get_instance();
		
		$CI->load->model('backend/model_category');
		
		$arrCategory = array();
		$rsListCategoryModuleGroup = $CI->model_category->getCategoryModuleGroup();
		for($i=0; $i<count($rsListCategoryModuleGroup); $i++){
			$rsCategoryModuleGroupAccessUserLevel = $CI->model_category->getCategoryModuleGroupAccessUserLevel($_SESSION['admin_data']['user_level_id'], $rsListCategoryModuleGroup[$i]['module_group_id']);
			if(count($rsCategoryModuleGroupAccessUserLevel) > 0){
				$arrCategory[$i]['module_group_id'] =  $rsListCategoryModuleGroup[$i]['module_group_id'];
				$arrCategory[$i]['module_group_name'] =  $rsListCategoryModuleGroup[$i]['module_group_name'];
				$arrCategory[$i]['module_group_active_status'] =  $rsListCategoryModuleGroup[$i]['module_group_order_value'];
				$arrCategory[$i]['module_group_order_value'] =  $rsListCategoryModuleGroup[$i]['module_group_active_status'];
				
				$rsListCategoryModule = $CI->model_category->getCategoryModule($rsListCategoryModuleGroup[$i]['module_group_id']);
				
				if(count($rsListCategoryModule) > 0) {
					for($j=0; $j<count($rsListCategoryModule); $j++){
						$rsListCategoryModule[$j]['module_id'] =  $rsListCategoryModule[$j]['module_id'];
						$rsListCategoryModule[$j]['module_name'] =  $rsListCategoryModule[$j]['module_name'];
						$rsListCategoryModule[$j]['module_path'] =  $rsListCategoryModule[$j]['module_path'];
						$rsListCategoryModule[$j]['module_active_status'] =  $rsListCategoryModule[$j]['module_active_status'];
						$rsListCategoryModule[$j]['module_order_value'] =  $rsListCategoryModule[$j]['module_order_value'];
						
						$rsCategoryModuleAccessUserLevel = $CI->model_category->getCategoryModuleAccessUserLevel($_SESSION['admin_data']['user_level_id'],$rsListCategoryModuleGroup[$i]['module_group_id'],$rsListCategoryModule[$j]['module_id']);
						if(count($rsCategoryModuleAccessUserLevel) > 0) {
							$rsListCategoryModule[$j]['access_privilege_status'] =  $rsCategoryModuleAccessUserLevel[0]['access_privilege_status'];
						} else {
							$rsListCategoryModule[$j]['access_privilege_status'] =  0;
						}

					}
					
					$arrCategory[$i]['module'] =  $rsListCategoryModule;
				}	
			}	
		}
		
		return $arrCategory;
	}
}
?>
