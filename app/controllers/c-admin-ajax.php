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

    class CAdminAjax extends Controller {
        
        // App ajax services ------------------------------------------------

        public function send_login($args) {
            $admin = new AdminAjax('ajax-admin-login');
            $admin->security_admin_logout();
            $result = [];
            $result['login'] = $admin->login($_POST['email'], md5($_POST['pass']), $_POST['remember']);
            echo json_encode($result);
        }

        public function create_new_sitemap() {
            $admin = new AdminAjax('ajax-sitemap');
            $admin->security_admin_login();
            $result = [];
            $result['sitemap'] = $admin->create_new_sitemap();
            echo json_encode($result);
        }

        public function ftpu_get_dir($args) {
            $admin = new AdminAjax('ajax-ftpu-get-dir');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $result = [];
            $result['get_dir'] = $upload->get_folder_html($_POST['dir']);
            echo json_encode($result);
        }

        public function ftpu_compare($args) {
            $admin = new AdminAjax('ajax-ftpu-compare');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $result = [];
            $result['compare'] = $upload->ftpCompare($_POST['folder'], $_POST['file']);
            echo json_encode($result);
        }

        public function ftpu_upload($args) {
            $admin = new AdminAjax('ajax-ftpu-upload');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $result = [];
            $result['upload'] = $upload->upload_ftp($_POST['folder'], $_POST['file']);
            echo json_encode($result);
        }
        
        public function ftpu_upload_all($args) {
            $admin = new AdminAjax('ajax-ftpu-all');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $result = [];
            $result['upload'] = $upload->upload_all_ftp($_POST['folder'], $_POST['files']);
            echo json_encode($result);
        }

        public function ftpu_create_folder($args) {
            $admin = new AdminAjax('ajax-ftpu-create-dir');
            $admin->security_admin_login();
            $upload = new FtpUpload();
            $upload->init();
            $result = [];
            $result['folder'] = $upload->create_folder($_POST['folder'], $_POST['name']);
            echo json_encode($result);
        }

    }

?>