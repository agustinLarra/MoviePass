<?php 

namespace Controllers;
use Models\User as User;
use DAO\UserDAO as UserDAO;


class UserController{
    
    public function login($email,$password){
    
        ///levantar del json. 
        $userDAO = new UserDAO();
        $userList = $userDAO->GetAll();

        
        ///comparo con los del parametro 

        ///si son creo la session

    }


}



?>