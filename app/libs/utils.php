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

    class Utils {

        public const ONEYEAR = (24 * 60 * 60 * 365);
        public const ONEMONTH = (24 * 60 * 60 * 30);
        public const ONEWEEK = (24 * 60 * 60 * 7);
        public const IDDISABLE = 1;
        public const IDACTIVE = 2;

        /**
         * @return bool Returns true if the domain is valid
         */
        public static function validateDomain($dominio) {
            $result = preg_match('/^(?!\-)(?:[a-zA-Z0-9\-]{1,60}\.)+[a-zA-Z]{2,20}$/', $dominio);
            return $result;
        }

        /**
         * @return bool Returns true if the slug is valid
         */
        public static function validateSlug($slug) {
            $result = preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug);
            return $result;
        }

        /**
         * @return bool Returns true if the path is valid
         */
        public static function validateRelativePath($path) {
            $result = preg_match('#^/?[a-zA-Z0-9/_-]+$#', $path);
            return $result;
        }

        /**
         * @return bool Returns true if the ISO language is valid
         */
        public static function validateISOLanguage($language) {
            $result = preg_match('/^[a-zA-Z]{2}$/', $language);
            return $result;
        }

        public static function error($message, $code = 500) {
            if(METHOD == 'get') {
                self::errorGet($message, $code);
            } else {
                self::errorPost($message, $code);
            }
        }

        private static function errorGet($message, $code = 500) {
            $html = '<html>';
            $html .=    '<head>';
            $html .=        '<title>Error | '.$code.'</title>';
            $html .=        '<meta charset="UTF-8">';
            $html .=        '<meta name="viewport" content="width=device-width, initial-scale=1">';
            $html .=        '<style>';
            $html .=            'body {';
            $html .=                'font-size: 18px; font-family: arial; color: #494949; padding: 20px 20px 20px 20px;';
            $html .=            '}';
            $html .=            'div.content {';
            $html .=                'max-width: 800px; background-color: #e7e7e7; border: 2px solid #c7c7c7; padding: 40px 50px 40px 50px; margin: auto auto;';
            $html .=            '}';
            $html .=            'div.title {';
            $html .=                'font-size: 22px; border-bottom: 2px solid #c7c7c7; padding-bottom: 10px; margin-bottom: 20px;';
            $html .=            '}';
            $html .=        '</style>';
            $html .=    '</head>';
            $html .=    '<body>';
            $html .=        '<div class="content">';
            $html .=            '<div class="title"><b>An error has occurred</b></div>';
            $html .=            '<div>'.$message.'</div>';
            $html .=            '<div style="padding-top: 40px;">';
            $html .=                '<button onclick="window.history.back()">Return to the previous page</button>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</body>';
            $html .= '</html>';
            echo $html;
            exit;
        }
        
        private static function errorPost($message, $code = 500) {
            http_response_code($code);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array(
                'response' => 'error',
                'code' => $code,
                'message' => $message
            ));
            exit;
        }

        public static function debug($var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
            exit;
        }

        /**
         * @return mysqli_result|false Returns false if it fails or a mysqli_result object
         */
        public static function query($sql, $params = null) {
            if(HAS_DDBB == true) {
                global $Ddbb;
                return $Ddbb->query($sql, $params);
            } else {
                self::error('To make a query you must have access to the database.');
            }
        }

        public static function errorLog($message) {
            if(HAS_DDBB == true) {
                $sql = 'INSERT INTO error_log (message) VALUES (?)';
                self::query($sql, array($message));
            } else {
                self::error('To save a record in the log you must have access to the database.');
            }
        }

        public static function getPhpFiles($path, $phpFiles = array()) {
            $files = scandir($path);
            $files = array_diff($files, array('.', '..'));
            foreach($files as $file) {
                $fullPath = $path.'/'.$file;
                if(is_dir($fullPath)) {
                    $phpFiles = self::getPhpFiles($fullPath, $phpFiles);
                } else {
                    array_push($phpFiles, $fullPath);
                }
            }
            return $phpFiles;
        }

        public static function settingsValidator($settings) {
            // I verify that all configuration values ​​exist
            $arraySettingVars = array(
                'APP_NAME', 'ADMIN_NAME', 'HOST_DEV', 'HOST_PRO', 'LANGUAGE', 'MULTILANGUAGE', 'LANGUAGES', 'HAS_DDBB',
                'DDBB_PREFIX', 'MAINTENANCE', 'MAINTENANCE_IPS', 'EMAIL_HOST', 'EMAIL_FROM', 'META_TITLE', 'META_EXTRA_TITLE',
                'META_DESCRIPTION', 'META_KEYS', 'OG_TITLE', 'OG_DESCRIPTION', 'OG_SITE_NAME', 'OG_TYPE', 'OG_URL', 'OG_IMAGE',
                'OG_APP_ID', 'DEV', 'PRO', 'FTP_UPLOAD_HOST', 'FTP_UPLOAD_USER', 'FTP_UPLOAD_PASS', 'FTP_UPLOAD_SERVER_PATH'
            );
            foreach($arraySettingVars as $var) {
                if(!isset($settings[$var])) {
                    self::error('The configuration value '.$var.' does not exist.');
                }
            }
            $arrayEnviromentVars = array(
                'PROTOCOL', 'PUBLIC_PATH', 'DDBB_HOST', 'DDBB_USER', 'DDBB_PASS', 'DDBB'
            );
            foreach($arrayEnviromentVars as $var) {
                if(!(isset($settings['DEV'][$var]))) {
                    self::error('The development enviroment configuration value '.$var.' does not exist.');
                }
            }
            foreach($arrayEnviromentVars as $var) {
                if(!(isset($settings['PRO'][$var]))) {
                    self::error('The production enviroment configuration value '.$var.' does not exist.');
                }
            }
            // I check that the values ​​are correct
            if(!self::validateSlug($settings['APP_NAME'])) {
                self::error('The value of the <b>APP_NAME</b> constant is incorrect. Must be a valid slug.');
            }
            if(!self::validateSlug($settings['ADMIN_NAME'])) {
                self::error('The value of the <b>ADMIN_NAME</b> constant is incorrect. Must be a valid slug.');
            }
            if($settings['HOST_DEV'] != '' && !self::validateDomain($settings['HOST_DEV'])) {
                self::error('The value of the <b>HOST_DEV</b> constant is incorrect. Must be a valid domain.');
            }
            if($settings['HOST_PRO'] != '' && !self::validateDomain($settings['HOST_PRO'])) {
                self::error('The value of the <b>HOST_PRO</b> constant is incorrect. Must be a valid domain.');
            }
            if(!self::validateISOLanguage($settings['LANGUAGE'])) {
                self::error('The value of the <b>LANGUAGE</b> constant is incorrect. Must be a valid ISO language value');
            }
            if(!is_bool($settings['MULTILANGUAGE'])) {
                self::error('The value of the <b>MULTILANGUAGE</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_array($settings['LANGUAGES'])) {
                self::error('The value of the <b>LANGUAGES</b> constant is incorrect. It has to be a array variable.');
            }
            foreach($settings['LANGUAGES'] as $lang) {
                if(!self::validateISOLanguage($lang)) {
                    self::error('The value of the <b>LANGUAGE</b> constant is incorrect. Must be a valid ISO language value');
                }    
            }
            if(!is_bool($settings['HAS_DDBB'])) {
                self::error('The value of the <b>HAS_DDBB</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_string($settings['DDBB_PREFIX'])) {
                self::error('The value of the <b>DDBB_PREFIX</b> constant is incorrect. It has to be a string variable.');
            }
            if(!is_bool($settings['MAINTENANCE'])) {
                self::error('The value of the <b>MAINTENANCE</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_array($settings['MAINTENANCE_IPS'])) {
                self::error('The value of the <b>MAINTENANCE_IPS</b> constant is incorrect. It has to be a array variable.');
            }
            foreach($settings['MAINTENANCE_IPS'] as $ip) {
                if(!filter_var($ip, FILTER_VALIDATE_IP)) {
                    self::error('Invalid IP <b>'.$ip.'</b> in <b>MAINTENANCE_IPS</b> array.');
                }
            }
            if($settings['EMAIL_HOST'] != '' &&
                !self::validateDomain($settings['EMAIL_HOST']) &&
                !filter_var($settings['EMAIL_HOST'], FILTER_VALIDATE_IP)) {
                self::error('The value of the <b>EMAIL_HOST</b> constant is incorrect. Must be a valid host.');
            }
            if($settings['EMAIL_FROM'] != '' && !filter_var($settings['EMAIL_FROM'], FILTER_VALIDATE_EMAIL)) {
                self::error('The value of the <b>EMAIL_FROM</b> constant is incorrect. Must be a valid email.');
            }
            // Meta and Open Graph tags validation
            foreach(array(
                'META_TITLE', 'META_EXTRA_TITLE', 'META_DESCRIPTION', 'META_KEYS',
                'OG_TITLE', 'OG_DESCRIPTION', 'OG_SITE_NAME', 'OG_TYPE'
            ) as $value) {
                if(!is_string($settings[$value])) {
                    self::error('The value of the <b>'.$value.'</b> constant is incorrect. It has to be a string variable.');
                }    
            }
            if($settings['OG_URL'] != '' && !filter_var($settings['OG_URL'], FILTER_VALIDATE_URL)) {
                self::error('The value of the <b>OG_URL</b> constant is incorrect. Must be a valid url.');
            }
            if($settings['OG_IMAGE'] != '' && !filter_var($settings['OG_IMAGE'], FILTER_VALIDATE_URL)) {
                self::error('The value of the <b>OG_IMAGE</b> constant is incorrect. Must be a valid url.');
            }
            if(!is_numeric($settings['OG_APP_ID'])) {
                self::error('The value of the <b>OG_APP_ID</b> constant is incorrect. It has to be a numeric variable.');
            }
            // Environments validation
            foreach(array('DEV', 'PRO') as $value) {
                if(!in_array($settings[$value]['PROTOCOL'], array('http', 'https'))) {
                    self::error('The value of the <b>'.$value.' -> PROTOCOL</b> constant is incorrect. Must be a valid protocol (http or https).');
                }
                if($settings[$value]['PROTOCOL'] == 'http' && stripos(PROTOCOL, 'http') !== 0) {
                    self::error('The value of the <b>'.$value.' -> PROTOCOL</b> constant is incorrect. It must match the current domain.');
                }
                if($settings[$value]['PROTOCOL'] == 'https' && stripos(PROTOCOL, 'https') !== 0) {
                    self::error('The value of the <b>'.$value.' -> PROTOCOL</b> constant is incorrect. It must match the current domain.');
                }
                if($settings[$value]['PUBLIC_PATH'] == '/') {
                    self::error('To indicate the root directory, leave the <b>'.$value.' -> PUBLIC_PATH</b> field empty.');
                }
                if($settings[$value]['PUBLIC_PATH'] != '' && !self::validateRelativePath($settings[$value]['PUBLIC_PATH'])) {
                    self::error('The value of the <b>'.$value.' -> PUBLIC_PATH</b> constant is incorrect. Must be a valid relative path.');
                }
                if($settings['HAS_DDBB'] == true) {
                    if($settings[$value]['DDBB_HOST'] != 'localhost' &&
                        !self::validateDomain($settings['DDBB_HOST']) &&
                        !filter_var($settings['DDBB_HOST'], FILTER_VALIDATE_IP)) {
                        self::error('The value of the <b>'.$value.' -> DDBB_HOST</b> constant is incorrect. Must be a valid host.');
                    }
                    if(!is_string($settings[$value]['DDBB_USER'])) {
                        self::error('The value of the <b>'.$value.' -> DDBB_USER</b> constant is incorrect. It has to be a string variable.');
                    }
                    if(!is_string($settings[$value]['DDBB_PASS'])) {
                        self::error('The value of the <b>'.$value.' -> DDBB_PASS</b> constant is incorrect. It has to be a string variable.');
                    }
                    if(!is_string($settings[$value]['DDBB'])) {
                        self::error('The value of the <b>'.$value.' -> DDBB</b> constant is incorrect. It has to be a string variable.');
                    }
                }
            }
            // Ftp Upload validation
            if($settings['FTP_UPLOAD_HOST'] != '' &&
                !self::validateDomain($settings['FTP_UPLOAD_HOST']) &&
                !filter_var($settings['FTP_UPLOAD_HOST'], FILTER_VALIDATE_IP)) {
                self::error('The value of the <b>FTP_UPLOAD_HOST</b> constant is incorrect. Must be a valid host.');
            }
            if($settings['FTP_UPLOAD_USER'] != '' && !is_string($settings['FTP_UPLOAD_USER'])) {
                self::error('The value of the <b>FTP_UPLOAD_USER</b> constant is incorrect. Must be a valid relative path.');
            }
            if($settings['FTP_UPLOAD_PASS'] != '' && !is_string($settings['FTP_UPLOAD_PASS'])) {
                self::error('The value of the <b>FTP_UPLOAD_PASS</b> constant is incorrect. Must be a valid relative path.');
            }
            if($settings['FTP_UPLOAD_SERVER_PATH'] != '' && !self::validateRelativePath($settings['FTP_UPLOAD_SERVER_PATH'])) {
                self::error('The value of the <b>FTP_UPLOAD_SERVER_PATH</b> constant is incorrect. Must be a valid relative path.');
            }
        }

        public static function initEnvironment() {
            date_default_timezone_set('Europe/Madrid');
            ignore_user_abort(true);
            // Start user session
            session_name(APP_NAME);
            session_start();
        }

        /**
         * @return string Returns the environment in which the project is located
         */
        public static function getEnvironment($hostDev, $hostPro) {
            if(strpos(HOST, $hostDev) !== false && $hostDev != '') {
                error_reporting(E_ALL);
                ini_set('display_errors', '1');
                return 'DEV';
            } else if(strpos(HOST, $hostPro) !== false && $hostPro != '') {
                error_reporting(0);
                ini_set('display_errors', '0');
                return 'PRO';
            } else {
                self::error('Permission denied.', 403);
            }        
        }

        /**
         * @return string Returns the framework ISO language
         */
        public static function getLanguage() {
            if(MULTILANGUAGE == true) {
                // First I try to get the language from the route
                $lang = explode(PUBLIC_PATH.'/', ROUTE)[1];
                if(strpos($lang, '/') !== false) {
                    $lang = explode('/', $lang)[0];
                }
                // Second attempt to get the cookie value
                if(!in_array($lang, LANGUAGES) && isset($_COOKIE['lang'])) {
                    $lang = $_COOKIE['lang'];
                }
                // Third attempt to get the language value from the browser
                if(!in_array($lang, LANGUAGES) && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                }
                // Fourth attempt I give the value of the default language of the web
                if(!in_array($lang, LANGUAGES)) {
                    $lang = LANGUAGE;
                }
                // If the application is multilanguage and does not point to any language
                if(in_array(ROUTE, array(PUBLIC_PATH.'/', PUBLIC_PATH))) {
                    header('Location: '.PUBLIC_PATH.'/'.$lang);
                    exit;
                }
            } else {
                $lang = LANGUAGE;
            }
            // I check that the language text package file exists
            if(!file_exists(LANG_PATH.'/'.$lang.'.php')) {
                $lang = LANGUAGE;
                if(!file_exists(LANG_PATH.'/'.$lang.'.php')) {
                    self::error('The configuration file of the default language of the app does not exist. Check the <b>langs</b> folder.');
                }
            }
            // I declare the cookie
            self::initCookie('lang', $lang, self::ONEYEAR);
            return $lang;
        }

        public static function setThemeColor($colorTheme = null) {
            if($colorTheme != null) {
                $theme = $colorTheme;
            } else {
                if(isset($_COOKIE['color-mode'])) {
                    $theme = $_COOKIE['color-mode'];
                } else {
                    $theme = 'light-mode';
                }
            }
            // I check that it receives a valid value
            $validThemes = array('light-mode', 'dark-mode');
            if(!in_array($theme, $validThemes)) {
                $theme = 'light-mode';
            }
            // I declare the cookie
            self::initCookie('color-mode', $theme, self::ONEYEAR);
        }

        public static function initCookie($name, $value, $time) {
            setcookie($name, $value, [
                'expires' => time() + $time,
                'path' => PUBLIC_PATH.'/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            $_COOKIE[$name] = $value;
        }

        public static function killCookie($name) {
            setcookie($name, '', [
                'expires' => time() - 3600,
                'path' => PUBLIC_PATH . '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);            
        }

    }

?>