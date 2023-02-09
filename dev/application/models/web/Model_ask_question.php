<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ask_question extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
   
        function getSubject($student_id){
            
            $data = array();
            $sql = "SELECT a.subject_id, b. subject_title FROM  tbl_class_management AS a "
                   . " INNER JOIN tbl_subject AS b ON a.subject_id = b.subject_id "
                    . " where a.student_id =  $student_id order by a.subject_id Asc";         
            $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
            
        }
    
        function getEmail($subject_id){
            
          $data = array();
            $sql = "SELECT a.lecturer_email FROM  tbl_lecturer AS a "
                   . " INNER JOIN tbl_subject AS b ON a.lecturer_id = b.lecturer_id "
                    . " where b.subject_id =  $subject_id ";         
            $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                            $data = '';
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;   
        }
       
}