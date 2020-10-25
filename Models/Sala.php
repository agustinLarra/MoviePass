<?php
namespace Models;

class Sala{


<<<<<<< HEAD
    private $id;
=======
>>>>>>> 741892d6c85cb9b16257a3cbab3a33ba8f0a4190
    private $nombre;
    private $id_cine;
    private $precio;
    private $capacidad;
    private $tipoSala;
<<<<<<< HEAD

=======
>>>>>>> 741892d6c85cb9b16257a3cbab3a33ba8f0a4190

    public function getId(){
        return $this->id ;
    }

<<<<<<< HEAD
    public function setId($id){
        $this->id = $id ;
    }    
=======
    
>>>>>>> 741892d6c85cb9b16257a3cbab3a33ba8f0a4190

    public function getNombre(){
        return $this->nombre ;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre ;
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


}


?>