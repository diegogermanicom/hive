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
                            <?php
                                if(isset($data['args']['cat'])) {
                                    echo '<div class="pb-20">';
                                    echo    '<div><b>Category:</b> '.$data['args']['cat'].'</div>';
                                    echo    '<div class="pt-5"><b>Attribute:</b> '.$data['args']['attr'].'</div>';
                                    echo '</div>';
                                }
                            ?>
                            <div class="title-container underline text-left" id="prologue">Prologue</div>
                            <div class="texto-container">Created by developer <b>Diego Martín</b>:<br><br>"It's fast, light and simple. Hive is based on the <i>model-view-controller</i> architecture pattern. Hive helps you create a basic structure for your project. It's perfect if you want to remove all the excess dependencies and useless code from the most popular frameworks and start programming your own project with freedom. It is also configured to support multi-language."</div>
                            <div class="title-container underline text-left pt-30" id="throw-errors">Throw errors</div>
                            <div class="texto-container">You can throw development errors with the Err class.</div>
                            <pre class="animate animate-right"><code class="language-php">new Err(
    'El nombre de usuario o la contraseña no son correctos.',
    'Comprueba las variables $user y $pass del modelo ftp-upload.'
);</code></pre>
                            <div class="title-container underline text-left pt-30" id="throw-errors">Translations</div>
                            <div class="texto-container">You can translate the messages of the application with this system. For a multilanguage application we recommend duplicating the project in another folder or domain.</div>
                            <pre class="animate animate-right"><code class="language-php">// hive/app/langs/en.php
return array('mensaje' => LANGTXT['user-admin-fail']);</code></pre>
                            <div class="title-container underline text-left pt-30" id="administrator">Administrator</div>
                            <div class="texto-container">Manage your application from the administrator that we include by default. You will need to import into your database the <b>users_admin</b> table found in the sql file <b>hive/app/database/users_admin.sql</b>.</div>
                            <div class="title-container underline text-left pt-30" id="ftp-ulpoad">Ftp Upload</div>
                            <div class="texto-container">Php library to compare development files with production to see which have been modified, added or deleted and directly upload files from the administrator.</div>
                            <pre class="animate animate-right"><code class="language-php">&lt;a href="&lt;?= ADMIN_PATH ?>/ftp-upload">Ftp Upload&lt;/a></code></pre>
                            <div class="title-container underline text-left pt-30" id="font-awesome">Font Awesome</div>
                            <div class="texto-container">Font Awesome is the Internet's icon library and toolkit, used by millions of designers, developers, and content creators.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;i class="fa-solid fa-house">&lt;/i></code></pre>
                            <div class="texto-container">Official website: <a href="https://fontawesome.com/" target="_blanck"><b>fontawesome.com</b></a></div>
                            <div class="title-container underline text-left pt-30" id="jquery">jQuery</div>
                            <div class="texto-container">jQuery is a fast, small, and feature-rich JavaScript library. It makes things like HTML document traversal and manipulation, event handling, animation, and Ajax much simpler with an easy-to-use API that works across a multitude of browsers.</div>
                            <pre class="animate animate-right"><code class="language-javascript">$(window).ready(function() {
    $("#btn-send-login").on("click", function() { ... });
});</code></pre>
                            <div class="texto-container">Official website: <a href="https://jquery.com/" target="_blanck"><b>jquery.com</b></a></div>
                            <div class="title-container underline text-left pt-30" id="slick-slider">Slick Slider</div>
                            <div class="texto-container">Create sliders easily with this javascript library. Depends on the jQuery library.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;div id="hive-slider-example">
    &lt;div>1. Create a Route&lt;/div>
    &lt;div>2. Bind it to a Controller&lt;/div>
    &lt;div>3. Play with a Model&lt;/div>
&lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-javascript">$('#hive-slider-example').slick({
    dots: true,
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1
});</code></pre>
                            <div class="texto-container">Official website: <a href="https://kenwheeler.github.io/slick/" target="_blanck"><b>kenwheeler.github.io/slick</b></a></div>
                            <div class="title-container underline text-left pt-30" id="slick-slider">Sortable</div>
                            <div class="texto-container">Create easy drag and drop elements. Depends on the jQuery library.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;div id="hive-sortable-example">
    &lt;div>Yellow&lt;/div>
    &lt;div>Black&lt;/div>
    &lt;div>Ornge&lt;/div>
&lt;/div></code></pre>
                            <pre class="animate animate-right"><code class="language-javascript">$('#hive-sortable-example').sortable({
    group: 'list',
    animation: 200,
    ghostClass: 'ghost'
});</code></pre>
                            <div class="texto-container">Official website: <a href="https://github.com/SortableJS/jquery-sortablejs" target="_blanck"><b>github.com/SortableJS/jquery-sortablejs</b></a></div>
                            <div class="title-container underline text-left pt-30" id="prism">Prism</div>
                            <div class="texto-container">Format html text to look like in a programming IDE. User <b><span>&</span>lt<span>;</span></b> for <b>&lt;</b> simbol inside &lt;code> tag.</div>
                            <pre class="animate animate-right"><code class="language-html">&lt;link href="&lt;?= PUBLIC_PATH; ?>/css/prism.css" rel="stylesheet">
&lt;script src="&lt;?= PUBLIC_PATH; ?>/js/prism.js">&lt;/script>
&lt;pre>&lt;code class="language-php"> ... &lt;/code>&lt;/pre></code></pre>
                            <div class="texto-container">Official website: <a href="https://prismjs.com/" target="_blanck"><b>prismjs.com</b></a></div>
                            <div class="title-container underline text-left pt-30" id="easter-egg"><i class="fa-solid fa-gift"></i> Easter Egg</div>
                            <div class="texto-container">We have a hidden surprise, will you be able to find it?</div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include VIEWS_PUBLIC.'/footer.php'; ?>
        </div>
    </body>
</html>