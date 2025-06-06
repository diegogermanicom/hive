<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */   

    class AppModel extends Model {

        function __construct() {
            parent::__construct();
        }

        public function setTitle($title) {
            return $title.META_EXTRA_TITLE;
        }

        public function security_app_logout() {
            if(isset($_SESSION['user'])) {
                if(METHOD == 'get') {
                    header('Location: '.PUBLIC_ROUTE.'/');
                    exit;
                } else {
                    return json_encode(array(
                        'response' => 'error',
                        'mensaje' => 'You do not have permissions to perform this action.'
                    ));
                }
            }
        }

        public function security_app_login() {
            if(!isset($_SESSION['user'])) {
                if(METHOD == 'get') {
                    header('Location: '.PUBLIC_ROUTE.'/');
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
            $sql = 'SELECT * FROM '.DDBB_PREFIX.'users WHERE email = ? AND pass = ? LIMIT 1';
            $result = $this->query($sql, array($email, $pass));
            if($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                if($row['id_state'] == 2) {
                    $sql = 'UPDATE '.DDBB_PREFIX.'users SET last_access = NOW(), ip_last_access = ? WHERE id_user = ? LIMIT 1';
                    $this->query($sql, array($this->get_ip(), $row['id_user']));
                    $_SESSION['user'] = [
                        'id_user' => $row['id_user'],
                        'email' => $row['email'],
                        'name' => $row['name']
                    ];
                    // If the user still does not have a remember code, I will create one for him
                    if($row["remember_code"] == '') {
                        $row["remember_code"] = uniqid();
                        $sql = 'UPDATE '.DDBB_PREFIX.'users SET remember_code = ? WHERE id_user = ? LIMIT 1';
                        $this->query($sql, array($row["remember_code"], $row['id_user']));
                    }
                    if($remember == 1) {
                        setcookie("user_remember", $row["remember_code"], time() + (60 * 60 * 24 * 7), PUBLIC_PATH.'/'); // 7 dias
                    }
                    return array(
                        'response' => 'ok',
                        'url' => PUBLIC_ROUTE.'/?login'
                    );
                } else {
                    return array(
                        'response' => 'error',
                        'mensaje' => LANGTXT['user-fail']
                    );                    
                }
            } else {
                return array(
                    'response' => 'error',
                    'mensaje' => LANGTXT['error-login']
                );
            }
        }

    }

?>