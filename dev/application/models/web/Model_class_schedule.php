<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_class_schedule extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	

	  function getVideoSchedule() {           
                    $data = array();
                        $sql = "SELECT a.video_lectures_id, a.video_lectures_title, a.subject_id, a.video_lectures_link,
                                    a.video_lectures_order, a.video_lectures_date,
					 DATE_FORMAT(  a.video_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as video_lectures_create_date,a.video_lectures_active_status, a.video_lectures_create_by, b.subject_title,
                                         c.lecturer_name, d.student_id
					 FROM tbl_video_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id 
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]."";			
                        
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
       function getModuleSchedule() {           
                    $data = array();                     
                        $sql = "SELECT a.module_lectures_id, a.module_lectures_title, a.subject_id, a.module_lectures_link,
                                    a.module_lectures_order, a.module_lectures_date,
					 DATE_FORMAT(  a.module_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as module_lectures_create_date,a.module_lectures_active_status, a.module_lectures_create_by, b.subject_title,
                                         c.lecturer_name, d.student_id
					 FROM tbl_module_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]."";		
                        
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
           function getSkypeSchedule() {           
                    $data = array();                     
                        $sql ="SELECT a.skype_lectures_id, a.skype_lectures_title, a.subject_id, a.skype_lectures_link,
                                    a.skype_lectures_order, a.skype_lectures_date,a.skype_lectures_time,
					 DATE_FORMAT(  a.skype_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as skype_lectures_create_date,a.skype_lectures_active_status, a.skype_lectures_create_by, b.subject_title,
                                         c.lecturer_name, d.student_id
					 FROM tbl_skype_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id 
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]."";
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
    
    function getVideoScheduleMonth($month) {           
                    //$data = array();
                   
                        $sql = "SELECT a.video_lectures_id, a.video_lectures_title, a.subject_id, a.video_lectures_link,
                                    a.video_lectures_order, a.video_lectures_date,
					 DATE_FORMAT(  a.video_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as video_lectures_create_date,a.video_lectures_active_status, a.video_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_video_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id  
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]."
                                         and a.video_lectures_date like '$month%'";		
                        
                         $query		= $this->db->query($sql)->result_array();
		
		return $query;      
    }
    function getSkypeScheduleMonth($month) {           
                    //$data = array();
                   
                        $sql = "SELECT a.skype_lectures_id, a.skype_lectures_title, a.subject_id, a.skype_lectures_link,
                                    a.skype_lectures_order, a.skype_lectures_date,
					 DATE_FORMAT(  a.skype_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as skype_lectures_create_date,a.skype_lectures_active_status, a.skype_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_skype_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id  
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]." 
                                         and a.skype_lectures_date like '$month%'";		
                        
                         $query		= $this->db->query($sql)->result_array();
		
		return $query;      
    }
    function getModuleScheduleMonth($month) {           
                    //$data = array();
                   
                        $sql = "SELECT a.module_lectures_id, a.module_lectures_title, a.subject_id, a.module_lectures_link,
                                    a.module_lectures_order, a.module_lectures_date,
					 DATE_FORMAT(  a.module_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as module_lectures_create_date,a.module_lectures_active_status, a.module_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_module_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id  
                                         inner join tbl_class_management as d on b.subject_id=d.subject_id 
                                         inner join tbl_student as e on d.student_id=e.student_id where e.student_id =".$this->data["student_id"]."
                                         and a.module_lectures_date like '$month%'";		
                        
                         $query		= $this->db->query($sql)->result_array();
		
		return $query;      
    }
    
    
	function getVideo_Lectures($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE video_lectures_id = ".$id;
		}
		$sql	= "SELECT video_lectures_id,video_lectures_title,subject_id,video_lectures_link,video_lectures_date,video_lectures_active_status, video_lectures_order FROM tbl_video_lectures $where ORDER BY video_lectures_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		
		return $rs;	
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
    
}

