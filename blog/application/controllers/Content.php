<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public function __construct()

	{
		parent::__construct();
                  if (!$_SESSION) {
                    session_start();
                }
                 include 'checkSession.php'; 
              
                date_default_timezone_set('UTC');
		$this->load->model(array('backend/Model_menu_frontend','web/Model_label','web/Model_content'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));		
                $module_name=  $this->uri->segment(1);
                
                $getmodule = $this->Model_content->getModule($module_name);
                foreach ($getmodule as $gm) {
                 $this->module_id = $gm->module_id;
                 $this->section = $gm->module_group_id;
                 $_SESSION['module_id']=$this->module_id;
                }
		
		$this->data['controller'] = $module_name; 
                if ($module_name == 'faq'){
                     $this->data['breadcrump']= 'Frequenly asked question';
                } else if ($module_name == 'privacy_policy'){
                     $this->data['breadcrump']= 'privacy & policy';
                } else {
                    $this->data['breadcrump'] =$this->data['controller'];
                }
                  
                $this->data['module_id']=$_SESSION['module_id'];
	}

	 function index()
	{
                $order_limit='';
                $order_limit .= " order by a.row_order ASC";
                $order_limit .= " limit  0, 8";
                $whereContent = '';
                $whereContent .= " WHERE a.row_active_status=1 and  a.row_parent=0 and a.module_id = ".$_SESSION['module_id'];
                $ListContent = $this->Model_content->getListContent($whereContent,$order_limit);
                $this->data["countContent"] = count($ListContent);
		$this->data["ListContent"] = $ListContent;                         
		$this->load->view('vcontent',$this->data);
	}
	
	 function detail($row_id=NULL)
	{
                $whereContent = '';
                $order_limit= '';
                $whereContent .= "WHERE a.row_parent=0 and a.row_id = ".$row_id;
                $order_limit .= " order by a.row_order ASC";
                $order_limit .= " limit  0, 4 ";
                $ListContent = $this->Model_content->getListContent($whereContent,$order_limit);
                $this->data["countContent"] = count($ListContent);
		$this->data["ListContent"] = $ListContent;
                           
                if( $this->data["countContent"] > 0){
                        foreach($this->data["ListContent"] as $pr){
                         
                        $visibility = contentValue($pr, 'visibility');
                         
                            $label =   $pr['content'][1]['label_id'];
                            $content=   $pr['content'][1]['content_text'];
                            $where_related  ='inner join tbl_content b on a.row_id = b.row_id WHERE a.module_id = '.$_SESSION['module_id'] .' and (b.label_id ='."$label".' and b.content_text ='."$content".')';
                        
                         if($visibility != 'Public' && $this->data["agent_id"] == '' && $_SESSION['module_id'] =100 ){
                             redirect(BASE_URL.'/home');
                         } 
                            
                       } 
                       $this->data["productRelated"] = $this->Model_content->getListContent($where_related,$order_limit);
                           
                     
                     $this->load->view('vDetail'.$this->data['controller'],$this->data);   
                }     
		
	}

}