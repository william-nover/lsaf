<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_Lectures extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 9; //get module group id from database
	public $module_id = 19; //get module id from database
	public $alias_category = "video_Lectures";
	public $module = "Video_Lectures";
	public function __construct()
	{
		parent::__construct();
                session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_menu_frontend','backend/Model_class_management','backend/Model_video_lectures','backend/Model_lecturer','backend/Model_alias', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
                $this->data['ListMenu'] = $this->arrMenu;
                $this->data['CountMenu'] = count($this->arrMenu);
		$this->data['controller'] = $this->module;
                $this->data['getSubject'] = $this->Model_video_lectures->getSubject();
//               
//                echo'<pre>';
//                print_r( $this->data['getSubject'] );
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
		
		$orderBy = "ORDER BY a.video_lectures_id DESC";
		
		$cond 			= $where." ".$orderBy;
		$rsVideo_Lectures		= $this->Model_video_lectures->getListVideo_Lectures($cond);
		$base_url		= BASE_URL_BACKEND."/video_lectures/view/";
		$total_rows		= count($rsVideo_Lectures);
		$per_page		= $perpage;

		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$ListVideo_Lectures = $this->Model_video_lectures->getListVideo_Lectures($cond);
//                echo'<pre>';
//		print_r($ListVideo_Lectures);
//                die;
		
		$this->data["ListVideo_Lectures"] = $ListVideo_Lectures;
		
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
		$this->load->view('backend/video_lectures/list');
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
		$this->load->view('backend/video_lectures/add',$this->data);
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
			redirect(BASE_URL_BACKEND."/video_lectures");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		$this->data['breadcrump'] = $this->breadcrump;
		$video_lectures_title = $this->security->xss_clean(secure_input($_POST['video_lectures_title']));
                $video_lectures_link = $this->security->xss_clean(secure_input($_POST['video_lectures_link']));              
                $video_lectures_date = $this->security->xss_clean(secure_input($_POST['video_lectures_date']));		
                $subject_id = $this->security->xss_clean(secure_input($_POST['subject_id']));
		
		
		$pesan = array();
		// Validasi data
		if ($video_lectures_title=="") {
			$pesan[] = 'Video Lectures Title is empty';
		}else if ($video_lectures_link=="") {
			$pesan[] = 'Video Link is empty';
		}else if ($video_lectures_date=="") {
			$pesan[] = 'Video Date is empty';
		} else if ($subject_id==0) {
			$pesan[] = 'Subject must choosed';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['video_lectures_title']=$video_lectures_title;
                                $this->data['video_lectures_link']=$video_lectures_link;
                                $this->data['video_lectures_date']=$video_lectures_date;
				$this->data['subject_id']=$subject_id;
				
					
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/video_lectures/add',$this->data);
			}
		} else {
			$cekVideo_Lectures = $this->Model_video_lectures->checkVideo_Lectures($video_lectures_title);
			$countVideo_Lectures = count($cekVideo_Lectures);
			
			if ($countVideo_Lectures > 0 ) {
				$this->data['error']='Video_Lectures Title '.$video_lectures_title.' already exist';
                                $this->data['subject_id']=$subject_id;
				$this->data['video_lectures_title']=$video_lectures_title;
				
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/video_lectures/add',$this->data);
			} else {
                            
                        $subject_id = $this->Model_video_lectures->insertVideo_Lectures($video_lectures_title,$subject_id,$video_lectures_link,$video_lectures_date);


                        $log_module = "Add ".$this->module;
                        $log_value = $subject_id." | ".$video_lectures_title;
                        $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);					
                        redirect(BASE_URL_BACKEND."/video_lectures/");	
				
			}	
		}	
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/video_lectures");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsVideo_Lectures = $this->Model_video_lectures->getVideo_Lectures($id); 
		
                $title = $rsVideo_Lectures[0]['video_lectures_title'];
		$active_status = abs($rsVideo_Lectures[0]['subject_active_status']-1);
		
		 $this->Model_video_lectures->activeVideo_Lectures($id);
		
                $callVideo_Lectures = $this->Model_video_lectures->getVideo_Lectures($id);
                 $status = $callVideo_Lectures[0]['video_lectures_active_status'];
                if($status == 1){    
                    $this->sendMail($id,$callVideo_Lectures[0]['subject_id'],$callVideo_Lectures[0]['video_lectures_title'],$callVideo_Lectures[0]['video_lectures_date']);
                }

		
		if($active_status == 1){
			$log_module = "Active ".$this->module;
		} else {
			$log_module = "Inactive ".$this->module;
		}
		$log_value = $id." | ".$title." | ".$active_status;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Video_Lectures
		
		//End Cache JSON Video_Lectures

		redirect(BASE_URL_BACKEND."/video_lectures");
		
	}
	function sendMail($id, $subject_id, $video_lectures_title, $video_lectures_date){
            
		 $getMail = $this->Model_class_management->getMail($subject_id);
                
                 foreach ($getMail as $gm) {
                      $email = $gm->email;
                      $subject_title = $gm->subject_title;
                 
                $subject = "LSAF - Video Lectures ";
                $message_email = "New Video lectures"  .$video_lectures_title."<br>";
                $message_email .= "For Subject : ".$subject_title.'--'.$video_lectures_date."<br>";
                $message_email .= "Sign in to LSAF and open link bellow<br>";
                $message_email .= BASE_URL."/Video_lectures/detail/" .$id; 

                $header = "";
                $header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
                    
                mail($email, $subject, $message_email, $header);
                 }          
                 
	}
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/video_lectures");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$rsVideo_Lectures = $this->Model_video_lectures->getVideo_Lectures($id); 
		$title = $rsVideo_Lectures[0]['video_lectures_title'];
		
		$delete = $this->Model_video_lectures->deleteVideo_Lectures($id);
		$delete_alias = $this->Model_alias->deleteAlias($id, $this->alias_category);
		createRouteAlias(); //create route alias
		
		$log_module = "Delete ".$this->module;
		$log_value = $id." | ".$title;
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//Cache JSON Video_Lectures
	
		//End Cache JSON Video_Lectures
		
		redirect(BASE_URL_BACKEND."/video_lectures");
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/video_lectures");
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
		
		$rsVideo_Lectures = $this->Model_video_lectures->getVideo_Lectures($id);  // mengambil database dari model untuk dikirim ke view
		
                $countVideo_Lectures = count($rsVideo_Lectures);
		
		$this->data['rsVideo_Lectures'] = $rsVideo_Lectures;
		$this->data['countVideo_Lectures'] = $countVideo_Lectures;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/video_lectures/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/video_lectures");
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
		
		$rsVideo_Lectures = $this->Model_video_lectures->getVideo_Lectures($id);  // mengambil database dari model untuk dikirim ke view
		$countVideo_Lectures = count($rsVideo_Lectures);
		
		$this->data['rsVideo_Lectures'] = $rsVideo_Lectures;
		$this->data['countVideo_Lectures'] = $countVideo_Lectures;
                $video_lectures_title = $this->security->xss_clean(secure_input($_POST['video_lectures_title']));
                $video_lectures_link = $this->security->xss_clean(secure_input($_POST['video_lectures_link']));              
                $video_lectures_date = $this->security->xss_clean(secure_input($_POST['video_lectures_date']));		
                $subject_id = $this->security->xss_clean(secure_input($_POST['subject_id']));	
		$video_lectures_titleOld = $this->security->xss_clean(secure_input($_POST['video_lectures_titleOld']));
		
		
		$pesan = array();
		// Validasi data
		if ($video_lectures_title=="") {
			$pesan[] = 'Video Lectures Title is empty';
		}else if ($video_lectures_link=="") {
			$pesan[] = 'Video Link is empty';
		}else if ($video_lectures_date=="") {
			$pesan[] = 'Video Date is empty';
		} else if ($subject_id==0) {
			$pesan[] = 'Subject must choosed';
		} 
		
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
                                $this->data['video_lectures_title']=$video_lectures_title;
                                $this->data['video_lectures_link']=$video_lectures_link;
                                $this->data['video_lectures_date']=$video_lectures_date;
				$this->data['subject_id']=$subject_id;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/video_lectures/edit',$this->data);
			}
		} else {
			$cekVideo_Lectures = $this->Model_video_lectures->checkVideo_Lectures($video_lectures_title);
			$countVideo_Lectures = count($cekVideo_Lectures);
			
			if($video_lectures_title == $video_lectures_titleOld){
				$countVideo_Lectures = 0;
			}
			
			if ($countVideo_Lectures > 0 ) {
				$this->data['error']='Video_Lectures Title '.$video_lectures_title.' already exist';

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/video_lectures/edit',$this->data);
			} else {
				$update = $this->Model_video_lectures->updateVideo_Lectures($id,$video_lectures_title,$subject_id,$video_lectures_link,$video_lectures_date);					
					
                                $log_module = "Edit ".$this->module;
                                $log_value = $id." | ".$video_lectures_title;
                                $insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);

                                redirect(BASE_URL_BACKEND."/video_lectures/");				
			}	
		}
		
	}
	public function doOrder(){
		
		$order = $this->security->xss_clean($_POST['order']);
		
		if($order == ""){
			redirect(BASE_URL_BACKEND."/video_lectures/");
			exit();
		} 
		
		foreach($order as $id => $ordervalue){
			$this->Model_video_lectures->updateOrderVideo_Lectures($id,$ordervalue);
		}
		
		redirect(BASE_URL_BACKEND."/video_lectures/");
	}
	
	
      
}