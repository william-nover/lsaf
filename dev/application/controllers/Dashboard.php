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
                
                $this->load->model(array('backend/Model_menu_frontend', 'web/Model_Apply'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
                $this->load->library(array('form_validation'));
                
        }
	
	 function index()
	{ 
            
             include 'checkSession.php';
             if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
             else if ($this->data["step"]== 3){
            
             $this->load->view('vDashboard',$this->data);  

             }
            elseif ($this->data["step"] == 1 || $this->data["step"]> 2 ) {

            redirect(BASE_URL.'/Mylsaf');
            }
            
            
	}
                    
        
}