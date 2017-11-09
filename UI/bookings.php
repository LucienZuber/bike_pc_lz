<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";
//This is the page used to display all bookings
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['MENU_BOOKINGS'];?></title>

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
array_push($acceptedRoles, 'admin');
array_push($acceptedRoles, 'driver');

if(!isset($_SESSION['userId'])) {
    header('Location: '."./index.php");
}
$user = $userManager->getUsersById(intval($_SESSION['userId']));
$role = $roleManager->getRoleById($user->getRoleId());

if(!in_array($role->getName(), $acceptedRoles)){
    header('Location: '."./index.php");
}
?>
<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center deep-orange-text"><?php echo $lang['LIST_BOOKINGS'];?></h1>
            <br><br>

            <table class="striped">
                <thead>
                <tr>
                    <th><?php echo $lang['FROM'];?></th>
                    <th><?php echo $lang['TO'];?></th>
                    <th><?php echo $lang['NAME'];?></th>
                    <th><?php echo $lang['MAIL'];?></th>
                    <th><?php echo $lang['PHONE'];?></th>
                    <th><?php echo $lang['NB_BIKE'];?></th>
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
                switch ($role->getName()){
                    case 'admin':
                        require_once "../BLL/regionManager.php";
                        $regionManager = new RegionManager();
                        $bookings = $bookingsManager->getBookingByRegion($regionManager->getRegionByAdmin($user->getId())->getId());
                        break;
                    case 'driver':
                        require_once "../BLL/driverManager.php";
                        $driverManager = new DriverManager();
                        $bookings = $bookingsManager->getBookingByRegion($driverManager->getRegionByDriver($user->getId())->getId());
                        break;
                    case 'superAdmin':
                        $bookings = $bookingsManager->getAllBooking();
                        break;
                }
                foreach ($bookings as $booking) {
                    if(!$bookingsManager->isBookingIfOutOfDate($booking)) {
                        ?>
                        <tr>
                            <td><?php echo $stationManager->getStationById($booking->getDepartureStation()) . " " . $booking->getDepartureHour() ?></td>
                            <td><?php echo $stationManager->getStationById($booking->getArrivalStation()) . " " . $booking->getArrivalHour() ?></td>
                            <td><?php echo $booking->getName() ?></td>
                            <td><?php echo $booking->getMail() ?></td>
                            <td><?php echo $booking->getPhone() ?></td>
                            <td><?php echo $booking->getNbrBike() ?></td>
                            <td>
                                <?php
                                $acceptedRolesDeletion = array();
                                array_push($acceptedRolesDeletion, 'superAdmin');
                                array_push($acceptedRolesDeletion, 'admin');
                                if (in_array($role->getName(), $acceptedRolesDeletion)) {
                                    ?>
                                    <a class="btn-floating orange"
                                       href="bookingDelete.php?bookingId=<?php echo $booking->getId(); ?>"><i
                                                class="material-icons">remove</i></a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <th><?php echo $lang['ADD_RESERVATION'];?></th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/datepicker.js"></script>
<script src="../js/timepicker.js"></script>
</body>
</html>
