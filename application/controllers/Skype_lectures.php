<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skype_lectures extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('UTC');
		 error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR |
			E_COMPILE_WARNING );   
                session_start();
                if(empty($_SESSION['user_data'])){
			session_destroy();
			redirect(BASE_URL."/signin");
			exit();
		}
                $this->load->model(array('web/Model_class_schedule','backend/Model_skype_lectures','web/Model_menu','backend/Model_language'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		$this->data['menu_left'] =  $this->uri->segment(1);
		$this->data['title'] =  $this->uri->segment(1);
			 $this->data['metacontent']='London School of Accoutancy And Finance';
			 $this->data['metadesc']='Student E_learning  pages';
			 $this->data['metaurl'] = current_url();
        }
	
	 function index($date = NULL)
	{    
             include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            else if ($this->data["step"]== 3){ 
            if ($date == ''){ $month= date("Y-m"); }else{ $month = $date; }
                       
            $ListSkype_Lectures = $this->Model_class_schedule->getSkypeScheduleMonth($month); 

            $this->data['month']=$month;
            $this->data['ListSkype_Lectures']=$ListSkype_Lectures;
            $this->load->view('vSkype_lectures',$this->data);  
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
                $rsSkype_Lectures = $this->Model_class_schedule->getSkype_Lectures($id);  // mengambil database dari model untuk dikirim ke view
		
                $countSkype_Lectures = count($rsSkype_Lectures);
		
		$this->data['rsSkype_Lectures'] = $rsSkype_Lectures;
		$this->data['countSkype_Lectures'] = $countSkype_Lectures;
                $this->load->view('vSkype_detail',$this->data);  
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
               
                
   
            
    } 
}