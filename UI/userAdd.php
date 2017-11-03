<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Add a User</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--Scripts-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>
    <script src="../js/select.js"></script>
    <script src="../js/displayUserRegion.js"></script>
</head>
<body>
<?php include("menus.php"); ?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header left deep-orange-text">Ajouter un nouvel utilisateur</h1>
        <br><br>
    </div>
</div>

<div class="row">
    <form class="col s12" action="#" method="post">
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="name"required>
                <label for="name">Nom</label>
            </div>
            <div class="input-field col s6">
                <input type="password" name="password" required>
                <label for="password">Mot de passe</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="mail" required>
                <label for="mail">E-mail</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="phone" required>
                <label for="phone">Téléphone</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select class = "roleUser" name="role" required>
                    <option value="">Choisissez</option>
                    <?php
                    require_once "../BLL/roleManager.php";
                    $roleManager = new RoleManager();
                    $roles = $roleManager->getAllRole();
                    foreach ($roles as $role){
                        ?>
                        <option value="<?php echo $role->getId(); ?>"><?php echo $role->getName()?></option>
                    <?php
                    }
                    ?>
                </select>
                <label>Rôle</label>
            </div>
            <div class="input-field col s6 dependOnRegion" >
                    <input type="text" name="region" value= "">
                    <label for="region">Région</label>
            </div>
            <div class="input-field col s6">
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light orange" type="submit" name="submit">Confirmer
                    <i class="material-icons right">person</i>
                </button>
            </div>
        </div>
    </form>
</div>
<?php
require_once '../BLL/userManager.php';
require_once '../BLL/regionManager.php';
require_once '../BLL/driverManager.php';
const ACCEPTED_TRANSPORT_TYPE = array('post');

//once the client click on the submit button, we will add a new client.
if(isset($_POST['submit'])){
    $userManager = new UserManager();
    $regionManager = new RegionManager();
    $userManager->addUser($_POST['name'], $_POST['password'], $_POST['mail'], $_POST['phone'], $_POST['role']);
    $addedUser = $userManager->getUsersByNameAndRoleId($_POST['name'], $_POST['role']);
    $listOfRolesAssignedToRegion = array('admin', 'driver');
    $region = $_POST['region'];
    switch($roleManager->getRoleById($addedUser->getRoleId())->getName()){
        case 'admin':
            $region = $regionManager->getRegionById($_POST['region']);
            $region->setAdminId($addedUser->getId());
            break;
        case 'driver':
            $region = $regionManager->getRegionById($_POST['region']);
            $driverManager = new DriverManager();
            $driverManager->addDriver($addedUser->getId(), $region->getId());
            break;
        default:

            break;
    }

}

?>

</main>
<?php include("footer.php"); ?>

</body>
</html>