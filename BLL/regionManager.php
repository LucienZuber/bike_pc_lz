<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:25
 */

require_once "../DTO/region.php";
require_once "../DAL/regionRequest.php";

class RegionManager
{

    private $regionRequest;

    public function __construct()
    {
        $this->regionRequest = new RegionRequest();
    }

    public function addRegion($regionName, $adminId){
        $this->regionRequest->insertRegion($regionName, $adminId);
        $this->region = $this->regionRequest->getRegionByName($regionName);
    }

    public function getAllRegion(){
        return $this->regionRequest->getAllRegion();
    }
    public function getRegionById($id){
        return $this->regionRequest->getRegionById($id);
    }
}