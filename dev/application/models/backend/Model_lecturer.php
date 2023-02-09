<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_lecturer extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
        function getLecturerActive(){
            $data = array();
            $sql = "Select lecturer_id,lecturer_name from tbl_lecturer where lecturer_active_status=1 order by lecturer_id Asc";         
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
    
	function getListLecturer($cond = null){
            
		  $query		= "SELECT a.lecturer_id, a.lecturer_name, a.lecturer_email, a.lecturer_gender,a.lecturer_address,
					 DATE_FORMAT(  a.lecturer_create_date, '%d-%m-%Y %H:%i:%s' ) as lecturer_create_date,a.lecturer_active_status, a.lecturer_create_by
					  FROM tbl_lecturer as a ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}

	

	
	function getLecturer($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE lecturer_id = ".$id;
		}
		$sql	= "SELECT lecturer_id, lecturer_name,lecturer_gender,lecturer_email,lecturer_address, lecturer_active_status FROM tbl_lecturer $where ORDER BY lecturer_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	
	
	function activeLecturer($id)
	{
		$sql	= "UPDATE tbl_lecturer SET lecturer_active_status = abs(lecturer_active_status-1),  
				   lecturer_update_date = now(), 
				   lecturer_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteLecturer($id)
	{
		$sql	= "DELETE FROM tbl_lecturer WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteLecturerLang($id)
	{
		$sql	= "DELETE FROM tbl_lecturer_lang WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkLecturer($lecturer_name){
		$sql	= "SELECT * FROM tbl_lecturer WHERE lecturer_name = '".$lecturer_name."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	
	
	function insertLecturer($lecturer_name,$lecturer_gender,$lecturer_email,$lecturer_address)
	{
		$sql	= "INSERT INTO tbl_lecturer SET lecturer_name = '".$lecturer_name."',
                                        lecturer_gender = '".$lecturer_gender."',
                                        lecturer_email = '".$lecturer_email."',
                                        lecturer_address = '".$lecturer_address."',
					lecturer_active_status = 0,
					lecturer_create_by = ".$_SESSION['admin_data']['user_id'].", lecturer_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertLecturerLang($lecturer_name,$lecturerid,$languageid)
	{
		$sql	= "INSERT INTO tbl_lecturer_lang SET lecturer_lang_title = '".$lecturer_name."',
					lecturer_id = ".$lecturerid.", language_id = ".$languageid.",
					lecturer_lang_create_by = ".$_SESSION['admin_data']['user_id'].", lecturer_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateLecturer($id,$lecturer_name,$lecturer_gender,$lecturer_email,$lecturer_address)
	{
		$sql	= "UPDATE tbl_lecturer SET  
                            lecturer_name='".$lecturer_name."', 
                            lecturer_gender = '".$lecturer_gender."',
                            lecturer_email = '".$lecturer_email."',
                            lecturer_address = '".$lecturer_address."',
                            lecturer_update_by = ".$_SESSION['admin_data']['user_id'].", lecturer_update_date=now() WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateLecturerDefault($id,$lecturer_name)
	{
		$sql	= "UPDATE tbl_lecturer SET 
				   lecturer_name='".$lecturer_name."',
                                       
				   lecturer_update_by = ".$_SESSION['admin_data']['user_id'].", lecturer_update_date=now() WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateLecturerLang($lecturer_name,$lecturerid,$languageid)
	{
		$sql	= "UPDATE tbl_lecturer_lang SET 
				   lecturer_lang_title='".$lecturer_name."', 
				   lecturer_lang_update_by = ".$_SESSION['admin_data']['user_id'].", lecturer_lang_update_date=now() 
				   WHERE lecturer_id = ".$lecturerid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateLecturerLangID($id, $lecturer_namelang)
	{
		$sql	= "UPDATE tbl_lecturer_lang SET 
				   lecturer_lang_title='".$lecturer_namelang."', 
				   lecturer_lang_update_by = ".$_SESSION['admin_data']['user_id'].", lecturer_lang_update_date=now() 
				   WHERE lecturer_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderLecturer($id,$order)
	{
		$sql	= "UPDATE tbl_lecturer SET 
				   lecturer_order= ".$order.",
				   lecturer_update_by = ".$_SESSION['admin_data']['user_id'].", lecturer_update_date=now() WHERE lecturer_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
       
}