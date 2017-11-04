<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 09:51
 */
require_once 'mySQLConnection.php';
require_once '../DTO/region.php';

class RegionRequest
{
    private $_dbh;
    public function __construct()
    {
        try{
            $this->_dbh = MySQLConn::getConn();

        }catch (PDOException $e){
            die('Connection failed:'.$e->getMessage());
        }
    }

    public function insertRegion($regionName, $adminId){
        //The query for inserting a new region, if the region already exists, we do not add it
        if(empty($this->getRegionByName($regionName))) {
            try {
                $sth = $this->_dbh->prepare("INSERT INTO region (name, admin_id) VALUES (:name, :admin_id)");
                $sth->bindParam(':name', $regionName);
                $sth->bindParam(':admin_id', $adminId);
                if ($sth->execute()) {
                    echo "Ajout réussi !";
                } else {
                    echo "Ajout échoué !";
                }
            } catch (PDOException $e) {
                die('Connection failed:' . $e->getMessage());
            }
        }
    }
    public function getRegionById($regionId){
        //The query for getting one region
        $query = "SELECT _id, name, admin_id FROM region WHERE _id = '$regionId'";

        $result = $this->_dbh->query($query);
        $returnedRegions = null;
        while ($row = $result->fetch()) {
            $returnedRegions= new Region($row['_id'], $row['name'], $row['admin_id']);
        }
        return $returnedRegions;
    }
    public function getRegionByName($regionName){
        //The query for getting one region
        $query = "SELECT _id, name, admin_id FROM region WHERE name = '$regionName'";

        $result = $this->_dbh->query($query);
        $returnedRegions = null;
        while ($row = $result->fetch()) {
            $returnedRegions= new Region($row['_id'], $row['name'], $row['admin_id']);
        }
        return $returnedRegions;
    }

    public function getAllRegion()
    {
        //The query for getting one region
        $query = "SELECT _id, name, admin_id FROM region";

        $result = $this->_dbh->query($query);
        $returnedRegions = array();
        while ($row = $result->fetch()) {
            array_push($returnedRegions, new Region($row['_id'], $row['name'], $row['admin_id']));
        }
        return $returnedRegions;
    }
    public function updateRegion($regionId, $regionName, $regionAdminId){
        //The query for modifying an user
        $regionId = intval($regionId);
        $regionAdminId = intval($regionAdminId);
        if(!empty($this->getRegionById($regionId))) {
            try {
                $sth = $this->_dbh->prepare("UPDATE region SET name=:name, admin_id=:admin_id WHERE _id = :region_id");
                $sth->bindParam(':region_id', $regionId);
                $sth->bindParam(':name', $regionName);
                $sth->bindParam(':admin_id', $regionAdminId);
                if ($sth->execute()) {
                    echo "update réussi !";
                } else {
                    echo "update échouée !";
                }
            } catch (PDOException $e) {
                die('Connection failed:' . $e->getMessage());
            }
        }
    }
    public function deleteRegion($regionId){
        //The query for removing a Region
        try{
            $sth = $this->_dbh->prepare("DELETE FROM `region` WHERE _id = :regionId");
            $sth->bindParam(':regionId', $regionId);

            if ($sth->execute()) {
                echo "suppression réussi !";
            } else {
                echo "suppresion échouée !";
            }
        } catch (PDOException $e) {
            die('Connection failed:' . $e->getMessage());
        }
    }
}