<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    class Controller {

        private static function call($view, $data) {
            Utils::checkDefined('LANGTXT');
            // Call the view and finish the script
            if(strpos($view, '.php') === false) {
                $view .= '.php';
            }
            if(!file_exists($view)) {
                Utils::error(LANGTXT['error-view-description']);
            } else {
                include $view;
            }
            exit;
        }
    
        public static function view($view, $data) {
            Utils::checkDefined('VIEWS_PUBLIC');
            self::call(VIEWS_PUBLIC.$view, $data);
        }

        public static function viewAdmin($view, $data) {
            Utils::checkDefined('VIEWS_ADMIN');
            self::call(VIEWS_ADMIN.$view, $data);
        }

    }

?>