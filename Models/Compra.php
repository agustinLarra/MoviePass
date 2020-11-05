<?php
namespace Models;

class Compra{

    private $id;
    private $numeroTarjeta;
    private $idUser;
    private $cantidadEntradas;
    private $total;

    public function getId(){
        return $this->id ;
    }
    public function setId($id){
        $this->id = $id ;
    }
    
    public function getNumeroTarjeta(){
        return $this->numeroTarjeta ;
    }
    public function setNumeroTarjeta($numeroTarjeta){
        $this->numeroTarjeta = $numeroTarjeta ;
    }
    
    public function getIdUser(){
        return $this->idUser ;
    }
    public function setIdUser($idUser){
        $this->idUser = $idUser ;
    }

    public function getCantidadEntradas(){
        return $this->cantidadEntradas ;
    }
    public function setCantidadEntradas($cantidadEntradas){
        $this->cantidadEntradas = $cantidadEntradas ;
    }

    public function getTotal(){
        return $this->total ;
    }
    public function setTotal($total){
        $this->total = $total ;
    }







} ?>    