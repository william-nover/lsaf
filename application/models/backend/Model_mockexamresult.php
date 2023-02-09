<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mockexamresult extends CI_Model {

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
		$query		= "SELECT a.mock_exam_result_id, a.attempt, a.mock_exam_group_id,
					  a.student_id, c.mock_exam_group_title, d.subject_title,
					  e.full_name, e.register_id
					  FROM tbl_mock_exam_result a 
					  INNER JOIN tbl_student b ON a.student_id = b.student_id
					  INNER JOIN tbl_mock_exam_group c ON a.mock_exam_group_id = c.mock_exam_group_id
					  INNER JOIN tbl_subject d ON c.subject_id = d.subject_id
					  INNER JOIN tbl_signup e ON b.signup_id = e.signup_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultDetail($groupid, $studentid){
		$query		= "SELECT a.mock_exam_result_id, a.total_question, a.total_answered, a.attempt, a.mock_exam_group_id,
					  a.mock_exam_result_value, a.student_id, DATE_FORMAT( mock_exam_result_create_date, '%d-%m-%Y %H:%i:%s' ) as mock_exam_result_create_date
					  FROM tbl_mock_exam_result a 
					  WHERE a.mock_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetail($groupid, $studentid){
		$query		= "SELECT a.mock_exam_essay_id, a.mock_exam_group_id, a.student_id, a.attempt, a.mock_exam_group_id,
					  a.mock_exam_essay_value, a.mock_exam_essay_file, DATE_FORMAT( mock_exam_essay_create_date, '%Y-%m-%d %H:%i:%s' ) as mock_exam_essay_create_date
					  FROM tbl_mock_exam_essay a 
					  WHERE a.mock_exam_group_id = ".$groupid." AND a.student_id = ".$studentid." 
					  ORDER BY a.attempt ASC";
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function getListResultEssayDetailByID($id){
		$query		= "SELECT a.mock_exam_essay_id, a.mock_exam_group_id, a.student_id, a.attempt, a.mock_exam_group_id,
					  a.mock_exam_essay_value, a.mock_exam_essay_file, DATE_FORMAT( mock_exam_essay_create_date, '%d-%m-%Y %H:%i:%s' ) as mock_exam_essay_create_date,
					  b.mock_exam_group_title, c.subject_title
					  FROM tbl_mock_exam_essay a 
					  INNER JOIN tbl_mock_exam_group b ON a.mock_exam_group_id = b.mock_exam_group_id
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id
					  WHERE a.mock_exam_essay_id = ".$id;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($mock_exam_resulttitle, $subject_id){
		$sql	= "SELECT * FROM tbl_mock_exam_result 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   mock_exam_result_title = '".$mock_exam_resulttitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($mock_exam_resulttitle,$subject_id,$mock_exam_resultstart,$mock_exam_resultend,$mock_exam_resulttimer,$mock_exam_resulttimeressay){

		$sql	= "INSERT INTO tbl_mock_exam_result SET 
					mock_exam_result_title = '".$mock_exam_resulttitle."',
					subject_id = ".$subject_id.",
					mock_exam_result_start = '".$mock_exam_resultstart."',
					mock_exam_result_end = '".$mock_exam_resultend."',
					mock_exam_result_timer = ".$mock_exam_resulttimer.",
					mock_exam_result_timer_essay = ".$mock_exam_resulttimeressay.",
					mock_exam_result_active_status = 1, 
					mock_exam_result_create_by = ".$_SESSION['admin_data']['user_id'].", 
					mock_exam_result_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE mock_exam_result_id = ".$id;
		}

		$sql	= "SELECT mock_exam_result_id, mock_exam_result_title, mock_exam_result_active_status, 
				   subject_id, mock_exam_result_timer, mock_exam_result_timer_essay, 
				   DATE_FORMAT( mock_exam_result_start, '%Y-%m-%d' ) as mock_exam_result_start,
				   DATE_FORMAT( mock_exam_result_end, '%Y-%m-%d' ) as mock_exam_result_end
				   FROM tbl_mock_exam_result $where ORDER BY mock_exam_result_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$mock_exam_resulttitle,$subject_id,$mock_exam_resultstart,$mock_exam_resultend,$mock_exam_resulttimer,$mock_exam_resulttimeressay){
		$sql	= "UPDATE tbl_mock_exam_result SET 
				   mock_exam_result_title = '".$mock_exam_resulttitle."',
				   subject_id = ".$subject_id.",
				   mock_exam_result_start = '".$mock_exam_resultstart."',
				   mock_exam_result_end = '".$mock_exam_resultend."',
				   mock_exam_result_timer = ".$mock_exam_resulttimer.",
				   mock_exam_result_timer_essay = ".$mock_exam_resulttimeressay.",
				   mock_exam_result_update_by = ".$_SESSION['admin_data']['user_id'].",
				   mock_exam_result_update_date=now()
				   WHERE mock_exam_result_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_mock_exam_result SET mock_exam_result_active_status = abs(mock_exam_result_active_status-1)
				   WHERE mock_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_mock_exam_result WHERE mock_exam_result_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
	
	function updateResultEssay($id,$mock_exam_essay_value){
		$sql	= "UPDATE tbl_mock_exam_essay SET 
				   mock_exam_essay_value = '".$mock_exam_essay_value."',
				   mock_exam_essay_update_date=now()
				   WHERE mock_exam_essay_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}
}