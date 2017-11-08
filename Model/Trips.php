<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 31.10.2017
 * Time: 12:29
 */

//This class is the model for the trips

class Trips
{
    private $_departureStation;
    private $_departureDateTime;
    private $_arrivalStation;
    private $_arrivalDateTime;

    /**
     * PreBooking constructor.
     * @param $_departureStation
     * @param $_departureDateTime
     * @param $_arrivalStation
     * @param $_arrivalDateTime
     */
    public function __construct($_departureStation, $_departureDateTime, $_arrivalStation, $_arrivalDateTime)
    {
        $this->_departureStation = $_departureStation;
        $this->_departureDateTime = $_departureDateTime;
        $this->_arrivalStation = $_arrivalStation;
        $this->_arrivalDateTime = $_arrivalDateTime;
    }

    /**
     * @return mixed
     */
    public function getDepartureStation()
    {
        return $this->_departureStation;
    }

    /**
     * @param mixed $departureStation
     */
    public function setDepartureStation($departureStation)
    {
        $this->_departureStation = $departureStation;
    }

    /**
     * @return mixed
     */
    public function getDepartureDateTime()
    {
        return $this->_departureDateTime;
    }

    /**
     * @param mixed $departureDateTime
     */
    public function setDepartureDateTime($departureDateTime)
    {
        $this->_departureDateTime = $departureDateTime;
    }

    /**
     * @return mixed
     */
    public function getArrivalStation()
    {
        return $this->_arrivalStation;
    }

    /**
     * @param mixed $arrivalStation
     */
    public function setArrivalStation($arrivalStation)
    {
        $this->_arrivalStation = $arrivalStation;
    }

    /**
     * @return mixed
     */
    public function getArrivalDateTime()
    {
        return $this->_arrivalDateTime;
    }

    /**
     * @param mixed $arrivalDateTime
     */
    public function setArrivalDateTime($arrivalDateTime)
    {
        $this->_arrivalDateTime = $arrivalDateTime;
    }

}