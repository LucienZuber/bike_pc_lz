<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:05
 */

require_once 'mySQLConnection.php';
require_once '../DTO/user.php';

//This class contain sql queries for the user
class UserRequest
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
    //INSERT USER
    public function insertUser($userName, $userPassword, $userMail, $userPhone, $roleId){
        //The query for inserting a new user
        if(empty($this->getUserByNameAndRoleId($userName, $roleId))) {
            try {
                $sth = $this->_dbh->prepare("INSERT INTO user (name, password, mail, phone, role_id) VALUES (:name, :password, :mail, :phone, :role_id)");
                $sth->bindParam(':name', $userName);
                $sth->bindParam(':password', $userPassword);
                $sth->bindParam(':mail', $userMail);
                $sth->bindParam(':phone', $userPhone);
                $sth->bindParam(':role_id', $roleId);
                if ($sth->execute()) {

                } else {
                    echo "Ajout échoué !";
                }
            } catch (PDOException $e) {
                die('Connection failed:' . $e->getMessage());
            }
        }
    }
    public function modifyUser($userId, $userName, $userPassword, $userMail, $userPhone, $roleId){
        //The query for modifying an user
        $userId = intval($userId);
        if(!empty($this->getUserById($userId))) {
            try {
                $roleId = intval($roleId);
                $sth = $this->_dbh->prepare("UPDATE user SET name=:name, password=:password, mail=:mail, phone=:phone, role_id=:role_id WHERE _id = :user_id");
                $sth->bindParam(':name', $userName);
                $sth->bindParam(':password', $userPassword);
                $sth->bindParam(':mail', $userMail);
                $sth->bindParam(':phone', $userPhone);
                $sth->bindParam(':role_id', $roleId);
                $sth->bindParam(':user_id', $userId);
                if ($sth->execute()) {

                } else {
                    echo "update échouée !";
                }
            } catch (PDOException $e) {
                die('Connection failed:' . $e->getMessage());
            }
        }
    }

    public function getUsersByNameAndPassword($userName, $userPassword){
        //The query for getting one user by name and password

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user WHERE name = '$userName' AND password = '$userPassword'";

        $result = $this->_dbh->query($query);
        $returnedUser = null;
        while ($row = $result->fetch()) {
            $returnedUser= new User($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']);
        }
        return $returnedUser;
    }

    public function getUserById($userId){
        //The query for getting one user by id

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user WHERE _id = $userId";

        $result = $this->_dbh->query($query);
        $returnedUser = null;
        while ($row = $result->fetch()) {
            $returnedUser= new User($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']);
        }
        return $returnedUser;
    }

    public function getUsersByRole($userRole){
        //The query for getting users by role

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user WHERE role_id = $userRole";

        $result = $this->_dbh->query($query);
        $returnedUsers = array();
        while ($row = $result->fetch()) {
            array_push($returnedUsers, new User($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']));
        }
        return $returnedUsers;
    }

    public function getUserByNameAndRoleId($userName, $roleId){
        //The query for getting user by name and role

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user WHERE name = '$userName' AND role_id = $roleId";

        $result = $this->_dbh->query($query);
        $returnedUser = null;
        while ($row = $result->fetch()) {
            $returnedUser= new User($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']);
        }
        return $returnedUser;
    }
    public function deleteUser($userId){
        //The query for removing a User
        try{
            $sth = $this->_dbh->prepare("DELETE FROM `user` WHERE _id = :userId");
            $sth->bindParam(':userId', $userId);

            if ($sth->execute()) {

            } else {
                echo "suppresion échouée !";
            }
        } catch (PDOException $e) {
            die('Connection failed:' . $e->getMessage());
        }
    }
    public function getAllUser(){
        //The query for getting one user

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user";

        $result = $this->_dbh->query($query);
        $returnedUsers = array();
        while ($row = $result->fetch()) {
            array_push($returnedUsers, new User($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']));
        }
        return $returnedUsers;
    }
}