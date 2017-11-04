<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:01
 */
require_once "../BLL/bookingManager.php";

$bookingManager = new BookingManager();
$bookingManager->deleteBooking($_GET['bookingId']);
?>