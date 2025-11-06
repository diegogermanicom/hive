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

    class AppModel extends Model {

        function __construct() {
            parent::__construct();
        }

        /**
         * @return string Return the full title
         */
        public function setTitle($title) {
            return $title.META_EXTRA_TITLE;
        }

        public function security_app_logout() {
            if(isset($_SESSION['user'])) {
                if(METHOD == 'get') {
                    Route::redirect('/');
                } else {
                    Utils::error('You do not have permissions to perform this action.', 403);
                }
            }
        }

        public function security_app_login() {
            if(!isset($_SESSION['user'])) {
                if(METHOD == 'get') {
                    Route::redirect('/');
                } else {
                    Utils::error('You do not have permissions to perform this action.', 403);
                }
            }
        }

        public function login($email, $pass, $remember = 0) {
            // Pass must come in md5
            $sql = 'SELECT * FROM users WHERE email = ? AND pass = ? LIMIT 1';
            $result = $this->query($sql, array($email, $pass));
            if($result->num_rows == 0) {
                return array(
                    'response' => 'error',
                    'message' => LANGTXT['error-login']
                );
            }
            $row = $result->fetch_assoc();
            if($row['id_state'] == 2) {
                $sql = 'UPDATE users SET last_access = NOW(), ip_last_access = ? WHERE id_user = ? LIMIT 1';
                $this->query($sql, array($this->getIp(), $row['id_user']));
                $_SESSION['user'] = [
                    'id_user' => $row['id_user'],
                    'email' => $row['email'],
                    'name' => $row['name']
                ];
                // If the user still does not have a remember code, I will create one for him
                if($row["remember_code"] == '') {
                    $row["remember_code"] = uniqid();
                    $sql = 'UPDATE users SET remember_code = ? WHERE id_user = ? LIMIT 1';
                    $this->query($sql, array($row["remember_code"], $row['id_user']));
                }
                if($remember == 1) {
                    Utils::initCookie('user_remember', $row["remember_code"], Utils::ONEMONTH);
                }
                return array(
                    'response' => 'ok',
                    'url' => Route::getAlias('/', array('login' => 'true'))
                );
            } else {
                return array(
                    'response' => 'error',
                    'message' => LANGTXT['user-fail']
                );                    
            }
        }

    }

?>