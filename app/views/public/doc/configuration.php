<!DOCTYPE html>
<html lang="<?= LANG; ?>">
    <head>
        <?php include VIEWS_PUBLIC.'/head.php'; ?>
        <link href="<?= PUBLIC_PATH; ?>/css/vendor/prism.css" rel="stylesheet">
        <script src="<?= PUBLIC_PATH; ?>/js/vendor/prism.js"></script>
    </head>
    <body id="<?= $data['app']['name_page']; ?>" class="<?= $_COOKIE['color-mode']; ?>">
        <?php include VIEWS_PUBLIC.'/header-body.php'; ?>
        <div class="app">
            <?php include VIEWS_PUBLIC.'/header.php'; ?>
            <section>
                <div class="container container-lg">
                    <div class="row">
                        <div class="col-3 pr-20"><?php include 'menu-doc.php'; ?></div>
                        <div class="col-9">
                            <div class="title-container underline text-left" id="configuration">Configuration</div>
                            <div class="texto-container">Change the name of the project <b>(has to match the directory name)</b>:</div>
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/config/config.php
define('APP_NAME', 'custom_app_name');</code></pre>
                            <div class="texto-container">Customize access to your administration area by changing the route globally:</div>
                            <pre class="animate animate-right"><code class="language-php">define('ADMIN_NAME', 'custom_admin_name');</code></pre>
                            <div class="texto-container">Define a development and production domain to indicate the behavior of your application:</div>
                            <pre class="animate animate-right"><code class="language-php">define('HOST_DEV', 'nombredemitienda-dev.com');
define('HOST_PRO', 'nombredemitienda.com');</code></pre>
                            <div class="texto-container">Configure your app if it is multi-language:</div>
                            <pre class="animate animate-right"><code class="language-php">define('LANGUAGE', 'en');
define('MULTILANGUAGE', true);
define('LANGUAGES', array(LANGUAGE, 'es'));</code></pre>
                            <div class="texto-container">Indicates if your application makes use of a database:</div>
                            <pre class="animate animate-right"><code class="language-php">define('HAS_DDBB', true);</code></pre>
                            <div class="texto-container">Configure your access data to your development and production database:</div>
                            <pre class="animate animate-right"><code class="language-php">define('DDBB_HOST', 'localhost');
define('DDBB_USER', 'hive-user');
define('DDBB_PASS', 'Mysql-hive-1');
define('DDBB', 'hive');</code></pre>
                            <div class="texto-container">Indicates if your application is closed for maintenance in such a way that no one can access:</div>
                            <pre class="animate animate-right"><code class="language-php">define('MAINTENANCE', false);</code></pre>
                            <div class="texto-container">Configure the data of the email sending server:</div>
                            <pre class="animate animate-right"><code class="language-php">define('EMAIL_HOST', 'Hive Framework');
define('EMAIL_FROM', 'info@hiveframework.com');</code></pre>
                            <div class="texto-container">Indicates the default values of the meta tags for the SEO of the application:</div>
                            <pre class="animate animate-right"><code class="language-php">define('META_TITLE', 'Hive PHP Framework');
define('META_DESCRIPTION', 'Welcome to Hive, the fastest...');
define('META_KEYS', 'Hive, framework, php');</code></pre>
                            <div class="texto-container">Indicates the default values of the Open Graph tags for rrss:</div>
                            <pre class="animate animate-right"><code class="language-php">define('OG_TITLE', 'Hive PHP Framework');
define('OG_DESCRIPTION', 'Welcome to Hive, the fastest...');
define('OG_URL', 'http://hiveframework.com/home');
define('OG_IMAGE', 'http://hiveframework.com/img/hive-logo.png');</code></pre>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>