<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_content extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getListContent($cond = null){
		$query		= "SELECT content_id, content_title, content_short_desc, content_image, content_desc, content_active_status, content_alias, content_meta_description, content_meta_keywords,
					  DATE_FORMAT( content_create_date, '%d-%m-%Y %H:%i:%s' ) as content_create_date, content_create_by
					  FROM tbl_content ".$cond;
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
		$sql	= "SELECT content_id, content_title, content_short_desc, content_image, content_desc, content_alias, content_meta_description, content_meta_keywords, content_active_status
				  FROM tbl_content $where ORDER BY content_id ASC";	
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
	
	function checkContent($contenttitle){
		$sql	= "SELECT content_title FROM tbl_content WHERE content_title = '".$contenttitle."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertContent($contenttitle,$contentdesc,$contentimageurl,$contentalias,$contentmetadescription,$contentmetakeywords,$contentshortdesc)
	{

		$sql	= "INSERT INTO tbl_content SET 
					content_title='".$contenttitle."', 
					content_short_desc='".$contentshortdesc."', 
					content_image='".$contentimageurl."', 
					content_alias ='".$contentalias."', 
					content_meta_description='".$contentmetadescription."', 
					content_meta_keywords='".$contentmetakeywords."', 
					content_active_status = 0, 
					content_desc='".$contentdesc."',
					content_create_by = ".$_SESSION['admin_data']['user_id'].", content_create_date = now()";	
		
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateContent($id,$contenttitle,$contentdesc,$contentimageurl,$contentalias,$contentmetadescription,$contentmetakeywords,$contentshortdesc)
	{
		$sql	= "UPDATE tbl_content SET 
				   content_title='".$contenttitle."', 
				   content_short_desc='".$contentshortdesc."', 
				   content_image='".$contentimageurl."',
				   content_alias ='".$contentalias."', 
				   content_desc='".$contentdesc."', 
				   content_meta_description='".$contentmetadescription."', 
				   content_meta_keywords='".$contentmetakeywords."', 
				   content_active_status = 1, 
				   content_update_by = ".$_SESSION['admin_data']['user_id'].", 
				   content_update_date=now() WHERE content_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
}