<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2022
     */   

    class App extends AppModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
            $this->check_maintenance();
            $this->set_cesta();
            $this->login_remember();
        }

        public function getAppData() {
            // Declare here the variables that you are going to use in several different views
            $data = array();
            $data['app'] = array(
                'name_page' => $this->name_page
            );
            $data['head'] = array(
                'application-name' => 'Hive',
                'author' => 'Diego Martín',
                'robots' => 'index, follow',
                'canonical' => PROTOCOL.'://'.HOST_PRO
            );
            $data['meta'] = array(
                'title' => META_TITLE,
                'description' => META_DESCRIPTION,
                'keywords' => META_KEYS
            );
            $data['og'] = array(
                'og:title' => OG_TITLE,
                'og:site_name' => OG_SITE_NAME,
                'og:description' => OG_DESCRIPTION,
                'og:type' => OG_TYPE,
                'og:url' => OG_URL,
                'og:image' => OG_IMAGE,
                'og:locale' => LANG,
                'fb:app_id' => OG_APP_ID
            );
            return $data;
        }

        public function set_cesta() {
            // If you don't have the id_cesta cookie, I create one
			if(!(isset($_COOKIE["id_cesta"]))) {
                $uniq = uniqid();
				setcookie("id_cesta", $uniq, time() + (60 * 60 * 24 * 30 * 4), PUBLIC_PATH.'/'); // 4 meses
                $_COOKIE["id_cesta"] = $uniq;
			}
        }

        public function set_cookies() {
            setcookie("acepto_cookies", 'accepted cookies', time() + (60 * 60 * 24 * 30 * 4), PUBLIC_PATH.'/'); // 4 meses
            $_COOKIE["acepto_cookies"] = 'accepted cookies';
        }

        public function login_remember() {
			if(isset($_COOKIE["user_remember"])) {
                if(!isset($_SESSION['user'])) {
                    $sql = 'SELECT email, pass FROM '.DDBB_PREFIX.'users WHERE remember_code = ? AND id_state = 2 LIMIT 1';
                    $result = $this->query($sql, array($_COOKIE['user_remember']));
                    if($result->num_rows != 0) {
                        $row = $result->fetch_assoc();
                        $this->login($row['email'], $row['pass'], 1);
                    } else {
                        setcookie('user_remember', '', time() -3600, PUBLIC_PATH.'/');
                    }
                } else {
                    // If the remember code does not match it is because the user has been kicked out
                    $sql = 'SELECT id_user FROM '.DDBB_PREFIX.'users WHERE id_user = ? AND remember_code = ? LIMIT 1';
                    $result = $this->query($sql, array($_SESSION['user']['id_user'], $_COOKIE["user_remember"]));
                    if($result->num_rows == 0) {
                        $this->logout();
                        header('Location: '.PUBLIC_PATH.'/');
                        exit;
                    }
                }
            }            
        }

        public function login($email, $pass, $remember) {
            // Pass must come in md5
            $sql = 'SELECT * FROM '.DDBB_PREFIX.'users WHERE email = ? AND pass = ? LIMIT 1';
            $result = $this->query($sql, array($email, $pass));
            if($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                if($row['id_state'] == 2) {
                    $sql = 'UPDATE '.DDBB_PREFIX.'users SET last_access = NOW(), ip_last_access = ? WHERE id_user = ? LIMIT 1';
                    $this->query($sql, array($this->get_ip(), $row['id_user']));
                    $_SESSION['user'] = [];
                    $_SESSION['user']['id_user'] = $row['id_user'];
                    $_SESSION['user']['email'] = $row['email'];
                    $_SESSION['user']['name'] = $row['name'];
                    // If the user still does not have a remember code, I will create one for him
                    if($row["remember_code"] == '') {
                        $row["remember_code"] = uniqid();
                        $sql = 'UPDATE '.DDBB_PREFIX.'users SET remember_code = ? WHERE id_user = ? LIMIT 1';
                        $this->query($sql, array($row["remember_code"], $row['id_user']));
                    }
                    if($remember == 1) {
                        setcookie("user_remember", $row["remember_code"], time() + (60 * 60 * 24 * 7), PUBLIC_PATH.'/'); // 7 dias
                    }
                    return array('response' => 'ok');
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

        public function logout() {
            unset($_SESSION['user']);
            setcookie('user_remember', '', time() -3600, PUBLIC_PATH.'/');
        }

        public function validate_email($code) {
            $sql = 'SELECT id_user FROM '.DDBB_PREFIX.'users WHERE validation_code = ? LIMIT 1';
            $result = $this->query($sql, array($code));
            if($result->num_rows != 0) {
                $sql = 'UPDATE '.DDBB_PREFIX.'users SET validated_email = 1 WHERE validation_code = ? LIMIT 1';
                $this->query($sql, array($code));
                $html = 'Your account has been successfully validated.';
            } else {
                $html = 'Your account could not be validated.';
            }
            return $html;
        }

    }
    
?>