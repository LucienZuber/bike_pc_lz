<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 29.10.2017
 * Time: 18:43
 */

require_once '../DTO/station.php';
require_once '../DAL/stationRequest.php';
require_once '../Model/Trips.php';

class BookingManager
{
    const URI = "https://timetable.search.ch/api/route.en.json";
    const ACCEPTED_TRANSPORT_TYPE = array('post'); //the list of transport type that will be returned by the API

    private $stationRequest;

    /**
     * BookingManager constructor.
     * @param $stationRequest
     */
    public function __construct()
    {
        $this->stationRequest = new StationRequest();
    }

    public function displayTrips($departure, $arrival, $date, $time){

        $param = array (
            'from' => $departure,
            'to' => $arrival,
            'date' => $date,
            'time' => $time
        );
        //We build the query

        $this->query = self::URI.'?'.http_build_query($param);
        $data = json_decode(file_get_contents($this->query), true);

        $listOfTrips=array();

        //we see every connection
        foreach ($data['connections'] as $connections){
            //we see every legs

            $from = $this->checkIfStationExists($departure);
            $to = $this->checkIfStationExists($arrival);
            if(is_null($from)||is_null($to)){
                echo "Please enter an existing station";
                return null;
            }
            if($from->getRegionId()!=$to->getRegionId()){
                if(is_null($this->stationRequest->getStationByNameAndRegionId($from->getName(), $to->getRegionId()))){
                    if(is_null($this->stationRequest->getStationByNameAndRegionId($to->getName(), $from->getRegionId()))){
                        echo "Merci de choisir une arrivée et un départ dans la même région !";
                        return null;
                    }
                    else{
                        $to = $this->stationRequest->getStationByNameAndRegionId($to->getName(), $from->getRegionId());
                    }
                }
                else{
                    $from = $this->stationRequest->getStationByNameAndRegionId($from->getName(), $to->getRegionId());
                }
            }
            array_push($listOfTrips, new Trips($from, $connections['departure'], $to, $connections['arrival']));
        }
        return $listOfTrips;
    }

    public function checkIfStationExists($stationName){
        $station = $this->stationRequest->getStationByName($stationName);
        if(!is_null($station)){
            return $station;
        }
        return null;
    }

}