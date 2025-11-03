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

    class Ddbb {

        public $db = null;
        private $prefix;

        function __construct($host, $user, $pass, $ddbb, $prefix) {
            $this->prefix = $prefix;
            if(HAS_DDBB == true) {
                $this->db = @new mysqli($host, $user, $pass, $ddbb);
                if($this->db->connect_errno) {
                    Utils::error('An error occurred while connecting to the database. Please check your connection credentials and domain.',  403);
                } else {
                    $this->db->set_charset("utf8");
                }
            }
        }

        function __destruct() {
            if(HAS_DDBB == true) {
                $this->db->close();
            }
        }

        /**
         * @return string Returns the query with the table prefix added
         */
        private function prefixTables($sql) {
            if($this->prefix != '') {
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
                    $replaceString = $keyword.' '.$this->prefix;
                    $sql = str_replace($keyword.' ', $replaceString, $sql);
                }
            }
            return $sql;
        }

        /**
         * @return mysqli_result|false Returns false if it fails or a mysqli_result object
         */
        public function query($sql, $params = null) {
            if(HAS_DDBB == true) {
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
                        Utils::error('An error has occurred when performing the query to the database, check the parameters.');
                    }
                }
                $query->execute();
                return $query->get_result();
            } else {
                Utils::error('You do not have access to the database.', 503);
            }
        }

    }

?>