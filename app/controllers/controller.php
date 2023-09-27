<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2022
     */

    class Controller {

        private static function call($view, $data) {
            // Call the view and finish the script
            if(strpos($view, '.php') === false) {
                $view .= '.php';
            }
            if(!file_exists($view)) {
                new Err(
                    LANGTXT['error-view-title'],
                    LANGTXT['error-view-description']                    
                );
            } else {
                include $view;
            }
            exit;
        }
    
        public static function view($view, $data) {
            self::call(VIEWS_PUBLIC.$view, $data);
        }

        public static function viewAdmin($view, $data) {
            self::call(VIEWS_ADMIN.$view, $data);
        }

    }

?>