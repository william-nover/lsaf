<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_weeklyexamresult extends CI_Model {

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
		$query		= "SELECT a.weekly_exam_result_id, a.attempt, a.weekly_exam_group_id,
					  a.student_id, c.weekly_exam_group_title, d.subject_title,
					  e.full_name, e.register_id
					  FROM tbl_weekly_exam_result a 
					  INNER JOIN tbl_student b ON a.student_id = b.student_id
					  INNER JOIN tbl_weekly_exam_group c ON a.weekly_exam_group_id = c.weekly_exam_group_id
					  INNER JOIN tbl_subject d ON c.subject_id = d.subject_id
					  INNER JOIN tbl_signup e ON b.signup_id = e.signup_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultDetail($groupid, $studentid){
		$query		= "SELECT a.weekly_exam_result_id, a.total_question, a.total_answered, a.attempt, a.weekly_exam_group_id,
					  a.weekly_exam_result_value, a.student_id, DATE_FORMAT( weekly_exam_result_create_date, '%d-%m-%Y %H:%i:%s' ) as weekly_exam_result_create_date
					  FROM tbl_weekly_exam_result a 
					  WHERE a.weekly_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetail($groupid, $studentid){
		$query		= "SELECT a.weekly_exam_essay_id, a.weekly_exam_group_id, a.student_id, a.attempt, a.weekly_exam_group_id,
					  a.weekly_exam_essay_value, a.weekly_exam_essay_file, DATE_FORMAT( weekly_exam_essay_create_date, '%d-%m-%Y %H:%i:%s' ) as weekly_exam_essay_create_date
					  FROM tbl_weekly_exam_essay a 
					  WHERE a.weekly_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetailByID($id){
		$query		= "SELECT a.weekly_exam_essay_id, a.weekly_exam_group_id, a.student_id, a.attempt, a.weekly_exam_group_id,
					  a.weekly_exam_essay_value, a.weekly_exam_essay_file, DATE_FORMAT( weekly_exam_essay_create_date, '%d-%m-%Y %H:%i:%s' ) as weekly_exam_essay_create_date,
					  b.weekly_exam_group_title, c.subject_title
					  FROM tbl_weekly_exam_essay a 
					  INNER JOIN tbl_weekly_exam_group b ON a.weekly_exam_group_id = b.weekly_exam_group_id
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id
					  WHERE a.weekly_exam_essay_id = ".$id;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($weekly_exam_resulttitle, $subject_id){
		$sql	= "SELECT * FROM tbl_weekly_exam_result 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   weekly_exam_result_title = '".$weekly_exam_resulttitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($weekly_exam_resulttitle,$subject_id,$weekly_exam_resultstart,$weekly_exam_resultend,$weekly_exam_resulttimer,$weekly_exam_resulttimeressay){

		$sql	= "INSERT INTO tbl_weekly_exam_result SET 
					weekly_exam_result_title = '".$weekly_exam_resulttitle."',
					subject_id = ".$subject_id.",
					weekly_exam_result_start = '".$weekly_exam_resultstart."',
					weekly_exam_result_end = '".$weekly_exam_resultend."',
					weekly_exam_result_timer = ".$weekly_exam_resulttimer.",
					weekly_exam_result_timer_essay = ".$weekly_exam_resulttimeressay.",
					weekly_exam_result_active_status = 1, 
					weekly_exam_result_create_by = ".$_SESSION['admin_data']['user_id'].", 
					weekly_exam_result_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE weekly_exam_result_id = ".$id;
		}

		$sql	= "SELECT weekly_exam_result_id, weekly_exam_result_title, weekly_exam_result_active_status, 
				   subject_id, weekly_exam_result_timer, weekly_exam_result_timer_essay, 
				   DATE_FORMAT( weekly_exam_result_start, '%Y-%m-%d' ) as weekly_exam_result_start,
				   DATE_FORMAT( weekly_exam_result_end, '%Y-%m-%d' ) as weekly_exam_result_end
				   FROM tbl_weekly_exam_result $where ORDER BY weekly_exam_result_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$weekly_exam_resulttitle,$subject_id,$weekly_exam_resultstart,$weekly_exam_resultend,$weekly_exam_resulttimer,$weekly_exam_resulttimeressay){
		$sql	= "UPDATE tbl_weekly_exam_result SET 
				   weekly_exam_result_title = '".$weekly_exam_resulttitle."',
				   subject_id = ".$subject_id.",
				   weekly_exam_result_start = '".$weekly_exam_resultstart."',
				   weekly_exam_result_end = '".$weekly_exam_resultend."',
				   weekly_exam_result_timer = ".$weekly_exam_resulttimer.",
				   weekly_exam_result_timer_essay = ".$weekly_exam_resulttimeressay.",
				   weekly_exam_result_update_by = ".$_SESSION['admin_data']['user_id'].",
				   weekly_exam_result_update_date=now()
				   WHERE weekly_exam_result_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_weekly_exam_result SET weekly_exam_result_active_status = abs(weekly_exam_result_active_status-1)
				   WHERE weekly_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_weekly_exam_result WHERE weekly_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
	
	function updateResultEssay($id,$weekly_exam_essay_value){
		$sql	= "UPDATE tbl_weekly_exam_essay SET 
				   weekly_exam_essay_value = '".$weekly_exam_essay_value."',
				   weekly_exam_essay_update_date=now()
				   WHERE weekly_exam_essay_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}
}