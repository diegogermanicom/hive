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
    $R->post(
        ['/send-login'                      , 'send_login'],
        ['/create-new-sitemap'              , 'create_new_sitemap'],        
        ['/ftpu-get-dir'                    , 'ftpu_get_dir'],
        ['/ftpu-compare'                    , 'ftpu_compare'],
        ['/ftpu-upload'                     , 'ftpu_upload'],
        ['/ftpu-upload-all'                 , 'ftpu_upload_all'],
        ['/ftpu-create-folder'              , 'ftpu_create_folder']
    );

?>