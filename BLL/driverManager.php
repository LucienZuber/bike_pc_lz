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

    public function addDriver($driverId, $regionId){
        $this->driverRequest->insertDriver($driverId, $regionId);
    }
}