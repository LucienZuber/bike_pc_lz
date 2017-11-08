<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:01
 */
require_once "../BLL/userManager.php";
require_once "../BLL/roleManager.php";

//This page is used to delete a user

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$userManager = new UserManager();
$roleManager = new RoleManager();

$acceptedRoles = array();
array_push($acceptedRoles, 'superAdmin');

if(!isset($_SESSION['userId'])) {
    header('Location: '."/bike_pc_lz/UI/index.php");
}

$role = $roleManager->getRoleById($userManager->getUsersById(intval($_SESSION['userId']))->getRoleId());

if(!in_array($role->getName(), $acceptedRoles)){
    header('Location: '."/bike_pc_lz/UI/index.php");
}

$userManager->deleteUser($_GET['userId']);
header('Location: '."/bike_pc_lz/UI/users.php");
?>