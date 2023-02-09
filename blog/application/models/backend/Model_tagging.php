<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tagging extends CI_Model {

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
	function getListTagging($cond = null){
		$query		= "SELECT tagging_id, tagging_title, 
					  DATE_FORMAT( tagging_create_date, '%d-%m-%Y %H:%i:%s' ) as tagging_create_date
					  FROM tbl_tagging ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	function getTagging($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE tagging_id = ".$id;
		}
		$sql	= "SELECT tagging_id, tagging_title, 
					  DATE_FORMAT( tagging_create_date, '%d-%m-%Y %H:%i:%s' ) as tagging_create_date "
                                    . "FROM tbl_tagging as a "
                                    . " $where "
                                    . " ORDER BY tagging_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	function checkTagging($tagging_title){
		$sql	= "SELECT tagging_title FROM tbl_tagging WHERE tagging_title = '".$tagging_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;
	}
	
	
	function insertTagging($tagging_title)
	{
		$sql	= "INSERT INTO tbl_tagging SET tagging_title='".$tagging_title."',
					tagging_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;

	}
        
        
        function activeTagging($id)
	{
		$sql	= "UPDATE tbl_tagging SET tagging_active_status = abs(tagging_active_status-1),  
				   tagging_update_date = now(), 
				   tagging_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE tagging_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteTagging($id = '')
	{
		$sql	= "DELETE FROM tbl_tagging WHERE tagging_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
        
        function updateTagging($id,$tagging_title)
	{
		$sql	= "UPDATE tbl_tagging SET 
                            tagging_title='".$tagging_title."' WHERE tagging_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
}