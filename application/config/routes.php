<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'my_404';
$route['translate_uri_dashes'] = FALSE;

$route['backend'] = "backend/signin/login";
$route['backend/signin'] = "backend/signin/login";
$route['backend/cekLogin'] = "backend/signin/cekLogin";
$route['backend/signout'] = "backend/signin/signout";
$route['backend/changePassword'] = "backend/home/changePassword";
$route['backend/doChangePassword'] = "backend/home/doChangePassword";


$pathPageAlias = PATH_ASSETS."/json/pages.json";
$arr_page_alias = json_decode(file_get_contents($pathPageAlias),TRUE);
foreach($arr_page_alias as $k => $page) {
	$route[$page['web_alias']] = "pages/detail/".$page['pages_id'];
}

define('EXT', '.php');
require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get_where( 'tbl_module',array('module_group_id' => 8));
$result = $query->result();

foreach( $result as $row )
{
  $route[''.$row->module_path.''] = "content";
  $route[''.$row->module_path.'/(:num)/(:any)'] = "content/index/$1/$2";
  $route[''.$row->module_path.'/(:num)/(:num)/(:any)'] = "content/index/$1/$2/$3";
  $route[''.$row->module_path.'/(:num)/(:num)/(:num)/(:any)'] = "content/index/$1/$2/$3/$4";
  $route['backend/'.$row->module_path] = "backend/Content";
  $route['backend/'.$row->module_path.'/(:any)'] = "backend/Content/$1";
  $route['backend/'.$row->module_path.'/(:any)/(:num)'] = "backend/Content/$1/$2";
  $route['backend/'.$row->module_path.'/(:num)/(:num)/(:any)'] = "backend/Content/index/$1/$2/$3";
  $route['backend/'.$row->module_path.'/(:num)/(:num)/(:num)/(:any)'] = "backend/Content/index/$1/$2/$3/$4";
}
$route['backend/Accordion/(:num)'] = "backend/Accordion/index/$1";
 $route['backend/Accordion/(:any)'] = "backend/Accordion/$1";

$route['Class_schedule/(:num)/(:num)'] = "Class_schedule/index/$1/$2";
$route['Video_lectures/(:any)'] = "Video_lectures/index/$1";
$route['Module_lectures/(:any)'] = "Module_lectures/index/$1";
$route['Skype_lectures/(:any)'] = "Skype_lectures/index/$1";
$route['Privacy_Policy'] = "Pages";
$route['Terms_Condition'] = "Pages";
$route['ApplyOnline/verify/(:any)'] = "ApplyOnline/verify/$1";
 



//require_once(PATH."config/alias_routes.php");	
