<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_entrygroup extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function getListGroup($cond = null){
		$query		= "SELECT entry_group_id, entry_group_title, entry_group_active_status, entry_group_timer,
					  DATE_FORMAT( entry_group_create_date, '%d-%m-%Y %H:%i:%s' ) as entry_group_create_date
					  FROM tbl_entry_group ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($entry_grouptitle){
		$sql	= "SELECT * FROM tbl_entry_group WHERE entry_group_title = '".$entry_grouptitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($entry_grouptitle,$entry_grouptimer){

		$sql	= "INSERT INTO tbl_entry_group SET 
					entry_group_title = '".$entry_grouptitle."',
					entry_group_timer = ".$entry_grouptimer.",
					entry_group_active_status = 1, 
					entry_group_create_by = ".$_SESSION['admin_data']['user_id'].", 
					entry_group_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE entry_group_id = ".$id;
		}

		$sql	= "SELECT entry_group_id, entry_group_title, entry_group_active_status, entry_group_timer
				   FROM tbl_entry_group $where ORDER BY entry_group_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$entry_grouptitle,$entry_grouptimer){
		$sql	= "UPDATE tbl_entry_group SET 
				   entry_group_title = '".$entry_grouptitle."',
				   entry_group_timer = ".$entry_grouptimer.",
				   entry_group_update_by = ".$_SESSION['admin_data']['user_id'].",
				   entry_group_update_date=now()
				   WHERE entry_group_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_entry_group SET entry_group_active_status = abs(entry_group_active_status-1)
				   WHERE entry_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_entry_group WHERE entry_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
}