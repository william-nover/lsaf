<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tagging extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
//	public $section = 8; //get module group id from database
//	public $module_id = 15; //get module id from database
	public $alias_category = "Tagging";
	
	public function __construct()
	{
		parent::__construct();
                if( ! $_SESSION)
                {
                    session_start();
                }
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_tagging','backend/Model_gallery','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
                $module_name=  $this->uri->segment(2);
                $getmodule = $this->Model_tagging->getModule($module_name);
                foreach ($getmodule as $gm) {
                 $this->module_id = $gm->module_id;
                 $this->section = $gm->module_group_id;
                $_SESSION['module_id']=$this->module_id;
                }
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $module_name;
                $this->data['MenuTagging'] = $this->Model_menu_frontend->getMenuContent($_SESSION['module_id']);
               
		//check privilege module
		$this->privilege = accessprivilegeuserlevel($_SESSION['admin_data']['user_level_id'], $_SESSION['module_id']);
		$this->breadcrump = breadCrump($_SESSION['module_id']);
	}
	
	public function index()
	{
		$this->view();
	}
	
	function view(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $_SESSION['module_id'];
		$this->data['breadcrump'] = $this->breadcrump;
		
		$searchkey = "";
		$searchby = "";
		$where = "";
		$perpage = "";
		
		$orderBy = "ORDER BY tagging_id DESC";
		
		$cond 			= $where." ".$orderBy;

		$ListTagging = $this->Model_tagging->getListTagging($cond);
		
		$this->data["ListTagging"] = $ListTagging;

                
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
		
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/Tagging/list');
	}
	
	 function add(){
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
		$this->load->view('backend/Tagging/add',$this->data);
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
			redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
             
		$tagging_title = $this->security->xss_clean(secure_input($_POST['tagging_title']));	
		$pesan = array();
		// Validasi data
		if ($tagging_title=="") {
			$pesan[] = 'Tagging  is empty';
		} 
		  
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['tagging_title']=$tagging_title;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Tagging/add',$this->data);
			}
		} else {
			$cekTagging = $this->Model_tagging->checkTagging($tagging_title);
			$countTagging = count($cekTagging);
			
			if ($countTagging > 0 ) {
				$this->data['error']='Tagging Title '.$tagging_title.' already exist';
				
				$this->data['tagging_title']=$tagging_title;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Tagging/add',$this->data);
			} else {
				
				$tagging_id = $this->Model_tagging->insertTagging($tagging_title);
					
					
                                $log_module = "Add ".$this->module;
                                $log_value = $tagging_id." | ".$tagging_title;
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
					
                                redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
                                
                        }	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsTagging = $this->Model_tagging->getTagging($id); 
		$title = $rsTagging[0]['tagging_title'];
		$active_status = abs($rsTagging[0]['tagging_active_status']-1);
		
		$active = $this->Model_tagging->activeTagging($id);
		
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
                
              
		redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsTagging = $this->Model_tagging->getTagging($id); 
		$title = $rsTagging[0]['tagging_title'];
               
		$delete = $this->Model_tagging->deleteTagging($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
                
              
		
                redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
	}
       
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
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
		
		$rsTagging = $this->Model_tagging->getTagging($id);  // mengambil database dari model untuk dikirim ke view
		
                $countTagging = count($rsTagging);
		
               
		$this->data['rsTagging'] = $rsTagging;
		$this->data['countTagging'] = $countTagging;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/Tagging/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
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
		
		$rsTagging = $this->Model_tagging->getTagging($id);  // mengambil database dari model untuk dikirim ke view
		$countTagging = count($rsTagging);
		
		$this->data['rsTagging'] = $rsTagging;
		$this->data['countTagging'] = $countTagging;
                
		
		$tagging_title = $this->security->xss_clean(secure_input($_POST['tagging_title']));
		$tagging_titleOld = $this->security->xss_clean(secure_input($_POST['tagging_titleOld']));
		
		$pesan = array();
		// Validasi data
		if ($tagging_title=="") {
			$pesan[] = 'Tagging Title is empty';
		}
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Tagging/edit',$this->data);
			}
		} else {
			$cekTagging = $this->Model_tagging->checkTagging($tagging_title);
			$countTagging = count($cekTagging);
			
			if($tagging_title == $tagging_titleOld){
				$countTagging = 0;
			}
			
			if ($countTagging > 0 ) {
				$this->data['error']='Tagging Title '.$tagging_title.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/Tagging/edit',$this->data);
			} else {
				
                                
				$update = $this->Model_tagging->updateTagging($id,$tagging_title);		
					$log_module = "Edit ".$this->module;
					$log_value = $id." | ".$tagging_title;
					$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
					
					redirect(BASE_URL_BACKEND.'/'.$this->data['controller']);
				}	
		}
		
	}
	
}