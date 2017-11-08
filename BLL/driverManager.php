<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:55
 */


require_once '../DAL/driverRequest.php';

//this class regroup the driver manager
class DriverManager
{
    private $driverRequest;

    public function __construct()
    {
        $this->driverRequest = new DriverRequest();
    }

    //This class regroup the region by its driver
    public function getRegionByDriver($driverId){
        return $this->driverRequest->getDriverByDriverId($driverId)->getRegionId();
    }

    //this function add a driver to a region
    public function addDriver($driverId, $regionId){
        $this->driverRequest->insertDriver($driverId, $regionId);
    }

    //this function update a driver
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