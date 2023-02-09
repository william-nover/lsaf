<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_progress_exam extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getProgressExamSchedule($groupid = "") {
		$sqladd = "";
		if(!empty($groupid)){
			$sqladd .= " AND a.progress_exam_group_id = ".$groupid;
		}
		
		$sql 	= "SELECT a.progress_exam_group_id, a.progress_exam_group_title, a.subject_id, b.subject_title,
					DATE_FORMAT( a.progress_exam_group_start, '%d/%m/%Y' ) as progress_exam_group_start,
					DATE_FORMAT( a.progress_exam_group_end, '%d/%m/%Y' ) as progress_exam_group_end
					FROM tbl_progress_exam_group a 
					INNER JOIN tbl_subject b ON a.subject_id = b.subject_id
					INNER JOIN tbl_class_management c ON b.subject_id = c.subject_id
					WHERE a.progress_exam_group_active_status = 1 AND a.progress_exam_group_start <= CURDATE( ) 
					AND a.progress_exam_group_end > CURDATE( ) ".$sqladd;			
		$query	= $this->db->query($sql)->result_array();
		
		return $query;      
    }
	
	function getProgressExamAttemptMultiple($groupid, $studentid) {
		$sql 	= "SELECT count(attempt) as total FROM tbl_progress_exam_result 
				   WHERE progress_exam_group_id = ".$groupid." AND student_id = ".$studentid;
		
		$query	= $this->db->query($sql)->result_array();
		
		return $query;      
    }
	
	function getProgressExamAttemptEssay($groupid, $studentid) {
		$sql 	= "SELECT count(attempt) as total FROM tbl_progress_exam_essay 
				   WHERE progress_exam_group_id = ".$groupid." AND student_id = ".$studentid;
		
		$query	= $this->db->query($sql)->result_array();
		
		return $query;      
    }
	
	function getGroup($groupid){
		$query		= "SELECT a.progress_exam_group_id, a.progress_exam_group_title, a.progress_exam_group_timer,
						a.progress_exam_group_timer_essay, a.subject_id, b.subject_title
						FROM tbl_progress_exam_group a INNER JOIN tbl_subject b ON a.subject_id = b.subject_id
						WHERE a.progress_exam_group_active_status = 1 AND a.progress_exam_group_id = ".$groupid;		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getQuestion($cond = null){
		$query		= "SELECT progress_exam_question_id, progress_exam_question_title, progress_exam_question_images
					  FROM tbl_progress_exam_question ".$cond;	
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswer($questionid){
		$query		= "SELECT progress_exam_answer_id, progress_exam_answer_title
					  FROM tbl_progress_exam_answer
					  WHERE progress_exam_answer_active_status = 1 AND progress_exam_question_id = ".$questionid;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamAnswered($questionid, $answerid, $student_id){
		$query		= "SELECT progress_exam_multiple_id, progress_exam_question_id, progress_exam_answer_id
						FROM tbl_progress_exam_multiple 
						WHERE progress_exam_question_id = ".$questionid." AND 
						progress_exam_answer_id = ".$answerid." AND 
						student_id  = ".$student_id;		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExam($questionid, $student_id, $groupid){
		$query		= "SELECT progress_exam_multiple_id
						FROM tbl_progress_exam_multiple 
						WHERE progress_exam_question_id = ".$questionid." AND 
						student_id = ".$student_id." AND 
						progress_exam_group_id  = ".$groupid."
						";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function insertExam($questionid, $answerid, $student_id, $groupid){
		$sql	= "INSERT INTO tbl_progress_exam_multiple SET 
					progress_exam_question_id = ".$questionid.",
					progress_exam_answer_id = ".$answerid.",
					progress_exam_group_id  = ".$groupid.",
					student_id = ".$student_id.",
					progress_exam_multiple_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateExam($questionid, $answerid, $student_id, $groupid){
		$sql	= "UPDATE tbl_progress_exam_multiple SET 
					progress_exam_answer_id = ".$answerid."
					WHERE progress_exam_question_id = ".$questionid." AND 
					student_id = ".$student_id." AND
					progress_exam_group_id  = ".$groupid."
					";	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function getQuestionForExam($group_id, $type){
		$query		= "SELECT progress_exam_question_id
					  FROM tbl_progress_exam_question 
					  WHERE progress_exam_question_type = ".$type." AND progress_exam_group_id = ".$group_id." ORDER BY progress_exam_question_id ASC";	
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionCheckAnswered($question_id, $group_id, $student_id){
		$query		= "SELECT progress_exam_question_id, progress_exam_answer_id
						FROM tbl_progress_exam_multiple 
						WHERE progress_exam_group_id = ".$group_id." AND 
						progress_exam_question_id = ".$question_id." AND 
						student_id  = ".$student_id." ORDER BY progress_exam_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionTotalAnswered($group_id, $student_id){
		$query		= "SELECT progress_exam_question_id, progress_exam_answer_id
						FROM tbl_progress_exam_multiple 
						WHERE progress_exam_group_id = ".$group_id." AND 
						student_id  = ".$student_id." ORDER BY progress_exam_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionAnswered($group_id, $student_id){
		$query		= "SELECT progress_exam_question_id, progress_exam_answer_id
						FROM tbl_progress_exam_multiple 
						WHERE progress_exam_group_id = ".$group_id." AND 
						student_id  = ".$student_id." ORDER BY progress_exam_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function checkAnswer($question_id, $answer_id){
		$query		= "SELECT progress_exam_answer_status
					  FROM tbl_progress_exam_answer
					  WHERE progress_exam_answer_status = 1 AND 
					  progress_exam_question_id = ".$question_id." AND 
					  progress_exam_answer_id = ".$answer_id." ORDER BY progress_exam_question_id ASC";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamResult($student_id, $groupid){
		$query		= "SELECT progress_exam_result_id, progress_exam_result_value, attempt
						FROM tbl_progress_exam_result 
						WHERE 
						student_id = ".$student_id." AND 
						progress_exam_group_id  = ".$groupid."
						ORDER BY progress_exam_result_id DESC
						";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function insertExamResult($student_id, $groupid, $totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt){
		$sql	= "INSERT INTO tbl_progress_exam_result SET 
					progress_exam_group_id  = ".$groupid.",
					student_id = ".$student_id.",
					progress_exam_result_value = ".$totalAnsweredTrue.",
					total_question = ".$totalAllQuestion.",
					attempt = ".$attempt.",
					total_answered = ".$totalAllExamQuestionAnswered.",
					progress_exam_result_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateExamResult($student_id, $groupid, $totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt){
		$sql	= "UPDATE tbl_progress_exam_result SET 
					progress_exam_result_value = ".$totalAnsweredTrue.",
					total_question = ".$totalAllQuestion.",
					total_answered = ".$totalAllExamQuestionAnswered.",
					attempt = ".$attempt."
					WHERE student_id = ".$student_id." AND
					progress_exam_group_id  = ".$groupid."
					";	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function insertExamEssay($student_id,$groupid,$fileName,$attempt){
		$sql	= "INSERT INTO tbl_progress_exam_essay SET 
					progress_exam_group_id = ".$groupid.",
					student_id = ".$student_id.",
					progress_exam_essay_file = '".$fileName."',
					attempt = ".$attempt.",
					progress_exam_essay_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function getExamResultEssay($student_id, $groupid){
		$query		= "SELECT progress_exam_essay_id, progress_exam_essay_file, attempt, progress_exam_essay_value
						FROM tbl_progress_exam_essay 
						WHERE 
						student_id = ".$student_id." AND 
						progress_exam_group_id  = ".$groupid."
						ORDER BY progress_exam_essay_id DESC
						";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
}

