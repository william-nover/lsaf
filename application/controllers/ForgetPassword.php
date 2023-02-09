<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class ForgetPassword extends MY_Controller {	
	public $data = array();		
	public function __construct()	
	{		
	parent::__construct();                
	session_start();               
	 $this->load->model(array('backend/Model_menu_frontend','web/Model_apply', 'backend/Model_language','backend/Model_logcms'));		
	 $this->load->helper(array('funcglobal','menu','accessprivilege','alias','email'));
	 }		
	 public function index()	{		
		 $this->data['title'] = "Forget Password";		
		include 'checkSession.php'; 		
		$this->load->view('vForget',$this->data);	
	}
        
        function getPassword(){
         $email = $this->security->xss_clean(secure_input($_POST['email'])); 
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
          if ($this->form_validation->run() == FALSE)
                    {
                     $this->data['emailExist']='';
                     $this->load->view('vForget',$this->data);
                    }
                     else
                        {   $check_email=array();
                            //echo 'dasda';
                            $check_email = $this->Model_apply->getDataEmail($email);
                           
                            if ( $check_email=='')
                            {
                                $this->data['error']='Email Address Not Match';
                                $this->load->view('vForget',$this->data);
                                return false;
                                }
                            else{
                                    foreach ($check_email as $cm) {
                                        $full_name=$cm->full_name;
                                        $email=$cm->email;
                                    }
                                   
                                   $newpassword = random_string('alnum', 8);
                                   $newpass = md5($newpassword);
                                   $updatePass = $this->Model_apply->updateForgetPassword($email,$newpass);
                                  
                                    $this->sendmail($full_name, $email,$newpassword);
                                     $this->data['error']='Please check your email address to get new Password';

                                     $this->load->view('vForget',$this->data);            
                                           
                                }
                        }             
        }
        
        
         function sendmail($full_name,$email,$newpassword)  
            {    
               
      
                $subject = "LSAF - Forget Password ";
                $message_email = "Dear "  .$full_name."<br>";
                $message_email .= "Your signin account is<br>";
                $message_email .= "Email : ".$email."<br>";
                $message_email .= "New Password : ".$newpassword."<br>";
                $message_email .= "Please click Link below to login<br>";
                $message_email .= "<a href=".BASE_URL."/Mylsaf/>";
                $message_email .= BASE_URL."/Mylsaf/"; 
                $message_email .= "</a>";
				
               

                $header = "";
                $header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  
              
                mail($email, $subject, $message_email, $header);
                
                  
            } 
        
}