<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_weeklyexamquestion extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function getListQuestion($cond = null){
		$query		= "SELECT a.weekly_exam_question_id, a.weekly_exam_question_title, a.weekly_exam_question_active_status, a.weekly_exam_question_type,
					  DATE_FORMAT( a.weekly_exam_question_create_date, '%d-%m-%Y %H:%i:%s' ) as weekly_exam_question_create_date,
					  a.weekly_exam_question_images, b.weekly_exam_group_title, c.subject_title
					  FROM tbl_weekly_exam_question a
					  INNER JOIN tbl_weekly_exam_group b ON a.weekly_exam_group_id = b.weekly_exam_group_id 
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id 
					  ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswerGrid($id){
		$sql		= "SELECT weekly_exam_answer_id, weekly_exam_answer_title, weekly_exam_answer_status
					  FROM tbl_weekly_exam_answer
					  WHERE weekly_exam_question_id = '$id' ORDER BY weekly_exam_answer_order ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();

		return $rs;
	}
	
	function checkQuestion($weekly_exam_questiontitle,$weekly_exam_group_id,$weekly_exam_question_type){
		$sql	= "SELECT * FROM tbl_weekly_exam_question 
				   WHERE weekly_exam_question_title = '".$weekly_exam_questiontitle."' AND 
				   weekly_exam_group_id = ".$weekly_exam_group_id." AND 
				   weekly_exam_question_type = ".$weekly_exam_question_type." ";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertQuestion($weekly_exam_questiontitle,$weekly_exam_group_id,$weekly_exam_question_type,$weekly_exam_question_images_url){
		$sql	= "INSERT INTO tbl_weekly_exam_question SET 
					weekly_exam_question_title = '".$weekly_exam_questiontitle."',
					weekly_exam_group_id = ".$weekly_exam_group_id.",
					weekly_exam_question_type = ".$weekly_exam_question_type.", 
					weekly_exam_question_images = '".$weekly_exam_question_images_url."', 
					weekly_exam_question_active_status = 1, 
					weekly_exam_question_create_by = ".$_SESSION['admin_data']['user_id'].",
					weekly_exam_question_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	
	function insertAnswer($weekly_exam_question,$weekly_exam_answer,$weekly_exam_status,$weekly_exam_order){
		$sql	= "INSERT INTO tbl_weekly_exam_answer SET
					weekly_exam_question_id = '".$weekly_exam_question."',
					weekly_exam_answer_title = '".$weekly_exam_answer."',
					weekly_exam_answer_status = '".$weekly_exam_status."',
					weekly_exam_answer_order = '".$weekly_exam_order."',
					weekly_exam_answer_active_status = 1,
					weekly_exam_answer_create_by = ".$_SESSION['admin_data']['user_id'].", weekly_exam_answer_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	
	function getQuestion($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE weekly_exam_question_id = ".$id;
		}

		$sql	= "SELECT weekly_exam_question_id, weekly_exam_question_title, weekly_exam_question_active_status, weekly_exam_question_type, weekly_exam_group_id, weekly_exam_question_images 
				   FROM tbl_weekly_exam_question $where ORDER BY weekly_exam_question_id ASC";	
		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 

		return $rs;	
	}
	
	function getAnswer($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE weekly_exam_question_id = ".$id;
		}

		$sql	= "SELECT weekly_exam_answer_id, weekly_exam_answer_title, weekly_exam_answer_status, weekly_exam_answer_active_status, weekly_exam_answer_order 
				   FROM tbl_weekly_exam_answer $where ORDER BY weekly_exam_answer_order ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}

	function updateQuestion($id,$weekly_exam_questiontitle,$weekly_exam_groupid,$weekly_exam_question_type,$weekly_exam_question_images_url){
		$sql	= "UPDATE tbl_weekly_exam_question SET 
				   weekly_exam_question_title = '".$weekly_exam_questiontitle."',
				   weekly_exam_group_id = ".$weekly_exam_groupid.",
				   weekly_exam_question_type = ".$weekly_exam_question_type.",
				   weekly_exam_question_images = '".$weekly_exam_question_images_url."',
				   weekly_exam_question_update_by = ".$_SESSION['admin_data']['user_id'].", 
				   weekly_exam_question_update_date=now()
				   WHERE weekly_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function updateAnswer($id,$answer,$status,$order){
		$sql	= "UPDATE tbl_weekly_exam_answer SET 
				   weekly_exam_answer_title = '".$answer."',
				   weekly_exam_answer_status = '".$status."',
				   weekly_exam_answer_update_by = ".$_SESSION['admin_data']['user_id'].", weekly_exam_answer_update_date=now()
				   WHERE weekly_exam_question_id = ".$id." and weekly_exam_answer_order = ".$order;	

		$query	= $this->db->query($sql);

		return $query;
	}
	
	function activeQuestion($id){
		$sql	= "UPDATE tbl_weekly_exam_question SET weekly_exam_question_active_status = abs(weekly_exam_question_active_status-1)
				   WHERE weekly_exam_question_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteQuestion($id = ''){
		$sql	= "DELETE FROM tbl_weekly_exam_question WHERE weekly_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		$str = $this->db->last_query();
		$sqlx	= "DELETE FROM tbl_weekly_exam_answer WHERE weekly_exam_question_id = ".$id;	
		$queryx	= $this->db->query($sqlx);

		$strx = $this->db->last_query();

		return $str."|----|".$strx;
	}
	
	function deleteAnswer($qid = ''){
		$sqlx	= "DELETE FROM tbl_weekly_exam_answer WHERE weekly_exam_question_id = ".$qid;	
		$query	= $this->db->query($sqlx);

		return $query;
	}
}