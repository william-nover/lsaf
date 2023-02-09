<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mockexamquestion extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function getListQuestion($cond = null){
		$query		= "SELECT a.mock_exam_question_id, a.mock_exam_question_title, a.mock_exam_question_active_status, a.mock_exam_question_type,
					  DATE_FORMAT( a.mock_exam_question_create_date, '%d-%m-%Y %H:%i:%s' ) as mock_exam_question_create_date,
					  b.mock_exam_group_title, c.subject_title, a.mock_exam_question_images
					  FROM tbl_mock_exam_question a
					  INNER JOIN tbl_mock_exam_group b ON a.mock_exam_group_id = b.mock_exam_group_id 
					  INNER JOIN tbl_subject c ON b.subject_id = c.subject_id 
					  ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswerGrid($id){
		$sql		= "SELECT mock_exam_answer_id, mock_exam_answer_title, mock_exam_answer_status
					  FROM tbl_mock_exam_answer
					  WHERE mock_exam_question_id = '$id' ORDER BY mock_exam_answer_order ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();

		return $rs;
	}
	
	function checkQuestion($mock_exam_questiontitle,$mock_exam_group_id,$mock_exam_question_type){
		$sql	= "SELECT * FROM tbl_mock_exam_question 
				   WHERE mock_exam_question_title = '".$mock_exam_questiontitle."' AND 
				   mock_exam_group_id = ".$mock_exam_group_id." AND 
				   mock_exam_question_type = ".$mock_exam_question_type." ";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertQuestion($mock_exam_questiontitle,$mock_exam_group_id,$mock_exam_question_type,$mock_exam_question_images_url){
		$sql	= "INSERT INTO tbl_mock_exam_question SET 
					mock_exam_question_title = '".$mock_exam_questiontitle."',
					mock_exam_group_id = ".$mock_exam_group_id.",
					mock_exam_question_type = ".$mock_exam_question_type.", 
					mock_exam_question_images = '".$mock_exam_question_images_url."', 
					mock_exam_question_active_status = 1, 
					mock_exam_question_create_by = ".$_SESSION['admin_data']['user_id'].",
					mock_exam_question_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	
	function insertAnswer($mock_exam_question,$mock_exam_answer,$mock_exam_status,$mock_exam_order){
		$sql	= "INSERT INTO tbl_mock_exam_answer SET
					mock_exam_question_id = '".$mock_exam_question."',
					mock_exam_answer_title = '".$mock_exam_answer."',
					mock_exam_answer_status = '".$mock_exam_status."',
					mock_exam_answer_order = '".$mock_exam_order."',
					mock_exam_answer_active_status = 1,
					mock_exam_answer_create_by = ".$_SESSION['admin_data']['user_id'].", mock_exam_answer_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	
	function getQuestion($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE mock_exam_question_id = ".$id;
		}

		$sql	= "SELECT mock_exam_question_id, mock_exam_question_title, mock_exam_question_active_status, mock_exam_question_type, mock_exam_group_id, mock_exam_question_images 
				   FROM tbl_mock_exam_question $where ORDER BY mock_exam_question_id ASC";	
		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 

		return $rs;	
	}
	
	function getAnswer($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE mock_exam_question_id = ".$id;
		}

		$sql	= "SELECT mock_exam_answer_id, mock_exam_answer_title, mock_exam_answer_status, mock_exam_answer_active_status, mock_exam_answer_order 
				   FROM tbl_mock_exam_answer $where ORDER BY mock_exam_answer_order ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}

	function updateQuestion($id,$mock_exam_questiontitle,$mock_exam_groupid,$mock_exam_question_type,$mock_exam_question_images_url){
		$sql	= "UPDATE tbl_mock_exam_question SET 
				   mock_exam_question_title = '".$mock_exam_questiontitle."',
				   mock_exam_group_id = ".$mock_exam_groupid.",
				   mock_exam_question_type = ".$mock_exam_question_type.",
				   mock_exam_question_images = '".$mock_exam_question_images_url."',
				   mock_exam_question_update_by = ".$_SESSION['admin_data']['user_id'].", 
				   mock_exam_question_update_date=now()
				   WHERE mock_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function updateAnswer($id,$answer,$status,$order){
		$sql	= "UPDATE tbl_mock_exam_answer SET 
				   mock_exam_answer_title = '".$answer."',
				   mock_exam_answer_status = '".$status."',
				   mock_exam_answer_update_by = ".$_SESSION['admin_data']['user_id'].", mock_exam_answer_update_date=now()
				   WHERE mock_exam_question_id = ".$id." and mock_exam_answer_order = ".$order;	

		$query	= $this->db->query($sql);

		return $query;
	}
	
	function activeQuestion($id){
		$sql	= "UPDATE tbl_mock_exam_question SET mock_exam_question_active_status = abs(mock_exam_question_active_status-1)
				   WHERE mock_exam_question_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteQuestion($id = ''){
		$sql	= "DELETE FROM tbl_mock_exam_question WHERE mock_exam_question_id = ".$id;	
		$query	= $this->db->query($sql);

		$str = $this->db->last_query();
		$sqlx	= "DELETE FROM tbl_mock_exam_answer WHERE mock_exam_question_id = ".$id;	
		$queryx	= $this->db->query($sqlx);

		$strx = $this->db->last_query();

		return $str."|----|".$strx;
	}
	
	function deleteAnswer($qid = ''){
		$sqlx	= "DELETE FROM tbl_mock_exam_answer WHERE mock_exam_question_id = ".$qid;	
		$query	= $this->db->query($sqlx);

		return $query;
	}
}