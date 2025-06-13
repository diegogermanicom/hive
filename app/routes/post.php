<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2025
     */

    // App Post
    $R->setController('CAppAjax');
    $R->post(
        ['/set-cookies'                     , 'set_cookies'],
        ['/save-newsletter'                 , 'save_newsletter'],
        ['/login-send'                      , 'login_send'],
        ['/register-send'                   , 'register_send'],
        ['/choose-language'                 , 'choose_language'],
        ['/choose-color-mode'               , 'choose_color_mode']
    );

?>