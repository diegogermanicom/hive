<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
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