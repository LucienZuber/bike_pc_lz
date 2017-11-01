<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 10:50
 */

class BookingRequest
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

    public function insertBooking($departureStationId, $arrivalStationId, $nbrBike, $name, $mail, $phone, $departureHour, $arrivalHour){
        //The query for inserting a new station

        try {
            $departureStationId = intval($departureStationId);
            $arrivalStationId = intval($arrivalStationId);
            $nbrBike = intval($nbrBike);
            $sth = $this->_dbh->prepare("INSERT INTO booking (departure_id, arrival_id, nbr_bike, name, mail, phone, departure_hour, arrival_hour) VALUES (:departure_id, :arrival_id, :nbr_bike, :name, :mail, :phone, :departure_hour, :arrival_hour)");
            $sth->bindParam(':departure_id', $departureStationId);
            $sth->bindParam(':arrival_id', $arrivalStationId);
            $sth->bindParam(':nbr_bike', $nbrBike);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':mail', $mail);
            $sth->bindParam(':phone', $phone);
            $sth->bindParam(':departure_hour', $departureHour);
            $sth->bindParam(':arrival_hour', $arrivalHour);
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