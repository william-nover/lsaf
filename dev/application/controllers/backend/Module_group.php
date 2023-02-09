<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_group extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $module = "Module Group";
	public $section = 1;
	public $module_id = 3;
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_module_group','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu'));
		
		if($_SESSION['admin_data']['user_level_id'] != 1) echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
		
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
		$this->data['modul_id'] =4;
		
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
				$where   =   " WHERE module_group_id <> 1 ";
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
					$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' AND module_group_id <> 1 ";
				} else {
					$where   =   " WHERE module_group_id <> 1 ";
				}
			}	
		} else {
			$searchkey = @$_SESSION["searchkey".$this->module_id];
			$searchby = @$_SESSION["searchby".$this->module_id];
			
			if($searchkey != "" && $searchby != ""){
				$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' AND module_group_id <> 1 ";
			} else {
				$where   =   " WHERE module_group_id <> 1 ";
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
		
		$orderBy = "ORDER BY module_group_order_value ASC, module_group_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsGroup		= $this->Model_module_group->getListGroup($cond);
		$base_url		= BASE_URL_BACKEND."/group/view/";
		$total_rows		= count($rsGroup);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListGroup"] = $this->Model_module_group->getListGroup($cond);
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module_group/list',$this->data);
	}
	
	function active($id){
		$id = $this->security->xss_clean(secure_input($id));
		if ($id == '') {
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$rsGroup = $this->Model_module_group->getGroup($id);  // mengambil database dari model untuk dikirim ke view
		$module_group_name = $rsGroup[0]['module_group_name'];
		$active_status = abs($rsGroup[0]['module_group_active_status']-1);
		
		$active = $this->Model_module_group->activeGroup($id);
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		
		$log_value = $id." | ".$module_group_name." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/module_group");
	}
	
	function delete($id=''){
		$id = $this->security->xss_clean(secure_input($id));
		
		if(empty($id)){
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$rsGroup = $this->Model_module_group->getGroup($id); 
		$module_group_name = $rsGroup[0]['module_group_name'];
		
		$delete = $this->Model_module_group->deleteGroup($id);
		$log_module = "Delete ".$this->module;
		
		$log_value = $id." | ".$module_group_name;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/module_group");
	}
	
	public function add(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] =4;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module_group/add',$this->data);
	}
	
	function doAdd(){
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] =4;
		
		$groupname = $this->security->xss_clean(secure_input($_POST['groupname']));
		
		$pesan = array();
		// Validasi data
		if ($groupname=="") {
			$pesan[] = 'Module Group Name is empty';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['groupname']=$groupname;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module_group/add',$this->data);
			}
		} else {
			$cekGroup = $this->Model_module_group->checkGroup($groupname);
			$countGroup = count($cekGroup);
			
			if ($countGroup > 0 ) {
				$this->data['error']='Module Group Name '.$groupname.' already exist';
				
				$this->data['groupname']=$groupname;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module_group/add',$this->data);
			} else {
				$insert = $this->Model_module_group->insertGroup($groupname);
				redirect(BASE_URL_BACKEND."/module_group/");
			}
			
		}
	}
	
	public function edit($id){	
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] =4;
		
		$rsGroup = $this->Model_module_group->getGroup($id);  // mengambil database dari model untuk dikirim ke view
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		if($countGroup == 0){
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/module_group/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/module_group");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] =4;
		
		$rsGroup = $this->Model_module_group->getGroup($id);  // mengambil database dari model untuk dikirim ke view
		$countGroup = count($rsGroup);
		
		$this->data['rsGroup'] = $rsGroup;
		$this->data['countGroup'] = $countGroup;
		
		
		$groupname = $this->security->xss_clean(secure_input($_POST['groupname']));
		$groupnameOld = $this->security->xss_clean(secure_input($_POST['groupnameOld']));
		
		$pesan = array();
		// Validasi data
		if ($groupname=="") {
			$pesan[] = 'Module Group Name is empty';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['groupname']=$groupname;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module_group/edit',$this->data);
			}
		} else {
			$cekGroup = $this->Model_module_group->checkGroup($groupname);
			$countGroup = count($cekGroup);
			
			if($groupname == $groupnameOld){
				$countGroup = 0;
			}
			
			if ($countGroup > 0 ) {
				$this->data['error'] = 'Module Group Name '.$groupname.' already exist';
				
				$this->data['groupname'] = $groupname;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/module_group/edit',$this->data);
			} else {
				$insert = $this->Model_module_group->updateGroup($id,$groupname);
				redirect(BASE_URL_BACKEND."/module_group/");
			}
		}
	}
	
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/module_group/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_module_group->updateOrderGroup($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/module_group/");
	}
}