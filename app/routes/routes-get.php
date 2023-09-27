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
    $R->get('/404'                                  , 'CApp#page_404');
    $R->get('/service-down'                         , 'CApp#service_down');
    $R->get('/privacy-policy'                       , 'CApp#privacy_policy');
    $R->get('/register'                             , 'CApp#register');
    $R->get('/logout'                               , 'CApp#logout');

    // App Dynamics Get
    $R->get('/producto/$cat/$attr'                  , 'CApp#documentation');

?>