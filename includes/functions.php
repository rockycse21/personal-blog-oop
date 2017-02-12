<?php
function strip_zero_from_date( $marked_string="" ) {
  //First remove the marked ziros
   $no_zeros = str_replace('*0', '', $marked_string);
   // then Remove any remaining marks
   $cleanded_string = str_replace('*', '', $no_zeros);
   return $cleanded_string;
}

function redirect_to ($location = NULL) {
  if($location != NULL ){
    header("Location: {$location}");
    exxit;
  }
}
/*
 * @output_message
 * @param
 * */
function output_message($message=""){
  if(!empty($message)){
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}
/*
 * auto object method
 * stand along function out side of the object
 * */
function __autoload($class_name){
  $class_name = strtolower($class_name);
  $path = SITE_ROOT.DS."{$class_name}.php";
  if(file_exists($path)){
    require_once($path);
  } else {
    die("the file {$class_name}.php could not be found.");
  }
}

function include_layout_template($template = ""){

  $dirName = dirname(dirname(__FILE__) . ".." . DIRECTORY_SEPARATOR);
// Full document root - E:/xampp/htdocs/adv_php
  $base_path = str_replace('\\', "/", $dirName);
// only root folder name - /adv_php
  $base = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dirName);
  include($base_path.DS.'public'.DS.'layouts'.DS.$template.'.php');

}
/*
* Creating a log file and give the log message
* Make sure file exit or else create a new file
*make file writeable or else output an error
*Append new emtry to the end of the file
*  Remember: SITE_ROOT and DS
* Consider how to handle new ine (Double quote matter)
* Use log_action() in admin/login.php
* Read the log from public/admin/logfile.php
* Locate logs logs/log.txt using SITE_ROOT and DS
*/
function log_action($action, $message=""){
$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
$new = file_exists($logfile) ? false : true;
if($handle = fopen($logfile,'a')) { //append
$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
$content = "{$timestamp} | {$action}: {$message} \n";
fwrite($handle, $content);
fclose($handle);
if($new) { chmod($logfile, 0755); }
} else {
  echo "could not open log file for writing.";
}
}
?>
