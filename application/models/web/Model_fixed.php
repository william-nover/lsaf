<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_fixed extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }

	function savePersonBrochure($gender_label, $first_name, $last_name, $email, $edu, $phone){
        // $this->db->insert('tbl_downloaded_brochure', $data);
        $sql	= "INSERT INTO tbl_downloaded_brochure SET 
					gender_label = '".$gender_label."',
					first_name = '".$first_name."',
					last_name = '".$last_name."',
					email = '".$email."',
					edu = '".$edu."',
                    phone = '".$phone."',
					created_at = now()";	
		$query  = $this->db->query($sql);
	}
}