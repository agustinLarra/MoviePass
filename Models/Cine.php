<?php
namespace Models;

class Cine{

    private $nombre;
    private $direccion;
    private $capacidad;
    private $valorEntrada ;



    public function getNombre(){
        return $this->nombre ;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre ;
    }

    public function getDireccion(){
        return $this->direccion ;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion ;
    }

    public function getCapacidad(){
        return $this->capacidad ;
    }
    public function setCapacidad($capacidad){
        $this->capacidad = $capacidad ;
    }

    public function getValorEntrada(){
        return $this->valorEntrada ;
    }
    public function setValorEntrada($valorEntrada){
        $this->valorEntrada = $valorEntrada ;
    }



}


?>