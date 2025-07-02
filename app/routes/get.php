<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
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