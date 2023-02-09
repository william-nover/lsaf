<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_list extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 5; //get module group id from database
	public $module_id = 10; //get module id from database
	public $alias_category = "student_list";
	public $module = "Student_list";
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_student','backend/Model_lecturer','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
                $this->data['moduleLevel'] = $this->Model_student->getmoduleLevel();
               
//                echo'<pre>';
//                print_r( $this->data['getLecturer'] );
//                die;
		//check privilege module
		$this->privilege = accessprivilegeuserlevel($_SESSION['admin_data']['user_level_id'], $this->module_id);
		$this->breadcrump = breadCrump($this->module_id);
	}
	
	public function index()
	{
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
		
		$orderBy = "ORDER BY  a.student_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsStudent		= $this->Model_student->getListStudent($cond);
		$base_url		= BASE_URL_BACKEND."/Student_list/view/";
		$total_rows		= count($rsStudent);
		$per_page		= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListStudent = $this->Model_student->getListStudent($cond);
//                echo'<pre>';
//		print_r($ListStudent);
//                die;
		
		$this->data["ListStudent"] = $ListStudent;
		
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
		$this->load->view('backend/Student_list/list');
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
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/Student_list/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/student_list");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		$level_id = $this->security->xss_clean(secure_input($_POST['level_id']));
                $lecturer_id = $this->security->xss_clean(secure_input($_POST['lecturer_id']));
		$student_title = $this->security->xss_clean(secure_input($_POST['student_title']));
		
		
		$pesan = array();
		// Validasi data
		if ($student_title=="") {
			$pesan[] = 'Student Title is empty';
		} else if ($level_id==0) {
			$pesan[] = 'Level must choosed';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['level_id']=$level_id;
				$this->data['student_title']=$student_title;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Student_list/add',$this->data);
			}
		} else {
			$cekStudent = $this->Model_student->checkStudent($student_title);
			$countStudent = count($cekStudent);
			
			if ($countStudent > 0 ) {
				$this->data['error']='Student Title '.$student_title.' already exist';
                                $this->data['level_id']=$level_id;
				$this->data['student_title']=$student_title;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Student_list/add',$this->data);
			} else {
                            
                        $student_id = $this->Model_student->insertStudent($level_id,$lecturer_id,$student_title);


                        $log_module = "Add ".$this->module;
                        $log_value = $student_id." | ".$student_title;
                        $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);					
                        redirect(BASE_URL_BACKEND."/Student_list/");	
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/student_list");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsStudent = $this->Model_student->getStudent($id); 
		$title = $rsStudent[0]['student_title'];
		$active_status = abs($rsStudent[0]['student_active_status']-1);
		
		$active = $this->Model_student->activeStudent($id);
		
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Student
		
		//End Cache JSON Student

		redirect(BASE_URL_BACKEND."/student_list");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/student_list");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsStudent = $this->Model_student->getStudent($id); 
		$title = $rsStudent[0]['student_title'];
		
		$delete = $this->Model_student->deleteStudent($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Student
	
		//End Cache JSON Student
		
		redirect(BASE_URL_BACKEND."/student_list");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/student_list");
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
		
		$rsStudent = $this->Model_student->getStudent($id);  // mengambil database dari model untuk dikirim ke view
		
                $countStudent = count($rsStudent);
		
		$this->data['rsStudent'] = $rsStudent;
		$this->data['countStudent'] = $countStudent;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/Student_list/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/student_list");
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
		
		$rsStudent = $this->Model_student->getStudent($id);  // mengambil database dari model untuk dikirim ke view
		$countStudent = count($rsStudent);
		
		$this->data['rsStudent'] = $rsStudent;
		$this->data['countStudent'] = $countStudent;
                $module_level_id = $this->security->xss_clean(secure_input($_POST['module_level_id']));
		$student_pid = $this->security->xss_clean(secure_input($_POST['student_pid']));                    
		$student_name = $this->security->xss_clean(secure_input($_POST['student_name']));
		
		
		$pesan = array();
		// Validasi data
		
		$update = $this->Model_student->updateStudent($id,$module_level_id,$student_pid);					
					
                                $log_module = "Edit ".$this->module;
                                $log_value = $id." | ".$student_name;
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                redirect(BASE_URL_BACKEND."/Student_list/");	
		
		
		
	}
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/Student_list/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_student->updateOrderStudent($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/Student_list/");
	}
	
	
}