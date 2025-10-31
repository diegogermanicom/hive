<?php

    /**
     * Upload Ftp
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * 
     * Files:
     *  /js/ftp-upload.js
     *  /app/lib/ftp-upload.php
     *  /app/views/admin/ftp-upload-view.php
     * 
     * DISCLAIMER:
     * Modifying or altering any part of the code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     */

    class FtpUpload {

        public $conn;
        public $conn_success = false;
        public $banned_files = array(
            'ftp-upload-view.php',
            'ftp-upload.php',
            'ftp-upload.js',
        );

        function __destruct() {
            if($this->conn_success == true) {
                ftp_close($this->conn);
            }
        }

        /**
         * @return bool Returns true if the connection was successful
         */
        public function init() {
            if($this->connect()) {
                if($this->login()) {
                    return true;
                } else {
                    Utils::error('The Ftp Upload user or password is not correct.');
                }    
            } else {
                Utils::error('Ftp Upload could not connect to server.');
            }
        }

        /**
         * @return bool Returns true if the connection to the host was successful
         */
        private function connect() {
            if($this->conn = @ftp_connect(FTP_UPLOAD_HOST)) {
                $this->conn_success = true;
                return true;
            } else {
                $this->conn_success = false;
                return false;
            }
        }

        /**
         * @return bool Returns true if the login was successful
         */
        private function login() {
            if(@ftp_login($this->conn, FTP_UPLOAD_USER, FTP_UPLOAD_PASS)) {
                ftp_pasv($this->conn, true);
                return true;
             } else {
                return false;
             }
        }

        /**
         * @return array Returns ok if the entire process succeeds.
         */
        public function get_folder_html($folder = '') {
            // Impido que puedan bajar mas de la raiz
            $pos1 = strpos($folder, SERVER_PATH);
            $pos2 = strpos($folder, SERVER_PATH.'/..');
            if(($pos1 !== false && $pos2 === false) || $folder == '') {
                if($folder == '') {
                    $folder = SERVER_PATH;
                } else if(substr($folder, -3) == '/..') {
                    // Si son dos puntos bajo un nivel
                    $array_folder = explode('/', $folder);
                    $folder = '';
                    for($i = 0; $i < (count($array_folder) - 2); $i++) {
                        $folder .= $array_folder[$i].'/';
                    }
                    $folder = substr($folder, 0, -1);
                }
                // Si no existe el directorio da error
                if(!file_exists($folder)) {
                    Utils::error('The directory does not exist.');
                }
                // Obtengo el directorio del ftp relaccionado
                $dir = str_replace(SERVER_PATH, "", $folder);
                $dir = FTP_UPLOAD_SERVER_PATH.$dir.'/';
                if(!(@ftp_chdir($this->conn, $dir))) {
                    Utils::error('Could not switch to directory "'.$dir.'".');
                }
                list($array_folders, $array_files) = $this->separateFilesFolders($folder);
                // Obtengo la información de los ficheros del ftp
                $ftp_rawlist = ftp_rawlist($this->conn, '.');
                // Pintado del html del arbol
                $html = '<div class="folder" folder="'.$folder.'" server-folder="'.$dir.'"><i class="fas fa-folder-open"></i> '.$folder.'</div>';
                $html .= '<ul class="dir-list">';
                $html .= $this->drawFolders($array_folders, $ftp_rawlist);
                $html .= $this->drawFiles($array_files, $ftp_rawlist);
                $html .= '</ul>';
                return array(
                    'response' => 'ok',
                    'html' => $html
                );
            } else {
                Utils::error('Access denied.', 403);
            }
        }

        /**
         * @return array Remix two arrays containing the files and folders in the directory
         */
        private function separateFilesFolders($dir) {
            $array_dir = scandir($dir);
            $array_folders = array();
            $array_files = array();
            for($i = 0; $i < count($array_dir); $i++) {
                if(is_dir($dir.'/'.$array_dir[$i])) {
                    if($array_dir[$i] != '.') {
                        array_push($array_folders, $array_dir[$i]);                            
                    }
                } else {
                    if(!in_array($array_dir[$i], $this->banned_files)) {
                        $temp = array(
                            'name' => $array_dir[$i],
                            'size' => filesize($dir.'/'.$array_dir[$i])
                        );
                        array_push($array_files, $temp);
                    }
                }
            }            
            sort($array_folders);
            sort($array_files);
            return array($array_folders, $array_files);
        }

        /**
         * @return string Returns an HTML string with the list of folders
         */
        private function drawFolders($array_folders, $ftp_rawlist) {
            $html = '';
            for($i = 0; $i < count($array_folders); $i++) {
                $css_exist = ' no-existe';
                for($e = 0; $e < count($ftp_rawlist); $e++) {
                    $ftp_file_info = preg_split("/[\s]+/", $ftp_rawlist[$e], 9);
                    if($array_folders[$i] == $ftp_file_info['8'] || $array_folders[$i] == '..') {
                        $css_exist = '';
                    }
                }
                $html .= '<li class="ftp-dir'.$css_exist.'" name="'.$array_folders[$i].'" id-folder="'.$i.'"><i class="fas fa-folder"></i> '.$array_folders[$i].'</li>';
            }
            return $html;
        }

        /**
         * @return string Returns an HTML string with the list of files
         */
        private function drawFiles($array_file, $ftp_rawlist) {
            $html = '';
            for($i = 0; $i < count($array_file); $i++) {
                $ftp_size = 0;
                for($e = 0; $e < count($ftp_rawlist); $e++) {
                    $ftp_file_info = preg_split("/[\s]+/", $ftp_rawlist[$e], 9);
                    if($array_file[$i]['name'] == $ftp_file_info['8']) {
                        $ftp_size = $ftp_file_info['4'];
                    }
                }
                $sizeString = number_format($array_file[$i]['size'], 0, '.', '.');
                $css_size = '';
                // I compare the size of the FTP file with the development file size.
                if($ftp_size != $array_file[$i]['size']) {
                    $css_size = ' warning';
                }
                if($ftp_size == 0) {
                    $css_size = ' no-existe';
                }
                $html .= '<li class="ftp-file'.$css_size.'" id-file="'.$i.'">'.
                            '<div class="name" name="'.$array_file[$i]['name'].'"><i class="far fa-file"></i> '.$array_file[$i]['name'].'</div>'.
                            '<div class="size" size="'.$array_file[$i]['size'].'" ftp_size="'.$ftp_size.'">'.$sizeString.' bytes</div>'.
                        '</li>';
            }
            return $html;
        }

        /**
         * @return array Returns ok if the file has been uploaded successfully
         */
        public function upload_ftp($folder, $file) {
            $dir = str_replace(SERVER_PATH, "", $folder);
            $dir = FTP_UPLOAD_SERVER_PATH.$dir.'/';
            if(ftp_put($this->conn, $dir.$file, $folder.'/'.$file, FTP_BINARY)) {
                return array(
                    'response' => 'ok',
                    'message' => 'The file has been uploaded successfully.'
                );
            } else {
                Utils::error('Error saving file.');
            }
        }
        
        /**
         * @return array Returns ok if the files have been uploaded successfully
         */
        public function upload_all_ftp($folder, $files) {
            $dir = str_replace(SERVER_PATH, "", $folder);
            $dir = FTP_UPLOAD_SERVER_PATH.$dir.'/';
            $errors = 0;
            for($i = 0; $i < count($files); $i++) {
                if(!ftp_put($this->conn, $dir.$files[$i], $folder.'/'.$files[$i], FTP_BINARY)) {
                    $errors++;
                }
            }
            if($errors == 0) {
                return array(
                    'response' => 'ok',
                    'message' => 'The file has been uploaded successfully.'
                );
            } else {
                Utils::error('Error saving '.$errors.' files.');
            }
        }

        /**
         * @return array Returns ok if the folder is created correctly
         */
        public function create_folder($folder, $name) {
            $dir = str_replace(SERVER_PATH, "", $folder);
            $dir = FTP_UPLOAD_SERVER_PATH.$dir.'/';
            if(ftp_mkdir($this->conn, $dir.$name)) {
                return array(
                    'response' => 'ok',
                    'message' => 'The directory '.$name.' has been created successfully.'
                );
            } else {
                Utils::error('Error creating directory '.$name.'.');
            }
        }
        
        /**
         * @return array Returns the source code of the files
         */
        public function ftpCompare($folder, $file) {
            $file_server = fopen($folder.'/'.$file, 'r');
            $code_server = '';
            while(!feof($file_server)) {
                $line = fgets($file_server);
                $code_server .= $line;
            }
            $dir = str_replace(SERVER_PATH, "", $folder);
            $dir = FTP_UPLOAD_SERVER_PATH.$dir.'/';
            $temp = fopen('php://temp', 'r+');
            if(ftp_fget($this->conn, $temp, $dir.$file, FTP_BINARY)) {
                $code_ftp = '';
                fseek($temp, 0);
                while(!feof($temp)) {
                    $line = fgets($temp);
                    $code_ftp .= $line;
                }
                return array(
                    'response' => 'ok',
                    'code_server' =>  $code_server,
                    'code_ftp' => $code_ftp
                );
            } else {
                Utils::error('Error reading file '.$file.' from ftp.');
            }
        }
               
    }

?>