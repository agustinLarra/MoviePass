<?php namespace Models;


class Descuento{

    private $Id_Descuento;
    private $Porcentaje;

public function getIdDescuento()
{
    return $this->Id_Descuento;
}
public function setIdDescuento($id)
{
    $this->Id_Descuento = $id;
}
public function getPorcentaje()
{
    return $this->Porcentaje;
}

public function setPorcentaje($porcentaje)
{
    $this->Porcentaje=$porcentaje;
}









}


?>