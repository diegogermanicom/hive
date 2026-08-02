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

    class Utils {

        public const ONEYEAR = (24 * 60 * 60 * 365);
        public const ONEMONTH = (24 * 60 * 60 * 30);
        public const ONEWEEK = (24 * 60 * 60 * 7);
        public const IDDISABLE = 1;
        public const IDACTIVE = 2;

        /**
         * @return bool Returns true if the domain is valid
         */
        public static function validateDomain(string $dominio) {
            $result = preg_match('/^(?!\-)(?:[a-zA-Z0-9\-]{1,60}\.)+[a-zA-Z]{2,20}$/', $dominio);
            return $result;
        }

        /**
         * @return bool Returns true if the slug is valid
         */
        public static function validateSlug(string $slug) {
            $result = preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug);
            return $result;
        }

        /**
         * @return bool Returns true if the path is valid
         */
        public static function validateRelativePath(string $path) {
            $result = preg_match('#^/?[a-zA-Z0-9/_-]+$#', $path);
            return $result;
        }

        /**
         * @return bool Returns true if the ISO language is valid
         */
        public static function validateISOLanguage(string$language) {
            $result = preg_match('/^[a-zA-Z]{2}$/', $language);
            return $result;
        }

        public static function error(string $message, int $code = 500): void {
            if(METHOD == 'get') {
                self::errorGet($message, $code);
            } else {
                self::errorPost($message, $code);
            }
        }

        private static function errorGet(string $message, int $code = 500): never {
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
        
        private static function errorPost(string $message, int $code = 500): never {
            http_response_code($code);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array(
                'response' => 'error',
                'code' => $code,
                'message' => $message
            ));
            exit;
        }

        public static function debug(string $var): never {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
            exit;
        }

        /**
         * @return mysqli_result|false Returns false if it fails or a mysqli_result object
         */
        public static function query(string $sql, array $params = []): mysqli_result|bool {
            if(!HAS_DDBB) {
                self::error('To make a query you must have access to the database.');
            }
            global $Ddbb;
            return $Ddbb->query($sql, $params);
        }

        public static function errorLog(string $message): void {
            if(!HAS_DDBB) {
                self::error('To save a record in the log you must have access to the database.');
            }
            $sql = 'INSERT INTO error_log (message) VALUES (?)';
            self::query($sql, array($message));
        }

        public static function getPhpFiles(string $path, array $phpFiles = []): array {
            $files = scandir($path);
            $files = array_diff($files, array('.', '..'));
            foreach($files as $file) {
                $fullPath = $path.'/'.$file;
                if(is_dir($fullPath)) {
                    $phpFiles = self::getPhpFiles($fullPath, $phpFiles);
                } elseif(pathinfo($fullPath, PATHINFO_EXTENSION) === 'php') {
                    $phpFiles[] = $fullPath;
                } else {
                    self::error('Unexpected file found: <b>'.$fullPath.'</b>. Only PHP files are allowed.');
                }
            }
            return $phpFiles;
        }

        public static function initEnvironment(): void {
            date_default_timezone_set('Europe/Madrid');
            ignore_user_abort(true);
            session_name(APP_NAME);
            session_start();
        }

        /**
         * @return string Returns the environment in which the project is located
         */
        public static function getEnvironment(string $hostDev, string $hostPro): string {
            if(strpos(HOST, $hostDev) !== false && $hostDev != '') {
                error_reporting(E_ALL);
                ini_set('display_errors', '1');
                return 'DEV';
            }
            if(strpos(HOST, $hostPro) !== false && $hostPro != '') {
                error_reporting(0);
                ini_set('display_errors', '0');
                return 'PRO';
            }
            self::error('Permission denied.', 403);
        }

        public static function protocolValidator(string $protocol): void {
            if($protocol != PROTOCOL) {
                self::error('The value of the <b>PROTOCOL</b> constant is incorrect. It must match the current domain.');
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

        public static function setThemeColor(string $colorTheme = ''): void {
            if($colorTheme != '') {
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

        public static function initCookie(string $name, int|string $value, int $time): void {
            setcookie($name, $value, [
                'expires' => time() + $time,
                'path' => PUBLIC_PATH.'/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            $_COOKIE[$name] = $value;
        }

        public static function killCookie(string $name): void {
            setcookie($name, '', [
                'expires' => time() - 3600,
                'path' => PUBLIC_PATH.'/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);            
        }

    }

?>