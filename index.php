<?php

$pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER['PHP_SELF']);
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF']);
 }
 
$pageURL .="/modern/";
 
header( 'Location: '.$pageURL ) ;

?>

