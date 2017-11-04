<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:55
 */

require_once "../DTO/driver.php";

class DriverRequest
{

    private $_dbh;
    public function __construct()
    {
        try {
            $this->_dbh = MySQLConn::getConn();

        } catch (PDOException $e) {
            die('Connection failed:' . $e->getMessage());
        }

    }
    public function insertDriver($driverId, $regionId){
        //The query for inserting a new driver

        try {
            $driverId = intval($driverId);
            $regionId = intval($regionId);
            $sth = $this->_dbh->prepare("INSERT INTO drivers (driver_id, region_id) VALUES (:driver_id, :region_id)");
            $sth->bindParam(':driver_id', $driverId);
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
    public function getDriverByDriverId($driverId){
        $driverId = intval($driverId);
        $query = "SELECT driver_id, region_id FROM drivers WHERE driver_id = '$driverId'";
        $result = $this->_dbh->query($query);
        $returnedDriver = null;
        while ($row = $result->fetch()) {
            $returnedDriver= new Driver($row['driver_id'], $row['region_id']);
        }
        return $returnedDriver;
    }
    public function updateDriver($driverId, $regionId){
        try {
            $driverId = intval($driverId);
            $regionId = intval($regionId);
            $sth = $this->_dbh->prepare("UPDATE drivers SET region_id=:region_id WHERE driver_id = :driver_id");
            $sth->bindParam(':driver_id', $driverId);
            $sth->bindParam(':region_id', $regionId);
            if ($sth->execute()) {
                echo "Update réussi !";
            } else {
                echo "Update échoué !";
            }

        } catch (PDOException $e) {
            die('Connection failed:' . $e->getMessage());
        }
    }
}