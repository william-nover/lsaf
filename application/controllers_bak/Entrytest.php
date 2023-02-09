<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entrytest extends MY_Controller {	
	public $data = array();	
	
	public function __construct()	
	{		
		parent::__construct();            
		session_start();            
		if(empty($_SESSION['user_data'])){
		session_destroy();
		redirect(BASE_URL."/signin");
		exit();		}
		$this->load->model(array('backend/Model_menu_frontend','web/Model_Apply','web/Model_entry','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
		$this->load->library(array('form_validation'));
	}		
	
	function index()	
	{ 		
	ini_set('display_errors', '1');
	$this->data['Menu_all'] = $this->Model_menu_frontend->GenerateMenu();
	include 'checkSession.php';
		if($this->data['step']==''){
			redirect(BASE_URL.'/Signup');
		}else if($this->data['step'] != 1 ){
			redirect(BASE_URL.'/Mylsaf');
		}else if($this->data['step']==1){
			$rsDt = $this->Model_entry->getEntryTest($this->data['signup_id']);
			
			if( count($rsDt) < 1){
				$rsDt = $this->Model_entry->createEntryTest($this->data['signup_id']);
			}else{
				if( $rsDt['entry_test_status'] == 0 ){
					echo "silahkan ambil test";
				} else if( $rsDt['entry_test_status'] == 1 ) {
					echo "silahkan lanjutkan test anda";
				} else if( $rsDt['entry_test_status'] == 2 ) {
					echo "Anda sudaj ambil test ini, silahkan tunggu hasil by email";
				}
			}
			
		$this->load->view('vEntryTest',$this->data);
		}
	}
}