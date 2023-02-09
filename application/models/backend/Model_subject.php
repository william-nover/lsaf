<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_subject extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
       function getmoduleLevel(){
            $data = array();
            $sql = "Select module_level_id , module_level_title from tbl_module_level order by module_level_id Asc";         
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
     
	function getListSubject($cond = null){
            
		 $query		= "SELECT a.subject_id, a.module_level_id, a.subject_title, a.subject_order,
					 DATE_FORMAT(  a.subject_create_date, '%d-%m-%Y %H:%i:%s' ) as subject_create_date,a.subject_active_status, a.subject_create_by, b.module_level_title,
                                         c.lecturer_name
					 FROM tbl_subject as a inner join tbl_module_level as b on a.module_level_id = b.module_level_id 
                                         inner join tbl_lecturer as c on a.lecturer_id=c.lecturer_id ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}

	

	
	function getSubject($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE subject_id = ".$id;
		}
		$sql	= "SELECT subject_id, module_level_id,lecturer_id, subject_title,subject_active_status, subject_order FROM tbl_subject $where ORDER BY subject_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	
	
	function activeSubject($id)
	{
		$sql	= "UPDATE tbl_subject SET subject_active_status = abs(subject_active_status-1),  
				   subject_update_date = now(), 
				   subject_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteSubject($id)
	{
		$sql	= "DELETE FROM tbl_subject WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteSubjectLang($id)
	{
		$sql	= "DELETE FROM tbl_subject_lang WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkSubject($subject_title){
		$sql	= "SELECT * FROM tbl_subject WHERE subject_title = '".$subject_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkSubjectLang($subject_titlelang){
		$sql	= "SELECT * FROM tbl_subject_lang WHERE subject_lang_title = '".$subject_titlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertSubject($module_level_id,$lecturer_id,$subject_title)
	{
		$sql	= "INSERT INTO tbl_subject SET module_level_id = '".$module_level_id."',lecturer_id = '".$lecturer_id."', subject_title = '".$subject_title."',
					subject_active_status = 0,
					subject_order = 1,
					subject_create_by = ".$_SESSION['admin_data']['user_id'].", subject_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertSubjectLang($subject_title,$subjectid,$languageid)
	{
		$sql	= "INSERT INTO tbl_subject_lang SET subject_lang_title = '".$subject_title."',
					subject_id = ".$subjectid.", language_id = ".$languageid.",
					subject_lang_create_by = ".$_SESSION['admin_data']['user_id'].", subject_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateSubject($id,$module_level_id,$lecturer_id,$subject_title)
	{
		$sql	= "UPDATE tbl_subject SET 
				   module_level_id='".$module_level_id."',lecturer_id = '".$lecturer_id."', subject_title='".$subject_title."', 
				   subject_update_by = ".$_SESSION['admin_data']['user_id'].", subject_update_date=now() WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSubjectDefault($id,$subject_title)
	{
		$sql	= "UPDATE tbl_subject SET 
				   subject_title='".$subject_title."', 
				   subject_update_by = ".$_SESSION['admin_data']['user_id'].", subject_update_date=now() WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSubjectLang($subject_title,$subjectid,$languageid)
	{
		$sql	= "UPDATE tbl_subject_lang SET 
				   subject_lang_title='".$subject_title."', 
				   subject_lang_update_by = ".$_SESSION['admin_data']['user_id'].", subject_lang_update_date=now() 
				   WHERE subject_id = ".$subjectid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateSubjectLangID($id, $subject_titlelang)
	{
		$sql	= "UPDATE tbl_subject_lang SET 
				   subject_lang_title='".$subject_titlelang."', 
				   subject_lang_update_by = ".$_SESSION['admin_data']['user_id'].", subject_lang_update_date=now() 
				   WHERE subject_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderSubject($id,$order)
	{
		$sql	= "UPDATE tbl_subject SET 
				   subject_order= ".$order.",
				   subject_update_by = ".$_SESSION['admin_data']['user_id'].", subject_update_date=now() WHERE subject_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
       
}