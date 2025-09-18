<?php

    /**
     * @author Diego Martín
     * @copyright Hive®
     * @version 1.0.1
     * @since 1.0.0
     */

    class AdminAjax extends AdminModel {

        public $name_page;

        function __construct($name_page = 'default-page') {
            parent::__construct();
            $this->name_page = $name_page;
        }

        public function create_new_sitemap() {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            foreach(LANGUAGES as $lang) {
                $xml .= '<sitemap>';
                $xml .=     '<loc>'.URL.'/sitemap-'.$lang.'.xml</loc>';
                $xml .=     '<lastmod>'.date('Y-m-d').'</lastmod>';
                $xml .= '</sitemap>';
                $xmlLang = '<?xml version="1.0" encoding="UTF-8"?>';
                $xmlLang .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                foreach(ROUTES as $alias) {
                    foreach($alias as $route) {
                        if($route['language'] == $lang && $route['index'] == true) {
                            $xmlLang .= '<url>';
                            $xmlLang .=     '<loc>'.URL.$route['route'].'</loc>';
                            $xmlLang .=     '<lastmod>'.date('Y-m-d').'</lastmod>';
                            $xmlLang .=     '<changefreq>monthly</changefreq>';
                            $xmlLang .=     '<priority>1</priority>';
                            $xmlLang .= '</url>';    
                        }
                    }
                }
                $xmlLang .= '</urlset>';
                $file = 'sitemap-'.$lang.'.xml';
                $result = file_put_contents(SERVER_PATH.'/'.$file, $xmlLang);
                if($result === false) {
                    return array(
                        'response' => 'error',
                        'title' => 'Error!',
                        'message' => 'An error occurred while saving the file '.$file.'.'
                    );        
                }
            }
            $xml .= '</sitemapindex>';
            $result = file_put_contents(SERVER_PATH.'/sitemap-index.xml', $xml);
            if($result === false) {
                return array(
                    'response' => 'error',
                    'title' => 'Error!',
                    'message' => 'An error occurred while saving the file <b>sitemap-index.xml</b>.'
                );        
            }
            return array(
                'response' => 'ok',
                'title' => 'Error!',
                'message' => 'The sitemap files have been created successfully.'
            );
        }

    }

?>