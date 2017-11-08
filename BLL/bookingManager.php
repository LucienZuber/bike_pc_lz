<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 29.10.2017
 * Time: 18:43
 */

require_once "mailManager.php";
require_once "stationManager.php";
require_once '../DTO/booking.php';
require_once '../DTO/station.php';
require_once '../DAL/stationRequest.php';
require_once '../DAL/bookingRequest.php';
require_once '../Model/reservationDetails.php';
require_once '../Model/Trips.php';
require_once 'changeLanguage.php';
//This is the class that will manage the bookings
class BookingManager
{
    const URI = "https://timetable.search.ch/api/route.en.json";
    const ACCEPTED_TRANSPORT_TYPE = array('post'); //the list of transport type that will be returned by the API

    private $stationRequest;
    private $bookingRequest;
    private $stationManager;
    /**
     * BookingManager constructor.
     */
    public function __construct()
    {
        $this->stationRequest = new StationRequest();
        $this->bookingRequest = new BookingRequest();
        $this->stationManager = new StationManager();
    }

    public function displayTrips($departure, $arrival, $date, $time){
    //this class will query the search API to display the 4 next trip according to the stations and the time
        $param = array (
            'from' => $departure,
            'to' => $arrival,
            'date' => $date,
            'time' => $time,
            'time_type' => 'depart'
    );
        //We build the query

        $this->query = self::URI.'?'.http_build_query($param);
        $data = json_decode(file_get_contents($this->query), true);

        $listOfTrips=array();

        //we see every connection
        foreach ($data['connections'] as $connections){
            //we see every legs

            $from = $this->stationManager->checkIfStationExists($departure);
            $to = $this->stationManager->checkIfStationExists($arrival);
            if(is_null($from)||is_null($to)){
                echo "Please enter an existing station";
                return null;
            }
            if($from->getRegionId()!=$to->getRegionId()){
                if(is_null($this->stationRequest->getStationByNameAndRegionId($from->getName(), $to->getRegionId()))){
                    if(is_null($this->stationRequest->getStationByNameAndRegionId($to->getName(), $from->getRegionId()))){
                        echo "Merci de choisir une arrivée et un départ dans la même région !";
                        return null;
                    }
                    else{
                        $to = $this->stationRequest->getStationByNameAndRegionId($to->getName(), $from->getRegionId());
                    }
                }
                else{
                    $from = $this->stationRequest->getStationByNameAndRegionId($from->getName(), $to->getRegionId());
                }
            }
            array_push($listOfTrips, new Trips($from, $connections['departure'], $to, $connections['arrival']));
        }
        return $listOfTrips;
    }

    //This add a booking
    public function addBooking($trip, $reservationDetail){
        $this->bookingRequest->insertBooking(
            $trip->getDepartureStation()->getId(),
            $trip->getArrivalStation()->getId(),
            $reservationDetail->getNumberBike(),
            $reservationDetail->getName(),
            $reservationDetail->getMail(),
            $reservationDetail->getPhone(),
            $trip->getDepartureDateTime(),
            $trip->getArrivalDateTime()
        );
        $mailManager = new MailManager();
        //this send an email
        $mailManager->sendMailBookings("Réservation",
            "Merci d'avoir utiliser notre système de réservation. les détails sont: ",
            $reservationDetail->getMail(),
            $reservationDetail->getName(),
            $reservationDetail->getNumberBike(),
            $reservationDetail->getMail(),
            $trip->getDepartureStation()->getName(),
            $trip->getArrivalStation()->getName(),
            $trip->getDepartureDateTime(),
            $trip->getArrivalDateTime(),
            $reservationDetail->getPhone());
    }

    //This function return the list of bookings belonging to a region
    public function getBookingByRegion($regionId){
        return $this->bookingRequest->getBookingByRegion($regionId);
    }
    //This function return every bookings
    public function getAllBooking(){
        return $this->bookingRequest->getAllBooking();
    }
    //this function return a booking by its id
    public function getBookingById($bookingId){
        return $this->bookingRequest->getBookingById($bookingId);
    }
    //This function update a booking
    public function modifyBooking($booking)
    {
        $this->bookingRequest->modifyBooking($booking->getId(), $booking->getDepartureStation(), $booking->getArrivalStation(), $booking->getNbrBike(), $booking->getName(), $booking->getMail(), $booking->getPhone(), $booking->getDepartureHour(), $booking->getArrivalHour());
    }

    //This function check if the booking is finished or not, so it is displayed only if needed
    public function isBookingIfOutOfDate($booking){
        $arrivalHour = $booking->getArrivalHour();
        if(date('Y-m-d h:i:s') > $arrivalHour){
            return true;
        }
        return false;
    }

    //This function remove a booking
    public function deleteBooking($bookingId){
        $this->bookingRequest->deleteBooking($bookingId);
    }
}