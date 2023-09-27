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
                            <div class="title-container underline text-left" id="architecture">Architecture</div>
                            <div class="texto-container">With a simple route editor and a dynamic view manager you can easily and quickly manage access to your application. Start with these 4 simple steps.</div>
                            <div class="texto-container">1. Enter the <b>route</b> you want to capture inside the method you want it to receive:</div>                
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/config/routes.php
$R->get('/home', 'CApp#home');</code></pre>
                            <div class="texto-container">2. Bind the route with a function of a <b>controller</b>:</div>                
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/controllers/c-app.php
public function home($args) {
    $app = new App('home-page');
    $data = $app->getAppData();
    $data['user'] = $app->getUserData($_GET['id_user']);
    $this->view('/home', $data);
}</code></pre>
                            <div class="texto-container">3. Use a <b>model</b> class to develop your code:</div>                
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/models/app.php
public function getUserData($id_user) {
    $sql = 'SELECT * FROM users WHERE id_user = ? LIMIT 1';
    $result = $this->query($sql, array($id_user));
    return $result->fetch_assoc();
}</code></pre>
                            <div class="texto-container">4. Bind the call to a <b>view</b> in the controller:</div>                
                            <pre class="animate animate-right"><code class="language-php">&lt;!-- File: hive/app/views/public/home.php --&gt;
&lt;body id="&lt;?= $data['app']['name_page']; ?>">
    &lt;div>Email: &lt;?= $data['user']['email']; ?>&lt;/div>
&lt;/body></code></pre>
                            <div class="texto-container"><b>Plantilla HTML</b></div>
                            <div class="texto-container">To create views you have a html template found in <b>hive/app/views/public/_template.php</b>.</div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>