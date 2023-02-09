<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_language extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getAllGrid($start,$limit,$sidx,$sord,$where){
		$query		= "SELECT language_id, language_title, language_default, language_active_status
					  FROM tbl_language
					  WHERE 1 = 1 ".$where." ORDER BY ".$sidx." ".$sord. " LIMIT ".$start." , ".$limit;
		$query		= $this->db->query($query)->result();
		
		return $query;
	}
	
	function getCountAllGrid($where){
		$query		= "SELECT language_id, language_title, language_default, language_active_status, language_image
					  FROM tbl_language 
					  WHERE 1 = 1 ".$where;
		$count		= $this->db->query($query)->num_rows();
		
		return $count;
	}
	
	function getListLanguage($cond = null){
		$query		= "SELECT language_id, language_title, language_default, language_active_status, language_image
					  FROM tbl_language ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getLanguage($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE language_id = ".$id;
		}
		$sql	= "SELECT language_id, language_title, language_default, language_active_status, language_image FROM tbl_language $where ORDER BY language_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function activeLanguage($id)
	{
		$sql	= "UPDATE tbl_language SET language_active_status = abs(language_active_status-1)
				   WHERE language_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function checkLanguage($languagetitle){
		$sql	= "SELECT * FROM tbl_language WHERE language_title = '".$languagetitle."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function deleteLanguage($id = '')
	{
		$sql	= "DELETE FROM tbl_language WHERE language_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteSelectedLanguage($id = '')
	{
		
		$pisah_kata  = explode("-",$id);
		$jml_katakan = (integer)count($pisah_kata);
		
		for($i=0;$i<$jml_katakan;$i++) {
			$pisah_kata[$i] = trim($pisah_kata[$i]);
			
			$sql	= "DELETE FROM tbl_language WHERE language_id = $pisah_kata[$i]";	
			$query	= $this->db->query($sql);
		}
		
		return $query;
	}
	
	function defaultLanguage($id)
	{
		$sql	= "UPDATE tbl_language SET language_default = 1
				   WHERE language_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function defaultChangeLanguage($id)
	{
		$sql	= "UPDATE tbl_language SET language_default = 0
				   WHERE language_id <> ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function insertLanguage($languagetitle,$languageimageurl)
	{
		$sql	= "INSERT INTO tbl_language SET language_title='".$languagetitle."',
					language_image = '".$languageimageurl."',
					language_active_status = 0, language_default='0'";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateLanguage($id,$languagetitle,$languageimageurl)
	{
		$sql	= "UPDATE tbl_language SET 
				   language_title='".$languagetitle."',
				   language_image = '".$languageimageurl."'
				   WHERE language_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
}