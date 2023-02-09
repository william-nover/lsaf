<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weekly_exam_result extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 11; //get module group id from database
	public $module_id = 32; //get module id from database
	public $module = "Weekly Exam Result";

	public function __construct(){
		parent::__construct();
               
		session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}

		$this->load->model(array('backend/Model_weeklyexamresult','backend/Model_logcms'));
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

		$orderBy = " GROUP BY a.weekly_exam_group_id, a.student_id ORDER BY a.weekly_exam_result_id DESC";

		$cond 				= $where." ".$orderBy;
		$rsentry_question	= $this->Model_weeklyexamresult->getListResult($cond);
		$base_url			= BASE_URL_BACKEND."/weekly_exam_result/view/";
		$total_rows			= count($rsentry_question);
		$per_page			= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$query = $this->Model_weeklyexamresult->getListResult($cond);
		
		if(count($query) > 0){
			for($i=0; $i<count($query); $i++){
				$rsMultipleChoice	= $this->Model_weeklyexamresult->getListResultDetail($query[$i]['weekly_exam_group_id'], $query[$i]['student_id']);
				if(count($rsMultipleChoice) > 0){
					$query[$i]['multiple_choice'] = $rsMultipleChoice;
				} else {
					$query[$i]['multiple_choice'] = array();
				}
				
				$rsEssay	= $this->Model_weeklyexamresult->getListResultEssayDetail($query[$i]['weekly_exam_group_id'], $query[$i]['student_id']);
				if(count($rsEssay) > 0){
					$query[$i]['essay'] = $rsEssay;
				} else {
					$query[$i]['essay'] = array();
				}
			}
		}
		
		$this->data["List_entry_result"] = $query;
		

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
		$this->load->view('backend/weeklyexam_result/list');
	}


	public function editEssay($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/weekly_exam_result");
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

		$rsResultEssay = $this->Model_weeklyexamresult->getListResultEssayDetailByID($id);  // mengambil database dari model untuk dikirim ke view
		$countResultEssay  = count($rsResultEssay);		
		
		$this->data['rsResultEssay'] = $rsResultEssay;
		$this->data['countResultEssay'] = $countResultEssay;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/weeklyexam_result/edit',$this->data);
	}

	
	public function doEditEssay($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/weekly_exam_result");
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
		
		$weekly_exam_essay_value = $this->security->xss_clean(secure_input($_POST['weekly_exam_essay_value']));
		
		$rsResultEssay = $this->Model_weeklyexamresult->getListResultEssayDetailByID($id);  // mengambil database dari model untuk dikirim ke view
		$countResultEssay  = count($rsResultEssay);		
		
		$this->data['rsResultEssay'] = $rsResultEssay;
		$this->data['countResultEssay'] = $countResultEssay;
		
		$pesan = array();
		
		// Validasi data
		if ($weekly_exam_essay_value=="" || $weekly_exam_essay_value=="0") {
			$pesan[] = 'Value is empty';
		} 

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/weeklyexam_result/edit',$this->data);
			}
		} else {
			$update = $this->Model_weeklyexamresult->updateResultEssay($id,$weekly_exam_essay_value);
			
			redirect(BASE_URL_BACKEND."/weekly_exam_result");
		}
	}
}