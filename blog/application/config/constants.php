<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
// web
$view_path_web = str_replace('\\','/',realpath($application_folder).'/views/web/');
define('VIEWS_PATH_WEB', $view_path_web);

$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['base_url'] = "https://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])); 
define('BASE_URL', $config['base_url']);

define('PROJECT_NAME', BASE_URL);
define('PROJECT_LOGO', 'logo.gif');

define('SITE_KEY', '6Ldl-CETAAAAABv_lusri9iRnVmfMz3ZkNLxb3dY');
define('SECRET_KEY', '6Ldl-CETAAAAAJ4HQ3W6bRcqAgUdJ2G8vNKvrJT1');


define('FRONTEND_BASE_URL', BASE_URL.'/assets/frontend');
define('BACKEND_BASE_URL', BASE_URL.'/assets/backend');

define('SLICK_BASE_URL', BASE_URL.'/assets/slick');
define('TOOLS_BASE_URL', BASE_URL.'/assets/tools');
define('IMAGES_BASE_URL', BASE_URL.'/assets/images');
define('IMG_BASE_URL', BASE_URL.'/assets/img');
define('CAPCTHA_BASE_URL', BASE_URL.'/assets/capctha/');
define('PDF_BASE_URL', BASE_URL.'/assets/pdf/');

// backend

define('PATH', str_replace('\\','/',realpath($application_folder).'/'));

define('PATH_PROJECT', str_replace('/application/','',PATH));

//define('PATH_PROJECT', '/var/www/apps/www.beachrepublic.com/revisions/00000000-000000/public');

define('PATH_ASSETS', PATH_PROJECT.'/assets');
define('BASE_URL_BACKEND', BASE_URL.'/backend');
define('FILE_PATH_ASSETS', PATH_PROJECT.'/assets/file_upload/agent/');

$view_path_backend = str_replace('\\','/',realpath($application_folder).'/views/backend/');
define('VIEWS_PATH_BACKEND', $view_path_backend);
$view_path_frontend = str_replace('\\','/',realpath($application_folder).'/views/');
define('VIEWS_PATH_FRONTEND', $view_path_frontend);

define('PER_PAGE', 10);
define('MAIL_SUBS', 'hl.prbadolsa@gmail.com');
define('MAIL_CONT', 'hl.prbadolsa@gmail.com');
define('MAIL_CAT', 'hl.prbadolsa@gmail.com');
define('MAIL_NOREP', 'hl.prbadolsa@gmail.com');
