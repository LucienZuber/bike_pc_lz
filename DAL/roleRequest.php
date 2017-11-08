<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 02.11.2017
 * Time: 10:42
 */
require_once "../DTO/role.php";
require_once "mySQLConnection.php";

//The class concerning the sql queries for the role
class RoleRequest
{
    private $_dbh;
    public function __construct()
    {
        try{
            $this->_dbh = MySQLConn::getConn();

        }catch (PDOException $e){
            die('Connection failed:'.$e->getMessage());
        }
    }

    //The function to return a role by its id
    public function getRoleById($id){
        //The query for getting one user

        $query = "SELECT _id, name FROM role WHERE _id = $id";

        $result = $this->_dbh->query($query);
        $returnedRole = null;
        while ($row = $result->fetch()) {
            $returnedRole = new Role($row['_id'], $row['name']);
        }
        return $returnedRole;
    }

    //The function to return a role by its name
    public function getRoleByName($name){
        $query = "SELECT _id, name FROM role WHERE name = '$name'";

        $result = $this->_dbh->query($query);
        $returnedRole = null;
        while ($row = $result->fetch()) {
            $returnedRole = new Role($row['_id'], $row['name']);
        }
        return $returnedRole;
    }

    //The function to return a list of all roles
    public function getAllRole(){
        //The query for getting one user

        $query = "SELECT _id, name FROM role";

        $result = $this->_dbh->query($query);
        $returnedRoles = array();
        while ($row = $result->fetch()) {
            array_push($returnedRoles, new Role($row['_id'], $row['name']));
        }
        return $returnedRoles;
    }
}