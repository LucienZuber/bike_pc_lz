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
    private $_user;
    private $_departure;
    private $_arrival;
    private $_nbrBike;

    /**
     * booking constructor.
     * @param $_id
     * @param $_user
     * @param $_departure
     * @param $_arrival
     * @param $_nbrBike
     */
    public function __construct($_id, $_user, $_departure, $_arrival, $_nbrBike)
    {
        $this->_id = $_id;
        $this->_user = $_user;
        $this->_departure = $_departure;
        $this->_arrival = $_arrival;
        $this->_nbrBike = $_nbrBike;
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
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->_departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->_departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->_arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->_arrival = $arrival;
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
}