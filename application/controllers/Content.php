<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MY_Controller {
	public $data = array();
	public $section = 8; //get module group id from database
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('web/Model_content','web/Model_menu','backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('url','funcglobal','menu','accessprivilege','alias'));
             
	}
	
	public function index($id_satu='', $id_dua='', $id_tiga='', $id_empat='')
	{       
	    
                include 'checkSession.php';    
                $this->data['controller'] = $this->uri->segment(1);
                             
                $getModule = $this->Model_content->getModuleId($this->data['controller']); 
                   foreach ($getModule as $mdl) {
                        $this->data['controller'] = $mdl->module_path; 
                        $this->data['module_id'] = $mdl->module_id;  
                  }
                 
                  if ($id_satu!=''&& $id_dua!='' && $id_tiga!=''&& $id_empat!=''){
                    $where_menu = " where a.menu_parent = ".$id_satu." and a.menu_sub_parent = ".$id_dua." " ;    
                    $where_content = " where b.menu_parent = ".$id_satu." and b.menu_sub_parent = ".$id_dua."  and a.menu_id = ".$id_tiga." " ;
                    $this->data['menu_id'] = $id_tiga; 
                  }  
                  else if ($id_satu!=''&& $id_dua!='' && $id_tiga!='' && !$id_empat){
                   $where_menu = " where a.menu_parent = ".$id_satu." and a.menu_sub_parent = 0 " ; 
                   $where_content = " where b.menu_parent = ".$id_satu." and b.menu_sub_parent = 0 and a.menu_id = ".$id_dua." " ;
                   $this->data['menu_id'] = $id_dua;
                  }
                 else if ($id_satu!=''&& $id_dua !='' && !$id_tiga && !$id_empat){
                    $where_menu = " where a.menu_parent = 0 and a.menu_sub_parent = 0 " ;    
                    $where_content = " where b.menu_parent = 0 and b.menu_sub_parent = 0 and a.menu_id = ".$id_satu." " ; 
                    $this->data['menu_id'] = $id_satu;
                  }
                  else{
                    $where_menu = " where a.menu_parent = 0 and a.menu_sub_parent = 0 " ;    
                    $where_content = " where b.menu_parent = 0 and b.menu_sub_parent = 0 ";   
                    $this->data['menu_id'] = "";
                  }
                $this->data['title'] = $this->data['controller'];  
                $this->data['MenuContent'] = $this->Model_menu->getMenuContent($where_menu, $this->data['module_id']);
                $this->data['getContent'] = $this->Model_content->getContent($where_content, $this->data['module_id']);
				$contn = $this->data['getContent'];
				foreach($contn as $gt){
				$meta = $gt->content_title;	
				$desc = $gt->content_desc;					
				}
				
				 $metadesc = strip_tags($desc); 
			   $this->data['title'] = $this->uri->segment(1);  				 
			   $this->data['metacontent']=$meta;
			   $this->data['metadesc']=substr($metadesc, 0, 500);
			   $this->data['metaurl']  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI']; 
//        echo'<pre>';
//        print_r($this->data['getContent']);
//        die;
		$this->load->view('vcontent',$this->data);
	}
}