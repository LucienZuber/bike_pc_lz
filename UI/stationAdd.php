<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";

//This page is used to add a station

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['ADD_STATION'];?></title>

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
    header('Location: '."./index.php");
}

$role = $roleManager->getRoleById($userManager->getUsersById(intval($_SESSION['userId']))->getRoleId());

if(!in_array($role->getName(), $acceptedRoles)){
    header('Location: '."./index.php");
}
?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text"><?php echo $lang['IMPORT_STATION_REGION'];?></h1>
        <br><br>
        <form class="col s12" action="#" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="departure" class="autocomplete recherche" required>
                    <label for="departure"><?php echo $lang['START'];?></label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="arrival" class="autocomplete recherche" required>
                    <label for="arrival"><?php echo $lang['END'];?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                </div>
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['CONFIRM'];?>
                        <i class="material-icons right">directions_subway</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../BLL/importManager.php';
require_once '../BLL/regionManager.php';

const ACCEPTED_TRANSPORT_TYPE = array('post');

//once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
if(isset($_POST['submit'])){
    $import = new ImportManager();
    $regionManager = new RegionManager();
    $oldRegion = $regionManager->getRegionById($_GET['regionId']);
    $import->read($_POST['departure'], $_POST['arrival'], $oldRegion->getName(), $oldRegion->getAdminId());
    ?>
    <script type="text/javascript">
        window.location = "./regionUpdate.php?regionId=<?php echo $_GET['regionId'] ;?>";
    </script>
    <?php
}

?>
</main>
<?php include("footer.php"); ?>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/select.js"></script>
<script src="../js/autocompleteCFF.js"></script>
</body>
</html>