<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
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