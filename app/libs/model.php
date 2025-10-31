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

     class Model {
        
        public $ddbb;
        public $db;
        public const SLEEP = 200000;
        public const MONTHS = array(
            'es' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            'en' => ['January', 'February', 'March', 'Apri', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        );
        public const MONTHSMIN = array(
            'es' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            'en' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        );
        public const WEEKDAYS = array(
            'es' => ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            'en' => ['Mondays', 'Tuesdays', 'Wednesdays', 'Thursdays', 'Fridays', 'Saturdays', 'Sundays']
        );
        public const WEEKDAYSMIN = array(
            'es' => ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá', 'Do'],
            'en' => ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
        );

        function __construct() {
            global $Ddbb;
            $this->ddbb = $Ddbb;
            $this->db = $Ddbb->db;
        }

        /**
         * @return bool Returns false if the IP address can access in maintenance mode
         */
        public function checkMaintenance() {
            // Close the access to the web for maintenance
            if(in_array($this->getIp(), MAINTENANCE_IPS)) {
                return false;
            }
            if(MAINTENANCE == true && ROUTE != Route::getAlias('service-down')) {
                if(METHOD == 'get') {
                    Route::redirect('service-down');
                } else {
                    Utils::error('The website is under maintenance.', 503);
                }
            }
        }

        /**
         * @return mysqli_result|false Returns false if it fails or a mysqli_result object
         */
        public function query($sql, $params = null) {
            return $this->ddbb->query($sql, $params);
        }

        /**
         * @return string Returns the user's IP address
         */
        public function getIp() {
            $ipaddress = '';
            if(isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if(isset($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = 'unknown';
            }
            return $ipaddress;
        }

        /**
         * @return string Returns the date in a nice format
         */
        public function dateToString($date) {
            $date = explode('-', $date);
            $str_date = '';
            if(LANG == 'es') {
                $str_date = intval($date[2]).' de '.self::MONTHS['es'][(intval($date[1]) - 1)].' de '.$date[0];
            } else if(LANG == 'en') {
                $str_date = self::MONTHS['en'][(intval($date[1]) - 1)].' '.intval($date[2]).', '.$date[0];
            }
            return $str_date;
        }

        public function sendEmail($email, $titulo, $html, $reply = EMAIL_FROM) {
			// To use variables in emails the syntax is <%NAME%> in uppercase and then I do a replace
			$cabeceras = "From: ".EMAIL_HOST." <".EMAIL_FROM.">\r\n";
			$cabeceras .= "Reply-To: ".$reply."\r\n";
			$cabeceras .= "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
			$cabeceras .= "X-Mailer: PHP/".phpversion().'\r\n';
    	    mail($email, $titulo, $html, $cabeceras);
		}
        
    }
    
?>