<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	  function getModule($module_name){
            $data = array();
            
            $sql="select module_id , module_group_id from tbl_module where module_name='".$module_name."' ";         
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
	function getListContent($module_id,$cond = null){
		$query		= "SELECT a.content_id, a.content_title, a.content_short_desc,"
                                    . " a.content_image, a.content_desc, a.content_active_status, a.content_alias, "
                                    . "a.content_order,"
                                    . " a.content_meta_description, a.content_meta_keywords, "
                                    . "DATE_FORMAT( a.content_create_date, '%d-%m-%Y %H:%i:%s' ) as content_create_date, a.content_create_by, "
                                    . " b.menu_id, b.menu_title "
                                    . "FROM tbl_content as a "
                                    . " inner join tbl_menu as b on a.menu_id = b.menu_id "
                                    . " where b.Module_id=".$module_id." "
                                    . " ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
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
	
	function getContent($id = '')
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
	
	function activeContent($id)
	{
		$sql	= "UPDATE tbl_content SET content_active_status = abs(content_active_status-1),  
				   content_update_date = now(), 
				   content_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteContent($id = '')
	{
		$sql	= "DELETE FROM tbl_content WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkContent($content_title){
		$sql	= "SELECT content_title FROM tbl_content WHERE content_title = '".$content_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertContent($menu_id,$page_type,$content_title,$content_desc,$content_imageurl,$content_alias,$content_metadescription,$content_metakeywords,$content_shortdesc)
	{

		$sql	= "INSERT INTO tbl_content SET 
                            menu_id='".$menu_id."', 
                            page_type='".$page_type."', 
                            content_title='".$content_title."', 
                            content_short_desc='".$content_shortdesc."', 
                            content_image='".$content_imageurl."', 
                            content_alias ='".$content_alias."', 
                            content_meta_description='".$content_metadescription."', 
                            content_meta_keywords='".$content_metakeywords."', 
                            content_active_status = 0, 
                            content_desc='".$content_desc."',
                            content_create_by = ".$_SESSION['admin_data']['user_id'].", content_create_date = now()";	
		
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateContent($id,$menu_id,$page_type,$content_title,$content_desc,$content_imageurl,$content_alias,$content_metadescription,$content_metakeywords,$content_shortdesc)
	{
		$sql	= "UPDATE tbl_content SET 
                            menu_id='".$menu_id."', 
                            page_type='".$page_type."', 
                            content_title='".$content_title."', 
                            content_short_desc='".$content_shortdesc."', 
                            content_image='".$content_imageurl."',
                            content_alias ='".$content_alias."', 
                            content_desc='".$content_desc."', 
                            content_meta_description='".$content_metadescription."', 
                            content_meta_keywords='".$content_metakeywords."', 
                            content_active_status = 1, 
                            content_update_by = ".$_SESSION['admin_data']['user_id'].", 
                            content_update_date=now() WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
        
         function getPageView(){
         $data = array();
         $sql="select * from tbl_page_view order by page_type asc";         
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
     
     function updateOrderContent($id,$order)
	{
		$sql	= "UPDATE tbl_content SET 
				   content_order= ".$order.",
				   content_update_by = ".$_SESSION['admin_data']['user_id'].", content_update_date=now() WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
     
        
}