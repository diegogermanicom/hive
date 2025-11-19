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
            <section>
                <div class="container"></div>
            </section>
            <?php include VIEWS_PUBLIC.'/partials/footer.php'; ?>
        </div>
    </body>
</html>