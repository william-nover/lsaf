<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entrytest extends MY_Controller {		
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
		$this->load->model(array('backend/Model_menu_frontend','web/Model_Apply','web/Model_entry','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
		$this->load->library(array('form_validation'));
	}		
	
	function index(){ 		
		include 'checkSession.php';
		
		$this->data['Menu_all'] = $this->Model_menu_frontend->GenerateMenu();
		
		if($this->data['step']==''){
			redirect(BASE_URL.'/Signup');
		}else if($this->data['step'] != 1 ){
			redirect(BASE_URL.'/Mylsaf');
		}else if($this->data['step']==1){
			if($_SESSION['entry_test']['start'] == 1){
				redirect(BASE_URL.'/Entrytest/Start');
				exit();
			} else if($_SESSION['entry_test']['start'] == 2 || $_SESSION['entry_test']['start'] == 3){
				redirect(BASE_URL.'/Entrytest/Finish');
				exit();
			}
			
			/*$rsDt = $this->Model_entry->getEntryTest($this->data['signup_id']);
			
			if( count($rsDt) < 1){
				$rsDt = $this->Model_entry->createEntryTest($this->data['signup_id']);
			}else{
				if( $rsDt['entry_test_status'] == 0 ){
					//echo "silahkan ambil test";
				} else if( $rsDt['entry_test_status'] == 1 ) {
					echo "silahkan lanjutkan test anda";
				} else if( $rsDt['entry_test_status'] == 2 ) {
					echo "Anda sudaj ambil test ini, silahkan tunggu hasil by email";
				}
			}*/
				
			$this->load->view('vEntryTest',$this->data);
		}
	}
	
	function Start(){ 	
		include 'checkSession.php';
		
		//unset($_SESSION['entry_test']); 

		$signup_id = $this->data['signup_id']; 
		//$signup_id = 13; //dummy
		$group_id = $this->data['entry_group_id']; 
		//$group_id = 1; //dummy
		
		$rsAllQuestion		= array();
		$timer 	 			= 0;
		$percenProgress		= 0;
		$rsGetTimer		 	= $this->Model_entry->getGroupSignUp($group_id, $signup_id);
		
		if (count($rsGetTimer) > 0) {
			$timer = $rsGetTimer[0]['entry_group_timer'];
		} else{
			redirect(BASE_URL."/home");
		}
		$this->data["timer"] = $timer;
		
		
		$where 				= "";
		$orderBy 			= "";
		$cond 				= "";
		
		$where 				.= " WHERE entry_question_active_status = 1 AND entry_group_id = ".$group_id."";
		$orderBy 			.= " ORDER BY entry_question_order ASC, entry_question_id ASC ";
		$cond 				.= $where." ".$orderBy;
		
		$rsExam 			= $this->Model_entry->getQuestion($cond);
		$base_url			= BASE_URL."/Entrytest/Start/";
		$total_rows			= count($rsExam);
		$per_page			= 1;
		
		$this->data['paging']		= pagging_frontend($base_url , $total_rows, $per_page, 3);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		
		$rsExam 			= $this->Model_entry->getQuestion($cond);
		if (count($rsExam) > 0) {
			foreach($rsExam as $key => $question){
				$rsAnswer = $this->Model_entry->getAnswer($question['entry_question_id']);
				
				if (count($rsAnswer) > 0) {
					foreach($rsAnswer as $keyAnswer => $answer){
						$rsExam[$key]['answer'][$keyAnswer]['entry_answer_id'] = $answer['entry_answer_id'];
						$rsExam[$key]['answer'][$keyAnswer]['entry_answer_title'] = $answer['entry_answer_title'];
						
						$rsExamAnsweredChoose = $this->Model_entry->getExamAnswered($question['entry_question_id'],$answer['entry_answer_id'],$signup_id);
						if (count($rsExamAnsweredChoose) > 0) {
							$rsExam[$key]['answer'][$keyAnswer]['is_answered'] = 1;
						} else {
							$rsExam[$key]['answer'][$keyAnswer]['is_answered'] = 0;
						}
					}
				}
			}
		
		
			$getAllQuestion = $this->Model_entry->getQuestionForExam($group_id);
			$totalAllQuestion = count($getAllQuestion);
			
			
			$no = 1;
			if($totalAllQuestion > 0){
				for($a=0;$a<count($getAllQuestion);$a++){
					$rsAllQuestion[$a]['no'] = $no;
					
					$question_id = $getAllQuestion[$a]['entry_question_id'];
					$getExamQuestionCheckAnswered = $this->Model_entry->getExamQuestionCheckAnswered($question_id, $group_id, $signup_id);
					$totalExamQuestionCheckAnswered = count($getExamQuestionCheckAnswered); 
					
					if($totalExamQuestionCheckAnswered > 0){
						$rsAllQuestion[$a]['is_answered'] = 1;
					} else {
						$rsAllQuestion[$a]['is_answered'] = 0;
					}
					
					$no++;
				}
			}
			
			$getAllExamQuestionAnswered = $this->Model_entry->getExamQuestionTotalAnswered($group_id, $signup_id);
			$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
			
			$percenProgress = round(($totalAllExamQuestionAnswered/$totalAllQuestion) * 100, 2);
		}
		
		if(!empty($page)){
			$page = $this->uri->segment(3);
		}else{
			$page = 1;
		}
		
		
		if(empty($_SESSION['entry_test']['start'])){
			$now = date('Y-m-d H:i:s');
			$_SESSION['entry_test']['start'] = 1;
			
			$expired_timer = date('Y-m-d H:i:s', time() + $timer);	
			
			$_SESSION['entry_test']['expired_timer'] 	= $expired_timer;
			$_SESSION['entry_test']['now_timer'] 		= $now;
		} else  {
			$balance_timer = strtotime($_SESSION['entry_test']['expired_timer']) - strtotime(date('Y-m-d H:i:s'));
			$_SESSION['entry_test']['balance_timer'] = $balance_timer;
			
			if($_SESSION['entry_test']['balance_timer'] < 1){
				$_SESSION['entry_test']['start'] = 2; //if timeout
			}
			
			if($_SESSION['entry_test']['start'] == 2 || $_SESSION['entry_test']['start'] == 3){
				if($_SESSION['entry_test']['start'] == 2){
					$this->Timeout();
				}
				redirect(BASE_URL.'/Entrytest/Finish');
				exit();
			}
		}
		
		$arrTimer = explode(" ",$_SESSION['entry_test']['expired_timer']);
		$arrTimer1 = explode("-",$arrTimer[0]);
		$arrTimer2 = explode(":",$arrTimer[1]);
		$resultTimer = array_merge($arrTimer1, $arrTimer2);
		$this->data["arrTimer"] = $resultTimer;
		$this->data["now"] = $_SESSION['entry_test']['now_timer'];
		
		$pageNext = $page + 1;
		$TotalPage = floor($total_rows / 1);
		
		$length = 15;
		$csrfString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		
		$this->data['AllQuestion'] = $rsAllQuestion;
		$this->data['Exam'] = $rsExam;
		$this->data['countExam'] = count($rsExam);
		$this->data["TotalQuestion"] = $total_rows;
		$this->data["TotalPage"] = $TotalPage;
		$this->data["page"] = $page;
		$this->data["pageNext"] = $pageNext;
		$this->data["csrfString"] = $csrfString;
		$this->data["percenProgress"] = $percenProgress;
		
		$this->load->view('vEntryTestStart',$this->data);
	}
	
	public function Timeout(){
		include 'checkSession.php';
		
		$signup_id = $this->data['signup_id']; 
		//$signup_id = 13; //dummy
		$group_id = $this->data['entry_group_id']; 
		//$group_id = 1; //dummy
		
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
			
			$score = round(100*($totalAnsweredTrue/$totalAllQuestion), 2);
			$rsPersonal		 	= $this->Model_Apply->getPersonal($signup_id);
			$email_user			= $rsPersonal[0]->email;
			$register_id		= $rsPersonal[0]->register_id;
			
			//Start Send Email to User
			if(!empty($email_user)){
				$subject = "Entry Test";
				$message_email_user = "Dear ".$this->data['full_name'].", <br>";
				$message_email_user .= "Greetings from London School of Accountancy and Finance<br><br>";
				$message_email_user .= "<b>Your entry test result is : ".$score."%</b> <br><br>";
				$message_email_user .= "To discuss your result, do set appointment with our program management team via whatsapp at +62 877 8547 7338.<br>";
				$message_email_user .= "You will receive an email shortly on completing the sign up process.<br><br>";
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
				$subject_inv_user = "LSAF - Registration Documents";
				$message_inv_user = "Dear ".$this->data['full_name'].", <br>";
				$message_inv_user .= "Greetings from London School of Accountancy and Finance (LSAF).<br>";
				$message_inv_user .= "We greatly appreciate your interest in pursuing the global ACCA qualification with us ! To complete your registration process , do send us the following documents at info@Lsafglobal.com and subsequently our program management will send you a Student Contract for your review and signing : <br><br>";
				$message_inv_user .= "1. Scan Copy of Passport / National ID (KTP) / Birth Certificate<br>"; 
                $message_inv_user .= "2. Passport size photograph<br>";  
                $message_inv_user .= "3. Scan copy of latest Certificates and Transcripts ,<br>";                                
                $message_inv_user .= "While this is an online registration process, feel free to visit our campus for consultation with program management team. You can also communicate with us via whatsapp at +62877 8547 7338.<br>"; 
                                
				$message_inv_user .= "<b>Thank you and we look forward to welcome you aboard as a ACCA student and part of LSAF Learning Community! </b><br>";
				$message_inv_user .= "<b>Best Regards, </b><br>";
                $message_inv_user .= "<b>Tyas Kanti</b><br>"; 
                $message_inv_user .= "<b>Campus Manager</b><br>"; 
                $message_inv_user .= "<b>LSAF Global</b><br>"; 
				$message_inv_user .= "<b>Mall Of Indonesia<br>";
                $message_inv_user .= "Italian Walk Block B no. 36 Kelapa Gading Square </b><br>";
                $message_inv_user .= "<b>Jl. Raya Boulevard Barat, Kelapa Gading, Jakarta-14240 </b><br>";
                $message_inv_user .="<b>021-29364793 / 96</b><br>";
                $message_inv_user .= "<b><a href=".BASE_URL.">";
                $message_inv_user .= BASE_URL; 
                $message_inv_user .= "</a></b><br>";
				
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
			
				mail(MAIL_SENDER, $subject_admin, $message_email_admin, $header_admin);
				// End Send Email to Admin
			}
			
			$_SESSION['entry_test']['start'] = 2;
		} else {
			$msg = "Parameters incomplete";
		}
	}
	
	
	function Finish(){ 	
		include 'checkSession.php';
		
		$message = "";
		if($_SESSION['entry_test']['start'] == 2){
			$message = "Your test is finish because timeout. Please check your email adderess.";
		} else if($_SESSION['entry_test']['start'] == 3){
			$message = "Your test is finish. Please check your email adderess.";
		}
		
		$this->data["message"] = $message;
		$this->load->view('vEntryTestFinish',$this->data);
	}	
}