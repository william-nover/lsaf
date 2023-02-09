<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	public $data = array();
	//public $section = 8; //get page group id from database
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('web/Model_page','web/Model_menu','backend/Model_language','backend/Model_logcms'));
				$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
                $page_name=  $this->uri->segment(1);
                $this->page_name = $page_name;
                
			 $this->data['title'] =  $this->uri->segment(1);
			 $this->data['metacontent']='London School of Accoutancy And Finance';
			 $this->data['metadesc']='Student E_learning  pages';
			 $this->data['metaurl'] = current_url();
	}
	
	public function index()
	{       
                include 'checkSession.php';                    
                $this->data['controller'] = $this->uri->segment(1);
                $this->data['getpages'] = $this->Model_page->getPage($this->page_name);              
				$this->load->view('vpages',$this->data);
	}
}