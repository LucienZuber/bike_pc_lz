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
        if(empty($this->getRegion($regionName))) {
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
    public function getRegion($regionName){
        //The query for getting one region
        $query = "SELECT _id, name, admin_id FROM region WHERE name = '$regionName'";

        $result = $this->_dbh->query($query);
        $returnedRegions = null;
        while ($row = $result->fetch()) {
            $returnedRegions= new Region($row['_id'], $row['name'], $row['admin_id']);
        }
        return $returnedRegions;
    }
}