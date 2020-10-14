<?php 

namespace Controllers;
use Models\User as User;
use DAO\UserDAO as UserDAO;


class UserController{
    
    public function login($email,$password){
    
        $userDAO = new UserDAO();
        $userList = $userDAO->GetAll();
        $loggedUser = NULL;

        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($password == $value->getPassword()){
                    $loggedUser = $value;
                    
                    echo "Ingreso correcto al sistema";
                    echo "Nuevo commit";

                    session_start();
                    $_SESSION['loggedUser'] = $loggedUser;
                    header('location:../Views/home.php');

                    
                }
                else{
                    header('location:/MoviePass/');
                }
            }
            else{
                header('location:/MoviePass/');
            }
        }
    }
}
