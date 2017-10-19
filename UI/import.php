<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Import</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="../Scripts/autocomplete.js"></script>
</head>
<body>

<h1>Utilisez cette page pour importer de nouvelles zones</h1>
<form action="#" method="get">
    départ: <input type="text" name="departure" class="recherche" required>
    arrivée: <input type="text" name="arrival" class="recherche" required>
    région: <input type="text" name="region" required>
    chauffeur: <input type="text" name="region" required>
    <input type="submit" name="submit">
</form>
<?php
require_once '../BLL/import.php';

const ACCEPTED_TRANSPORT_TYPE = array('post');

//once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
if(isset($_GET['submit'])){
    $import = new Import($_GET['departure'], $_GET['arrival'], $_GET['region']);
    $import->read();
}

?>
</body>
</html>