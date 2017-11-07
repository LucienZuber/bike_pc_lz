<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['MENU_MANAGE_REGIONS'];?></title>

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
?>
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text"><?php echo $lang['MENU_MANAGE_REGIONS'];?></h1>
            <br><br>

            <table class="striped">
                <thead>
                <tr>
                    <th><?php echo $lang['NAME'];?></th>
                    <th><?php echo $lang['ADMIN'];?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../DTO/region.php";
                require_once "../DTO/user.php";
                require_once "../BLL/userManager.php";
                require_once "../BLL/regionManager.php";

                $regionManager = new RegionManager();
                $userManager = new UserManager();
                $regions = $regionManager->getAllRegion();
                foreach ($regions as $region){
                    ?>
                    <tr>
                        <td><?php echo $region->getName()?></td>
                        <td><?php echo $userManager->getUsersById($region->getAdminId())->getName()?></td>
                        <td>
                            <a class="btn-floating orange" href="regionUpdate.php?regionId=<?php echo $region->getId();?>"><i class="material-icons">create</i></a>
                            <a class="btn-floating orange" href="regionDelete.php?regionId=<?php echo $region->getId();?>"><i class="material-icons">remove</i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th><?php echo $lang['ADD_REGION'];?></th>
                    <th></th>
                    <th> <a class="btn-floating orange" href="regionAdd.php"><i class="material-icons">add</i></a></th>
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
