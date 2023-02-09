<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry_question extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 10; //get module group id from database
	public $module_id = 21; //get module id from database
	public $module = "Entry Question";

	public function __construct(){
		parent::__construct();
               
		session_start();

		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}

		$this->load->model(array('backend/Model_entryquestion','backend/Model_entrygroup','backend/Model_logcms'));
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

		$orderBy = "ORDER BY a.entry_group_id ASC, a.entry_question_order ASC";

		$cond 				= $where." ".$orderBy;
		$rsentry_question			= $this->Model_entryquestion->getListQuestion($cond);
		$base_url			= BASE_URL_BACKEND."/entry_question/view/";
		$total_rows			= count($rsentry_question);
		$per_page			= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$query = $this->Model_entryquestion->getListQuestion($cond);

		$i=0;
		if (count($query) > 0) {

			foreach($query as $row) {
				
				
				$query2 = $this->Model_entryquestion->getAnswerGrid($row['entry_question_id']);

				$div = '<a id="viewBackend" class="btn-primary btn-sm" href="#viewData'.$row['entry_question_id'].'">Answer List</a>';

				$div .= '<div style="display: none;"><div id="viewData'.$row['entry_question_id'].'">';

				$div .= '<div>'.$row['entry_question_title'].'</div>';

				if(count($query2) > 0){

					foreach($query2 as $key => $value){

						if($value['entry_answer_status'] == 1){

							$jw = 'TRUE';

						} else {

							$jw = 'FALSE';

						}

						$div .= '<div>'.($key+1).'. '.$value['entry_answer_title'].' = '.$jw.'</div>';

					}

				}	

				$div .= '</div></div>';

				$query[$i]['entry_answer'] = $div;
				
				$i++;

			}

		}
	
		$this->data["List_entry_question"] = $query;
		
		//see($this->data["Listentry_question"]);
		

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
		$this->load->view('backend/entry_question/list');
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
		
		$rsGroup	= $this->Model_entrygroup->getListGroup("WHERE entry_group_active_status = 1 ORDER BY entry_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/entry_question/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/entry_question");
			exit();
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;

	
		$entry_groupid = $this->security->xss_clean(secure_input($_POST['entry_groupid']));
		$entry_questiontitle = $this->security->xss_clean(secure_input($_POST['entry_questiontitle']));
                $entry_question_images = $this->security->xss_clean(secure_input($_POST['entry_question_images']));
		$entry_answer1 = $_POST['entry_answer1'];
		$entry_status1 = $_POST['entry_status1'];
		$entry_answer2 = $_POST['entry_answer2'];
		$entry_status2 = $_POST['entry_status2'];
		$entry_answer3 = $_POST['entry_answer3'];
		$entry_status3 = $_POST['entry_status3'];
		$entry_answer4 = $_POST['entry_answer4'];
		$entry_status4 = $_POST['entry_status4'];

		$rsGroup	= $this->Model_entrygroup->getListGroup("WHERE entry_group_active_status = 1 ORDER BY entry_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;

		$pesan = array();

		// Validasi data
		if ($entry_groupid=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($entry_questiontitle=="") {
			$pesan[] = 'Question Title is empty';
		} else if ($entry_answer1=="") {
			$pesan[] = 'Answer 1 is empty';
		} else if ($entry_status1=="") {
			$pesan[] = 'Status 1 is empty';
		} else if ($entry_answer2=="") {
			$pesan[] = 'Answer 2 is empty';
		} else if ($entry_status2=="") {
			$pesan[] = 'Status 2 is empty';
		} else if ($entry_answer3=="") {
			$pesan[] = 'Answer 3 is empty';
		} else if ($entry_status3=="") {
			$pesan[] = 'Status 3 is empty';
		} else if ($entry_answer4=="") {
			$pesan[] = 'Answer 4 is empty';
		} else if ($entry_status4=="") {
			$pesan[] = 'Status 4 is empty';
		} 

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->data['entry_groupid']=$entry_groupid;
				$this->data['entry_questiontitle']=$entry_questiontitle;
                                
				$this->data['entry_answer1']=$entry_answer1;
				$this->data['entry_status1']=$entry_status1;
				$this->data['entry_answer2']=$entry_answer2;
				$this->data['entry_status2']=$entry_status2;
				$this->data['entry_answer3']=$entry_answer3;
				$this->data['entry_status3']=$entry_status3;
				$this->data['entry_answer4']=$entry_answer4;
				$this->data['entry_status4']=$entry_status4; 
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/entry_question/add',$this->data);
			}
		} else {
			$cekQuestion = $this->Model_entryquestion->checkQuestion($entry_questiontitle);
			$countQuestion = count($cekQuestion);

			if ($countQuestion > 0 ) {
				$this->data['error']='Question Title '.$entry_questiontitle.' already exist';
				
				$this->data['entry_groupid']=$entry_groupid;
				$this->data['entry_questiontitle']=$entry_questiontitle;
                                $this->data['entry_question_images']=$entry_question_images;
				$this->data['entry_answer1']=$entry_answer1;
				$this->data['entry_status1']=$entry_status1;
				$this->data['entry_answer2']=$entry_answer2;
				$this->data['entry_status2']=$entry_status2;
				$this->data['entry_answer3']=$entry_answer3;
				$this->data['entry_status3']=$entry_status3;
				$this->data['entry_answer4']=$entry_answer4;
				$this->data['entry_status4']=$entry_status4;
			
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/entry_question/add',$this->data);
			} else {
				$arr_status = array();

				array_push($arr_status,$entry_status1,$entry_status2,$entry_status3,$entry_status4);

				$var = 0;

				for($i=0;$i<count($arr_status);$i++){
					if($arr_status[$i] == '1'){
						$var++;
					}
				}

				if($var == 1){
					$entry_questionid = $this->Model_entryquestion->insertQuestion($entry_questiontitle,$entry_question_images,$entry_groupid);

					$answer1 = $this->Model_entryquestion->insertAnswer($entry_questionid,$entry_answer1,$entry_status1,1);
					$answer2 = $this->Model_entryquestion->insertAnswer($entry_questionid,$entry_answer2,$entry_status2,2);
					$answer3 = $this->Model_entryquestion->insertAnswer($entry_questionid,$entry_answer3,$entry_status3,3);
					$answer4 = $this->Model_entryquestion->insertAnswer($entry_questionid,$entry_answer4,$entry_status4,4);
					
					redirect(BASE_URL_BACKEND."/entry_question");
				} else {
					$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

					$this->data['entry_groupid']=$entry_groupid;
					$this->data['entry_questiontitle']=$entry_questiontitle;
					$this->data['entry_answer1']=$entry_answer1;
					$this->data['entry_status1']=$entry_status1;
					$this->data['entry_answer2']=$entry_answer2;
					$this->data['entry_status2']=$entry_status2;
					$this->data['entry_answer3']=$entry_answer3;
					$this->data['entry_status3']=$entry_status3;
					$this->data['entry_answer4']=$entry_answer4;
					$this->data['entry_status4']=$entry_status4;

					$this->load->view('backend/header',$this->data);
					$this->load->view('backend/entry_question/add',$this->data);
				}
			}	
		}	
	}

	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/entry_question");
			exit();
		}

		//extract privilege
		$this->data["approve"] = $this->privilege[5];

		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsentry_question = $this->Model_entryquestion->getQuestion($id); 
		$title = $rsentry_question[0]['entry_question_title'];
		$active_status = abs($rsentry_question[0]['entry_question_active_status']-1);

		$active = $this->Model_entryquestion->activeQuestion($id);

		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}

		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/entry_question");
	}

	

	function delete($id){

		if (empty($id)) {

			redirect(BASE_URL_BACKEND."/entry_question");

			exit();

		}

		

		//extract privilege

		$this->data["delete"] = $this->privilege[6];

		

		if($this->data["delete"] == 0){

			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";

			die;

		}

		

		$rsEntry_question = $this->Model_entryquestion->getQuestion($id); 

		$title = $rsEntry_question[0]['entry_question_name'];

		

		$delete = $this->Model_entryquestion->deleteQuestion($id);

		$log_module = "Delete ".$this->module;

		$log_value = $id." | ".$title;

		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/entry_question");

	}

	

	public function edit($id){

		if (empty($id)) {

			redirect(BASE_URL_BACKEND."/entry_question");

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

		
		$rsGroup	= $this->Model_entrygroup->getListGroup("WHERE entry_group_active_status = 1 ORDER BY entry_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_entryquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_entryquestion->getAnswer($id);

		$this->data['rsAnswer'] = $rsAnswer;

		

		$this->load->view('backend/header',$this->data);

		$this->load->view('backend/entry_question/edit',$this->data);

	}

	

	public function doEdit($id){
		$tb = $_POST['tbEdit'];

		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/entry_question");
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
		

		$entry_groupid = $this->security->xss_clean(secure_input($_POST['entry_groupid']));
		$entry_questiontitle = $this->security->xss_clean(secure_input($_POST['entry_questiontitle']));
                $entry_question_images = $this->security->xss_clean(secure_input($_POST['entry_question_images']));
		$entry_answer1 = $this->security->xss_clean(secure_input($_POST['entry_answer1']));
		$entry_status1 = $this->security->xss_clean(secure_input($_POST['entry_status1']));
		$entry_answer2 = $this->security->xss_clean(secure_input($_POST['entry_answer2']));
		$entry_status2 = $this->security->xss_clean(secure_input($_POST['entry_status2']));
		$entry_answer3 = $this->security->xss_clean(secure_input($_POST['entry_answer3']));
		$entry_status3 = $this->security->xss_clean(secure_input($_POST['entry_status3']));
		$entry_answer4 = $this->security->xss_clean(secure_input($_POST['entry_answer4']));
		$entry_status4 = $this->security->xss_clean(secure_input($_POST['entry_status4']));

		$rsGroup	= $this->Model_entrygroup->getListGroup("WHERE entry_group_active_status = 1 ORDER BY entry_group_id DESC");
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$rsQuestion = $this->Model_entryquestion->getQuestion($id);  // mengambil database dari model untuk dikirim ke view
		$countQuestion = count($rsQuestion);		

		$this->data['rsQuestion'] = $rsQuestion;
		$this->data['countQuestion'] = $countQuestion;
		
		$rsAnswer = $this->Model_entryquestion->getAnswer($id);

		$this->data['rsAnswer'] = $rsAnswer;
		
		$pesan = array();

		// Validasi data
		if ($entry_groupid=="0") {
			$pesan[] = 'Group Title is empty';
		} else if ($entry_questiontitle=="") {
			$pesan[] = 'Question Title is empty';
		} else if ($entry_answer1=="") {
			$pesan[] = 'Answer 1 is empty';
		} else if ($entry_status1=="") {
			$pesan[] = 'Status 1 is empty';
		} else if ($entry_answer2=="") {
			$pesan[] = 'Answer 2 is empty';
		} else if ($entry_status2=="") {
			$pesan[] = 'Status 2 is empty';
		} else if ($entry_answer3=="") {
			$pesan[] = 'Answer 3 is empty';
		} else if ($entry_status3=="") {
			$pesan[] = 'Status 3 is empty';
		} else if ($entry_answer4=="") {
			$pesan[] = 'Answer 4 is empty';
		} else if ($entry_status4=="") {
			$pesan[] = 'Status 4 is empty';
		}

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/entry_question/edit',$this->data);
			}
		} else {
			$arr_status = array();

			array_push($arr_status,$entry_status1,$entry_status2,$entry_status3,$entry_status4);

			$var = 0;
			for($i=0;$i<count($arr_status);$i++){
				if($arr_status[$i] == '1'){
					$var++;
				}
			}

			if($var == 1){
				$update = $this->Model_entryquestion->updateQuestion($id,$entry_questiontitle,$entry_question_images,$entry_groupid);

				$updateAnswer1 = $this->Model_entryquestion->updateAnswer($id,$entry_answer1,$entry_status1,1);
				$updateAnswer2 = $this->Model_entryquestion->updateAnswer($id,$entry_answer2,$entry_status2,2);
				$updateAnswer3 = $this->Model_entryquestion->updateAnswer($id,$entry_answer3,$entry_status3,3);
				$updateAnswer4 = $this->Model_entryquestion->updateAnswer($id,$entry_answer4,$entry_status4,4);

				redirect(BASE_URL_BACKEND."/entry_question/");
			} else {
				$this->data['error']='Please check your answer status. It can be only one that contain 1 value';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/entry_question/edit',$this->data);
			}
		}
	}
	
	
	public function doOrder(){

		//extract privilege

		$this->data["order"] = $this->privilege[7];

		

		if($this->data["order"] == 0){

			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";

			die;

		}



		$order = $_POST['order'];
		

		foreach($order as $id => $val)

		{

			

			$this->Model_entryquestion->updateOrderQuestion($id,$val);

		

			

			$log_module = "Order ".$this->module;

			$log_value = $id." | ".$val;

			$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		}		

		redirect(BASE_URL_BACKEND."/entry_question/");

	}

}