<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * @return array Returns the values ​​to configure the framework
     * 
     * DISCLAIMER:
     * Modifying or altering the main structure of the HTML is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * Add the HTML content you need to customize the view.
     */

?>
<!DOCTYPE html>
<html lang="<?= LANG; ?>">
    <head>
        <?php include VIEWS_ADMIN.'/partials/head.php'; ?>
    </head>
    <body id="<?= $data['admin']['name_page']; ?>">
        <div class="app">
            <?php include VIEWS_ADMIN.'/partials/header.php'; ?>
            <?php include VIEWS_ADMIN.'/partials/menu-left.php'; ?>
            <div id="container-admin">
                <section>
                    <div class="container pt-50 pb-40">
                        <div class="text-center pt-10 mega-title">Welcome to<br>Hive Administrator</div>
                        <div class="text-center pt-10">Easily manage your application</div>
                    </div>
                </section>
                <section>
                    <div class="container-sm">
                        <div class="text-center">Welcome <b><?= $_SESSION['admin']['email']; ?></b></div>
                    </div>
                </section>
                <?php include VIEWS_ADMIN.'/partials/footer.php'; ?>
            </div>
        </div>
    </body>
</html>