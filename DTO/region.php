<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

//This class define the region model

class Region
{
    private $_id;
    private $_name;
    const TOTAL_BIKE = 6;
    private $_adminId;

    /**
     * region constructor.
     * @param $_id
     * @param $_name
     * @param $_totalBike
     * @param $_adminId
     */
    public function __construct($_id, $_name, $_adminId)
    {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_adminId = $_adminId;
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
    public function getAdminId()
    {
        return $this->_adminId;
    }

    /**
     * @param mixed $adminId
     */
    public function setAdminId($adminId)
    {
        $this->_adminId = $adminId;
    }

}