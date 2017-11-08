<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:32
 */

require_once ('../DAL/userRequest.php');
require_once ('../DTO/user.php');


//This class has a list of function related to the user
class UserManager
{
    private $userRequest;

    public function __construct()
    {
        $this->userRequest = new UserRequest();
    }

    //This function add a new user
    public function addUser($userName, $userPassword, $userMail, $userPhone, $roleId)
    {
        $this->userRequest->insertUser($userName, $userPassword, $userMail, $userPhone, $roleId);
    }

    //This function modify a user
    public function modifyUser($user){
        $this->userRequest->modifyUser($user->getId(), $user->getName(), $user->getPassword(), $user->getMail(), $user->getPhone(), $user->getRoleId());

    }

    //This function delete a user
    public function deleteUser($userId){
        $this->userRequest->deleteUser($userId);
    }

    //This function return a list of all users having the same role
    public function getAllUsersByRole($userRole){
        return $this->userRequest->getUsersByRole($userRole);
    }

    //This function return a user by its id
    public function getUsersById($id){
        return $this->userRequest->getUserById($id);
    }

    //this function return a user by its name and role
    public function getUsersByNameAndRoleId($name, $roleId){
        return $this->userRequest->getUserByNameAndRoleId($name, $roleId);
    }

    //This function return a user by its name and password
    public function getUsersByNameAndPassword($name, $password){
        return $this->userRequest->getUsersByNameAndPassword($name, $password);
    }

    //This function return a list of all users
    public function getAllUsers(){
        return $this->userRequest->getAllUser();
    }
}
?>