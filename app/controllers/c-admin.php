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
            self::viewAdmin('/login', $data);
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
            self::viewAdmin('/home', $data);
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
            self::viewAdmin('/sitemap', $data);
        }

        public function ftp_upload($args) {
            $admin = new Admin('ftp-upload-page');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $data = $admin->getAdminData();
            $data['admin']['tags'] = [
                'ftp-upload'
            ];
            $data['meta']['title'] = $admin->setTitle('FTP Upload');
            self::viewAdmin('/ftp-upload-view', $data);
        }
        
    }

?>