<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();
                $this->load->model(array('backend/Model_menu_frontend', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
	}
	
	public function index()
	{
		$this->data['title'] = "Home";
		include 'checkSession.php'; 
                //Banner Home
		 $pathBannerHome = PATH_ASSETS."/json/bannerhome.json";
                 $arrBannerHome = json_decode(file_get_contents($pathBannerHome),TRUE);
		
		$arrBannerHomeNew = array();
		if(count($arrBannerHome) > 0){
			$keyArr = searchmanyarray(1, 'banner_type', $arrBannerHome,'banner_id');

			if(count($keyArr) > 0){
				foreach($keyArr as $key => $val){
					array_push($arrBannerHomeNew,$arrBannerHome[$val]);
				}
			}	
		} 
		
		$this->data['dataBannerHome'] = $arrBannerHomeNew;
                $this->data['countBannerHome'] = count($arrBannerHomeNew);
		
		$this->load->view('vhome',$this->data);
	}
}