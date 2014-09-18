<?php

require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require_once '../include/MailHandler.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        $db = new DbHandler();

        // get the api key
        $api_key = $headers['Authorization'];
        // validating api key
        if (!$db->isValidApiKey($api_key)) {
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key";
            echoRespnse(401, $response);
            $app->stop();
        } else {
            global $user_id;
            // get user primary key id
            $user_id = $db->getUserId($api_key);
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
 */
/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/signup', function() use ($app) {
            // check for required params
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $email = $request_params['email'];
            $password = $request_params['password'];
            $name = $request_params['name'];
    
            verifyRequiredParams(array('name', 'email', 'password'));
            $response = array();

            validateEmail($email);

            $db = new DbHandler();
            $res = $db->createUser($name, $email, $password);
            if ($res == USER_CREATED_SUCCESSFULLY) {
                $em = new MailHandler();
                $user = $db->getUserByEmail($email);
                $random_str=sha1($user['name'] . date('Y-m-d H:i:s') . $user['id']);
                if (($db-> newAccountRequest($random_str,$user['id'])) && 
                        ($em->send_account_act_email($user['email'], $random_str)))
                {
                    $response['error'] = false;
                    $response['type'] = 'success'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response['URL'] = BASE_URL . "/#/activate_account/" . $random_str;
                    $response["message"] = "You are successfully registered, we sent a confirmation email with instructions to activate your account";
                }
                else {
                    $response['error'] = true;
                    $response['type'] = 'danger'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response["message"] = "Oops! An error occurred while registering";
                }
            } else if ($res == USER_CREATE_FAILED) {
                $response['error'] = true;
                $response['type'] = 'danger'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response["message"] = "Oops! An error occurred while registering";
            } else if ($res == USER_ALREADY_EXISTED) {
                $response['error'] = true;
                $response['type'] = 'warning'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response["message"] = "Sorry, this email already existed";
            }
            // echo json response
            echoRespnse(201, $response);
        });

/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('email', 'password'));
            
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $email = $request_params['email'];
            $password = $request_params['password'];
            $response = array();

            $db = new DbHandler();
            // check for correct email and password
            if ($db->checkLogin($email, $password)) {
                // get the user by email
                $user = $db->getUserByEmail($email);
				
                if ($user != NULL) {
                    
                    session_start();
                    $_SESSION['uid']=uniqid('ang_');
                    $response['session'] = $_SESSION['uid'];
                    $response['error'] = false;
                    $response['type'] = 'success'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response['name'] = $user['name'];
                    $response['email'] = $user['email'];
                    $response['apiKey'] = $user['api_key'];
                    $response['createdAt'] = $user['created_at'];
                    $response['message'] = "Login Successfull";
                } else {
                    // unknown error occurred
                    $response['error'] = true;
                    $response['type'] = 'danger'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response['message'] = "An error occurred. Please try again";
                }
            } else {
                // user credentials are wrong
                $response['error'] = true;
                $response['type'] = 'warning'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['message'] = 'Login failed. Incorrect credentials';
            }

            echoRespnse(200, $response);
        });
        
$app->post('/forgot_pw', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('email'));
                        
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $email = $request_params['email'];
            $response = array();

            $db = new DbHandler();
            $em = new MailHandler();
            // get the user by email
            $user = $db->getUserByEmail($email);
				
            if ($user != NULL) {
                //Everything is looking good, lets create the email and update the database
                $random_str=sha1($user['name'] . date('Y-m-d H:i:s') . $user['id']);
                if (($db->pwResetPreparation($random_str,$user['id']))&&
                        ($em->send_pw_reset_email($user['email'], $random_str))){
                    $response['error'] = false;
                    $response['type'] = 'success'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response['name'] = $user['name'];
                    $response['email'] = $user['email'];
                    $response['apiKey'] = $user['api_key'];
                    $full_url=BASE_URL . $random_str;
                    $response['URL'] = BASE_URL . "/#/reset_pw/" .$random_str;
                    $response['message'] = "User found, an email with instructions on how to reset your password will be sent soon.";
                }
                else {
                    $response['error'] = true;
                    $response['type'] = 'danger'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                    $response['name'] = $user['name'];
                    $response['email'] = $user['email'];
                    $response['apiKey'] = $user['api_key'];
                    $response['message'] = "There was an error during the process, please contact support.";
                    
                }
            } else {
                // unknown error occurred
                $response['error'] = true;
                $response['type'] = 'warning'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['message'] = "User not found, please contact support.";
            }
            echoRespnse(200, $response);
        });
        
        
/**
 * Check Session
 * url - /check_session
 * method - POST
 */
$app->post('/check_session', function() use ($app) {
            session_start();
            if( isset($_SESSION['uid']) ) {
                $response['error'] = false;
                $response['type'] = 'success'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['message']='authentified';
            }
            else {
                $response['error'] = true;
                $response['type'] = 'danger'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['message'] = 'Login failed. Incorrect credentials';
            }
            echoRespnse(200, $response);
            
            
        });
        
/**
 * Check Password Request
 * url - /check_session
 * method - POST
 */
$app->post('/check_pw_request', function() use ($app) {
            
     // check for required params
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $reset_code = $request_params['reset_code'];
            verifyRequiredParams(array('reset_code'));
            $response = array();
            $db = new DbHandler();
            if ($db->checkResetCode($reset_code)) {
                //Everything is looking good, lets create the email and update the database
                $response['error'] = false;
                $response['type'] = 'success';
                $response['message'] = "Reset Password request found, please provide the new password below.";
            }
            else {
                $response['error'] = true;
                $response['type'] = 'warning';
                $response['message'] = "We cannot find your request, please contact support.";
                    
            }
            echoRespnse(200, $response);
            
            
        });
        
/**
 * Check Password Request
 * url - /check_session
 * method - POST
 */
$app->post('/activate_account', function() use ($app) {
            
     // check for required params
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $activation_code = $request_params['activation_code'];
            verifyRequiredParams(array('activation_code'));
            $response = array();
            $db = new DbHandler();
            if ($db->checkVerifyCode($activation_code)) {
                //Everything is looking good, lets create the email and update the database
                if ($db->activateAccount($activation_code)){
                    $response['error'] = false;
                    $response['type'] = 'success';
                    $response['message'] = "Your account is been activated, please login <a href=\"#/login\">here</a>";
                }
                else {
                    $response['error'] = true;
                    $response['type'] = 'warning';
                    $response['message'] = "We cannot activate your account, please contact support.";
                }
            }
            else {
                $response['error'] = true;
                $response['type'] = 'warning';
                $response['message'] = "We cannot find your request, please contact support.";
                    
            }
            echoRespnse(200, $response);
            
            
        }); 
        
       
        /**
 * User Registration
 * url - /change_pw
 * method - POST
 * params - name, email, password
 */
$app->post('/change_pw', function() use ($app) {
            // check for required params
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $reset_code = $request_params['reset_code'];
            $password = $request_params['password'];
                
            verifyRequiredParams(array('reset_code', 'password'));
            $response = array();
            $db = new DbHandler();
                       
            if ($db->changePassword($reset_code,$password)) {
                //Everything is looking good, lets create the email and update the database
                $response['error'] = false;
                $response['type'] = 'success';
                $response['message'] = "Reset Password request found, please provide the new password below.";
                $db->deleteResetRequest($reset_code);
            }
            else {
                $response['error'] = true;
                $response['type'] = 'warning';
                $response['message'] = "We cannot find your request, please contact support.";
                    
            }
            
            
            
            echoRespnse(200, $response);
        });
/**
 * User Logout
 * url - /logout
 * method - POST
 * params - none
 */
$app->post('/logout', function() use ($app) {
            session_id('uid');
            session_start();
            session_destroy();
            session_commit();
            $response['error']=false;
            //types are always bind to alerts: ["info", "warning", "danger", "success"]; 
            $response['type']='success';
            $response['message'] = 'Logout successfully';
            echoRespnse(200, $response);
        });

      
/**
 * Check Session
 * url - /check_session
 * method - POST
 */
$app->post('/reset_pw', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('email'));
            
            $app = \Slim\Slim::getInstance();
            $request_params =  json_decode($app->request()->getBody(),true);
            // reading post params
            $email = $request_params['email'];
            $response = array();

            $db = new DbHandler();
            // get the user by email
            $user = $db->getUserByEmail($email);
				
            if ($user != NULL) {
                $response['error'] = false;
                $response['type'] = 'success'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['name'] = $user['name'];
                $response['email'] = $user['email'];
                $response['apiKey'] = $user['api_key'];
                $response['message'] = "User found, an email with instructions on how to reset your password will be sent soon.";
            } else {
                // unknown error occurred
                $response['error'] = true;
                $response['type'] = 'warning'; //types are always bind to alerts: ["info", "warning", "danger", "success"];
                $response['message'] = "User not found, please contact support.";
            }
            echoRespnse(200, $response);
            echoRespnse(201, $response);
            
            
        });    
        
/*
 * ------------------------ METHODS WITH AUTHENTICATION ------------------------
 */

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    //$request_params = array();
    //$request_params = $_REQUEST;
    $app = \Slim\Slim::getInstance();
    $request_params =  json_decode($app->request()->getBody(),true);
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
?>