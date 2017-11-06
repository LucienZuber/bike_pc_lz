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
    <script src="../js/displayUserRegion.js"></script>
</head>
<body>
<?php include("menus.php");

require_once "../BLL/userManager.php";
require_once "../BLL/roleManager.php";

$userManager = new UserManager();
$roleManager = new RoleManager();

$acceptedRoles = array();
array_push($acceptedRoles, 'superadmin');;

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
            <h1 class="header center deep-orange-text">Liste D'utilisateurs</h1>
            <br><br>

            <form class="col s12" action="#" method="post">
                <?php
                require_once "../BLL/regionManager.php";
                require_once "../DTO/region.php";
                $regionManager = new RegionManager();
                $entryRegion = $regionManager->getRegionById($_GET['regionId']);
                ?>
                <div class="row">
                    <div class="input-field col s4">
                        <input type="text" name="name" value="<?php echo $entryRegion->getName()?>" required>
                        <label for="name">Nom</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="admin" required>
                            <?php
                            require_once "../BLL/userManager.php";
                            require_once "../BLL/roleManager.php";
                            $userManager = new UserManager();
                            $roleManager = new RoleManager();
                            $users = $userManager->getAllUsersByRole($roleManager->getRoleByName('admin')->getId());
                            foreach ($users as $user){
                                ?>
                                <option value="<?php echo $user->getId(); ?>"
                                    <?php
                                    if($user->getId() == $entryRegion->getAdminId()) {
                                        echo " selected";
                                    }
                                    ?>
                                ><?php echo $user->getName()?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Rôle</label>
                    </div>
                    <div class="input-field col s4">
                        <button class="btn waves-effect waves-light orange" type="submit" name="submit">Confirmer
                            <i class="material-icons right">person</i>
                        </button>
                    </div>
                </div>
            </form>
            <table class="striped">
                <thead>
                <tr>
                    <th>Station</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../DTO/station.php";
                require_once "../BLL/stationManager.php";

                $stationManager = new StationManager();
                $stations = $stationManager->getAllStationsByRegion($entryRegion->getId());
                foreach ($stations as $station){
                    ?>
                    <tr>
                        <td><?php echo $station->getName()?></td>
                        <td>
                            <a class="btn-floating orange" href="stationDelete.php?stationId=<?php echo $station->getId();?>"><i class="material-icons">remove</i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th>Ajouter un trajet</th>
                    <th> <a class="btn-floating orange" href="stationAdd.php?regionId=<?php echo $entryRegion->getId();?>"><i class="material-icons">add</i></a></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php

    if(isset($_POST['submit'])){
        $region = new Region($_GET['regionId'], $_POST['name'], $_POST['admin']);
        $regionManager->updateRegion($region);
    }
    ?>
</main>

<?php include("footer.php"); ?>
</body>
</html>

