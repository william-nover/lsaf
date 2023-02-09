<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                $this->load->model(array('backend/Model_menu_frontend','web/Model_Apply','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','captcha'));
                //$this->load->library(array('session'));
               session_start();
	}
	
	public function index()
	{
            
		$this->login();
	}
	
	function login()
	{
            
            include 'checkSession.php'; 
            
		if(!empty($_SESSION['user_data'])){              
			redirect(BASE_URL."/Mylsaf");
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
                      //  $this->data["capt"]=$word;
			$this->data["captcha"] = $cap['image'];			
			$this->load->view('vLogin',$this->data);
		}
	}
	
	function cekLogin()
	{
            include 'checkSession.php'; 
            
		$tbSignin = $this->input->post('tbSignin');
		
		if (!$tbSignin) {
			redirect(BASE_URL.'/signin');
			die;
		}
		
		$email = $this->security->xss_clean(secure_input($_POST['email']));
		$password = $this->security->xss_clean(secure_input_password($_POST['password']));
		$pass = md5($password);
		$capctha = $this->security->xss_clean(secure_input($_POST['capctha']));
		//$capt = $this->security->xss_clean(secure_input($_POST['capt']));
		$pesan = array();
		// Validasi data
		if (trim($email)=="") {
			$pesan[] = "Please fill email";
		} else if (trim($password)=="") {
			$pesan[] = "Please fill password";
		} else if (trim($capctha)=="") {
			$pesan[] = "Please fill security code";
                } 
                else if($_SESSION['captcha'] != $capctha){             
			$pesan[] = "Security Code is not valid";
		} 
//               
		
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
                                $this->data["capt"]=$word;
				$this->load->view('vLogin',$this->data);
			}
		} else {
			$getSign = $this->Model_Apply->cekSignUp($email,$pass); 
			
			if(!empty($getSign)){
				foreach($getSign as $items){ 
					if($items->step == 3){
						$getStudent = $this->Model_Apply->getStudent($items->signup_id); 
						foreach($getStudent as $student){
							$session_student =   $student->student_id."|".$student->student_pid."|".$student->module_level_id;                                      
						}  
					}                            
				   
					$session_email = $items->signup_id."|".$items->full_name."|".$items->email."|".$items->step."|".$items->status."|".$items->entry_group_id;                                                                                                                           
				}
				
				$_SESSION['ses_student'] = $session_student;
				$_SESSION['user_data'] = $session_email; 
				 
				redirect(BASE_URL."/Mylsaf");
				die;
            } else {
				$alphanumerik = '0123456789';	
				$word = str_shuffle(substr(str_shuffle($alphanumerik),1,6));
				$_SESSION['captcha'] = $word;
                                //$this->session->set_userdata('captcha',$word);
				
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
				$this->data["capt"]=$word;
				$this->data['error'] = "Incorrect email and password";
				$this->load->view('vLogin',$this->data);
			}
		}
	}
	
	function signout()
	{
		//$this->session->unset_userdata(array("searchkey" => '', "searchby" => ''));
		session_destroy();
		redirect(BASE_URL."/home");
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