<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * @see https://github.com/diegogermanicom/hive
     * @license MIT
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
     */

    class CAdmin extends Controller {

        public function root() {
            header('Location: '.ADMIN_PATH.'/login');
            exit;
        }

        public function login() {
            $admin = new Admin('admin-login-page');
            $admin->security_admin_logout();
            $data = $admin->getAdminData();
            $data['meta']['title'] = $admin->setTitle('Login');
            self::viewAdmin('/login', $data);
        }

        public function logout() {
            $admin = new Admin();
            $admin->security_admin_login();
            $admin->logout();
            header('Location: '.ADMIN_PATH.'/login?logout');
            exit;
        }

        public function home() {
            $admin = new Admin('admin-home-page');
            $admin->security_admin_login();
            $data = $admin->getAdminData();
            $data['admin']['tags'] = [
                'home'
            ];
            $data['meta']['title'] = $admin->setTitle('Home');
            self::viewAdmin('/home', $data);
        }

        public function sitemap() {
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

        public function ftp_upload() {
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