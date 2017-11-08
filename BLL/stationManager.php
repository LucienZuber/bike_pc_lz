<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 08:10
 */

require_once '../DAL/stationRequest.php';
require_once '../DTO/station.php';

//This class regroup all action concerning the stations
class StationManager
{
    private $stationRequest;

    public function __construct()
    {
        $this->stationRequest = new StationRequest();
    }

    //This function return a station by its name
    public function getStationByName($stationName){
        return $this->stationRequest->getStationByName($stationName);
    }

    //This function return a station by its id
    public function getStationById($stationId){
        return $this->stationRequest->getStationById($stationId);
    }

    //This function return a list of stations corresponding to an input
    public function getStationLikeName($stationName)
    {
        $stations = $this->stationRequest->getStationLikeName($stationName);

        $returnedValue = json_encode($stations);

        echo($returnedValue);

        return $returnedValue;
    }

    //This function add a new station
    public function addStation($name, $region){
        $this->stationRequest->insertStation($name, $region);
    }

    //This function remove a station
    public function removeStation($id){
        $this->stationRequest->deleteStation($id);
    }

    //This function return a list of all stations
    public function getAllStations(){
        return $this->stationRequest->getAllStations();
    }

    //This function return a list of all regions by the same region
    public function getAllStationsByRegion($region){
        return $this->stationRequest->getAllStationByRegion($region);
    }
    //This function check if a station exists
    public function checkIfStationExists($stationName){
        $station = $this->stationRequest->getStationByName($stationName);
        if(!is_null($station)){
            return $station;
        }
        return null;
    }
}