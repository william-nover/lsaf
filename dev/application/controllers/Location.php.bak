<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('backend/Model_menu_frontend', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
	}
	
	public function index()
	{
		$this->data['title'] = "Contact Us";
		include 'checkSession.php'; 
                
//                echo'<pre>';
//                print_r($this->data['Menu_all']);
//                die;
		$this->load->view('vlocation',$this->data);
	}
}