<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
     */

    class CAdmin extends Controller {

        // Admin services ------------------------------------------------        
    
        public function root($args) {
            header('Location: '.ADMIN_PATH.'/login');
            exit;
        }

        public function login($args) {
            $admin = new Admin('admin-login-page');
            $admin->security_admin_logout();
            $data = $admin->getAdminData();
            $data['meta']['title'] = $admin->setTitle('Login');
            $this->viewAdmin('/login', $data);
        }

        public function logout($args) {
            $admin = new Admin();
            $admin->security_admin_login();
            $admin->logout();
            header('Location: '.ADMIN_PATH.'/login?logout');
            exit;
        }

        public function home($args) {
            $admin = new Admin('admin-home-page');
            $admin->security_admin_login();
            $data = $admin->getAdminData();
            $data['admin']['tags'] = [
                'home'
            ];
            $data['meta']['title'] = $admin->setTitle('Home');
            $this->viewAdmin('/home', $data);
        }

        public function sitemap($args) {
            $admin = new Admin('admin-sitemap');
            $admin->security_admin_login();
            $data = $admin->getAdminData();
            $data['admin']['tags'] = [
                'sitemap'
            ];
            $data['meta']['title'] = $admin->setTitle('Sitemap');
            $data['sitemap'] = $admin->getSitemapInfo();
            $this->viewAdmin('/sitemap', $data);
        }

        public function ftp_upload($args) {
            $admin = new Admin('ftp-upload-page');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            if($upload->connect()) {
                if($upload->login()) {
                    $data = $admin->getAdminData();
                    $data['admin']['tags'] = [
                        'ftp-upload'
                    ];
                    $data['meta']['title'] = $admin->setTitle('FTP Upload');
                    $this->viewAdmin('/ftp-upload-view', $data);
                } else {
                    Utils::error('The Ftp Upload user or password is not correct.');
                }    
            } else {
                Utils::error('Ftp Upload could not connect to server.');
            }
        }
        
    }

?>