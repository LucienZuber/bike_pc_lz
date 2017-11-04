<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 08:47
 */
//page used for the local autocompletion
require_once "../BLL/stationManager.php";

$stationManager = new StationManager();

$stations = $stationManager->getStationLikeName($_GET['input']);

return $stations;

?>