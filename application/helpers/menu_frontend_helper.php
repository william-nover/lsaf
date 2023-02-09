<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('menu_frontend')){
	function menu_frontend(){
		$CI = get_instance();
		
		$CI->load->model('web/model_menu_frontend');
		
		$level = 1;
		$ListMenu = array();
		$ListMenu = display_children(0, $level);
		for($i=0; $i<count($ListMenu); $i++){
			if ($ListMenu[$i]['Count'] > 0) {
				$ListMenuChildren = display_children($ListMenu[$i]['menu_id'], $level + 1);
				if (count($ListMenuChildren) > 0) {
					for($j=0; $j<count($ListMenuChildren); $j++){
						$ListMenu[$i]['SubMenu1'][$j] = $ListMenuChildren[$j];
					}
				}	
			}
		}
		
		return $ListMenu;
	}
}

if( ! function_exists('display_children')){
	function display_children($parent, $level) {
		$CI = get_instance();
		
		$CI->load->model('web/model_menu_frontend');
		
		$row = $CI->model_menu_frontend->getMenuChildren($parent);
		
		return $row;
	}
}	
?>
