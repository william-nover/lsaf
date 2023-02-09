<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Take_test_ajax extends MY_Controller {
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
		
		$this->load->model(array('web/Model_weekly_exam'));
    }
	
	public function SubmitRadio(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		//$student_id = 7; //dummy
		
		$result = array();
		$status = 0;
		
		$q_id 						= $this->security->xss_clean(secure_input(@$_POST['q_id']));
		//$q_id 						= 12;
		$a_id 						= $this->security->xss_clean(secure_input(@$_POST['a_id']));
		//$a_id 						= 76;
		$groupid 						= $this->security->xss_clean(secure_input(@$_POST['groupid']));
		//$groupid 						= 7;

		if(!empty($q_id) && !empty($a_id) && !empty($groupid)){
			$rsExam	= $this->Model_weekly_exam->getExam($q_id,$student_id,$groupid);
			$countExam 	= count($rsExam);
			
			if($countExam > 0){
				$this->Model_weekly_exam->updateExam($q_id,$a_id,$student_id,$groupid);
			} else {
				$exam_id	= $this->Model_weekly_exam->insertExam($q_id,$a_id,$student_id,$groupid);
			}
			
			$status = 1;
		}
		
		$result['msg'] = "";
		$result['status'] = $status;

		echo json_encode($result);
	}
	
	public function SubmitFinish(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		//$student_id = 7; //dummy
		
		$result = array();
		$status = 0;
		
		$csfr 						= $this->security->xss_clean(secure_input(@$_POST['csfr']));  
		$groupid 					= $this->security->xss_clean(secure_input(@$_POST['groupid']));
		$type 						= $this->security->xss_clean(secure_input(@$_POST['type']));

		if(!empty($csfr) && !empty($student_id) && !empty($groupid) && !empty($type)){
			//get all question
			$getAllQuestion = $this->Model_weekly_exam->getQuestionForExam($groupid,$type);
			$totalAllQuestion = count($getAllQuestion);
			
			//get all question not answered in exam
			$getAllExamQuestionAnswered = $this->Model_weekly_exam->getExamQuestionAnswered($groupid, $student_id);
			$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
			
			$totalAnsweredTrue = 0;
			for($a=0;$a<count($getAllExamQuestionAnswered);$a++){
				$question_id = $getAllExamQuestionAnswered[$a]['weekly_exam_question_id'];
				$answer_id = $getAllExamQuestionAnswered[$a]['weekly_exam_answer_id'];
				$checkAnswer = $this->Model_weekly_exam->checkAnswer($question_id, $answer_id);
				
				if(count($checkAnswer) > 0){
					$answer_status = $checkAnswer[0]['weekly_exam_answer_status'];
					if($answer_status == 1){
						$totalAnsweredTrue += $answer_status;
					}
				}
			}
		
			//Process Result
			$rsExamResult		= $this->Model_weekly_exam->getExamResult($student_id,$groupid);
			$countExamResult 	= count($rsExamResult);
			
			if($countExamResult > 0){
				$attempt = $rsExamResult['0']['attempt'] + 1;
				
				if($attempt < 4){
					$examresult_id	= $this->Model_weekly_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
				}
			} else {
				$attempt = 1;
				$examresult_id	= $this->Model_weekly_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
			}
			
			$status = 1;
			$msg = "Success";
			
			$_SESSION['weekly_test']['exam'][$groupid]['start'] = 3;
		} else {
			$msg = "Parameters incomplete";
		}
		
		$result['attempt'] = $attempt;
		$result['msg'] = $msg;
		$result['status'] = $status;

		echo json_encode($result);
	}
	
	
	public function Timeout(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		//$student_id = 7; //dummy
		
		$groupid 					= $this->security->xss_clean(secure_input(@$_POST['groupid']));
		$type 						= $this->security->xss_clean(secure_input(@$_POST['type']));
		
		$result = array();
		$status = 0;
		
		if(!empty($student_id) && !empty($groupid) && !empty($type)){
			//get all question
			$getAllQuestion = $this->Model_weekly_exam->getQuestionForExam($groupid,$type);
			$totalAllQuestion = count($getAllQuestion);
			
			//get all question not answered in exam
			$getAllExamQuestionAnswered = $this->Model_weekly_exam->getExamQuestionAnswered($groupid, $student_id);
			$totalAllExamQuestionAnswered = count($getAllExamQuestionAnswered);
			
			$totalAnsweredTrue = 0;
			for($a=0;$a<count($getAllExamQuestionAnswered);$a++){
				$question_id = $getAllExamQuestionAnswered[$a]['weekly_exam_question_id'];
				$answer_id = $getAllExamQuestionAnswered[$a]['weekly_exam_answer_id'];
				$checkAnswer = $this->Model_weekly_exam->checkAnswer($question_id, $answer_id);
				
				if(count($checkAnswer) > 0){
					$answer_status = $checkAnswer[0]['weekly_exam_answer_status'];
					if($answer_status == 1){
						$totalAnsweredTrue += $answer_status;
					}
				}
			}
		
			//Process Result
			$rsExamResult		= $this->Model_weekly_exam->getExamResult($student_id,$groupid);
			$countExamResult 	= count($rsExamResult);
			
			if($countExamResult > 0){
				$attempt = $rsExamResult[0]['attempt'] + 1;
				
				if($attempt < 4){
					$examresult_id	= $this->Model_weekly_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
				}
			} else {
				$attempt = 1;
				$examresult_id	= $this->Model_weekly_exam->insertExamResult($student_id,$groupid,$totalAnsweredTrue,$totalAllQuestion,$totalAllExamQuestionAnswered,$attempt);
			}
			
			$status = 1;
			$msg = "Timeout";
			
			$_SESSION['weekly_test']['exam'][$groupid]['start'] = 2;
		} else {
			$msg = "Parameters incomplete";
		}
		
		$result['msg'] = $msg;
		$result['status'] = $status;

		echo json_encode($result);
	}
	
	
	function uploadEssay(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
		include 'checkSession.php';
		
		$student_id 		= $this->data['student_id'];
		$csfr 				= $_POST['csrf']; 
		$groupid 			= $_POST['groupid'];
		
		$output_dir = PATH_ASSETS."/upload/weekly/";
		 
		if(!empty($csfr) && !empty($groupid) ){
			if(isset($_FILES["myfile"])){
				$myfile = $_FILES["myfile"];
				$myfile_size = $myfile['size'];
				$myfile_name = $myfile['name'];
				$myfile_type = $myfile['type'];
				list($txt, $ext) = explode(".", $myfile_name);
				
				$fileName = "essay_".$groupid."_".$student_id."_".date('dmYHis').".".$ext;
				$MAXSIZE = 1024*1024*10; // 10mb
				$ALLOWED =  array('xls','xlsx' ,'doc','docs','pdf');
				
				//Filter the file types , if you want.
				if ($myfile["error"] > 0){
					$msg = "<span style='color:red'>" . $myfile["error"] . "</span>";
				} else {
					if(in_array($ext,$ALLOWED)) {
						if($_FILES['name']['size'] < $MAXSIZE){
							move_uploaded_file($myfile["tmp_name"],$output_dir. $fileName);
							
							//Process Result
							$rsExamResult		= $this->Model_weekly_exam->getExamResultEssay($student_id,$groupid);
							$countExamResult 	= count($rsExamResult);
							
							if($countExamResult > 0){
								$attempt = $rsExamResult[0]['attempt'] + 1;
								
								if($attempt < 4){
									$examresult_id	= $this->Model_weekly_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
									$msg = "Uploaded File : ".$myfile["name"];
								} else {
									$msg = "5"; //"Maximum attempt 3";
								}
							} else {
								$attempt = 1;
								$examresult_id	= $this->Model_weekly_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
								$msg = "Uploaded File : ".$myfile["name"];
							}
							
							$_SESSION['weekly_test']['exam'][$groupid]['start'] = 3;
						} else {
							$msg = "4"; //"Maximum upload file 10 Mb";
						}
					} else {
						$msg = "3"; //"File upload not allowed format";
					}	
				}
			} else {
				$msg = "2"; //"Please select file";
			}
		} else {
			$msg = "1"; //"Parameter incomplete";
		}
		
		echo $msg;
	}
	
	
	public function TimeoutEssay(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
		include 'checkSession.php';
		
		$student_id = $this->data['student_id']; 
		//$student_id = 7; //dummy
		
		$groupid 					= $this->security->xss_clean(secure_input(@$_POST['groupid']));
		$fileName 					= "";
		
		$result = array();
		$status = 0;
		
		if(!empty($groupid)){
			//Process Result
			$rsExamResult		= $this->Model_weekly_exam->getExamResultEssay($student_id,$groupid);
			$countExamResult 	= count($rsExamResult);
			
			if($countExamResult > 0){
				$attempt = $rsExamResult[0]['attempt'] + 1;
				
				if($attempt < 4){
					$examresult_id	= $this->Model_weekly_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
				} 
			} else {
				$attempt = 1;
				$examresult_id	= $this->Model_weekly_exam->insertExamEssay($student_id,$groupid,$fileName,$attempt);
			}
			
			$status = 1;
			$msg = "Timeout";
			
			$_SESSION['weekly_test']['exam'][$groupid]['start'] = 2;
		} else {
			$msg = "Parameters incomplete";
		}
		
		$result['msg'] = $msg;
		$result['status'] = $status;

		echo json_encode($result);
	}
}