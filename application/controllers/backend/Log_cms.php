<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cms extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 2; //get module group id from database
	public $module_id = 2; //get module id from database
	public $module = "Log History CMS";
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_logcms', 'backend/Model_language'));
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
					
					$where   .=   " WHERE b.user_level_id = ".$_SESSION['admin_data']['user_level_id'];
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
					if($_SESSION['admin_data']['user_level_id'] == 1){
						$where   .=   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
					} else {
						$where   .=   " WHERE b.user_id = ".$_SESSION['admin_data']['user_id']." AND ".$searchby." LIKE '%". $searchkey ."%' ";
					}
				} else {
					if($_SESSION['admin_data']['user_level_id'] == 1){
					
					} else {
						$where   .=   " WHERE b.user_id = ".$_SESSION['admin_data']['user_id'];
					}
				}
			}	
		} else {
			$searchkey = @$_SESSION["searchkey".$this->module_id];
			$searchby = @$_SESSION["searchby".$this->module_id];
			
			if($searchkey != "" && $searchby != ""){
				if($_SESSION['admin_data']['user_level_id'] == 1){
					$where   .=   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
				} else {
					$where   .=   " WHERE b.user_id = ".$_SESSION['admin_data']['user_id']." AND ".$searchby." LIKE '%". $searchkey ."%' ";
				}
			} else {
				if($_SESSION['admin_data']['user_level_id'] == 1){
					
				} else {
					$where   .=   " WHERE b.user_id = ".$_SESSION['admin_data']['user_id'];
				}
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
		
		$orderBy = "ORDER BY log_id_cms DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsLogCMS	= $this->Model_logcms->getListLogCMS($cond);
		$base_url		= BASE_URL_BACKEND."/log_cms/view/";
		$total_rows		= count($rsLogCMS);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListLogCMS"] = $this->Model_logcms->getListLogCMS($cond);
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
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
		$this->load->view('backend/log_cms/list');
	}
}