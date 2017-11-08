<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";

//This page is used to display all users

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['MENU_MANAGE_USERS'];?></title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
<?php include("menus.php");

require_once "../BLL/userManager.php";
require_once "../BLL/roleManager.php";

$userManager = new UserManager();
$roleManager = new RoleManager();

$acceptedRoles = array();
array_push($acceptedRoles, 'superAdmin');

if(!isset($_SESSION['userId'])) {
    header('Location: '."/bike_pc_lz/UI/index.php");
}

$role = $roleManager->getRoleById($userManager->getUsersById(intval($_SESSION['userId']))->getRoleId());

if(!in_array($role->getName(), $acceptedRoles)){
    header('Location: '."/bike_pc_lz/UI/index.php");
}
?><main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text"><?php echo $lang['LIST_USERS'];?></h1>
            <br><br>

            <table class="striped">
                <thead>
                <tr>
                    <th><?php echo $lang['NAME'];?></th>
                    <th><?php echo $lang['ROLE'];?></th>
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
                            <a class="btn-floating orange" href="userUpdate.php?userId=<?php echo $user->getId();?>"><i class="material-icons">create</i></a>
                            <a class="btn-floating orange" href="userDelete.php?userId=<?php echo $user->getId();?>"><i class="material-icons">remove</i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <th><?php echo $lang['ADD_USER'];?></th>
                    <th></th>
                    <th> <a class="btn-floating orange" href="userAdd.php"><i class="material-icons">add</i></a></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/datepicker.js"></script>
<script src="../js/timepicker.js"></script>
</body>
</html>
