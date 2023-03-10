<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menu_frontend extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getListMenu($cond = null){
            
		 $query		= "SELECT menu_id, menu_title, menu_active_status, menu_parent,menu_sub_parent, menu_url, menu_order,
					  DATE_FORMAT( menu_create_date, '%d-%m-%Y %H:%i:%s' ) as menu_create_date, menu_create_by
					  FROM tbl_menu ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getListSubMenu($parent){
		$query		= "SELECT menu_id, menu_title, menu_active_status, menu_parent,menu_sub_parent, menu_url, menu_order,
					  DATE_FORMAT( menu_create_date, '%d-%m-%Y %H:%i:%s' ) as menu_create_date, menu_create_by
					  FROM tbl_menu WHERE menu_parent = ".$parent." ORDER BY menu_order ASC, menu_id ASC ";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getMenuChildren($parent){
		 $query		= "SELECT a.menu_id, a.menu_title, a.menu_url, Deriv1.Count FROM 
					  tbl_menu a LEFT OUTER JOIN (SELECT menu_parent, COUNT(*) AS Count FROM tbl_menu WHERE menu_active_status = 1 GROUP BY menu_parent) 
					  Deriv1 ON a.menu_id = Deriv1.menu_parent WHERE a.menu_parent=0 AND a.menu_active_status = 1 ORDER BY a.menu_order ASC ";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getListMenuLanguage($cond = null){
		$query		= "SELECT a.language_id, a.language_title, a.language_default, a.language_active_status, 
					    b.menu_id, b.menu_lang_id
						FROM tbl_language a
						LEFT JOIN tbl_menu_lang b ON a.language_id = b.language_id
						".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getMenu($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE menu_id = ".$id;
		}
		$sql	= "SELECT menu_id, menu_title, menu_active_status, menu_parent, menu_url, menu_order FROM tbl_menu $where ORDER BY menu_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function getMenuLangByMenuID($id = '', $langid = '')
	{
		$where = ' WHERE 1=1 ';
		if($id != ''){
			$where .= " AND menu_id = ".$id;
		}
		
		if($langid != ''){
			$where .= " AND language_id = ".$langid;
		}
		
		$sql	= "SELECT menu_lang_id, menu_id, language_id, menu_lang_title FROM tbl_menu_lang $where ORDER BY menu_lang_id ASC";	
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function getMenuLang($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE menu_lang_id = ".$id;
		}
		$sql	= "SELECT menu_lang_id, menu_id, language_id, menu_lang_title FROM tbl_menu_lang $where ORDER BY menu_lang_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function activeMenu($id)
	{
		$sql	= "UPDATE tbl_menu SET menu_active_status = abs(menu_active_status-1),  
				   menu_update_date = now(), 
				   menu_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteMenu($id)
	{
		$sql	= "DELETE FROM tbl_menu WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteMenuLang($id)
	{
		$sql	= "DELETE FROM tbl_menu_lang WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkMenu($menutitle){
		$sql	= "SELECT * FROM tbl_menu WHERE menu_title = '".$menutitle."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkMenuLang($menutitlelang){
		$sql	= "SELECT * FROM tbl_menu_lang WHERE menu_lang_title = '".$menutitlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertMenu($module_id,$menutitle,$menuurl,$menuparent,$menusubparent)
	{
		$sql	= "INSERT INTO tbl_menu SET module_id = '".$module_id."', menu_title = '".$menutitle."',
					menu_active_status = 0, menu_url = '".$menuurl."', menu_parent = ".$menuparent." ,menu_sub_parent = ".$menusubparent.",
					menu_order = 1,
					menu_create_by = ".$_SESSION['admin_data']['user_id'].", menu_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertMenuLang($menutitle,$menuid,$languageid)
	{
		$sql	= "INSERT INTO tbl_menu_lang SET menu_lang_title = '".$menutitle."',
					menu_id = ".$menuid.", language_id = ".$languageid.",
					menu_lang_create_by = ".$_SESSION['admin_data']['user_id'].", menu_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateMenu($id,$module_id,$menutitle,$menuurl,$menuparent,$menusubparent)
	{
		$sql	= "UPDATE tbl_menu SET 
				   module_id='".$module_id."', menu_title='".$menutitle."', menu_url='".$menuurl."', menu_parent = ".$menuparent.", menu_sub_parent = ".$menusubparent.", 
				   menu_update_by = ".$_SESSION['admin_data']['user_id'].", menu_update_date=now() WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateMenuDefault($id,$menutitle)
	{
		$sql	= "UPDATE tbl_menu SET 
				   menu_title='".$menutitle."', 
				   menu_update_by = ".$_SESSION['admin_data']['user_id'].", menu_update_date=now() WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateMenuLang($menutitle,$menuid,$languageid)
	{
		$sql	= "UPDATE tbl_menu_lang SET 
				   menu_lang_title='".$menutitle."', 
				   menu_lang_update_by = ".$_SESSION['admin_data']['user_id'].", menu_lang_update_date=now() 
				   WHERE menu_id = ".$menuid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateMenuLangID($id, $menutitlelang)
	{
		$sql	= "UPDATE tbl_menu_lang SET 
				   menu_lang_title='".$menutitlelang."', 
				   menu_lang_update_by = ".$_SESSION['admin_data']['user_id'].", menu_lang_update_date=now() 
				   WHERE menu_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderMenu($id,$order)
	{
		$sql	= "UPDATE tbl_menu SET 
				   menu_order= ".$order.",
				   menu_update_by = ".$_SESSION['admin_data']['user_id'].", menu_update_date=now() WHERE menu_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
        
       function getParent($menu_id)
	{
		 $data = array();
			 $sql = "Select * from tbl_menu  where   menu_sub_parent= 0 and menu_parent= '".$menu_id."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
                        
                            
                            foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'menu_id'	=>$row->menu_id,
                                        'menu_parent'	=>$row->menu_parent,
                                        'menu_sub_parent' =>$row->menu_sub_parent, 
                                        'menu_title'	=>$row->menu_title				// recursive 2
					
				);
		}
            
                        
			$query->free_result();
                        $this->db->close();
			return $data; 
                            
                            
                        }

        }
        function GenerateMenu()
            {
		 $data = array();
			 $sql = "SELECT menu_id, menu_title, menu_active_status, menu_parent,menu_sub_parent, menu_url, menu_order,
					  DATE_FORMAT( menu_create_date, '%d-%m-%Y %H:%i:%s' ) as menu_create_date, menu_create_by
					  FROM tbl_menu as a where a.menu_parent = 0 and a.menu_active_status=1 ";
			$query = $this->db->query($sql);
			
                            //$data = $query->result();                                      
                        foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'menu_id'	=>$row->menu_id,
                                        'menu_title'	=>$row->menu_title,
                                        'menu_parent'	=>$row->menu_parent,
                                        'menu_sub_parent' =>$row->menu_sub_parent,                                        
                                        'menu_url'	=>$row->menu_url,                                                                   
					// recursive
					'child_first'	=>$this->get_sub_menu_firstLeft($row->menu_id)
				);
		}
                      
                    
                        
			$query->free_result();
                        $this->db->close();
			return $data;
	}        
        
        function get_sub_menu_firstLeft($menu_id)
	{
		 $data = array();
			 $sql = "SELECT a.menu_id,a.menu_parent,a.menu_sub_parent,a.menu_title,a.menu_url from tbl_menu as a  where   a.menu_sub_parent= 0 and menu_parent= '".$menu_id."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
                
                foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'menu_id'	=>$row->menu_id,
                                        'menu_title'	=>$row->menu_title,
                                        'menu_parent'	=>$row->menu_parent,
                                        'menu_sub_parent' =>$row->menu_sub_parent,                                        
                                        'menu_url'	=>$row->menu_url,
					// recursive 2
					'child_second' =>$this->get_sub_menu_secondLeft($row->menu_id,$row->menu_parent)
				);
		}
            
                        
			$query->free_result();
                        $this->db->close();
			return $data; 
                            
                            
                        }

        }
           function get_sub_menu_secondLeft($menu_id,$menu_parent)
	{
		 $data = array();
			 $sql = "SELECT a.menu_id,a.menu_parent,a.menu_sub_parent,a.menu_title,a.menu_url from tbl_menu as a  where  a.menu_sub_parent ='".$menu_id."' and a.menu_parent= '".$menu_parent."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
                        
                            
                            foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'menu_id'	=>$row->menu_id,
                                        'menu_title'	=>$row->menu_title,
                                        'menu_parent'	=>$row->menu_parent,
                                        'menu_sub_parent' =>$row->menu_sub_parent,                                         
                                        'menu_url'	=>$row->menu_url,
         
					
				);
		}
            
                        
			$query->free_result();
                        $this->db->close();
			return $data; 
                            
                            
                        }

        } 
        
}