<?php 
namespace Models;

class Entrada {


    private $IdFuncion;
    private $IdCompra;
    private $Id_Pelicula;
    private $Title_Pelicula;
    private $Cine;
    private $Sala;
    private $Dia;
    private $Hora;
    private $Descuento;
    private $Cantidad_Entradas;
    private $Total;
    private $QR;
    private $Id_Usuario;



    public function getQR (){
        return $this->QR ;
    }

    public function setQR ($QR){
        $this->QR = $QR;
    }

    
    public function getIdCompra (){
        return $this->IdCompra ;
    }

    public function setIdCompra ($IdCompra){
        $this->IdCompra = $IdCompra;
    }

    public function getIdFuncion (){
        return $this->IdFuncion ;
    }

    public function setIdFuncion ($IdFuncion){
        $this->IdFuncion = $IdFuncion;
    }

    /*
    public function get (){
        return $this-> ;
    }

    public function set ($){
        $this-> = $
    }
    */

} ?>    