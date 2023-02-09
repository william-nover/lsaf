<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MY_Controller {
	public $data = array();
	public $section = 8; //get module group id from database
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('web/Model_content','backend/Model_menu_frontend','backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
             
	}
	
	public function index($id_satu='', $id_dua='', $id_tiga='', $title='')
	{       
                include 'checkSession.php';
                echo $id_satu;
               
               
                if($id_satu!='' || $id_satu!=0 ){
                 $getModule = $this->Model_content->getMenuModule($id_satu);                   
                 foreach ($getModule as $mdl) {
                  $this->data['controller'] = $mdl->module_path; 
                  $this->data['module_id'] = $mdl->module_id;  
                 }
              
                }
                if($id_satu == '' || $id_satu == 0){
                      echo $this->data['controller'] = $this->uri->segment(1);
                      $getModule = $this->Model_content->getModuleId($this->data['controller']); 
                     foreach ($getModule as $mdl) {
                        echo  $this->data['controller'] = $mdl->module_path; 
                        echo  $this->data['module_id'] = $mdl->module_id;  
                    }
                 }
            
                
               $this->data['MenuContent'] = $this->Model_menu_frontend->getMenuContent($this->data['module_id']);
              
               $this->data['title'] = $this->data['controller'];
                
                
                
                
		
   
		
		$this->load->view('vcontent',$this->data);
	}
}