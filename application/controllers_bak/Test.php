<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
                
        }
	
	 function index()
	{
             print_r($this->session->userdata()); 
		
	}
                    
        
}