<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_progressexamresult extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	function getListSubject($cond = null){
		$query		= "SELECT subject_id, subject_title
					  FROM tbl_subject ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}

	function getListResult($cond = null){
		$query		= "SELECT a.progress_exam_result_id, a.attempt, a.progress_exam_group_id,
					  a.student_id, c.progress_exam_group_title, d.subject_title,
					  e.full_name, e.register_id
					  FROM tbl_progress_exam_result a 
					  INNER JOIN tbl_student b ON a.student_id = b.student_id
					  INNER JOIN tbl_progress_exam_group c ON a.progress_exam_group_id = c.progress_exam_group_id
					  INNER JOIN tbl_subject d ON c.subject_id = d.subject_id
					  INNER JOIN tbl_signup e ON b.signup_id = e.signup_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultDetail($groupid, $studentid){
		$query		= "SELECT a.progress_exam_result_id, a.total_question, a.total_answered, a.attempt, a.progress_exam_group_id,
					  a.progress_exam_result_value, a.student_id, DATE_FORMAT( progress_exam_result_create_date, '%d-%m-%Y %H:%i:%s' ) as progress_exam_result_create_date
					  FROM tbl_progress_exam_result a 
					  WHERE a.progress_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetail($groupid, $studentid){
		$query		= "SELECT a.progress_exam_essay_id, a.progress_exam_group_id, a.student_id, a.attempt, a.progress_exam_group_id,
					  a.progress_exam_essay_value, a.progress_exam_essay_file, DATE_FORMAT( progress_exam_essay_create_date, '%Y-%m-%d %H:%i:%s' ) as progress_exam_essay_create_date
					  FROM tbl_progress_exam_essay a 
					  WHERE a.progress_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetailByID($id){
		$query		= "SELECT a.progress_exam_essay_id, a.progress_exam_group_id, a.student_id, a.attempt, a.progress_exam_group_id,
					  a.progress_exam_essay_value, a.progress_exam_essay_file, DATE_FORMAT( progress_exam_essay_create_date, '%d-%m-%Y %H:%i:%s' ) as progress_exam_essay_create_date,
					  b.progress_exam_group_title, c.subject_title
					  FROM tbl_progress_exam_essay a 
					  INNER JOIN tbl_progress_exam_group b ON a.progress_exam_group_id = b.progress_exam_group_id
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id
					  WHERE a.progress_exam_essay_id = ".$id;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($progress_exam_resulttitle, $subject_id){
		$sql	= "SELECT * FROM tbl_progress_exam_result 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   progress_exam_result_title = '".$progress_exam_resulttitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($progress_exam_resulttitle,$subject_id,$progress_exam_resultstart,$progress_exam_resultend,$progress_exam_resulttimer,$progress_exam_resulttimeressay){

		$sql	= "INSERT INTO tbl_progress_exam_result SET 
					progress_exam_result_title = '".$progress_exam_resulttitle."',
					subject_id = ".$subject_id.",
					progress_exam_result_start = '".$progress_exam_resultstart."',
					progress_exam_result_end = '".$progress_exam_resultend."',
					progress_exam_result_timer = ".$progress_exam_resulttimer.",
					progress_exam_result_timer_essay = ".$progress_exam_resulttimeressay.",
					progress_exam_result_active_status = 1, 
					progress_exam_result_create_by = ".$_SESSION['admin_data']['user_id'].", 
					progress_exam_result_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE progress_exam_result_id = ".$id;
		}

		$sql	= "SELECT progress_exam_result_id, progress_exam_result_title, progress_exam_result_active_status, 
				   subject_id, progress_exam_result_timer, progress_exam_result_timer_essay, 
				   DATE_FORMAT( progress_exam_result_start, '%Y-%m-%d' ) as progress_exam_result_start,
				   DATE_FORMAT( progress_exam_result_end, '%Y-%m-%d' ) as progress_exam_result_end
				   FROM tbl_progress_exam_result $where ORDER BY progress_exam_result_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$progress_exam_resulttitle,$subject_id,$progress_exam_resultstart,$progress_exam_resultend,$progress_exam_resulttimer,$progress_exam_resulttimeressay){
		$sql	= "UPDATE tbl_progress_exam_result SET 
				   progress_exam_result_title = '".$progress_exam_resulttitle."',
				   subject_id = ".$subject_id.",
				   progress_exam_result_start = '".$progress_exam_resultstart."',
				   progress_exam_result_end = '".$progress_exam_resultend."',
				   progress_exam_result_timer = ".$progress_exam_resulttimer.",
				   progress_exam_result_timer_essay = ".$progress_exam_resulttimeressay.",
				   progress_exam_result_update_by = ".$_SESSION['admin_data']['user_id'].",
				   progress_exam_result_update_date=now()
				   WHERE progress_exam_result_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_progress_exam_result SET progress_exam_result_active_status = abs(progress_exam_result_active_status-1)
				   WHERE progress_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_progress_exam_result WHERE progress_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
	
	function updateResultEssay($id,$progress_exam_essay_value){
		$sql	= "UPDATE tbl_progress_exam_essay SET 
				   progress_exam_essay_value = '".$progress_exam_essay_value."',
				   progress_exam_essay_update_date=now()
				   WHERE progress_exam_essay_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}
}