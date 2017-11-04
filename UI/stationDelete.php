<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 04.11.2017
 * Time: 13:21
 */

require_once "../BLL/stationManager.php";

$stationManager = new StationManager();
$stationManager->removeStation($_GET['stationId']);

?>