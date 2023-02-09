<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_signin extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function cekAdminLogin($email, $password)
	{
		$sql	= "SELECT user_id, user_name, user_level_id FROM tbl_user 
				   WHERE user_name = ".$this->db->escape($email)." AND user_pass = ".$this->db->escape($password)." AND user_active_status = 1";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
}