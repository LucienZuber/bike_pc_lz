<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

//This class define the role model

class Role{
    private $_id;
    private $_name;

    /**
     * role constructor.
     * @param $_id
     * @param $_name
     */
    public function __construct($_id, $_name)
    {
        $this->_id = $_id;
        $this->_name = $_name;
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


}
?>