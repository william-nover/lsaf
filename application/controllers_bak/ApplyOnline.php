<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApplyOnline extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('backend/Model_menu_frontend','web/Model_Apply','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));               
                error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
                
        }
	
	public function index()
	{       
                include 'checkSession.php'; 
                      
		$this->load->view('vApplyOnline',$this->data);
	}
    
         function Signup()
	{
		$this->data['title'] = "Home";
		include 'checkSession.php'; 
                
                $this->data['Nationality'] = $this->Model_Apply->getNationality();
//                echo'<pre>';
//                print_r($this->data['Nationality']);
//                die;
                if ($_POST) {
                 $email = $this->security->xss_clean(secure_input($_POST['email'])); 
                 $full_name = $this->security->xss_clean(secure_input($_POST['full_name'])); 
                 $date_day = $this->security->xss_clean(secure_input($_POST['date_day'])); 
                 $date_month = $this->security->xss_clean(secure_input($_POST['date_month'])); 
                 $date_year = $this->security->xss_clean(secure_input($_POST['date_year'])); 
                 $phone1 = $this->security->xss_clean(secure_input($_POST['phone1'])); 
                 $phone2 = $this->security->xss_clean(secure_input($_POST['phone2'])); 
                 $address1 = $this->security->xss_clean(secure_input($_POST['addr1'])); 
                 $address2 = $this->security->xss_clean(secure_input($_POST['addr2'])); 
                 $postal_code = $this->security->xss_clean(secure_input($_POST['postal_code']));                  
                 $country_id = $this->security->xss_clean(secure_input($_POST['country_id']));  
                 $today      = date("Y-m-d H:i:s"); 
                 $phone = $phone1.$phone2;
                 $time = strtotime($date_month.'/'.$date_day.'/'.$date_year);
                 $dob = date('Y-m-d',$time);
                 $passgenerate = random_string('alnum', 8);
                 $password = md5($passgenerate);
                 
                 $check_email = $this->Model_Apply->checkEmail($email);
                     if (count($check_email->result_array())>0)
                         {
                         echo'email sudah ada';
                         return false;
                         }else{
                         $verificationCode = random_string('alnum', 20); 
                         $data = array( 
                                        'full_name'=>$full_name,                                    
                                        'email'=>$email,  
                                        'password'=>$password,                                      
                                        'date_of_birth' =>$dob,
                                        'address1' =>$address1,
                                        'address2' =>$address2,
                                        'postal_code' =>$postal_code,
                                        'phone' =>$phone,
                                        'country_id' =>$country_id,
                                        'status'=>0,                                        
                                        'step'=>1,
                                        'signup_date'=>$today,
                                        'email_verification_code'=>$verificationCode
                                       );
//                        print_r($data);
//                         die;
                                $this->sendmail($full_name,$email,$passgenerate,$verificationCode);
                                $this->Model_Apply->AddSignup($data);                          
                         }                        
                }
                                
		$this->load->view('vSignUp',$this->data);
	}
                        
    function sendmail($full_name,$email,$passgenerate,$verificationCode)  
            {                   
                $email_msg = "Selamat bergabung $full_name,  
				<p-->  
				Silahkan ikuti tautan berikut untuk ativasi  anda.<p></p>";  
                                $email_msg .= base_url()."/ApplyOnline/verify/" .$verificationCode; 
                                $email_msg .='Email :' .$email; 
                                $email_msg .='Password :'.$passgenerate ; 
                                $email_msg .= "<p>Thanks,  
				Panitia</p>";  
                $subject = "Email Verification";  
                $this->load->library('email');  
                $config['charset'] = 'iso-8859-1';  
                $config['wordwrap'] = TRUE;  
                $config['mailtype'] = 'html';  
                $this->email->initialize($config);  
                $this->email->from(MAIL_SENDER, 'Support Team');  
                $this->email->to($email);  
                $this->email->subject($subject);  
                $this->email->message($email_msg);  
                $this->email->send();  
                  
                // Insert user record     
                  
            } 
        
             function verify($verificationText=NULL) {  			
                $noOfRecords = $this->Model_Apply->verifyEmailAddress($verificationText);
//                echo $noOfRecords;
//                die;
                if ($noOfRecords > 0) {  
                    
                    $hasil = $this->Model_Apply->getByVerify($verificationText);	

                            if (!empty($hasil)){
                               // echo "<meta http-equiv='refresh' content='0; url=".BASE_URL."/Mylsaf'>";
                                 $this->session->set_flashdata('success', "Email verifikasi sukses! silahkan Login dan test online."); 
                                    redirect(BASE_URL.'/Mylsaf');
                            }
                              else {
                                  die;
                              }                  
				
						
                        } else {  
                            $this->session->set_flashdata('error', "Email verifkasi anda sudah pernah dilakukan, silahkan lewati halaman ini jika tidak ingin mendaftar");  
                             //echo "<meta http-equiv='refresh' content='0; url=".base_url()."/ApplyOnline'>"; 
                             redirect(BASE_URL.'/ApplyOnline');
                        }  
            }
        
            
}