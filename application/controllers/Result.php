<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends MY_Controller {
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
		
		$this->load->model(array('backend/Model_menu_frontend', 'web/Model_result'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
		$this->load->library(array('form_validation'));
		$this->data['menu_left'] =  $this->uri->segment(1);            
    }
	
	function index(){  
		include 'checkSession.php';
		
		$this->data['title'] =  $this->uri->segment(1);
		$this->data['metacontent']='London School of Accoutancy And Finance';
		$this->data['metadesc']='Student E_learning  pages';
		$this->data['metaurl'] = current_url(); 
		 
		if ($this->data["step"]==''){        
			redirect(BASE_URL.'/Signup');
		} else if ($this->data["step"]== 3){
			$student_id = $this->data['student_id']; 
			
			
			$rsProgressExamSubject		= $this->Model_result->getProgressExamSubject($student_id);
			$countProgressExamSubject		= count($rsProgressExamSubject);
			
			if($countProgressExamSubject > 0){
				foreach($rsProgressExamSubject as $key => $progressyexamsubject){ 
					$rsProgressExamResult		= $this->Model_result->getProgressExamResult($progressyexamsubject['progress_exam_group_id'], $student_id);
					$rsProgressExamSubject[$key]['result'] = $rsProgressExamResult;
					
					$rsProgressExamResultEssay		= $this->Model_result->getProgressExamResultEssay($progressyexamsubject['progress_exam_group_id'], $student_id);
					$rsProgressExamSubject[$key]['result_essay'] = $rsProgressExamResultEssay;
				}
			}
			
			$this->data["rsProgressExamSubject"] = $rsProgressExamSubject;
			$this->data["countProgressExamSubject"] = $countProgressExamSubject;
			
			
			$rsMockExamSubject		= $this->Model_result->getMockExamSubject($student_id);
			$countMockExamSubject		= count($rsMockExamSubject);
			
			if($countMockExamSubject > 0){
				foreach($rsMockExamSubject as $key => $mockyexamsubject){ 
					$rsMockExamResult		= $this->Model_result->getMockExamResult($mockyexamsubject['mock_exam_group_id'], $student_id);
					$rsMockExamSubject[$key]['result'] = $rsMockExamResult;
					
					$rsMockExamResultEssay		= $this->Model_result->getMockExamResultEssay($mockyexamsubject['mock_exam_group_id'], $student_id);
					$rsMockExamSubject[$key]['result_essay'] = $rsMockExamResultEssay;
				}
			}
			
			$this->data["rsMockExamSubject"] = $rsMockExamSubject;
			$this->data["countMockExamSubject"] = $countMockExamSubject;
			
			
			
			$rsWeeklyExamSubject		= $this->Model_result->getWeeklyExamSubject($student_id);
			$countWeeklyExamSubject		= count($rsWeeklyExamSubject);
			
			if($countWeeklyExamSubject > 0){
				foreach($rsWeeklyExamSubject as $key => $weeklyexamsubject){ 
					$rsWeeklyExamResult		= $this->Model_result->getWeeklyExamResult($weeklyexamsubject['weekly_exam_group_id'], $student_id);
					$rsWeeklyExamSubject[$key]['result'] = $rsWeeklyExamResult;
					
					$rsWeeklyExamResultEssay		= $this->Model_result->getWeeklyExamResultEssay($weeklyexamsubject['weekly_exam_group_id'], $student_id);
					$rsWeeklyExamSubject[$key]['result_essay'] = $rsWeeklyExamResultEssay;
				}
			}
			
			$this->data["rsWeeklyExamSubject"] = $rsWeeklyExamSubject;
			$this->data["countWeeklyExamSubject"] = $countWeeklyExamSubject;
			
			$this->load->view('vResult',$this->data);  
		} elseif ($this->data["step"] == 1 || $this->data["step"]> 2 ) {
			redirect(BASE_URL.'/Mylsaf');
		}
	}              
}