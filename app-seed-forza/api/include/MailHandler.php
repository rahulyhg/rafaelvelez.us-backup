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
        $headers = "From:" . $from;
        $full_url=BASE_URL . $id;
        $message = strtr (PW_RESET_BODY, array ('{{res_link}}' => $full_url));
        $resp = mail($to, $subject, $message, $headers);
        return $resp;
    }

    
}

?>

