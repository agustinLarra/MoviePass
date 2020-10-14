<?php 

namespace Controllers;
use Models\User as User;
use DAO\UserDAO as UserDAO;


class UserController{
    
    public function login($email,$password){
    
        $userDAO = new UserDAO();
        $userList = $userDAO->GetAll();

        $loggedUser = new User();

        $correctUser = 'Pepito@gmail.com';
        $correctPassword = '12345';

        if($correctUser == $email){
            echo "putamadre";
            if($correctPassword == $password){
                echo"putamadre2";
                $loggedUser->setEmail($email);
                    $loggedUser->setPassword($password);
                    session_start();
                    $_SESSION['loggedUser'] = $loggedUser;

                    header('location:home.php');
            }
        }
    }
}


/*
        foreach($userList as $value){
            if($email == $value->getEmail()){
                if($password == $value->getPassword()){
                    $loggedUser->setEmail($email);
                    $loggedUser->setPassword($password);
                    session_start();
                    $_SESSION['loggedUser'] = $loggedUser;

                    header('location:home.php');

                    }
                }
            }
        }
    }
*/
?>