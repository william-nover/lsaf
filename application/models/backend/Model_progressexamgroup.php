<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_progressexamgroup extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	function getListSubject($cond = null){
		$query		= "SELECT subject_id, subject_title
					  FROM tbl_subject ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query; 
	}

	function getListGroup($cond = null){
		$query		= "SELECT a.progress_exam_group_id, a.progress_exam_group_title, a.progress_exam_group_active_status, a.progress_exam_group_timer,
					  DATE_FORMAT( a.progress_exam_group_start, '%d-%m-%Y' ) as progress_exam_group_start,
					  DATE_FORMAT( a.progress_exam_group_end, '%d-%m-%Y' ) as progress_exam_group_end,
					  a.progress_exam_group_timer_essay,
					  DATE_FORMAT( a.progress_exam_group_create_date, '%d-%m-%Y %H:%i:%s' ) as progress_exam_group_create_date,
					  b.subject_title, b.subject_id
					  FROM tbl_progress_exam_group a 
					  INNER JOIN tbl_subject b ON a.subject_id = b.subject_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($progress_exam_grouptitle, $subject_id){
		$sql	= "SELECT * FROM tbl_progress_exam_group 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   progress_exam_group_title = '".$progress_exam_grouptitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($progress_exam_grouptitle,$subject_id,$progress_exam_groupstart,$progress_exam_groupend,$progress_exam_grouptimer,$progress_exam_grouptimeressay){

		$sql	= "INSERT INTO tbl_progress_exam_group SET 
					progress_exam_group_title = '".$progress_exam_grouptitle."',
					subject_id = ".$subject_id.",
					progress_exam_group_start = '".$progress_exam_groupstart."',
					progress_exam_group_end = '".$progress_exam_groupend."',
					progress_exam_group_timer = ".$progress_exam_grouptimer.",
					progress_exam_group_timer_essay = ".$progress_exam_grouptimeressay.",
					progress_exam_group_active_status = 1, 
					progress_exam_group_create_by = ".$_SESSION['admin_data']['user_id'].", 
					progress_exam_group_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE progress_exam_group_id = ".$id;
		}

		$sql	= "SELECT progress_exam_group_id, progress_exam_group_title, progress_exam_group_active_status, 
				   subject_id, progress_exam_group_timer, progress_exam_group_timer_essay, 
				   DATE_FORMAT( progress_exam_group_start, '%Y-%m-%d' ) as progress_exam_group_start,
				   DATE_FORMAT( progress_exam_group_end, '%Y-%m-%d' ) as progress_exam_group_end
				   FROM tbl_progress_exam_group $where ORDER BY progress_exam_group_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$progress_exam_grouptitle,$subject_id,$progress_exam_groupstart,$progress_exam_groupend,$progress_exam_grouptimer,$progress_exam_grouptimeressay){
		$sql	= "UPDATE tbl_progress_exam_group SET 
				   progress_exam_group_title = '".$progress_exam_grouptitle."',
				   subject_id = ".$subject_id.",
				   progress_exam_group_start = '".$progress_exam_groupstart."',
				   progress_exam_group_end = '".$progress_exam_groupend."',
				   progress_exam_group_timer = ".$progress_exam_grouptimer.",
				   progress_exam_group_timer_essay = ".$progress_exam_grouptimeressay.",
				   progress_exam_group_update_by = ".$_SESSION['admin_data']['user_id'].",
				   progress_exam_group_update_date=now()
				   WHERE progress_exam_group_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_progress_exam_group SET progress_exam_group_active_status = abs(progress_exam_group_active_status-1)
				   WHERE progress_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_progress_exam_group WHERE progress_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
}