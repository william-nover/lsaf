<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// website
define('PROJECT_NAME', 'LSAF');
define('PROJECT_LOGO', 'logo.gif');

// web
$view_path_web = str_replace('\\','/',realpath($application_folder).'/views/web/');
define('VIEWS_PATH_WEB', $view_path_web);
//define('TWITTER_ID', "tukarpoin");
//define('FACEBOOK_ID', "tukarpoin");
//define('KEY', "tuk4rp01n");
define("EXPIRED_COOKIE", 604800); //604800 : 7 day
/*
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['base_url'] = "https://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])); 
define('BASE_URL', $config['base_url']);
*/



// $config['base_url'] ="https://www.lsafglobal.com";
$config['base_url'] ="https://www.localhost/lsaf";
define('BASE_URL', $config['base_url']);
// define('BASE_URL', "https://www.localhost/lsaf");

define('JS_BASE_URL', BASE_URL.'/assets/js');
define('CSS_BASE_URL', BASE_URL.'/assets/css');
define('SLICK_BASE_URL', BASE_URL.'/assets/slick');
define('TOOLS_BASE_URL', BASE_URL.'/assets/tools');
define('IMAGES_BASE_URL', BASE_URL.'/assets/images');
define('IMG_BASE_URL', BASE_URL.'/assets/img');
define('CAPCTHA_BASE_URL', BASE_URL.'/assets/capctha/');
define('PDF_BASE_URL', BASE_URL.'/assets/pdf/');

// backend
define('PATH', str_replace('\\','/',realpath($application_folder).'/'));
// define('PATH_PROJECT', '/home/lsafglob/public_html');
define('PATH_PROJECT', 'C:/XAMPP/htdocs/lsaf');

define('PATH_ASSETS', PATH_PROJECT.'/assets');
define('BASE_URL_BACKEND', BASE_URL.'/backend');
$view_path_backend = str_replace('\\','/',realpath($application_folder).'/views/backend/');
define('VIEWS_PATH_BACKEND', $view_path_backend);
$view_path_frontend = str_replace('\\','/',realpath($application_folder).'/views/');
define('VIEWS_PATH_FRONTEND', $view_path_frontend);

define('PER_PAGE', 10);

define('MAIL_SENDER', "info@lsafglobal.com");