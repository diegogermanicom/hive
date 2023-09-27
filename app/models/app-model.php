<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2022
     */   

    class AppModel extends Model {

        function __construct() {
            parent::__construct();
        }

        public function setTitle($title) {
            return $title.' | Hive';
        }

        public function security_app_logout() {
            if(isset($_SESSION['user'])) {
                header('Location: '.PUBLIC_ROUTE.'/home');
                exit;
            }
        }

        public function security_app_login() {
            if(!isset($_SESSION['user'])) {
                header('Location: '.PUBLIC_ROUTE.'/home');
                exit;
            }
        }

    }

?>