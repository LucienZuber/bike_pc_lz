<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:01
 */
require_once "../BLL/userManager.php";

$userManager = new UserManager();
$userManager->deleteUser($_GET['userId']);
echo "utilisateur supprimé";
?>