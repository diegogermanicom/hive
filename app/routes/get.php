<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // App Get
    $R->setController('CApp');
    $R->get(''                                      , 'root');
    $R->get('/'                                     , 'root');
    $R->get('/home'                                 , 'home');
    $R->get('/privacy-policy'                       , 'privacy_policy');
    $R->get('/cookie-policy'                        , 'cookie_policy');
    $R->get('/register'                             , 'register');
    $R->get('/404'                                  , 'page_404', false);
    $R->get('/service-down'                         , 'service_down', false);
    $R->get('/logout'                               , 'logout', false);

?>