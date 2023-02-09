<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require APPPATH.'libraries/phpmailer/class.phpmailer.php';

class Phpmailer_lib {
    private $respond = array();
	
	public function __construct()
	{
		$this->CI = & get_instance();
	}
	
	public function send_smtp($to, $subject, $message, $fromname, $pathfile = null){
		$respond['status'] = 1;
		$respond['err'] = "";
		
		$mail = new PHPMailer();
		$mail->IsSMTP();  
		$mail->Host     = EMAIL_HOST; 
		$mail->Port		= EMAIL_PORT;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = EMAIL_USERNAME;
		$mail->Password = EMAIL_PASSWORD;
		$mail->From     = EMAIL_USERNAME;
		$mail->FromName = $fromname;
		
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject  = $subject;
		$mail->Body		= $message;
		if(!empty($pathfile)){
			$mail->AddAttachment($pathfile);   
		}
		if(!$mail->Send()) {
		  $respond['status'] = 0;
		  $respond['err'] = $mail->ErrorInfo;
		} 
		
		unset($mail);
		
		return $respond;
	}
}
?>
