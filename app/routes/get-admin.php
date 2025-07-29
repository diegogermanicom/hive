<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0
     * @lastUpdated 2025
     */

    // Admin Get
    $R->setRoot(ADMIN_PATH);
    $R->setController('CAdmin');
    $R->setIndex(false);

    $R->get('')                                 ->call('root')                      ->add('admin-empty-root');
    $R->get('/')                                ->call('root')                      ->add('admin-bar-root');
    $R->get('/login')                           ->call('login')                     ->add('admin-login');
    $R->get('/logout')                          ->call('logout')                    ->add('admin-logout');
    $R->get('/home')                            ->call('home')                      ->add('admin-home');
    // Settings
    $R->get('/sitemap')                         ->call('sitemap')                   ->add('sitemap');
    $R->get('/ftp-upload')                      ->call('ftp_upload')                ->add('ftp-upload');

?>