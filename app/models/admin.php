<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    class Admin extends AdminModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
            $this->login_remember();
        }

        public function getAdminData() {
            // Declare here the variables that you are going to use in several different views
            $data = array();
            $data['admin'] = array(
                'name_page' => $this->name_page
            );
            $data['meta'] = array(
                'title' => META_TITLE
            );
            return $data;
        }

        public function login_remember() {
			if(isset($_COOKIE["admin_remember"])) {
                if(!isset($_SESSION['admin'])) {
                    $sql = 'SELECT email, pass FROM '.DDBB_PREFIX.'users_admin WHERE remember_code = ? AND id_state = 2 LIMIT 1';
                    $result = $this->query($sql, array($_COOKIE['admin_remember']));
                    if($result->num_rows != 0) {
                        $row = $result->fetch_assoc();
                        $this->login($row['email'], $row['pass']);
                    } else {
                        Utils::killCookie('admin_remember');
                    }
                } else {
                    // If the remember code does not match it is because the user has been kicked out
                    $sql = 'SELECT id_admin FROM '.DDBB_PREFIX.'users_admin WHERE id_admin = ? AND remember_code = ? LIMIT 1';
                    $result = $this->query($sql, array($_SESSION['admin']['id_admin'], $_COOKIE["admin_remember"]));
                    if($result->num_rows == 0) {
                        $this->logout();
                        header('Location: '.ADMIN_PATH.'/');
                        exit;
                    }
                }
            }            
        }
        
        public function logout() {
            unset($_SESSION['admin']);
            Utils::killCookie('admin_remember');
        }

        public function getSitemapInfo() {
            $fileMain = SERVER_PATH.'/sitemap-index.xml';
            $html = '';
            if(file_exists($fileMain)) {
                $html .= '<div class="box box-green mb-20">';
                $html .=    '<div>The main sitemap <b>sitemap-index.xml</b> exists.</div>';
                $html .=    '<div>Last modified date: <b>'.date("Y-m-d", filemtime($fileMain)).'</b>.</div>';
                $html .=    '<div>Last access date: <b>'.date("Y-m-d", fileatime($fileMain)).'</b>.</div>';
                $html .= '</div>';
                // I check if the sitemap for each language exists
                foreach(LANGUAGES as $language) {
                    $fileLang = SERVER_PATH.'/sitemap-'.$language.'.xml';
                    if(file_exists($fileLang)) {
                        $html .= '<div class="box box-green mb-20">';
                        $html .=    '<div>The sitemap for the '.$language.' exists in the <b>sitemap-'.$language.'.xml</b> file.</div>';
                        $html .=    '<div>Last modified date: <b>'.date("Y-m-d", filemtime($fileLang)).'</b>.</div>';
                        $html .=    '<div>Last access date: <b>'.date("Y-m-d", fileatime($fileLang)).'</b>.</div>';
                        $html .= '</div>';
                    } else {
                        $html .= '<div class="box box-red mb-20">';
                        $html .=    '<div>The <b>sitemap-'.$language.'.xml</b> sitemap file for the language <b>'.$language.'</b> does not exist.</div>';
                        $html .= '</div>';
                    }
                }
                return $html;
            } else {
                $html .= '<div class="box box-red mb-20">';
                $html .=    '<div>The main sitemap <b>sitemap-index.xml</b> does not exist.</div>';
                $html .= '</div>';
                return $html;
            }
        }

    }

?>