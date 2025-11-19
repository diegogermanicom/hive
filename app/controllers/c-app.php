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
     * Modifying or altering any part of the original code is not recommended,
     * as it could compromise the stability, security or operation of the system.
     * Any changes made will be the sole responsibility of the person who makes them.
     * You can add custom code to add new features.
     */

    class CApp extends Controller {

        public function root() {
            Route::redirect('home', $_GET);
        }

        public function home() {
            $app = new App('home-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Home');
            $data['head']['canonical'] .= '/home';
            self::view('/home', $data);
        }

        public function privacy_policy() {
            $app = new App('privacy-policy-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Privacy Policy');
            $data['meta']['description'] = 'Find out about our privacy policies to make good use of our application.';
            $data['meta']['keywords'] .= ', privacy policy, legal';
            $data['head']['canonical'] .= '/privacy-policy';
            self::view('/privacy-policy', $data);
        }

        public function cookie_policy() {
            $app = new App('cookie-policy-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Cookie Policy');
            $data['meta']['description'] = 'Find out about our cookie policies to make good use of our application.';
            $data['meta']['keywords'] .= ', cookies, cookies policy';
            $data['head']['canonical'] .= '/cookie-policy';
            self::view('/cookie-policy', $data);
        }

        public function service_down() {
            $app = new App('service-down-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('Service Down');
            $data['meta']['description'] = 'We are making improvements to our app. In a very short time we will be back.';
            $data['meta']['keywords'] .= ', service, down';
            $data['head']['canonical'] .= '/service-down';
            if($this->args['_index'] == false) {
                $data['head']['robots'] = 'noindex, noimageindex, nofollow';
            }
            self::view('/service-down', $data);
        }

        public function page_404() {
            $app = new App('404-page');
            $data = $app->getAppData();
            $data['meta']['title'] = $app->setTitle('404');
            $data['meta']['description'] = 'If you have come this far, it is because we do not have the page you are looking for.';
            $data['meta']['keywords'] .= ', 404, not found, missing';
            $data['head']['canonical'] .= '/page-404';
            if($this->args['_index'] == false) {
                $data['head']['robots'] = 'noindex, noimageindex, follow';
            }
            self::view('/page-404', $data);
        }

        public function logout() {
            $app = new App();
            $app->security_app_login();
            $app->logout();
            Route::redirect('home', array(
                'logout' => 'true'
            ));
        }

    }

?>