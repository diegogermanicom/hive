<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */   

    class AdminModel extends Model {

        function __construct() {
            parent::__construct();
            if(HAS_DDBB == false) {
                Utils::error('If you want to use the administrator you have to activate the access to the database.');
            }
        }

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
                    return json_encode(array(
                        'response' => 'error',
                        'mensaje' => 'You do not have permissions to perform this action.'
                    ));
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
                    return json_encode(array(
                        'response' => 'error',
                        'mensaje' => 'You do not have permissions to perform this action.'
                    ));
                }                
            }
        }

        public function login($email, $pass, $remember = 0) {
            // Pass must come in md5
            $sql = 'SELECT * FROM '.DDBB_PREFIX.'users_admin WHERE email = ? AND pass = ? LIMIT 1';
            $result = $this->query($sql, array($email, $pass));
            if($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                if($row['id_state'] == 2) {
                    $sql = 'UPDATE '.DDBB_PREFIX.'users_admin SET last_access = NOW(), ip_last_access = ? WHERE id_admin = ? LIMIT 1';
                    $this->query($sql, array($this->get_ip(), $row['id_admin']));
                    $_SESSION['admin'] = [];
                    $_SESSION['admin']['id_admin'] = $row['id_admin'];
                    $_SESSION['admin']['email'] = $row['email'];
                    $_SESSION['admin']['name'] = $row['name'];
                    $_SESSION['admin']['type'] = $row['id_admin_type'];
                    // If the user still does not have a remember code, I will create one for him
                    if($row["remember_code"] == '') {
                        $row["remember_code"] = uniqid();
                        $sql = 'UPDATE '.DDBB_PREFIX.'users_admin SET remember_code = ? WHERE id_admin = ? LIMIT 1';
                        $this->query($sql, array($row["remember_code"], $row['id_admin']));
                    }
                    if($remember == 1) {
                        setcookie("admin_remember", $row["remember_code"], time() + (60 * 60 * 24 * 7), PUBLIC_PATH.'/'); // 7 dias
                    }
                    return array('response' => 'ok');                    
                } else {
                    return array(
                        'response' => 'error',
                        'mensaje' => LANGTXT['user-admin-fail']
                    );                    
                }
            } else {
                return array(
                    'response' => 'error',
                    'mensaje' => LANGTXT['error-login-admin']
                );
            }
        }

    }

?>