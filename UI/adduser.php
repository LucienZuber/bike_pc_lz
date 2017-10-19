<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Add user</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<?php include("menus.php"); ?>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header left orange-text">Ajouter un nouvel utilisateur</h1>
        <br><br>
    </div>
</div>

<div class="row">
    <form class="col s12" action="#" method="get">
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="nom"required>
                <label for="nom">Nom</label>
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
                <select>
                    <option value="" disabled selected>Choisissez</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Chauffeur</option>
                </select>
                <label>Rôle</label>
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="submit">Confirmer
                    <i class="material-icons right">person</i>
                </button>
            </div>
        </div>
    </form>
</div>

<?php include("footer.php"); ?>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../Scripts/select.js"></script>

</body>
</html>