<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public $arrMenu = array();
	public $data;
	
	public function __construct()
	{
		parent::__construct();
		session_start();
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/Model_home','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
        $this->data['ListMenu'] = $this->arrMenu;
        $this->data['CountMenu'] = count($this->arrMenu);
	}
	
	public function index()
	{
		$this->home();
	}
	
	function home(){
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'home';
		$this->data['modul_id'] = 1;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/home');
	}
	
	function changePassword(){
		$modul_id = 1;
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'home';
		$this->data['modul_id'] = $modul_id;
		
		$alphanumerik = '0123456789';	
		$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
		$_SESSION['captcha_changepassword'] = $word;
		
		$vals = array(
			'word'	 => $word,
			'img_path'	 => PATH_ASSETS.'/capctha/',
			'img_url'	 => BASE_URL.'/assets/capctha/',
			'img_width'	 => '150',
			'img_height' => 30,
			'expiration' => 7200
			);
		
		$cap = create_captcha($vals);
		$this->data["captcha"] = $cap['image'];
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/changePassword');
	}
	
	function doChangePassword(){
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/changePassword");
			exit();
		}
		
		$modul_id = 1;
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = 'home';
		$this->data['modul_id'] = $modul_id;
		
		$pass_db = $this->Model_home->getPassword();
		
		$password_database = $pass_db[0]['user_pass'];
		$oldpassword = $this->security->xss_clean(secure_input_password($_POST['oldpassword']));
		$oldpassword_md5 = md5($oldpassword);
		$newpassword = $this->security->xss_clean(secure_input_password($_POST['newpassword']));
		$newpassword_md5 = md5($newpassword);
		$retypenewpassword = $this->security->xss_clean(secure_input_password($_POST['retypenewpassword']));
		$length_password = strlen($newpassword);
		$capctha = $this->security->xss_clean(secure_input($_POST['capctha']));
		
		$pesan = array();
		// Validasi data
		if (trim($oldpassword)=="") {
			$pesan[] = 'Old password is empty';
		} else if ($oldpassword_md5 != $password_database) {
			$pesan[] = 'Old password not correct';
		} else if (trim($capctha)=="") {
			$pesan[] = "Security Code is empty";
		} else if ($length_password < 6) {
			$pesan[] = 'Minimal password is six character';
		} else if ($newpassword != $retypenewpassword) {
			$pesan[] = 'New password did not match with retype new password';
		} else if ($password_database == $newpassword_md5) {
			$pesan[] = 'New password same as old password';
		} else if($_SESSION['captcha_changepassword'] != $capctha){
			$pesan[] = "Security Code is not valid";
		} 
		
		// Untuk menampilkan pesan error
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$modul_id = 1;
				
				// kirim variabel global
				$admin_data = $_SESSION['admin_data'];
				$this->data['admin_data'] = $admin_data;
				$this->data['section'] = 'home';
				$this->data['modul_id'] = $modul_id;
				
				$this->data['error'] = $pesan_tampil;
				
				$alphanumerik = '0123456789';	
				$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
				$_SESSION['captcha_changepassword'] = $word;
				
				$vals = array(
				'word'	 => $word,
				'img_path'	 => PATH_ASSETS.'/capctha/',
				'img_url'	 => BASE_URL.'/assets/capctha/',
				'img_width'	 => '150',
				'img_height' => 30,
				'expiration' => 7200
				);
				
				$cap = create_captcha($vals);
				$this->data["captcha"] = $cap['image'];
				
				// load view			
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/changePassword');
			}
		} else {
			
			$log_module = "Change Password";
			$log_value = $_SESSION['admin_data']['user_name']." | ".$newpassword_md5;
			$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
			
			$insert = $this->Model_home->updatePassword($newpassword_md5);
			
			//session_destroy();
			unset($_SESSION['admin_data']);
			
			redirect(BASE_URL_BACKEND."/home");
		}
	}	
}