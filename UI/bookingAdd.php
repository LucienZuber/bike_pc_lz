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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <?php session_start(); ?>
</head>
<body>
<?php
    include("menus.php");
    require_once "../Model/reservationDetails.php";
    require_once '../BLL/bookingManager.php';
    require_once '../Model/Trips.php';
?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text">Réserver</h1>
        <br><br>
        <form class="col s12" action="#" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="departure" class="rechercheDB" required>
                    <label for="departure">Départ</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="arrival" class="rechercheDB" required>
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

        const ACCEPTED_TRANSPORT_TYPE = array('post');
        $import = new BookingManager();

        //once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
        if(isset($_POST['submit'])){
        $date = $_POST['date'];
        $date = date_create_from_format('j/m/Y', $date);
        $date = date_format($date, "m/d/Y");
        $trips = $import->displayTrips($_POST['departure'], $_POST['arrival'], $date, $_POST['time']);
        ?>
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
            <?php
            $count = 0;
            foreach ($trips as $trip) {
                echo "
                    <tr>
                        <td>" . $trip->getDepartureStation()->getName() . "</td>
                        <td>" . $trip->getDepartureDateTime() . "</td>
                        <td>" . $trip->getArrivalStation()->getName() . "</td>
                        <td>" . $trip->getArrivalDateTime() . "</td>
                        <td><a class=\"btn-floating orange modal-trigger\" href=\"#makeABook$count\"><i class=\"material-icons\">add</i></a></td>
                    </tr>

                    ";
                ?>
                <!-- Modal Structure -->
                <div id="makeABook<?php echo $count; ?>" class="modal">
                    <div class="modal-content">
                        <h4>Faire une réservation</h4>

                        <div class="row">
                            <form class="col s12" action="#" method="post">
                                <div class="row modal-form-row">
                                    <div class="input-field col s6">
                                        <input type="text" name="name" class="" required>
                                        <label for="name">Nom</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" name="phone" class="" required>
                                        <label for="phone">téléphone</label>
                                    </div>
                                </div>
                                <input type="hidden" name="departureStation" value="<?php echo $trip->getDepartureStation()->getName()?>">
                                <input type="hidden" name="departureHour" value="<?php echo $trip->getDepartureDateTime()?>">
                                <input type="hidden" name="arrivalStation" value="<?php echo $trip->getArrivalStation()->getName()?>">
                                <input type="hidden" name="arrivalHour" value="<?php echo $trip->getArrivalDateTime()?>">
                                <div class="row modal-form-row">
                                    <div class="input-field col s6">
                                        <input type="email" name="mail" class="" required>
                                        <label for="mail">adresse mail</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="number" name="nbrBike" min="1" , max="20" class="" required>
                                        <label for="nbrBike">nombre de vélos</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <a class=" modal-action modal-close btn waves-effect waves-light orange">Annuler
                                            <i class="material-icons right">remove</i>
                                        </a>
                                        <button class="btn waves-effect waves-light orange" type="submit" name="book">
                                            Réserver
                                            <i class="material-icons right">done</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
            <?php
            $count ++;
            }
            ?>
            </tbody>
        </table>
                    <?php
                }
            ?>
    </div>
        <?php
        //once the client click on the submit button, we will query the SBB API to get every stop between the two stations.
        if(isset($_POST['book'])) {
            require_once "../BLL/stationManager.php";
            $stationManager = new StationManager();
            $departureStation = $stationManager->getStationByName($_POST['departureStation']);
            $arrivalStation = $stationManager->getStationByName($_POST['arrivalStation']);
            $trip = new Trips($departureStation, $_POST['departureHour'], $arrivalStation, $_POST['arrivalHour']);
            $reservationDetail = new ReservationDetails($_POST['name'], $_POST['phone'], $_POST['mail'], $_POST['nbrBike']);
            $import->addBooking($trip, $reservationDetail);
        }
        ?>
    </div>
</div>
</main>


<?php include("footer.php"); ?>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/datepicker.js"></script>
<script src="../js/timepicker.js"></script>
<script src="../js/autocompleteLocal.js"></script>
<script src="../js/modalInstantiate.js"></script>
</body>
</html>
