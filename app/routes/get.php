<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // App Get
    $R->setController('CApp');
    $R->get(
        [''                                 , 'root'],
        ['/'                                , 'root'],
        ['/home'                            , 'home'],
        ['/privacy-policy'                  , 'privacy_policy'],
        ['/cookie-policy'                   , 'cookie_policy'],
        ['/register'                        , 'register'],
        ['/service-down'                    , 'service_down',       false],
        ['/logout'                          , 'logout',             false],
        ['/404'                             , 'page_404',           false]
    );    

?>