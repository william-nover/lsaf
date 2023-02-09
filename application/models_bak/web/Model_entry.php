<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_entry extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	function getEntryTest($id){
		
		$query		= "SELECT entry_test_id, signup_id, entry_test_status, email_status
					  FROM tbl_entry_test WHERE signup_id = ".$id;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function createEntryTest($id)
	{
		$sql	= "INSERT INTO tbl_entry_test SET 
					signup_id = ".$id.",
					entry_test_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
}