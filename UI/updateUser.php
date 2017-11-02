<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:07
 */
require_once "../BLL/userManager.php";
require_once "../DTO/user.php";

$userManager = new UserManager();
$user = new User($_GET['id'], $_GET['name'], $_GET['password'], $_GET['mail'], $_GET['phone'], $_GET['roleId']);
$userManager->modifyUser($_GET['user']);
echo "utilisateur modifié";