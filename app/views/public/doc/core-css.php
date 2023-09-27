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
                            <div class="title-container underline text-left" id="core-css">Core CSS</div>
                            <div class="texto-container">Basic class structure in html view.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;body id="name-page">
    &lt;div class="app"> &lt;!-- Fix overflow on mobiles --&gt;
        &lt;section> &lt;!-- Fill 100% width always --&gt;
            &lt;div class="container"> ... &lt;/div> &lt;!-- Has max-width --&gt;
        &lt;/section>
    &lt;/div>
&lt;/body></code></pre>
                            <div class="texto-container">Hive has a number of basic CSS classes so you can quickly structure your application templates. Take a look at the <b>hive/public/css/app.scss</b> file.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;section class="animate animate-top"> &lt;!-- Animations --&gt;
    &lt;div class="container pt-20"> &lt;!-- 20px padding top --&gt;
        &lt;div class="row mt-20"> &lt;!-- Grid system, 20px margin top --&gt;
            &lt;div class="col-4 col-md-3"> &lt;!-- Responsive cols --&gt;
                &lt;div class="btn btn-black">&lt;/div> &lt;!-- Button class --&gt;
            &lt;/div>
            &lt;div class="col-8 col-md-9 text-center"> &lt;!-- Text align --&gt;
                &lt;div class="hidden">&lt;/div> &lt;!-- Hide element --&gt;
            &lt;/div>
        &lt;/div>
    &lt;/div>
&lt;/section></code></pre>
                            <pre class="animate animate-right"><code class="language-html">&lt;div class="popup"> &lt;!-- Popup system --&gt;
    &lt;div class="content"> &lt;!-- Center content --&gt;
        &lt;div class="title">Data saved successfully&lt;/div> &lt;!-- Title --&gt;
        &lt;div class="text ">The user ...&lt;/div> &lt;!-- Text --&gt;
        &lt;div class="btn btn-popup-close">Accept&lt;/div> &lt;!-- Close class --&gt;
    &lt;/div>
&lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-html">&lt;div class="custom-list" style="height: 120px;"> &lt;!-- Custom List --&gt;
    &lt;div value="1">Yellow&lt;/div>
    &lt;div value="2">White&lt;/div>
&lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-html">&lt;div class="custom-tab"> &lt;!-- Custom Tabs --&gt;
    &lt;div class="menu">
        &lt;div id-tab="1">Categories&lt;/div>
        &lt;div id-tab="2">Attributes&lt;/div>
    &lt;/div>
    &lt;div class="content">
        &lt;div id-tab="1">...&lt;/div>
        &lt;div id-tab="2">...&lt;/div>
    &lt;/div>
&lt;/div></code></pre>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>