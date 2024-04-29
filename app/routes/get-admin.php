<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // Admin Get
    $R->getAdmin(''                                 , 'CAdmin#root');
    $R->getAdmin('/'                                , 'CAdmin#root');
    $R->getAdmin('/login'                           , 'CAdmin#login');
    $R->getAdmin('/logout'                          , 'CAdmin#logout');
    $R->getAdmin('/home'                            , 'CAdmin#home');
    $R->getAdmin('/ftp-upload'                      , 'CAdmin#ftp_upload');

?>