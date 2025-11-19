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

?>
<div id="back-top">
    <i class="fa-solid fa-circle-up"></i>
</div>
<div id="popup-loading" class="popup">
    <i class="fas fa-spinner fa-spin"></i>
</div>
<div id="popup-info" class="popup">
    <div class="content">
        <div class="title"></div>
        <div class="text"></div>
        <div>
            <div class="btn btn-black w-100 btn-popup-close">Continue</div>
        </div>                
    </div>
</div>
<div id="popup-cookies"<?php if(!(isset($_COOKIE["acepto_cookies"]))) echo ' class="active"'; ?>>
    <div class="content">
        <div>This website uses its own and third-party cookies to improve our services and show you advertising related to your preferences by analyzing your browsing habits. If you continue browsing the web, you consent to its use. You can obtain more information in our <a href="<?= Route::getAlias('privacy-policy'); ?>">Cookie Policy</a>.</div>
        <div class="text-center pt-20">
            <div id="btn-acepta-cookies" class="btn btn-black">Continue</div>
        </div>
    </div>
</div>
<header>
    <div class="logo-header">
        <img src="<?= PUBLIC_PATH.'/img/website-logo.png'; ?>" height="100%" alt="Hive Framework">
    </div>
    <ul class="menu animate animate-opacity">
        <li>
            <a href="<?= Route::getAlias('home'); ?>"><i class="fa-solid fa-house"></i> Home</a>
        </li>
        <li>
            <a href="<?= ADMIN_PATH; ?>"><i class="fa-solid fa-gear"></i> Administrator</a>
        </li>
    </ul>
    <div class="header-content-right">
        <label class="switch" id="btn-change-color-mode">
            <input type="checkbox" value="1"<?php if($_COOKIE["color-mode"] == 'dark-mode') echo ' checked'; ?>>
            <span class="slider round"></span>
        </label>
    </div>
</header>