<footer class="page-footer deep-orange darken-4">
    <div class="container">
            <div class="men">
                <h5 class="white-text"><?php
                    require_once "../BLL/changeLanguage.php";
                    translate('languages'); ?></h5>
                <ul>
                    <li><a class="white-text" href="">English</a></li>
                    <li><a class="white-text" href="#!">Français</a></li>
                    <li><a class="white-text" href="#!">Deutsch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <?php
            require_once "../BLL/changeLanguage.php";
            translate('credits'); ?>
        </div>
    </div>
</footer>