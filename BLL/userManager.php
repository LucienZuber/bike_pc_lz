<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:32
 */

require_once ('../DAL/userRequest.php');
require_once ('../DTO/user.php');

class UserManager
{
    private $userRequest;

    public function __construct()
    {
        $this->userRequest = new UserRequest();
    }

    public function addUser($userName, $userPassword, $userMail, $userPhone, $roleId)
    {
        $this->userRequest->insertUser($userName, $userPassword, $userMail, $userPhone, $roleId);
    }

    public function modifyUser($user){
        $this->userRequest->modifyUser($user->getId(), $user->getName(), $user->getPassword(), $user->getMail(), $user->getPhone(), $user->getRoleId());

    }

    public function deleteUser($userId){
        $this->userRequest->deleteUser($userId);
    }

    public function getAllUsersByRole($userRole){
        return $this->userRequest->getUsersByRole($userRole);
    }

    public function getUsersById($id){
        return $this->userRequest->getUserById($id);
    }

    public function getUsersByNameAndRoleId($name, $roleId){
        return $this->userRequest->getUserByNameAndRoleId($name, $roleId);
    }

    public function getAllUsers(){
        return $this->userRequest->getAllUser();
    }

    public function readAddedUser()
    {
        foreach ($this->listOfUser as $key => $value) {
            $this->addUser($value);
            echo "$key : $value <br>";
        }
    }
}
?>