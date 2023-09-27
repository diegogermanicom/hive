<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2022
     */   

    class Admin extends AdminModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
            $this->login_remember();
        }

        public function getAdminData() {
            // Declare here the variables that you are going to use in several different views
            $data = array();
            $data['admin'] = array(
                'name_page' => $this->name_page
            );
            $data['meta'] = array(
                'title' => META_TITLE
            );
            return $data;
        }

        public function login_remember() {
			if(isset($_COOKIE["admin_remember"]) && !isset($_SESSION['admin'])) {
                $sql = 'SELECT email, pass FROM '.DDBB_PREFIX.'users_admin WHERE remember_code = ? AND id_state = 2 LIMIT 1';
    			$result = $this->query($sql, array($_COOKIE['admin_remember']));
                if($result->num_rows != 0) {
                    $row = $result->fetch_assoc();
                    $this->login($row['email'], $row['pass']);
                } else {
                    setcookie('admin_remember', '', time() -3600, PUBLIC_PATH.'/');
                }
            }            
        }

        public function login($email, $pass) {
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
                    setcookie("admin_remember", $row["remember_code"], time() + (60 * 60 * 24 * 7), PUBLIC_PATH.'/'); // 7 dias
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
        
        public function logout() {
            unset($_SESSION['admin']);
            setcookie('admin_remember', '', time() -3600, PUBLIC_PATH.'/');
        }

    }

?>