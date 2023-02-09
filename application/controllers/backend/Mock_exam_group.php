<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mock_exam_group extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 12; //get module group id from database
	public $module_id = 31; //get module id from database
	public $module = "Mock Exam Group";

	public function __construct(){
		parent::__construct();
               
		session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}

		$this->load->model(array('backend/Model_mockexamgroup','backend/Model_logcms'));
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

		$orderBy = "ORDER BY mock_exam_group_id DESC";

		$cond 				= $where." ".$orderBy;
		$rsentry_question	= $this->Model_mockexamgroup->getListGroup($cond);
		$base_url			= BASE_URL_BACKEND."/mock_exam_group/view/";
		$total_rows			= count($rsentry_question);
		$per_page			= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$query = $this->Model_mockexamgroup->getListGroup($cond);
		
		$this->data["List_entry_question"] = $query;
		

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
		$this->load->view('backend/mockexam_group/list');
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

		$rsSubject		= $this->Model_mockexamgroup->getListSubject("WHERE subject_active_status = 1 ORDER BY subject_id DESC");
		$countSubject 	= count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/mockexam_group/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/mock_exam_group");
			exit();
		}

		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$rsSubject		= $this->Model_mockexamgroup->getListSubject("WHERE subject_active_status = 1 ORDER BY subject_id DESC");
		$countSubject 	= count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
		
		$mock_exam_grouptitle = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptitle']));
		$subject_id = $_POST['subject_id'];
		$mock_exam_groupstart = $this->security->xss_clean(secure_input($_POST['mock_exam_groupstart']));
		$mock_exam_groupend = $this->security->xss_clean(secure_input($_POST['mock_exam_groupend']));
		$mock_exam_grouptimer = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptimer']));
		$mock_exam_grouptimeressay = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptimeressay']));

		$pesan = array();
		
		// Validasi data
		if ($mock_exam_grouptitle=="") {
			$pesan[] = 'Group Title is empty';
		} else if ($subject_id==0) {
			$pesan[] = 'Subject is empty'; 
		} else if ($mock_exam_groupstart=="") {
			$pesan[] = 'Start Date is empty'; 
		} else if ($mock_exam_groupend=="") {
			$pesan[] = 'End Date is empty'; 
		} else if ($mock_exam_grouptimer=="") {
			$pesan[] = 'Group Timer is empty'; 
		} else if ($mock_exam_grouptimeressay=="") {
			$pesan[] = 'Group Timer Essay is empty'; 
		} 


		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->data['mock_exam_grouptitle']=$mock_exam_grouptitle;
				$this->data['subject_id']=$subject_id;
				$this->data['mock_exam_groupstart']=$mock_exam_groupstart;
				$this->data['mock_exam_groupend']=$mock_exam_groupend;
				$this->data['mock_exam_grouptimer']=$mock_exam_grouptimer;
				$this->data['mock_exam_grouptimeressay']=$mock_exam_grouptimeressay;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/mockexam_group/add',$this->data);
			}
		} else {
			$cekGroup = $this->Model_mockexamgroup->checkGroup($mock_exam_grouptitle, $subject_id);
			$countGroup = count($cekGroup);

			if ($countGroup > 0 ) {
				$this->data['error']='Group Title '.$mock_exam_grouptitle.' already exist';

				$this->data['mock_exam_grouptitle']=$mock_exam_grouptitle;
				$this->data['subject_id']=$subject_id;
				$this->data['mock_exam_groupstart']=$mock_exam_groupstart;
				$this->data['mock_exam_groupend']=$mock_exam_groupend;
				$this->data['mock_exam_grouptimer']=$mock_exam_grouptimer;
				$this->data['mock_exam_grouptimeressay']=$mock_exam_grouptimeressay;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/mockexam_group/add',$this->data);
			} else {
				$entry_groupid = $this->Model_mockexamgroup->insertGroup($mock_exam_grouptitle,$subject_id,$mock_exam_groupstart,$mock_exam_groupend,$mock_exam_grouptimer,$mock_exam_grouptimeressay);
				
				redirect(BASE_URL_BACKEND."/mock_exam_group");
			}	
		}	
	}

	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/mock_exam_group");
			exit();
		}

		//extract privilege
		$this->data["approve"] = $this->privilege[5];

		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsGroup = $this->Model_mockexamgroup->getGroup($id); 
		$title = $rsGroup[0]['mock_exam_group_title'];
		$active_status = abs($rsGroup[0]['mock_exam_group_active_status']-1);

		$active = $this->Model_mockexamgroup->activeGroup($id);

		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}

		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/mock_exam_group");
	}

	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/mock_exam_group");
			exit();
		}

		//extract privilege
		$this->data["delete"] = $this->privilege[6];

		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$rsGroup = $this->Model_mockexamgroup->getGroup($id); 
		$title = $rsGroup[0]['mock_exam_group_title'];

		$delete = $this->Model_mockexamgroup->deleteGroup($id);

		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

		redirect(BASE_URL_BACKEND."/mock_exam_group");
	}


	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/mock_exam_group");
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
		
		$rsSubject		= $this->Model_mockexamgroup->getListSubject("WHERE subject_active_status = 1 ORDER BY subject_id DESC");
		$countSubject 	= count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
		
		$rsGroup = $this->Model_mockexamgroup->getGroup($id);  // mengambil database dari model untuk dikirim ke view
		$countGroup  = count($rsGroup);		
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/mockexam_group/edit',$this->data);
	}

	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/mock_exam_group");
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
		
		$rsSubject		= $this->Model_mockexamgroup->getListSubject("WHERE subject_active_status = 1 ORDER BY subject_id DESC");
		$countSubject 	= count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
		
		$mock_exam_grouptitle = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptitle']));
		$mock_exam_grouptitleOld = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptitleOld']));
		$subject_id = $_POST['subject_id'];
		$mock_exam_groupstart = $this->security->xss_clean(secure_input($_POST['mock_exam_groupstart']));
		$mock_exam_groupend = $this->security->xss_clean(secure_input($_POST['mock_exam_groupend']));
		$mock_exam_grouptimer = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptimer']));
		$mock_exam_grouptimeressay = $this->security->xss_clean(secure_input($_POST['mock_exam_grouptimeressay']));
		
		$rsGroup = $this->Model_mockexamgroup->getGroup($id);  // mengambil database dari model untuk dikirim ke view
		$countGroup  = count($rsGroup);		

		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		$pesan = array();
		
		// Validasi data
		if ($mock_exam_grouptitle=="") {
			$pesan[] = 'Group Title is empty';
		} else if ($subject_id==0) {
			$pesan[] = 'Subject is empty'; 
		} else if ($mock_exam_groupstart=="") {
			$pesan[] = 'Start Date is empty'; 
		} else if ($mock_exam_groupend=="") {
			$pesan[] = 'End Date is empty'; 
		} else if ($mock_exam_grouptimer=="") {
			$pesan[] = 'Group Timer is empty'; 
		} else if ($mock_exam_grouptimeressay=="") {
			$pesan[] = 'Group Timer Essay is empty'; 
		} 

		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/mockexam_group/edit',$this->data);
			}
		} else {
			$cekGroup = $this->Model_mockexamgroup->checkGroup($mock_exam_grouptitle, $subject_id);
			$countGroup = count($cekGroup);
			
			if($mock_exam_grouptitle == $mock_exam_grouptitleOld){
				$countGroup = 0;
			}
			
			if ($countGroup > 0 ) {
				$this->data['error']='Group Title '.$mock_exam_grouptitle.' already exist';
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/mockexam_group/edit',$this->data);
			} else {	
				$update = $this->Model_mockexamgroup->updateGroup($id,$mock_exam_grouptitle,$subject_id,$mock_exam_groupstart,$mock_exam_groupend,$mock_exam_grouptimer,$mock_exam_grouptimeressay);
			
				redirect(BASE_URL_BACKEND."/mock_exam_group");
			}	
		}
	}
}