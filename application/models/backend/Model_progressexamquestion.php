<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_progressexamquestion extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function getListQuestion($cond = null){
		$query		= "SELECT a.progress_exam_question_id, a.progress_exam_question_title, a.progress_exam_question_active_status, a.progress_exam_question_type,
					  DATE_FORMAT( a.progress_exam_question_create_date, '%d-%m-%Y %H:%i:%s' ) as progress_exam_question_create_date,
					  b.progress_exam_group_title, c.subject_title, a.progress_exam_question_images
					  FROM tbl_progress_exam_question a
					  INNER JOIN tbl_progress_exam_group b ON a.progress_exam_group_id = b.progress_exam_group_id 
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id 
					  ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswerGrid($id){
		$sql		= "SELECT progress_exam_answer_id, progress_exam_answer_title, progress_exam_answer_status
					  FROM tbl_progress_exam_answer
					  WHERE progress_exam_question_id = '$id' ORDER BY progress_exam_answer_order ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();

		return $rs;
	}
	
	function checkQuestion($progress_exam_questiontitle,$progress_exam_group_id,$progress_exam_question_type){
		$sql	= "SELECT * FROM tbl_progress_exam_question 
				   WHERE progress_exam_question_title = '".$progress_exam_questiontitle."' AND 
				   progress_exam_group_id = ".$progress_exam_group_id." AND 
				   progress_exam_question_type = ".$progress_exam_question_type." ";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertQuestion($progress_exam_questiontitle,$progress_exam_group_id,$progress_exam_question_type,$progress_exam_question_images_url){
		$sql	= "INSERT INTO tbl_progress_exam_question SET 
					progress_exam_question_title = '".$progress_exam_questiontitle."',
					progress_exam_group_id = ".$progress_exam_group_id.",
					progress_exam_question_type = ".$progress_exam_question_type.", 
					progress_exam_question_images = '".$progress_exam_question_images_url."', 
					progress_exam_question_active_status = 1, 
					progress_exam_question_create_by = ".$_SESSION['admin_data']['user_id'].",
					progress_exam_question_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	
	function insertAnswer($progress_exam_question,$progress_exam_answer,$progress_exam_status,$progress_exam_order){
		$sql	= "INSERT INTO tbl_progress_exam_answer SET
					progress_exam_question_id = '".$progress_exam_question."',
					progress_exam_answer_title = '".$progress_exam_answer."',
					progress_exam_answer_status = '".$progress_exam_status."',
					progress_exam_answer_order = '".$progress_exam_order."',
					progress_exam_answer_active_status = 1,
					progress_exam_answer_create_by = ".$_SESSION['admin_data']['user_id'].", progress_exam_answer_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	
	function getQuestion($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE progress_exam_question_id = ".$id;
		}

		$sql	= "SELECT progress_exam_question_id, progress_exam_question_title, progress_exam_question_active_status, progress_exam_question_type, progress_exam_group_id, progress_exam_question_images 
				   FROM tbl_progress_exam_question $where ORDER BY progress_exam_question_id ASC";	
		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 

		return $rs;	
	}
	
	function getAnswer($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE progress_exam_question_id = ".$id;
		}

		$sql	= "SELECT progress_exam_answer_id, progress_exam_answer_title, progress_exam_answer_status, progress_exam_answer_active_status, progress_exam_answer_order 
				   FROM tbl_progress_exam_answer $where ORDER BY progress_exam_answer_order ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}

	function updateQuestion($id,$progress_exam_questiontitle,$progress_exam_groupid,$progress_exam_question_type,$progress_exam_question_images_url){
		$sql	= "UPDATE tbl_progress_exam_question SET 
				   progress_exam_question_title = '".$progress_exam_questiontitle."',
				   progress_exam_group_id = ".$progress_exam_groupid.",
				   progress_exam_question_type = ".$progress_exam_question_type.",
				   progress_exam_question_images = '".$progress_exam_question_images_url."',
				   progress_exam_question_update_by = ".$_SESSION['admin_data']['user_id'].", 
				   progress_exam_question_update_date=now()
				   WHERE progress_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function updateAnswer($id,$answer,$status,$order){
		$sql	= "UPDATE tbl_progress_exam_answer SET 
				   progress_exam_answer_title = '".$answer."',
				   progress_exam_answer_status = '".$status."',
				   progress_exam_answer_update_by = ".$_SESSION['admin_data']['user_id'].", progress_exam_answer_update_date=now()
				   WHERE progress_exam_question_id = ".$id." and progress_exam_answer_order = ".$order;	

		$query	= $this->db->query($sql);

		return $query;
	}
	
	function activeQuestion($id){
		$sql	= "UPDATE tbl_progress_exam_question SET progress_exam_question_active_status = abs(progress_exam_question_active_status-1)
				   WHERE progress_exam_question_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteQuestion($id = ''){
		$sql	= "DELETE FROM tbl_progress_exam_question WHERE progress_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		$str = $this->db->last_query();
		$sqlx	= "DELETE FROM tbl_progress_exam_answer WHERE progress_exam_question_id = ".$id;	
		$queryx	= $this->db->query($sqlx);

		$strx = $this->db->last_query();

		return $str."|----|".$strx;
	}
	
	function deleteAnswer($qid = ''){
		$sqlx	= "DELETE FROM tbl_progress_exam_answer WHERE progress_exam_question_id = ".$qid;	
		$query	= $this->db->query($sqlx);

		return $query;
	}
}