<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 03.11.2017
 * Time: 11:55
 */

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
}