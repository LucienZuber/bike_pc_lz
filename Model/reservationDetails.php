<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 10:45
 */

//THis class is the model for the reservation details

class ReservationDetails
{
    private $_name;
    private $_phone;
    private $_mail;
    private $_numberBike;

    /**
     * ReservationDetails constructor.
     * @param $_name
     * @param $_phone
     * @param $_mail
     * @param $_numberBike
     */
    public function __construct($_name, $_phone, $_mail, $_numberBike)
    {
        $this->_name = $_name;
        $this->_phone = $_phone;
        $this->_mail = $_mail;
        $this->_numberBike = $_numberBike;
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
    public function getNumberBike()
    {
        return $this->_numberBike;
    }

    /**
     * @param mixed $numberBike
     */
    public function setNumberBike($numberBike)
    {
        $this->_numberBike = $numberBike;
    }

}