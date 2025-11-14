<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
     */

    class CAppAjax extends Controller {

        // App ajax services ------------------------------------------------
        
        public function set_cookies() {
            $app = new AppAjax();
            $result = [];
            $result['cookie'] = $app->set_cookies();
            echo json_encode($result);
        }

        public function save_newsletter() {
            $app = new AppAjax();
            $result = [];
            $result['newsletter'] = $app->save_newsletter($_POST['email']);
            echo json_encode($result);
        }

        public function login_send() {
            $app = new AppAjax();
            $app->security_app_logout();
            $result = [];
            $result['login'] = $app->login($_POST['email'], md5($_POST['pass']), $_POST['remember']);
            echo json_encode($result);
        }

        public function register_send() {
            $app = new AppAjax();
            $app->security_app_logout();
            $result = [];
            $result['register'] = $app->register($_POST['email'], $_POST['name'], $_POST['lastname'], $_POST['pass1'], $_POST['newsletter']);
            echo json_encode($result);
        }

        public function choose_language() {
            $app = new AppAjax();
            $result = [];
            $result['language'] = $app->choose_language($_POST['language']);
            echo json_encode($result);
        }

        public function choose_color_mode() {
            Utils::setThemeColor($_POST['mode']);
            $result = [];
            echo json_encode($result);
        }

    }

?>