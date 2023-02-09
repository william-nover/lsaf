<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_entryquestion extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function getListQuestion($cond = null){
		$query		= "SELECT a.entry_question_id, a.entry_question_title, a.entry_question_active_status, a.entry_question_order,
					  DATE_FORMAT( a.entry_question_create_date, '%d-%m-%Y %H:%i:%s' ) as entry_question_create_date,
					  b.entry_group_title
					  FROM tbl_entry_question a
					  INNER JOIN tbl_entry_group b ON a.entry_group_id = b.entry_group_id ".$cond;
		$query		= $this->db->query($query)->result_array();
		
		return $query;
	}
	
	function getAnswerGrid($id){
		$sql		= "SELECT entry_answer_id, entry_answer_title, entry_answer_status
					  FROM tbl_entry_answer
					  WHERE entry_question_id = '$id' ORDER BY entry_answer_order ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();

		return $rs;
	}
	
	function checkQuestion($entry_questiontitle){
		$sql	= "SELECT * FROM tbl_entry_question WHERE entry_question_title = '".$entry_questiontitle."'";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertQuestion($entry_questiontitle,$entry_groupid){
		$sql	= "INSERT INTO tbl_entry_question SET 
					entry_question_title = '".$entry_questiontitle."',
					entry_group_id = ".$entry_groupid.",
					entry_question_active_status = 1, 
					entry_question_create_by = ".$_SESSION['admin_data']['user_id'].",
					entry_question_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	
	function insertAnswer($entry_question,$entry_answer,$entry_status,$entry_order){
		$sql	= "INSERT INTO tbl_entry_answer SET
					entry_question_id = '".$entry_question."',
					entry_answer_title = '".$entry_answer."',
					entry_answer_status = '".$entry_status."',
					entry_answer_order = '".$entry_order."',
					entry_answer_active_status = 1,
					entry_answer_create_by = ".$_SESSION['admin_data']['user_id'].", entry_answer_create_date = now()";	
		$query  = $this->db->query($sql);

		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	
	function getQuestion($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE entry_question_id = ".$id;
		}

		$sql	= "SELECT entry_question_id, entry_question_title, entry_question_active_status, entry_question_order, entry_group_id 
				   FROM tbl_entry_question $where ORDER BY entry_question_id ASC";	
		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 

		return $rs;	
	}
	
	function getAnswer($id = ''){

		$where = '';

		if($id != ''){

			$where = "WHERE entry_question_id = ".$id;

		}

		$sql	= "SELECT entry_answer_id, entry_answer_title, entry_answer_status, entry_answer_active_status, entry_answer_order 

				   FROM tbl_entry_answer $where ORDER BY entry_answer_order ASC";	

		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 

		

		return $rs;	

	}

	function updateQuestion($id,$entry_questiontitle,$entry_groupid){
		$sql	= "UPDATE tbl_entry_question SET 
				   entry_question_title = '".$entry_questiontitle."',
				   entry_group_id = ".$entry_groupid.",
				   entry_question_update_by = ".$_SESSION['admin_data']['user_id'].", 
				   entry_question_update_date=now()
				   WHERE entry_question_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	

	function updateAnswer($id,$answer,$status,$order)

	{

		$sql	= "UPDATE tbl_entry_answer SET 

				   entry_answer_title = '".$answer."',

				   entry_answer_status = '".$status."',

				   entry_answer_update_by = ".$_SESSION['admin_data']['user_id'].", entry_answer_update_date=now()

				   WHERE entry_question_id = ".$id." and entry_answer_order = ".$order;	

		$query	= $this->db->query($sql);

		

		return $query;

	}
	

	function activeQuestion($id)

	{

		$sql	= "UPDATE tbl_entry_question SET entry_question_active_status = abs(entry_question_active_status-1)

				   WHERE entry_question_id = ".$id;	

		$query	= $this->db->query($sql);

		

		return $query;

	}

	

	function deleteQuestion($id = '')

	{

		$sql	= "DELETE FROM tbl_entry_question WHERE entry_question_id = ".$id;	

		$query	= $this->db->query($sql);

		

		$str = $this->db->last_query();
		
		$sqlx	= "DELETE FROM tbl_entry_answer WHERE entry_question_id = ".$id;	

		$queryx	= $this->db->query($sqlx);

		

		$strx = $this->db->last_query();

		

		return $str."|----|".$strx;

	}
	
	function updateOrderQuestion($id,$order)

	{

		$sql	= "UPDATE tbl_entry_question SET 

				   entry_question_order= ".$order.",

				   entry_question_update_by = ".$_SESSION['admin_data']['user_id'].", entry_question_update_date=now() 

				   WHERE entry_question_id = ".$id;	

		$query	= $this->db->query($sql);

		

		return $query;

	}

	
	

}