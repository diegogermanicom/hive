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
        <?php include VIEWS_PUBLIC.'/partials/header-body.php'; ?>
        <div class="app">
            <?php include VIEWS_PUBLIC.'/partials/header.php'; ?>
            <section class="pt-100 pb-100">
                <div class="container animate animate-top">
                    <div class="text-center pt-10 mega-title">Welcome to<br><span class="accent">Hive Framework</span></div>
                    <div class="text-center pt-10">It's fast, light and simple</div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/partials/footer.php'; ?>
        </div>
    </body>
</html>