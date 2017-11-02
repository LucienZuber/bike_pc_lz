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
    private $stationManagere;
    public function __construct()
    {
        $this->stationManagere = new StationManager();
    }
    public function getStationLikeName($stationName){
        $stations = $this->stationManagere->getStationLikeName($stationName);

        return json_encode($stations);
        }
}