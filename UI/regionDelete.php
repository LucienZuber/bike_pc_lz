<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 11:01
 */
require_once "../BLL/regionManager.php";

$regionManager = new RegionManager();
$regionManager->deleteRegion($_GET['regionId']);
?>