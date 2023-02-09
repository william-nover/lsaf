<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $module = "Module";
	public $section = 1;
	public $module_id = 5;
	
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
		
		$this->load->model(array('backend/Model_module','backend/Model_module_group','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu'));
		
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
		$this->data['modul_id'] = 5;
		
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
				$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' AND module_id <> 1 ";
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
		
		$orderBy = "ORDER BY module_group_id ASC, module_order_value ASC, module_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsModule		= $this->Model_module->getListModule($cond);
		$base_url		= BASE_URL_BACKEND."/module/view/";
		$total_rows		= count($rsModule);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListModule"] = $this->Model_module->getListModule($cond);
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module/list',$this->data);
	}
	
	function active($id){
		$id = $this->security->xss_clean(secure_input($id));
		if ($id == '') {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$rsModule = $this->Model_module->getModule($id);
		$module_name = $rsModule[0]['module_name'];
		$active_status = abs($rsModule[0]['module_active_status']-1);
		
		$active = $this->Model_module->activeModule($id);
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		
		$log_value = $id." | ".$module_name." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/module");
	}
	
	function delete($id=''){
		$id = $this->security->xss_clean(secure_input($id));
		
		if(empty($id)){
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$rsModule = $this->Model_module->getModule($id);
		$module_name = $rsModule[0]['module_name'];
		
		$delete = $this->Model_module->deleteModule($id);
		
		$log_module = "Delete ".$this->module;
		
		$log_value = $id." | ".$module_name;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/module");
	}
	
	function deleteSelectedData($id=''){
		$id = $this->security->xss_clean(secure_input($id));
		
		if(empty($id)){
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$delete = $this->Model_module->deleteSelectedModule($id);
		$log_module = "Delete Selected ".$this->module;
		$log_value = $id;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/module");
	}
	
	public function add(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$rsListGroup = $this->Model_module_group->getListGroup(" WHERE module_group_active_status = 1 AND module_group_id <> 1");
		$this->data["ListGroup"] = $rsListGroup;
		$this->data["CountListGroup"] = count($rsListGroup);
		
		$modulegroupid = "";
		$this->data["modulegroupid"] = $modulegroupid;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module/add',$this->data);
	}
	
	function doAdd(){
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$rsListGroup = $this->Model_module_group->getListGroup(" WHERE module_group_active_status = 1 AND module_group_id <> 1");
		$this->data["ListGroup"] = $rsListGroup;
		$this->data["CountListGroup"] = count($rsListGroup);
		
		$modulegroupid = $_POST['module_group_id'];
		$modulename = $this->security->xss_clean(secure_input($_POST['modulename']));
		$modulepath = $this->security->xss_clean(secure_input($_POST['modulepath']));
		
		$pesan = array();
		// Validasi data
		if ($modulegroupid=="0") {
			$pesan[] = 'Group Name has not been choose';
		} else if ($modulename=="") {
			$pesan[] = 'Module Name is empty';
		} else if ($modulepath=="") {
			$pesan[] = 'Module Controller is empty';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['modulegroupid']=$modulegroupid;
				$this->data['modulename']=$modulename;
				$this->data['modulepath']=$modulepath;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module/add',$this->data);
			}
		} else {
			$cekModule = $this->Model_module->checkModule($modulename,$modulegroupid);
			$countModule = count($cekModule);
			
			if ($countModule > 0 ) {
				$this->data['error']='Module Name '.$modulename.' already exist';
				
				$this->data['modulegroupid']=$modulegroupid;
				$this->data['modulename']=$modulename;
				$this->data['modulepath']=$modulepath;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module/add',$this->data);
			} else {
				$insert = $this->Model_module->insertModule($modulename,$modulepath,$modulegroupid);
				redirect(BASE_URL_BACKEND."/module/");
			}
			
		}
	}
	
	public function edit($id){	
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$rsListGroup = $this->Model_module_group->getListGroup(" WHERE module_group_active_status = 1 AND module_group_id <> 1");
		$this->data["ListGroup"] = $rsListGroup;
		$this->data["CountListGroup"] = count($rsListGroup);
		
		$rsModule = $this->Model_module->getModule($id);  // mengambil database dari model untuk dikirim ke view
		$countModule = count($rsModule);
		
		$this->data['rsModule'] = $rsModule;
		$this->data['countModule'] = $countModule;
		
		if($countModule == 0){
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$rsListGroup = $this->Model_module_group->getListGroup(" WHERE module_group_active_status = 1 AND module_group_id <> 1");
		$this->data["ListGroup"] = $rsListGroup;
		$this->data["CountListGroup"] = count($rsListGroup);
		
		$rsModule = $this->Model_module->getModule($id);  // mengambil database dari model untuk dikirim ke view
		$countModule = count($rsModule);
		
		$this->data['rsModule'] = $rsModule;
		$this->data['countModule'] = $countModule;
		
		$modulegroupid = $_POST['module_group_id'];
		$modulename = $this->security->xss_clean(secure_input($_POST['modulename']));
		$modulenameOld = $this->security->xss_clean(secure_input($_POST['modulenameOld']));
		$modulepath = $this->security->xss_clean(secure_input($_POST['modulepath']));
		
		$pesan = array();
		// Validasi data
		if ($modulegroupid=="0") {
			$pesan[] = 'Group Name has not been choose';
		} else if ($modulename=="") {
			$pesan[] = 'Module Name is empty';
		} else if ($modulepath=="") {
			$pesan[] = 'Module Controller is empty';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['modulegroupid']=$modulegroupid;
				$this->data['modulename']=$modulename;
				$this->data['modulepath']=$modulepath;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module/edit',$this->data);
			}
		} else {
			$cekModule = $this->Model_module->checkModule($modulename,$modulegroupid);
			$countModule = count($cekModule);
			
			if($modulename == $modulenameOld){
				$countModule = 0;
			}
			
			if ($countModule > 0 ) {
				$this->data['error'] = 'Module Name '.$modulename.' already exist';
				
				$this->data['modulegroupid']=$modulegroupid;
				$this->data['modulename']=$modulename;
				$this->data['modulepath']=$modulepath;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module/edit',$this->data);
			} else {
				$insert = $this->Model_module->updateModule($id,$modulename,$modulepath,$modulegroupid);
				redirect(BASE_URL_BACKEND."/module/");
			}
		}
	}

	
	public function listmoduleprivilege($id){	
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$rsModule = $this->Model_module->getModule($id);
		$this->data['id'] = $id;
		$this->data['modulename'] = $rsModule[0]['module_name'];
		
		$rsListModulePrivilege = $this->Model_module->getListModulePrivilege(" WHERE a.module_id = ".$id);
		$this->data['ListModulePrivilege'] = $rsListModulePrivilege;
		$this->data['countModulePrivilege'] = count($rsListModulePrivilege);
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module/listprivilege',$this->data);
		
	}
	
	public function addmoduleprivilege($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/module");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$this->data['id'] = $id;
		$rsModule = $this->Model_module->getModule($id);
		$this->data['id'] = $id;
		$this->data['modulename'] = $rsModule[0]['module_name'];
		
		$rsListPrivilege = $this->Model_module->getPrivilege();
		$this->data['ListPrivilege'] = $rsListPrivilege;
		$this->data['countListPrivilege'] = count($rsListPrivilege);
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module/addprivilege',$this->data);
	}
	
	public function doAddmoduleprivilege(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 5;
		
		$privilegeid = @$_POST['privilegeid'];
		$id = $_POST['moduleid'];
		
		
		
		$rsModule = $this->Model_module->getModule($id);
		$this->data['id'] = $id;
		$this->data['modulename'] = $rsModule[0]['module_name'];
		
		$rsListPrivilege = $this->Model_module->getPrivilege();
		$this->data['ListPrivilege'] = $rsListPrivilege;
		$this->data['countListPrivilege'] = count($rsListPrivilege);
		
		$pesan = array();
		// Validasi data
		if ($privilegeid=="") {
			$pesan[] = 'Privilege Name has not been choose';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['privilegeid'] = $privilegeid;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module/addprivilege',$this->data);
			}	
		} else {
			$rsDeleteModulePrivilege = $this->Model_module->deleteModulePrivilege($id);
			foreach ($privilegeid as $p_id) {
				$moduleprivilegeid = $this->Model_module->insertModulePrivilege($id,$p_id);
			}
			redirect(BASE_URL_BACKEND."/module/listmoduleprivilege/".$id);
		}
	}
	
	public function deletemoduleprivilege($id,$moduleid){
		$delete = $this->Model_module->deleteModulePrivilegeOne($id);
		redirect(BASE_URL_BACKEND."/module/listmoduleprivilege/".$moduleid);
	}
	
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/module/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_module->updateOrderModule($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/module/");
	}
}