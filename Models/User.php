<?php
namespace Models;

class User{
    private $email;
    private $password;
<<<<<<< HEAD
    
=======
    private $firstName;
    private $lastName;
    private $dni;
>>>>>>> 3057da1d08a39543614fcdde3f7eda24dbcfe4d0

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