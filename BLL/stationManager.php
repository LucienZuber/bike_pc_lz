<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 08:10
 */

require_once '../DAL/stationRequest.php';
require_once '../DTO/station.php';

class StationManager
{
    private $stationRequest;

    public function __construct()
    {
        $this->stationRequest = new StationRequest();
    }

    public function getStationLikeName($stationName)
    {
        $stations = $this->stationRequest->getStationLikeName($stationName);

        $returnedValue = json_encode($stations);

        echo($returnedValue);

        return $returnedValue;
    }
}