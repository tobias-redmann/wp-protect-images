<?php
define('WP_USE_THEMES', false);

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

if (is_user_logged_in()) {
  
  $filename = $_GET['f'];
  
  
  if (file_exists($_SERVER['DOCUMENT_ROOT']. '/wp-content/uploads/'.$filename)) {
    
    // FIXME: Need a function to get several mime type
    
    $size = getimagesize($_SERVER['DOCUMENT_ROOT']. '/wp-content/uploads/'. $file);
    
    header('Content-Type: '.$size['mime']);
    
    readfile($_SERVER['DOCUMENT_ROOT']. '/wp-content/uploads/'.$filename);
    
    exit();
    
  }
  
 
} else {
  
  header("Content-type: image/jpeg");
  readfile('login.jpg');
  exit(0);
  
}


?>
