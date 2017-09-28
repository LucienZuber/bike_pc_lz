<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 27.09.2017
 * Time: 16:08
 */

class User{
    private $_id;
    private $_name;
    private $_password;
    private $_mail;
    private $_phone;
    private $_roleId;

    /**
     * user constructor.
     * @param $_id
     * @param $_name
     * @param $_password
     * @param $_mail
     * @param $_phone
     * @param $_roleId
     */
    public function __construct($_id, $_name, $_password = "", $_mail, $_phone, $_roleId)
    {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_password = $_password;
        $this->_mail = $_mail;
        $this->_phone = $_phone;
        $this->_roleId = $_roleId;
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
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
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
    public function getRoleId()
    {
        return $this->_roleId;
    }

    /**
     * @param mixed $roleId
     */
    public function setRoleId($roleId)
    {
        $this->_roleId = $roleId;
    }

}
?>