<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */

    // App Post
    $R->setController('CAppAjax');
    $R->post('/set-cookies'                         , 'set_cookies');
    $R->post('/save-newsletter'                     , 'save_newsletter');
    $R->post('/login-send'                          , 'login_send');
    $R->post('/register-send'                       , 'register_send');
    $R->post('/choose-language'                     , 'choose_language');
    $R->post('/choose-color-mode'                   , 'choose_color_mode');

?>