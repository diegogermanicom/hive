<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     */

    // Constant system variables
    define('HOST', strtolower($_SERVER['HTTP_HOST']));
    define('METHOD', strtolower($_SERVER['REQUEST_METHOD']));
    define('ROUTE', strtolower(strtok($_SERVER["REQUEST_URI"], '?')));
    if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }
    define('PROTOCOL', $protocol);

    require_once __DIR__.'/autoload-libs.php';
    require_once __DIR__.'/autoload-models.php';
    $controllers = require_once __DIR__.'/autoload-controllers.php';
    define('CONTROLLERS', $controllers);

    $settings = require_once __DIR__.'/settings.php';
    // If all setting values are correct continue
    Utils::settingsValidator($settings);
 
    $environment = Utils::getEnvironment($settings['HOST_DEV'], $settings['HOST_PRO']);
    define('ENVIRONMENT', $environment);

    define('HAS_DDBB', $settings['HAS_DDBB']);
    // I create the object to connect to the database at this point, in case you want to load configuration data from the administrator.
    $Ddbb = new Ddbb(
        $settings[ENVIRONMENT]['DDBB_HOST'],
        $settings[ENVIRONMENT]['DDBB_USER'], $settings[ENVIRONMENT]['DDBB_PASS'],
        $settings[ENVIRONMENT]['DDBB'], $settings['DDBB_PREFIX']
    );

    define('APP_NAME', $settings['APP_NAME']);
    define('ADMIN_NAME', $settings['ADMIN_NAME']);

    define('LANGUAGE', $settings['LANGUAGE']);
    define('MULTILANGUAGE', $settings['MULTILANGUAGE']);
    define('LANGUAGES', $settings['LANGUAGES']);

    define('MAINTENANCE', $settings['MAINTENANCE']);
    define('MAINTENANCE_IPS', $settings['MAINTENANCE_IPS']);

    define('EMAIL_SMTP', $settings['EMAIL_SMTP']);
    define('EMAIL_HOST', $settings['EMAIL_HOST']);
    define('EMAIL_FROM', $settings['EMAIL_FROM']);
    define('EMAIL_USER', $settings['EMAIL_USER']);
    define('EMAIL_PASS', $settings['EMAIL_PASS']);

    define('META_TITLE', $settings['META_TITLE']);
    define('META_EXTRA_TITLE', $settings['META_EXTRA_TITLE']);
    define('META_DESCRIPTION', $settings['META_DESCRIPTION']);
    define('META_KEYS', $settings['META_KEYS']);

    define('OG_TITLE', $settings['OG_TITLE']);
    define('OG_DESCRIPTION', $settings['OG_DESCRIPTION']);
    define('OG_SITE_NAME', $settings['OG_SITE_NAME']);
    define('OG_TYPE', $settings['OG_TYPE']);
    define('OG_URL', $settings['OG_URL']);
    define('OG_IMAGE', $settings['OG_IMAGE']);
    define('OG_APP_ID', $settings['OG_APP_ID']);

    define('FTP_UPLOAD_HOST', $settings['FTP_UPLOAD_HOST']);
    define('FTP_UPLOAD_USER', $settings['FTP_UPLOAD_USER']);
    define('FTP_UPLOAD_PASS', $settings['FTP_UPLOAD_PASS']);
    define('FTP_UPLOAD_SERVER_PATH', $settings['FTP_UPLOAD_SERVER_PATH']);

    define('URL', PROTOCOL.'://'.HOST);
    define('PUBLIC_PATH', $settings[ENVIRONMENT]['PUBLIC_PATH']);
    define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].PUBLIC_PATH);
    define('LANG_PATH', SERVER_PATH.'/app/langs');
    define('IMG_PATH', SERVER_PATH.'/img');
    define('EMAILS_PATH', SERVER_PATH.'/app/emails');
    define('VIEWS_ADMIN', SERVER_PATH.'/app/views/admin');
    define('ADMIN_PATH', PUBLIC_PATH.'/'.ADMIN_NAME);
    
    // Find out the language
    define('LANG', Utils::getLanguage());
    require_once LANG_PATH.'/'.LANG.'.php';

    // Declare public paths
    if(MULTILANGUAGE == true) {
        define('VIEWS_PUBLIC', SERVER_PATH.'/app/views/public/'.LANG);
        define('PUBLIC_ROUTE', PUBLIC_PATH.'/'.LANG);
        // I check that it has the views folder of the translation
        if(!file_exists(VIEWS_PUBLIC)) {
            Utils::error('The public directory of the language views <b>'.VIEWS_PUBLIC.'</b> does not exist.');
        }
    } else {
        define('VIEWS_PUBLIC', SERVER_PATH.'/app/views/public');
        define('PUBLIC_ROUTE', PUBLIC_PATH);
    }
    define('URL_ROUTE', URL.PUBLIC_ROUTE);
    
    Utils::initEnvironment();
    Utils::setThemeColor();

    // I start the route recognition process
    $R = new Route();
    require_once __DIR__.'/autoload-routes.php';
    define('ROUTES', $R->getRoutes('get'));
    $R->init();

?>