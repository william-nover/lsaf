<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_schedule extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('UTC');
                session_start();
                if(empty($_SESSION['user_data'])){
			session_destroy();
			redirect(BASE_URL."/signin");
			exit();
		}
            error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR |
			E_COMPILE_WARNING );    
		$this->load->model(array('web/Model_class_schedule','web/Model_menu','backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
		$this->data['menu_left'] =  $this->uri->segment(1);
        }
	
	 function index()
	{     
	
			 $this->data['title'] =  $this->uri->segment(1);
			 $this->data['metacontent']='London School of Accoutancy And Finance';
			 $this->data['metadesc']='Student E_learning  pages';
			 $this->data['metaurl'] = current_url(); 

            include 'checkSession.php';
             if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            else if ($this->data["step"]== 3){
            $this->data["now"]= date("Y-m-d");                 
            $getVideo = $this->Model_class_schedule->getVideoSchedule();
            $getModule = $this->Model_class_schedule->getModuleSchedule();
            $getSkype = $this->Model_class_schedule->getSkypeSchedule();

            $jsonevents = array();
            foreach($getVideo as $entry)
            {
                $jsonevents[] = array(
                    'id' => $entry->video_lectures_id,
                    'title' => $entry->subject_title.'-'.$entry->video_lectures_title,
                    'start' => $entry->video_lectures_date,           
                    'url' => 'Video_lectures/detail/'.$entry->video_lectures_id
                );
            }  

            foreach($getModule as $entry)
            {
                $jsonevents[] = array(
                    'id' => $entry->module_lectures_id,
                    'title' => $entry->subject_title.'-'.$entry->module_lectures_title,
                    'start' => $entry->module_lectures_date,           
                    'url' => 'Module_lectures/detail/'.$entry->module_lectures_id
                );
            } 

            foreach($getSkype as $entry)
            {
                $jsonevents[] = array(
                    'id' => $entry->skype_lectures_id,
                    'title' => $entry->subject_title.'-'.$entry->skype_lectures_title,
                    'start' => $entry->skype_lectures_date.'T'.$entry->skype_lectures_time,           
                    'url' => 'Skype_lectures/detail/'.$entry->skype_lectures_id
                );
            }
            $this->data['json'] = json_encode($jsonevents);
            $this->load->view('vClass_schedule',$this->data);    
             }
             
             
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            } 


        }
                    
        
}