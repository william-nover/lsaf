<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
                session_start();date_default_timezone_set('UTC');
                $this->load->model(array('backend/Model_menu_frontend', 'backend/Model_language','backend/Model_logcms'));
		$this->load->helper(array('funcglobal','menu','accessprivilege','alias'));
	}
	
	public function index()
	{
		$this->data['title'] = "London School of Accountancy  And Finance";
		include 'checkSession.php'; 
                //Banner Home
		 $pathBannerHome = PATH_ASSETS."/json/bannerhome.json";
                 $arrBannerHome = json_decode(file_get_contents($pathBannerHome),TRUE);
//		echo'<pre>';
//                 print_r($arrBannerHome);
//                 die;
		$arrBannerHomeNew = array();
		if(count($arrBannerHome) > 0){
			$keyArr = searchmanyarray(1, 'banner_type', $arrBannerHome,'banner_id');

			if(count($keyArr) > 0){
				foreach($keyArr as $key => $val){
                                  
					array_push($arrBannerHomeNew,$arrBannerHome[$val]);
				}
			}	
		}
                if(count($arrBannerHome) > 0){
			$keyArrMidle = searchmanyarray(2, 'banner_type', $arrBannerHome,'banner_id');

			if(count($keyArrMidle) > 0){
				foreach($keyArrMidle as $key => $val){
                                  
					array_push($arrBannerHomeNew,$arrBannerHome[$val]);
				}
			}	
		}

		 $this->data['dataBannerHome'] = $arrBannerHomeNew;
		 $this->data['countBannerHome'] = count($arrBannerHomeNew);
		 
		 $this->data['metacontent']='Your Keys to Global Careers';
		 $this->data['metaurl'] = current_url();
		$this->load->view('vhome',$this->data);
	}
}