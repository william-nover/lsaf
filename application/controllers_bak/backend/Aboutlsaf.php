<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutlsaf extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 3; //get module group id from database
	public $module_id = 5; //get module id from database
	public $alias_category = "aboutlsaf";
	public $module = "Aboutlsaf";
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_content','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
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
		
		$orderBy = "ORDER BY content_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsUserLevel	= $this->Model_content->getListContent($cond);
		$base_url		= BASE_URL_BACKEND."/aboutlsaf/view/";
		$total_rows		= count($rsUserLevel);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListContent = $this->Model_content->getListContent($cond);
		
		$this->data["ListContent"] = $ListContent;
		
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
		$this->load->view('backend/content/list');
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
		$this->load->view('backend/content/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/aboutlsaf");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$aboutlsaftitle = $this->security->xss_clean(secure_input($_POST['aboutlsaftitle']));
		$aboutlsafshortdesc = secure_input_editor($_POST['aboutlsafshortdesc']);
		$aboutlsafdesc = secure_input_editor($_POST['aboutlsafdesc']);
		$aboutlsafimageurl = $this->security->xss_clean(secure_input($_POST['aboutlsafimageurl']));
		$aboutlsafalias = $this->security->xss_clean(secure_input($_POST['aboutlsafalias']));
		$aboutlsafmetadescription = $this->security->xss_clean(secure_input($_POST['aboutlsafmetadescription']));
		$aboutlsafmetakeywords = $this->security->xss_clean(secure_input($_POST['aboutlsafmetakeywords']));
		
		$pesan = array();
		// Validasi data
		if ($aboutlsaftitle=="") {
			$pesan[] = 'Aboutlsaf Title is empty';
		} else if ($aboutlsafdesc=="") {
			$pesan[] = 'Aboutlsaf Description is empty';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['aboutlsaftitle']=$aboutlsaftitle;
				$this->data['aboutlsafshortdesc']=$aboutlsafshortdesc;
				$this->data['aboutlsafdesc']=$aboutlsafdesc;
				$this->data['aboutlsafimageurl']=$aboutlsafimageurl;
				$this->data['aboutlsafalias']=$aboutlsafalias;
				$this->data['aboutlsafmetadescription']=$aboutlsafmetadescription;
				$this->data['aboutlsafmetakeywords']=$aboutlsafmetakeywords;
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/content/add',$this->data);
			}
		} else {
			$cekAboutlsaf = $this->Model_content->checkAboutlsaf($aboutlsaftitle);
			$countAboutlsaf = count($cekAboutlsaf);
			
			if ($countAboutlsaf > 0 ) {
				$this->data['error']='Aboutlsaf Title '.$aboutlsaftitle.' already exist';
				
				$this->data['aboutlsaftitle']=$aboutlsaftitle;
				$this->data['aboutlsafshortdesc']=$aboutlsafshortdesc;
				$this->data['aboutlsafdesc']=$aboutlsafdesc;
				$this->data['aboutlsafimageurl']=$aboutlsafimageurl;
				$this->data['aboutlsafalias']=$aboutlsafalias;
				$this->data['aboutlsafmetadescription']=$aboutlsafmetadescription;
				$this->data['aboutlsafmetakeywords']=$aboutlsafmetakeywords;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/content/add',$this->data);
			} else {
				$aboutlsafimageurl = str_replace(BASE_URL,"",$aboutlsafimageurl);
				$countAlias = 0;
				
				if(!empty($aboutlsafalias)) {
					$alias = generateAlias($aboutlsafalias);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				} else {
					$alias = generateAlias($aboutlsaftitle);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				}
				
				if ($countAlias > 0 ) {
					$this->data['error']='Alias '.$alias.' already exist from title '.$aboutlsaftitle.'';
				
					$this->data['aboutlsaftitle']=$aboutlsaftitle;
					$this->data['aboutlsafshortdesc']=$aboutlsafshortdesc;
					$this->data['aboutlsafdesc']=$aboutlsafdesc;
					$this->data['aboutlsafimageurl']=$aboutlsafimageurl;
					$this->data['aboutlsafalias']=$aboutlsafalias;
					$this->data['aboutlsafmetadescription']=$aboutlsafmetadescription;
					$this->data['aboutlsafmetakeywords']=$aboutlsafmetakeywords;
				
					$this->load->view('backend/header',$this->data);
					$this->load->view('backend/content/add',$this->data);
				} else {				
					$aboutlsafid = $this->Model_content->insertAboutlsaf($aboutlsaftitle,$aboutlsafdesc,$aboutlsafimageurl,$aboutlsafalias,$aboutlsafmetadescription,$aboutlsafmetakeywords,$aboutlsafshortdesc);
					if(!empty($aboutlsafid)) {
						$aliasid = $this->Model_alias->insertAlias($aboutlsafid,$this->alias_category,$alias,"aboutlsaf/detail/".$aboutlsafid);
					}
					
					$log_module = "Add ".$this->module;
					$log_value = $aboutlsafid." | ".$aboutlsaftitle." | ".$aboutlsafshortdesc." | ".$aboutlsafdesc." | ".$aboutlsafimageurl." | ".$aboutlsafalias." | ".$aboutlsafmetadescription." | ".$aboutlsafmetakeywords;
					$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
					
					redirect(BASE_URL_BACKEND."/aboutlsaf/");
				}
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/aboutlsaf");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsAboutlsaf = $this->Model_content->getAboutlsaf($id); 
		$title = $rsAboutlsaf[0]['aboutlsaf_title'];
		$active_status = abs($rsAboutlsaf[0]['aboutlsaf_active_status']-1);
		
		$active = $this->Model_content->activeAboutlsaf($id);
		createRouteAlias(); //create route alias
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Aboutlsaf
		$ListContent = $this->generateAboutlsaf();
		createCache($ListContent,"aboutlsaf");
		//End Cache JSON Aboutlsaf

		redirect(BASE_URL_BACKEND."/aboutlsaf");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/aboutlsaf");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsAboutlsaf = $this->Model_content->getAboutlsaf($id); 
		$title = $rsAboutlsaf[0]['aboutlsaf_title'];
		
		$delete = $this->Model_content->deleteAboutlsaf($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Aboutlsaf
		$ListContent = $this->generateAboutlsaf();
		createCache($ListContent,"aboutlsaf");
		//End Cache JSON Aboutlsaf
		
		redirect(BASE_URL_BACKEND."/aboutlsaf");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/aboutlsaf");
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
		
		$rsAboutlsaf = $this->Model_content->getAboutlsaf($id);  // mengambil database dari model untuk dikirim ke view
		$countAboutlsaf = count($rsAboutlsaf);
		
		$this->data['rsAboutlsaf'] = $rsAboutlsaf;
		$this->data['countAboutlsaf'] = $countAboutlsaf;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/content/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/aboutlsaf");
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
		
		$rsAboutlsaf = $this->Model_content->getAboutlsaf($id);  // mengambil database dari model untuk dikirim ke view
		$countAboutlsaf = count($rsAboutlsaf);
		
		$this->data['rsAboutlsaf'] = $rsAboutlsaf;
		$this->data['countAboutlsaf'] = $countAboutlsaf;
		
		$aboutlsaftitle = $this->security->xss_clean(secure_input($_POST['aboutlsaftitle']));
		$aboutlsafshortdesc = secure_input_editor($_POST['aboutlsafshortdesc']);
		$aboutlsaftitleOld = $this->security->xss_clean(secure_input($_POST['aboutlsaftitleOld']));
		$aboutlsafdesc = secure_input_editor($_POST['aboutlsafdesc']);
		$aboutlsafimageurl = $this->security->xss_clean(secure_input($_POST['aboutlsafimageurl']));
		$aboutlsafalias = $this->security->xss_clean(secure_input(@$_POST['aboutlsafalias']));
		$aboutlsafmetadescription = $this->security->xss_clean(secure_input($_POST['aboutlsafmetadescription']));
		$aboutlsafmetakeywords = $this->security->xss_clean(secure_input($_POST['aboutlsafmetakeywords']));
		
		$pesan = array();
		// Validasi data
		if ($aboutlsaftitle=="") {
			$pesan[] = 'Aboutlsaf Title is empty';
		} else if ($aboutlsafdesc=="") {
			$pesan[] = 'Aboutlsaf Description is empty';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/content/edit',$this->data);
			}
		} else {
			$cekAboutlsaf = $this->Model_content->checkAboutlsaf($aboutlsaftitle);
			$countAboutlsaf = count($cekAboutlsaf);
			
			if($aboutlsaftitle == $aboutlsaftitleOld){
				$countAboutlsaf = 0;
			}
			
			if ($countAboutlsaf > 0 ) {
				$this->data['error']='Aboutlsaf Title '.$aboutlsaftitle.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/content/edit',$this->data);
			} else {
				$aboutlsafimageurl = str_replace(BASE_URL,"",$aboutlsafimageurl);
				$countAlias = 0;
				
				if(!empty($aboutlsafalias)) {
					$alias = generateAlias($aboutlsafalias);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				} else {
					$alias = generateAlias($aboutlsaftitle);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				}
				
				if($aboutlsaftitle == $aboutlsaftitleOld){
					$countAlias = 0;
				}
				
				if ($countAlias > 0 ) {
					$this->data['error']='Alias '.$alias.' already exist from title '.$aboutlsaftitle.'';
					
					$this->load->view('backend/header',$this->data);
					$this->load->view('backend/content/edit',$this->data);
				} else {				
					$update = $this->Model_content->updateAboutlsaf($id,$aboutlsaftitle,$aboutlsafdesc,$aboutlsafimageurl,$aboutlsafalias,$aboutlsafmetadescription,$aboutlsafmetakeywords,$aboutlsafshortdesc);
					if($update) {
						$this->Model_alias->updateAlias($id,$alias,$this->alias_category);
					}
					
					createRouteAlias(); //create route alias
					
					$log_module = "Edit ".$this->module;
					$log_value = $id." | ".$aboutlsaftitle." | ".$aboutlsafshortdesc." | ".$aboutlsafdesc." | ".$aboutlsafimageurl." | ".$aboutlsafalias." | ".$aboutlsafmetadescription." | ".$aboutlsafmetakeywords;
					$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
					
					//Cache JSON Aboutlsaf
					$ListContent = $this->generateAboutlsaf();
					createCache($ListContent,"aboutlsaf");
					//End Cache JSON Aboutlsaf
					
					redirect(BASE_URL_BACKEND."/aboutlsaf/");
				}
			}	
		}
		
	}
	
	function generateAboutlsaf(){
		$rsAboutlsaf			= $this->Model_content->getListContentAlias();
		
		return $rsAboutlsaf;
	}
	
}