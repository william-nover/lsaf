<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_management extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 5; //get module group id from database
	public $module_id = 25; //get module id from database
	public $alias_category = "class_management";
	public $module = "Class_management";
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_class_management','backend/Model_subject','backend/Model_lecturer','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
                $this->data['getSubject'] = $this->Model_class_management->getSubject();
                $this->data['getStudent'] = $this->Model_class_management->getStudent();
//                echo'<pre>';
//                print_r( $this->data['getStudent'] );
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
		
		$orderBy = "ORDER BY a.class_management_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsClass_management		= $this->Model_class_management->getListClass_management($cond);
		$base_url		= BASE_URL_BACKEND."/class_management/view/";
		$total_rows		= count($rsClass_management);
		$per_page		= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListClass_management = $this->Model_class_management->getListClass_management($cond);
//                echo'<pre>';
//		print_r($ListClass_management);
//                die;
		
		$this->data["ListClass_management"] = $ListClass_management;
		
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
		$this->load->view('backend/class_management/list');
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
		$this->load->view('backend/class_management/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/class_management");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		$subject_id = $this->security->xss_clean(secure_input($_POST['subject_id']));
                $student_id = $this->security->xss_clean(secure_input($_POST['student_id']));
		$class_management_start_date = $this->security->xss_clean(secure_input($_POST['class_management_start_date']));
                $class_management_end_date = $this->security->xss_clean(secure_input($_POST['class_management_end_date']));
		
		
		$pesan = array();
		// Validasi data
		if ($class_management_start_date=="") {
			$pesan[] = 'Class Start date is empty';
		} else if ($class_management_end_date=="") {
			$pesan[] = 'Class End date is';
		} 
		else if ($student_id==0) {
			$pesan[] = 'Student must choosed';
		} 
                else if ($subject_id==0) {
			$pesan[] = 'Subject must choosed';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['subject_id']=$subject_id;
				$this->data['student_id']=$student_id;
                                $this->data['class_management_start_date']=$class_management_start_date;
				$this->data['class_management_end_date']=$class_management_end_date;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/class_management/add',$this->data);
			}
		} else {
			$cekClass_management = $this->Model_class_management->checkClass_management($student_id,$subject_id);
			$countClass_management = count($cekClass_management);
			
			if ($countClass_management > 0 ) {
				$this->data['error']='Class management already exist';
                                $this->data['student_id']=$student_id;
				$this->data['subject_id']=$subject_id;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/class_management/add',$this->data);
			} else {
                            
                        $class_management_id = $this->Model_class_management->insertClass_management($subject_id,$student_id,$class_management_start_date,$class_management_end_date);


                        $log_module = "Add ".$this->module;
                        $log_value = $class_management_id." | ".$subject_title;
                        $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);					
                        redirect(BASE_URL_BACKEND."/class_management/");	
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/class_management");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		 $rsClass_management = $this->Model_class_management->getClass_management($id);
                
		$title = $rsClass_management[0]['class_management_id'];
		$active_status = abs($rsClass_management[0]['class_management_active_status']-1);
		
		 $active = $this->Model_class_management->activeClass_management($id);
		
            //createRouteAlias(); //create route alias
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Class_management
		
		//End Cache JSON Class_management

		redirect(BASE_URL_BACKEND."/class_management");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/class_management");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsClass_management = $this->Model_class_management->getClass_management($id); 
		$title = $rsClass_management[0]['subject_title'];
		
		$delete = $this->Model_class_management->deleteClass_management($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Class_management
		
		//End Cache JSON Class_management
		
		redirect(BASE_URL_BACKEND."/class_management");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/class_management");
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
		
		$rsClass_management = $this->Model_class_management->getClass_management($id);  // mengambil database dari model untuk dikirim ke view
		
                $countClass_management = count($rsClass_management);
		
		$this->data['rsClass_management'] = $rsClass_management;
		$this->data['countClass_management'] = $countClass_management;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/class_management/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/class_management");
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
		
		$rsClass_management = $this->Model_class_management->getClass_management($id);  // mengambil database dari model untuk dikirim ke view
		$countClass_management = count($rsClass_management);
		
		$this->data['rsClass_management'] = $rsClass_management;
		$this->data['countClass_management'] = $countClass_management;
                
		$subject_id = $this->security->xss_clean(secure_input($_POST['subject_id']));
                $student_id = $this->security->xss_clean(secure_input($_POST['student_id']));
		$class_management_start_date = $this->security->xss_clean(secure_input($_POST['class_management_start_date']));
                $class_management_end_date = $this->security->xss_clean(secure_input($_POST['class_management_end_date']));
		
		
		
		$pesan = array();
		// Validasi data
		if ($class_management_start_date=="") {
			$pesan[] = 'Class Start date is empty';
		} else if ($class_management_end_date=="") {
			$pesan[] = 'Class End date is';
		} 
		else if ($student_id==0) {
			$pesan[] = 'Student must choosed';
		} 
                else if ($subject_id==0) {
			$pesan[] = 'Subject must choosed';
		}
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/class_management/edit',$this->data);
			}
		} else {
                    $update = $this->Model_class_management->updateClass_management($id,$subject_id,$student_id,$class_management_start_date,$class_management_end_date);					
					
                                $log_module = "Edit ".$this->module;
                                $log_value = $id." | Class Schedule";
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                redirect(BASE_URL_BACKEND."/class_management/");
                }
		
	}
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/class_management/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_class_management->updateOrderClass_management($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/class_management/");
	}
	
}