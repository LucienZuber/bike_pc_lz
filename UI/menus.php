<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../BLL/userManager.php";
    include_once  "../BLL/changeLanguage.php";

    $userManager = new UserManager();
?>

<nav class="amber accent-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo"><i class="material-icons">train</i>Resabike</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="bookingAdd.php"><?php echo $lang['MENU_BOOK'];?></a></li>
            <?php
            if(isset($_SESSION['userId'])){
                $currentUser = $userManager->getUsersById($_SESSION['userId']);
                require_once "../BLL/roleManager.php";

                $roleManager = new RoleManager();


                switch($roleManager->getRoleById($currentUser->getRoleId())->getName()){
                    case 'superAdmin';
                    ?>
                        <li><a href="users.php"><?php echo $lang['MENU_MANAGE_USERS'];?></a></li>
                        <li><a href="regions.php"><?php echo $lang['MENU_MANAGE_REGIONS'];?></a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                    ?>
                        <li><a href="bookings.php"><?php echo $lang['MENU_BOOKINGS'];?></a></li>
                    <?php
                    default:
                        ?>
                        <li><a href="logout.php"><?php echo $lang['LOGOUT'];?></a></li>
                        <li><?php echo $currentUser->getName() ?></li>
                        <?php
                }
            }
            else{
            ?>
                <li><a href="login.php"><?php echo $lang['LOGIN'];?></a></li>
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
                        <li><a href="users.php"><?php echo $lang['MENU_MANAGE_USERS'];?></a></li>
                        <li><a href="regions.php"><?php echo $lang['MENU_MANAGE_REGIONS'];?></a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                        ?>
                        <li><a href="bookings.php"><?php echo $lang['MENU_BOOKINGS'];?></a></li>
                        <?php
                    default:
                    ?>
                        <li><a href="logout.php"><?php echo $lang['FOOTER_LANGUAGES'];?></a></li>
                        <li><?php echo $currentUser->getName() ?></li>
                        <?php
                }

            }
            else{
                ?>
                <li><a href="login.php"><?php echo $lang['LOGIN'];?></a></li>
                <?php
            }
            ?>
            <li><a href="bookingAdd.php"><?php echo $lang['MENU_BOOK'];?></a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>