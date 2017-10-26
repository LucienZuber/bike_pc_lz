<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 26.10.17
 * Time: 17:32
 */

require_once '../DAL/userRequest.php';
require_once '../DTO/user.php';

class user
{
    private $userRequest;
    private $user;

    public function addUser($userName, $userPassword, $userMail, $userPhone, $roleId)
    {
        $this->userRequest->insertUser($userName, $userPassword, $userMail, $userPhone, $roleId, 1);
        $this->user = $this->userRequest->getUser($userName, $roleId);
    }

    public function readAddedUser()
    {
        foreach ($this->listOfUser as $key => $value) {
            $this->addUser($value);
//            echo "$key : $value <br>";
        }
    }
}