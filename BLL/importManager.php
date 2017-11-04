<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 09:18
 */
require_once 'stationManager.php';
require_once 'regionManager.php';
require_once '../DTO/station.php';

class ImportManager
{
    const URI = "https://timetable.search.ch/api/route.en.json";
    const ACCEPTED_TRANSPORT_TYPE = array('post'); //the list of transport type that will be returned by the API

    private $query;
    private $listOfStops;
    private $stationManager;
    private $regionManager;
    private $_region;
    /**
     * Import constructor.
     * @param $region
     * @param $param
     */
    public function __construct()
    {
        $this->listOfStops = array();
        $this->stationManager = new StationManager();
        $this->regionManager = new RegionManager();
    }

    //Read the jsonObject
    public function read($departure, $arrival, $regionName, $adminId){

        $this->regionManager->addRegion($regionName, $adminId);
        $param = array (
            'from' => $departure,
            'to' => $arrival,
            'num' => 1 //We take only one rideça
        );

        //We build the query

        $this->query = self::URI.'?'.http_build_query($param);
        $data = json_decode(file_get_contents($this->query), true);
        //we see every connection
        foreach ($data['connections'] as $connections){
            //we see every legs
            foreach ($connections['legs'] as $legs){
                //we only take legs that have a type defined and where the type is accepted
                if(isset($legs['type']) && in_array($legs['type'], self::ACCEPTED_TRANSPORT_TYPE)){
                    $this->readIdName($legs);
                    //we see every stops of every legs
                    foreach ($legs['stops'] as $stops){
                        $this->readIdName($stops);
                    }
                    //We display the final exit of every legs !if it is an intermediary leg, the next departure may be the same
                    $this->readIdName($legs['exit']);
                }
            }
        }
        $this->readAddedStations($this->regionManager->getRegionByName($regionName));
    }
    //Read the id and the name of a JSonObject
    private function readIdName($jsonObject){
        $this->listOfStops[$jsonObject['stopid']] = $jsonObject['name'];
    }

    public function readAddedStations($region){
        foreach ($this->listOfStops as $key => $value){
            $this->stationManager->addStation($value, $region->getId());
//            echo "$key : $value <br>";
        }
    }
}