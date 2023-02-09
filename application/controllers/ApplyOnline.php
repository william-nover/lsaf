<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApplyOnline extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                date_default_timezone_set('UTC');
                $this->load->model(array('backend/Model_menu_frontend','web/Model_entry','web/Model_apply','backend/Model_logcms'));
				$this->load->helper(array('funcglobal','menu','accessprivilege','alias','email'));   
				$this->data['title'] =  $this->uri->segment(1);
				$this->data['metacontent']='London School of Accoutancy And Finance';
				$this->data['metadesc']='Student E_learning';
				$this->data['metaurl'] = current_url();				
                error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
                
        }
	
	public function index()
	{       
                include 'checkSession.php'; 
                      
		$this->load->view('vApplyOnline',$this->data);
	}
    
        public function Signup()
	{
		$this->data['title'] = "Signup";
		include 'checkSession.php'; 
                
                $this->data['Nationality'] = $this->Model_apply->getNationality();

          
                if ($_POST) {
                
                 $full_name = $this->security->xss_clean(secure_input($_POST['full_name'])); 
                 $email = $this->security->xss_clean(secure_input($_POST['email'])); 
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
                 
                $this->form_validation->set_rules('full_name', 'full_name', 'required');
                $this->form_validation->set_rules('phone1', 'phone1', 'required'); 
                $this->form_validation->set_rules('phone2', 'phone2', 'required');
                $this->form_validation->set_rules('addr1', 'addr1', 'required');
                $this->form_validation->set_rules('postal_code', 'postal_code', 'required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                 //$this->form_validation->set_rules('email', 'Email', 'callback_email_check');
                    if ($this->form_validation->run() == FALSE)
                    {
                     $this->data['emailExist']='';
                     $this->load->view('vSignUp',$this->data);
                    }
                     else
                        {    
                            $check_email = $this->Model_apply->checkEmail($email);
                            if (count($check_email->result_array())>0)
                         {
                                $this->data['emailExist']='Email Already registered';
                                $this->load->view('vSignUp',$this->data);
                                return false;
                                }
                                else{
                                   
                                   
                                    $verificationCode = random_string('alnum', 20);                             

                                     $signup_id =   $this->Model_apply->AddSignup($full_name,$email,$password,$dob,$address1,$address2,$postal_code,$phone,$country_id,$today,$verificationCode);
                                     $register_id = 'LSAF-'.date("y").$signup_id;                                          
                                     $this->Model_apply->setRegisterId($signup_id,$register_id);
                                     $this->sendmail($full_name,$register_id,$email,$passgenerate,$verificationCode,$dob,$address1,$address2,$postal_code,$phone);
                                     $this->sendmailAdmin($full_name,$email,$register_id,$dob,$address1,$address2,$postal_code,$phone);
                                     $this->load->view('vsuccessSignUp',$this->data);            
                                           
                                }
                                
                        }
                 
                         
                                       
                } else 
                    {
                     $this->load->view('vSignUp',$this->data);   
                }
                             
		
	}
   
        
    function sendmail($full_name,$register_id,$email,$passgenerate,$verificationCode,$dob,$address1,$address2,$postal_code,$phone)  
            {    
               
        
                $subject = "LSAF - Registration Confirmation ";
                $message_email = "Congratulations!!!!<br>"; 
                $message_email .= "Your registration was successful<br>";
               
                $message_email .= "Your Registration ID : ".$register_id."<br>";
                $message_email .= "Your signin account is<br>";
                $message_email .= "Email : ".$email."<br>";
                $message_email .= "Password : ".$passgenerate."<br>";
                $message_email .= "Please confirm your details below and click the following link <strong>on DESKTOP or NOTEBOOK / LAPTOP device  </strong>  to proceed to the entry test.. <br>";
                $message_email .= "<a href=".BASE_URL."/ApplyOnline/verify/" .$verificationCode.">";
                $message_email .= BASE_URL."/ApplyOnline/verify/" .$verificationCode; 
                $message_email .= "</a>";
				
                $message_email .= "Full name"  .$full_name."<br>"; 
                $message_email .= "Date of birth : ".$dob."<br>";
                $message_email .="Postal address :"  .$address1.'-'.$address2."<br>";
                $message_email .="Postal code :"  .$postal_code."<br>"; 
                $message_email .="Phone :"  .$phone."<br>"; 					



                $header = "";
                $header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  
                 
                mail($email, $subject, $message_email, $header);
                
                  
            } 
         function sendmailAdmin($full_name,$email,$register_id,$dob,$address1,$address2,$postal_code,$phone)  
            {    
               
        
                $subject = " New Applicant Notification ";
                $message_email = "New Register to LSAF : "  .$full_name."<br>";
                $message_email .= "Register ID : ".$register_id."<br>";
                $message_email .= "Email : ".$email."<br>";
				$message_email .= "Date of birth : ".$dob."<br>";
                $message_email .="Postal address :"  .$address1.'-'.$address2."<br>";
				$message_email .="Postal code :"  .$postal_code."<br>"; 
				$message_email .="Phone :"  .$phone."<br>"; 
				$message_email .= "Please click Link below to show detail<br>";
                $message_email .= "<a href=".BASE_URL_BACKEND."/ApplyOnline/".">";                
                $message_email .= "</a>";

                $header = "";
                $header .= "Reply-To: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Return-Path: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "From: lsafglobal.com <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
                $header .= "Organization: ".$_SERVER['SERVER_NAME']." \r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  
                // Insert user record     
                mail(MAIL_SENDER, $subject, $message_email, $header);
                
                  
            } 
            
			function verify($verificationText=NULL) {  			
                if(!empty($verificationText)){
					$rsGroup = $this->Model_entry->getGroup();
				
					if(count($rsGroup) > 0){
						echo $entryGroupId = $rsGroup[0]['entry_group_id'];
						
						//$noOfRecords = $this->Model_apply->verifyEmailAddress($verificationText);
						$noOfRecords = $this->Model_apply->verifyEmailAddress($verificationText,$entryGroupId);
						
						if ($noOfRecords > 0) {  
							
							$hasil = $this->Model_apply->getByVerify($verificationText);	
							
							if (!empty($hasil)){    
							 ?>
							<script type="text/javascript">
							alert("register has been success please login to LSAF..!!!");			
							</script>
							<?php
								redirect(BASE_URL.'/Mylsaf');
							}
							  else {
							?>
							<script type="text/javascript">
							alert("Your register already verified please login to LSAF!!!");			
							</script>
							<?php
								redirect(BASE_URL.'/Mylsaf');
							  }                  
				
						
						} else {  
						   ?>
							<script type="text/javascript">
							alert("Error verified login!!!");			
							</script>
							<?php  
							 redirect(BASE_URL.'/ApplyOnline');
						}  
					} else {
						// Group Test Not Found
						redirect(BASE_URL.'/ApplyOnline');
					}
				} else {
					// No Parameter
					redirect(BASE_URL.'/ApplyOnline');
				}
            }
}