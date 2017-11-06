<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 10:50
 */

require_once "../DTO/booking.php";

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
        //The query for inserting a new booking

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

    public function getAllBooking(){
        //The query for getting one user

        $query = "SELECT _id, departure_id, arrival_id, nbr_bike, name, mail, phone, departure_hour, arrival_hour FROM booking";

        $result = $this->_dbh->query($query);
        $returnedBookings = array();
        while ($row = $result->fetch()) {
            array_push($returnedBookings, new Booking($row['_id'], $row['departure_id'], $row['arrival_id'], $row['nbr_bike'], $row['name'], $row['mail'], $row['phone'], $row['departure_hour'], $row['arrival_hour']));
        }
        return $returnedBookings;
    }

    public function updateBooking($bookingId, $departureStationId, $arrivalStationId, $nbrBike, $name, $mail, $phone, $departureHour, $arrivalHour){
        //The query for inserting a new booking

        try {
            $bookingId = intval($bookingId);
            $departureStationId = intval($departureStationId);
            $arrivalStationId = intval($arrivalStationId);
            $nbrBike = intval($nbrBike);
            $sth = $this->_dbh->prepare("UPDATE booking SET departure_id = :departure_id, arrival_id = :arrival_id, nbr_bike = :nbr_bike, name = :name, mail = :mail, phone = :phone, departure_hour = :departure_hour, arrival_hour = :arrival_hour) WHERE _id = :_id");
            $sth->bindParam(':_id', $bookingId);
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

    public function getBookingById($bookingId)
    {
        $bookingId = intval($bookingId);
        $query = "SELECT _id, departure_id, arrival_id, nbr_bike, name, mail, phone, departure_hour, arrival_hour FROM drivers WHERE _id = '$bookingId'";
        $result = $this->_dbh->query($query);
        $returnedBooking = null;
        while ($row = $result->fetch()) {
            $returnedBooking= new Booking($row['_id'], $row['departure_id'], $row['arrival_id'], $row['nbr_bike'], $row['name'], $row['mail'], $row['phone'], $row['departure_hour'], $row['arrival_hour']);
        }
        return $returnedBooking;

    }

        public function deleteBooking($bookingId){
        //The query for removing a User
        $bookingId = intval($bookingId);
        try{
            $sth = $this->_dbh->prepare("DELETE FROM booking WHERE _id = :bookingId");
            $sth->bindParam(':bookingId', $bookingId);

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