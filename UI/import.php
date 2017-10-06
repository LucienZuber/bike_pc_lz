<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Import</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script type="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
<h1>Use this page to import new area</h1>
<form action="#" method="get">
    departure: <input type="text" name="departure" id="recherche">
    arrival: <input type="text" name="arrival">
    region: <input type="text" name="region">
    <input type="submit" name="submit">
</form>
<script>
    var liste = [
        "Draggable",
        "Droppable",
        "Resizable",
        "Selectable",
        "Sortable"
    ];
    console.log('TEST');
    $('#recherche').autocomplete({source : liste});
</script>
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