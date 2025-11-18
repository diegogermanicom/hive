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

    $libsPath = __DIR__.'/../../libs';
     // I add classes that are prioritized in order
    $priorityLibs = array(
        $libsPath.'/utils.php'
    );
    foreach($priorityLibs as $value) {
        if(file_exists($value)) {
            require_once $value;
        } else {
            Utils::error('The priority library file you are trying to load <b>'.$value.'</b> does not exist.');
        }
    }
    // I add classes that I will not load
    $ignoreLibs = array();
    // I automatically include each library from the libs folder recursively.
    $files = Utils::getPhpFiles($libsPath);
    $files = array_diff($files, array('.', '..'), $ignoreLibs, $priorityLibs);
    foreach($files as $value) {
        require_once $value;
    }

?>