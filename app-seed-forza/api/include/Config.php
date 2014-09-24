<?php
/**
 * Database configuration
 */

//Not the most elegant solution, but works for development
$HOST = $_SERVER['SERVER_NAME'];
if (preg_match("/\blocalhost\b/i", $HOST)) {
    define('BASE_URL','http://localhost/rafaelvelez.us/app-seed-forza');
} else {
    define('BASE_URL','http://rafaelvelez.us/app-seed-forza');
}

//Database Settings
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Pl4t1num');
define('DB_HOST', 'localhost');
define('DB_NAME', 'my_tracker');

define('USER_CREATED_SUCCESSFULLY', 0);
define('USER_CREATE_FAILED', 1);
define('USER_ALREADY_EXISTED', 2);
define('PW_RESET_REQUEST_CREATED_SUCCESSFULLY',3);
define('PW_RESET_REQUEST_CREATE_FAILED',4);
define('PW_RESET_REQUEST_USER_NOT_EXIST',5);

//Email Settings
define('MAIL_SERVER','smtp.gmail.com');                 // Specify main and backup SMTP servers
define('MAIL_USER','rafael.velez.c@gmail.com');         // SMTP username
define('MAIL_PASSWORD','J4c0b3c0');                     // SMTP password
define('MAIL_SECURITY','tls');                          // Enable TLS encryption, `ssl` also accepted
define('MAIL_PORT',587);                                // TCP port to connect to
define('MAIL_FROM' , 'rafael.velez.c@gmail.com');
define('MAIL_FROM_NAME','Rafael Velez');


?>
