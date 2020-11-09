<?php
namespace Models;

class Sala{


    private $id;
    private $nombre;
    private $nombreCine;
    private $id_cine;
    private $precio;
    private $capacidad;
    private $tipoSala;
    private $estado;


    public function getId(){
        return $this->id ;
    }

    public function setId($id){
        $this->id = $id ;
    }    

    public function getNombre(){
        return $this->nombre ;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre ;
    }

    public function getNombreCine(){
        return $this->nombreCine ;
    }

    public function setNombreCine($nombreCine){
        $this->nombreCine = $nombreCine ;
    }


    public function getIdCine(){
        return $this->id_cine ;
    }
    public function setIdCine($id_cine){
        $this->id_cine = $id_cine ;
    }

    public function getPrecio(){
        return $this->precio ;
    }
    public function setPrecio($precio){
        $this->precio = $precio ;
    }

    public function getCapacidad(){
        return $this->capacidad ;
    }
    public function setCapacidad($capacidad){
        $this->capacidad = $capacidad ;
    }

    public function getTipoSala(){
        return $this->tipoSala ;
    }

    public function setTipoSala($tipoSala){
        $this->tipoSala = $tipoSala ;
    }

    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }


}


?>