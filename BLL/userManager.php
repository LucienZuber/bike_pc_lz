<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:32
 */

require_once '../DAL/userRequest.php';
require_once '../DTO/user.php';

class userManager
{
    private $userRequest;
    private $user;

    public function __construct()
    {
        $this->userRequest = new userRequest();
    }

    public function addUser($userName, $userPassword, $userMail, $userPhone, $roleId)
    {
        $this->userRequest->insertUser($userName, $userPassword, $userMail, $userPhone, $roleId);
        $this->user = $this->userRequest->getUser($userName, $roleId);
    }

    public function deleteUser($userId){
        $this->userRequest->deleteUser($userId);
    }

    public function readAddedUser()
    {
        foreach ($this->listOfUser as $key => $value) {
            $this->addUser($value);
            echo "$key : $value <br>";
        }
    }
}