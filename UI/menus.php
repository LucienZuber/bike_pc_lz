<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../BLL/userManager.php";

    $userManager = new UserManager();
?>

<nav class="amber accent-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">Resabike</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="bookingAdd.php"><?php
                    require_once "../BLL/changeLanguage.php";
                    translate('book'); ?></a></li>
            <?php
            if(isset($_SESSION['userId'])){
                $currentUser = $userManager->getUsersById($_SESSION['userId']);
                require_once "../BLL/roleManager.php";

                $roleManager = new RoleManager();


                switch($roleManager->getRoleById($currentUser->getRoleId())->getName()){
                    case 'superAdmin';
                    ?>
                        <li><a href="users.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('manageUsers'); ?></a></li>
                        <li><a href="regions.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('manageRegions'); ?></a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                    ?>
                        <li><a href="bookings.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('bookings'); ?></a></li>
                    <?php
                    default:
                        ?>
                        <li><a href="logout.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('logout'); ?></a></li>
                        <li><?php echo $currentUser->getName() ?></li>
                        <?php
                }
            }
            else{
            ?>
                <li><a href="login.php"><?php
                        require_once "../BLL/changeLanguage.php";
                        translate('login'); ?></a></li>
            <?php
            }
            ?>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <?php
            if(isset($_SESSION['userId'])){
                $currentUser = $userManager->getUsersById($_SESSION['userId']);
                require_once "../BLL/roleManager.php";

                $roleManager = new RoleManager();

                switch($roleManager->getRoleById($currentUser->getRoleId())->getName()){
                    case 'superAdmin';
                        ?>
                        <li><a href="users.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('manageUsers'); ?></a></li>
                        <li><a href="regions.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('manageRegions'); ?></a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                        ?>
                        <li><a href="bookings.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('bookings'); ?></a></li>
                        <?php
                    default:
                    ?>
                        <li><a href="logout.php"><?php
                                require_once "../BLL/changeLanguage.php";
                                translate('logout'); ?></a></li>
                        <li><?php echo $currentUser->getName() ?></li>
                        <?php
                }

            }
            else{
                ?>
                <li><a href="login.php"><?php
                        require_once "../BLL/changeLanguage.php";
                        translate('login'); ?></a></li>
                <?php
            }
            ?>
            <li><a href="bookingAdd.php"><?php
                    require_once "../BLL/changeLanguage.php";
                    translate('book'); ?></a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>