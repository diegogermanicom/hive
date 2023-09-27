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
                        <div class="title-container underline text-left" id="models">Models</div>
                            <div class="texto-container"><b>DDBB queries</b></div>
                            <div class="texto-container">To protect you from malicious injections in your queries, a function has been developed in the Model class to perform database queries safely.</div>
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/models/...
$sql = 'SELECT * FROM users_admin WHERE email = ? AND pass = ? LIMIT 1';
$result = $this->query($sql, array($email, $pass));</code></pre>
                            <div class="texto-container"><b>Get App data</b></div>
                            <div class="texto-container">Return the variables that you are going to use in several different views. As the name of the page, the default meta variables for SEO, the default Open Graph variables for RRSS...</div>
                            <pre class="animate animate-right"><code class="language-php">$data = $app->getAppData();</code></pre>
                            <pre class="animate animate-right"><code class="language-php">public function getAppData() {
    $data = array();
    $data['app'] = array(
        'name_page' => $this->name_page
    );
    $data['head'] = array(
        'application-name' => 'Hive',
        'author' => 'Diego Martín',
        'robots' => 'index, follow'
    );
    $data['meta'] = array('title' => META_TITLE, ... );
    $data['og'] = array('title' => OG_TITLE, ... );
    return $data;
}</code></pre>
                            <div class="texto-container"><b>Get user IP</b></div>
                            <pre class="animate animate-right"><code class="language-php">$app->get_ip();</code></pre>
                            <div class="texto-container"><b>Email sending function</b></div>
                            <pre class="animate animate-right"><code class="language-php">$app->send_email($email, $titulo, $html);</code></pre>
                            <div class="texto-container"><b>Controls access to logged users</b></div>
                            <pre class="animate animate-right"><code class="language-php">$app->security_app_login();</code></pre>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>