<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
     */

    // App Post
    $R->setController('CAppAjax');

    $R->post('/choose-language')                ->call('choose_language')           ->add('choose-language');
    $R->post('/set-cookies')                    ->call('set_cookies')               ->add('set-cookies');
    $R->post('/save-newsletter')                ->call('save_newsletter')           ->add('save-newsletter');
    $R->post('/login-send')                     ->call('login_send')                ->add('login-send');
    $R->post('/register-send')                  ->call('register_send')             ->add('register-send');
    $R->post('/choose-color-mode')              ->call('choose_color_mode')         ->add('choose-color-mode');

?>