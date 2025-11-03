<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
     */

    // Admin Get
    $R->setController('CAdmin');

    $R->get('')                                 ->call_admin('root');
    $R->get('/')                                ->call_admin('root');
    $R->get('/login')                           ->call_admin('login');
    $R->get('/logout')                          ->call_admin('logout');
    $R->get('/home')                            ->call_admin('home');
    // Settings
    $R->get('/sitemap')                         ->call_admin('sitemap');
    $R->get('/ftp-upload')                      ->call_admin('ftp_upload');

?>