<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

class Station implements JsonSerializable
{
    private $_id;
    private $_name;
    private $_regionId;

    /**
     * station constructor.
     * @param $_id
     * @param $_name
     * @param $regionId
     */
    public function __construct($_id, $name, $regionId)
    {
        $this->_id = $_id;
        $this->_name = $name;
        $this->_regionId = $regionId;
    }

    public function jsonSerialize() {
        return [
            '_id' => $this->getId(),
            'name' => $this->getName(),
            'regionId' => $this->getRegionId()
        ];
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