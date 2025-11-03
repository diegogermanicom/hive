<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
     */

    class AdminModel extends Model {

        function __construct() {
            parent::__construct();
            if(HAS_DDBB == false) {
                Utils::error('If you want to use the administrator you have to activate the access to the database.', 503);
            }
        }

        /**
         * @return string
         */
        public function setTitle($title) {
            return $title.' | Hive Admin';
        }

        public function security_admin_logout() {
            // I make sure that the admin user is logged out
            if(isset($_SESSION['admin']['id_admin'])) {
                if(METHOD == 'get') {
                    header('Location: '.ADMIN_PATH.'/home');
                    exit;
                } else {
                    Utils::error('You do not have permissions to perform this action.', 403);
                }
            }
        }

        public function security_admin_login() {
            // I make sure that the admin user is logged in
            if(!(isset($_SESSION['admin']['id_admin']))) {
                if(METHOD == 'get') {
                    header('Location: '.ADMIN_PATH.'/login');
                    exit;
                } else {
                    Utils::error('You do not have permissions to perform this action.', 403);
                }                
            }
        }

        /**
         * @return array
         */
        public function login($email, $pass, $remember = 0) {
            // Pass must come in md5
            $sql = 'SELECT * FROM users_admin WHERE email = ? AND pass = ? LIMIT 1';
            $result = $this->query($sql, array($email, $pass));
            if($result->num_rows == 0) {
                return array(
                    'response' => 'error',
                    'message' => LANGTXT['error-login-admin']
                );
            }
            $row = $result->fetch_assoc();
            if($row['id_state'] == 2) {
                $sql = 'UPDATE users_admin SET last_access = NOW(), ip_last_access = ? WHERE id_admin = ? LIMIT 1';
                $this->query($sql, array($this->getIp(), $row['id_admin']));
                $_SESSION['admin'] = [];
                $_SESSION['admin']['id_admin'] = $row['id_admin'];
                $_SESSION['admin']['email'] = $row['email'];
                $_SESSION['admin']['name'] = $row['name'];
                $_SESSION['admin']['type'] = $row['id_admin_type'];
                // If the user still does not have a remember code, I will create one for him
                if($row["remember_code"] == '') {
                    $row["remember_code"] = uniqid();
                    $sql = 'UPDATE users_admin SET remember_code = ? WHERE id_admin = ? LIMIT 1';
                    $this->query($sql, array($row["remember_code"], $row['id_admin']));
                }
                if($remember == 1) {
                    Utils::initCookie('admin_remember', $row["remember_code"], Utils::ONEMONTH);
                }
                return array(
                    'response' => 'ok'
                );
            } else {
                return array(
                    'response' => 'error',
                    'message' => LANGTXT['user-admin-fail']
                );                    
            }
        }

    }

?>