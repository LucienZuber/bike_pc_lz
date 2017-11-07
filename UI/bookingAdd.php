<!DOCTYPE html>
<?php
require_once "../Model/reservationDetails.php";
require_once '../BLL/bookingManager.php';
require_once '../Model/Trips.php';
include_once  '../BLL/changeLanguage.php';
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['MENU_BOOK'];?></title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <?php session_start(); ?>
</head>
<body>
<?php
    include("menus.php");
?>
<main>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text"><?php echo $lang['BOOK_NOW'];?></h1>
        <br><br>
        <form class="col s12" action="#" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">people</i>
                    <input type="text" name="departure" class="autocomplete rechercheDB" required>
                    <label for="departure"><?php echo $lang['START'];?></label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">location_on</i>
                    <input type="text" name="arrival" class="autocomplete rechercheDB" required>
                    <label for="arrival"><?php echo $lang['END'];?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="datepicker" name ="date" required>
                    <label for="icon_telephone"><?php echo $lang['DATE'];?></label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">timer</i>
                    <input type="text" class="timepicker" name="time" required>
                    <label for="fa fa-clock-o"><?php echo $lang['TIME'];?></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                </div>
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['CONFIRM'];?>
                        <i class="material-icons right">search</i>
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
                <th><?php echo $lang['START'];?></th>
                <th><?php echo $lang['START_TIME'];?></th>
                <th><?php echo $lang['END'];?></th>
                <th><?php echo $lang['END_TIME'];?></th>
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
                        <h4><?php echo $lang['COMPLETE_RESERVATION'];?></h4>

                        <div class="row">
                            <form class="col s12" action="#" method="post">
                                <div class="row modal-form-row">
                                    <div class="input-field col s6">
                                        <input type="text" name="name" class="" required>
                                        <label for="name"><?php echo $lang['NAME'];?></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" name="phone" class="" required>
                                        <label for="phone"><?php echo $lang['PHONE'];?></label>
                                    </div>
                                </div>
                                <input type="hidden" name="departureStation" value="<?php echo $trip->getDepartureStation()->getName()?>">
                                <input type="hidden" name="departureHour" value="<?php echo $trip->getDepartureDateTime()?>">
                                <input type="hidden" name="arrivalStation" value="<?php echo $trip->getArrivalStation()->getName()?>">
                                <input type="hidden" name="arrivalHour" value="<?php echo $trip->getArrivalDateTime()?>">
                                <div class="row modal-form-row">
                                    <div class="input-field col s6">
                                        <input type="email" name="mail" class="" required>
                                        <label for="mail"><?php echo $lang['MAIL'];?></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="number" name="nbrBike" min="1" , max="20" class="" required>
                                        <label for="nbrBike"><?php echo $lang['NB_BIKE'];?></label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <a class=" modal-action modal-close btn waves-effect waves-light orange"><?php echo $lang['CANCEL'];?>
                                            <i class="material-icons right">remove</i>
                                        </a>
                                        <button class="btn waves-effect waves-light orange" type="submit" name="book">
                                            <?php echo $lang['MENU_BOOK'];?>
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
</main>


<?php include("footer.php"); ?>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/datepicker.js"></script>
<script src="../js/timepicker.js"></script>
<script src="../js/autocompleteLocal.js"></script>
<script src="../js/modalInstantiate.js"></script>
</body>
</html>
