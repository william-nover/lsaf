<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_weeklyexamgroup extends CI_Model {

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
		$query		= "SELECT a.weekly_exam_group_id, a.weekly_exam_group_title, a.weekly_exam_group_active_status, a.weekly_exam_group_timer,
					  DATE_FORMAT( a.weekly_exam_group_start, '%d-%m-%Y' ) as weekly_exam_group_start,
					  DATE_FORMAT( a.weekly_exam_group_end, '%d-%m-%Y' ) as weekly_exam_group_end,
					  a.weekly_exam_group_timer_essay,
					  DATE_FORMAT( a.weekly_exam_group_create_date, '%d-%m-%Y %H:%i:%s' ) as weekly_exam_group_create_date,
					  b.subject_title, b.subject_id
					  FROM tbl_weekly_exam_group a 
					  INNER JOIN tbl_subject b ON a.subject_id = b.subject_id
					  ".$cond;
		$query		= $this->db->query($query)->result_array();

		return $query;
	}
	
	function checkGroup($weekly_exam_grouptitle, $subject_id){
		$sql	= "SELECT * FROM tbl_weekly_exam_group 
				   WHERE 
				   subject_id = ".$subject_id." AND
				   weekly_exam_group_title = '".$weekly_exam_grouptitle."'";
		
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;
	}

	function insertGroup($weekly_exam_grouptitle,$subject_id,$weekly_exam_groupstart,$weekly_exam_groupend,$weekly_exam_grouptimer,$weekly_exam_grouptimeressay){

		$sql	= "INSERT INTO tbl_weekly_exam_group SET 
					weekly_exam_group_title = '".$weekly_exam_grouptitle."',
					subject_id = ".$subject_id.",
					weekly_exam_group_start = '".$weekly_exam_groupstart."',
					weekly_exam_group_end = '".$weekly_exam_groupend."',
					weekly_exam_group_timer = ".$weekly_exam_grouptimer.",
					weekly_exam_group_timer_essay = ".$weekly_exam_grouptimeressay.",
					weekly_exam_group_active_status = 1, 
					weekly_exam_group_create_by = ".$_SESSION['admin_data']['user_id'].", 
					weekly_exam_group_create_date = now()";	
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();

		return $last_id;
	}
	

	function getGroup($id = ''){
		$where = '';

		if($id != ''){
			$where = "WHERE weekly_exam_group_id = ".$id;
		}

		$sql	= "SELECT weekly_exam_group_id, weekly_exam_group_title, weekly_exam_group_active_status, 
				   subject_id, weekly_exam_group_timer, weekly_exam_group_timer_essay, 
				   DATE_FORMAT( weekly_exam_group_start, '%Y-%m-%d' ) as weekly_exam_group_start,
				   DATE_FORMAT( weekly_exam_group_end, '%Y-%m-%d' ) as weekly_exam_group_end
				   FROM tbl_weekly_exam_group $where ORDER BY weekly_exam_group_id ASC";	

		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 

		return $rs;	
	}
	

	function updateGroup($id,$weekly_exam_grouptitle,$subject_id,$weekly_exam_groupstart,$weekly_exam_groupend,$weekly_exam_grouptimer,$weekly_exam_grouptimeressay){
		$sql	= "UPDATE tbl_weekly_exam_group SET 
				   weekly_exam_group_title = '".$weekly_exam_grouptitle."',
				   subject_id = ".$subject_id.",
				   weekly_exam_group_start = '".$weekly_exam_groupstart."',
				   weekly_exam_group_end = '".$weekly_exam_groupend."',
				   weekly_exam_group_timer = ".$weekly_exam_grouptimer.",
				   weekly_exam_group_timer_essay = ".$weekly_exam_grouptimeressay.",
				   weekly_exam_group_update_by = ".$_SESSION['admin_data']['user_id'].",
				   weekly_exam_group_update_date=now()
				   WHERE weekly_exam_group_id = ".$id;	

		$query	= $this->db->query($sql);

		return $query;
	}

	function activeGroup($id){
		$sql	= "UPDATE tbl_weekly_exam_group SET weekly_exam_group_active_status = abs(weekly_exam_group_active_status-1)
				   WHERE weekly_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}

	function deleteGroup($id = ''){
		$sql	= "DELETE FROM tbl_weekly_exam_group WHERE weekly_exam_group_id = ".$id;	
		$query	= $this->db->query($sql);

		return $query;
	}
}