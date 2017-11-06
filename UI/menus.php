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
            <?php
            if(isset($_SESSION['userId'])){
                $currentUser = $userManager->getUsersById($_SESSION['userId']);
                require_once "../BLL/roleManager.php";

                $roleManager = new RoleManager();


                switch($roleManager->getRoleById($currentUser->getRoleId())->getName()){
                    case 'superAdmin';
                    ?>
                        <li><a href="users.php">Gestion d'utilisateurs</a></li>
                        <li><a href="regions.php">Gestion de régions</a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                    ?>
                        <li><a href="bookings.php">Réservations</a></li>
                        <li><a href="logout.php">Déconnection</a></li>
                    <?php
                }
            }
            else{
            ?>
                <li><a href="login.php">Connection</a></li>
            <?php
            }
            ?>
            <li><a href="bookingAdd.php">Réserver</a></li>
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
                        <li><a href="users.php">Gestion d'utilisateurs</a></li>
                        <li><a href="regions.php">Gestion de régions</a></li>
                        <?php
                    case 'admin';
                        ?>

                        <?php
                    case 'driver';
                        ?>
                        <li><a href="bookings.php">Réservations</a></li>
                        <li><a href="logout.php">Déconnection</a></li>
                        <?php
                }
            }
            else{
                ?>
                <li><a href="login.php">Connection</a></li>
                <?php
            }
            ?>
            <li><a href="bookingAdd.php">Réserver</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>