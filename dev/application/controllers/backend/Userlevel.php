<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlevel extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $module = "User Level";
	public $section = 1;
	public $module_id = 1;
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		if($_SESSION['admin_data']['user_level_id'] != 1) echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
		
		$this->load->model(array('backend/Model_userlevel','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu'));
		$this->load->library(array('Writelog'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
        $this->data['ListMenu'] = $this->arrMenu;
		$this->data['CountMenu'] = count($this->arrMenu);
	}
	
	public function index()
	{
		$this->view();
	}
	
	public function view(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 3;
		
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
		
		$orderBy = "ORDER BY user_level_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsUserLevel	= $this->Model_userlevel->getListUserLevel($cond);
		$base_url		= BASE_URL_BACKEND."/userlevel/view/";
		$total_rows		= count($rsUserLevel);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListUserLevel"] = $this->Model_userlevel->getListUserLevel($cond);
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/userlevel/list',$this->data);
	}
	
	function active($id){
		$id = $this->security->xss_clean(secure_input($id));
		
		if ($id == '') {
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$rsUserLevel = $this->Model_userlevel->getUserLevel($id); 
		$userlevelname = $rsUserLevel[0]['user_level_name'];
		$userlevelactive = abs($rsUserLevel[0]['user_level_active_status']-1);
		
		$active = $this->Model_userlevel->activeUserLevel($id);
		
		if($userlevelactive == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$userlevelname." | ".$userlevelactive;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/userlevel");
	}
	
	function delete($id){
		$id = $this->security->xss_clean(secure_input($id));
		
		if(empty($id)){
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$rsUserLevel = $this->Model_userlevel->getUserLevel($id); 
		$userlevelname = $rsUserLevel[0]['user_level_name'];
		
		$delete = $this->Model_userlevel->deleteUserLevel($id);
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$userlevelname;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/userlevel");
	}
	
	public function add(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 3;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/userlevel/add',$this->data);
	}
	
	function doAdd(){
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 3;
		
		$userlevelname = $this->security->xss_clean(secure_input($_POST['userlevelname']));
		$userleveldesc = $this->security->xss_clean(secure_input($_POST['userleveldesc']));
		
		$pesan = array();
		// Validasi data
		if ($userlevelname=="") {
			$pesan[] = 'User Level Name is empty';
		} else if ($userleveldesc=="") {
			$pesan[] = 'User Level Description is empty';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['userlevelname']=$userlevelname;
				$this->data['userleveldesc']=$userleveldesc;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/userlevel/add',$this->data);
			}
		} else {
			$cekUserLevel = $this->Model_userlevel->checkUserLevel($userlevelname);
			$countUserLevel = count($cekUserLevel);
			
			if ($countUserLevel > 0 ) {
				$this->data['error']='User Level Name '.$userlevelname.' already exist';
				
				$this->data['userlevelname']=$userlevelname;
				$this->data['userleveldesc']=$userleveldesc;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/userlevel/add',$this->data);
			} else {
				$insert = $this->Model_userlevel->insertUserLevel($userlevelname,$userleveldesc);
				
				$log_module = "Add ".$this->module;
				$log_value = $userlevelname." | ".$userleveldesc;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND."/userlevel/");
			}
			
		}
	}
	
	public function edit($id){	
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 3;
		
		$rsUserLevel = $this->Model_userlevel->getUserLevel($id);  // mengambil database dari model untuk dikirim ke view
		$countUserLevel = count($rsUserLevel);
		
		$this->data['rsUserLevel'] = $rsUserLevel;
		$this->data['countUserLevel'] = $countUserLevel;
		
		if($countUserLevel == 0){
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/userlevel/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/userlevel");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 3;
		
		$rsUserLevel = $this->Model_userlevel->getUserLevel($id);  // mengambil database dari model untuk dikirim ke view
		$countUserLevel = count($rsUserLevel);
		
		$this->data['rsUserLevel'] = $rsUserLevel;
		$this->data['countUserLevel'] = $countUserLevel;
		
		
		$userlevelname = $this->security->xss_clean(secure_input($_POST['userlevelname']));
		$userlevelnameOld = $this->security->xss_clean(secure_input($_POST['userlevelnameOld']));
		$userleveldesc = $this->security->xss_clean(secure_input($_POST['userleveldesc']));
		
		$pesan = array();
		// Validasi data
		if ($userlevelname=="") {
			$pesan[] = 'User Level Name is empty';
		} else if ($userleveldesc=="") {
			$pesan[] = 'User Level Description is empty';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['userlevelname']=$userlevelname;
				$this->data['userleveldesc']=$userleveldesc;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/userlevel/edit',$this->data);
			}
		} else {
			$cekUserLevel = $this->Model_userlevel->checkUserLevel($userlevelname);
			$countUserLevel = count($cekUserLevel);
			
			if($userlevelname == $userlevelnameOld){
				$countUserLevel = 0;
			}
			
			if ($countUserLevel > 0 ) {
				$this->data['error'] = 'User Level Name '.$userlevelname.' already exist';
				
				$this->data['userlevelname'] = $userlevelname;
				$this->data['userleveldesc'] = $userleveldesc;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/userlevel/edit',$this->data);
			} else {
				$insert = $this->Model_userlevel->updateUserLevel($id,$userlevelname,$userleveldesc);
				
				$log_module = "Edit ".$this->module;
				$log_value = $id." | ".$userlevelname." | ".$userleveldesc;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND."/userlevel/");
			}
		}
	}
}