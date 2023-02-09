<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mockexamgroup extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	
	function getListSubject($cond = null){
		$query		= "SELECT subject_id, subject_title
					  FROM tbl_subject ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query; 
	}

	function getListGroup($cond = null){
		$query		= "SELECT a.mock_exam_group_id, a.mock_exam_group_title, a.mock_exam_group_active_status, a.mock_exam_group_timer,
					  DATE_FORMAT( a.mock_exam_group_start, '%d-%m-%Y' ) as mock_exam_group_start,
					  DATE_FORMAT( a.mock_exam_group_end, '%d-%m-%Y' ) as mock_exam_group_end,
					  a.mock_exam_group_timer_essay,
					  DATE_FORMAT( a.mock_exam_group_create_date, '%d-%m-%Y %H:%i:%s' ) as mock_exam_group_create_date,
					  b.subject_title, b.subject_id
					  FROM tbl_mock_exam_group a 
					  INNER JOIN tbl_subject b ON a.subject_id = b.subject_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($mock_exam_grouptitle, $subject_id){
		$sql	= "SELECT * FROM tbl_mock_exam_group 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   mock_exam_group_title = '".$mock_exam_grouptitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($mock_exam_grouptitle,$subject_id,$mock_exam_groupstart,$mock_exam_groupend,$mock_exam_grouptimer,$mock_exam_grouptimeressay){

		$sql	= "INSERT INTO tbl_mock_exam_group SET 
					mock_exam_group_title = '".$mock_exam_grouptitle."',
					subject_id = ".$subject_id.",
					mock_exam_group_start = '".$mock_exam_groupstart."',
					mock_exam_group_end = '".$mock_exam_groupend."',
					mock_exam_group_timer = ".$mock_exam_grouptimer.",
					mock_exam_group_timer_essay = ".$mock_exam_grouptimeressay.",
					mock_exam_group_active_status = 1, 
					mock_exam_group_create_by = ".$_SESSION['admin_data']['user_id'].", 
					mock_exam_group_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE mock_exam_group_id = ".$id;
		}

		$sql	= "SELECT mock_exam_group_id, mock_exam_group_title, mock_exam_group_active_status, 
				   subject_id, mock_exam_group_timer, mock_exam_group_timer_essay, 
				   DATE_FORMAT( mock_exam_group_start, '%Y-%m-%d' ) as mock_exam_group_start,
				   DATE_FORMAT( mock_exam_group_end, '%Y-%m-%d' ) as mock_exam_group_end
				   FROM tbl_mock_exam_group $where ORDER BY mock_exam_group_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$mock_exam_grouptitle,$subject_id,$mock_exam_groupstart,$mock_exam_groupend,$mock_exam_grouptimer,$mock_exam_grouptimeressay){
		$sql	= "UPDATE tbl_mock_exam_group SET 
				   mock_exam_group_title = '".$mock_exam_grouptitle."',
				   subject_id = ".$subject_id.",
				   mock_exam_group_start = '".$mock_exam_groupstart."',
				   mock_exam_group_end = '".$mock_exam_groupend."',
				   mock_exam_group_timer = ".$mock_exam_grouptimer.",
				   mock_exam_group_timer_essay = ".$mock_exam_grouptimeressay.",
				   mock_exam_group_update_by = ".$_SESSION['admin_data']['user_id'].",
				   mock_exam_group_update_date=now()
				   WHERE mock_exam_group_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_mock_exam_group SET mock_exam_group_active_status = abs(mock_exam_group_active_status-1)
				   WHERE mock_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_mock_exam_group WHERE mock_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
}