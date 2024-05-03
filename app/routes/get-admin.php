<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // Admin Get
    $R->setController('CAdmin');
    $R->getAdmin(''                                 , 'root');
    $R->getAdmin('/'                                , 'root');
    $R->getAdmin('/login'                           , 'login');
    $R->getAdmin('/logout'                          , 'logout');
    $R->getAdmin('/home'                            , 'home');
    $R->getAdmin('/ftp-upload'                      , 'ftp_upload');

?>