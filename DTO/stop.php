<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

class Stop
{
    private $_id;
    private $_departure;
    private $_arrival;
    private $_stationId;
    private $_lineId;
    private $_bookedBike;

    /**
     * stop constructor.
     * @param $_id
     * @param $_departure
     * @param $_arrival
     * @param $_stationId
     * @param $_lineId
     * @param $_bookedBike
     */
    public function __construct($_id, $_departure, $_arrival, $_stationId, $_lineId, $_bookedBike)
    {
        $this->_id = $_id;
        $this->_departure = $_departure;
        $this->_arrival = $_arrival;
        $this->_stationId = $_stationId;
        $this->_lineId = $_lineId;
        $this->_bookedBike = $_bookedBike;
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
    public function getStationId()
    {
        return $this->_stationId;
    }

    /**
     * @param mixed $stationId
     */
    public function setStationId($stationId)
    {
        $this->_stationId = $stationId;
    }

    /**
     * @return mixed
     */
    public function getLineId()
    {
        return $this->_lineId;
    }

    /**
     * @param mixed $lineId
     */
    public function setLineId($lineId)
    {
        $this->_lineId = $lineId;
    }

    /**
     * @return mixed
     */
    public function getBookedBike()
    {
        return $this->_bookedBike;
    }

    /**
     * @param mixed $bookedBike
     */
    public function setBookedBike($bookedBike)
    {
        $this->_bookedBike = $bookedBike;
    }

}