<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // Admin Post
    $R->postAdmin('/send-login'                     , 'CAdminAjax#send_login');
    $R->postAdmin('/ftpu-get-dir'                   , 'CAdminAjax#ftpu_get_dir');
    $R->postAdmin('/ftpu-compare'                   , 'CAdminAjax#ftpu_compare');
    $R->postAdmin('/ftpu-upload'                    , 'CAdminAjax#ftpu_upload');
    $R->postAdmin('/ftpu-upload-all'                , 'CAdminAjax#ftpu_upload_all');
    $R->postAdmin('/ftpu-create-folder'             , 'CAdminAjax#ftpu_create_folder');

?>