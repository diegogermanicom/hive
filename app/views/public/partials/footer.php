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
        <div class="text-center font-14 pt-5">Copyright © <?= date('Y'); ?> <b class="core-color">Hive</b> Framework - <a href="<?= PUBLIC_ROUTE; ?>/privacy-policy">Privacy policy</a> - <a href="<?= PUBLIC_ROUTE; ?>/cookie-policy">Cookie policy</a></div>
    </footer>