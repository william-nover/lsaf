<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dashboard extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	function getWeeklyExamSubject($student_id){
		$query		= "SELECT a.weekly_exam_group_id, a.student_id, c.subject_title
						FROM tbl_weekly_exam_result a 
						INNER JOIN tbl_weekly_exam_group b ON a.weekly_exam_group_id = b.weekly_exam_group_id
						INNER JOIN tbl_subject c ON b.subject_id = c.subject_id
						WHERE a.student_id = ".$student_id."
						GROUP BY a.weekly_exam_group_id ASC, a.student_id ASC
						ORDER BY a.weekly_exam_group_id ASC";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getWeeklyExamResult($group_id, $student_id){
		$query		= "SELECT a.*
						FROM tbl_weekly_exam_result a 
						WHERE a.student_id = ".$student_id." AND a.weekly_exam_group_id = ".$group_id."
						ORDER BY a.attempt ASC";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getWeeklyExamResultEssay($group_id, $student_id){
		$query		= "SELECT a.*
						FROM tbl_weekly_exam_essay a 
						WHERE a.student_id = ".$student_id." AND a.weekly_exam_group_id = ".$group_id."
						ORDER BY a.attempt ASC";		  
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
}