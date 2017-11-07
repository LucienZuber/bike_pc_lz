<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Connexion</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<?php include("menus.php");
    include_once "../BLL/changeLanguage.php";

if(isset($_SESSION['userId'])) {
    header('Location: '."/bike_pc_lz/UI/index.php");
}


?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text"><?php echo $lang['CONNECT'];?></h1>
        <br><br>
    </div>
</div>

<div class="row">
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

            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['LOGIN'];?>
                    <i class="material-icons right">check</i>
                </button>
            </div>
        </div>
    </form>
</div>
    <?php
    require_once "../BLL/userManager.php";
    $userManager = new UserManager();
    if(isset($_POST['submit'])){
        $user = $userManager->getUsersByNameAndPassword($_POST['name'], $_POST['password']);
        if(!is_null($user)){
            $_SESSION['userId'] = $user->getId();
            header('Location: '."/bike_pc_lz/UI/index.php");
        }
    }
    ?>
</main>
<?php include("footer.php"); ?>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>

</body>
</html>
