<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // App Get
    $R->get(''                                      , 'CApp#root');
    $R->get('/'                                     , 'CApp#root');
    $R->get('/home'                                 , 'CApp#home');
    $R->get('/hive'                                 , 'CApp#home');
    $R->get('/privacy-policy'                       , 'CApp#privacy_policy');
    $R->get('/register'                             , 'CApp#register');
    $R->get('/404'                                  , 'CApp#page_404', false);
    $R->get('/service-down'                         , 'CApp#service_down', false);
    $R->get('/logout'                               , 'CApp#logout', false);

?>