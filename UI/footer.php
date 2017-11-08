<?php
include_once '../BLL/changeLanguage.php';

//This is the footer of our website

?>
<footer class="page-footer deep-orange darken-4">
    <div class="container">
            <div class="row">
                <div class="col l6 s12">
                <h5 class="white-text"><?php echo $lang['FOOTER_LANGUAGES'];?></h5>
                <ul>
                    <li><a class="white-text" href="?lang=en"><?php echo $lang['LANG_DEFAULT'];?></a></li>
                    <li><a class="white-text" href="?lang=fr"><?php echo $lang['LANG_FRENCH'];?></a></li>
                    <li><a class="white-text" href="?lang=de"><?php echo $lang['LANG_GERMAN'];?></a></li>
                </ul>
                </div>
            <div class="col l6 s12">
            <h5 class="white-text"><?php echo $lang['FOOTER_CONTACT'];?></h5>
                <p class="white-text"><?php echo $lang['FOOTER_CONTACT_TEXT'];?>
                    <a href="mailto:resabikepclz@gmail.com">resabikepclz@gmail.com</a>.</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <?php echo $lang['FOOTER_CREDITS'];?>
        </div>
    </div>
</footer>