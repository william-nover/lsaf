<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_page extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function getPage($title = '')
	{
		$where = '';
		if($title != ''){
			$where = "WHERE pages_title LIKE '%". $title ."%' ";
		}
		 $sql	= "SELECT pages_id, pages_title, pages_short_desc, pages_image, pages_desc, pages_alias, pages_meta_description, pages_meta_keywords, pages_active_status
				  FROM tbl_pages $where ORDER BY pages_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
         
        
}