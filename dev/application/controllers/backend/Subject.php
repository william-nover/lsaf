<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 5; //get module group id from database
	public $module_id = 11; //get module id from database
	public $alias_category = "subject";
	public $module = "Subject";
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_subject','backend/Model_lecturer','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
                $this->data['moduleLevel'] = $this->Model_subject->getmoduleLevel();
                $this->data['getLecturer'] = $this->Model_lecturer->getLecturerActive();
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
		
		$orderBy = "ORDER BY  a.subject_order ASC, a.subject_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsSubject		= $this->Model_subject->getListSubject($cond);
		$base_url		= BASE_URL_BACKEND."/subject/view/";
		$total_rows		= count($rsSubject);
		$per_page		= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListSubject = $this->Model_subject->getListSubject($cond);
//                echo'<pre>';
//		print_r($ListSubject);
//                die;
		
		$this->data["ListSubject"] = $ListSubject;
		
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
		$this->load->view('backend/subject/list');
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
		$this->load->view('backend/subject/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/subject");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		$module_level_id = $this->security->xss_clean(secure_input($_POST['module_level_id']));
                $lecturer_id = $this->security->xss_clean(secure_input($_POST['lecturer_id']));
		$subject_title = $this->security->xss_clean(secure_input($_POST['subject_title']));
		
		
		$pesan = array();
		// Validasi data
		if ($subject_title=="") {
			$pesan[] = 'Subject Title is empty';
		} else if ($module_level_id==0) {
			$pesan[] = 'Level must choosed';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['level_id']=$module_level_id;
				$this->data['subject_title']=$subject_title;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/subject/add',$this->data);
			}
		} else {
			$cekSubject = $this->Model_subject->checkSubject($subject_title);
			$countSubject = count($cekSubject);
			
			if ($countSubject > 0 ) {
				$this->data['error']='Subject Title '.$subject_title.' already exist';
                                $this->data['level_id']=$module_level_id;
				$this->data['subject_title']=$subject_title;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/subject/add',$this->data);
			} else {
                            
                        $subject_id = $this->Model_subject->insertSubject($module_level_id,$lecturer_id,$subject_title);


                        $log_module = "Add ".$this->module;
                        $log_value = $subject_id." | ".$subject_title;
                        $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);					
                        redirect(BASE_URL_BACKEND."/subject/");	
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/subject");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsSubject = $this->Model_subject->getSubject($id); 
		$title = $rsSubject[0]['subject_title'];
		$active_status = abs($rsSubject[0]['subject_active_status']-1);
		
		$active = $this->Model_subject->activeSubject($id);
		createRouteAlias(); //create route alias
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Subject
		
		//End Cache JSON Subject

		redirect(BASE_URL_BACKEND."/subject");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/subject");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsSubject = $this->Model_subject->getSubject($id); 
		$title = $rsSubject[0]['subject_title'];
		
		$delete = $this->Model_subject->deleteSubject($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Subject
		
		//End Cache JSON Subject
		
		redirect(BASE_URL_BACKEND."/subject");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/subject");
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
		
		$rsSubject = $this->Model_subject->getSubject($id);  // mengambil database dari model untuk dikirim ke view
		
                $countSubject = count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/subject/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/subject");
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
		
		$rsSubject = $this->Model_subject->getSubject($id);  // mengambil database dari model untuk dikirim ke view
		$countSubject = count($rsSubject);
		
		$this->data['rsSubject'] = $rsSubject;
		$this->data['countSubject'] = $countSubject;
                
		$module_level_id = $this->security->xss_clean(secure_input($_POST['module_level_id']));    
                $lecturer_id = $this->security->xss_clean(secure_input($_POST['lecturer_id']));
		$subject_title = $this->security->xss_clean(secure_input($_POST['subject_title']));		
		$subject_titleOld = $this->security->xss_clean(secure_input($_POST['subject_titleOld']));
		
		
		$pesan = array();
		// Validasi data
		if ($subject_title=="") {
			$pesan[] = 'Subject Title is empty';
		} else if ($module_level_id==0) {
			$pesan[] = 'level must choose';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/subject/edit',$this->data);
			}
		} else {
			$cekSubject = $this->Model_subject->checkSubject($subject_title);
			$countSubject = count($cekSubject);
			
			if($subject_title == $subject_titleOld){
				$countSubject = 0;
			}
			
			if ($countSubject > 0 ) {
				$this->data['error']='Subject Title '.$subject_title.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/subject/edit',$this->data);
			} else {
				$update = $this->Model_subject->updateSubject($id,$module_level_id,$lecturer_id,$subject_title);					
					
                                $log_module = "Edit ".$this->module;
                                $log_value = $id." | ".$subject_title;
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                redirect(BASE_URL_BACKEND."/subject/");				
			}	
		}
		
	}
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/subject/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_subject->updateOrderSubject($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/subject/");
	}
	
}