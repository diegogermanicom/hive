<div id="menu-left" class="active">
    <div id="btn-hide-menu-left" class="active"><i class="fa-solid fa-angles-left"></i></div>
    <div id="btn-show-menu-left"><i class="fa-solid fa-angles-right"></i></div>
    <div class="content">
        <div class="text-center pt-40 pb-20">
            <a href="<?= ADMIN_PATH ?>/home"><img src="<?= PUBLIC_PATH.'/img/website-logo.png'; ?>" width="60" alt="Hive Framework"></a>
        </div>
        <nav>
            <a href="<?= ADMIN_PATH ?>/home"<?php if(in_array('home', $data['admin']['tags'])) echo ' class="active"'; ?>><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Home</a>
        </nav>
        <div class="separator"></div>
        <nav>
            <a href="<?= ADMIN_PATH ?>/sitemap"<?php if(in_array('sitemap', $data['admin']['tags'])) echo ' class="active"'; ?>><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;Sitemap</a>
            <?php if(ENVIRONMENT == 'DEV') { ?>
                <a href="<?= ADMIN_PATH ?>/ftp-upload"<?php if(in_array('ftp-upload', $data['admin']['tags'])) echo ' class="active"'; ?>><i class="fa-regular fa-file"></i>&nbsp;&nbsp;Ftp Upload</a>
            <?php } ?>
        </nav>
        <div class="separator"></div>
        <nav>
            <a href="<?= PUBLIC_ROUTE ?>/" target="_blank"><i class="fa-solid fa-desktop"></i>&nbsp;&nbsp;Public Home</a>
            <a href="<?= ADMIN_PATH ?>/logout"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>
        </nav>
    </div>
</div>