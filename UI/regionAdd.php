<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Import a Region</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
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
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header left deep-orange-text">Importer de nouvelles zones</h1>
        <br><br>
    </div>
</div>

<div>
    <form class="col s12" action="#" method="post">
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="departure" class="autocomplete recherche" required>
                <label for="departure">Départ</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="arrival" class="autocomplete recherche" required>
                <label for="arrival">Arrivée</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="region" required>
                <label for="region">Région</label>
            </div>
            <div class="input-field col s6">
                <select name="admin">
                    <option value="" disabled selected>Choisissez</option>
                    <?php
                    require_once "../BLL/userManager.php";
                    require_once "../BLL/roleManager.php";
                    $roleManager = new RoleManager();
                    $userManager = new UserManager();
                    foreach ($userManager->getAllUsersByRole($roleManager->getRoleByName('Admin')->getId()) as $row){
                        $id = $row->getId();
                        $name = $row->getName();
                        echo "<option value=\"$id\">$name</option>";
                    }
                    ?>
                </select>
                <label>Admin</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light orange" type="submit" name="submit">Valider
                    <i class="material-icons right">directions_subway</i>
                </button>
            </div>
        </div>
    </form>
</div>
<?php
require_once '../BLL/importManager.php';

const ACCEPTED_TRANSPORT_TYPE = array('post');

//once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
if(isset($_POST['submit'])){
    $import = new ImportManager();
    $import->read($_POST['departure'], $_POST['arrival'], $_POST['region'], $_POST['admin']);
}

?>
</main>
<?php include("footer.php"); ?>
<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../js/select.js"></script>
<script src="../js/autocompleteCFF.js"></script>
</body>
</html>