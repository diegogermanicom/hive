<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
     */

    // Admin Post
    $R->setRoot(ADMIN_PATH);
    $R->setController('CAdminAjax');
    
    $R->post('/send-login')                     ->call('send_login')                        ->add('/send-login');
    $R->post('/create-new-sitemap')             ->call('create_new_sitemap')                ->add('/create-new-sitemap');
    // FPT Upload
    $R->post('/ftpu-get-dir')                   ->call('ftpu_get_dir')                      ->add('ftpu-get-dir');
    $R->post('/ftpu-compare')                   ->call('ftpu_compare')                      ->add('ftpu-compare');
    $R->post('/ftpu-upload')                    ->call('ftpu_upload')                       ->add('ftpu-upload');
    $R->post('/ftpu-upload-all')                ->call('ftpu_upload_all')                   ->add('ftpu-upload-all');
    $R->post('/ftpu-create-folder')             ->call('ftpu_create_folder')                ->add('ftpu-create-folder');

?>