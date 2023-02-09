<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mylsaf extends MY_Controller {
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

               
                
                
                $this->load->model(array('backend/Model_menu_frontend', 'web/Model_Apply','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','url'));
                $this->load->library(array('form_validation'));
                
        }
	
	 function index()
	{
              
            include 'checkSession.php'; 
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            if ($this->data["step"]==1){

                  redirect(BASE_URL.'/Entrytest');
            }
            elseif ($this->data["step"]==2) {

                redirect(BASE_URL.'/Offerletter');
            }             
            elseif ($this->data["step"]==3) {
            //$this->load->view('vDasboard',$this->data);
                 redirect(BASE_URL.'/Dashboard');
            }
             
	}
                    
        
}