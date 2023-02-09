<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_entry extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	function getGroup(){
		$query		= "SELECT entry_group_id
						FROM tbl_entry_group 
						WHERE entry_group_active_status = 1 
						ORDER BY RAND() LIMIT 1";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getGroupSignUp($group_id, $signup_id){
		$sql		= "SELECT a.register_id, a.status, a.step, b.entry_group_timer, b.entry_group_title
						FROM tbl_signup a, tbl_entry_group b
						WHERE a.entry_group_id = b.entry_group_id AND a.signup_id = ".$signup_id." AND b.entry_group_id = ".$group_id;  
		$query		= $this->db->query($sql)->result_array();
		
		return $query;
	}
	
	function getQuestion($cond = null){
		$query		= "SELECT entry_question_id, entry_question_title
					  FROM tbl_entry_question ".$cond;	
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswer($questionid){
		$query		= "SELECT entry_answer_id, entry_answer_title
					  FROM tbl_entry_answer
					  WHERE entry_answer_active_status = 1 AND entry_question_id = ".$questionid;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExam($questionid, $signup_id, $groupid){
		$query		= "SELECT entry_exam_id
						FROM tbl_entry_exam 
						WHERE entry_question_id = ".$questionid." AND 
						signup_id = ".$signup_id." AND 
						entry_group_id  = ".$groupid."
						";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamAnswered($questionid, $answerid, $signup_id){
		$query		= "SELECT entry_exam_id, entry_question_id, entry_answer_id
						FROM tbl_entry_exam 
						WHERE entry_question_id = ".$questionid." AND 
						entry_answer_id = ".$answerid." AND 
						signup_id  = ".$signup_id;		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getQuestionForExam($group_id){
		$query		= "SELECT entry_question_id
					  FROM tbl_entry_question WHERE entry_group_id = ".$group_id." ORDER BY entry_question_order ASC, entry_question_id ASC";	
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionCheckAnswered($question_id, $group_id, $signup_id){
		$query		= "SELECT entry_question_id, entry_answer_id
						FROM tbl_entry_exam 
						WHERE entry_group_id = ".$group_id." AND 
						entry_question_id = ".$question_id." AND 
						signup_id  = ".$signup_id." ORDER BY entry_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionTotalAnswered($group_id, $signup_id){
		$query		= "SELECT entry_question_id, entry_answer_id
						FROM tbl_entry_exam 
						WHERE entry_group_id = ".$group_id." AND 
						signup_id  = ".$signup_id." ORDER BY entry_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getExamQuestionAnswered($group_id, $signup_id){
		$query		= "SELECT entry_question_id, entry_answer_id
						FROM tbl_entry_exam 
						WHERE entry_group_id = ".$group_id." AND 
						signup_id  = ".$signup_id." ORDER BY entry_question_id ASC"; 		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function checkAnswer($question_id, $answer_id){
		$query		= "SELECT entry_answer_status
					  FROM tbl_entry_answer
					  WHERE entry_answer_active_status = 1 AND 
					  entry_question_id = ".$question_id." AND 
					  entry_answer_id = ".$answer_id." ORDER BY entry_question_id ASC";
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function updateExam($questionid, $answerid, $signup_id, $groupid){
		$sql	= "UPDATE tbl_entry_exam SET 
					entry_answer_id = ".$answerid."
					WHERE entry_question_id = ".$questionid." AND 
					signup_id = ".$signup_id." AND
					entry_group_id  = ".$groupid."
					";	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function insertExam($questionid, $answerid, $signup_id, $groupid){
		$sql	= "INSERT INTO tbl_entry_exam SET 
					entry_question_id = ".$questionid.",
					entry_answer_id = ".$answerid.",
					entry_group_id  = ".$groupid.",
					signup_id = ".$signup_id.",
					entry_exam_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function getExamResult($signup_id, $groupid){
		$query		= "SELECT entry_result_id, entry_result_value
						FROM tbl_entry_result 
						WHERE 
						signup_id = ".$signup_id." AND 
						entry_group_id  = ".$groupid;		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function insertExamResult($signup_id, $groupid, $totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered){
		$sql	= "INSERT INTO tbl_entry_result SET 
					entry_group_id  = ".$groupid.",
					signup_id = ".$signup_id.",
					entry_result_value = ".$totalAnsweredTrue.",
					total_question = ".$totalAllQuestion.",
					total_answered = ".$totalAllExamQuestionAnswered.",
					entry_result_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	function updateExamResult($signup_id, $groupid, $totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered){
		$sql	= "UPDATE tbl_entry_result SET 
					entry_result_value = ".$totalAnsweredTrue.",
					total_question = ".$totalAllQuestion.",
					total_answered = ".$totalAllExamQuestionAnswered."
					WHERE signup_id = ".$signup_id." AND
					entry_group_id  = ".$groupid."
					";	
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function getEntryTest($id){
		
		$query		= "SELECT entry_test_id, signup_id, entry_test_status, email_status
					  FROM tbl_entry_test WHERE signup_id = ".$id;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function createEntryTest($id)
	{
		$sql	= "INSERT INTO tbl_entry_test SET 
					signup_id = ".$id.",
					entry_test_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
	
	
	function updateSignUpFinishExam($signup_id){
		$sql	= "UPDATE tbl_signup SET 
					step = 2
					WHERE signup_id = ".$signup_id;	
		$query	= $this->db->query($sql);
		
		return $query;
	}
}