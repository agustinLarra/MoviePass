<?php
namespace Models;

class User{
    private $email;
    private $password;

    function __construct(){
      
     //Se usa contructor vacio asi cuando se crea un usuario no hay que pasar por parametro lo de Person'
    //Usar user->setEmail, etc
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

}

?>