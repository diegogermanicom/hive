<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    class CAppAjax extends Controller {

        // App ajax services ------------------------------------------------
        
        public function set_cookies($args) {
            $app = new AppAjax();
            $result = [];
            $result['cookie'] = $app->set_cookies();
            echo json_encode($result);
        }

        public function save_newsletter($args) {
            $app = new AppAjax();
            $result = [];
            $result['newsletter'] = $app->save_newsletter($_POST['email']);
            echo json_encode($result);
        }

        public function login_send($args) {
            $app = new AppAjax();
            $app->security_app_logout();
            $result = [];
            $result['login'] = $app->login($_POST['email'], md5($_POST['pass']), $_POST['remember']);
            echo json_encode($result);
        }

        public function register_send($args) {
            $app = new AppAjax();
            $app->security_app_logout();
            $result = [];
            $result['register'] = $app->register($_POST['email'], $_POST['name'], $_POST['lastname'], $_POST['pass1'], $_POST['newsletter']);
            echo json_encode($result);
        }

        public function choose_language($args) {
            $app = new AppAjax();
            $result = [];
            $result['language'] = $app->choose_language($_POST['language']);
            echo json_encode($result);
        }

        public function choose_color_mode($args) {
            setcookie('color-mode', $_POST['mode'], time() + Utils::ONEYEAR, PUBLIC_PATH.'/'); // 1 año
            $result = [];
            echo json_encode($result);
        }

    }

?>