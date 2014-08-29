<?php

$loc='location: http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/modern";
echo $loc;
header( $loc ) ;

?>

