<?php
namespace Models;

class Cine{

    private $nombre;
    private $ciudad;
    private $calle;
    private $numero ;



    public function getNombre(){
        return $this->nombre ;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre ;
    }

    public function getCiudad(){
        return $this->ciudad ;
    }
    public function setCiudad($ciudad){
        $this->ciudad = $ciudad ;
    }

    public function getNumero(){
        return $this->numero ;
    }
    public function setNumero($numero){
        $this->numero = $numero ;
    }

    public function getCalle(){
        return $this->calle ;
    }
    public function setCalle($calle){
        $this->calle = $calle ;
    }



}


?>