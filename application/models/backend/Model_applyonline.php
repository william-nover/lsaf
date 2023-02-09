<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_applyonline extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getListApplyOnline($cond = null){
		 $query		= "select a.* , b.country_name FROM tbl_signup as a inner join tbl_country as b"
                                . " on a.country_id = b.country_id  ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getNationality()
	  {
            $hasil=$this->db->query("SELECT  * from tbl_country  order by country_name Asc");
			if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                           $data=''; 
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
                        
		}
	
	function getApplyOnline($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE signup_id = ".$id;
		}
		$sql	= "select a.* , b.country_name FROM tbl_signup as a inner join tbl_country as b
				 on a.country_id = b.country_id $where ORDER BY signup_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	function activeApplyOnline($id)
	{
		$sql	= "UPDATE tbl_signup SET status = abs(status-1) 
				   WHERE signup_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteApplyOnline($id = '')
	{
		$sql	= "DELETE FROM tbl_signup WHERE signup_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	function deleteStudent($id)
	{
		$sql	= "DELETE FROM tbl_student WHERE signup_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	function checkApplyOnline($applyOnlinetitle){
		$sql	= "SELECT full_name FROM tbl_signup WHERE full_name = '".$applyOnlinetitle."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function updateApplyOnline($id,$full_name,$email,$date_of_birth,$address1,$address2,$postal_code,$phone,$country_id,$step)
	{
		$sql	= "UPDATE tbl_signup SET 
				    full_name='".$full_name."', email='".$email."',date_of_birth='".$date_of_birth."',address1='".$address1."',
                                    postal_code='".$postal_code."',phone='".$phone."',country_id='".$country_id."', step='".$step."' WHERE signup_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
}