<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // App Post
    $R->post('/set-cookies'                         , 'CAppAjax#set_cookies');
    $R->post('/save-newsletter'                     , 'CAppAjax#save_newsletter');
    $R->post('/login-send'                          , 'CAppAjax#login_send');
    $R->post('/register-send'                       , 'CAppAjax#register_send');
    $R->post('/choose-language'                     , 'CAppAjax#choose_language');
    $R->post('/choose-color-mode'                   , 'CAppAjax#choose_color_mode');

?>