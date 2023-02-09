<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress_test extends MY_Controller {
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
		
		$this->load->model(array('backend/Model_menu_frontend', 'web/Model_progress_exam'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
		$this->data['menu_left'] =  $this->uri->segment(1);
    }
	
	
	public function Start($groupid="", $type=""){       
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		
		if ($this->data["step"]==''){        
			redirect(BASE_URL.'/Signup');
		} else if ($this->data["step"]== 3){
			if(!empty($groupid) && !empty($type)){
				
				unset($_SESSION['progress_test']['exam']); 
				
				$session_start = @$_SESSION['progress_test']['exam'][$groupid]['start'];
				$session_type = @$_SESSION['progress_test']['exam'][$groupid]['type'];

				if($session_start == 2 || $session_start == 3){
					if($session_type != $type){
						unset($_SESSION['progress_test']['exam'][$groupid]);
					}
				}
				
				$rsAllQuestion		= array();
				$timer 	 			= 0;
				$percenProgress		= 0;
				$rsGetTimer		 	= $this->Model_progress_exam->getGroup($groupid);
				$subject_title		= @$rsGetTimer[0]['subject_title'];
				
				if (count($rsGetTimer) > 0) {
					if($type == 1){
						$timer = $rsGetTimer[0]['progress_exam_group_timer'];
					} else {
						$timer = $rsGetTimer[0]['progress_exam_group_timer_essay'];
					}
				} else{
					redirect(BASE_URL.'/Take_test');
				}
				$this->data["timer"] = $timer;
				
				$where 				= "";
				$orderBy 			= "";
				$cond 				= "";
				
				$where 				.= " WHERE progress_exam_question_active_status = 1 AND progress_exam_question_type = ".$type." AND progress_exam_group_id = ".$groupid."";
				$orderBy 			.= " ORDER BY progress_exam_question_id ASC";
				$cond 				.= $where." ".$orderBy;
				
				$rsExam 			= $this->Model_progress_exam->getQuestion($cond);
				$base_url			= BASE_URL."/Progress_test/Start/";
				$total_rows			= count($rsExam);
				if($type == 1){
					$per_page			= 1;
				} else {
					$per_page			= $total_rows;
				}
				
				$this->data['paging']		= pagging_frontend($base_url , $total_rows, $per_page, 4);
				$page = ($this->uri->segment(4)) ? $this->uri->segment(5) : 1;
				$start = $per_page*$page - $per_page;
				if ($start<0) $start = 0;
				$cond .= " LIMIT ".$start.",".$per_page;
				
				$rsExam 			= $this->Model_progress_exam->getQuestion($cond);
				if (count($rsExam) > 0) {
					foreach($rsExam as $key => $question){
						$rsAnswer = $this->Model_progress_exam->getAnswer($question['progress_exam_question_id']);
						
						if (count($rsAnswer) > 0) {
							foreach($rsAnswer as $keyAnswer => $answer){
								$rsExam[$key]['answer'][$keyAnswer]['progress_exam_answer_id'] = $answer['progress_exam_answer_id'];
								$rsExam[$key]['answer'][$keyAnswer]['progress_exam_answer_title'] = $answer['progress_exam_answer_title'];
								
								$rsExamAnsweredChoose = $this->Model_progress_exam->getExamAnswered($question['progress_exam_question_id'],$answer['progress_exam_answer_id'],$student_id);
								if (count($rsExamAnsweredChoose) > 0) {
									$rsExam[$key]['answer'][$keyAnswer]['is_answered'] = 1;
								} else {
									$rsExam[$key]['answer'][$keyAnswer]['is_answered'] = 0;
								}
							}
						}
					}
					
					$getAllQuestion = $this->Model_progress_exam->getQuestionForExam($groupid,$type);
					$totalAllQuestion = count($getAllQuestion);
					
					$no = 1;
					if($totalAllQuestion > 0){
						for($a=0;$a<count($getAllQuestion);$a++){
							$rsAllQuestion[$a]['no'] = $no;
							
							$question_id = $getAllQuestion[$a]['progress_exam_question_id'];
							$getExamQuestionCheckAnswered = $this->Model_progress_exam->getExamQuestionCheckAnswered($question_id, $groupid, $student_id);
							$totalExamQuestionCheckAnswered = count($getExamQuestionCheckAnswered); 
							
							if($totalExamQuestionCheckAnswered > 0){
								$rsAllQuestion[$a]['is_answered'] = 1;
							} else {
								$rsAllQuestion[$a]['is_answered'] = 0;
							}
							
							$no++;
						}
					}
					
					$getAllExamQuestionAnswered = $this->Model_progress_exam->getExamQuestionTotalAnswered($groupid, $student_id);
					$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
					
					$percenProgress = round(($totalAllExamQuestionAnswered/$totalAllQuestion) * 100, 2);
				}
				
				if(!empty($page)){
					$page = $this->uri->segment(5);
				}else{
					$page = 1;
				}
				
				if(empty($_SESSION['progress_test']['exam'][$groupid]['start'])){
					$now = date('Y-m-d H:i:s');
					$_SESSION['progress_test']['exam'][$groupid]['start'] = 1;
					
					$expired_timer = date('Y-m-d H:i:s', time() + $timer);	
					
					$_SESSION['progress_test']['exam'][$groupid]['expired_timer'] 	= $expired_timer;
					$_SESSION['progress_test']['exam'][$groupid]['now_timer'] 		= $now;
				} else  {
					$balance_timer = strtotime($_SESSION['progress_test']['exam'][$groupid]['expired_timer']) - strtotime(date('Y-m-d H:i:s'));
					$_SESSION['progress_test']['exam'][$groupid]['balance_timer'] = $balance_timer;
					
					if($_SESSION['progress_test']['exam'][$groupid]['balance_timer'] < 1){
						$_SESSION['progress_test']['exam'][$groupid]['start'] = 2; //if timeout
					}
					
					if($_SESSION['progress_test']['exam'][$groupid]['start'] == 2 || $_SESSION['progress_test']['exam'][$groupid]['start'] == 3){
						if($_SESSION['progress_test']['exam'][$groupid]['start'] == 2){							
							$this->Timeout($type,$groupid);
						}
						redirect(BASE_URL.'/Progress_test/Finish');
						exit();
					}
				}
				
				$arrTimer = explode(" ",$_SESSION['progress_test']['exam'][$groupid]['expired_timer']);
				$arrTimer1 = explode("-",$arrTimer[0]);
				$arrTimer2 = explode(":",$arrTimer[1]);
				$resultTimer = array_merge($arrTimer1, $arrTimer2);
				$this->data["arrTimer"] = $resultTimer;
				$this->data["now"] = $_SESSION['progress_test']['exam'][$groupid]['now_timer'];
				
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
				$this->data["subject_title"] = $subject_title;
				$this->data["groupid"] = $groupid;
				$this->data["type"] = $type;
				
				$_SESSION['progress_test']['exam'][$groupid]['groupid'] = $groupid;
				$_SESSION['progress_test']['exam'][$groupid]['type'] = $type;
				$_SESSION['progress_test']['exam'][$groupid]['subject_title'] = $subject_title;
				
				$this->load->view('vProgressTestStart',$this->data);
			} else {
				redirect(BASE_URL.'/Take_test');
			}
		} elseif ($this->data["step"] == 1 || $this->data["step"]> 2 ) {
			redirect(BASE_URL.'/Mylsaf');
		}
	}
	
	function Finish(){ 	
		include 'checkSession.php';
		
		$message = "Your test is finish. Please <a href='".BASE_URL."/Result'>click in here</a> to check your result in Dashboard.";

		$this->data["message"] = $message;
		
		$this->load->view('vMockTestFinish',$this->data);
	}	
	
	function Timeout($type,$groupid){ 	
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		
		if(!empty($student_id) && !empty($groupid) && !empty($type)){
			if($type == 1){
				//get all question
				$getAllQuestion = $this->Model_progress_exam->getQuestionForExam($groupid,$type);
				$totalAllQuestion = count($getAllQuestion);
				
				//get all question not answered in exam
				$getAllExamQuestionAnswered = $this->Model_progress_exam->getExamQuestionAnswered($groupid, $student_id);
				$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
				
				$totalAnsweredTrue = 0;
				for($a=0;$a<count($getAllExamQuestionAnswered);$a++){
					$question_id = $getAllExamQuestionAnswered[$a]['mock_exam_question_id'];
					$answer_id = $getAllExamQuestionAnswered[$a]['mock_exam_answer_id'];
					$checkAnswer = $this->Model_progress_exam->checkAnswer($question_id, $answer_id);
					
					if(count($checkAnswer) > 0){
						$answer_status = $checkAnswer[0]['mock_exam_answer_status'];
						if($answer_status == 1){
							$totalAnsweredTrue += $answer_status;
						}
					}
				}
			
				//Process Result
				$rsExamResult		= $this->Model_progress_exam->getExamResult($student_id,$groupid);
				$countExamResult 	= count($rsExamResult);
				
				if($countExamResult > 0){
					$attempt = $rsExamResult[0]['attempt'] + 1;
					
					if($attempt < 4){
						$examresult_id	= $this->Model_progress_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
					}
				} else {
					$attempt = 1;
					$examresult_id	= $this->Model_progress_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
				}
				
				$_SESSION['progress_test']['exam'][$groupid]['start'] = 2;
			} else {
				$fileName = "";
				
				//Process Result
				$rsExamResult		= $this->Model_progress_exam->getExamResultEssay($student_id,$groupid);
				$countExamResult 	= count($rsExamResult);
				
				if($countExamResult > 0){
					$attempt = $rsExamResult[0]['attempt'] + 1;
					
					if($attempt < 4){
						$examresult_id	= $this->Model_progress_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
					} 
				} else {
					$attempt = 1;
					$examresult_id	= $this->Model_progress_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
				}
				
				$_SESSION['progress_test']['exam'][$groupid]['start'] = 2;
			}
		}
	}
}