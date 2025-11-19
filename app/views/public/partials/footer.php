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
<footer>
    <?php if(MULTILANGUAGE == true && isset($data['routes'])) { ?>
    <div class="pb-15 animate animate-opacity text-center">
        <label>Choose your language</label>
        <?php
            $html = '<select id="select-choose-language">';
            foreach($data['routes'] as $value) {
                if(in_array($value['language'], LANGUAGES)) {
                    $selected = '';
                    if($value['language'] == LANG) {
                        $selected = ' selected';
                    }
                    $html .= '<option value="'.$value['language'].'" route="'.$value['route'].'"'.$selected.'>'.$value['language'].'</option>';
                }
            }
            $html .= '</select>';
            echo $html;
        ?>
    </div>
    <?php } ?>
    <div class="text-center font-14">Published under <a href="https://opensource.org/licenses/MIT" target="_blank">MIT</a> license.</div>
    <div class="text-center font-14 pt-5">Copyright © <?= date('Y'); ?> <b class="core-color">Hive</b> Framework - <a href="<?= Route::getAlias('privacy-policy'); ?>">Privacy policy</a> - <a href="<?= Route::getAlias('cookie-policy'); ?>">Cookie policy</a></div>
</footer>