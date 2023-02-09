<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_404 extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		session_start();date_default_timezone_set('UTC');
        $this->load->model(array('backend/Model_menu_frontend', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
	}
	
	public function index(){
		$this->data['title'] = "404 Not Found";
		include 'checkSession.php'; 
		
		$this->data['message'] = "<b>".$this->security->xss_clean(secure_input(current_url()))."</b>";
		
		$this->load->view('vMy404',$this->data);
	}
}