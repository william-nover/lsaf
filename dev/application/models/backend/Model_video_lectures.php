<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_video_Lectures extends CI_Model {

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
    
	function getListVideo_Lectures($cond = null){
		 $query		= "SELECT a.video_lectures_id, a.video_lectures_title, a.subject_id, a.video_lectures_link,
                                    a.video_lectures_order, a.video_lectures_date,
					 DATE_FORMAT(  a.video_lectures_create_date, '%d-%m-%Y %H:%i:%s' ) as video_lectures_create_date,a.video_lectures_active_status, a.video_lectures_create_by, b.subject_title,
                                         c.lecturer_name
					 FROM tbl_video_lectures as a inner join tbl_subject as b on a.subject_id = b.subject_id 
                                         inner join tbl_lecturer as c on b.lecturer_id=c.lecturer_id ".$cond;		  
		//echo $query."<br>";
		$query		= $this->db->query($query)->result_array();
		
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
	
	
	
	function activeVideo_Lectures($id)
	{
		$sql	= "UPDATE tbl_video_lectures SET video_lectures_active_status = abs(video_lectures_active_status-1),  
				   video_lectures_update_date = now(), 
				   video_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
				   WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function deleteVideo_Lectures($id)
	{
		$sql	= "DELETE FROM tbl_video_lectures WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function deleteVideo_LecturesLang($id)
	{
		$sql	= "DELETE FROM tbl_video_lectures_lang WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		$str = $this->db->last_query();
		
		return $str;
	}
	
	function checkVideo_Lectures($video_lectures_title){
		$sql	= "SELECT * FROM tbl_video_lectures WHERE video_lectures_title = '".$video_lectures_title."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function checkVideo_LecturesLang($video_lectures_titlelang){
		$sql	= "SELECT * FROM tbl_video_lectures_lang WHERE video_lectures_lang_title = '".$video_lectures_titlelang."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}
	
	function insertVideo_Lectures($video_lectures_title,$subject_id,$video_lectures_link,$video_lectures_date)
	{
		$sql	= "INSERT INTO tbl_video_lectures SET 
					video_lectures_title = '".$video_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        video_lectures_link = '".$video_lectures_link."',
                                        video_lectures_date = '".$video_lectures_date."',
                                        video_lectures_active_status = 0,
					video_lectures_order = 1,
					video_lectures_create_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function insertVideo_LecturesLang($video_lectures_title,$video_Lecturesid,$languageid)
	{
		$sql	= "INSERT INTO tbl_video_lectures_lang SET video_lectures_lang_title = '".$video_lectures_title."',
					video_lectures_id = ".$video_Lecturesid.", language_id = ".$languageid.",
					video_lectures_lang_create_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_lang_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateVideo_Lectures($id,$video_lectures_title,$subject_id,$video_lectures_link,$video_lectures_date)
	{
		$sql	= "UPDATE tbl_video_lectures SET
                                        video_lectures_title = '".$video_lectures_title."',
                                        subject_id = '".$subject_id."',
                                        video_lectures_link = '".$video_lectures_link."',
                                        video_lectures_date = '".$video_lectures_date."', 
                                        video_lectures_update_date=now(),
                                        video_lectures_update_by = ".$_SESSION['admin_data']['user_id']."
                                        WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateVideo_LecturesDefault($id,$video_lectures_title)
	{
		$sql	= "UPDATE tbl_video_lectures SET 
				   video_lectures_title='".$video_lectures_title."', 
				   video_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_update_date=now() WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateVideo_LecturesLang($video_lectures_title,$video_Lecturesid,$languageid)
	{
		$sql	= "UPDATE tbl_video_lectures_lang SET 
				   video_lectures_lang_title='".$video_lectures_title."', 
				   video_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_lang_update_date=now() 
				   WHERE video_lectures_id = ".$video_Lecturesid." AND language_id = ".$languageid;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateVideo_LecturesLangID($id, $video_lectures_titlelang)
	{
		$sql	= "UPDATE tbl_video_lectures_lang SET 
				   video_lectures_lang_title='".$video_lectures_titlelang."', 
				   video_lectures_lang_update_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_lang_update_date=now() 
				   WHERE video_lectures_lang_id = ".$id;	

		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function updateOrderVideo_Lectures($id,$order)
	{
		$sql	= "UPDATE tbl_video_lectures SET 
				   video_lectures_order= ".$order.",
				   video_lectures_update_by = ".$_SESSION['admin_data']['user_id'].", video_lectures_update_date=now() WHERE video_lectures_id = ".$id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
           
}