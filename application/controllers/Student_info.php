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
                $this->data['menu_left'] =  $this->uri->segment(1);
				$this->data['title'] =  $this->uri->segment(1);
			 $this->data['metacontent']='London School of Accoutancy And Finance';
			 $this->data['metadesc']='Student E_learning  pages';
			 $this->data['metaurl'] = current_url();
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
           /*        
           function edit()
	{         
            include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
            else if ($this->data["step"]== 3){
            $this->data['getPersonal'] = $this->Model_apply->getPersonal($this->data["signup_id"]);         
           
            $this->data['getNationality'] = $this->Model_apply->getNationality();
            
            $this->load->view('vStudent_edit',$this->data); 
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }        
    } 
    
    
    function UpdateData(){
        
    }
    
    */ 
    
    
    
    
    function changepassword(){
           include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
           
            else if ($this->data["step"]== 3){
                 
            
            
            $this->load->view('vStudent_password',$this->data); 
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
        }
        
         function SavePassword(){
           include 'checkSession.php';
            if ($this->data["step"]==''){        
            redirect(BASE_URL.'/Signup');
            }
           
            else if ($this->data["step"]== 3){
                
          
                $this->form_validation->set_rules('oldpassword', 'oldpassword', 'required');
                $this->form_validation->set_rules('newpassword', 'newpassword', 'trim|required|min_length[6]');
                $this->form_validation->set_rules('confpassword', 'confpassword', 'trim|required|min_length[6]');
                 
                    if ($this->form_validation->run() == FALSE)
                    {
                     $this->data['notif']='error change password';
                    
                     $this->load->view('vStudent_password',$this->data); 
                    }
                     else
                        { 
                         $oldPassword = $this->security->xss_clean(secure_input($_POST['oldpassword'])); 
                         $newpassword = $this->security->xss_clean(secure_input($_POST['newpassword']));                  
                         $confpassword = $this->security->xss_clean(secure_input($_POST['confpassword']));
                         $pass = md5($oldPassword);
                         
                         $getPassword = $this->Model_apply->cekPassword($this->data["signup_id"],$pass);
                       
                            if(empty($getPassword)){
                            $this->data['notif']='password not found';
                            $this->load->view('vStudent_password',$this->data); 
                            } else {
                                if ($newpassword == $confpassword){
                                    $newpass = md5($newpassword);
                                    $updatePass= $this->Model_apply->updatePassword($this->data["signup_id"],$newpass);
                                     
                                    
                                     $this->data['notif']='Password succesful changed';
                                     $this->load->view('vStudent_password',$this->data); 
                                    
                                }
                                else {
                                     $this->data['notif']='password confirmation not match ';
                                     $this->load->view('vStudent_password',$this->data); 
                                }
                                
                            }
                                     
                        } 
            
            } 
            elseif ($this->data["step"] == 1 || $this->data["step"]!= 3 ) {
            redirect(BASE_URL.'/Mylsaf');
            }
        }
        
}