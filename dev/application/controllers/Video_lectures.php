<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_lectures extends MY_Controller {
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
                $this->load->model(array('web/Model_class_schedule','backend/Model_video_lectures','web/Model_menu'));
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
                       
            $ListVideo_Lectures = $this->Model_class_schedule->getVideoScheduleMonth($month); 

            $this->data['month']=$month;
            $this->data['ListVideo_Lectures']=$ListVideo_Lectures;
            $this->load->view('vVideo_lectures',$this->data); 
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
                 $rsVideo_Lectures = $this->Model_class_schedule->getVideo_Lectures($id);  // mengambil database dari model untuk dikirim ke view		
                $countVideo_Lectures = count($rsVideo_Lectures);
		
		$this->data['rsVideo_Lectures'] = $rsVideo_Lectures;
		$this->data['countVideo_Lectures'] = $countVideo_Lectures;
                $this->load->view('vVideo_detail',$this->data); 
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
            
                
   
            
    }   
}