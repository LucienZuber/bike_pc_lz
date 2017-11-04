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

    public function getStationByName($stationName){
        return $this->stationRequest->getStationByName($stationName);
    }
    public function getStationById($stationId){
        return $this->stationRequest->getStationById($stationId);
    }

    public function getStationLikeName($stationName)
    {
        $stations = $this->stationRequest->getStationLikeName($stationName);

        $returnedValue = json_encode($stations);

        echo($returnedValue);

        return $returnedValue;
    }
    public function addStation($name, $region){
        $this->stationRequest->insertStation($name, $region);
    }
    public function removeStation($id){
        $this->stationRequest->deleteStation($id);
    }
    public function getAllStations(){
        return $this->stationRequest->getAllStations();
    }
    public function getAllStationsByRegion($region){
        return $this->stationRequest->getAllStationByRegion($region);
    }
}