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

    $routesPath = __DIR__.'/../routes';
    // I add routes that are prioritized in order
    $priorityRoutes = array();
    foreach($priorityRoutes as $value) {
        if(file_exists($value)) {
            require_once $value;
        } else {
            Utils::error('The priority route file you are trying to load <b>'.$value.'</b> does not exist.');
        }
    }
    // I add routes that I will not load
    $ignoreRoutes = array();
    // I automatically include each route from the routes folder recursively.
    $files = Utils::getPhpFiles($routesPath);
    $files = array_diff($files, array('.', '..'), $ignoreRoutes);
    foreach($files as $value) {
        $R->reset();
        require_once $value;
    }

?>