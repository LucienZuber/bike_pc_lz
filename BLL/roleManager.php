<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 10:45
 */
require_once "../DTO/role.php";
require_once "../DAL/roleRequest.php";

//This class manager role functions
class RoleManager
{
    private $_roleRequest;

    public function __construct()
    {
        $this->_roleRequest = new RoleRequest();
    }

    //This function return a role by its id
    public function getRoleById($id){
        return $this->_roleRequest->getRoleById($id);
    }

    //This function return a list of all roles
    public function getAllRole(){
        return $this->_roleRequest->getAllRoleById();
    }

    //This function return a role by its name
    public function getRoleByName($name){
        return $this->_roleRequest->getRoleByName($name);
    }
}