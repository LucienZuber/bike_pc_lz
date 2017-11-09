<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";

//This page is used to add a user

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['ADD_USER'];?></title>

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
            <h1 class="header center deep-orange-text"><?php echo $lang['ADD_USER'];?></h1>
            <br><br>
            <form class="col s12" action="#" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" name="name"required>
                        <label for="name"><?php echo $lang['NAME'];?></label>
                    </div>
                    <div class="input-field col s6">
                        <input type="password" name="password" required>
                        <label for="password"><?php echo $lang['PASSWORD'];?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" name="mail" required>
                        <label for="mail"><?php echo $lang['MAIL'];?></label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="phone" required>
                        <label for="phone"><?php echo $lang['PHONE'];?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select class = "roleUser" name="role" required>
                            <option value="" disabled selected><?php echo $lang['CHOOSE'];?></option>
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
                        <label><?php echo $lang['ROLE'];?></label>
                    </div>
                    <div class="input-field col s6 dependOnRegion">
                        <select class = "" name="region">
                            <option value="" disabled selected><?php echo $lang['CHOOSE'];?></option>
                            <?php
                            require_once "../BLL/regionManager.php";
                            $regionManager = new RegionManager();
                            $regions = $regionManager->getAllRegion();
                            foreach ($regions as $region){
                                ?>
                                <option value="<?php echo $region->getId(); ?>"><?php echo $region->getName()?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label><?php echo $lang['REGION'];?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    </div>
                    <div class="input-field col s6">
                        <button class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['CONFIRM'];?>
                            <i class="material-icons right">person</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once '../BLL/userManager.php';
    require_once '../BLL/driverManager.php';
    const ACCEPTED_TRANSPORT_TYPE = array('post');
    //once the client click on the submit button, we will add a new client.
    if(isset($_POST['submit'])){
        $userManager = new UserManager();
        $regionManager = new RegionManager();
        $userManager->addUser($_POST['name'], $_POST['password'], $_POST['mail'], $_POST['phone'], $_POST['role']);
        $addedUser = $userManager->getUsersByNameAndRoleId($_POST['name'], $_POST['role']);
        switch($roleManager->getRoleById($addedUser->getRoleId())->getName()){
            case 'driver':
                $region = $regionManager->getRegionById($_POST['region']);
                $driverManager = new DriverManager();
                $driverManager->addDriver($addedUser->getId(), $region->getId());
                break;
            default:
                break;
        }
    ?>
    <script type="text/javascript">
        window.location = "./users.php";
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
<script src="../js/displayUserRegion.js"></script>
</body>
</html>