<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_lectures extends MY_Controller {
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
                
                $this->load->model(array('web/Model_class_schedule','backend/Model_module_lectures','web/Model_menu','backend/Model_language'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
        }
	
	 function index($date = NULL)
	{    
            include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
              else if ($this->data["step"]== 3){
            if ($date == ''){ $month= date("Y-m"); }else{ $month = $date; }
                       
            $ListModule_Lectures = $this->Model_class_schedule->getModuleScheduleMonth($month); 

            $this->data['month']=$month;
            $this->data['ListModule_Lectures']=$ListModule_Lectures;
            $this->load->view('vModule_lectures',$this->data);  
   
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
            
    }
                    
        function detail($id)
	{         
            include 'checkSession.php';
             if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
              else if ($this->data["step"]== 3){
            
                $rsModule_Lectures = $this->Model_class_schedule->getModule_Lectures($id);  // mengambil database dari model untuk dikirim ke view
		
                $countModule_Lectures = count($rsModule_Lectures);
		
		$this->data['rsModule_Lectures'] = $rsModule_Lectures;
		$this->data['countModule_Lectures'] = $countModule_Lectures;
                $this->load->view('vModule_detail',$this->data);  
              }
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }    
    } 
    
}