<?php

require_once("Config\Autoload.php");

use Controllers\UserRepository as UserRepository;
use Models\User as User;

if(_POST){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $User = new User();
    $User->setEmail($email);
    $User->setPassword($password);

    $UserRepository = new UserRepository();
    $UserRepository->Add($User);

}

?>