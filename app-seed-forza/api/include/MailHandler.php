<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class MailHandler {

    function __construct() {
        require_once dirname(__FILE__) . '/EmailTemplates.php';
        
    }

    /* ------------- `users` table method ------------------ */

    /**
     * Send an Email with Template
     * @param String $to Email to send message
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function send_pw_reset_email($to,$id) {
        $subject = PW_RESET_SUBJECT;
        $from = "rafael.velez.c@gmail.com";
        $headers = "From:" . $from . "\r\n";
        $headers .= "CC: rafael.velez.c@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $full_url= BASE_URL . "/#/reset_pw/" . $id;
        $message = strtr (PW_RESET_BODY, array ('{{res_link}}' => $full_url));
        $resp = mail($to, $subject, $message, $headers);
        return $resp;
    }
    
     /**
     * Send an Email with Template
     * @param String $to Email to send message
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function send_account_act_email($to,$id) {
        $subject = ACTIVATE_ACC_SUBJECT;
        $from = "rafael.velez.c@gmail.com";
        $headers = "From:" . $from . "\r\n";
        $headers .= "CC: rafael.velez.c@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $full_url= BASE_URL . "/#/activate_account/" . $id;
        $message = strtr (ACTIVATE_ACC_BODY, array ('{{res_link}}' => $full_url));
        $resp = mail($to, $subject, $message, $headers);
        return $resp;
    }

    
}

?>

