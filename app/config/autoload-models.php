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

    $modelsPath = __DIR__.'/../models';
     // I add classes that are prioritized in order
    $priorityModels = array(
        'app-model.php',
        'admin-model.php'
    );
    foreach($priorityModels as $value) {
        if(file_exists($modelsPath.'/'.$value)) {
            require_once $modelsPath.'/'.$value;
        } else {
            Utils::error('The priority model file you are trying to load <b>'.$value.'</b> does not exist.');
        }
    }
    // I add classes that I will not load
    $ignoreModels = array();
    // I automatically include each model
    $scandir = scandir($modelsPath);
    $files = array_diff($scandir, array('.', '..'), $ignoreModels, $priorityModels);
    foreach($files as $value) {
        require_once $modelsPath.'/'.$value;
    }

?>