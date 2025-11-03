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
<meta charset="UTF-8">
<title><?= $data['meta']['title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-title" content="Hive" />
<meta name="application-name" content="Hive" />
<meta name="author" content="Diego Martín" />
<meta name="date" content="<? date('Y'); ?>" />
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="icon" href="<?= PUBLIC_PATH; ?>/icono.png" type="image/png">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/fontawesome.min.css" rel="stylesheet">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/brands.min.css" rel="stylesheet">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/solid.min.css" rel="stylesheet">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/balloon.css" rel="stylesheet">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/slick.css" rel="stylesheet">
<link href="<?= PUBLIC_PATH; ?>/css/vendor/slick-theme.css" rel="stylesheet">
<?php
    if(ENVIRONMENT == 'DEV') {
        echo '<link href="'.PUBLIC_PATH.'/css/core.css?'.uniqid().'" rel="stylesheet">';
        echo '<link href="'.PUBLIC_PATH.'/css/admin.css?'.uniqid().'" rel="stylesheet">';
    } else {
        echo '<link href="'.PUBLIC_PATH.'/css/core.css" rel="stylesheet">';
        echo '<link href="'.PUBLIC_PATH.'/css/admin.css" rel="stylesheet">';
    }
?>
<script src="<?= PUBLIC_PATH; ?>/js/vendor/jquery-3.7.1.min.js"></script>
<script src="<?= PUBLIC_PATH; ?>/js/vendor/slick.min.js"></script>
<script>
    var PUBLIC_PATH = '<?= PUBLIC_PATH ?>';
    var ADMIN_PATH = '<?= ADMIN_PATH ?>';
</script>
<?php
    if(ENVIRONMENT == 'DEV') {
        echo '<script src="'.PUBLIC_PATH.'/js/utils.js?'.uniqid().'"></script>';
        echo '<script src="'.PUBLIC_PATH.'/js/admin.js?'.uniqid().'"></script>';    
    } else {
        echo '<script src="'.PUBLIC_PATH.'/js/min/utils.min.js"></script>';
        echo '<script src="'.PUBLIC_PATH.'/js/min/admin.min.js"></script>';                
    }
?>