<?php
session_start();
define('PATH_TOOLS', '../../../assets/file_upload');
define('PATH', str_replace('\\','/',realpath($application_folder).'/'));
define('PATH_PROJECT', str_replace('/application/','',PATH));
define('PATH_ASSETS', PATH_PROJECT.'/assets');
//define('BASE_URL_TOOLS', 'http://lsaf.balkat.com');
define('BASE_URL_TOOLS', 'https://www.lsafglobal.com/blog');

?>