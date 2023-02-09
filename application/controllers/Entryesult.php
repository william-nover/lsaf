<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entryesult extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                $this->load->model(array('backend/Model_menu_frontend','web/Model_Apply','backend/Model_logcms'));
				$this->load->helper(array('funcglobal','captcha'));
                $this->load->library(array('session'));
                session_start();
	}
	
	public function index()
	{
           $this->load->view('vEntryresult');
	}
	
	
}