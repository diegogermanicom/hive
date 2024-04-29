<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */   

    class AppAjax extends AppModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
        }

        public function save_newsletter($email) {
            $sql = 'SELECT id_newsletter FROM '.DDBB_PREFIX.'newsletters WHERE email = ? LIMIT 1';
            $result = $this->query($sql, array($email));
            if($result->num_rows == 0) {
                $validation_code = uniqid();
                $sql = 'INSERT INTO '.DDBB_PREFIX.'newsletters (email, validation_code) VALUES (?, ?)';
                $this->query($sql, array($email, $validation_code));
            } else {
                $sql = 'UPDATE '.DDBB_PREFIX.'newsletters SET status = 1 WHERE email = ? LIMIT 1';
                $this->query($sql, array($email));
            }
            return array(
                'response' => 'ok',
                'title' => LANGTXT['newsletter-ok-title'],
                'description' => LANGTXT['newsletter-ok-description']
            );
        }

        public function register($email, $name, $lastname, $pass, $newsletter) {
            $sql = 'SELECT id_user FROM '.DDBB_PREFIX.'users WHERE email = ? LIMIT 1';
            $result = $this->query($sql, array($email));
            if($result->num_rows == 0) {
                $sql = 'INSERT INTO '.DDBB_PREFIX.'users (email, `name`, lastname, pass, validation_code, ip_register) VALUES (?, ?, ?, ?, ?, ?)';
                $this->query($sql, array($email, $name, $lastname, md5($pass), uniqid(), $this->get_ip()));
                // If you sign up for the newsletter
                if($newsletter == 1) {
                    $validation_code = uniqid();
                    $sql = 'INSERT INTO '.DDBB_PREFIX.'newsletters (email, validation_code) VALUES (?, ?)';
                    $this->query($sql, array($email, $validation_code));
                }
                return array(
                    'response' => 'ok',
                    'url' => PUBLIC_ROUTE.'/?register'
                );
            } else {
                return array(
                    'response' => 'error',
                    'mensaje' => LANGTXT['error-register']
                );    
            }
        }

        public function choose_language($language) {
            setcookie('lang', $language, time() + (24 * 60 * 60 * 365), PUBLIC_PATH.'/'); // 1 año
            $_COOKIE['lang'] = $language;
            return array('response' => 'ok');
        }

    }

?>