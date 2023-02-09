<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('backend/Model_menu_frontend', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
	}
	
	public function index()
	{
		$this->data['title'] = "Contact Us";
		include 'checkSession.php'; 
		$this->load->view('vlocation',$this->data);
	}
        
        public function contactUs()
	{
		$this->data['title'] = "Contact";
		include 'checkSession.php';                
                 $full_name = $this->security->xss_clean(secure_input($_POST['full_name'])); 
                 $email = $this->security->xss_clean(secure_input($_POST['email']));                  
                 $phone1 = $this->security->xss_clean(secure_input($_POST['phone1'])); 
                 $phone2 = $this->security->xss_clean(secure_input($_POST['phone2']));
                 $subject  = $this->security->xss_clean(secure_input($_POST['subject']));
                 $message = $this->security->xss_clean(secure_input($_POST['message']));                                    
                
                 $phone = $phone1.$phone2;                 
                $this->form_validation->set_rules('full_name', 'full_name', 'required');
                $this->form_validation->set_rules('phone1', 'phone1', 'required'); 
                $this->form_validation->set_rules('phone2', 'phone2', 'required');
               
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                 $this->form_validation->set_rules('subject', 'subject', 'required');
                  $this->form_validation->set_rules('message', 'message', 'required');
                 //$this->form_validation->set_rules('email', 'Email', 'callback_email_check');
                    if ($this->form_validation->run() == FALSE)
                    {
                     $this->data['notif']='error send contact us';
                     $this->load->view('vlocation',$this->data);
                    }
                     else
                        {   
                         $this->sendmail($full_name,$phone,$email,$subject,$message);
                          $this->data['notif']='Your message has been succesful to send Us, we will replay your mail soon<br/> ';
                         $this->load->view('vlocation',$this->data);             
                        }                                      
              $this->data['notif']='';
              $this->load->view('vlocation',$this->data);                   
		
	}
       function sendmail($full_name,$phone,$email,$subject,$message)  
            {     
       //  $this->load->library('email'); 
      
               $subject = "Contact Us - ".$subject;
				$message_email = "Hi LSAF, <br><br>";
				$message_email .= "Name : ".$full_name."<br>";
				$message_email .= "Phone Number : ".$phone."<br>";
				$message_email .= "Email : ".$email."<br>";
				$message_email .= "Message : ".$message."<br><br>";
			$header = "";
			$header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
			$header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
			$header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
			$header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
			$header .= "X-Priority: 3\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  
                // Insert user record     
                 mail(MAIL_SENDER, $subject, $message_email, $header);   
                // mail("hl.prbadolsa@gmail.com", $subject, $message_email, $header);  
            }  
}