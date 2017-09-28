<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:09
 */

class Line
{
    private $_id;
    private $_trailer;
    private $_driverId;

    /**
     * line constructor.
     * @param $_id
     * @param $_trailer
     * @param $_driverId
     */
    public function __construct($_id, $_trailer, $_driverId)
    {
        $this->_id = $_id;
        $this->_trailer = $_trailer;
        $this->_driverId = $_driverId;
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
    public function getTrailer()
    {
        return $this->_trailer;
    }

    /**
     * @param mixed $trailer
     */
    public function setTrailer($trailer)
    {
        $this->_trailer = $trailer;
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->_driverId;
    }

    /**
     * @param mixed $driverId
     */
    public function setDriverId($driverId)
    {
        $this->_driverId = $driverId;
    }

}