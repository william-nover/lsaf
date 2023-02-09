<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_media extends CI_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library("tukarpoin");
	}
	
	
	public function connectfacebook()
	{
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		
		echo "<pre>";
	    print_r($_SESSION);
	    echo "</pre>";
		
		$this->load->library("facebook");
		$loginUrl = $this->facebook->loginurl();
		
		echo '<a href="'.$loginUrl.'">Log in with Facebook!</a>';
	}
	
	public function connectfacebookcallback()
	{
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		
		$this->load->library("facebook");
		$arrFBToken = $this->facebook->gettoken();
		$arrMe = $this->facebook->getme($arrFBToken['access_token']);
		
		//check email exist
		$email = $arrMe['user_profile']['email'];
		$signature = strtoupper(md5($email.MERCHANT_ID.SECRET_KEY)); 	
		$params = array(
						'email' => $email,
						'mid' => MERCHANT_ID,								
						'signature' => $signature);
		$resultcheckemailexist = $this->tukarpoin->request_account("CheckEmailExist",$params);
		
		if($resultcheckemailexist['status'] == 1){
			if($resultcheckemailexist['data']['status'] == 0){
				$_SESSION['fb']['email'] = $arrMe['user_profile']['email'];
				$_SESSION['fb']['name'] = $arrMe['user_profile']['name'];
				if($arrMe['user_profile']['gender'] == "male"){
					$_SESSION['fb']['gender'] = "M";
				} else {
					$_SESSION['fb']['gender'] = "F";
				}
				redirect(BASE_URL."/daftar");
			} else {			
				//get profile by email
				$signature = strtoupper(md5($email.MERCHANT_ID.SECRET_KEY)); 	
				$params = array(
							'email' => $email,
							'mid' => MERCHANT_ID,								
							'signature' => $signature);
				$result_profile = $this->tukarpoin->request_account("AccountInfoEmail",$params);
				
				if($resultcheckemailexist['status'] == 1){
					$_SESSION['user']['login'] = true;
					$_SESSION['user']['username'] = $result_profile['data']['login'];
					$_SESSION['user']['email'] = $email;
					$_SESSION['user']['name'] = $result_profile['data']['name'];
					$_SESSION['user']['birthdate'] = $result_profile['data']['birthdate'];
					$_SESSION['user']['phone'] = $result_profile['data']['phone'];
					$_SESSION['user']['country'] = $result_profile['data']['country'];
					$_SESSION['user']['gender'] = $result_profile['data']['gender'];
					redirect(BASE_URL);
					exit;
					
					/*if($result_profile['data']['status'] == 2){
						$_SESSION['user']['login'] = true;
						$_SESSION['user']['username'] = $result_profile['data']['login'];
						$_SESSION['user']['email'] = $email;
						$_SESSION['user']['name'] = $result_profile['data']['name'];
						$_SESSION['user']['birthdate'] = $result_profile['data']['birthdate'];
						$_SESSION['user']['phone'] = $result_profile['data']['phone'];
						$_SESSION['user']['country'] = $result_profile['data']['country'];
						$_SESSION['user']['gender'] = $result_profile['data']['gender'];
						redirect(BASE_URL);
						exit;
					} else {
						echo "Email tidak terdaftar";
					}*/
				} else {
					echo "Error API Account Info Email";
				}	
			}	
		} else {
			echo "Error API Check Email Exist";
		}
		
	}
}