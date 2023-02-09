<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $data = array();
	protected $user_data = array();
	protected $is_login = FALSE;
	
	public function __construct() {
		parent::__construct();
	
		//General
		$meta_title = "";
		$meta_description = "";
		$meta_keywords = "";
		$facebook_id = "";
		$twitter_id = "";
		$cs_phonenumber = "";
		$cs_email = "";
		
		$pathGeneral = PATH_ASSETS."/json/meta.json";
		$arrGeneral = json_decode(file_get_contents($pathGeneral),TRUE);
		
		if(count($arrGeneral)){
			$meta_title = $arrGeneral[0]['general_title'];
			$meta_description = $arrGeneral[0]['general_description'];
			$meta_keywords = $arrGeneral[0]['general_keyword'];
			$facebook_id = @$arrGeneral[0]['general_facebook'];
			$twitter_id = @$arrGeneral[0]['general_twitter'];
			$cs_phonenumber = @$arrGeneral[0]['general_cs_phonenumber'];
			$cs_email = @$arrGeneral[0]['general_cs_email'];
		}
		
		$this->data['meta_title'] = $meta_title;
		$this->data['meta_description'] = $meta_description;
		$this->data['meta_keywords'] = $meta_keywords;
		$this->data['facebook_id'] = $facebook_id;
		$this->data['twitter_id'] = $twitter_id;
		$this->data['cs_phonenumber'] = $cs_phonenumber;
		$this->data['cs_email'] = $cs_email;
		
		//Menu
		$pathMenu = PATH_ASSETS."/json/menu.json";
		$arrMenu = json_decode(file_get_contents($pathMenu),TRUE);
		
		$this->data['countdataMenu'] = count($arrMenu);
		$this->data['dataMenu'] = $arrMenu;
		
		
		//User Agent Detect Mobile
		$ismobile = FALSE;
		if ($this->agent->is_mobile()){
			$ismobile = TRUE;
		}
		$this->data['ismobile'] = $ismobile;
	}
}
?>