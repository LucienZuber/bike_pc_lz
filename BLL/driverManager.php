<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:55
 */


require_once '../DAL/driverRequest.php';

class DriverManager
{
    private $driverRequest;

    public function __construct()
    {
        $this->driverRequest = new DriverRequest();
    }

    public function getRegionByDriver($driverId){
        return $this->driverRequest->getDriverByDriverId($driverId)->getRegionId();
    }

    public function addDriver($driverId, $regionId){
        $this->driverRequest->insertDriver($driverId, $regionId);
    }

    public function updateDriver($driverId, $regionId){
        var_dump($this->driverRequest->getDriverByDriverId($driverId));

        if(is_null($this->driverRequest->getDriverByDriverId($driverId))){
            $this->driverRequest->insertDriver($driverId, $regionId);
        }
        else{
            $this->driverRequest->updateDriver($driverId, $regionId);
        }
    }
}