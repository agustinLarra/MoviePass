<?php namespace Models;

class Funcion {

    private $id;
    private $Id_Pelicula;
    private $Title_Pelicula;
    private $Id_Sala;
    private $Nombre_Sala;
    private $Id_Cine;
    private $Nombre_Cine;
    private $Dia;
    private $Hora;
    private $Descuento;

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

    public function setTitlePelicula($Title_Pelicula)
    {
        $this->Title_Pelicula=$Title_Pelicula;
    }
    public function getTitlePelicula()
    {
        return $this->Title_Pelicula;
    }
    
    public function setIdSala($Id_Sala)
    {
        $this->Id_Sala=$Id_Sala;
    }
    public function getIdSala()
    {
        return $this->Id_Sala;
    }

    public function setNombreSala($Nombre_Sala)
    {
        $this->Nombre_Sala=$Nombre_Sala;
    }
    public function getNombreSala()
    {
        return $this->Nombre_Sala;
    }
    
    public function setIdCine($Id_Cine)
    {
        $this->Id_Cine=$Id_Cine;
    }
    public function getIdCine()
    {
        return $this->Id_Cine;
    }


    public function setNombreCine($Nombre_Cine)
    {
        $this->Nombre_Cine=$Nombre_Cine;
    }
    public function getNombreCine()
    {
        return $this->Nombre_Cine;
    }

    public function setDia($Dia)
    {
        $this->Dia=$Dia;
    }
    public function getDia()
    {
        return $this->Dia;
    }
    public function getHora()
    {
        return $this->Hora;
    }
    public function setHora($hora)
    {
        $this->Hora=$hora;
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