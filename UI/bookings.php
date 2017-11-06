<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 10:24
 */
?>
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

</head>
<body>
<?php include("menus.php");

require_once "../BLL/userManager.php";
require_once "../BLL/roleManager.php";

$userManager = new UserManager();
$roleManager = new RoleManager();

$acceptedRoles = array();
array_push($acceptedRoles, 'superadmin');
array_push($acceptedRoles, 'admin');
array_push($acceptedRoles, 'driver');

if(!isset($_SESSION['userId'])) {
    header('Location: '."/bike_pc_lz/UI/index.php");
}

$role = $roleManager->getRoleById($userManager->getUsersById(intval($_SESSION['userId']))->getRoleId());

if(!in_array($role->getName(), $acceptedRoles)){
    header('Location: '."/bike_pc_lz/UI/index.php");
}
?>
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text">Liste Des réservations</h1>
            <br><br>

            <table class="striped">
                <thead>
                <tr>
                    <th>De</th>
                    <th>A</th>
                    <th>Nom</th>
                    <th>Adresse mail</th>
                    <th>numéro de téléphone</th>
                    <th>Nombre de vélos</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../DTO/booking.php";
                require_once "../BLL/bookingManager.php";
                require_once "../BLL/stationManager.php";
                $stationManager = new StationManager();
                $bookingsManager = new BookingManager();
                $bookings = $bookingsManager->getAllBooking();
                foreach ($bookings as $booking) {
                    ?>
                    <tr>
                        <td><?php echo $stationManager->getStationById($booking->getDepartureStation())." ".$booking->getDepartureHour() ?></td>
                        <td><?php echo $stationManager->getStationById($booking->getArrivalStation())." ".$booking->getArrivalHour() ?></td>
                        <td><?php echo $booking->getName()?></td>
                        <td><?php echo $booking->getMail()?></td>
                        <td><?php echo $booking->getPhone()?></td>
                        <td><?php echo $booking->getNbrBike()?></td>
                        <td>
                            <?php
                            $acceptedRolesDeletion = array();
                            array_push($acceptedRolesDeletion, 'superadmin');
                            array_push($acceptedRolesDeletion, 'admin');
                            if(in_array($role->getName(), $acceptedRolesDeletion)){
                                ?>
                                <a class="btn-floating orange" href="bookingDelete.php?bookingId=<?php echo $booking->getId();?>"><i class="material-icons">remove</i></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th>Ajouter une réservation</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> <a class="btn-floating orange" href="bookingAdd.php"><i class="material-icons">add</i></a></th>
                </tr>
                </tbody>
            </table>
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
</body>
</html>
