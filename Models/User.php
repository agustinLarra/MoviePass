<?php
namespace Models;

class User{
    private $firstName;
    private $lastName;
    private $dni;
    private $email;
    private $password;
    

    function __construct(){
        //Se usa contructor vacio asi cuando se crea un usuario no hay que pasar por parametro lo de Person'
    //Usar user->setEmail, etc
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getDni(){
        return $this->dni;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setDni($dni){
        $this->dni = $dni;
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