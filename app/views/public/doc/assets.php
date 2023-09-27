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
                            <div class="title-container underline text-left" id="assets">Assets</div>
                            <div class="texto-container"><b>Cookie Popup</b></div>
                            <div class="texto-container">Hive has implemented the cookie popup with its respective cookie to save the configuration chosen by the user.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;!-- File: hive/app/views/public/header.php --&gt;
&lt;div id="popup-cookies">
    &lt;div id="btn-acepta-cookies" class="btn btn-black">Aceptar&lt;/div>
&lt;/div></code></pre>
                            <div class="texto-container"><b>Info Popup</b></div>
                            <div class="texto-container">If you want to display an informative popup with a title and a message, you can use this element.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;!-- File: hive/app/views/public/header.php --&gt;
&lt;div id="popup-info"> ... &lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-javascript">show_info('Aviso', 'Los datos han sido guardados correctamente');</code></pre>
                            <div class="texto-container"><b>Loading Popup</b></div>
                            <div class="texto-container">If you want to show the user that your application is carrying out some load or process and they need to wait for it to finish, you can use this popup. While it is active, the user cannot interact with your application.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;!-- File: hive/app/views/public/header.php --&gt;
&lt;div id="popup-loading" class="popup">
    &lt;i class="fas fa-spinner fa-spin">&lt;/i>
&lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-javascript">$("#btn-save-user").on("click", function() {
    show_popup('#popup-loading');
});</code></pre>
                            <div class="texto-container"><b>Back To Top Button</b></div>
                            <div class="texto-container">At the bottom right of the screen you have a button that take the user to the top of the page when clicked on.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;!-- File: hive/app/views/public/header.php --&gt;
&lt;div id="back-top">
    &lt;i class="fa-solid fa-circle-up">&lt;/i>
&lt;/div></code></pre>
                            <div class="texto-container"><b>Tooltips</b></div>
                            <div class="texto-container">Lets you add tooltips to elements without JavaScript and in just a few lines of CSS.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;a data-balloon="Save user data" data-balloon-pos="down">Save&lt;/a>
&lt;a data-balloon="Cancel save" data-balloon-length="large">Cancel&lt;/a></code></pre>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>