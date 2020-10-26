<?php namespace Models;

class Funcion {

    private $id;
    private $Id_Pelicula;
    private $Id_Sala;
    private $Horario;
    private $Descuento ;

    public function __construct()
    {
        
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    

    public function setIdPelicula($Id_Pelicula)
    {
        $this->Id_Pelicula=$Id_Pelicula;
    }
    public function getIdPelicula()
    {
        return $this->Id_Pelicula;
    }
    
    public function setIdSala($Id_Sala)
    {
        $this->Id_Sala=$Id_Sala;
    }
    public function getIdSala()
    {
        return $this->Id_Sala;
    }
    public function setHorario($Horario)
    {
        $this->Horario=$Horario;
    }
    public function getHorario()
    {
        return $this->Horario;
    }
    public function setDescuento($Descuento)
    {
        $this->Descuento=$Descuento;

    }
    public function getDescuento()
    {
        return $this->Descuento;
    }
    






}




?>