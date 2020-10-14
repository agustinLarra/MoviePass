<?php namespace Models;

class Person{

    private $firstName;
    private $lastName;
    private $dni;

    function __construct(){
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

}

?>