<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    class CAdminAjax extends Controller {
        
        // App ajax services ------------------------------------------------

        public function send_login($args) {
            $admin = new Admin('ajax-admin-login');
            $admin->security_admin_logout();
            $result = [];
            $result['login'] = $admin->login($_POST['email'], md5($_POST['pass']));
            echo json_encode($result);
        }

        public function ftpu_get_dir($args) {
            $admin = new Admin('ajax-ftpu-get-dir');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->connect();
            $upload->login();
            $result = [];
            $result['get_dir'] = $upload->get_folder_html($_POST['dir']);
            echo json_encode($result);
        }

        public function ftpu_compare($args) {
            $admin = new Admin('ajax-ftpu-compare');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->connect();
            $upload->login();
            $result = [];
            $result['compare'] = $upload->ftp_comparar($_POST['folder'], $_POST['file']);
            echo json_encode($result);
        }

        public function ftpu_upload($args) {
            $admin = new Admin('ajax-ftpu-upload');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->connect();
            $upload->login();
            $result = [];
            $result['upload'] = $upload->upload_ftp($_POST['folder'], $_POST['file']);
            echo json_encode($result);
        }
        
        public function ftpu_upload_all($args) {
            $admin = new Admin('ajax-ftpu-all');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->connect();
            $upload->login();
            $result = [];
            $result['upload'] = $upload->upload_all_ftp($_POST['folder'], $_POST['files']);
            echo json_encode($result);
        }

        public function ftpu_create_folder($args) {
            $admin = new Admin('ajax-ftpu-create-dir');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->connect();
            $upload->login();
            $result = [];
            $result['folder'] = $upload->create_folder($_POST['folder'], $_POST['name']);
            echo json_encode($result);
        }

    }

?>