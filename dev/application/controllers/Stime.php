<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stime extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$now = new DateTime(); 
		//echo $now->format("M j, Y H:i:s O")."\n";	
		echo $now->format("M j, Y H:i:s");	
	}
}