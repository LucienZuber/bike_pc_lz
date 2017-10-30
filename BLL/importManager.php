<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 09:18
 */
require_once '../DAL/regionRequest.php';
require_once '../DAL/stationRequest.php';
require_once '../DTO/region.php';
require_once '../DTO/station.php';

class ImportManager
{
    const URI = "https://timetable.search.ch/api/route.en.json";
    const ACCEPTED_TRANSPORT_TYPE = array('post'); //the list of transport type that will be returned by the API

    private $regionRequest;
    private $stationRequest;
    private $region;
    private $query;
    private $listOfStops;
    /**
     * Import constructor.
     * @param $region
     * @param $param
     */
    public function __construct()
    {
        $this->regionRequest = new RegionRequest();
        $this->stationRequest = new StationRequest();
        $this->listOfStops = array();

    }

    //Read the jsonObject
    public function read($departure, $arrival, $regionName, $adminId){

        $this->addRegion($regionName, $adminId);

        $param = array (
            'from' => $departure,
            'to' => $arrival,
            'num' => 1 //We take only one ride
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
        $this->readAddedStations();
    }
    //Read the id and the name of a JSonObject
    private function readIdName($jsonObject){
        $this->listOfStops[$jsonObject['stopid']] = $jsonObject['name'];
    }

    public function addRegion($regionName, $adminId){
        $this->regionRequest->insertRegion($regionName, $adminId);
        $this->region = $this->regionRequest->getRegion($regionName);
    }

    public function addStation($name){
        $this->stationRequest->insertStation($name, (int)$this->region->getId());
    }

    public function readAddedStations(){
        foreach ($this->listOfStops as $key => $value){
            $this->addStation($value);
//            echo "$key : $value <br>";
        }
    }
}