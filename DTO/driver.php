<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 04.11.2017
 * Time: 10:51
 */

//This class define the model driver

class Driver
{
    private $_driverId;
    private $_regionId;

    /**
     * Driver constructor.
     * @param $_driverId
     * @param $_regionId
     */
    public function __construct($_driverId, $_regionId)
    {
        $this->_driverId = $_driverId;
        $this->_regionId = $_regionId;
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

    /**
     * @return mixed
     */
    public function getRegionId()
    {
        return $this->_regionId;
    }

    /**
     * @param mixed $regionId
     */
    public function setRegionId($regionId)
    {
        $this->_regionId = $regionId;
    }
}