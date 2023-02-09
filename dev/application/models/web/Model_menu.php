<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menu  extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
   
       function getMenuContent($where, $module_id)
            {
		 $data = array();
			 $sql = "SELECT a.menu_id, a.menu_title, a.menu_parent, a.menu_sub_parent, a.menu_url, b.module_id, b.module_name "
                                 . "FROM tbl_menu as a "
                                 . "INNER JOIN tbl_module as b on a.module_id = b.module_id "
                                 . " $where and b.module_id = ".$module_id." ";
			$query = $this->db->query($sql);
			
                            //$data = $query->result();                                      
                        foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'menu_id'	=>$row->menu_id,
                                        'menu_title'	=>$row->menu_title,   
                                        'menu_url'      =>$row->menu_url 
					// recursive
					//'child_first'	=>$this->getChild($row->menu_id)
				);
		}                        
			$query->free_result();
                        $this->db->close();
			return $data;
	}        
        
        function getChild($menu_id)
	{
            $data = array();
			 $sql = "SELECT a.menu_id,a.menu_parent,a.menu_sub_parent,a.menu_title,a.menu_url from tbl_menu as a  where   a.menu_sub_parent= 0 and menu_parent= '".$menu_id."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
                
                foreach($query->result() as $row)
		{                                                   
                    $data[] = (object) array(
                            'menu_id'	=>$row->menu_id,
                            'menu_title' =>$row->menu_title,
                            'menu_url'      =>$row->menu_url,
                            // recursive 2
                            'child_second' =>$this->getSecond($row->menu_id,$row->menu_parent)
                            );
		}                       
			$query->free_result();
                        $this->db->close();
			return $data;                            
                    }

        }
           function getSecond($menu_id,$menu_parent)
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
                                        'menu_url'      =>$row->menu_url
				);
		}                     
			$query->free_result();
                        $this->db->close();
			return $data; 
                            
                            
                        }

        }  
        
        function updateUrlMenu($menu_id,$url_menu){
                $sql	= "UPDATE tbl_menu SET menu_url = '".$url_menu."' WHERE menu_id =".$menu_id." ";	
		$query	= $this->db->query($sql);
		
		return $query;
        }
        
}