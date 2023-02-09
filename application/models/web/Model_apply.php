<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_apply extends CI_Model {

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
   function AddSignup($full_name,$email,$password,$dob,$address1,$address2,$postal_code,$phone,$country_id,$today,$verificationCode){
       
     $sql	= "INSERT INTO tbl_signup SET 
                            register_id= '', 
                            full_name='".$full_name."', 
                            email='".$email."', 
                            password='".$password."', 
                            date_of_birth='".$dob."', 
                            address1='".$address1."', 
                            address2 ='".$address2."', 
                            postal_code='".$postal_code."', 
                            phone='".$phone."', 
                            country_id = $country_id,                
                            photo = '',                               
                            step= 1,
                            signup_date ='".$today."',
                            email_verification_code ='".$verificationCode."'";		
		
		$query  = $this->db->query($sql);
                $last_id  = $this->db->insert_id();
		
		return $last_id;
       
            
        }
	function checkEmail($email){			
			$query=$this->db->query("select * from tbl_signup WHERE email ='".$email."'");
                	return $query;			

		}
                
          function getDataEmail($email)
	  {
                $sql = "SELECT full_name, email from tbl_signup WHERE email ='".$email."'";		                                         
                        $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
                        $this->db->close();
			return $data;
              
            
                        
		}   
                
        function setRegisterId($signup_id,$register_id)  
        {  
            $this->db->set('register_id', $register_id)  
                ->where('signup_id', $signup_id)  
                ->update('tbl_signup');  
            return $this->db->affected_rows();  
        }      
        function verifyEmailAddress($verificationCode,$entryGroupId)  
        {  
            $this->db->set('entry_group_id', $entryGroupId);
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
        
     function getStudent ($signup_id)
      {
		$data=array();
                $sql = "select a.* from tbl_student as a inner join tbl_signup as b on a.signup_id = b.signup_id "
                        . "where a.signup_id=".$signup_id." and student_active_status = 1 ";	
		$hasil = $this->db->query($sql);
				if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
			$this->db->close();
			return $data;	
	}  
        
        
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
      
        function getPersonal ($signup_id){
         $data = array();
                    $sql = "select a.*, b.country_name from tbl_signup a "
                            . " inner join tbl_country as b on a.country_id = b.country_id "
                            . " where a.signup_id='$signup_id' and a.status = 1 ";		                                         
                        $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
                        $this->db->close();
			return $data;
      
  } 
  

  function updatePassword($signup_id,$newpass){
      {
		$sql	= "UPDATE tbl_signup SET 
				   password='".$newpass."' WHERE signup_id = ".$signup_id."";
		$query	= $this->db->query($sql);
		
		return $query;
	}
      
  }
     function updateForgetPassword($email,$newpass){
      {
		 $sql	= "UPDATE tbl_signup SET 
				   password='".$newpass."' WHERE email = '".$email."'";	
		$query	= $this->db->query($sql);
		
		return $query;
	}
      
  } 

function cekPassword ($signup_id,$password){
         $data = array();
                    $sql = "select signup_id as a from tbl_signup where signup_id='$signup_id' and password= '$password' and status = 1 ";		                                         
                        $hasil = $this->db->query($sql);
                        if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
                        $this->db->close();
			return $data;
      
  }
  
}