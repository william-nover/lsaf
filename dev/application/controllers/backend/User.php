<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public $arrMenu = array();
	public $data = array();
	public $module = "User";
	public $section = 1;
	public $module_id = 2;
	
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
		
		$this->load->model(array('backend/Model_user','backend/Model_userlevel','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		
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
		$this->data['modul_id'] = 2;
		
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
				$where   =   " WHERE user_id <> 1 ";
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
					$where   =   " WHERE user_id <> 1 AND ".$searchby." LIKE '%". $searchkey ."%' ";
				}  else {
					$where   =   " WHERE user_id <> 1 ";
				}
			}	
		} else {
			$searchkey = @$_SESSION["searchkey".$this->module_id];
			$searchby = @$_SESSION["searchby".$this->module_id];
			
			if($searchkey != "" && $searchby != ""){
				$where   =   " WHERE user_id <> 1 AND ".$searchby." LIKE '%". $searchkey ."%' ";
			} else {
				$where   =   " WHERE user_id <> 1 ";
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
		
		$orderBy = "ORDER BY user_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsUser			= $this->Model_user->getListUser($cond);
		$base_url		= BASE_URL_BACKEND."/user/view/";
		$total_rows		= count($rsUser);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListUser"] = $this->Model_user->getListUser($cond);
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/user/list',$this->data);
	}
	
	function active($id){
		$id = $this->security->xss_clean(secure_input($id));
		
		if ($id == '') {
			redirect(BASE_URL_BACKEND."/user");
			exit();
		}
		
		$rsUser = $this->Model_user->getUser($id);
		$user_name = $rsUser[0]['user_name'];
		$useractive = abs($rsUser[0]['user_active_status']-1);
		
		$active = $this->Model_user->activeUser($id);
		
		if($useractive == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$user_name." | ".$useractive;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/user");
	}
	
	function delete($id=''){
		$id = $this->security->xss_clean(secure_input($id));
		
		if(empty($id)){
			redirect(BASE_URL_BACKEND."/user");
			exit();
		}
		
		$rsUser = $this->Model_user->getUser($id);
		$user_name = $rsUser[0]['user_name'];
		
		$delete = $this->Model_user->deleteUser($id);
		$log_module = "Delete ".$this->module;

		$log_value = $id." | ".$user_name;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		redirect(BASE_URL_BACKEND."/user");
	}
	
	public function add(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 2;
		
		$rsListUserLevel = $this->Model_userlevel->getListUserLevel(" WHERE user_level_active_status = 1");
		$this->data["ListUserLevel"] = $rsListUserLevel;
		$this->data["CountUserLevel"] = count($rsListUserLevel);
		
		$userlevelid = "";
		$this->data["userlevelid"] = $userlevelid;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/user/add',$this->data);
	}
	
	public function doAdd(){
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/user");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 2;
		
		$rsListUserLevel = $this->Model_userlevel->getListUserLevel(" WHERE user_level_active_status = 1");
		$this->data["ListUserLevel"] = $rsListUserLevel;
		$this->data["CountUserLevel"] = count($rsListUserLevel);
		
		$userlevelid = $_POST['userlevelid'];
		$username = $this->security->xss_clean(secure_input($_POST['username']));
		$email = $this->security->xss_clean(secure_input($_POST['email']));
		$password = $this->security->xss_clean(secure_input_password($_POST['password']));
		$retypepassword = $this->security->xss_clean(secure_input_password($_POST['retypepassword']));
		
		$pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
		
		$pesan = array();
		// Validasi data
		if ($userlevelid=="0") {
			$pesan[] = 'User Level has not been choose';
		}else if ($username=="") {
			$pesan[] = 'User Name is empty';
		} else if ($email=="") {
			$pesan[] = 'Email is empty';
		} else if ($password=="") {
			$pesan[] = 'Password is empty';
		} else if(!preg_match($pattern, $email)){
			$pesan[] = 'Email is not valid';
		} else if ($retypepassword=="") {
			$pesan[] = 'Retype Password is empty';
		} else if ($password != $retypepassword) {
			$pesan[] = 'Password not same with Retype Password';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$this->data['userlevelid']=$userlevelid;
				$this->data['username']=$username;
				$this->data['email']=$email;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/user/add',$this->data);
			}
		} else { 
			$cekUser = $this->Model_user->checkUser($username);
			$countUser = count($cekUser);
			
			if ($countUser > 0 ) {
				$this->data['error']='User Name '.$username.' already exist';
				
				$this->data['userlevelid']=$userlevelid;
				$this->data['username']=$username;
				$this->data['email']=$email;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/user/add',$this->data);
			} else {
				$insert = $this->Model_user->insertUser($userlevelid,$username,$email,$password);
				
				$log_module = "Add ".$this->module;
				$log_value = $userlevelid." | ".$username." | ".$email;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND."/user/");
			}
		}
	}
	
	public function edit($id){	
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/user");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 2;
		
		$rsListUserLevel = $this->Model_userlevel->getListUserLevel(" WHERE user_level_active_status = 1");
		$this->data["ListUserLevel"] = $rsListUserLevel;
		$this->data["CountUserLevel"] = count($rsListUserLevel);
		
		$rsUser = $this->Model_user->getUser($id);  // mengambil database dari model untuk dikirim ke view
		$countUser = count($rsUser);
		
		$this->data['rsUser'] = $rsUser;
		$this->data['countUser'] = $countUser;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/user/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/user");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'access';
		$this->data['modul_id'] = 2;
		
		$rsListUserLevel = $this->Model_userlevel->getListUserLevel(" WHERE user_level_active_status = 1");
		$this->data["ListUserLevel"] = $rsListUserLevel;
		$this->data["CountUserLevel"] = count($rsListUserLevel);
		
		$rsUser = $this->Model_user->getUser($id);  // mengambil database dari model untuk dikirim ke view
		$countUser = count($rsUser);
		
		$this->data['rsUser'] = $rsUser;
		$this->data['countUser'] = $countUser;
		
		$userlevelid = $_POST['userlevelid'];
		$username = $this->security->xss_clean(secure_input($_POST['username']));
		$usernameOld = $this->security->xss_clean(secure_input($_POST['usernameOld']));
		$email = $this->security->xss_clean(secure_input($_POST['email']));
		
		$pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
		
		$pesan = array();
		// Validasi data
		if ($userlevelid=="0") {
			$pesan[] = 'User Level has not been choose';
		}else if ($username=="") {
			$pesan[] = 'User Name is empty';
		} else if ($email=="") {
			$pesan[] = 'Email is empty';
		} else if(!preg_match($pattern, $email)){
			$pesan[] = 'Email is not valid';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['userlevelid']=$userlevelid;
				$this->data['username']=$username;
				$this->data['email']=$email;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/user/edit',$this->data);
			}
		} else {
			$cekUser = $this->Model_user->checkUser($username);
			$countUser = count($cekUser);
			
			if($username == $usernameOld){
				$countUser = 0;
			}
			
			if ($countUser > 0 ) {
				$this->data['error'] = 'User name '.$username.' already exist';
				
				$this->data['userlevelid']=$userlevelid;
				$this->data['username']=$username;
				$this->data['email']=$email;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/user/edit',$this->data);
			} else {
				$insert = $this->Model_user->updateUser($id,$username,$email,$userlevelid);
				
				$log_module = "Edit ".$this->module;
				$log_value = $id." | ".$userlevelid." | ".$username." | ".$email;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND."/user/");
			}
		}
	}
}