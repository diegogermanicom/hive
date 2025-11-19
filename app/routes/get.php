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

    // App Get
    $R->setController('CApp');

    $R->get('')                                 ->call('root')                      ->add('empty-root');
    $R->get('/')                                ->call('root')                      ->add('/');
    $R->get('/page-404')                        ->call('page_404')                  ->add('page-404', false);
    $R->get('/home')                            ->call('home')                      ->add('home');
    $R->get('/privacy-policy')                  ->call('privacy_policy')            ->add('privacy-policy');
    $R->get('/cookie-policy')                   ->call('cookie_policy')             ->add('cookie-policy');
    $R->get('/service-down')                    ->call('service_down')              ->add('service-down', false);
    $R->get('/logout')                          ->call('logout')                    ->add('logout', false);

?>