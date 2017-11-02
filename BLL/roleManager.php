<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 10:45
 */
require_once "../DTO/role.php";
require_once "../DAL/roleRequest.php";

class RoleManager
{
    private $_roleRequest;

    public function __construct()
    {
        $this->_roleRequest = new RoleRequest();
    }
    public function getRoleById($id){
        return $this->_roleRequest->getRoleById($id);
    }
    public function getAllRole(){
        return $this->_roleRequest->getAllRoleById();
    }
}