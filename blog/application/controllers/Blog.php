<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

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
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias','text'));		
                $module_name= 'blog';
                
                $getmodule = $this->Model_content->getModule($module_name);
                foreach ($getmodule as $gm) {
                 $this->module_id = $gm->module_id;
                 $this->section = $gm->module_group_id;
                 $_SESSION['module_id']=$this->module_id;
                }
		$this->data["menu_id"]=4;
		$this->data['controller'] = $module_name; 
                $this->data['module_id']=$_SESSION['module_id'];
                $this->data['now'] = date("Y-m-d");
                $ListCategory             = $this->Model_label->getOptions(86,6); 
                $this->data["countCategory"] = count($ListCategory);
                $this->data["ListCategory"] = $ListCategory;
              
	}

	 
	
        public function index()                          
	{    
            $this->data['controller'] = $this->uri->segment(1);
            $this->data['title']=  $this->data['controller'];      
             $whereContent = " WHERE a.row_active_status=1 and  a.row_parent=0 and a.module_id = ".$_SESSION['module_id']." and a.publish_date <= '". $this->data['now']."' and a.close_date >= '". $this->data['now']."' ";
              
                   $config = array();
                   $config["base_url"] = BASE_URL."/blog/page/";
                   $config["uri_segment"] = 1;
                   $config['full_tag_open'] = ' <div class="pagination text-small text-uppercase text-extra-dark-gray"><ul class="mx-auto">';
                   $config['full_tag_close'] = '</ul></div>';
                   $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';
                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';
                    $config['prev_link'] = '<i class="fas fa-long-arrow-alt-left margin-5px-right d-none d-md-inline-block"></i> Prev';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';
                    $config['next_link'] = 'Next <i class="fas fa-long-arrow-alt-right margin-5px-left d-none d-md-inline-block"></i>';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';
                    $config["total_rows"] = $this->Model_content->getCount($whereContent,'');
                    $per_page =  $config["per_page"] = 9; 
                    $this->pagination->initialize($config);
                    $page =0;
                    $this->data['page'] = $page; 
                $order_limit='';
                $order_limit .= " order by a.row_order ASC";
                $order_limit .= " limit ".$page. "," .$per_page;
                $label_page =1;
                $ListContent = $this->Model_content->getListContent($whereContent,$order_limit,$label_page);
                $this->data["countContent"] = count($ListContent);
		$this->data["ListContent"] = $ListContent;
                
//                echo '<!--<pre>';
//                print_r($ListContent);
//                echo '-->';
                
                $this->data['page_links']=$this->pagination->create_links();
                $this->data['breadcrump'] ='';
		$this->load->view('vblog',$this->data);

	}
        function page (){
          
                $this->data['module_id'] =  $_SESSION['module_id'];                
               $this->data['title']=  $this->data['controller'];  
                $whereContent = " WHERE a.row_active_status=1 and  a.row_parent=0 and a.module_id = ".$_SESSION['module_id']." and a.publish_date <= '". $this->data['now']."' and a.close_date >= '". $this->data['now']."' ";
               
                $config = array();
                $config["base_url"] = BASE_URL."/blog/page/";
                $config["total_rows"] = $this->Model_content->getCount($whereContent,'');           
                $config["uri_segment"] = 3;
                $config['full_tag_open'] = ' <div class="pagination text-small text-uppercase text-extra-dark-gray"><ul class="mx-auto">';
                $config['full_tag_close'] = '</ul></div>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['prev_link'] = '<i class="fas fa-long-arrow-alt-left margin-5px-right d-none d-md-inline-block"></i> Prev';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next <i class="fas fa-long-arrow-alt-right margin-5px-left d-none d-md-inline-block"></i>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $per_page =  $config["per_page"] = 9; 
                $this->pagination->initialize($config);
                $getpage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                if ($getpage != 0){
                   $page = $getpage;  
                }
                else {
                     $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
                }
                if (!is_numeric($page))
                {
                   $page=0;
                }
                $order_limit='';
                $order_limit .= " order by a.row_order ASC";
                $order_limit .= " limit ".$page. "," .$per_page;
                $label_page =1;
                $ListContent = $this->Model_content->getListContent($whereContent,$order_limit,$label_page);
                 
                $this->data["countContent"] = count($ListContent);
		$this->data["ListContent"] = $ListContent;
               
                
                $this->data['page_links']=$this->pagination->create_links();                              
		$this->load->view('vblog',$this->data);
           
        }        
	 function detail($row_id=NULL)
	{
          
             $whereContent = '';
                $order_limit= '';
                $whereContent .= "WHERE a.row_parent=0 and a.row_id = ".$row_id;
                $order_limit .= " order by a.row_order ASC";
                $order_limit .= " limit  0, 6 ";
                $ListContent = $this->Model_content->getListContent($whereContent,$order_limit,'');
                $this->data["countContent"] = count($ListContent);
//                echo '<!--<pre>';
//                print_r($ListContent);
//                echo '-->';
		$this->data["ListContent"] = $ListContent;
                foreach($this->data["ListContent"] as $pr){
                            $label =   $pr['content'][2]['label_id'];
                            $content=   $pr['content'][2]['content_text'];
                            $where_related  ='inner join tbl_content c on a.row_id = c.row_id WHERE a.row_id <> '.$pr['row_id'] .' and a.module_id = '.$_SESSION['module_id'] .' and (c.label_id ='."$label".' and c.content_text in ('."$content".') )';
                       
                  $row_id=  $pr['row_id'] ;     
                } 
                $label_page=1;
                $blogRelated = $this->Model_content->getListContent($where_related,$order_limit,$label_page);
                $this->data["countPr"]= count($blogRelated);
                $this->data["ListPr"]=$blogRelated;
//               
                
                $update_view = $this->Model_content->getUpdateViews($row_id); 
                
                
                
                $whereBlog ='';
                $whereBlog .= " WHERE a.row_id <> $row_id and a.row_active_status=1 and  a.row_parent=0 and a.module_id = ".$_SESSION['module_id']."  and a.publish_date <= '". $this->data['now']."' and a.close_date >= '". $this->data['now']."' ";              
                $LatestBlog = $this->Model_content->getListContent($whereBlog,$order_limit,$label_page);                
                $this->data["countLatestBlog"] = count($LatestBlog);
		$this->data["LatestBlog"] = $LatestBlog;
                
                
                $whereNext = "WHERE a.row_parent=0 and a.row_id > ".$row_id." and a.module_id = ".$_SESSION['module_id']."";
                $wherePrev = "WHERE a.row_parent=0 and a.row_id < ".$row_id." and a.module_id = ".$_SESSION['module_id']."";
                $ListNext = $this->Model_content->getNextPrev($whereNext,$order_limit);
                $ListPrev = $this->Model_content->getNextPrev($wherePrev,$order_limit);
               
                if (count($ListNext) > 0){
                if ($ListNext[0]['row_alias'] !=''){                          
                $this->data["next"] =BASE_URL.'/'.$ListNext[0]['row_alias'];
                }                       
                else {                          
                $this->data["next"]  =  BASE_URL.'/'.$this->data['controller'].'/detail/'.$ListNext[0]['row_id'];                 
                }  
                }
                else {
                    $this->data["next"] ='';
                    
                }
             
                if (count($ListPrev) > 0){
                if ($ListPrev[0]['row_alias'] !=''){                          
                $this->data["prev"] =BASE_URL.'/'.$ListPrev[0]['row_alias'];
                }                       
                else {                          
                $this->data["prev"]  =  BASE_URL.'/'.$this->data['controller'].'/detail/'.$ListPrev[0]['row_id'];                 
                }  
                }
                else {
                    $this->data["prev"] =''; 
                }         
                if( $this->data["countContent"] > 0){
                    $this->load->view('vblogdetail',$this->data);    
                }
                else {
                    redirect(BASE_URL.'/blog');
                }
		
	}
}