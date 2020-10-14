<?php
namespace Models;

class User{
    private $email;
    private $password;

    function __construct($email,$password){
        $this->$email = $email;
        $this->$password = $password;
    // tiene que ir constructor vacio.
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setEmail(){
        $this->email = $email;
    }

    public function setPassword(){
        $this->password = $password;
    }

}

?>