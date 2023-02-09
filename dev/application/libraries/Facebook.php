<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class Facebook extends CI_Controller {
	public $CI 	= "";
	public $config_facebook = array();
	public $session_facebook = array();
	public $data = array();
	public $fbLoginURL 	= "";
	
    public function __construct()
    {
		$this->CI = & get_instance();
		$this->CI->config->load("facebook",TRUE);
		$this->config_facebook = $this->CI->config->item('facebook');
    }
	
	public function loginurl(){
		$fb = new Facebook\Facebook([
		  'app_id'                => $this->config_facebook['appId'],
		  'app_secret'            => $this->config_facebook['secret'],
		  'default_graph_version' => 'v2.4',
		]);
		$helper = $fb->getRedirectLoginHelper();
		
		$permissions = $this->config_facebook['permission'];
		$callback = $this->config_facebook['callback_url'];
		$this->fbLoginURL = $helper->getLoginUrl($callback, $permissions);
		
		return $this->fbLoginURL;
	}
	
	public function gettoken(){
		$this->data['status'] = TRUE;
		$this->data['error_msg'] = "";
		$this->data['access_tokeb'] = "";
		
		$fb = new Facebook\Facebook([
		  'app_id'                => $this->config_facebook['appId'],
		  'app_secret'            => $this->config_facebook['secret'],
		  'default_graph_version' => 'v2.4',
		]);
		$helper = $fb->getRedirectLoginHelper();
		
		try {  
		  $accessToken = $helper->getAccessToken();  
		} catch(Facebook\Exceptions\FacebookResponseException $e) {  
		  // When Graph returns an error  
		  $this->data['status'] = FALSE;
		  $this->data['error_msg'] = 'Graph returned an error: ' . $e->getMessage();
		  exit;  
		} catch(Facebook\Exceptions\FacebookSDKException $e) {  
		  // When validation fails or other local issues  
		  $this->data['status'] = FALSE;
		  $this->data['error_msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;  
		}
		
		if (! isset($accessToken)) {  
		  if ($helper->getError()) {  
			header('HTTP/1.0 401 Unauthorized');  
			$this->data['status'] = FALSE;
			$this->data['error_msg'] .= "Error: " . $helper->getError() . "\n";
			$this->data['error_msg'] .= "Error Code: " . $helper->getErrorCode() . "\n";
			$this->data['error_msg'] .= "Error Reason: " . $helper->getErrorReason() . "\n";
			$this->data['error_msg'] .= "Error Description: " . $helper->getErrorDescription() . "\n";
			//$error_message = $error_message;
		  } else {  
			header('HTTP/1.0 400 Bad Request');  
			$this->data['status'] = FALSE;
			$this->data['error_msg'] = 'Bad request';  
		  }  
		  exit;  
		}
		
		// The OAuth 2.0 client handler helps us manage access tokens  
		$oAuth2Client = $fb->getOAuth2Client();  
		
		// Get the access token metadata from /debug_token  
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);  
		
		// Validation (these will throw FacebookSDKException's when they fail)  
		$tokenMetadata->validateAppId($this->config_facebook['appId']);  
		
		// If you know the user ID this access token belongs to, you can validate it here  
		// $tokenMetadata->validateUserId('123');  
		$tokenMetadata->validateExpiration();   
		
		if (! $accessToken->isLongLived()) {  
		  // Exchanges a short-lived access token for a long-lived one  
		  try {  
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);  
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {  
			$this->data['status'] = FALSE;
			$this->data['error_msg'] = "Error getting long-lived access token: " . $helper->getMessage();  
			exit;  
		  }  
		}
		
		$_SESSION['fb_access_token'] = (string) $accessToken;
		$this->data['access_token'] = (string) $accessToken;
		
		return $this->data;
	}
	
	public function getme($accesstoken){
		$user_profile = array();
		$this->data['error'] = FALSE;
		$this->data['error_msg'] = "";
		
		$fb = new Facebook\Facebook([
		  'app_id'                => $this->config_facebook['appId'],
		  'app_secret'            => $this->config_facebook['secret'],
		  'default_graph_version' => 'v2.4',
		]);
		$helper = $fb->getRedirectLoginHelper();
		
		try {
			$response = $fb->get('/me?fields=id,name,email,gender', $accesstoken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$this->data['error'] = TRUE;
			$this->data['error_msg'] = 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$this->data['error'] = TRUE;
			$this->data['error_msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		
		$user = $response->getGraphUser();
		$user_profile['id'] = $user['id'];
		$user_profile['name'] = $user['name'];
		$user_profile['email'] = $user['email'];
		$user_profile['gender'] = $user['gender'];
		
		$this->data['user_profile'] = $user_profile;
		
		return $this->data;
	}
}