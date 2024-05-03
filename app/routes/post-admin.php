<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // Admin Post
    $R->setController('CAdminAjax');
    $R->postAdmin('/send-login'                     , 'send_login');
    $R->postAdmin('/ftpu-get-dir'                   , 'ftpu_get_dir');
    $R->postAdmin('/ftpu-compare'                   , 'ftpu_compare');
    $R->postAdmin('/ftpu-upload'                    , 'ftpu_upload');
    $R->postAdmin('/ftpu-upload-all'                , 'ftpu_upload_all');
    $R->postAdmin('/ftpu-create-folder'             , 'ftpu_create_folder');

?>