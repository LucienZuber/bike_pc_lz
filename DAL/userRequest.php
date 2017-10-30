<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:05
 */

require_once 'mySQLConnection.php';
require_once '../DTO/user.php';

class userRequest
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
        if(empty($this->getUser($userName, $roleId))) {
            try {
                $sth = $this->_dbh->prepare("INSERT INTO user (name, password, mail, phone, role_id) VALUES (:name, :password, :mail, :phone, :role_id)");
                $sth->bindParam(':name', $userName);
                $sth->bindParam(':password', $userPassword);
                $sth->bindParam(':mail', $userMail);
                $sth->bindParam(':phone', $userPhone);
                $sth->bindParam(':role_id', $roleId);
                if ($sth->execute()) {
                    echo "Ajout réussi !";
                } else {
                    echo "Ajout échoué !";
                }
            } catch (PDOException $e) {
                die('Connection failed:' . $e->getMessage());
            }
        }
    }
    public function getUser($userName, $roleId){
        //The query for getting one user

        $query = "SELECT _id, name, password, mail, phone, role_id FROM user WHERE name = '$userName' AND role_id = $roleId";

        $result = $this->_dbh->query($query);
        $returnedUser = "";
        var_dump($query);
        while ($row = $result->fetch()) {
            $returnedUser= new userManager($row['_id'], $row['name'], $row['password'], $row['mail'], $row['phone'], $row['role_id']);
        }
        return $returnedUser;
    }
}