<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * @see https://github.com/diegogermanicom/hive
     * @license MIT
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
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