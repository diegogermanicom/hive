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

?>
<!DOCTYPE html>
<html lang="<?= LANG; ?>">
    <head>
        <?php include VIEWS_PUBLIC.'/partials/head.php'; ?>
    </head>
    <body id="<?= $data['app']['name_page']; ?>" class="<?= $_COOKIE['color-mode']; ?>">
        <div class="app">
            <section>
                <div class="container">
                    <div class="text-center pt-100">
                        <a href="<?= Route::getAlias('home'); ?>"><img src="<?= PUBLIC_PATH.'/img/website-logo.png'; ?>" width="80" alt="Hive Framework"></a>
                    </div>
                    <div class="text-center pt-30 pb-100">The website is under maintenance.</div>
                </div>
            </section>
            <footer>
                <div class="text-center font-14">Published under <a href="https://opensource.org/licenses/MIT" target="_blank">MIT</a> license.</div>
                <div class="text-center font-14 pt-5">Copyright © <?= date('Y'); ?> <b class="core-color">Hive</b> Framework</div>
            </footer>
        </div>
    </body>
</html>