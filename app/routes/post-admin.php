<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    // Admin Post
    $R->setController('CAdminAjax');
    
    $R->post('/send-login')                     ->call_admin('send_login');
    $R->post('/create-new-sitemap')             ->call_admin('create_new_sitemap');
    // FPT Upload
    $R->post('/ftpu-get-dir')                   ->call_admin('ftpu_get_dir');
    $R->post('/ftpu-compare')                   ->call_admin('ftpu_compare');
    $R->post('/ftpu-upload')                    ->call_admin('ftpu_upload');
    $R->post('/ftpu-upload-all')                ->call_admin('ftpu_upload_all');
    $R->post('/ftpu-create-folder')             ->call_admin('ftpu_create_folder');

?>