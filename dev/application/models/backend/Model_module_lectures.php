<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_module_lectures extends CI_Model {

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
    
	function getListModule_Lectures($cond = null){
		 $query		= "SELECT a.module_lectures_id, a.module_lectures_title, a.subject_id, a.module_lectures_link,
                                    a.module_lectures_order, a.module_lectures_date,
					 DATE_FORMAT(  a.module_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as module_lectures_create_date,a.module_lectures_active_status, a.module_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_module_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}

	

	
	function getModule_Lectures($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE module_lectures_id = ".$id;
		}
		 $sql	= "SELECT module_lectures_id,module_lectures_title,subject_id,module_lectures_link,module_lectures_date,module_lectures_active_status, module_lectures_order FROM tbl_module_lectures $where ORDER BY module_lectures_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	
	
	function activeModule_Lectures($id)
	{
		$sql	= "UPDATE tbl_module_lectures SET module_lectures_active_status = abs(module_lectures_active_status-1),  
				   module_lectures_update_date = now(), 
				   module_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteModule_Lectures($id)
	{
		$sql	= "DELETE FROM tbl_module_lectures WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteModule_LecturesLang($id)
	{
		$sql	= "DELETE FROM tbl_module_lectures_lang WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkModule_Lectures($module_lectures_title){
		$sql	= "SELECT * FROM tbl_module_lectures WHERE module_lectures_title = '".$module_lectures_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkModule_LecturesLang($module_lectures_titlelang){
		$sql	= "SELECT * FROM tbl_module_lectures_lang WHERE module_lectures_lang_title = '".$module_lectures_titlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertModule_Lectures($module_lectures_title,$subject_id,$module_lectures_link,$module_lectures_date)
	{
		$sql	= "INSERT INTO tbl_module_lectures SET 
					module_lectures_title = '".$module_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        module_lectures_link = '".$module_lectures_link."',
                                        module_lectures_date = '".$module_lectures_date."',
                                        module_lectures_active_status = 0,
					module_lectures_order = 1,
					module_lectures_create_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertModule_LecturesLang($module_lectures_title,$module_Lecturesid,$languageid)
	{
		$sql	= "INSERT INTO tbl_module_lectures_lang SET module_lectures_lang_title = '".$module_lectures_title."',
					module_lectures_id = ".$module_Lecturesid.", language_id = ".$languageid.",
					module_lectures_lang_create_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateModule_Lectures($id,$module_lectures_title,$subject_id,$module_lectures_link,$module_lectures_date)
	{
		$sql	= "UPDATE tbl_module_lectures SET
                                        module_lectures_title = '".$module_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        module_lectures_link = '".$module_lectures_link."',
                                        module_lectures_date = '".$module_lectures_date."', 
                                        module_lectures_update_date=now(),
                                        module_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
                                        WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateModule_LecturesDefault($id,$module_lectures_title)
	{
		$sql	= "UPDATE tbl_module_lectures SET 
				   module_lectures_title='".$module_lectures_title."', 
				   module_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_update_date=now() WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateModule_LecturesLang($module_lectures_title,$module_Lecturesid,$languageid)
	{
		$sql	= "UPDATE tbl_module_lectures_lang SET 
				   module_lectures_lang_title='".$module_lectures_title."', 
				   module_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_lang_update_date=now() 
				   WHERE module_lectures_id = ".$module_Lecturesid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateModule_LecturesLangID($id, $module_lectures_titlelang)
	{
		$sql	= "UPDATE tbl_module_lectures_lang SET 
				   module_lectures_lang_title='".$module_lectures_titlelang."', 
				   module_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_lang_update_date=now() 
				   WHERE module_lectures_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderModule_Lectures($id,$order)
	{
		$sql	= "UPDATE tbl_module_lectures SET 
				   module_lectures_order= ".$order.",
				   module_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", module_lectures_update_date=now() WHERE module_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
       
}