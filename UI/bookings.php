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
</head>
<body>
<?php include("menus.php");?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text">Réservations</h1>
        <br><br>

        <table class="striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Trajet</th>
                <th>Vélo(s)</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>4.11.2017</td>
                <td>Zinal - Sierre</td>
                <td>2</td>
                <td><a class="btn-floating orange"><i class="material-icons">create</i></a></td>
            </tr>
            <tr>
                <td>15.11.2017</td>
                <td>Ayer - Sierre</td>
                <td>8</td>
                <td><a class="btn-floating orange"><i class="material-icons">create</i></a></td>
            </tr>
            <tr>
                <td>20.11.2017</td>
                <td>Sierre - St-Luc</td>
                <td>1</td>
                <td><a class="btn-floating orange"><i class="material-icons">create</i></a></td>
            </tr>
            </tbody>
        </table>
        <br><br>
        <form class="col s12" action="#" method="get">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="departure" class="autocomplete rechercheLocal" required>
                    <label for="departure">Départ</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="arrival" class="autocomplete rechercheLocal" required>
                    <label for="arrival">Arrivée</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="datepicker" name ="date" required>
                    <label for="icon_telephone">Date</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="timepicker" name="time" required>
                    <label for="fa fa-clock-o">Time</label>
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
        <?php
        require_once '../BLL/bookingManager.php';

        const ACCEPTED_TRANSPORT_TYPE = array('post');

        //once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
        if(isset($_GET['submit'])){
            $import = new BookingManager();
            $date = $_GET['date'];
            $date = date_create_from_format('j/m/Y', $date);
            $date = date_format($date, "m/d/Y");
            $trips = $import->displayTrips($_GET['departure'], $_GET['arrival'], $date, $_GET['time']);

            echo "
                <table class=\"striped\">
                <thead>
                <tr>
                    <th>Départ</th>
                    <th>Heure de départ</th>
                    <th>Arrivée</th>
                    <th>Heure d'arrivée</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
            ";

            foreach ($trips as $trip) {
                echo "
                    <tr>
                        <td>".$trip->getDepartureStation()->getName()."</td>
                        <td>".$trip->getDepartureDateTime()."</td>
                        <td>".$trip->getArrivalStation()->getName()."</td>
                        <td>".$trip->getArrivalDateTime()."</td>
                        <td><a class=\"btn-floating orange modal-trigger\" href=\"#makeABook\"><i class=\"material-icons\">add</i></a></td>
                    </tr>
                    ";
                    }
                    echo "
                    </tbody>
                    </table>
                ";
                }
            ?>
    </div>
</div>
<div id="makeABook" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
</main>
<script>$(document).ready(function() {
        $('.modal').modal();
    });</script>
<?php include("footer.php"); ?>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../Scripts/datepicker.js"></script>
<script src="../Scripts/timepicker.js"></script>
<!--    <script src="../Scripts/autocompleteLocal.js"></script>-->

</body>
</html>
