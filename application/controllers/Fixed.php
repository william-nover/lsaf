<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fixed extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();   
		$this->load->helper('download');
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
        $campus = $this->input->post('campus');
		$this->Model_fixed->savePersonBrochure($gender_label, $first_name, $last_name, $email, $edu, $campus);
        
		
		// $file_path = PDF_BASE_URL.'/LSAF.pdf';
        // $file_name = PDF_BASE_URL.'/LSAF.pdf';
        // force_download($file_name, file_get_contents($file_path));
        // $this->Model_fixed->savePersonBrochure($data);
	}   
}