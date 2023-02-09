<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ask_question extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('backend/Model_menu_frontend','web/Model_ask_question','backend/Model_logcms'));
				$this->load->helper(array('funcglobal','menu','accessprivilege','alias','email'));  
				$this->data['menu_left'] =  $this->uri->segment(1);	
				 $this->data['title'] =  $this->uri->segment(1);
				 $this->data['metacontent']='London School of Accoutancy And Finance';
				 $this->data['metadesc']='Student E_learning  pages';
				 $this->data['metaurl'] = current_url();				
                error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
                
        }
	
	public function index()
	{       
			  

             include 'checkSession.php'; 
            $ListSubject = $this->Model_ask_question->getSubject($this->data["student_id"]); 
            $this->data['notif']='';
            $this->data['ListSubject']=$ListSubject;
            $this->load->view('VAsk_question',$this->data);     
            
	}
    
         function sendQuestion()
	{
		$this->data['title'] = "Home";
		include 'checkSession.php';
                 if ($_POST) {
                $ListSubject = $this->Model_ask_question->getSubject($this->data["student_id"]); 
                $this->data['ListSubject']=$ListSubject;
                $email= $this->data["email"];
                $full_name= $this->data["full_name"];
                
                 $subject_id = $this->security->xss_clean(secure_input($_POST['subject_id']));
                 $question_subject = $this->security->xss_clean(secure_input($_POST['question_subject'])); 
                 $question_detail = $this->security->xss_clean(secure_input($_POST['question_detail']));                  
                 
                
                 $this->form_validation->set_rules('question_subject', 'question_subject', 'required');
                 $this->form_validation->set_rules('question_detail', 'question_detail', 'required');

                  if ($this->form_validation->run() == FALSE)
                    {
                     $this->data['notif']='error send Message';
                     $this->load->view('VAsk_question',$this->data);
                    }
                     else
                        { 
                         
                         $getLecturerEmail=$this->Model_ask_question->getEmail($subject_id);   
                         foreach ($getLecturerEmail as $le) {
                          $lecturerEmail = $le->lecturer_email;  
                         }
                        
                        
                        $this->sendmail($full_name,$lecturerEmail,$email,$question_subject,$question_detail);
                        $this->sendmailCC($full_name,$lecturerEmail,$email,$question_subject,$question_detail);
                        $this->data['notif']='Your message has been succesful to send, your Lecturer will answere your guestions  soon<br/> ';
                        $this->load->view('VAsk_question',$this->data);             
                        }                                      
              $this->data['notif']='';        
              $this->load->view('VAsk_question',$this->data); 
               }
               else{
                   redirect(BASE_URL.'/Ask_question');
               }
	}   
       function sendmail($full_name,$lecturerEmail,$email,$subject,$message)  
            {     
       //  $this->load->library('email'); 
     
               $subject = "Question - ".$subject;
				$message_email = "Question from, <br><br>";
				$message_email .= "Name : ".$full_name."<br>";
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
                 mail($lecturerEmail, $subject, $message_email, $header);   
                // mail("hl.prbadolsa@gmail.com", $subject, $message_email, $header);  
            }  
            
            
             function sendmailCC($full_name,$lecturerEmail,$email,$subject,$message)  
            {     
       //  $this->load->library('email'); 
     
               $subject = "Question - ".$subject;
				$message_email = "Question from, <br><br>";
				$message_email .= "Name : ".$full_name."<br>";
				$message_email .= "Email : ".$email."<br>";
				$message_email .= "To : ".$lecturerEmail."<br>";
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