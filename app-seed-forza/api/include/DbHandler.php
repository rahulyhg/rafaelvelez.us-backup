<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /* ------------- `users` table method ------------------ */

    /**
     * Creating new user
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function createUser($name, $email, $password) {
        require_once 'PassHash.php';

        $response = array();

        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);

            // Generating API key
            $api_key = $this->generateApiKey();

            // insert query
            $stmt = $this->conn->prepare("INSERT INTO users(name, email, password_hash, api_key, user_status) values(?, ?, ?, ?, 0)");
            $stmt->bind_param("ssss", $name, $email, $password_hash, $api_key);

            $result = $stmt->execute();

            /* commit transaction */
            //$this->conn->commit();

            $stmt->close();
            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return USER_CREATED_SUCCESSFULLY;
            } else {
                // Failed to create user
                return USER_CREATE_FAILED;
            }
        } else {
            // User with same email already existed in the db
            return USER_ALREADY_EXISTED;
        }

        return $response;
    }

    /**
     * Checking user login
     * @param String $email User login email id
     * @param String $password User login password
     * @return boolean User login status success/fail
     */
    public function checkLogin($email, $password) {
        // fetching user by email
        $stmt = $this->conn->prepare("SELECT password_hash FROM users WHERE email = ? AND user_status = 1");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->bind_result($password_hash);

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Found user with the email
            // Now verify the password

            $stmt->fetch();

            $stmt->close();

            if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            $stmt->close();

            // user not existed with the email
            return FALSE;
        }
    }

    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
    private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT id from users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT id,name, email, api_key, avatar, user_status, created_at FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            /* store result */
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                // $user = $stmt->get_result()->fetch_assoc();
                $stmt->bind_result($id, $name, $email, $api_key, $avatar, $status, $created_at);
                $stmt->fetch();
                $user = array();
                $user['id'] = $id;
                $user['name'] = $name;
                $user['email'] = $email;
                $user['api_key'] = $api_key;
                $user['avatar'] = $avatar;
                $user['user_status'] = $status;
                $user['created_at'] = $created_at;
                $stmt->close();
                return $user;
            }
        }
        return NULL;
    }

    /**
     * Fetching user api key
     * @param String $user_id user id primary key in user table
     */
    public function getApiKeyById($user_id) {
        $stmt = $this->conn->prepare("SELECT api_key FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            // $api_key = $stmt->get_result()->fetch_assoc();
            $stmt->bind_result($api_key);
            $stmt->fetch();
            $stmt->close();
            return $api_key;
        } else {
            return NULL;
        }
    }

    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function getUserId($api_key) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        if ($stmt->execute()) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            // TODO
            // $user_id = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }

    /**
     * Validating user api key
     * If the api key is there in db, it is a valid key
     * @param String $api_key user api key
     * @return boolean
     */
    public function isValidApiKey($api_key) {
        $stmt = $this->conn->prepare("SELECT id from users WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Add a request to password reset
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function pwResetPreparation($uniq_hash, $user_id) {
        $response = array();

        // First check if user exists in db
        if ($this->getApiKeyById($user_id)) {

            // insert query
            $stmt = $this->conn->prepare("INSERT INTO reset_pw(user_id, uniq_hash) values(?, ?) ON DUPLICATE KEY UPDATE uniq_hash=?");
            $stmt->bind_param("iss", $user_id, $uniq_hash, $uniq_hash);

            $result = $stmt->execute();

            $stmt->close();

            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return true;
            } else {
                // Failed to create user
                return false;
            }
        } else {
            // User with same email already existed in the db
            return false;
        }

        return $response;
    }

    /**
     * Add a request to password reset
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function newAccountRequest($uniq_hash, $user_id) {
        $response = array();

        // First check if user exists in db
        if ($this->getApiKeyById($user_id)) {

            // insert query
            $stmt = $this->conn->prepare("INSERT INTO activate_user(user_id, uniq_hash) values(?, ?) ON DUPLICATE KEY UPDATE uniq_hash=?");
            $stmt->bind_param("iss", $user_id, $uniq_hash, $uniq_hash);

            $result = $stmt->execute();

            $stmt->close();

            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return true;
            } else {
                // Failed to create user
                return false;
            }
        } else {
            // User with same email already existed in the db
            return false;
        }

        return $response;
    }

    /**
     * Add a request to password reset
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function checkResetCode($res_code) {
        $stmt = $this->conn->prepare("SELECT user_id from reset_pw WHERE uniq_hash = ?");
        $stmt->bind_param("s", $res_code);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Add a request to password reset
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function checkVerifyCode($act_code) {
        $stmt = $this->conn->prepare("SELECT user_id from activate_user WHERE uniq_hash = ?");
        $stmt->bind_param("s", $act_code);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserIdFromResetCode($reset_code) {
        $stmt = $this->conn->prepare("SELECT user_id FROM reset_pw WHERE uniq_hash = ?");
        $stmt->bind_param("s", $reset_code);
        if ($stmt->execute()) {
            /* store result */
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                // $user = $stmt->get_result()->fetch_assoc();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
        return NULL;
    }

    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserIdFromActivationCode($reset_code) {
        $stmt = $this->conn->prepare("SELECT user_id FROM activate_user WHERE uniq_hash = ?");
        $stmt->bind_param("s", $reset_code);
        if ($stmt->execute()) {
            /* store result */
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                // $user = $stmt->get_result()->fetch_assoc();
                $stmt-> bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
        return NULL;
    }

    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function changePassword($reset_code, $password) {
        require_once 'PassHash.php';
        $user_id = $this->getUserIdFromResetCode($reset_code);
        if ($user_id) {
            $password_hash = PassHash::hash($password);
            // insert query
            $stmt = $this->conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
            $stmt->bind_param("si", $password_hash, $user_id);
            $result = $stmt->execute();
            $stmt->close();
            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return true;
            } else {
                // Failed to create user
                return false;
            }
        }
        return false;
    }

    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function activateAccount($act_code) {

        $user_id = $this->getUserIdFromActivationCode($act_code);
        if ($user_id) {

            // insert query
            $stmt = $this->conn->prepare("UPDATE users SET user_status = 1 WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $result = $stmt->execute();

            $stmt->close();
            // Check for successful insertion
            if ($result) {
                // User successfully inserted, delete record
                if (!$this->deleteVerifyRequest($act_code))
                    return false;
                return true;
            } else {
                // Failed to create user
                return false;
            }
        }
        return false;
    }

    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function deleteResetRequest($reset_code) {
        // insert query
        $stmt = $this->conn->prepare("DELETE FROM reset_pw WHERE uniq_hash = ?");
        $stmt->bind_param("s", $reset_code);
        $result = $stmt->execute();
        $stmt->close();
        // Check for successful insertion
        if ($result) {
            // User successfully inserted
            return true;
        } else {
            // Failed to create user
            return false;
        }
    }

    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function deleteVerifyRequest($reset_code) {
        // insert query
        $stmt = $this->conn->prepare("DELETE FROM activate_user WHERE uniq_hash = ?");
        $stmt->bind_param("s", $reset_code);
        $result = $stmt->execute();
        $stmt->close();
        // Check for successful insertion
        if ($result) {
            // User successfully inserted
            return true;
        } else {
            // Failed to create user
            return false;
        }
    }

    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT id,name, email, api_key, user_status, created_at FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            /* store result */
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                // $user = $stmt->get_result()->fetch_assoc();
                $stmt->bind_result($id, $name, $email, $api_key, $status, $created_at);
                $stmt->fetch();
                $user = array();
                $user['id'] = $id;
                $user['name'] = $name;
                $user['email'] = $email;
                $user['api_key'] = $api_key;
                $user['user_status'] = $status;
                $user['created_at'] = $created_at;
                $stmt->close();
                return $user;
            }
        }
        return NULL;
    }

    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

}

?>
