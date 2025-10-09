<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    class AppAjax extends AppModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
            $this->check_maintenance();
        }

        public function set_cookies() {
            Utils::initCookie('acepto_cookies', 'accepted cookies', Utils::ONEYEAR);
            return array('response' => 'ok');
        }

        public function save_newsletter($email) {
            $sql = 'SELECT id_newsletter FROM newsletters WHERE email = ? LIMIT 1';
            $result = $this->query($sql, array($email));
            if($result->num_rows == 0) {
                $validation_code = uniqid();
                $sql = 'INSERT INTO newsletters (email, validation_code) VALUES (?, ?)';
                $this->query($sql, array($email, $validation_code));
            } else {
                $sql = 'UPDATE newsletters SET status = 1 WHERE email = ? LIMIT 1';
                $this->query($sql, array($email));
            }
            return array(
                'response' => 'ok',
                'title' => LANGTXT['newsletter-ok-title'],
                'description' => LANGTXT['newsletter-ok-description']
            );
        }

        public function register($email, $name, $lastname, $pass, $newsletter) {
            $sql = 'SELECT id_user FROM users WHERE email = ? LIMIT 1';
            $result = $this->query($sql, array($email));
            if($result->num_rows == 0) {
                $sql = 'INSERT INTO users (email, `name`, lastname, pass, validation_code, ip_register) VALUES (?, ?, ?, ?, ?, ?)';
                $this->query($sql, array($email, $name, $lastname, md5($pass), uniqid(), $this->get_ip()));
                // If you sign up for the newsletter
                if($newsletter == 1) {
                    $validation_code = uniqid();
                    $sql = 'INSERT INTO newsletters (email, validation_code) VALUES (?, ?)';
                    $this->query($sql, array($email, $validation_code));
                }
                return array(
                    'response' => 'ok',
                    'url' => Utils::getRoute('/', array('register' => 'true'))
                );
            } else {
                return array(
                    'response' => 'error',
                    'message' => LANGTXT['error-register']
                );    
            }
        }

        public function choose_language($language) {
            Utils::initCookie('lang', $language, Utils::ONEYEAR);
            return array('response' => 'ok');
        }

    }

?>