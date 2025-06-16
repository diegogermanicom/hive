<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2025
     */

    // Admin Get
    $R->setRoot(ADMIN_PATH);
    $R->setController('CAdmin');
    $R->get(
        [''                                 , 'root'],
        ['/'                                , 'root'],
        ['/home'                            , 'home'],
        ['/login'                           , 'login'],
        ['/logout'                          , 'logout'],
        ['/sitemap'                         , 'sitemap'],
        ['/ftp-upload'                      , 'ftp_upload']
    );

?>