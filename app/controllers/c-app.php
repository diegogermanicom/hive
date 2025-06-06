<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    class CApp extends Controller {

        // App services ------------------------------------------------
        
        public function root($args) {
            header('Location: '.PUBLIC_ROUTE.'/home');
            exit;
        }

        public function home($args) {
            $app = new App('home-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Home');
            $data['head']['canonical'] .= '/home';
            $this->view('/home', $data);
        }

        public function privacy_policy($args) {
            $app = new App('privacy-policy-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Privacy Policy');
            $data['meta']['description'] = 'Find out about our privacy policies to make good use of our application.';
            $data['meta']['keywords'] .= ', privacy policy, legal, cookies, cookies policy';
            $data['head']['canonical'] .= '/privacy-policy';
            $this->view('/privacy-policy', $data);
        }

        public function service_down($args) {
            $app = new App('service-down-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Service Down');
            $data['meta']['description'] = 'We are making improvements to our app. In a very short time we will be back.';
            $this->view('/service-down', $data);
        }

        public function register($args) {
            $app = new App('register-page');
            $app->security_app_logout();
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Register');
            $data['head']['canonical'] .= '/register';
            $this->view('/register', $data);
        }

        public function page_404($args) {
            $app = new App('404-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('404');
            $data['meta']['description'] = 'If you have come this far, it is because we do not have the page you are looking for.';
            $data['meta']['keywords'] .= ', 404, not found, missing';
            $this->view('/404', $data);
        }

        public function logout($args) {
            $app = new App();
            $app->security_app_login();
            $app->logout();
            header('Location: '.PUBLIC_ROUTE.'/home?logout');
            exit;
        }

    }

?>