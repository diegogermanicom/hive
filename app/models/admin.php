<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
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
            $data['menu'] = array(
                'home' => array('admin-home-page'),
                'ftp_upload' => array('ftp-upload-page')
            );
            $data['meta'] = array(
                'title' => META_TITLE
            );
            return $data;
        }

        public function login_remember() {
			if(isset($_COOKIE["admin_remember"])) {
                if(!isset($_SESSION['admin'])) {
                    $sql = 'SELECT email, pass FROM '.DDBB_PREFIX.'users_admin WHERE remember_code = ? AND id_state = 2 LIMIT 1';
                    $result = $this->query($sql, array($_COOKIE['admin_remember']));
                    if($result->num_rows != 0) {
                        $row = $result->fetch_assoc();
                        $this->login($row['email'], $row['pass']);
                    } else {
                        setcookie('admin_remember', '', time() -3600, PUBLIC_PATH.'/');
                    }
                } else {
                    // If the remember code does not match it is because the user has been kicked out
                    $sql = 'SELECT id_admin FROM '.DDBB_PREFIX.'users_admin WHERE id_admin = ? AND remember_code = ? LIMIT 1';
                    $result = $this->query($sql, array($_SESSION['admin']['id_admin'], $_COOKIE["admin_remember"]));
                    if($result->num_rows == 0) {
                        $this->logout();
                        header('Location: '.ADMIN_PATH.'/');
                        exit;
                    }
                }
            }            
        }
        
        public function logout() {
            unset($_SESSION['admin']);
            setcookie('admin_remember', '', time() -3600, PUBLIC_PATH.'/');
        }

    }

?>