<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 10:50
 */

require_once "../DTO/booking.php";

//This class regroup the sql request for the booking

class BookingRequest
{
    private $_dbh;
    public function __construct()
    {
        try{
            $this->_dbh = MySQLConn::getConn();

        }catch (PDOException $e){
            die('Connection failed/Connexion échouée/Verbindung fehlgeschlagen:'.$e->getMessage());
        }
    }

    //This function is used to insert a new booking
    public function insertBooking($departureStationId, $arrivalStationId, $nbrBike, $name, $mail, $phone, $departureHour, $arrivalHour){

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

            } else {
                echo "Add Failed/Ajout échoué/Hinzufügen fehlgeschlagen!";
            }

        } catch (PDOException $e) {
            die('Connection failed/Connexion échouée/Verbindung fehlgeschlagen:' . $e->getMessage());
        }
    }

    //This function return a list of all bookings
    public function getAllBooking(){

        $query = "SELECT _id, departure_id, arrival_id, nbr_bike, name, mail, phone, departure_hour, arrival_hour FROM booking ORDER BY departure_hour";

        $result = $this->_dbh->query($query);
        $returnedBookings = array();
        while ($row = $result->fetch()) {
            array_push($returnedBookings, new Booking($row['_id'], $row['departure_id'], $row['arrival_id'], $row['nbr_bike'], $row['name'], $row['mail'], $row['phone'], $row['departure_hour'], $row['arrival_hour']));
        }
        return $returnedBookings;
    }

    //This function upudate a booking
    public function updateBooking($bookingId, $departureStationId, $arrivalStationId, $nbrBike, $name, $mail, $phone, $departureHour, $arrivalHour){

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

            } else {
                echo "Add Failed/Ajout échoué/Hinzufügen fehlgeschlagen!";
            }

        } catch (PDOException $e) {
            die('Connection failed/Connexion échouée/Verbindung fehlgeschlagen:' . $e->getMessage());
        }
    }

    //this function return a list of the bookings by a region
    public function getBookingByRegion($regionId){
        $regionId = intval($regionId);
        $query = "SELECT B._id, B.departure_id, B.arrival_id, B.nbr_bike, B.name, B.mail, B.phone, B.departure_hour, B.arrival_hour FROM booking B, station S, region R WHERE B.departure_id = S._id AND S.region_id = R._id AND R._id = $regionId ORDER BY B.departure_hour";

        $result = $this->_dbh->query($query);
        $returnedBookings = array();
        while ($row = $result->fetch()) {
            array_push($returnedBookings, new Booking($row['_id'], $row['departure_id'], $row['arrival_id'], $row['nbr_bike'], $row['name'], $row['mail'], $row['phone'], $row['departure_hour'], $row['arrival_hour']));
        }
        return $returnedBookings;
    }

    //This function return a booking by its id
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

    //This function delete a booking
    public function deleteBooking($bookingId){
    //The query for removing a User
    $bookingId = intval($bookingId);
        try{
            $sth = $this->_dbh->prepare("DELETE FROM booking WHERE _id = :bookingId");
            $sth->bindParam(':bookingId', $bookingId);

            if ($sth->execute()) {

            } else {
                echo "Failed Deletion/Suppresion échouée/Fehlgeschlagene Löschung!";
            }
        } catch (PDOException $e) {
        die('Connection failed/Connexion échouée/Verbindung fehlgeschlagen:' . $e->getMessage());
        }
    }

}