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

    class Controller {

        public $args = array();

        public function SetArguments($args) {
            $this->args = $args;
        }

        private static function call($view, $data) {
            // Call the view and finish the script
            if(strpos($view, '.php') === false) {
                $view .= '.php';
            }
            if(!file_exists($view)) {
                Utils::error('The view you are trying to display does not exist.');
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