<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		session_start();
		if(empty($_SESSION['user_data'])){
			session_destroy();
			redirect(BASE_URL."/signin");
			exit();
		}      
		
		$this->load->model(array('backend/Model_menu_frontend', 'web/Model_Dashboard'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
		$this->load->library(array('form_validation'));
		$this->data['menu_left'] =  $this->uri->segment(1);            
    }
	
	function index(){  
		include 'checkSession.php';
		
		$this->data['title'] =  $this->uri->segment(1);
		$this->data['metacontent']='London School of Accoutancy And Finance';
		$this->data['metadesc']='Student E_learning  pages';
		$this->data['metaurl'] = current_url(); 
		 
		if ($this->data["step"]==''){        
			redirect(BASE_URL.'/Signup');
		} else if ($this->data["step"]== 3){			
			$this->load->view('vDashboard',$this->data);  
		} elseif ($this->data["step"] == 1 || $this->data["step"]> 2 ) {
			redirect(BASE_URL.'/Mylsaf');
		}
	}   
	
	function saveDataPerson(){ 
		// $this->data['title'] =  $this->uri->segment(1);
		// $this->data['metacontent']='London School of Accoutancy And Finance';
		// $this->data['metadesc']='Student E_learning pages';
		// $this->data['metaurl'] = current_url(); 
		// gender_label= '".$gender_label."', 
        //                     first_name='".$first_name."', 
        //                     last_name='".$last_name."', 
        //                     email='".$email."', 
        //                     edu='".$edu."', 
        //                     campus='".$campus."',";		

		$this->load->model('Model_dashboard');
        $data = array(
            'gender_label' => $this->input->post('gender_label'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
            'edu' => $this->input->post('edu'),
            'campus' => $this->input->post('campus')
        );
        $this->Model_dashboard->savePersonBrochure($data);
	}   
}