<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:01
 */
require_once "../BLL/bookingManager.php";
require_once "../BLL/userManager.php";
require_once "../BLL/roleManager.php";

//This is the page used to delete booking

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userManager = new UserManager();
$roleManager = new RoleManager();

$acceptedRoles = array();
array_push($acceptedRoles, 'superAdmin');
array_push($acceptedRoles, 'admin');

if(!isset($_SESSION['userId'])) {
    header('Location: ' . "/bike_pc_lz/UI/index.php");
}

if(!in_array($acceptedRoles, $roleManager->getRoleById($userManager->getUsersById(intval($_SESSION['userId']))->getRoleId())->getName())){
    header('Location: '."/bike_pc_lz/UI/index.php");
}
$bookingManager = new BookingManager();
$bookingManager->deleteBooking($_GET['bookingId']);
header('Location: '."/bike_pc_lz/UI/bookings.php");
?>