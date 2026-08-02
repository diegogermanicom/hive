<?php

    class settingsValidator {

        public static function validate(array $settings): void {
            // I verify that all configuration values exist
            $arraySettingVars = array(
                'APP_NAME', 'ADMIN_NAME', 'HOST_DEV', 'HOST_PRO', 'LANGUAGE', 'MULTILANGUAGE', 'LANGUAGES',
                'HAS_DDBB', 'DDBB_PREFIX', 'MAINTENANCE', 'MAINTENANCE_IPS',
                'EMAIL_SMTP', 'EMAIL_HOST', 'EMAIL_FROM', 'EMAIL_USER', 'EMAIL_PASS',
                'META_TITLE', 'META_EXTRA_TITLE', 'META_DESCRIPTION', 'META_KEYS',
                'OG_TITLE', 'OG_DESCRIPTION', 'OG_SITE_NAME', 'OG_TYPE', 'OG_URL', 'OG_IMAGE', 'OG_APP_ID',
                'DEV', 'PRO', 'FTP_UPLOAD_HOST', 'FTP_UPLOAD_USER', 'FTP_UPLOAD_PASS', 'FTP_UPLOAD_SERVER_PATH'
            );
            foreach($arraySettingVars as $var) {
                if(!isset($settings[$var])) {
                    Utils::error('The configuration value '.$var.' does not exist.');
                }
            }
            $arrayEnviromentVars = array(
                'PROTOCOL', 'PUBLIC_PATH', 'DDBB_HOST', 'DDBB_USER', 'DDBB_PASS', 'DDBB'
            );
            foreach($arrayEnviromentVars as $var) {
                if(!(isset($settings['DEV'][$var]))) {
                    Utils::error('The development enviroment configuration value '.$var.' does not exist.');
                }
            }
            foreach($arrayEnviromentVars as $var) {
                if(!(isset($settings['PRO'][$var]))) {
                    Utils::error('The production enviroment configuration value '.$var.' does not exist.');
                }
            }
            // I check that the values are correct
            if(!Utils::validateSlug($settings['APP_NAME'])) {
                Utils::error('The value of the <b>APP_NAME</b> constant is incorrect. Must be a valid slug.');
            }
            if(!Utils::validateSlug($settings['ADMIN_NAME'])) {
                Utils::error('The value of the <b>ADMIN_NAME</b> constant is incorrect. Must be a valid slug.');
            }
            if($settings['HOST_DEV'] != 'localhost' && !Utils::validateDomain($settings['HOST_DEV'])) {
                Utils::error('The value of the <b>HOST_DEV</b> constant is incorrect. Must be a valid domain.');
            }
            if(!Utils::validateDomain($settings['HOST_PRO'])) {
                Utils::error('The value of the <b>HOST_PRO</b> constant is incorrect. Must be a valid domain.');
            }
            if(!Utils::validateISOLanguage($settings['LANGUAGE'])) {
                Utils::error('The value of the <b>LANGUAGE</b> constant is incorrect. Must be a valid ISO language value');
            }
            if(!is_bool($settings['MULTILANGUAGE'])) {
                Utils::error('The value of the <b>MULTILANGUAGE</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_array($settings['LANGUAGES'])) {
                Utils::error('The value of the <b>LANGUAGES</b> constant is incorrect. It has to be a array variable.');
            }
            foreach($settings['LANGUAGES'] as $lang) {
                if(!Utils::validateISOLanguage($lang)) {
                    Utils::error('The value of the <b>LANGUAGE</b> constant is incorrect. Must be a valid ISO language value');
                }    
            }
            if(!is_bool($settings['HAS_DDBB'])) {
                Utils::error('The value of the <b>HAS_DDBB</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_string($settings['DDBB_PREFIX'])) {
                Utils::error('The value of the <b>DDBB_PREFIX</b> constant is incorrect. It has to be a string variable.');
            }
            if(!is_bool($settings['MAINTENANCE'])) {
                Utils::error('The value of the <b>MAINTENANCE</b> constant is incorrect. It has to be a boolean variable.');
            }
            if(!is_array($settings['MAINTENANCE_IPS'])) {
                Utils::error('The value of the <b>MAINTENANCE_IPS</b> constant is incorrect. It has to be a array variable.');
            }
            foreach($settings['MAINTENANCE_IPS'] as $ip) {
                if(!filter_var($ip, FILTER_VALIDATE_IP)) {
                    Utils::error('Invalid IP <b>'.$ip.'</b> in <b>MAINTENANCE_IPS</b> array.');
                }
            }
            if(!is_bool($settings['EMAIL_SMTP'])) {
                Utils::error('The value of the <b>EMAIL_SMTP</b> constant is incorrect. It has to be a boolean variable.');
            }
            if($settings['EMAIL_HOST'] != '' &&
                !Utils::validateDomain($settings['EMAIL_HOST']) &&
                !filter_var($settings['EMAIL_HOST'], FILTER_VALIDATE_IP)) {
                Utils::error('The value of the <b>EMAIL_HOST</b> constant is incorrect. Must be a valid host.');
            }
            if($settings['EMAIL_FROM'] != '' && !filter_var($settings['EMAIL_FROM'], FILTER_VALIDATE_EMAIL)) {
                Utils::error('The value of the <b>EMAIL_FROM</b> constant is incorrect. Must be a valid email.');
            }
            // Meta and Open Graph tags validation
            foreach(array(
                'META_TITLE', 'META_EXTRA_TITLE', 'META_DESCRIPTION', 'META_KEYS',
                'OG_TITLE', 'OG_DESCRIPTION', 'OG_SITE_NAME', 'OG_TYPE'
            ) as $value) {
                if(!is_string($settings[$value])) {
                    Utils::error('The value of the <b>'.$value.'</b> constant is incorrect. It has to be a string variable.');
                }    
            }
            if($settings['OG_URL'] != '' && !filter_var($settings['OG_URL'], FILTER_VALIDATE_URL)) {
                Utils::error('The value of the <b>OG_URL</b> constant is incorrect. Must be a valid url.');
            }
            if($settings['OG_IMAGE'] != '' && !filter_var($settings['OG_IMAGE'], FILTER_VALIDATE_URL)) {
                Utils::error('The value of the <b>OG_IMAGE</b> constant is incorrect. Must be a valid url.');
            }
            if(!is_numeric($settings['OG_APP_ID'])) {
                Utils::error('The value of the <b>OG_APP_ID</b> constant is incorrect. It has to be a numeric variable.');
            }
            // Environments validation
            foreach(array('DEV', 'PRO') as $value) {
                if(!in_array($settings[$value]['PROTOCOL'], array('http', 'https'))) {
                    Utils::error('The value of the <b>'.$value.' -> PROTOCOL</b> constant is incorrect. Must be a valid protocol (http or https).');
                }
                if($settings[$value]['PUBLIC_PATH'] == '/') {
                    Utils::error('To indicate the root directory, leave the <b>'.$value.' -> PUBLIC_PATH</b> field empty.');
                }
                if($settings[$value]['PUBLIC_PATH'] != '' && !Utils::validateRelativePath($settings[$value]['PUBLIC_PATH'])) {
                    Utils::error('The value of the <b>'.$value.' -> PUBLIC_PATH</b> constant is incorrect. Must be a valid relative path.');
                }
                if($settings['HAS_DDBB'] == true) {
                    if($settings[$value]['DDBB_HOST'] != 'localhost' &&
                        !Utils::validateDomain($settings[$value]['DDBB_HOST']) &&
                        !filter_var($settings[$value]['DDBB_HOST'], FILTER_VALIDATE_IP)) {
                        Utils::error('The value of the <b>'.$value.' -> DDBB_HOST</b> constant is incorrect. Must be a valid host.');
                    }
                    if(!is_string($settings[$value]['DDBB_USER'])) {
                        Utils::error('The value of the <b>'.$value.' -> DDBB_USER</b> constant is incorrect. It has to be a string variable.');
                    }
                    if(!is_string($settings[$value]['DDBB_PASS'])) {
                        Utils::error('The value of the <b>'.$value.' -> DDBB_PASS</b> constant is incorrect. It has to be a string variable.');
                    }
                    if(!is_string($settings[$value]['DDBB'])) {
                        Utils::error('The value of the <b>'.$value.' -> DDBB</b> constant is incorrect. It has to be a string variable.');
                    }
                }
            }
            // Ftp Upload validation
            if($settings['FTP_UPLOAD_HOST'] != '' &&
                !Utils::validateDomain($settings['FTP_UPLOAD_HOST']) &&
                !filter_var($settings['FTP_UPLOAD_HOST'], FILTER_VALIDATE_IP)) {
                Utils::error('The value of the <b>FTP_UPLOAD_HOST</b> constant is incorrect. Must be a valid host.');
            }
            if($settings['FTP_UPLOAD_USER'] != '' && !is_string($settings['FTP_UPLOAD_USER'])) {
                Utils::error('The value of the <b>FTP_UPLOAD_USER</b> constant is incorrect. Must be a valid relative path.');
            }
            if($settings['FTP_UPLOAD_PASS'] != '' && !is_string($settings['FTP_UPLOAD_PASS'])) {
                Utils::error('The value of the <b>FTP_UPLOAD_PASS</b> constant is incorrect. Must be a valid relative path.');
            }
            if($settings['FTP_UPLOAD_SERVER_PATH'] != '' && !Utils::validateRelativePath($settings['FTP_UPLOAD_SERVER_PATH'])) {
                Utils::error('The value of the <b>FTP_UPLOAD_SERVER_PATH</b> constant is incorrect. Must be a valid relative path.');
            }
        }

    }

?>