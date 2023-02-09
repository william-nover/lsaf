<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_info extends MY_Controller {
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
                $this->load->model(array('web/Model_apply','web/Model_menu'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
        }
	
	 function index( )
	{    
             include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            else if ($this->data["step"]== 3){ 
          
                       
            $getPersonal = $this->Model_apply->getPersonal($this->data["signup_id"]);         
            $this->data['getPersonal']=$getPersonal;
           
            
            $this->load->view('vStudent_info',$this->data);  
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
            
            
    }
                    
           function edit($signup_id)
	{         
            include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            else if ($this->data["step"]== 3){
            $this->data['getPersonal'] = $this->Model_apply->getPersonal($signup_id);         
           
            $this->data['getNationality'] = $this->Model_apply->getNationality();
            
            $this->load->view('vStudent_edit',$this->data); 
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
               
                
   
            
    } 
}