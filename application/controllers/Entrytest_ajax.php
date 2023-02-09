<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entrytest_ajax extends MY_Controller {		
	public $data = array();	
	
	public function __construct()	
	{				
		parent::__construct();            
		session_start();            
		if(empty($_SESSION['user_data'])){
			session_destroy();
			redirect(BASE_URL."/signin");
			exit();		
		}       

		$this->load->model(array('web/Model_entry','web/Model_Apply'));
	}	

	public function SubmitRadio(){
		/*if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}*/
		
		include 'checkSession.php';
		
		$signup_id = $this->data['signup_id']; 
		//$signup_id = 13; //dummy
		$group_id = $this->data['entry_group_id']; 
		//$group_id = 1; //dummy
		
		$result = array();
		$status = 0;
		
		$q_id 						= $this->security->xss_clean(secure_input(@$_POST['q_id']));
		$a_id 						= $this->security->xss_clean(secure_input(@$_POST['a_id']));

		if(!empty($q_id) && !empty($a_id)){
			$rsExam	= $this->Model_entry->getExam($q_id,$signup_id,$group_id);
			$countExam 	= count($rsExam);
			
			if($countExam > 0){
				$this->Model_entry->updateExam($q_id,$a_id,$signup_id,$group_id);
			} else {
				$exam_id	= $this->Model_entry->insertExam($q_id,$a_id,$signup_id,$group_id);
			}
			
			$status = 1;
		}
		
		$result['msg'] = "";
		$result['status'] = $status;

		echo json_encode($result);
	}
	
	public function SubmitFinish(){
		/*if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}*/
		
		include 'checkSession.php';
		
		$signup_id = $this->data['signup_id']; 
		//$signup_id = 13; //dummy
		$group_id = $this->data['entry_group_id']; 
		//$group_id = 1; //dummy
		
		$result = array();
		$status = 0;
		
		$csfr 						= $this->security->xss_clean(secure_input(@$_POST['csfr'])); 
		//$csfr 						= 'fffa'; 
		
		if(!empty($csfr) && !empty($signup_id) && !empty($group_id)){
			//get all question
			$getAllQuestion = $this->Model_entry->getQuestionForExam($group_id);
			$totalAllQuestion = count($getAllQuestion);
			
			//get all question not answered in exam
			$getAllExamQuestionAnswered = $this->Model_entry->getExamQuestionAnswered($group_id, $signup_id);
			$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
			
			$totalAnsweredTrue = 0;
			for($a=0;$a<count($getAllExamQuestionAnswered);$a++){
				$question_id = $getAllExamQuestionAnswered[$a]['entry_question_id'];
				$answer_id = $getAllExamQuestionAnswered[$a]['entry_answer_id'];
				$checkAnswer = $this->Model_entry->checkAnswer($question_id, $answer_id);
				
				if(count($checkAnswer) > 0){
					$answer_status = $checkAnswer[0]['entry_answer_status'];
					if($answer_status == 1){
						$totalAnsweredTrue += $answer_status;
					}
				}
			}
		
			//Process Result
			$rsExamResult		= $this->Model_entry->getExamResult($signup_id,$group_id);
			$countExamResult 	= count($rsExamResult);
			
			if($countExamResult > 0){
				$this->Model_entry->updateExamResult($signup_id,$group_id,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered);
			} else {
				$examresult_id	= $this->Model_entry->insertExamResult($signup_id,$group_id,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered);
			}
			
			$this->Model_entry->updateSignUpFinishExam($signup_id);
			
			$score = round(100*($totalAnsweredTrue/$totalAllQuestion), 2);
			$rsPersonal		 	= $this->Model_Apply->getPersonal($signup_id);
			$email_user			= $rsPersonal[0]->email;
			$register_id		= $rsPersonal[0]->register_id;
			
			//Start Send Email to User
			if(!empty($email_user)){
				$subject = "Entry Test";
				$message_email_user = "Dear ".$this->data['full_name'].", <br>";
				$message_email_user .= "The result of your entry test is as follows.<br><br>";
				$message_email_user .= "<b>Score : ".$score."%</b> <br><br>";
				$message_email_user .= "Your result should not be treated as a reflection of your future actual performance in your studies with LSAF.<br>";
				$message_email_user .= "An offer letter will be emailed to you shortly.<br><br>";
				$message_email_user .= "Regards,<br>";
				$message_email_user .= "<b>LSAF Management and Team</b><br>";
				$message_email_user .= "<b>LSAF – Your Key To Global Success</b><br>";
				$message_email_user .= "(LSAF address and phone number)<br>";
				
				$header = "";
				$header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header .= "X-Priority: 3\r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail($email_user, $subject, $message_email_user, $header);
			}
			// End Send Email to User
			
			
			//Start Send Email Invoice to User
			if(!empty($email_user)){
				$subject_inv_user = "One step closer to completing the sign up process";
				$message_inv_user = "Dear ".$this->data['full_name'].", <br>";
				$message_inv_user .= "We greatly appreciate your interest in pursuing the global ACCA qualification with us ! To complete your registration process , <br> do send us the following documents at info@Lsafglobal.com and subsequently our program management will send you a Student Contract for your review and signing : <br>";
				$message_inv_user .= "1. Scan Copy of Passport / National ID (KTP) / Birth Certificate <br>";
				$message_inv_user .= "2. Photograph - Scanned Copy<br>";
				$message_inv_user .= "3. Scan copy of latest Certificates and Transcripts<br>";
                $message_inv_user .= "While this is an online registration process, feel free to visit our campus for consultation with program management team. You can also communicate with us via whatsapp at "; 
				$message_inv_user .= "<b><a href='https://web.whatsapp.com/send?phone=6287785477338&text=Halo, LSAF.'>";
                $message_inv_user .= "+62877 8547 73381";     
				$message_inv_user .= "</a></b><br>";				
				$message_inv_user .= "Thank you and we look forward to welcome you aboard as a ACCA student and part of LSAF Learning Community!<br>";
				$message_inv_user .= "Best Regards, <br>";
                $message_inv_user .= "Tyas Kanti><br>"; 
                $message_inv_user .= "Campus Manager<br>";  
                $message_inv_user .= "LSAF Global<br>";
				$message_inv_user .= "<b>Web :<a href=".BASE_URL.">";
                $message_inv_user .= BASE_URL; 
                $message_inv_user .= "</a></b><br>";
            	$message_inv_user .= "Mall of Indonesia ";
                $message_inv_user .= "Italian Walk Block B no. 36 Kelapa Gading Square<br>";
                $message_inv_user .= "Jl. Raya Boulevard Barat, Kelapa Gading, Jakarta-14240<br>";
                $message_inv_user .= "Tel : 021 293 647 93/96";
				
				$header_inv_user = "";
				$header_inv_user .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header_inv_user .= "X-Priority: 3\r\n";
				$header_inv_user .= "MIME-Version: 1.0\r\n";
				$header_inv_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail($email_user, $subject_inv_user, $message_inv_user, $header_inv_user);	
			}
			// End Send Email Invoice to User
			
			
			//Start Send Email to Admin
			if(!empty($email_user)){
				$subject_admin = "Applicant (".$register_id."/".$this->data['full_name'].")’s Entry Test";
				$message_email_admin = "Dear LSAF Management and Team, <br><br>";
				$message_email_admin .= "The result of applicant (".$register_id."/".$this->data['full_name'].") is as follows.<br><br>";
				$message_email_admin .= "<b>Score : ".$score."%</b> <br><br>";

				$header_admin = "";
				$header_admin .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header_admin .= "X-Priority: 3\r\n";
				$header_admin .= "MIME-Version: 1.0\r\n";
				$header_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail("poltak_tulus@yahoo.co.id", $subject_admin, $message_email_admin, $header_admin);
				// End Send Email to Admin
			}
			
			$status = 1;
			$msg = "Success";
			
			$_SESSION['entry_test']['start'] = 3;
		} else {
			$msg = "Parameters incomplete";
		}
		
		$result['msg'] = $msg;
		$result['status'] = $status;

		echo json_encode($result);
	}
	
	
	public function Timeout(){
		/*if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}*/
		
		include 'checkSession.php';
		
		$signup_id = $this->data['signup_id']; 
		//$signup_id = 13; //dummy
		$group_id = $this->data['entry_group_id']; 
		//$group_id = 1; //dummy
		
		$result = array();
		$status = 0;
		
		if(!empty($signup_id) && !empty($group_id)){
			//get all question
			$getAllQuestion = $this->Model_entry->getQuestionForExam($group_id);
			$totalAllQuestion = count($getAllQuestion);
			
			//get all question not answered in exam
			$getAllExamQuestionAnswered = $this->Model_entry->getExamQuestionAnswered($group_id, $signup_id);
			$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
			
			$totalAnsweredTrue = 0;
			for($a=0;$a<count($getAllExamQuestionAnswered);$a++){
				$question_id = $getAllExamQuestionAnswered[$a]['entry_question_id'];
				$answer_id = $getAllExamQuestionAnswered[$a]['entry_answer_id'];
				$checkAnswer = $this->Model_entry->checkAnswer($question_id, $answer_id);
				
				if(count($checkAnswer) > 0){
					$answer_status = $checkAnswer[0]['entry_answer_status'];
					if($answer_status == 1){
						$totalAnsweredTrue += $answer_status;
					}
				}
			}
		
			//Process Result
			$rsExamResult		= $this->Model_entry->getExamResult($signup_id,$group_id);
			$countExamResult 	= count($rsExamResult);
			
			if($countExamResult > 0){
				$this->Model_entry->updateExamResult($signup_id,$group_id,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered);
			} else {
				$examresult_id	= $this->Model_entry->insertExamResult($signup_id,$group_id,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered);
			}
			
			$this->Model_entry->updateSignUpFinishExam($signup_id);
			
			$score = round(100*($totalAnsweredTrue/$totalAllQuestion), 2);
			$rsPersonal		 	= $this->Model_Apply->getPersonal($signup_id);
			$email_user			= $rsPersonal[0]->email;
			$register_id		= $rsPersonal[0]->register_id;
			
			//Start Send Email to User
			if(!empty($email_user)){
				$subject = "Entry Test";
				$message_email_user = "Dear ".$this->data['full_name'].", <br>";
				$message_email_user .= "The result of your entry test is as follows.<br><br>";
				$message_email_user .= "<b>Score : ".$score."%</b> <br><br>";
				$message_email_user .= "Your result should not be treated as a reflection of your future actual performance in your studies with LSAF.<br>";
				$message_email_user .= "An offer letter will be emailed to you shortly.<br><br>";
				$message_email_user .= "Regards,<br>";
				$message_email_user .= "<b>LSAF Management and Team</b><br>";
				$message_email_user .= "<b>LSAF – Your Key To Global Success</b><br>";
				$message_email_user .= "(LSAF address and phone number)<br>";
				
				$header = "";
				$header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header .= "X-Priority: 3\r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail($email_user, $subject, $message_email_user, $header);
			}
			// End Send Email to User
			
			
			//Start Send Email Invoice to User
			if(!empty($email_user)){
				$subject_inv_user = "Invoice Installment";
				$message_inv_user = "Dear ".$this->data['full_name'].", <br>";
				$message_inv_user .= "You are one step closer to completing the Sign Up process. Kindly find the attached invoice and complete the stated requirements. We will contact you as soon as we receiveconfirmation that the requirements have been met.<br><br>";
				$message_inv_user .= "We highly appreciate your interest in pursuing an international qualification with us and are looking forward to having you as a part of London School of Accountancy & Finance.<br><br>";
				$message_inv_user .= "Regards,<br>";
				$message_inv_user .= "<b>LSAF Management and Team</b><br>";
				$message_inv_user .= "<b>LSAF – Your Key To Global Success</b><br>";
				$message_inv_user .= "(LSAF address and phone number)<br>";
				
				$header_inv_user = "";
				$header_inv_user .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_inv_user .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header_inv_user .= "X-Priority: 3\r\n";
				$header_inv_user .= "MIME-Version: 1.0\r\n";
				$header_inv_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail($email_user, $subject_inv_user, $message_inv_user, $header_inv_user);	
			}
			// End Send Email Invoice to User
			
			
			//Start Send Email to Admin
			if(!empty($email_user)){
				$subject_admin = "Applicant (".$register_id."/".$this->data['full_name'].")’s Entry Test";
				$message_email_admin = "Dear LSAF Management and Team, <br><br>";
				$message_email_admin .= "The result of applicant (".$register_id."/".$this->data['full_name'].") is as follows.<br><br>";
				$message_email_admin .= "<b>Score : ".$score."%</b> <br><br>";

				$header_admin = "";
				$header_admin .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
				$header_admin .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
				$header_admin .= "X-Priority: 3\r\n";
				$header_admin .= "MIME-Version: 1.0\r\n";
				$header_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				mail("poltak_tulus@yahoo.co.id", $subject_admin, $message_email_admin, $header_admin);
				// End Send Email to Admin
			}
			
			$status = 1;
			$msg = "Timeout";
			
			$_SESSION['entry_test']['start'] = 2;
		} else {
			$msg = "Parameters incomplete";
		}
		
		$result['msg'] = $msg;
		$result['status'] = $status;

		echo json_encode($result);
	}
}