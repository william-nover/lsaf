<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_skype_lectures extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
   
        function getSubject(){
            $data = array();
            $sql = "Select subject_id , subject_title from tbl_subject order by subject_id Asc";         
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
    
	function getListSkype_Lectures($cond = null){
		 $query		= "SELECT a.skype_lectures_id, a.skype_lectures_title, a.subject_id, a.skype_lectures_link,
                                    a.skype_lectures_order, a.skype_lectures_date,a.skype_lectures_time,
					 DATE_FORMAT(  a.skype_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as skype_lectures_create_date,a.skype_lectures_active_status, a.skype_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_skype_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}

	

	
	function getSkype_Lectures($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE skype_lectures_id = ".$id;
		}
		$sql	= "SELECT skype_lectures_id,skype_lectures_title,subject_id,skype_lectures_link,skype_lectures_date,skype_lectures_time,skype_lectures_active_status, skype_lectures_order FROM tbl_skype_lectures $where ORDER BY skype_lectures_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	
	
	function activeSkype_Lectures($id)
	{
		$sql	= "UPDATE tbl_skype_lectures SET skype_lectures_active_status = abs(skype_lectures_active_status-1),  
				   skype_lectures_update_date = now(), 
				   skype_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteSkype_Lectures($id)
	{
		$sql	= "DELETE FROM tbl_skype_lectures WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteSkype_LecturesLang($id)
	{
		$sql	= "DELETE FROM tbl_skype_lectures_lang WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkSkype_Lectures($skype_lectures_title){
		$sql	= "SELECT * FROM tbl_skype_lectures WHERE skype_lectures_title = '".$skype_lectures_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkSkype_LecturesLang($skype_lectures_titlelang){
		$sql	= "SELECT * FROM tbl_skype_lectures_lang WHERE skype_lectures_lang_title = '".$skype_lectures_titlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertSkype_Lectures($skype_lectures_title,$subject_id,$skype_lectures_link,$skype_lectures_date,$skype_lectures_time)
	{
		$sql	= "INSERT INTO tbl_skype_lectures SET 
					skype_lectures_title = '".$skype_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        skype_lectures_link = '".$skype_lectures_link."',
                                        skype_lectures_date = '".$skype_lectures_date."',
                                        skype_lectures_time ='".$skype_lectures_time."',
                                        skype_lectures_active_status = 0,
					skype_lectures_order = 1,
					skype_lectures_create_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertSkype_LecturesLang($skype_lectures_title,$skype_Lecturesid,$languageid)
	{
		$sql	= "INSERT INTO tbl_skype_lectures_lang SET skype_lectures_lang_title = '".$skype_lectures_title."',
					skype_lectures_id = ".$skype_Lecturesid.", language_id = ".$languageid.",
					skype_lectures_lang_create_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateSkype_Lectures($id,$skype_lectures_title,$subject_id,$skype_lectures_link,$skype_lectures_date,$skype_lectures_time)
	{
		$sql	= "UPDATE tbl_skype_lectures SET
                                        skype_lectures_title = '".$skype_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        skype_lectures_link = '".$skype_lectures_link."',
                                        skype_lectures_date = '".$skype_lectures_date."', 
                                        skype_lectures_time ='".$skype_lectures_time."',
                                        skype_lectures_update_date=now(),
                                        skype_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
                                        WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSkype_LecturesDefault($id,$skype_lectures_title)
	{
		$sql	= "UPDATE tbl_skype_lectures SET 
				   skype_lectures_title='".$skype_lectures_title."', 
				   skype_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_update_date=now() WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSkype_LecturesLang($skype_lectures_title,$skype_Lecturesid,$languageid)
	{
		$sql	= "UPDATE tbl_skype_lectures_lang SET 
				   skype_lectures_lang_title='".$skype_lectures_title."', 
				   skype_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_lang_update_date=now() 
				   WHERE skype_lectures_id = ".$skype_Lecturesid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSkype_LecturesLangID($id, $skype_lectures_titlelang)
	{
		$sql	= "UPDATE tbl_skype_lectures_lang SET 
				   skype_lectures_lang_title='".$skype_lectures_titlelang."', 
				   skype_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_lang_update_date=now() 
				   WHERE skype_lectures_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderSkype_Lectures($id,$order)
	{
		$sql	= "UPDATE tbl_skype_lectures SET 
				   skype_lectures_order= ".$order.",
				   skype_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", skype_lectures_update_date=now() WHERE skype_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
       
}