        <meta charset="UTF-8">
        <title><?= $data['meta']['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-title" content="Hive" />
        <meta name="application-name" content="Hive" />
        <meta name="author" content="Diego Martín" />
        <meta name="date" content="2022" />
        <meta name="robots" content="noindex, nofollow">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="icon" href="<?= PUBLIC_PATH; ?>/icono.png" type="image/png">
        <link href="<?= PUBLIC_PATH; ?>/css/fontawesome.min.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/brands.min.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/solid.min.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/vendor/balloon.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/vendor/slick.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/vendor/slick-theme.css" rel="stylesheet">
        <link href="<?= PUBLIC_PATH; ?>/css/admin.css?<?= uniqid(); ?>" rel="stylesheet">
        <script src="<?= PUBLIC_PATH; ?>/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="<?= PUBLIC_PATH; ?>/js/vendor/slick.min.js"></script>
        <script>
            var PUBLIC_PATH = '<?= PUBLIC_PATH ?>';
            var ADMIN_PATH = '<?= ADMIN_PATH ?>';
        </script>
        <?php
            if(ENVIRONMENT == 'PRE') {
                echo '<script src="'.PUBLIC_PATH.'/js/assets.js?'.uniqid().'"></script>';
                echo '<script src="'.PUBLIC_PATH.'/js/admin.js?'.uniqid().'"></script>';    
            } else {
                echo '<script src="'.PUBLIC_PATH.'/js/min/assets.min.js?'.uniqid().'"></script>';
                echo '<script src="'.PUBLIC_PATH.'/js/min/admin.min.js?'.uniqid().'"></script>';                
            }
        ?>