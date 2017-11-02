<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:07
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Réservations</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>
    <script src="../js/select.js"></script>
</head>
<body>
<?php include("menus.php");?>
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text">Liste D'utilisateurs</h1>
            <br><br>

        <form class="col s10" action="#" method="post">
                <?php
                require_once "../BLL/userManager.php";
                require_once "../DTO/user.php";
                $userManager = new UserManager();
                $entryUser = $userManager->getUsersById($_GET['userId']);
                ?>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" name="name" value="<?php echo $entryUser->getName()?>" required>
                        <label for="name">Nom</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="password" name="password" value="<?php echo $entryUser->getPassword()?>" required>
                        <label for="password">Mot de passe</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" name="mail" value="<?php echo $entryUser->getMail()?>" required>
                        <label for="mail">E-mail</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="phone" value="<?php echo $entryUser->getPhone()?>" required>
                        <label for="phone">Téléphone</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="roleId">
                            <?php
                            require_once "../BLL/roleManager.php";
                            $roleManager = new RoleManager();
                            $roles = $roleManager->getAllRole();
                            foreach ($roles as $role){
                                ?>
                                <option value="
                                <?php echo $role->getId(); ?>
                                "
                                <?php
                                    if($role->getId() == $entryUser->getRoleId()) {
                                        echo " selected";
                                    }
                                ?>
                                >
                                <?php echo $role->getName()?></option>
                                <?php 
                            }
                            ?>
                        </select>
                        <label>Rôle</label>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn waves-effect waves-light orange" type="submit" name="submit">Confirmer
                            <i class="material-icons right">person</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php

    if(isset($_POST['submit'])){
        $user = new User($_GET['userId'], $_POST['name'], $_POST['password'], $_POST['mail'], $_POST['phone'], $_POST['roleId']);
        $userManager->modifyUser($user);
    }
    ?>
</main>

<?php include("footer.php"); ?>
</body>
</html>

