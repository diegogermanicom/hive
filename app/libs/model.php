<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     * @see https://github.com/diegogermanicom/hive
     * @license MIT
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
            if(isset($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if(isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            }
            if(filter_var($ipaddress, FILTER_VALIDATE_IP)) {
                return trim($ipaddress);
            } else {
                return 'unknown';                
            }
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

        public function sendEmail($email, $name, $title, $html, $reply = EMAIL_FROM) {
            $html = str_replace("<%URL%>", URL, $html);
            $html = str_replace("<%URL_ROUTE%>", URL_ROUTE, $html);
            $html = str_replace("<%YEAR%>", date('Y'), $html);
            $html = str_replace("<%EMAIL_FROM%>", EMAIL_FROM, $html);
            $html = str_replace("<%URL_LEGAL%>", Route::getAlias('privacy-policy'), $html);
            if(EMAIL_SMTP == false) {
                $headers = "From: ".EMAIL_FROM." <".EMAIL_FROM.">\r\n";
                $headers .= "Reply-To: ".$reply."\r\n";
                //$headers .= "Cc: \r\n";
                //$headers .= "Bcc: \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "X-Mailer: PHP/".phpversion().'\r\n';
                // To use variables in emails the syntax is <%YEAR%> in uppercase and then I do a replace
                mail($email, $title, $html, $headers);    
            } else {
                require_once __DIR__.'/../vendor/phpmailer/PHPMailer.php';
                require_once __DIR__.'/../vendor/phpmailer/SMTP.php';
                $mail = new PHPMailer();
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;            //Enable verbose debug output
                $mail->isSMTP();
                $mail->Host       = EMAIL_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = EMAIL_USER;
                $mail->Password   = EMAIL_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
                $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                //Recipients
                $mail->setFrom(EMAIL_FROM, EMAIL_FROM);
                $mail->addAddress($email, $name);
                $mail->addReplyTo($reply, 'Reply');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $title;
                $mail->Body    = $html;
                $mail->AltBody = '';
                $mail->send();
            }
		}

        /**
         * @return array Returns the results for the selected page and pagination information
         */
        public function pager($result, $page = 1, $per_page = 20, $link = null) {
            $totalItems = $result->num_rows;
            if($totalItems > 0) {
                if($page < 1)  {
                    $page = 1;
                }
                if((($page - 1) * $per_page) > $totalItems) {
                    $result->data_seek((floor($totalItems / $per_page)) * $per_page);
                } else {
                    $result->data_seek(($page - 1) * $per_page);
                }
                $rows = array();
                $row_count = 1;
                while($row = $result->fetch_assoc()) {
                    array_push($rows, $row);
                    if($row_count == $per_page) {
                        break;
                    } else {
                        $row_count++;
                    }
                }
                // I check if the link is personalized
                if($link == null) {
                    $gets = '';
                    foreach($_GET as $index => $value) {
                        if($index != 'page' && $index != 'per_page') {
                            $gets .= $index.'='.$value.'&';
                        }
                    }
                    $link = ROUTE.'?'.$gets;
                } else {
                    if((substr_count($link, '?') == 0)) {
                        $link .= '?';
                    } else {
                        if(substr($link, -1) !== '?') {
                            $link .= '&';
                        }
                    }
                }
                // Total number of pages
                $total_pages = ceil($totalItems / $per_page);
                if($page > $total_pages) {
                    $page = $total_pages;
                }
                // Record range on current page and total
                $range_init = ((($page - 1) * $per_page) + 1);
                $range_max = ((($page - 1) * $per_page) + $per_page);
                if($range_max > $totalItems) {
                    $range_max = $totalItems;
                }
                $html = '<div class="pager-info pb-20">';
                $html .=    '<span>'.$range_init.'-'.$range_max.' of '.$totalItems.' items</span>';
                $html .= '</div>';
                // I paint the buttons
                $html .= '<div class="pager-pages">';
                if($page > 3) {
                    $html .= '<a href="'.$link.'page=1" class="btn btn-trans btn-sm"><i class="fa-solid fa-angles-left"></i></a>';
                }
                if($page > 1) {
                    $html .= '<a href="'.$link.'page='.($page - 1).'" class="btn btn-trans btn-sm"><i class="fa-solid fa-chevron-left"></i></a>';
                }
                $min = max(1, ($page - 2));
                $max = min($total_pages, ($page + 2));
                for($i = $min; $i <= $max; $i++) {
                    if($i == $page) {
                        $class = 'btn-black active';
                        $link_temp = '#';
                    } else {
                        $class = 'btn-white';
                        $link_temp = $link.'page='.$i;
                    }
                    $html .= '<a href="'.$link_temp.'" class="btn btn-sm '.$class.'">'.$i.'</a>';
                }
                if($page < ($total_pages - 1)) {
                    $html .= '<a href="'.$link.'page='.($page + 1).'" class="btn btn-trans btn-sm"><i class="fa-solid fa-angle-right"></i></a>';
                }
                if($page < ($total_pages - 2)) {
                    $html .= '<a href="'.$link.'page='.$total_pages.'" class="btn btn-trans btn-sm"><i class="fa-solid fa-angles-right"></i></a>';
                }
                $html .= '</div>';            
                return array(
                    'result' => $rows,
                    'pager' => $html
                );    
            } else {
                return array(
                    'result' => array(),
                    'pager' => ''
                );
            }
        }

        /**
         * @return array Returns the results for the selected page and pagination information
         */
        public function pagerAjax($result, $page = 1, $per_page = 20) {
            $totalItems = $result->num_rows;
            if($totalItems > 0) {
                if($page < 1)  {
                    $page = 1;
                }
                if((($page - 1) * $per_page) > $totalItems) {
                    $result->data_seek((floor($totalItems / $per_page)) * $per_page);
                } else {
                    $result->data_seek(($page - 1) * $per_page);
                }
                $rows = array();
                $row_count = 1;
                while($row = $result->fetch_assoc()) {
                    array_push($rows, $row);
                    if($row_count == $per_page) {
                        break;
                    } else {
                        $row_count++;
                    }
                }
                // Total number of pages
                $total_pages = ceil($totalItems / $per_page);
                if($page > $total_pages) {
                    $page = $total_pages;
                }
                // Record range on current page and total
                $range_init = ((($page - 1) * $per_page) + 1);
                $range_max = ((($page - 1) * $per_page) + $per_page);
                if($range_max > $totalItems) {
                    $range_max = $totalItems;
                }
                $html = '<div class="pager-info pb-20">';
                $html .=    '<span>'.$range_init.'-'.$range_max.' of '.$totalItems.' items</span>';
                $html .= '</div>';
                // I paint the buttons
                $html .= '<div class="pager-pages">';
                if($page > 3) {
                    $html .= '<div data-page="1" class="btn btn-trans btn-sm"><i class="fa-solid fa-angles-left"></i></div>';
                }
                if($page > 1) {
                    $html .= '<div data-page="'.($page - 1).'" class="btn btn-trans btn-sm"><i class="fa-solid fa-chevron-left"></i></div>';
                }
                $min = max(1, ($page - 2));
                $max = min($total_pages, ($page + 2));
                for($i = $min; $i <= $max; $i++) {
                    if($i == $page) {
                        $class = 'btn-black active';
                    } else {
                        $class = 'btn-white';
                    }
                    $html .= '<div data-page="'.$i.'" class="btn btn-sm '.$class.'">'.$i.'</div>';
                }
                if($page < $total_pages) {
                    $html .= '<div data-page="'.($page + 1).'" class="btn btn-trans btn-sm"><i class="fa-solid fa-angle-right"></i></div>';
                }
                if($page < ($total_pages - 2)) {
                    $html .= '<div data-page="'.$total_pages.'" class="btn btn-trans btn-sm"><i class="fa-solid fa-angles-right"></i></div>';
                }
                $html .= '</div>';
                return array(
                    'result' => $rows,
                    'pager' => $html
                );    
            } else {
                return array(
                    'result' => array(),
                    'pager' => ''
                );
            }
        }
        
    }
    
?>