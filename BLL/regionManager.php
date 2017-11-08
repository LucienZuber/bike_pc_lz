<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:25
 */

require_once "../DAL/regionRequest.php";

//This class manage the region functions
class RegionManager
{

    private $regionRequest;

    public function __construct()
    {
        $this->regionRequest = new RegionRequest();
    }

    //This function add a new region
    public function addRegion($regionName, $adminId){
        $this->regionRequest->insertRegion($regionName, $adminId);
    }

    //This function update a region
    public function updateRegion($region){
        $this->regionRequest->updateRegion($region->getId(), $region->getName(), $region->getAdminId());
    }

    //This function delete a Region
    public function deleteRegion($regionId){
        $this->regionRequest->deleteRegion($regionId);
    }

    //This function return a list of all regions
    public function getAllRegion(){
        return $this->regionRequest->getAllRegion();
    }

    //This function return a region by its id
    public function getRegionById($id){
        return $this->regionRequest->getRegionById($id);
    }

    //This function get a region by its name
    public function getRegionByName($name){
        return $this->regionRequest->getRegionByName($name);
    }

    //This function return a region by its admin
    public function getRegionByAdmin($adminId){
        return $this->regionRequest->getRegionByAdminId($adminId);
    }
}