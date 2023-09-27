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
                            <div class="title-container underline text-left" id="routes">Routes</div>
                            <div class="texto-container"><b>Routes to controllers</b></div>
                            <div class="texto-container">The standard way to configure the routes of your project.</div>
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/config/routes.php
$R->get('/home', 'CApp#home');</code></pre>
                            <div class="texto-container"><b>Routes to functions</b></div>
                            <div class="texto-container">You can configure simple routes without needing to bind them to a controller, directly to a function.</div>
                            <pre class="animate animate-right"><code class="language-php">$R->get('/home', function($args) {
    $app = new App('home-page');
    $data = $app->getAppData();
    $data['meta']['title'] = $app->setTitle('Home');
    Controller::view('/home', $data);
});</code></pre>
                            <div class="texto-container"><b>Dynamic routes</b></div>
                            <div class="texto-container">You can pass values to the controller through the route to get SEO friendly links.</div>
                            <pre class="animate animate-right"><code class="language-php">// ROUTE = '/hive/public/producto/bicicleta/carretera'
$R->get('/producto/$cat/$attr', 'CApp#documentation');</code></pre>
                            <pre class="animate animate-right"><code class="language-php">// File: hive/app/controllers/c-app.php
public function show_product($args) {
    $data = array(
        'category' => $args['cat'] // bicicleta
        'attributes' => $args['attr'] // carretera
    );
}</code></pre>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>