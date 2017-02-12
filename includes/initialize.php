<?php
//define the core path
//define theme as absolute path to make sure that require_once work as expected
//DIRECTORY_SEPARATOR is php pre-defined constant
// (\ for windows / for unix)
/*die(dirname(__FILE__));*/
//$current_file_path = dirname(__FILE__);
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'e'.DS.'xampp'.DS.'htdocs'.DS.'adv_php');
defined('SITE_ROOT') ? null : define('SITE_ROOT',dirname(__FILE__));
//defined(LIB_PATH) ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
//LOAD CONFIG FILE
require_once(SITE_ROOT.DS.'config.php');
//load basic function next so that everything after can use them
require_once(SITE_ROOT.DS.'functions.php');
//load core object
require_once(SITE_ROOT.DS.'session.php');
require_once(SITE_ROOT.DS.'database.php');
//load database related
require_once(SITE_ROOT.DS.'user.php');
?>