<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress_exam_question extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 13; //get module group id from database
	public $module_id = 36; //get module id from database
	public $module = "Progress Exam Question";

	public function __construct(){
		parent::__construct();
               
		session_start();

		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}

		$this->load->model(array('backend/Model_progressexamquestion','backend/Model_progressexamgroup','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege'));

		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
        $this->data['ListMenu'] = $this->arrMenu;
        $this->data['CountMenu'] = count($this->arrMenu);

		//check privilege module
		$this->privilege = accessprivilegeuserlevel($_SESSION['admin_data']['user_level_id'], $this->module_id);
		$this->breadcrump = breadCrump($this->module_id);
	}


	public function index(){
		$this->view();
	}


	function view(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
	
		$searchkey = "";
		$searchby = "";
		$searchkeynew = "";
		$where = "";
		$orderBy = "";
		$perpage = "";

		if(isset($_POST["tbSearch"])){
			$_SESSION["searchkey".$this->module_id] = '';
			$_SESSION["searchby".$this->module_id] = '';
			$_SESSION["perpage".$this->module_id] = '';

			
			$searchkey = $this->security->xss_clean(secure_input($_POST['searchkey']));
			$searchby = $this->security->xss_clean(secure_input($_POST['searchby']));
			$perpage = $this->security->xss_clean(secure_input($_POST['perpage']));
			
			$pesan = array();

			if ($searchkey=="") {
				$pesan[] = 'Keyword search is empty';
			} else if ($searchby=="") {
				$pesan[] = 'Search by has not been choose';
			}


			if (! count($pesan)==0 ) {
				foreach ($pesan as $indeks=>$pesan_tampil) {
					$_SESSION["searchkey".$this->module_id] = '';
					$_SESSION["searchby".$this->module_id] = '';
					$_SESSION["perpage".$this->module_id] = '';
					$this->data['error'] = $pesan_tampil;
				}
			} else {
				$_SESSION["searchkey".$this->module_id] = $searchkey;
				$_SESSION["searchby".$this->module_id] = $searchby;
				$_SESSION["perpage".$this->module_id] = $perpage;

				if(isset($_POST['searchkey'])){
					$searchkey = $_SESSION["searchkey".$this->module_id];
				}

				if(isset($_POST['searchby'])){
					$searchby = $_SESSION["searchby".$this->module_id];
				}

				if($searchkey != "" && $searchby != ""){
					$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
				}
			}	
		} else {
			$searchkey = @$_SESSION["searchkey".$this->module_id];
			$searchby = @$_SESSION["searchby".$this->module_id];

			if($searchkey != "" && $searchby != ""){
				$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
			}

			if(isset($_POST['perpage'])){
				$perpage = $this->security->xss_clean(secure_input($_POST['perpage'])); 
				$_SESSION["perpage".$this->module_id] = $perpage;
			} else {
				$perpage = @$_SESSION["perpage".$this->module_id];

				if($perpage == ""){
					$perpage = PER_PAGE;
				}
			}
		}

		$orderBy = "ORDER BY a.progress_exam_group_id DESC, a.progress_exam_question_type DESC, a.progress_exam_question_id DESC";

		$cond 				= $where." ".$orderBy;
		$rsentry_question	= $this->Model_progressexamquestion->getListQuestion($cond);
		$base_url			= BASE_URL_BACKEND."/progress_exam_question/view/";
		$total_rows			= count($rsentry_question);
		$per_page			= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$query = $this->Model_progressexamquestion->getListQuestion($cond);

		$i=0;
		if (count($query) > 0) {
			foreach($query as $row) {
				if($row['progress_exam_question_type'] == 1){
					$query2 = $this->Model_progressexamquestion->getAnswerGrid($row['progress_exam_question_id']);

					$div = '<a id="viewBackend" class="btn-primary btn-sm" href="#viewData'.$row['progress_exam_question_id'].'">Answer List</a>';
					$div .= '<div style="display: none;"><div id="viewData'.$row['progress_exam_question_id'].'">';
					$div .= '<div>'.$row['progress_exam_question_title'].'</div>';

					if(count($query2) > 0){
						foreach($query2 as $key => $value){
							if($value['progress_exam_answer_status'] == 1){
								$jw = 'TRUE';
							} else {
								$jw = 'FALSE';
							}

							$div .= '<div>'.($key+1).'. '.$value['progress_exam_answer_title'].' = '.$jw.'</div>';
						}
					}	

					$div .= '</div></div>';
					$query[$i]['progress_exam_answer'] = $div;
				} else {
					$query[$i]['progress_exam_answer'] = "";
				}
				$i++;
			}
		}
	
		$this->data["List_progress_exam_question"] = $query;
		
		//extract privilege
		$this->data["list"] = $this->privilege[0];
		$this->data["view"] = $this->privilege[1];
		$this->data["add"] = $this->privilege[2];
		$this->data["edit"] = $this->privilege[3];
		$this->data["publish"] = $this->privilege[4];
		$this->data["approve"] = $this->privilege[5];
		$this->data["delete"] = $this->privilege[6];
		$this->data["order"] = $this->privilege[7];

		if($this->data["list"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		$this->data['total'] = $total_rows;

		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/progressexam_question/list');
	}
	

	public function add(){
		//extract privilege
		$this->data["add"] = $this->privilege[2];

		if($this->data["add"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$rsGroup	= $this->Model_progressexamgroup->getListGroup("WHERE progress_exam_group_active_status = 1 ORDER BY progress_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/progressexam_question/add',$this->data);
	}


	public function doAdd(){
		//extract privilege
		$this->data["add"] = $this->privilege[2];

		if($this->data["add"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$tb = $_POST['tbSave'];

		if (!$tb) {
			redirect(BASE_URL_BACKEND."/progress_exam_question");
			exit();
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;

	
		$progress_exam_group_id = $this->security->xss_clean(secure_input($_POST['progress_exam_group_id']));
		$progress_exam_question_type = $_POST['progress_exam_question_type'];
		$progress_exam_question_images = $this->security->xss_clean(secure_input($_POST['progress_exam_question_images']));
		$progress_exam_questiontitle1 = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle1']));
		$progress_exam_questiontitle2 = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle2']));
		$progress_exam_answer1 = $_POST['progress_exam_answer1'];
		$progress_exam_status1 = $_POST['progress_exam_status1'];
		$progress_exam_answer2 = $_POST['progress_exam_answer2'];
		$progress_exam_status2 = $_POST['progress_exam_status2'];
		$progress_exam_answer3 = $_POST['progress_exam_answer3'];
		$progress_exam_status3 = $_POST['progress_exam_status3'];
		$progress_exam_answer4 = $_POST['progress_exam_answer4'];
		$progress_exam_status4 = $_POST['progress_exam_status4'];

		$rsGroup	= $this->Model_progressexamgroup->getListGroup("WHERE progress_exam_group_active_status = 1 ORDER BY progress_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;

		$pesan = array();

		// Validasi data
		if ($progress_exam_group_id=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($progress_exam_question_type=="0") {
			$pesan[] = 'Question Type is empty';
		}
		
		if($progress_exam_question_type == 1){
			if ($progress_exam_questiontitle1=="") {
				$pesan[] = 'Question Title is empty';
			} else if ($progress_exam_answer1=="") {
				$pesan[] = 'Answer 1 is empty';
			} else if ($progress_exam_status1=="") {
				$pesan[] = 'Status 1 is empty';
			} else if ($progress_exam_answer2=="") {
				$pesan[] = 'Answer 2 is empty';
			} else if ($progress_exam_status2=="") {
				$pesan[] = 'Status 2 is empty';
			} else if ($progress_exam_answer3=="") {
				$pesan[] = 'Answer 3 is empty';
			} else if ($progress_exam_status3=="") {
				$pesan[] = 'Status 3 is empty';
			} else if ($progress_exam_answer4=="") {
				$pesan[] = 'Answer 4 is empty';
			} else if ($progress_exam_status4=="") {
				$pesan[] = 'Status 4 is empty';
			} 
		} else if($progress_exam_question_type == 2){
			if ($progress_exam_questiontitle2=="") {
				$pesan[] = 'Question Title is empty';
			} 
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->data['progress_exam_group_id']=$progress_exam_group_id;
				$this->data['progress_exam_question_type']=$progress_exam_question_type;
				$this->data['progress_exam_question_images']=$progress_exam_question_images;
				$this->data['progress_exam_questiontitle1']=$progress_exam_questiontitle1;
				$this->data['progress_exam_questiontitle2']=$progress_exam_questiontitle2;
				$this->data['progress_exam_answer1']=$progress_exam_answer1;
				$this->data['progress_exam_status1']=$progress_exam_status1;
				$this->data['progress_exam_answer2']=$progress_exam_answer2;
				$this->data['progress_exam_status2']=$progress_exam_status2;
				$this->data['progress_exam_answer3']=$progress_exam_answer3;
				$this->data['progress_exam_status3']=$progress_exam_status3;
				$this->data['progress_exam_answer4']=$progress_exam_answer4;
				$this->data['progress_exam_status4']=$progress_exam_status4; 
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/progressexam_question/add',$this->data);
			}
		} else {
			if(!empty($progress_exam_questiontitle1)){
				$progress_exam_questiontitle = $progress_exam_questiontitle1;
			}
			
			if(!empty($progress_exam_questiontitle2)){
				$progress_exam_questiontitle = $progress_exam_questiontitle2;
			}
			
			$cekQuestion = $this->Model_progressexamquestion->checkQuestion($progress_exam_questiontitle,$progress_exam_group_id,$progress_exam_question_type);
			$countQuestion = count($cekQuestion);

			if ($countQuestion > 0 ) {
				$this->data['error']='Question Title '.$progress_exam_questiontitle.' already exist';
				
				$this->data['progress_exam_group_id']=$progress_exam_group_id;
				$this->data['progress_exam_question_type']=$progress_exam_question_type;
				$this->data['progress_exam_question_images']=$progress_exam_question_images;
				$this->data['progress_exam_questiontitle1']=$progress_exam_questiontitle1;
				$this->data['progress_exam_questiontitle2']=$progress_exam_questiontitle2;
				$this->data['progress_exam_answer1']=$progress_exam_answer1;
				$this->data['progress_exam_status1']=$progress_exam_status1;
				$this->data['progress_exam_answer2']=$progress_exam_answer2;
				$this->data['progress_exam_status2']=$progress_exam_status2;
				$this->data['progress_exam_answer3']=$progress_exam_answer3;
				$this->data['progress_exam_status3']=$progress_exam_status3;
				$this->data['progress_exam_answer4']=$progress_exam_answer4;
				$this->data['progress_exam_status4']=$progress_exam_status4; 
			
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/progressexam_question/add',$this->data);
			} else {
				if(!empty($progress_exam_question_images)){
					$progress_exam_question_images_url = str_replace(BASE_URL,"",$progress_exam_question_images);
				}
				
				if($progress_exam_question_type == 1){
					$arr_status = array();

					array_push($arr_status,$progress_exam_status1,$progress_exam_status2,$progress_exam_status3,$progress_exam_status4);

					$var = 0;

					for($i=0;$i<count($arr_status);$i++){
						if($arr_status[$i] == '1'){
							$var++;
						}
					}

					if($var == 1){
						$progress_exam_questionid = $this->Model_progressexamquestion->insertQuestion($progress_exam_questiontitle1,$progress_exam_group_id,$progress_exam_question_type,$progress_exam_question_images_url);

						$answer1 = $this->Model_progressexamquestion->insertAnswer($progress_exam_questionid,$progress_exam_answer1,$progress_exam_status1,1);
						$answer2 = $this->Model_progressexamquestion->insertAnswer($progress_exam_questionid,$progress_exam_answer2,$progress_exam_status2,2);
						$answer3 = $this->Model_progressexamquestion->insertAnswer($progress_exam_questionid,$progress_exam_answer3,$progress_exam_status3,3);
						$answer4 = $this->Model_progressexamquestion->insertAnswer($progress_exam_questionid,$progress_exam_answer4,$progress_exam_status4,4);
						
						redirect(BASE_URL_BACKEND."/progress_exam_question");
					} else {
						$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

						$this->data['progress_exam_group_id']=$progress_exam_group_id;
						$this->data['progress_exam_question_type']=$progress_exam_question_type;
						$this->data['progress_exam_question_images']=$progress_exam_question_images;
						$this->data['progress_exam_questiontitle1']=$progress_exam_questiontitle1;
						$this->data['progress_exam_questiontitle2']=$progress_exam_questiontitle2;
						$this->data['progress_exam_answer1']=$progress_exam_answer1;
						$this->data['progress_exam_status1']=$progress_exam_status1;
						$this->data['progress_exam_answer2']=$progress_exam_answer2;
						$this->data['progress_exam_status2']=$progress_exam_status2;
						$this->data['progress_exam_answer3']=$progress_exam_answer3;
						$this->data['progress_exam_status3']=$progress_exam_status3;
						$this->data['progress_exam_answer4']=$progress_exam_answer4;
						$this->data['progress_exam_status4']=$progress_exam_status4; 

						$this->load->view('backend/header',$this->data);
						$this->load->view('backend/progressexam_question/add',$this->data);
					}
				} else if($progress_exam_question_type == 2){
					$progress_exam_questionid = $this->Model_progressexamquestion->insertQuestion($progress_exam_questiontitle2,$progress_exam_group_id,$progress_exam_question_type,$progress_exam_question_images_url);
					
					redirect(BASE_URL_BACKEND."/progress_exam_question");
				}
			}	
		}	
	}

	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/progress_exam_question");
			exit();
		}

		//extract privilege
		$this->data["approve"] = $this->privilege[5];

		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsentry_question = $this->Model_progressexamquestion->getQuestion($id); 
		$title = $rsentry_question[0]['progress_exam_question_title'];
		$active_status = abs($rsentry_question[0]['progress_exam_question_active_status']-1);

		$active = $this->Model_progressexamquestion->activeQuestion($id);

		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}

		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/progress_exam_question");
	}

	

	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/progress_exam_question");
			exit();
		}

		//extract privilege
		$this->data["delete"] = $this->privilege[6];

		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsEntry_question = $this->Model_progressexamquestion->getQuestion($id); 
		$title = $rsentry_question[0]['progress_exam_question_title'];

		$delete = $this->Model_progressexamquestion->deleteQuestion($id);
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/progress_exam_question");
	}
	

	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/progress_exam_question");
			exit();
		}

		//extract privilege
		$this->data["edit"] = $this->privilege[3];

		if($this->data["edit"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$rsGroup	= $this->Model_progressexamgroup->getListGroup("WHERE progress_exam_group_active_status = 1 ORDER BY progress_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_progressexamquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_progressexamquestion->getAnswer($id);
		$this->data['rsAnswer'] = $rsAnswer;
		

		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/progressexam_question/edit',$this->data);
	}


	public function doEdit($id){
		$tb = $_POST['tbEdit'];

		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/progress_exam_question");
			exit();
		}

		//extract privilege
		$this->data["edit"] = $this->privilege[3];

		if($this->data["edit"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		

		$progress_exam_group_id = $this->security->xss_clean(secure_input($_POST['progress_exam_group_id']));
		$progress_exam_question_type = $_POST['progress_exam_question_type'];
		$progress_exam_question_images = $this->security->xss_clean(secure_input($_POST['progress_exam_question_images']));
		$progress_exam_questiontitle1 = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle1']));
		$progress_exam_questiontitle1_Old = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle1_Old']));
		$progress_exam_questiontitle2 = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle2']));
		$progress_exam_questiontitle2_Old = $this->security->xss_clean(secure_input($_POST['progress_exam_questiontitle2_Old']));
		$progress_exam_answer1 = $_POST['progress_exam_answer1'];
		$progress_exam_status1 = $_POST['progress_exam_status1'];
		$progress_exam_answer2 = $_POST['progress_exam_answer2'];
		$progress_exam_status2 = $_POST['progress_exam_status2'];
		$progress_exam_answer3 = $_POST['progress_exam_answer3'];
		$progress_exam_status3 = $_POST['progress_exam_status3'];
		$progress_exam_answer4 = $_POST['progress_exam_answer4'];
		$progress_exam_status4 = $_POST['progress_exam_status4'];

		$rsGroup	= $this->Model_progressexamgroup->getListGroup("WHERE progress_exam_group_active_status = 1 ORDER BY progress_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_progressexamquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_progressexamquestion->getAnswer($id);
		$this->data['rsAnswer'] = $rsAnswer;
		
		$pesan = array();

		// Validasi data
		if ($progress_exam_group_id=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($progress_exam_question_type=="0") {
			$pesan[] = 'Question Type is empty';
		}
		
		if($progress_exam_question_type == 1){
			if ($progress_exam_questiontitle1=="") {
				$pesan[] = 'Question Title is empty';
			} else if ($progress_exam_answer1=="") {
				$pesan[] = 'Answer 1 is empty';
			} else if ($progress_exam_status1=="") {
				$pesan[] = 'Status 1 is empty';
			} else if ($progress_exam_answer2=="") {
				$pesan[] = 'Answer 2 is empty';
			} else if ($progress_exam_status2=="") {
				$pesan[] = 'Status 2 is empty';
			} else if ($progress_exam_answer3=="") {
				$pesan[] = 'Answer 3 is empty';
			} else if ($progress_exam_status3=="") {
				$pesan[] = 'Status 3 is empty';
			} else if ($progress_exam_answer4=="") {
				$pesan[] = 'Answer 4 is empty';
			} else if ($progress_exam_status4=="") {
				$pesan[] = 'Status 4 is empty';
			} 
		} else if($progress_exam_question_type == 2){
			if ($progress_exam_questiontitle2=="") {
				$pesan[] = 'Question Title is empty';
			} 
		} 

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/progressexam_question/edit',$this->data);
			}
		} else {
			if(!empty($progress_exam_questiontitle1)){
				$progress_exam_questiontitle = $progress_exam_questiontitle1;
				$weekly_exam_grouptitleOld = $progress_exam_questiontitle1_Old;
			}
			
			if(!empty($progress_exam_questiontitle2)){
				$progress_exam_questiontitle = $progress_exam_questiontitle2;
				$weekly_exam_grouptitleOld = $progress_exam_questiontitle2_Old;
			}
			
			$cekQuestion = $this->Model_progressexamquestion->checkQuestion($progress_exam_questiontitle,$progress_exam_group_id,$progress_exam_question_type);
			$countQuestion = count($cekQuestion);
			
			if($progress_exam_questiontitle == $weekly_exam_grouptitleOld){
				$countQuestion = 0;
			}
			
			if ($countQuestion > 0 ) {
				$this->data['error']='Question Title '.$progress_exam_questiontitle.' already exist';
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/progressexam_question/edit',$this->data);
			} else {	
				if(!empty($progress_exam_question_images)){
					$progress_exam_question_images_url = str_replace(BASE_URL,"",$progress_exam_question_images);
				}
				
				if($progress_exam_question_type == 1){
					$arr_status = array();

					array_push($arr_status,$progress_exam_status1,$progress_exam_status2,$progress_exam_status3,$progress_exam_status4);

					$var = 0;
					for($i=0;$i<count($arr_status);$i++){
						if($arr_status[$i] == '1'){
							$var++;
						}
					}
					
					if($var == 1){
						$update = $this->Model_progressexamquestion->updateQuestion($id,$progress_exam_questiontitle1,$progress_exam_group_id,$progress_exam_question_type,$progress_exam_question_images_url);
						
						if(count($rsAnswer) > 0){
							$updateAnswer1 = $this->Model_progressexamquestion->updateAnswer($id,$progress_exam_answer1,$progress_exam_status1,1);
							$updateAnswer2 = $this->Model_progressexamquestion->updateAnswer($id,$progress_exam_answer2,$progress_exam_status2,2);
							$updateAnswer3 = $this->Model_progressexamquestion->updateAnswer($id,$progress_exam_answer3,$progress_exam_status3,3);
							$updateAnswer4 = $this->Model_progressexamquestion->updateAnswer($id,$progress_exam_answer4,$progress_exam_status4,4);
						} else {
							$answer1 = $this->Model_progressexamquestion->insertAnswer($id,$progress_exam_answer1,$progress_exam_status1,1);
							$answer2 = $this->Model_progressexamquestion->insertAnswer($id,$progress_exam_answer2,$progress_exam_status2,2);
							$answer3 = $this->Model_progressexamquestion->insertAnswer($id,$progress_exam_answer3,$progress_exam_status3,3);
							$answer4 = $this->Model_progressexamquestion->insertAnswer($id,$progress_exam_answer4,$progress_exam_status4,4);
						}

						redirect(BASE_URL_BACKEND."/progress_exam_question/");
					} else {
						$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

						$this->load->view('backend/header',$this->data);
						$this->load->view('backend/progressexam_question/edit',$this->data);
					}
				} else {
					$update = $this->Model_progressexamquestion->updateQuestion($id,$progress_exam_questiontitle2,$progress_exam_group_id,$progress_exam_question_type,$progress_exam_question_images_url);
					$deleteanswer = $this->Model_progressexamquestion->deleteAnswer($id);
					
					redirect(BASE_URL_BACKEND."/progress_exam_question/");
				}
			}	
		}
	}
}