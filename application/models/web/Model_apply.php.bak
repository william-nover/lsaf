<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Apply extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function getNationality()
	  {
            $hasil=$this->db->query("SELECT  * from tbl_country  order by country_name Asc");
			if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
                        else{
                           $data=''; 
                        }
			$hasil->free_result();
                        $this->db->close();
			return $data;
                        
		}
        function AddSignup($data){
             $this->db->insert('tbl_signup', $data);
        }
	function checkEmail($email){			
			$query=$this->db->query("select * from tbl_signup WHERE email ='".$email."'");
                	return $query;			

		}
        function verifyEmailAddress($verificationCode)  
        {  
            $this->db->set('status', 1)  
                ->where('email_verification_code', $verificationCode)  
                ->update('tbl_signup');  
            return $this->db->affected_rows();  
        }         
        function getByVerify($verificationText)		
        {	                     
            //$query=$this->db->query("select * from tbl_signup where email_verification_code='$verificationText'");  
             $sql = "select * from tbl_signup where email_verification_code='$verificationText'";		                                         
                        $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
                        $this->db->close();
			return $data;
       //     return $query;                        		
        }  
        
//     function cekSignUp ($email,$password)
//      {
//		echo $sql = "select * from tbl_signup where email='$email' and password= '$password' and status = 1 ";	
//		$query	= $this->db->query($sql);
//		$rs		= $query->result_array(); 
//		
//		return $rs;	
//	}  
        
        
        function cekSignUp ($email,$password){
      $data = array();
                    $sql = "select * from tbl_signup where email='$email' and password= '$password' and status = 1 ";		                                         
                        $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
                        $this->db->close();
			return $data;
      
  }     
        
        
}