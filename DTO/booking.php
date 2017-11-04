<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

class Booking
{
    private $_id;
    private $_departureStation;
    private $_arrivalStation;
    private $_nbrBike;
    private $_name;
    private $_mail;
    private $_phone;
    private $_departureHour;
    private $_arrivalHour;

    /**
     * Booking constructor.
     * @param $_id
     * @param $_departureStation
     * @param $_arrivalStation
     * @param $_nbrBike
     * @param $_nom
     * @param $_mail
     * @param $_phone
     * @param $_departureHour
     * @param $_arrivalHour
     */
    public function __construct($_id, $_departureStation, $_arrivalStation, $_nbrBike, $_nom, $_mail, $_phone, $_departureHour, $_arrivalHour)
    {
        $this->_id = $_id;
        $this->_departureStation = $_departureStation;
        $this->_arrivalStation = $_arrivalStation;
        $this->_nbrBike = $_nbrBike;
        $this->_name = $_nom;
        $this->_mail = $_mail;
        $this->_phone = $_phone;
        $this->_departureHour = $_departureHour;
        $this->_arrivalHour = $_arrivalHour;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
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
    public function getNbrBike()
    {
        return $this->_nbrBike;
    }

    /**
     * @param mixed $nbrBike
     */
    public function setNbrBike($nbrBike)
    {
        $this->_nbrBike = $nbrBike;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->_mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getDepartureHour()
    {
        return $this->_departureHour;
    }

    /**
     * @param mixed $departureHour
     */
    public function setDepartureHour($departureHour)
    {
        $this->_departureHour = $departureHour;
    }

    /**
     * @return mixed
     */
    public function getArrivalHour()
    {
        return $this->_arrivalHour;
    }

    /**
     * @param mixed $arrivalHour
     */
    public function setArrivalHour($arrivalHour)
    {
        $this->_arrivalHour = $arrivalHour;
    }

}