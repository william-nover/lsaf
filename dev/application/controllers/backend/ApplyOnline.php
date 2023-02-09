<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApplyOnline extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 6; //get module group id from database
	public $module_id = 9; //get module id from database
	public $alias_category = "applyOnline";
	public $module = "ApplyOnline";
	
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_applyOnline','web/Model_Apply','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
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
		
		$orderBy = "ORDER BY a.signup_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsUserLevel	= $this->Model_applyOnline->getListApplyOnline($cond);
		$base_url		= BASE_URL_BACKEND."/applyOnline/view/";
		$total_rows		= count($rsUserLevel);
		$per_page		= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListApplyOnline = $this->Model_applyOnline->getListApplyOnline($cond);
		
		$this->data["ListApplyOnline"] = $ListApplyOnline;
		
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
		$this->load->view('backend/applyOnline/list');
	}
	
	 function add(){
		//extract privilege
		$this->data["add"] = $this->privilege[2];
		
		if($this->data["add"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		$this->data['Nationality'] = $this->Model_Apply->getNationality();
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/ApplyOnline/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/applyOnline");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		
		 $email = $this->security->xss_clean(secure_input($_POST['email'])); 
                 $full_name = $this->security->xss_clean(secure_input($_POST['full_name'])); 
                 $date_day = $this->security->xss_clean(secure_input($_POST['date_day'])); 
                 $date_month = $this->security->xss_clean(secure_input($_POST['date_month'])); 
                 $date_year = $this->security->xss_clean(secure_input($_POST['date_year'])); 
                 $phone1 = $this->security->xss_clean(secure_input($_POST['phone1'])); 
                 $phone2 = $this->security->xss_clean(secure_input($_POST['phone2'])); 
                 $address1 = $this->security->xss_clean(secure_input($_POST['addr1'])); 
                 $address2 = $this->security->xss_clean(secure_input($_POST['addr2'])); 
                 $postal_code = $this->security->xss_clean(secure_input($_POST['postal_code']));                  
                 $country_id = $this->security->xss_clean(secure_input($_POST['country_id']));  
                 $today      = date("Y-m-d H:i:s"); 
                 $phone = $phone1.$phone2;
                 $time = strtotime($date_month.'/'.$date_day.'/'.$date_year);
                 $dob = date('Y-m-d',$time);
                 $passgenerate = random_string('alnum', 8);
                 $password = md5($passgenerate);
		
		$pesan = array();
		// Validasi data
		if ($email=="") {
			$pesan[] = 'email is empty';
		} else if ($full_name=="") {
			$pesan[] = 'full_name is empty';
		} else if ($address1=="") {
			$pesan[] = 'address is empty';
		} else if ($phone1=="") {
			$pesan[] = 'Phone number not correct';
		} 
		 else if ($phone2=="") {
			$pesan[] = 'Phone number not correct';
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;				
				$this->data['full_name']=$full_name;
				$this->data['address1']=$address1;
				$this->data['address2']=$address2;
				$this->data['phone1']=$phone1;
				$this->data['phone2']=$phone2;
				$this->data['email']=$email;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/applyOnline/add',$this->data);
			}
		} else {
			$check_email = $this->Model_Apply->checkEmail($email);
			if (count($check_email->result_array())>0)
                         {
				$this->data['error']='ApplyOnline Title '.$email.' already exist';
				
				$this->data['full_name']=$full_name;
				$this->data['address1']=$address1;
				$this->data['address2']=$address2;
				$this->data['phone1']=$phone1;
				$this->data['phone2']=$phone2;
				$this->data['email']=$email;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/applyOnline/add',$this->data);
			} else {
                            	 $verificationCode = random_string('alnum', 20); 
                                        $data = array( 
                                        'full_name'=>$full_name,                                    
                                        'email'=>$email,  
                                        'password'=>$password,                                      
                                        'date_of_birth' =>$dob,
                                        'address1' =>$address1,
                                        'address2' =>$address2,
                                        'postal_code' =>$postal_code,
                                        'phone' =>$phone,
                                        'country_id' =>$country_id,
                                        'status'=>0,                                        
                                        'step'=>1,
                                        'signup_date'=>$today,
                                        'email_verification_code'=>$verificationCode
                                       );			
                                    //$applyOnlineid = $this->Model_applyOnline->insertApplyOnline($full_name,$applyOnlinedesc,$applyOnlineimageurl,$applyOnlinealias,$applyOnlinemetadescription,$applyOnlinemetakeywords,$applyOnlineshortdesc);
                                    $applyOnlineid = $this->Model_Apply->AddSignup($data);

                                    $log_module = "Add ".$this->module;
                                    $log_value = $applyOnlineid." | ".$full_name." | ".$email."|".$today;
                                    $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                    redirect(BASE_URL_BACKEND."/applyOnline/");
				
                        }	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/applyOnline");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsApplyOnline = $this->Model_applyOnline->getApplyOnline($id); 
		$title = $rsApplyOnline[0]['applyOnline_title'];
		$active_status = abs($rsApplyOnline[0]['applyOnline_active_status']-1);
		
		$active = $this->Model_applyOnline->activeApplyOnline($id);
		createRouteAlias(); //create route alias
		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON ApplyOnline
		
		//End Cache JSON ApplyOnline

		redirect(BASE_URL_BACKEND."/applyOnline");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/applyOnline");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsApplyOnline = $this->Model_applyOnline->getApplyOnline($id); 
		$title = $rsApplyOnline[0]['full_name'];
		
//                print_r($rsApplyOnline);
//                die;
		$delete = $this->Model_applyOnline->deleteApplyOnline($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON ApplyOnline
		
		//End Cache JSON ApplyOnline
		
		redirect(BASE_URL_BACKEND."/applyOnline");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/applyOnline");
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
		
		$rsApplyOnline = $this->Model_applyOnline->getApplyOnline($id);  // mengambil database dari model untuk dikirim ke view
		$countApplyOnline = count($rsApplyOnline);
		
		$this->data['rsApplyOnline'] = $rsApplyOnline;
		$this->data['countApplyOnline'] = $countApplyOnline;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/applyOnline/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/applyOnline");
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
		
		$rsApplyOnline = $this->Model_applyOnline->getApplyOnline($id);  // mengambil database dari model untuk dikirim ke view
		$countApplyOnline = count($rsApplyOnline);
		
		$this->data['rsApplyOnline'] = $rsApplyOnline;
		$this->data['countApplyOnline'] = $countApplyOnline;
		
		$applyOnlinetitle = $this->security->xss_clean(secure_input($_POST['applyOnlinetitle']));
		$applyOnlineshortdesc = secure_input_editor($_POST['applyOnlineshortdesc']);
		$applyOnlinetitleOld = $this->security->xss_clean(secure_input($_POST['applyOnlinetitleOld']));
		$applyOnlinedesc = secure_input_editor($_POST['applyOnlinedesc']);
		$applyOnlineimageurl = $this->security->xss_clean(secure_input($_POST['applyOnlineimageurl']));
		$applyOnlinealias = $this->security->xss_clean(secure_input(@$_POST['applyOnlinealias']));
		$applyOnlinemetadescription = $this->security->xss_clean(secure_input($_POST['applyOnlinemetadescription']));
		$applyOnlinemetakeywords = $this->security->xss_clean(secure_input($_POST['applyOnlinemetakeywords']));
		
		$pesan = array();
		// Validasi data
		if ($applyOnlinetitle=="") {
			$pesan[] = 'ApplyOnline Title is empty';
		} else if ($applyOnlinedesc=="") {
			$pesan[] = 'ApplyOnline Description is empty';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/applyOnline/edit',$this->data);
			}
		} else {
			$cekApplyOnline = $this->Model_applyOnline->checkApplyOnline($applyOnlinetitle);
			$countApplyOnline = count($cekApplyOnline);
			
			if($applyOnlinetitle == $applyOnlinetitleOld){
				$countApplyOnline = 0;
			}
			
			if ($countApplyOnline > 0 ) {
				$this->data['error']='ApplyOnline Title '.$applyOnlinetitle.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/applyOnline/edit',$this->data);
			} else {
				$applyOnlineimageurl = str_replace(BASE_URL,"",$applyOnlineimageurl);
				$countAlias = 0;
				
				if(!empty($applyOnlinealias)) {
					$alias = generateAlias($applyOnlinealias);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				} else {
					$alias = generateAlias($applyOnlinetitle);
					$cekAlias = $this->Model_alias->checkAliasCategory($alias,$this->alias_category);
					$countAlias = count($cekAlias);
				}
				
				if($applyOnlinetitle == $applyOnlinetitleOld){
					$countAlias = 0;
				}
				
				if ($countAlias > 0 ) {
					$this->data['error']='Alias '.$alias.' already exist from title '.$applyOnlinetitle.'';
					
					$this->load->view('backend/header',$this->data);
					$this->load->view('backend/applyOnline/edit',$this->data);
				} else {				
					$update = $this->Model_applyOnline->updateApplyOnline($id,$applyOnlinetitle,$applyOnlinedesc,$applyOnlineimageurl,$applyOnlinealias,$applyOnlinemetadescription,$applyOnlinemetakeywords,$applyOnlineshortdesc);
					if($update) {
						$this->Model_alias->updateAlias($id,$alias,$this->alias_category);
					}
					
					createRouteAlias(); //create route alias
					
					$log_module = "Edit ".$this->module;
					$log_value = $id." | ".$applyOnlinetitle." | ".$applyOnlineshortdesc." | ".$applyOnlinedesc." | ".$applyOnlineimageurl." | ".$applyOnlinealias." | ".$applyOnlinemetadescription." | ".$applyOnlinemetakeywords;
					$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
					
					//Cache JSON ApplyOnline
					//$ListApplyOnline = $this->generateApplyOnline();
					createCache($ListApplyOnline,"applyOnline");
					//End Cache JSON ApplyOnline
					
					redirect(BASE_URL_BACKEND."/applyOnline/");
				}
			}	
		}
		
	}
	
	
	
}