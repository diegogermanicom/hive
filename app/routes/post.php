<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
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