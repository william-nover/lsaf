<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_frontend extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 3; //get module group id from database
	public $module_id = 4; //get module id from database
	public $module = "Menu";
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_module','backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
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
	
	private function menurekursif($start, $per_page, $where, $orderBy){
		$arrayMenu = array();
		
		$cond 			= $where." AND menu_parent = 0 ".$orderBy;
		$cond 			.= " LIMIT ".$start.",".$per_page;
		$rsMenu			= $this->Model_menu_frontend->getListMenu($cond);
		
		$index = 0;
		if(count($rsMenu) > 0){
			for($i=0; $i<count($rsMenu); $i++){
				$arrayMenu[$index]['menu_id'] = $rsMenu[$i]['menu_id'];
				$arrayMenu[$index]['menu_title'] = $rsMenu[$i]['menu_title'];
				$arrayMenu[$index]['menu_url'] = $rsMenu[$i]['menu_url'];
				$arrayMenu[$index]['menu_active_status'] = $rsMenu[$i]['menu_active_status'];
				$arrayMenu[$index]['menu_parent'] = $rsMenu[$i]['menu_parent'];
                                $arrayMenu[$index]['menu_sub_parent'] = $rsMenu[$i]['menu_sub_parent'];
				$arrayMenu[$index]['menu_order'] = $rsMenu[$i]['menu_order'];
				$arrayMenu[$index]['menu_create_date'] = $rsMenu[$i]['menu_create_date'];
				$index++;
				
				$cond 				= $where."  AND menu_parent = ".$rsMenu[$i]['menu_id']." AND menu_sub_parent=0 ".$orderBy;
				$rsSubMenu			= $this->Model_menu_frontend->getListMenu($cond);
			
				if(count($rsSubMenu) > 0){
					for($j=0; $j<count($rsSubMenu); $j++){
						$arrayMenu[$index]['menu_id'] = $rsSubMenu[$j]['menu_id'];
						$arrayMenu[$index]['menu_title'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rsSubMenu[$j]['menu_title'];
						$arrayMenu[$index]['menu_url'] = $rsSubMenu[$j]['menu_url'];
						$arrayMenu[$index]['menu_active_status'] = $rsSubMenu[$j]['menu_active_status'];
						$arrayMenu[$index]['menu_parent'] = $rsSubMenu[$j]['menu_parent'];
                                                $arrayMenu[$index]['menu_sub_parent'] = $rsSubMenu[$j]['menu_sub_parent'];
						$arrayMenu[$index]['menu_order'] = $rsSubMenu[$j]['menu_order'];
						$arrayMenu[$index]['menu_create_date'] = $rsSubMenu[$j]['menu_create_date'];
						$index++;
					
                                $cond 			= $where." AND menu_sub_parent = ".$rsSubMenu[$j]['menu_id']." AND menu_parent = ".$rsMenu[$i]['menu_id']." ".$orderBy;
				$rsSubChildMenu         = $this->Model_menu_frontend->getListMenu($cond);    
                             
                            //    print_r($rsSubChildMenu);
                                                if(count($rsSubChildMenu) > 0){
                                                        for($k=0; $k<count($rsSubChildMenu); $k++){
                                                                $arrayMenu[$index]['menu_id'] = $rsSubChildMenu[$k]['menu_id'];
                                                                $arrayMenu[$index]['menu_title'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rsSubChildMenu[$k]['menu_title'];
                                                                $arrayMenu[$index]['menu_url'] = $rsSubChildMenu[$k]['menu_url'];
                                                                $arrayMenu[$index]['menu_active_status'] = $rsSubChildMenu[$k]['menu_active_status'];
                                                                $arrayMenu[$index]['menu_parent'] = $rsSubChildMenu[$k]['menu_parent'];
                                                                $arrayMenu[$index]['menu_sub_parent'] = $rsSubChildMenu[$k]['menu_sub_parent'];
                                                                $arrayMenu[$index]['menu_order'] = $rsSubChildMenu[$k]['menu_order'];
                                                                $arrayMenu[$index]['menu_create_date'] = $rsSubChildMenu[$k]['menu_create_date'];
                                                                $index++;
                                                         }
                                                }
               
                                       }
				}
			}
		} else {
			if($where != "WHERE 1=1 "){
				$index = 0;
				$cond 				= $where." ".$orderBy;
				$rsSubMenu			= $this->Model_menu_frontend->getListMenu($cond);
				
				if(count($rsSubMenu) > 0){
					for($j=0; $j<count($rsSubMenu); $j++){
						$arrayMenu[$index]['menu_id'] = $rsSubMenu[$j]['menu_id'];
						$arrayMenu[$index]['menu_title'] = "&nbsp;&nbsp;&nbsp;&nbsp;".$rsSubMenu[$j]['menu_title'];
						$arrayMenu[$index]['menu_url'] = $rsSubMenu[$j]['menu_url'];
						$arrayMenu[$index]['menu_active_status'] = $rsSubMenu[$j]['menu_active_status'];
						$arrayMenu[$index]['menu_parent'] = $rsSubMenu[$j]['menu_parent'];
						$arrayMenu[$index]['menu_order'] = $rsSubMenu[$j]['menu_order'];
						$arrayMenu[$index]['menu_create_date'] = $rsSubMenu[$j]['menu_create_date'];
						$index++;
					}
				}
			}
		}
//                echo'<pre>';
//		print_r($arrayMenu);
//                die;
		return $arrayMenu;
	}
    function getParent($menu_id) {
                    $tmp    = '';
                    $_SESSION['menu_id']=$menu_id;
                    $data   = $this->Model_menu_frontend->getParent($menu_id);
                    if(!empty($data)) {
                        $tmp .= "<option value='0'>Sub Parent</option>";
                        foreach($data as $row){
                             $tmp .= "<option value='".$row->menu_id."'>".$row->menu_title."</option>";
                        }
                    } else {
                        $tmp .= "<option value='0'>Sub Parent</option>";
                    }
                    die($tmp);
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
		
		$where .= "WHERE 1=1 ";
		
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
					$where   .=   " AND ".$searchby." LIKE '%". $searchkey ."%' ";
				}
			}	
		} else {
			$searchkey = @$_SESSION["searchkey".$this->module_id];
			$searchby = @$_SESSION["searchby".$this->module_id];
			
			
			if($searchkey != "" && $searchby != ""){
				$where   .=   " AND ".$searchby." LIKE '%". $searchkey ."%' ";
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
		
		$orderBy = "ORDER BY menu_parent ASC, menu_order ASC, menu_id ASC";
		
		$cond 			= $where." ".$orderBy;
		$rsMenu			= $this->Model_menu_frontend->getListMenu($cond);
		$base_url		= BASE_URL_BACKEND."/menu_frontend/view/";
		$total_rows		= count($rsMenu);
		$per_page		= PER_PAGE; 
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		
		$ListMenuFrontend = $this->menurekursif($start, $per_page, $where, $orderBy);
//		echo'<pre>';
//                print_r($ListMenuFrontend);
//                die;
                
		$this->data["ListMenuFrontend"] = $ListMenuFrontend;
		
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
		$this->load->view('backend/menu_frontend/list');
	}
	
	public function add(){
		//extract privilege
		$this->data["add"] = $this->privilege[2];
		
		if($this->data["add"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		$module_group_id=8;
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$menuparent = 0;
		$this->data['menuparent'] = $menuparent;
		$cond = "WHERE menu_active_status = 1 AND menu_parent = 0 ";
		$MenuParent = $this->Model_menu_frontend->getListMenu($cond);
		$this->data['MenuParent'] = $MenuParent;                
		$this->data['Module']=$this->Model_module->getModulePath($module_group_id);
//                echo '<pre>';
//                print_r($this->data['Module']);die;
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/menu_frontend/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/news");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
                $asal   = array("\"","/", " ", "(", ")", "=","@", "%","^","*","`","+","#","$",";" ,":","{","}","[","]","|");
                $ganti  = array("");
		$menutitle = $this->security->xss_clean(secure_input($_POST['menutitle']));
                $menutitle_url = (str_replace ($asal, $ganti,  $menutitle));
		$menuurl = $this->security->xss_clean(secure_input($_POST['menuurl']));
                $module_id = $this->security->xss_clean(secure_input($_POST['module_id']));
                $menuparent =$this->security->xss_clean(secure_input($_POST['menuparent']));
                $menusubparent = $this->security->xss_clean(secure_input($_POST['menusubparent']));
		

		$pesan = array();
		// Validasi data
		if ($menutitle=="") {
			$pesan[] = 'Menu Title is empty';
		}  
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['menutitle']=$menutitle;
				$this->data['menuurl']=$menuurl;
				$this->data['menuparent']=$menuparent;
                                $this->data['menusubparent']=$menusubparent;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/menu_frontend/add',$this->data);
			}
		} else {
			$cekMenu = $this->Model_menu_frontend->checkMenu($menutitle);
			$countMenu = count($cekMenu);
			
			$countMenu = 0; //special case for kmn website
			
			if ($countMenu > 0 ) {
				$this->data['error'] = 'Menu Title '.$menutitle.' already exist';
				
				$this->data['menutitle']=$menutitle;
				$this->data['menuurl']=$menuurl;
				$this->data['menuparent']=$menuparent;
				$this->data['menusubparent']=$menusubparent;
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/menu_frontend/add',$this->data);
			} else {
				$menuid = $this->Model_menu_frontend->insertMenu($module_id,$menutitle,$menuurl,$menuparent,$menusubparent);
				
                                if ($menuurl == ''){
                                   $module_path =$this->Model_module->getModuleTitle($module_id);                    
                                   
                                   if ($menuparent==0 && $menusubparent == 0){                           
                                   $url_menu = BASE_URL.'/'.$module_path.'/'.$menuid.'/'.$menutitle_url;
                                    }
                                   else if ($menuparent!=0 && $menusubparent == 0){                          
                                   $url_menu = BASE_URL.'/'.$module_path.'/'.$menuparent.'/'.$menuid.'/'.$menutitle_url;
                                    }                                   
                                  else if ($menuparent!=0 && $menusubparent != 0){                        
                                  $url_menu = BASE_URL.'/'.$module_path.'/'.$menuparent.'/'.$menusubparent.'/'.$menuid.'/'.$menutitle_url;
                                    }
                               
                                  $this->Model_menu_frontend->updateUrlMenu($menuid,$url_menu);
                                  
				   
                                }
                		
                                
                                
				$log_module = "Add ".$this->module;
				$log_value = $menuid." | ".$menutitle." | ".$menuurl." | ".$menuparent." | ".$menuparent;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND."/menu_frontend/");
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/menu_frontend");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsMenu = $this->Model_menu_frontend->getMenu($id);
		$title = $rsMenu[0]['menu_title'];
		$active_status = abs($rsMenu[0]['menu_active_status']-1);
		
		$active = $this->Model_menu_frontend->activeMenu($id);
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value); 
		
		//Cache JSON Menu
		$ListMenu = $this->generateMenu();
		createCache($ListMenu,"menu");
                //untuk footer
                $MenuFooterAA = $this->generateFooterAA();
//                echo'<pre>';
//                print_r($MenuFooterAA);
//                die;
		createCache($MenuFooterAA,"menuFooterAA");
                $MenuFooterAB = $this->generateFooterAB();
		createCache($MenuFooterAB,"menuFooterAB");
                
                $MenuFooterBA = $this->generateFooterBA();
		createCache($MenuFooterBA,"menuFooterBA");
                $MenuFooterBB = $this->generateFooterBB();
		createCache($MenuFooterBB,"menuFooterBB");
                
                $MenuFooterC = $this->generateFooterC();
		createCache($MenuFooterC,"menuFooterC");
		//End Cache JSON Menu
		
		redirect(BASE_URL_BACKEND."/menu_frontend");
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/menu_frontend");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsMenu = $this->Model_menu_frontend->getMenu($id);
		$title = $rsMenu[0]['menu_title'];
		
		$delete = $this->Model_menu_frontend->deleteMenu($id);
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Menu
		$ListMenu = $this->generateMenu();
		createCache($ListMenu,"menu");
                //untuk footer
                $MenuFooterAA = $this->generateFooterAA();           
		createCache($MenuFooterAA,"menuFooterAA");
                $MenuFooterAB = $this->generateFooterAB();
		createCache($MenuFooterAB,"menuFooterAB");
                
                $MenuFooterBA = $this->generateFooterBA();
		createCache($MenuFooterBA,"menuFooterBA");
                $MenuFooterBB = $this->generateFooterBB();
		createCache($MenuFooterBB,"menuFooterBB");
                
                $MenuFooterC = $this->generateFooterC();
		createCache($MenuFooterC,"menuFooterC");
		//End Cache JSON Menu
		
		redirect(BASE_URL_BACKEND."/menu_frontend");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/menu_frontend");
			exit();
		}
		
		//extract privilege
		$this->data["edit"] = $this->privilege[3];
		
		if($this->data["edit"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		$module_group_id=8;
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$cond = "WHERE menu_active_status = 1 AND menu_parent = 0 ";
		$MenuParent = $this->Model_menu_frontend->getListMenu($cond);
		$this->data['MenuParent'] = $MenuParent;
		$this->data['Module']=$this->Model_module->getModulePath($module_group_id);
		$rsMenu = $this->Model_menu_frontend->getMenu($id);  // mengambil database dari model untuk dikirim ke view
		$countMenu = count($rsMenu);
		
		$this->data['rsMenu'] = $rsMenu;
		$this->data['countMenu'] = $countMenu;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/menu_frontend/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/menu_frontend");
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
		
		$cond = "WHERE menu_active_status = 1 AND menu_parent = 0 ";
		$MenuParent = $this->Model_menu_frontend->getListMenu($cond);
		$this->data['MenuParent'] = $MenuParent;
		
		$rsMenu = $this->Model_menu_frontend->getMenu($id);  // mengambil database dari model untuk dikirim ke view
		$countMenu = count($rsMenu);
		
		$this->data['rsMenu'] = $rsMenu;
		$this->data['countMenu'] = $countMenu;
		
		$asal   = array("\"","/", " ", "(", ")", "=","@", "%","^","*","`","+","#","$",";" ,":","{","}","[","]","|");
                $ganti  = array("");
		$menutitle = $this->security->xss_clean(secure_input($_POST['menutitle']));
                $menutitle_url = (str_replace ($asal, $ganti,  $menutitle));
		$menutitleOld = $this->security->xss_clean(secure_input($_POST['menutitleOld']));
		$menuurl = $this->security->xss_clean(secure_input($_POST['menuurl']));
		$module_id = $this->security->xss_clean(secure_input($_POST['module_id']));
                $menuparent = $this->security->xss_clean(secure_input($_POST['menuparent']));
                $menusubparent = $this->security->xss_clean(secure_input($_POST['menusubparent']));
		//$menuparent = 0;
	
		$pesan = array();
		// Validasi data
		if ($menutitle=="") {
			$pesan[] = 'Menu Title is empty';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->data['menutitle']=$menutitle;
				$this->data['menuurl']=$menuurl;
				$this->data['menuparent']=$menuparent;
                                $this->data['menusubparent']=$menusubparent;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/menu_frontend/edit',$this->data);
			}
		} else {
			$cekMenu = $this->Model_menu_frontend->checkMenu($menutitle);
			$countMenu = count($cekMenu);
			
			if($menutitle == $menutitleOld){
				$countMenu = 0;
			}
			
			$countMenu = 0; //special case for kmn website
			
			if ($countMenu > 0 ) {
				$this->data['error'] = 'Menu Title '.$menutitle.' already exist';
				
				$this->data['menutitle']=$menutitle;
				$this->data['menuurl']=$menuurl;
				$this->data['menuparent']=$menuparent;
				$this->data['menusubparent']=$menusubparent;
                                
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/menu_frontend/edit',$this->data);
			} else {
				$update = $this->Model_menu_frontend->updateMenu($id,$module_id,$menutitle,$menuurl,$menuparent,$menusubparent);
				  
                                if ($menuurl == ''){
                                  echo $module_path = $this->Model_module->getModuleTitle($module_id);                    
                                  
                                   if ($menuparent == 0 && $menusubparent == 0){                           
                                   $url_menu = BASE_URL.'/'.$module_path.'/'.$id.'/'.$menutitle_url;
                                    }
                                   else if ($menuparent!= 0 && $menusubparent == 0){                          
                                   $url_menu = BASE_URL.'/'.$module_path.'/'.$menuparent.'/'.$id.'/'.$menutitle_url;
                                    }                                   
                                  else if ($menuparent!= 0 && $menusubparent != 0){                        
                                  $url_menu = BASE_URL.'/'.$module_path.'/'.$menuparent.'/'.$menusubparent.'/'.$id.'/'.$menutitle_url;
                                    }
                               
                                  $this->Model_menu_frontend->updateUrlMenu($id,$url_menu);
                                 // $ListMenu = $this->generateMenu();
				   
                                }
                              //  die; 
				$log_module = "Edit ".$this->module;
				$log_value = $id." | ".$menutitle." | ".$menuurl." | ".$menuparent;
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				//Cache JSON Menu
				$ListMenu = $this->generateMenu();
                                createCache($ListMenu,"menu");
                                //untuk footer
                                $MenuFooterAA = $this->generateFooterAA();                               
                                createCache($MenuFooterAA,"menuFooterAA");
                                $MenuFooterAB = $this->generateFooterAB();
                                createCache($MenuFooterAB,"menuFooterAB");
                              
                                $MenuFooterBA = $this->generateFooterBA();
                                createCache($MenuFooterBA,"menuFooterBA");
                                $MenuFooterBB = $this->generateFooterBB();
                                createCache($MenuFooterBB,"menuFooterBB");

                                $MenuFooterC = $this->generateFooterC();
                                createCache($MenuFooterC,"menuFooterC");
				//End Cache JSON Menu
				
				redirect(BASE_URL_BACKEND."/menu_frontend/");
			}	
		}
		
	}
	
	public function doOrder(){
		//extract privilege
		$this->data["order"] = $this->privilege[7];
		
		if($this->data["order"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}

		$menuid = $_POST['menuid'];
		foreach($menuid as $id)
		{
			$order = $this->security->xss_clean(secure_input($_POST['order'][$id]));
			$updateorder = $this->Model_menu_frontend->updateOrderMenu($id,$order);
			
			$rsMenu = $this->Model_menu_frontend->getMenu($id);
			$title = $rsMenu[0]['menu_title'];
			$parent = $rsMenu[0]['menu_parent'];
			
			$log_module = "Order ".$this->module;
			$log_value = $id." | ".$title." | ".$parent." | ".$order;
			$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		}
		
		
		//Cache JSON Menu
				$ListMenu = $this->generateMenu();
				createCache($ListMenu,"menu");
				//untuk footer
				$MenuFooterAA = $this->generateFooterAA();                               
				createCache($MenuFooterAA,"menuFooterAA");
				$MenuFooterAB = $this->generateFooterAB();
				createCache($MenuFooterAB,"menuFooterAB");
			  
				$MenuFooterBA = $this->generateFooterBA();
				createCache($MenuFooterBA,"menuFooterBA");
				$MenuFooterBB = $this->generateFooterBB();
				createCache($MenuFooterBB,"menuFooterBB");

				$MenuFooterC = $this->generateFooterC();
				createCache($MenuFooterC,"menuFooterC");
		//End Cache JSON Menu
		
		redirect(BASE_URL_BACKEND."/menu_frontend/");
	}	
	function generateMenu(){
	$row = $this->Model_menu_frontend->GenerateMenu();
    
        return $row;
	}
        //untuk footer menu
	function generateFooterAA(){
	$row = $this->Model_menu_frontend->GenerateFooterAA();
    
        return $row;
	}
        function generateFooterAB(){
	$row = $this->Model_menu_frontend->GenerateFooterAB();
    
        return $row;
	}
        function generateFooterBA(){
	$row = $this->Model_menu_frontend->GenerateFooterBA();
    
        return $row;
	}
        function generateFooterBB(){
	$row = $this->Model_menu_frontend->GenerateFooterBB();
    
        return $row;
	}
        function generateFooterC(){
	$row = $this->Model_menu_frontend->GenerateFooterC();
    
        return $row;
	}
}