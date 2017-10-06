<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 09:51
 */
require_once 'mySQLConnection.php';

class ImportRequest
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

    public function insertStation($stationName, $region){

    }
    public function getStation($stationId = NULL, $stationName = NULL){

    }
    public function insertRegion($regionName, $adminId){
        //The query for inserting a new region
        try{
            $sth = $this->_dbh->prepare("INSERT IGNORE INTO region (name, admin_id) VALUES (:name, :admin_id)");
            $sth->bindParam(':name', $regionName);
            $sth->bindParam(':admin_id', $adminId);
            if ($sth->execute()){
                echo "Ajout réussi !";
            }
            else{
                echo "Ajout échoué !";
            }
        }catch (PDOException $e){
            die('Connection failed:'.$e->getMessage());
        }
    }
    public function getRegion($regionId = NULL, $regionName = NULL){
        //The query for getting one or several region
        $query = 'SELECT * FROM region';

        //if the region id is specified
        if(isset($regionId)){
            $query = $query." WHERE _id = $regionId";
            //if the region name is specified
            if(isset($regionName)){
                $query = $query." AND name = '$regionName'";
            }
        }
        else{
            //if the region name is specified we need to specify it since the requets won't be the same if the id is specified or not
            if(isset($regionName)){
                $query = $query." WHERE name = '$regionName'";
            }
        }
        //if the region id or the region name is not specified, we do not need to modify the query
        $result = $this->_dbh->query($query);
        $returnedRegions = array();


        while($row = $result->fetch()) {
            $returnedRegions = "id: {$row['_id']}, name: {$row['name']}<br>";
        }
        return $returnedRegions;
    }
}