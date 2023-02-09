<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weekly_exam_question extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 11; //get module group id from database
	public $module_id = 30; //get module id from database
	public $module = "Weekly Exam Question";

	public function __construct(){
		parent::__construct();
               
		session_start();

		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}

		$this->load->model(array('backend/Model_weeklyexamquestion','backend/Model_weeklyexamgroup','backend/Model_logcms'));
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

		$orderBy = "ORDER BY a.weekly_exam_group_id DESC, a.weekly_exam_question_type DESC, a.weekly_exam_question_id DESC";

		$cond 				= $where." ".$orderBy;
		$rsentry_question	= $this->Model_weeklyexamquestion->getListQuestion($cond);
		$base_url			= BASE_URL_BACKEND."/weekly_exam_question/view/";
		$total_rows			= count($rsentry_question);
		$per_page			= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$query = $this->Model_weeklyexamquestion->getListQuestion($cond);

		$i=0;
		if (count($query) > 0) {
			foreach($query as $row) {
				if($row['weekly_exam_question_type'] == 1){
					$query2 = $this->Model_weeklyexamquestion->getAnswerGrid($row['weekly_exam_question_id']);

					$div = '<a id="viewBackend" class="btn-primary btn-sm" href="#viewData'.$row['weekly_exam_question_id'].'">Answer List</a>';
					$div .= '<div style="display: none;"><div id="viewData'.$row['weekly_exam_question_id'].'">';
					$div .= '<div>'.$row['weekly_exam_question_title'].'</div>';

					if(count($query2) > 0){
						foreach($query2 as $key => $value){
							if($value['weekly_exam_answer_status'] == 1){
								$jw = 'TRUE';
							} else {
								$jw = 'FALSE';
							}

							$div .= '<div>'.($key+1).'. '.$value['weekly_exam_answer_title'].' = '.$jw.'</div>';
						}
					}	

					$div .= '</div></div>';
					$query[$i]['weekly_exam_answer'] = $div;
				} else {
					$query[$i]['weekly_exam_answer'] = "";
				}
				$i++;
			}
		}
	
		$this->data["List_weekly_exam_question"] = $query;
		
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
		$this->load->view('backend/weeklyexam_question/list');
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
		
		$rsGroup	= $this->Model_weeklyexamgroup->getListGroup("WHERE weekly_exam_group_active_status = 1 ORDER BY weekly_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/weeklyexam_question/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/weekly_exam_question");
			exit();
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;

	
		$weekly_exam_group_id = $this->security->xss_clean(secure_input($_POST['weekly_exam_group_id']));
		$weekly_exam_question_type = $_POST['weekly_exam_question_type'];
		$weekly_exam_question_images = $this->security->xss_clean(secure_input($_POST['weekly_exam_question_images']));
		$weekly_exam_questiontitle1 = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle1']));
		$weekly_exam_questiontitle2 = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle2']));
		$weekly_exam_answer1 = $_POST['weekly_exam_answer1'];
		$weekly_exam_status1 = $_POST['weekly_exam_status1'];
		$weekly_exam_answer2 = $_POST['weekly_exam_answer2'];
		$weekly_exam_status2 = $_POST['weekly_exam_status2'];
		$weekly_exam_answer3 = $_POST['weekly_exam_answer3'];
		$weekly_exam_status3 = $_POST['weekly_exam_status3'];
		$weekly_exam_answer4 = $_POST['weekly_exam_answer4'];
		$weekly_exam_status4 = $_POST['weekly_exam_status4'];

		$rsGroup	= $this->Model_weeklyexamgroup->getListGroup("WHERE weekly_exam_group_active_status = 1 ORDER BY weekly_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;

		$pesan = array();

		// Validasi data
		if ($weekly_exam_group_id=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($weekly_exam_question_type=="0") {
			$pesan[] = 'Question Type is empty';
		}
		
		if($weekly_exam_question_type == 1){
			if ($weekly_exam_questiontitle1=="") {
				$pesan[] = 'Question Title is empty';
			} else if ($weekly_exam_answer1=="") {
				$pesan[] = 'Answer 1 is empty';
			} else if ($weekly_exam_status1=="") {
				$pesan[] = 'Status 1 is empty';
			} else if ($weekly_exam_answer2=="") {
				$pesan[] = 'Answer 2 is empty';
			} else if ($weekly_exam_status2=="") {
				$pesan[] = 'Status 2 is empty';
			} else if ($weekly_exam_answer3=="") {
				$pesan[] = 'Answer 3 is empty';
			} else if ($weekly_exam_status3=="") {
				$pesan[] = 'Status 3 is empty';
			} else if ($weekly_exam_answer4=="") {
				$pesan[] = 'Answer 4 is empty';
			} else if ($weekly_exam_status4=="") {
				$pesan[] = 'Status 4 is empty';
			} 
		} else if($weekly_exam_question_type == 2){
			if ($weekly_exam_questiontitle2=="") {
				$pesan[] = 'Question Title is empty';
			} 
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->data['weekly_exam_group_id']=$weekly_exam_group_id;
				$this->data['weekly_exam_question_type']=$weekly_exam_question_type;
				$this->data['weekly_exam_question_images']=$weekly_exam_question_images;
				$this->data['weekly_exam_questiontitle1']=$weekly_exam_questiontitle1;
				$this->data['weekly_exam_questiontitle2']=$weekly_exam_questiontitle2;
				$this->data['weekly_exam_answer1']=$weekly_exam_answer1;
				$this->data['weekly_exam_status1']=$weekly_exam_status1;
				$this->data['weekly_exam_answer2']=$weekly_exam_answer2;
				$this->data['weekly_exam_status2']=$weekly_exam_status2;
				$this->data['weekly_exam_answer3']=$weekly_exam_answer3;
				$this->data['weekly_exam_status3']=$weekly_exam_status3;
				$this->data['weekly_exam_answer4']=$weekly_exam_answer4;
				$this->data['weekly_exam_status4']=$weekly_exam_status4; 
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/weeklyexam_question/add',$this->data);
			}
		} else {
			if(!empty($weekly_exam_questiontitle1)){
				$weekly_exam_questiontitle = $weekly_exam_questiontitle1;
			}
			
			if(!empty($weekly_exam_questiontitle2)){
				$weekly_exam_questiontitle = $weekly_exam_questiontitle2;
			}
			
			$cekQuestion = $this->Model_weeklyexamquestion->checkQuestion($weekly_exam_questiontitle,$weekly_exam_group_id,$weekly_exam_question_type);
			$countQuestion = count($cekQuestion);

			if ($countQuestion > 0 ) {
				$this->data['error']='Question Title '.$weekly_exam_questiontitle.' already exist';
				
				$this->data['weekly_exam_group_id']=$weekly_exam_group_id;
				$this->data['weekly_exam_question_type']=$weekly_exam_question_type;
				$this->data['weekly_exam_question_images']=$weekly_exam_question_images;
				$this->data['weekly_exam_questiontitle1']=$weekly_exam_questiontitle1;
				$this->data['weekly_exam_questiontitle2']=$weekly_exam_questiontitle2;
				$this->data['weekly_exam_answer1']=$weekly_exam_answer1;
				$this->data['weekly_exam_status1']=$weekly_exam_status1;
				$this->data['weekly_exam_answer2']=$weekly_exam_answer2;
				$this->data['weekly_exam_status2']=$weekly_exam_status2;
				$this->data['weekly_exam_answer3']=$weekly_exam_answer3;
				$this->data['weekly_exam_status3']=$weekly_exam_status3;
				$this->data['weekly_exam_answer4']=$weekly_exam_answer4;
				$this->data['weekly_exam_status4']=$weekly_exam_status4; 
			
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/weeklyexam_question/add',$this->data);
			} else {
				if(!empty($weekly_exam_question_images)){
					$weekly_exam_question_images_url = str_replace(BASE_URL,"",$weekly_exam_question_images);
				}
				
				if($weekly_exam_question_type == 1){
					$arr_status = array();

					array_push($arr_status,$weekly_exam_status1,$weekly_exam_status2,$weekly_exam_status3,$weekly_exam_status4);

					$var = 0;

					for($i=0;$i<count($arr_status);$i++){
						if($arr_status[$i] == '1'){
							$var++;
						}
					}

					if($var == 1){
						$weekly_exam_questionid = $this->Model_weeklyexamquestion->insertQuestion($weekly_exam_questiontitle1,$weekly_exam_group_id,$weekly_exam_question_type,$weekly_exam_question_images_url);

						$answer1 = $this->Model_weeklyexamquestion->insertAnswer($weekly_exam_questionid,$weekly_exam_answer1,$weekly_exam_status1,1);
						$answer2 = $this->Model_weeklyexamquestion->insertAnswer($weekly_exam_questionid,$weekly_exam_answer2,$weekly_exam_status2,2);
						$answer3 = $this->Model_weeklyexamquestion->insertAnswer($weekly_exam_questionid,$weekly_exam_answer3,$weekly_exam_status3,3);
						$answer4 = $this->Model_weeklyexamquestion->insertAnswer($weekly_exam_questionid,$weekly_exam_answer4,$weekly_exam_status4,4);
						
						redirect(BASE_URL_BACKEND."/weekly_exam_question");
					} else {
						$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

						$this->data['weekly_exam_group_id']=$weekly_exam_group_id;
						$this->data['weekly_exam_question_type']=$weekly_exam_question_type;
						$this->data['weekly_exam_question_images']=$weekly_exam_question_images;
						$this->data['weekly_exam_questiontitle1']=$weekly_exam_questiontitle1;
						$this->data['weekly_exam_questiontitle2']=$weekly_exam_questiontitle2;
						$this->data['weekly_exam_answer1']=$weekly_exam_answer1;
						$this->data['weekly_exam_status1']=$weekly_exam_status1;
						$this->data['weekly_exam_answer2']=$weekly_exam_answer2;
						$this->data['weekly_exam_status2']=$weekly_exam_status2;
						$this->data['weekly_exam_answer3']=$weekly_exam_answer3;
						$this->data['weekly_exam_status3']=$weekly_exam_status3;
						$this->data['weekly_exam_answer4']=$weekly_exam_answer4;
						$this->data['weekly_exam_status4']=$weekly_exam_status4; 

						$this->load->view('backend/header',$this->data);
						$this->load->view('backend/weeklyexam_question/add',$this->data);
					}
				} else if($weekly_exam_question_type == 2){
					$weekly_exam_questionid = $this->Model_weeklyexamquestion->insertQuestion($weekly_exam_questiontitle2,$weekly_exam_group_id,$weekly_exam_question_type,$weekly_exam_question_images_url);
					
					redirect(BASE_URL_BACKEND."/weekly_exam_question");
				}
			}	
		}	
	}

	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/weekly_exam_question");
			exit();
		}

		//extract privilege
		$this->data["approve"] = $this->privilege[5];

		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsentry_question = $this->Model_weeklyexamquestion->getQuestion($id); 
		$title = $rsentry_question[0]['weekly_exam_question_title'];
		$active_status = abs($rsentry_question[0]['weekly_exam_question_active_status']-1);

		$active = $this->Model_weeklyexamquestion->activeQuestion($id);

		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}

		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/weekly_exam_question");
	}

	

	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/weekly_exam_question");
			exit();
		}

		//extract privilege
		$this->data["delete"] = $this->privilege[6];

		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsEntry_question = $this->Model_weeklyexamquestion->getQuestion($id); 
		$title = $rsentry_question[0]['weekly_exam_question_title'];

		$delete = $this->Model_weeklyexamquestion->deleteQuestion($id);
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/weekly_exam_question");
	}
	

	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/weekly_exam_question");
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
		
		$rsGroup	= $this->Model_weeklyexamgroup->getListGroup("WHERE weekly_exam_group_active_status = 1 ORDER BY weekly_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_weeklyexamquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_weeklyexamquestion->getAnswer($id);
		$this->data['rsAnswer'] = $rsAnswer;
		

		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/weeklyexam_question/edit',$this->data);
	}


	public function doEdit($id){
		$tb = $_POST['tbEdit'];

		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/weekly_exam_question");
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
		

		$weekly_exam_group_id = $this->security->xss_clean(secure_input($_POST['weekly_exam_group_id']));
		$weekly_exam_question_type = $_POST['weekly_exam_question_type'];
		$weekly_exam_question_images = $this->security->xss_clean(secure_input($_POST['weekly_exam_question_images']));
		$weekly_exam_questiontitle1 = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle1']));
		$weekly_exam_questiontitle1_Old = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle1_Old']));
		$weekly_exam_questiontitle2 = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle2']));
		$weekly_exam_questiontitle2_Old = $this->security->xss_clean(secure_input_editor($_POST['weekly_exam_questiontitle2_Old']));
		$weekly_exam_answer1 = $_POST['weekly_exam_answer1'];
		$weekly_exam_status1 = $_POST['weekly_exam_status1'];
		$weekly_exam_answer2 = $_POST['weekly_exam_answer2'];
		$weekly_exam_status2 = $_POST['weekly_exam_status2'];
		$weekly_exam_answer3 = $_POST['weekly_exam_answer3'];
		$weekly_exam_status3 = $_POST['weekly_exam_status3'];
		$weekly_exam_answer4 = $_POST['weekly_exam_answer4'];
		$weekly_exam_status4 = $_POST['weekly_exam_status4'];

		$rsGroup	= $this->Model_weeklyexamgroup->getListGroup("WHERE weekly_exam_group_active_status = 1 ORDER BY weekly_exam_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_weeklyexamquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_weeklyexamquestion->getAnswer($id);
		$this->data['rsAnswer'] = $rsAnswer;
		
		$pesan = array();

		// Validasi data
		if ($weekly_exam_group_id=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($weekly_exam_question_type=="0") {
			$pesan[] = 'Question Type is empty';
		}
		
		if($weekly_exam_question_type == 1){
			if ($weekly_exam_questiontitle1=="") {
				$pesan[] = 'Question Title is empty';
			} else if ($weekly_exam_answer1=="") {
				$pesan[] = 'Answer 1 is empty';
			} else if ($weekly_exam_status1=="") {
				$pesan[] = 'Status 1 is empty';
			} else if ($weekly_exam_answer2=="") {
				$pesan[] = 'Answer 2 is empty';
			} else if ($weekly_exam_status2=="") {
				$pesan[] = 'Status 2 is empty';
			} else if ($weekly_exam_answer3=="") {
				$pesan[] = 'Answer 3 is empty';
			} else if ($weekly_exam_status3=="") {
				$pesan[] = 'Status 3 is empty';
			} else if ($weekly_exam_answer4=="") {
				$pesan[] = 'Answer 4 is empty';
			} else if ($weekly_exam_status4=="") {
				$pesan[] = 'Status 4 is empty';
			} 
		} else if($weekly_exam_question_type == 2){
			if ($weekly_exam_questiontitle2=="") {
				$pesan[] = 'Question Title is empty';
			} 
		} 

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/weeklyexam_question/edit',$this->data);
			}
		} else {
			if(!empty($weekly_exam_questiontitle1)){
				$weekly_exam_questiontitle = $weekly_exam_questiontitle1;
				$weekly_exam_grouptitleOld = $weekly_exam_questiontitle1_Old;
			}
			
			if(!empty($weekly_exam_questiontitle2)){
				$weekly_exam_questiontitle = $weekly_exam_questiontitle2;
				$weekly_exam_grouptitleOld = $weekly_exam_questiontitle2_Old;
			}
			
			$cekQuestion = $this->Model_weeklyexamquestion->checkQuestion($weekly_exam_questiontitle,$weekly_exam_group_id,$weekly_exam_question_type);
			$countQuestion = count($cekQuestion);
			
			if($weekly_exam_questiontitle == $weekly_exam_grouptitleOld){
				$countQuestion = 0;
			}
			
			if ($countQuestion > 0 ) {
				$this->data['error']='Question Title '.$weekly_exam_questiontitle.' already exist';
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/weeklyexam_question/edit',$this->data);
			} else {	
				if(!empty($weekly_exam_question_images)){
					$weekly_exam_question_images_url = str_replace(BASE_URL,"",$weekly_exam_question_images);
				}
				
				if($weekly_exam_question_type == 1){
					$arr_status = array();

					array_push($arr_status,$weekly_exam_status1,$weekly_exam_status2,$weekly_exam_status3,$weekly_exam_status4);

					$var = 0;
					for($i=0;$i<count($arr_status);$i++){
						if($arr_status[$i] == '1'){
							$var++;
						}
					}
					
					if($var == 1){
						$update = $this->Model_weeklyexamquestion->updateQuestion($id,$weekly_exam_questiontitle1,$weekly_exam_group_id,$weekly_exam_question_type,$weekly_exam_question_images_url);
						
						if(count($rsAnswer) > 0){
							$updateAnswer1 = $this->Model_weeklyexamquestion->updateAnswer($id,$weekly_exam_answer1,$weekly_exam_status1,1);
							$updateAnswer2 = $this->Model_weeklyexamquestion->updateAnswer($id,$weekly_exam_answer2,$weekly_exam_status2,2);
							$updateAnswer3 = $this->Model_weeklyexamquestion->updateAnswer($id,$weekly_exam_answer3,$weekly_exam_status3,3);
							$updateAnswer4 = $this->Model_weeklyexamquestion->updateAnswer($id,$weekly_exam_answer4,$weekly_exam_status4,4);
						} else {
							$answer1 = $this->Model_weeklyexamquestion->insertAnswer($id,$weekly_exam_answer1,$weekly_exam_status1,1);
							$answer2 = $this->Model_weeklyexamquestion->insertAnswer($id,$weekly_exam_answer2,$weekly_exam_status2,2);
							$answer3 = $this->Model_weeklyexamquestion->insertAnswer($id,$weekly_exam_answer3,$weekly_exam_status3,3);
							$answer4 = $this->Model_weeklyexamquestion->insertAnswer($id,$weekly_exam_answer4,$weekly_exam_status4,4);
						}

						redirect(BASE_URL_BACKEND."/weekly_exam_question/");
					} else {
						$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

						$this->load->view('backend/header',$this->data);
						$this->load->view('backend/weeklyexam_question/edit',$this->data);
					}
				} else {
					$update = $this->Model_weeklyexamquestion->updateQuestion($id,$weekly_exam_questiontitle2,$weekly_exam_group_id,$weekly_exam_question_type,$weekly_exam_question_images_url);
					$deleteanswer = $this->Model_weeklyexamquestion->deleteAnswer($id);
					
					redirect(BASE_URL_BACKEND."/weekly_exam_question/");
				}
			}	
		}
	}
}