<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:25
 */

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
    }
    public function updateRegion($region){
        $this->regionRequest->updateRegion($region->getId(), $region->getName(), $region->getAdminId());
    }

    public function deleteRegion($regionId){
        $this->regionRequest->deleteRegion($regionId);
    }

    public function getAllRegion(){
        return $this->regionRequest->getAllRegion();
    }
    public function getRegionById($id){
        return $this->regionRequest->getRegionById($id);
    }
    public function getRegionByName($name){
        return $this->regionRequest->getRegionByName($name);
    }
    public function getRegionByAdmin($adminId){
        return $this->regionRequest->getRegionByAdminId($adminId);
    }
}