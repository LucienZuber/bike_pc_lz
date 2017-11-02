<?php/**
* Created by PhpStorm.
* User: lucien
* Date: 01.11.2017
* Time: 10:24
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

</head>
<body>
<?php include("menus.php");?>
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text">Liste D'utilisateurs</h1>
            <br><br>

            <table class="striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../DTO/user.php";
                require_once "../DTO/role.php";
                require_once "../BLL/userManager.php";
                require_once "../BLL/roleManager.php";

                $userManager = new UserManager();
                $roleManager = new RoleManager();
                $users = $userManager->getAllUsers();
                foreach ($users as $user) {
                    $role = $roleManager->getRoleById($user->getRoleId());
                    ?>
                    <tr>
                        <td><?php echo $user->getName()?></td>
                        <td><?php echo $role->getName()?></td>
                        <td>
                            <a class="btn-floating orange" href="userDelete.php?userId=<?php echo $user->getId();?>"><i class="material-icons">create</i></a>
                            <a class="btn-floating orange" href="userDelete.php?userId=<?php echo $user->getId();?>"><i class="material-icons">remove</i></a>
                        </td>
                    </tr>
                <?php
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/datepicker.js"></script>
<script src="../js/timepicker.js"></script>
</body>
</html>
