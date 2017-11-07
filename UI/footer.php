<?php
include_once '../BLL/changeLanguage.php';
?>
<footer class="page-footer deep-orange darken-4">
    <div class="container">
            <div class="men">
                <h5 class="white-text"><?php echo $lang[FOOTER_LANGUGAGES];?></h5>
                <ul>
                    <li><a class="white-text" href="?lang=default">English</a></li>
                    <li><a class="white-text" href="?lang=french">Français</a></li>
                    <li><a class="white-text" href="?lang=german">Deutsch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <?php echo $lang[FOOTER_CREDITS];?>
        </div>
    </div>
</footer>