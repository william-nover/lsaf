<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lecturer extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 5; //get module group id from database
	public $module_id = 12; //get module id from database
	public $alias_category = "lecturer";
	public $module = "Lecturer";
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_lecturer','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
                //$this->data['levelLecturer'] = $this->Model_lecturer->getlevelLecturer();
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
		
		$orderBy = "ORDER BY  a.lecturer_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsLecturer		= $this->Model_lecturer->getListLecturer($cond);
		$base_url		= BASE_URL_BACKEND."/lecturer/view/";
		$total_rows		= count($rsLecturer);
		$per_page		= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListLecturer = $this->Model_lecturer->getListLecturer($cond);
//                echo'<pre>';
//		print_r($ListLecturer);
//                die;
		
		$this->data["ListLecturer"] = $ListLecturer;
		
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
		$this->load->view('backend/lecturer/list');
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
		$this->load->view('backend/lecturer/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/lecturer");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$lecturer_name = $this->security->xss_clean(secure_input($_POST['lecturer_name']));
		$lecturer_gender = $this->security->xss_clean(secure_input($_POST['lecturer_gender']));
                $lecturer_email = $this->security->xss_clean(secure_input($_POST['lecturer_email']));
		$lecturer_address = $this->security->xss_clean(secure_input($_POST['lecturer_address']));
		$pesan = array();
		// Validasi data
		if ($lecturer_name=="") {
			$pesan[] = 'Lecturer Name is empty';
		} else if ($lecturer_email=="") {
			$pesan[] = 'Lecturer email is empty';
		} 
		else if ($lecturer_address=="") {
			$pesan[] = 'Lecturer Address is empty';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['lecturer_name']=$lecturer_name;
				$this->data['lecturer_email']=$lecturer_email;
				$this->data['lecturer_address']=$lecturer_address;
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/lecturer/add',$this->data);
			}
		} else {
			$cekLecturer = $this->Model_lecturer->checkLecturer($lecturer_name);
			$countLecturer = count($cekLecturer);
			
			if ($countLecturer > 0 ) {
				$this->data['error']='Lecturer Name '.$lecturer_name.' already exist';   
				$this->data['lecturer_name']=$lecturer_name;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/lecturer/add',$this->data);
			} else {
                            
                        $lecturer_id = $this->Model_lecturer->insertLecturer($lecturer_name,$lecturer_gender,$lecturer_email,$lecturer_address);


                        $log_module = "Add ".$this->module;
                        $log_value = $lecturer_id." | ".$lecturer_name;
                        $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);					
                        redirect(BASE_URL_BACKEND."/lecturer/");	
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/lecturer");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsLecturer = $this->Model_lecturer->getLecturer($id); 
		$title = $rsLecturer[0]['lecturer_name'];
		$active_status = abs($rsLecturer[0]['lecturer_active_status']-1);
		
		$active = $this->Model_lecturer->activeLecturer($id);
		createRouteAlias(); //create route alias
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Lecturer
		
		//End Cache JSON Lecturer

		redirect(BASE_URL_BACKEND."/lecturer");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/lecturer");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsLecturer = $this->Model_lecturer->getLecturer($id); 
		$title = $rsLecturer[0]['lecturer_name'];
		
		$delete = $this->Model_lecturer->deleteLecturer($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Lecturer
//		$ListLecturer = $this->generateLecturer();
//		createCache($ListLecturer,"lecturer_");
		//End Cache JSON Lecturer
		
		redirect(BASE_URL_BACKEND."/lecturer");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/lecturer");
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
		
		$rsLecturer = $this->Model_lecturer->getLecturer($id);  // mengambil database dari model untuk dikirim ke view
		
                $countLecturer = count($rsLecturer);
		
		$this->data['rsLecturer'] = $rsLecturer;
		$this->data['countLecturer'] = $countLecturer;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/lecturer/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/lecturer");
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
		
		$rsLecturer = $this->Model_lecturer->getLecturer($id);  // mengambil database dari model untuk dikirim ke view
		$countLecturer = count($rsLecturer);
		
		$this->data['rsLecturer'] = $rsLecturer;
		$this->data['countLecturer'] = $countLecturer;
                
		$lecturer_name = $this->security->xss_clean(secure_input($_POST['lecturer_name']));
		$lecturer_gender = $this->security->xss_clean(secure_input($_POST['lecturer_gender']));
                $lecturer_email = $this->security->xss_clean(secure_input($_POST['lecturer_email']));
		$lecturer_address = $this->security->xss_clean(secure_input($_POST['lecturer_address']));		
		$lecturer_nameOld = $this->security->xss_clean(secure_input($_POST['lecturer_nameOld']));
		
		
		$pesan = array();
		// Validasi data
		if ($lecturer_name=="") {
			$pesan[] = 'Lecturer Name is empty';
		} else if ($lecturer_email=="") {
			$pesan[] = 'Lecturer email is empty';
		} 
		else if ($lecturer_address=="") {
			$pesan[] = 'Lecturer Address is empty';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/lecturer/edit',$this->data);
			}
		} else {
			$cekLecturer = $this->Model_lecturer->checkLecturer($lecturer_name);
			$countLecturer = count($cekLecturer);
			
			if($lecturer_name == $lecturer_nameOld){
				$countLecturer = 0;
			}
			
			if ($countLecturer > 0 ) {
				$this->data['error']='Lecturer Name '.$lecturer_name.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/lecturer/edit',$this->data);
			} else {
				$update = $this->Model_lecturer->updateLecturer($id,$lecturer_name,$lecturer_gender,$lecturer_email,$lecturer_address);				
					
                                $log_module = "Edit ".$this->module;
                                $log_value = $id." | ".$lecturer_name;
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                redirect(BASE_URL_BACKEND."/lecturer/");				
			}	
		}
		
	}

	
}