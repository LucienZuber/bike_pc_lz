<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 09:51
 * this class allows you to do request about the station on the DB
 */
require_once 'mySQLConnection.php';
require_once '../DTO/station.php';

class StationRequest
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

    public function insertStation($stationName, $regionId){
        //The query for inserting a new station

        if(empty($this->getStationByNameAndRegionId($stationName, $regionId))) {
            try {
                $sth = $this->_dbh->prepare("INSERT INTO station (name, region_id) VALUES (:name, :region_id)");
                $sth->bindParam(':name', $stationName);
                $sth->bindParam(':region_id', $regionId);
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
    public function getStationByNameAndRegionId($stationName, $regionId){
        //The query for getting one station
        $stationName = str_replace("'", "\'", $stationName);
        $query = "SELECT _id, name, region_id FROM station WHERE name = '$stationName' AND region_id = $regionId";

        $result = $this->_dbh->query($query);
        $returnedStations = null;
        while ($row = $result->fetch()) {
            $returnedStations= new Station($row['_id'], $row['name'], $row['region_id']);
        }
        return $returnedStations;
    }
    public function getStationByName($stationName){
        //The query for getting one station
        $stationName = str_replace("'", "\'", $stationName);
        $query = "SELECT _id, name, region_id FROM station WHERE name = '$stationName'";

        $result = $this->_dbh->query($query);
        $returnedStations = null;
        while ($row = $result->fetch()) {
            $returnedStations= new Station($row['_id'], $row['name'], $row['region_id']);
        }
        return $returnedStations;
    }
}