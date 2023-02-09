<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_class_management extends CI_Model {

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
        function getStudent(){
            $data = array();
            $sql = "Select a.student_id , b.full_name from tbl_student as a"
                    . " inner join tbl_signup as b on a.signup_id = b.signup_id order by student_id  Asc";         
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
     
	function getListClass_management($cond = null){
            
                    $query = "SELECT a.class_management_id, a.subject_id,
                             DATE_FORMAT(  a.class_management_start_date, '%d-%m-%Y %H:%i:%s' ) as class_management_start_date,
                             DATE_FORMAT(  a.class_management_end_date, '%d-%m-%Y %H:%i:%s' ) as class_management_end_date,
                             a.class_management_active_status, a.class_management_create_by, b.subject_title,
                             c.student_id, d.full_name,e.module_level_title
                             FROM tbl_class_management as a 
                             inner join tbl_subject as b on a.subject_id = b.subject_id 
                             inner join tbl_student as c on a.student_id=c.student_id
                             inner join tbl_signup as d on c.signup_id = d.signup_id
                             inner join tbl_module_level as e on c.module_level_id=e.module_level_id
                            ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}

	

	
	function getClass_management($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE class_management_id = ".$id;
		}
		$sql	= "SELECT class_management_id, student_id, subject_id,class_management_start_date,class_management_end_date, class_management_active_status FROM tbl_class_management $where ORDER BY class_management_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
	}
	
	
	
	function activeClass_management($id)
	{
		$sql	= "UPDATE tbl_class_management SET class_management_active_status = abs(class_management_active_status-1),  
				   
				   class_management_update_by = ".$_SESSION['admin_data']['user_id']." ,class_management_create_date = now()
				   WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteClass_management($id)
	{
		$sql	= "DELETE FROM tbl_class_management WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteSubjectLang($id)
	{
		$sql	= "DELETE FROM tbl_class_management_lang WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkClass_management($student_id,$subject_id){
		$sql	= "SELECT * FROM tbl_class_management WHERE student_id = '".$student_id."' and  subject_id = '".$subject_id."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkClass_managementLang($class_management_titlelang){
		$sql	= "SELECT * FROM tbl_class_management_lang WHERE class_management_lang_title = '".$class_management_titlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertClass_management($subject_id,$student_id,$class_management_start_date,$class_management_end_date)
	{
		$sql	= "INSERT INTO tbl_class_management SET subject_id = '".$subject_id."',student_id = '".$student_id."', class_management_start_date = '".$class_management_start_date."',
					class_management_end_date = '".$class_management_end_date."',
					class_management_create_by = ".$_SESSION['admin_data']['user_id'].", class_management_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertClass_managementtLang($class_management_title,$subjectid,$languageid)
	{
		$sql	= "INSERT INTO tbl_class_management_lang SET class_management_lang_title = '".$class_management_title."',
					class_management_id = ".$subjectid.", language_id = ".$languageid.",
					class_management_lang_create_by = ".$_SESSION['admin_data']['user_id'].", class_management_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateClass_management($id,$subject_id,$student_id,$class_management_start_date,$class_management_end_date)
	{
		$sql	= "UPDATE tbl_class_management SET 
				   subject_id='".$subject_id."',student_id = '".$student_id."',
                                   class_management_start_date='".$class_management_start_date."', 
                                   class_management_end_date='".$class_management_end_date."',     
				   class_management_update_by = ".$_SESSION['admin_data']['user_id'].",
                                    class_management_update_date=now() WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateClass_managementDefault($id,$class_management_title)
	{
		$sql	= "UPDATE tbl_class_management SET 
				   class_management_title='".$class_management_title."', 
				   class_management_update_by = ".$_SESSION['admin_data']['user_id'].", class_management_update_date=now() WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	
	
	function updateOrderSubject($id,$order)
	{
		$sql	= "UPDATE tbl_subject SET 
				   class_management_order= ".$order.",
				   class_management_update_by = ".$_SESSION['admin_data']['user_id'].", class_management_update_date=now() WHERE class_management_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
       
   function getMail($subject_id){
            $data = array();
            $sql = "SELECT a.subject_id, b.subject_title, c.student_id, d.email FROM `tbl_class_management`  as a
                    inner join tbl_subject as b on a.subject_id = b.subject_id
                    inner join tbl_student as c on a.student_id = c.student_id
                    inner join tbl_signup as d on c.signup_id = d.signup_id
                    where  a.subject_id= ".$subject_id."";
            
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
}