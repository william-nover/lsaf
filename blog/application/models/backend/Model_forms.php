<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_forms extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

        function getModule($module_name){
            $data = array();
            $sql="select module_id , module_group_id from tbl_module where module_path='".$module_name."' ";         
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

         function getListForms($cond = null){
		   $query	    = "SELECT  a.forms_id,  a.forms_title, a.forms_email, a.forms_cc, a.forms_bcc,a.forms_active_status,  "
                                    . "DATE_FORMAT( a.forms_create_date, '%d-%m-%Y %H:%i:%s' ) as forms_create_date "                                  
                                    . "FROM tbl_forms as a "
                                    . " ".$cond;
		$query		= $this->db->query($query)->result_array();
		return $query;

	}
         
	

	
	function getForms($id = '')
	{
		$where = '';
		if($id != ''){
			$where = "WHERE a.forms_id = ".$id;
		}
		 $sql	= "SELECT  a.forms_id,  a.forms_title, a.forms_email, a.forms_cc, a.forms_bcc,a.forms_active_status,  "
                                    . "DATE_FORMAT( a.forms_create_date, '%d-%m-%Y %H:%i:%s' ) as forms_create_date "                                  
                                    . "FROM tbl_forms as a "
                                    . " $where "
                                    . " ORDER BY a.forms_id ASC";	
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		return $rs;	

	}

	function checkForms($forms_title){

		$sql	= "SELECT forms_title FROM tbl_forms WHERE forms_title = '".$forms_title."'";

		$query	= $this->db->query($sql);

		$rs		= $query->result_array(); 



		return $rs;

	}
	function activeForms($id)

	{
		$sql	= "UPDATE tbl_forms SET forms_active_status = abs(forms_active_status-1)
				   WHERE forms_id = ".$id;	
		$query	= $this->db->query($sql);		
		return $query;
	}



	
	
	function deleteForms($id = '')

	{

		$sql	= "DELETE FROM tbl_forms WHERE forms_id = ".$id;	

		$query	= $this->db->query($sql);

		

		$str = $this->db->last_query();

		

		return $str;

	}



        function insertForms($forms_title, $forms_email,$forms_cc,$forms_bcc)
	{
		$sql	= "INSERT INTO tbl_forms SET 
                            forms_title='".$forms_title."',
                            forms_email='".$forms_email."',
                            forms_cc='".$forms_cc."',
                            forms_bcc='".$forms_bcc."',
                            forms_create_date = now()";			
		$query  = $this->db->query($sql);
		$last_id  = $this->db->insert_id();
		return $last_id;

	}

function updateForms($id,$forms_title, $forms_email,$forms_cc,$forms_bcc)

	{
		 $sql	= "UPDATE tbl_forms SET 
                            forms_title='".$forms_title."',
                            forms_email='".$forms_email."',
                            forms_cc='".$forms_cc."',
                            forms_bcc='".$forms_bcc."'
                            WHERE forms_id = ".$id;	
		$query	= $this->db->query($sql);
		return $query;

	}
         function updateOrderForms($id,$order)
	{

		$sql	= "UPDATE tbl_forms SET 
				   forms_order= ".$order.",
				   forms_update_by = ".$_SESSION['admin_data']['user_id'].", forms_update_date=now() WHERE forms_id = ".$id;	

		$query	= $this->db->query($sql);		
		return $query;

	}

}