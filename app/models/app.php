<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
     */

    class App extends AppModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
            $this->check_maintenance();
            $this->login_remember();
        }

        public function getAppData() {
            // Declare here the variables that you are going to use in several different views
            $data = array();
            $data['app'] = array(
                'name_page' => $this->name_page,
                'tags' => array()
            );
            $data['head'] = array(
                'application-name' => 'Hive',
                'author' => 'Diego Martín',
                'robots' => 'index, follow',
                'canonical' => URL_ROUTE
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

        public function login_remember() {
			if(isset($_COOKIE["user_remember"])) {
                if(!isset($_SESSION['user'])) {
                    $sql = 'SELECT email, pass FROM '.DDBB_PREFIX.'users WHERE remember_code = ? AND id_state = 2 LIMIT 1';
                    $result = $this->query($sql, array($_COOKIE['user_remember']));
                    if($result->num_rows != 0) {
                        $row = $result->fetch_assoc();
                        $this->login($row['email'], $row['pass'], 1);
                    } else {
                        Utils::killCookie('user_remember');
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

        public function logout() {
            unset($_SESSION['user']);
            Utils::killCookie('user_remember');
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