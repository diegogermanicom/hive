<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * @return array Returns an array with all the controllers and their functions
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     */

    $controllersPath = __DIR__.'/../controllers';
    $classBefore = get_declared_classes();
    // I add files that are prioritized in order
    $priorityControllers = array();
    foreach($priorityControllers as $value) {
        if(file_exists($controllersPath.'/'.$value)) {
            require_once $controllersPath.'/'.$value;
        } else {
            Utils::error('The priority controller file you are trying to load <b>'.$value.'</b> does not exist.');
        }
    }
    // I add classes that I will not load
    $ignoreControllers = array();
    // I automatically include each controller
    $scandir = scandir($controllersPath);
    $files = array_diff($scandir, array('.', '..'), $ignoreControllers, $priorityControllers);
    foreach($files as $value) {
        require_once $controllersPath.'/'.$value;
    }
    // I save the name of all the created controllers
    $classAfter = get_declared_classes();
    $arrayControllers = array_values(array_diff($classAfter, $classBefore));
    // Now I save the functions of each controller
    foreach($arrayControllers as $index => $value) {
        $arrayControllers[$index] = array(
            'name' => $value,
            'functions' => get_class_methods($value)
        );
    }
    return $arrayControllers;

?>