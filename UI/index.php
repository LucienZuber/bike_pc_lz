<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Home</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<?php include("menus.php");?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text">Effectuez rapidement une réservation</h1>
        <br><br>
    </div>
</div>

<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">people</i>
                <input id="icon_prefix" type="text" class="recherche" required>
                <label for="icon_prefix">Départ</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">location_on</i>
                <input id="icon_telephone" type="tel" class="recherche" required>
                <label for="icon_telephone">Arrivée</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">date_range</i>
                <input type="text" class="datepicker" required>
                <label for="icon_telephone">Date</label>
            </div>
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light orange" type="submit" name="submit">Rechercher
                    <i class="material-icons right">search</i>
                </button>
            </div>
        </div>
    </form>
</div>
</main>
<?php include("footer.php"); ?>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../js/autocompleteCFF.js"></script>
<script src="../js/datepicker.js"></script>

</body>
</html>
