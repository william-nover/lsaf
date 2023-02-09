<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();		
	}	
	public function detail($id)
	{
		set_time_limit(0);
		ini_set("memory_limit",-1);
		
		$meta_title = "";
		$meta_description = "";
		$meta_keywords = "";		
		$pathPages = PATH_ASSETS."/json/pages.json";
		$arrPages = json_decode(file_get_contents($pathPages),TRUE);
		$countarrPages = count($arrPages);		
		if($countarrPages > 0){
			$id = $this->security->xss_clean(secure_input($id));
			$key = searcharray($id, 'pages_id', $arrPages);
			
			if(!empty($arrPages[$key]['pages_title'])){
				$meta_title = "";
				$meta_description = "";
				$meta_keywords = "";				
				$this->data['title'] = $arrPages[$key]['pages_title'];
				$this->data['meta_title'] = $arrPages[$key]['pages_title'];
				$this->data['meta_description'] = $arrPages[$key]['pages_meta_description'];
				$this->data['meta_keywords'] = $arrPages[$key]['pages_meta_keywords'];				
				$this->data['pages'] = $arrPages[$key];				
				//Left Menu About Us & Patners
				$arrPagesAboutUsNew = array();
				if($countarrPages > 0){
					$key = searcharray(1, 'pages_id', $arrPages);
					
					if(!empty($arrPages[$key]['pages_title'])){
						$arrPagesAboutUsNew = $arrPages[$key];
					}
				}
				$this->data['dataPagesAboutUS'] = $arrPagesAboutUsNew;
				$this->data['countPagesAboutUS'] = count($arrPagesAboutUsNew);				
				$arrPagesPatnersUsNew = array();
				if($countarrPages > 0){
					$key = searcharray(5, 'pages_id', $arrPages);
					
					if(!empty($arrPages[$key]['pages_title'])){
						$arrPagesPatnersUsNew = $arrPages[$key];
					}
				}

				$this->data['dataPagesPatnersUS'] = $arrPagesPatnersUsNew;
				$this->data['countPagesPatnersUS'] = count($arrPagesPatnersUsNew);

				$this->load->view('pages_detail',$this->data);
			} else {
				redirect(BASE_URL);
			}
		} else {
			redirect(BASE_URL);
		}
	}
}