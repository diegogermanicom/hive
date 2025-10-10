<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    class Ddbb {

        public $db = null;

        function __construct() {
            $this->connect();
        }

        function __destruct() {
            $this->disconnect();
        }

        public function connect() {
            if(HAS_DDBB == true) {
                $this->db = @new mysqli(DDBB_HOST, DDBB_USER, DDBB_PASS, DDBB);
                if($this->db->connect_errno) {
                    Utils::error('An error occurred while connecting to the database. Please check your connection credentials and domain.');
                } else {
                    $this->db->set_charset("utf8");
                }
            }
        }

        public function disconnect() {
            if(HAS_DDBB == true) {
                $this->db->close();
            }
        }

        public static function prefixTables($sql) {
            if(DDBB_PREFIX != '') {
                $keyWords = array(
                    'FROM',
                    'JOIN',
                    'INTO',
                    'UPDATE',
                    'DELETE FROM',
                    'CREATE TABLE',
                    'ALTER TABLE',
                    'DROP TABLE',
                    'TRUNCATE TABLE',
                    'RENAME TABLE',
                );
                foreach ($keyWords as $keyword) {
                    $replaceString = $keyword.' '.DDBB_PREFIX;
                    $sql = str_replace($keyword.' ', $replaceString, $sql);
                }
            }
            return $sql;
        }

        public function query($sql, $params = null) {
            $this->prefixTables($sql);
            // This function is created to avoid malicious sql injections
            $query = $this->db->prepare($sql);
            if($params != null) {
                $type = '';
                $types = array(
                    'integer'   => 'i',
                    'double'    => 'd',
                    'string'    => 's',
                    'boolean'   => 'b'
                );
                if(!is_array($params)) {
                    $params = array($params);
                }
                foreach($params as $value) {
                    if($value == NULL) {
                        $type .= 's';
                    } else if(isset($types[gettype($value)])) {
                        $type .= $types[gettype($value)];
                    }
                }    
                if(!@$query->bind_param($type, ...$params)) {
                    Utils::error(LANGTXT['error-query-description']);
                }
            }
            $query->execute();
            return $query->get_result();
        }

    }

?>