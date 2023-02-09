<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                session_start();
		$this->load->model(array('backend/Model_signin','backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','captcha'));
	}
	
	public function index()
	{
		$this->login();
	}
	
	function login()
	{
		if(!empty($_SESSION['admin_data'])){
			redirect(BASE_URL_BACKEND."/home");
			exit();
		}else{
			$alphanumerik = '0123456789';	
			$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
			$_SESSION['captcha'] = $word;
			
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
			
			$this->load->view('backend/signin',$this->data);
		}
	}
	
	function cekLogin()
	{
		$tbSignin = $this->input->post('tbSignin');
		
		if (!$tbSignin) {
			redirect(BASE_URL_BACKEND.'/signin');
			die;
		}
		
		$username = $this->security->xss_clean(secure_input($_POST['username']));
		$password = $this->security->xss_clean(secure_input_password($_POST['password']));
		$pass = md5($password);
		$capctha = $this->security->xss_clean(secure_input($_POST['capctha']));
		
		$pesan = array();
		// Validasi data
		if (trim($username)=="") {
			$pesan[] = "Username is empty";
		} else if (trim($password)=="") {
			$pesan[] = "Password is empty";
		} else if (trim($capctha)=="") {
			$pesan[] = "Security Code is empty";
		} else if($_SESSION['captcha'] != $capctha){
			$pesan[] = "Security Code is not valid";
		} 
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$alphanumerik = '0123456789';	
				$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
				$_SESSION['captcha'] = $word;
				
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

				$this->load->view('backend/signin',$this->data);
			}
		} else {
			$rsAdmin = $this->Model_signin->cekAdminLogin($username, $pass); 
			$countAll = count($rsAdmin);
			if($countAll > 0){
				$rsDefaultLanguage = $this->Model_language->getListLanguage(" WHERE language_default = 1 "); 
				if(count($rsDefaultLanguage) < 1){
					$rsDefaultLanguage[0]['language_id'] = 0;
				}
				
				$admin_data = array("user_id" => $rsAdmin[0]['user_id'],
                                                    "user_name" => $rsAdmin[0]['user_name'],
                                                    "user_level_id" => $rsAdmin[0]['user_level_id'],
                                                    "language_id" => $rsDefaultLanguage[0]['language_id']
									);
				$_SESSION['admin_data'] = $admin_data;
				
				$log_module = "Login";
				$log_value = $_SESSION['admin_data']['user_name']." | ".$_SESSION['admin_data']['user_level_id'];
				$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
				
				redirect(BASE_URL_BACKEND.'/home');
				die;
			} else {
				$alphanumerik = '0123456789';	
				$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
				$_SESSION['captcha'] = $word;
				
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
				
				$this->data['error'] = "Incorrect username and password";
				$this->load->view('backend/signin',$this->data);
			}
		}
	}
	
	function signout()
	{
		
		$log_module = "Logout";
		$log_value = $_SESSION['admin_data']['user_name']." | ".$_SESSION['admin_data']['user_level_id'];
		$insertlog = $this->Model_logcms->insertLogCMS($log_module,$log_value);
		
		//session_destroy();
		unset($_SESSION['admin_data']);
		
		redirect(BASE_URL_BACKEND."/home"); 
		exit();
	}
	
	function reload_captcha(){		
		$alphanumerik = '0123456789';	
		$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
		$_SESSION['captcha'] = $word;
		

		$vals = array(
				'word'	 => $word,
				'img_path'	 => PATH_ASSETS.'/capctha/',
				'img_url'	 => BASE_URL.'/assets/capctha/',
				'img_width'	 => '150',
				'img_height' => 30,
				'expiration' => 7200
				);
			
		$cap = create_captcha($vals);
		$return["captcha"] = $cap['image'];
		
		echo $return["captcha"];
	}
}