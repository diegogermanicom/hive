<?php

    /*
     * Author: Diego Martin
     * Copyright: Hive®
     * Version: 1.0
     * Last Update: 2023
     */   

     class Model {
        
        public $db;
        public $sleep = 200000;
        public $months = [
            'es' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            'en' => ['January', 'February', 'March', 'Apri', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        ];
        public $week_days = [
            'es' => ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            'en' => ['Mondays', 'Tuesdays', 'Wednesdays', 'Thursdays', 'Fridays', 'Saturdays', 'Sundays']
        ];
        public $week_days_min = [
            'es' => ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá', 'Do'],
            'en' => ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
        ];

        function __construct() {
            global $DB;
            $this->db = $DB->db;
        }

        public function check_maintenance() {
            // Close the access to the web for maintenance
            if(MAINTENANCE == true && ROUTE != PUBLIC_ROUTE.'/service-down') {
                if(METHOD == 'get') {
                    header('Location: '.PUBLIC_ROUTE.'/service-down');
                    exit;
                } else {
                    return json_encode(array(
                        'response' => 'error',
                        'mensaje' => 'The website is under maintenance.'
                    ));
                }
            }
        }
        
        public function query($sql, $params = null) {
            // This function is created to avoid malicious sql injections
            $query = $this->db->prepare($sql);
            if($params != null) {
                $type = '';
                $types = array(
                    'integer' => 'i', 'double' => 'd',
                    'string' => 's', 'boolean' => 'b'
                );
                foreach($params as $value) {
                    if($value == NULL) {
                        $type .= 's';
                    } else if(isset($types[gettype($value)])) {
                        $type .= $types[gettype($value)];
                    }
                }    
                if(!@$query->bind_param($type, ...$params)) {
                    new Err(
                        LANGTXT['error-query-title'],
                        LANGTXT['error-query-description']
                    );
                }
            }
            $query->execute();
            return $query->get_result();    
        }

        public function get_ip() {
            // Returns the user's ip
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
                $ipaddress = 'desconocida';
            }
            return $ipaddress;
        }

        public function date_to_string($date) {
            $date = explode('-', $date);
            $str_date = intval($date[2]).' de '.$this->months[(intval($date[1]) - 1)].' de '.$date[0];
            return $str_date;
        }

        public function send_email($email, $titulo, $html, $reply = EMAIL_FROM) {
			// To use variables in emails the syntax is <%NAME%> in uppercase and then I do a replace
			$cabeceras = "From: ".EMAIL_HOST." <".EMAIL_FROM.">\r\n";
			$cabeceras .= "Reply-To: ".$reply."\r\n";
			$cabeceras .= "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
			$cabeceras .= "X-Mailer: PHP/".phpversion();
    	    mail($email, $titulo, $html, $cabeceras);
		}
        
    }
    
?>