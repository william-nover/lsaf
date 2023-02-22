<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fixed extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();   
		
    }
	
	function index(){  
	}    
	
	function saveDataPerson(){ 

		$this->load->model('web/Model_fixed');
		
		$gender_label =  $this->input->post('gender_label');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
        $edu = $this->input->post('edu');
        $phone = $this->input->post('phone');
		$this->Model_fixed->savePersonBrochure($gender_label, $first_name, $last_name, $email, $edu, $phone);
	}   
}