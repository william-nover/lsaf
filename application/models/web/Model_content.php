<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	

	  function getContent ($where_content ,$module_id){
            $data = array();
            
            $sql= "SELECT a.content_id, a.page_type, a.content_title, a.content_short_desc,"
                                    . " a.content_image, a.content_desc, a.content_active_status, a.content_alias,"
                                    . " a.content_meta_description, a.content_meta_keywords, "
                                    . "DATE_FORMAT( a.content_create_date, '%d-%m-%Y %H:%i:%s' ) as content_create_date, a.content_create_by, "
                                    . " b.menu_id, b.menu_title "
                                    . "FROM tbl_content as a "
                                    . " inner join tbl_menu as b on a.menu_id = b.menu_id "
                                    . " $where_content and b.Module_id=".$module_id." "
                                    . " and a.content_active_status=1 order by content_order Asc";         
            $query = $this->db->query($sql);
			
                            //$data = $query->result();                                      
                        foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
					'content_id'	=>$row->content_id,
                                        'page_type'	=>$row->page_type,
                                        'content_title'	=>$row->content_title,
                                        'content_short_desc'	=>$row->content_short_desc,
                                        'content_image' =>$row->content_image,                                        
                                        'content_desc'	=>$row->content_desc,
                                        'content_image' =>$row->content_image,                                        
                                        'menu_id'	=>$row->menu_id,
					// recursive
					'accordion'	=>$this->getAccordion($row->content_id)
				);
		}
                      
                    
                        
			$query->free_result();
                        $this->db->close();
			return $data;     
    } 
     function getAccordion($content_id)
	{
		 $data = array();
			 $sql = "SELECT a.accordion_id,a.accordion_title,a.accordion_desc from tbl_accordion as a  where a.accordion_active_status=1 and  a.content_id= '".$content_id."' and a.accordion_title <> '' order by accordion_order asc";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
                
                foreach($query->result() as $row)
		{
                                                     
			$data[] = (object) array(
                            'content_id'=>$row->content_id,
                            'accordion_id'=>$row->accordion_id,
                            'accordion_title' => $row->accordion_title,
                            'accordion_desc' => $row->accordion_desc
				);
		}
            
                        
			$query->free_result();
                        $this->db->close();
			return $data; 
                            
                            
                        }

        }
    
  
	function getListContentAlias(){
		$query		= "SELECT content_id, content_title, content_short_desc, content_image, content_desc, content_meta_description, content_meta_keywords,
						DATE_FORMAT( content_create_date, '%d %M %Y' ) as content_create_date,
						c.web_alias, c.web_ori
						FROM tbl_content a
						INNER JOIN tbl_alias c ON a.content_id = c.key_id 
						WHERE a.content_active_status = 1 AND c.alias_category = 'content' AND c.alias_active_status = 1
						ORDER BY content_id DESC";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getContentDetail($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE content_id = ".$id;
		}
		$sql	= "SELECT a.content_id, a.menu_id, a.page_type, a.content_title, a.content_short_desc,"
                                    . " a.content_image, a.content_desc, a.content_active_status, a.content_alias,"
                                    . " a.content_meta_description, a.content_meta_keywords, "
                                    . "DATE_FORMAT( a.content_create_date, '%d-%m-%Y %H:%i:%s' ) as content_create_date, a.content_create_by, "
                                    . " b.menu_id, b.menu_title "
                                    . "FROM tbl_content as a "
                                    . " inner join tbl_menu as b on a.menu_id = b.menu_id "
                                    . " $where "
                                    . " ORDER BY content_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
         function getMenuModule($id_satu){
            $data = array();
            $sql="select a.module_id, a.module_path, b.menu_id from tbl_module as a inner join tbl_menu as b"
                    . " on a.module_id = b. Module_id where b. menu_id =".$id_satu." ";         
            $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
         
     } 
          function getModuleId($module_path){
            $data = array();
             $sql="select module_id, module_path from tbl_module where module_path Like '%".$module_path."%' ";         
            $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
         
     } 
        
}